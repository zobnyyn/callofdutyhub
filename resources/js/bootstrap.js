// VERSION: 2025-10-16-HTTPS-FIX-V8 - ПЕРЕОПРЕДЕЛЕНИЕ ДО ИМПОРТА AXIOS

// ВАЖНО: Сначала импортируем полифилл XHR — он должен выполниться синхронно ДО любых импортов axios
import './xhr-polyfill';

import axios from 'axios';

// Принудительно устанавливаем HTTPS базовый URL
// Это покрывает случаи, когда приложение доступно как на https://codterminal.ru, так и на https://codterminal.ru/public
const BASE_URL = 'https://codterminal.ru' + (window.location.pathname.includes('/public') ? '/public' : '');

// Настраиваем axios статически
const axiosInstance = axios.create({
    baseURL: BASE_URL,
    withCredentials: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    }
});

axiosInstance.defaults.withXSRFToken = true;

// Interceptor
axiosInstance.interceptors.request.use(
    (config) => {
        console.log('🔍 AXIOS:', config.method?.toUpperCase(), config.url, 'baseURL:', config.baseURL);

        // АГРЕССИВНОЕ исправление всех HTTP на HTTPS
        if (config.url && config.url.includes('http://')) {
            config.url = config.url.replace(/http:\/\//g, 'https://');
            console.warn('🔒 AXIOS: Fixed URL to HTTPS:', config.url);
        }

        if (config.baseURL && config.baseURL.includes('http://')) {
            config.baseURL = config.baseURL.replace(/http:\/\//g, 'https://');
            console.warn('🔒 AXIOS: Fixed baseURL to HTTPS:', config.baseURL);
        }

        // Исправляем все варианты codterminal.ru на HTTPS
        if (config.url && config.url.includes('codterminal.ru') && !config.url.startsWith('https://')) {
            config.url = config.url.replace(/^https?:\/\//, 'https://');
            console.log('🔧 AXIOS: Fixed codterminal.ru URL:', config.url);
        }

        if (config.baseURL && config.baseURL.includes('codterminal.ru') && !config.baseURL.startsWith('https://')) {
            config.baseURL = config.baseURL.replace(/^https?:\/\//, 'https://');
            console.log('🔧 AXIOS: Fixed codterminal.ru baseURL:', config.baseURL);
        }

        // Убеждаемся что baseURL всегда установлен правильно
        if (!config.baseURL) {
            config.baseURL = BASE_URL;
            console.log('🔧 AXIOS: Set missing baseURL to:', BASE_URL);
        }

        // Исправляем относительные API URL
        if (config.url && (config.url.startsWith('/api/') || config.url.startsWith('/public/api/')) && !config.url.startsWith('http')) {
            if (!config.baseURL) {
                config.baseURL = BASE_URL;
            }
            console.log('🔧 AXIOS: Processing relative API URL:', config.url, 'with baseURL:', config.baseURL);
        }

        return config;
    },
    (error) => Promise.reject(error)
);

// Если где-то ранее (до обновления) был установлен placeholder window.axios, попытка реплея будет предпринята.
try {
    const existing = window.axios;
    window.axios = axiosInstance;

    if (existing && existing.__queued && Array.isArray(existing.__queued) && existing.__queued.length) {
        setTimeout(() => {
            try {
                for (const item of existing.__queued.slice()) {
                    try {
                        if (!item) continue;
                        const args = Array.isArray(item.args) ? item.args : (item.args ? [item.args] : []);

                        if (item.method === '__create') {
                            try {
                                const realInst = axios.create(...(args || []));
                                if (item.instance && item.instance.__instQueue && Array.isArray(item.instance.__instQueue)) {
                                    for (const call of item.instance.__instQueue) {
                                        try {
                                            const callArgs = Array.isArray(call.args) ? call.args : (call.args ? [call.args] : []);
                                            if (typeof realInst[call.method] === 'function') {
                                                realInst[call.method](...callArgs).then(call.resolve).catch(call.reject);
                                            } else {
                                                realInst.request(...callArgs).then(call.resolve).catch(call.reject);
                                            }
                                        } catch (e) {
                                            console.error('Error replaying queued instance call', { call, error: e });
                                            if (call && typeof call.reject === 'function') call.reject(e);
                                        }
                                    }
                                }
                            } catch (e) {
                                console.warn('Failed to replay queued create()', e, item);
                            }
                        } else {
                            try {
                                const fn = axiosInstance[item.method];
                                if (typeof fn === 'function') {
                                    fn.apply(axiosInstance, args).then(item.resolve).catch(item.reject);
                                } else {
                                    axiosInstance.request(...args).then(item.resolve).catch(item.reject);
                                }
                            } catch (e) {
                                console.error('Error invoking queued axios method', { item, error: e });
                                if (item && typeof item.reject === 'function') item.reject(e);
                            }
                        }
                    } catch (e) {
                        console.error('Unhandled error while replaying queued item', { item, error: e });
                        try { if (item && typeof item.reject === 'function') item.reject(e); } catch(_){ }
                    }
                }
            } catch (outerErr) {
                console.error('Failed during queued replay loop', outerErr);
            } finally {
                try { existing.__queued.length = 0; } catch(_){ }
            }
        }, 0);
    }
} catch (e) {
    console.warn('Failed to attach axios instance to window or replay queue:', e);
    window.axios = axiosInstance;
}

// Перехватываем fetch для исправления URL
const originalFetch = window.fetch;
window.fetch = function(url, options = {}) {
    console.log('🔍 FETCH:', url, 'options:', options);
    
    // Исправляем URL если он относительный
    if (typeof url === 'string' && url.startsWith('/api/')) {
        const fullUrl = BASE_URL + url;
        console.log('🔧 FETCH: Fixed relative URL:', url, '→', fullUrl);
        url = fullUrl;
    }
    
    // АГРЕССИВНОЕ исправление HTTP на HTTPS
    if (typeof url === 'string' && url.includes('http://')) {
        url = url.replace(/http:\/\//g, 'https://');
        console.warn('🔒 FETCH: Fixed URL to HTTPS:', url);
    }
    
    return originalFetch.call(this, url, options)
        .then(response => {
            console.log('📥 FETCH Response:', response.status, response.url);
            return response;
        })
        .catch(error => {
            console.error('❌ FETCH Error:', error.message, 'for URL:', url);
            throw error;
        });
};

console.log('AXIOS baseURL:', window.axios.defaults.baseURL);
console.log('🔒 HTTPS Mode: XHR patched BEFORE axios static import');
console.log('🔒 FETCH Mode: fetch patched for URL correction');
