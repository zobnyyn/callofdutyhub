import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import fs from 'fs';

// Плагин для автоматической замены .jpg на .webp
const imageFormatPlugin = () => ({
    name: 'image-format-replacer',
    enforce: 'pre',
    resolveId(source, importer) {
        // Обрабатываем импорты изображений и видео
        if (source.match(/\.(jpg|jpeg|png|mp4)$/i)) {
            let webpSource;

            // Для видео заменяем mp4 на webm
            if (source.match(/\.mp4$/i)) {
                webpSource = source.replace(/\.mp4$/i, '.webm');
            } else {
                // Для изображений заменяем на webp
                webpSource = source.replace(/\.(jpg|jpeg|png)$/i, '.webp');
            }

            let absolutePath;

            // Если это уже абсолютный путь (начинается с /)
            if (path.isAbsolute(source)) {
                // Нормализуем путь (resolve убирает ../) и заменяем расширение
                if (source.match(/\.mp4$/i)) {
                    absolutePath = path.normalize(source).replace(/\.mp4$/i, '.webm');
                } else {
                    absolutePath = path.normalize(source).replace(/\.(jpg|jpeg|png)$/i, '.webp');
                }
            }
            // Если это относительный путь, резолвим его
            else if (importer && (source.startsWith('./') || source.startsWith('../'))) {
                const dir = path.dirname(importer);
                absolutePath = path.resolve(dir, webpSource);
            }
            // Если это путь с алиасом @
            else if (source.startsWith('@/')) {
                const relativePath = webpSource.substring(2); // убираем @/
                absolutePath = path.join(__dirname, 'resources', 'js', relativePath);
            }
            // Для путей типа @/../images
            else if (source.includes('@/../')) {
                const relativePath = source.replace('@/../', ''); // получаем images/...
                if (source.match(/\.mp4$/i)) {
                    absolutePath = path.join(__dirname, 'resources', relativePath.replace(/\.mp4$/i, '.webm'));
                } else {
                    absolutePath = path.join(__dirname, 'resources', relativePath.replace(/\.(jpg|jpeg|png)$/i, '.webp'));
                }
            }
            // Для абсолютных путей от корня resources
            else if (source.startsWith('/')) {
                absolutePath = path.join(__dirname, 'resources', webpSource.substring(1));
            }

            if (absolutePath && fs.existsSync(absolutePath)) {
                return absolutePath;
            }
        }
        return null;
    },
    configureServer(server) {
        server.middlewares.use((req, res, next) => {
            // Заменяем изображения на webp
            if (req.url && (req.url.endsWith('.jpg') || req.url.endsWith('.jpeg') || req.url.endsWith('.png'))) {
                const webpUrl = req.url.replace(/\.(jpg|jpeg|png)$/, '.webp');
                req.url = webpUrl;
            }
            // Заменяем видео на webm
            else if (req.url && req.url.endsWith('.mp4')) {
                const webmUrl = req.url.replace(/\.mp4$/, '.webm');
                req.url = webmUrl;
            }
            next();
        });
    },
    transformIndexHtml(html) {
        return html
            .replace(/\.(jpg|jpeg|png)(['"])/g, '.webp$2')
            .replace(/\.mp4(['"])/g, '.webm$2');
    }
});

export default defineConfig({
    plugins: [
        imageFormatPlugin(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
        },
    },
    server: {
        host: '0.0.0.0',
        cors: true,
        hmr: {
            host: '25.52.146.209',
            port: 5173,
        },
    },
});
