<?php

return [
    // Идентификатор панели, используемой по умолчанию для команд и UI
    'default_panel' => 'adminPanel',

    // Определение панелей — указываем ваш провайдер панели
    'panels' => [
        'adminPanel' => [
            'id' => 'adminPanel',
            'label' => 'Admin',
            'path' => 'adminPanel',
            'provider' => App\Providers\Filament\AdminPanelPanelProvider::class,
        ],
    ],

    // Простая секция авторизации (используется стандартный guard `web`)
    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
    ],
];

