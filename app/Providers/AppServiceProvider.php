<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\ZombieGuide;
use App\Observers\ZombieGuideObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // КРИТИЧЕСКИЙ ФИКС: Принудительное использование HTTPS на этапе регистрации
        // Это гарантирует, что HTTPS будет использоваться для ВСЕХ URL
        if ($this->app->environment('production')) {
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // КРИТИЧЕСКИЙ ФИКС: Принудительное использование HTTPS для ВСЕХ URL
        // Проверяем несколько условий для максимальной совместимости
        $shouldForceHttps =
            $this->app->environment('production') ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
            (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on') ||
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

        // ВРЕМЕННО ОТКЛЮЧЕНО для диагностики Mixed Content
        // if ($shouldForceHttps) {
        //     URL::forceScheme('https');

        //     // Устанавливаем переменные сервера для корректной работы
        //     $_SERVER['HTTPS'] = 'on';
        //     $_SERVER['SERVER_PORT'] = 443;

        //     // Дополнительно: устанавливаем APP_URL с HTTPS
        //     config(['app.url' => str_replace('http://', 'https://', config('app.url'))]);
        // }

        // Регистрируем Observer для автоматической очистки кэша
        ZombieGuide::observe(ZombieGuideObserver::class);
    }
}
