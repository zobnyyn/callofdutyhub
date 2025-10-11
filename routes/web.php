<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZombiesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZombieGuideController;
use App\Http\Controllers\CommunityController;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/rules', function () {
    return Inertia::render('Rules');
})->name('rules');

Route::get('/partnership', function () {
    return Inertia::render('Partnership');
})->name('partnership');

// Страница сообщества
Route::get('/community', [CommunityController::class, 'index'])->middleware('auth')->name('community');

// Страница чата
Route::get('/chat/{userId}', [\App\Http\Controllers\MessageController::class, 'showChat'])->middleware('auth')->name('chat.show');

Route::get('/black-ops', function () {
    return Inertia::render('BlackOps');
})->name('blackops');
Route::get('/modern-warfare', function () {
    return Inertia::render('ModernWarfare');
})->name('modernwarfare');
Route::get('/cod-wiki', function () {
    return Inertia::render('CodWiki');
})->name('codwiki');

// Прямые маршруты для новых Modern Warfare Wiki-страниц (должны быть ПЕРЕД динамическим маршрутом)
Route::get('/wiki/cod4-modern-warfare', function () {
    return Inertia::render('ModernWarfare2007Wiki');
})->name('wiki.cod4');

Route::get('/wiki/modern-warfare-2', function () {
    return Inertia::render('ModernWarfare2009Wiki');
})->name('wiki.mw2');

Route::get('/wiki/modern-warfare-3', function () {
    return Inertia::render('ModernWarfare2011Wiki');
})->name('wiki.mw3');

Route::get('/wiki/modern-warfare-2019', function () {
    return Inertia::render('ModernWarfare2019Wiki');
})->name('wiki.mw2019');

Route::get('/wiki/modern-warfare-2022', function () {
    return Inertia::render('ModernWarfare2022Wiki');
})->name('wiki.mw2022');

Route::get('/wiki/modern-warfare-2023', function () {
    return Inertia::render('ModernWarfare2023Wiki');
})->name('wiki.mw2023');

Route::get('/wiki/black-ops', function () {
    return Inertia::render('BlackOpsWiki');
})->name('wiki.blackops');

Route::get('/wiki/black-ops-2', function () {
    return Inertia::render('BlackOps2Wiki');
})->name('wiki.blackops2');

Route::get('/wiki/black-ops-3', function () {
    return Inertia::render('BlackOps3Wiki');
})->name('wiki.blackops3');

Route::get('/wiki/black-ops-4', function () {
    return Inertia::render('BlackOps4Wiki');
})->name('wiki.blackops4');

Route::get('/wiki/black-ops-cold-war', function () {
    return Inertia::render('BlackOpsColdWarWiki');
})->name('wiki.blackopscoldwar');

Route::get('/wiki/black-ops-6', function () {
    return Inertia::render('BlackOps6Wiki');
})->name('wiki.blackops6');

// Wiki страницы для отдельных игр (динамический маршрут должен быть ПОСЛЕ конкретных)
Route::get('/wiki/{game}', [\App\Http\Controllers\WikiPageController::class, 'show'])->name('wiki.show');

// Детальные страницы зомби-карт
Route::get('/wiki/zombie-maps/{slug}', [\App\Http\Controllers\ZombieMapController::class, 'show'])->name('wiki.zombie-map.show');

Route::get('/zombies', [ZombiesController::class, 'index'])->name('zombies');
Route::get('/zombies/world-at-war', function () {
    return Inertia::render('WorldAtWarZombies');
})->name('zombies.worldatwar');
Route::get('/zombies/black-ops', function () {
    return Inertia::render('BlackOpsZombies');
})->name('zombies.blackops');
Route::get('/zombies/black-ops-2', function () {
    return Inertia::render('BlackOps2Zombies');
})->name('zombies.blackops2');
Route::get('/zombies/black-ops-3', function () {
    return Inertia::render('BlackOps3Zombies');
})->name('zombies.blackops3');
Route::get('/zombies/black-ops-4', function () {
    return Inertia::render('BlackOps4Zombies');
})->name('zombies.blackops4');
Route::get('/zombies/cold-war', function () {
    return Inertia::render('ColdWarZombies');
})->name('zombies.coldwar');
Route::get('/zombies/black-ops-6', function () {
    return Inertia::render('BlackOps6Zombies');
})->name('zombies.blackops6');
Route::get('/zombies/black-ops-7', function () {
    return Inertia::render('BlackOps7Zombies');
})->name('zombies.blackops7');

// Маршруты для гайдов зомби-карт (требуют авторизации)
Route::middleware('auth')->group(function () {
    Route::get('/zombies/{game}/{mapSlug}/guides', [ZombieGuideController::class, 'showByMap'])->name('zombies.guides.map');
    Route::get('/zombies/{game}/{mapSlug}/guides/{id}', [ZombieGuideController::class, 'show'])->name('zombies.guides.show');
    Route::post('/zombies/{game}/{mapSlug}/guides/{id}/complete', [ZombieGuideController::class, 'completeGuide'])->name('zombies.guides.complete');
});

// Маршруты для достижений
Route::get('/api/achievements/user/{userId}', [\App\Http\Controllers\AchievementController::class, 'getUserAchievements'])->name('achievements.user');
Route::get('/api/achievements/displayed/{userId}', [\App\Http\Controllers\AchievementController::class, 'getDisplayedAchievements'])->name('achievements.displayed');
Route::post('/api/achievements/update-displayed', [\App\Http\Controllers\AchievementController::class, 'updateDisplayedAchievements'])->middleware('auth')->name('achievements.update');

// API для онлайн пользователей
Route::get('/api/online-users', [\App\Http\Controllers\OnlineUsersController::class, 'index'])->name('online.users');

// API для системы друзей
Route::middleware('auth')->prefix('api/friends')->group(function () {
    Route::get('/', [\App\Http\Controllers\FriendshipController::class, 'index'])->name('friends.index');
    Route::get('/requests', [\App\Http\Controllers\FriendshipController::class, 'pendingRequests'])->name('friends.requests');
    Route::get('/sent', [\App\Http\Controllers\FriendshipController::class, 'sentRequests'])->name('friends.sent');
    Route::get('/status/{userId}', [\App\Http\Controllers\FriendshipController::class, 'getStatus'])->name('friends.status');
    Route::post('/send', [\App\Http\Controllers\FriendshipController::class, 'sendRequest'])->name('friends.send');
    Route::post('/accept', [\App\Http\Controllers\FriendshipController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/decline', [\App\Http\Controllers\FriendshipController::class, 'declineRequest'])->name('friends.decline');
    Route::delete('/remove', [\App\Http\Controllers\FriendshipController::class, 'removeFriend'])->name('friends.remove');
});

// API для системы уведомлений
Route::middleware('auth')->prefix('api/notifications')->group(function () {
    Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/unread', [\App\Http\Controllers\NotificationController::class, 'unread'])->name('notifications.unread');
    Route::get('/count', [\App\Http\Controllers\NotificationController::class, 'getUnreadCount'])->name('notifications.count');
    Route::post('/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/clear/read', [\App\Http\Controllers\NotificationController::class, 'clearRead'])->name('notifications.clearRead');
});

// API для системы сообщений
Route::middleware('auth')->prefix('api/messages')->group(function () {
    Route::get('/conversations', [\App\Http\Controllers\MessageController::class, 'getConversations'])->name('messages.conversations');
    Route::get('/unread-count', [\App\Http\Controllers\MessageController::class, 'getUnreadCount'])->name('messages.unread.count');
    Route::get('/unread-by-user', [\App\Http\Controllers\MessageController::class, 'getUnreadCountByUser'])->name('messages.unread.by.user');
    Route::get('/{userId}', [\App\Http\Controllers\MessageController::class, 'getMessages'])->name('messages.get');
    Route::post('/send', [\App\Http\Controllers\MessageController::class, 'sendMessage'])->name('messages.send');
    Route::post('/{userId}/read', [\App\Http\Controllers\MessageController::class, 'markAsRead'])->name('messages.read');
});

// API для страницы сообщества
Route::middleware('auth')->prefix('api/community')->group(function () {
    Route::get('/users/search', [CommunityController::class, 'searchUsers'])->name('community.users.search');
    Route::get('/guides/search', [CommunityController::class, 'searchGuides'])->name('community.guides.search');
    Route::get('/articles/search', [CommunityController::class, 'searchArticles'])->name('community.articles.search');
});

// Страницы аутентификации
Route::get('/register', function () {
    return Inertia::render('Register');
})->middleware('guest')->name('register.page');

Route::get('/login', function () {
    return Inertia::render('Login');
})->middleware('guest')->name('login.page');

// Страница редактирования профиля
Route::get('/profile/edit', function () {
    return Inertia::render('ProfileEdit');
})->middleware('auth')->name('profile.edit');

// Страница просмотра профиля пользователя
Route::get('/profile/{user}', function ($userId) {
    $user = \App\Models\User::findOrFail($userId);
    return Inertia::render('ProfileView', [
        'profileUser' => $user
    ]);
})->name('profile.view');

// Маршруты аутентификации
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth')->name('user');
Route::post('/profile', [AuthController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

// Admin Routes - Управление гайдами
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/guides', [\App\Http\Controllers\Admin\GuideController::class, 'index'])->name('guides.index');
    Route::get('/guides/create', [\App\Http\Controllers\Admin\GuideController::class, 'create'])->name('guides.create');
    Route::post('/guides', [\App\Http\Controllers\Admin\GuideController::class, 'store'])->name('guides.store');
    Route::get('/guides/{guide}/edit', [\App\Http\Controllers\Admin\GuideController::class, 'edit'])->name('guides.edit');
    Route::put('/guides/{guide}', [\App\Http\Controllers\Admin\GuideController::class, 'update'])->name('guides.update');
    Route::delete('/guides/{guide}', [\App\Http\Controllers\Admin\GuideController::class, 'destroy'])->name('guides.destroy');

    // Управление игровыми предметами (оружие, перки, жвачки)
    Route::get('/items', [\App\Http\Controllers\GameItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [\App\Http\Controllers\GameItemController::class, 'create'])->name('items.create');
    Route::post('/items', [\App\Http\Controllers\GameItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [\App\Http\Controllers\GameItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [\App\Http\Controllers\GameItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [\App\Http\Controllers\GameItemController::class, 'destroy'])->name('items.destroy');

    // Управление статьями
    Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [\App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [\App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [\App\Http\Controllers\ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [\App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [\App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');

    // Управление Wiki-контентом
    Route::prefix('wiki')->name('wiki.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\WikiController::class, 'index'])->name('index');
        Route::resource('pages', \App\Http\Controllers\Admin\WikiPageController::class);
        Route::resource('weapons', \App\Http\Controllers\Admin\WikiWeaponController::class);
        Route::resource('maps', \App\Http\Controllers\Admin\WikiMapController::class);
        Route::resource('zombie-maps', \App\Http\Controllers\Admin\WikiZombieMapController::class);
    });
});

// Публичные роуты для статей
Route::get('/articles', [\AppHttp\Controllers\ArticleController::class, 'publicIndex'])->name('articles.public.index');
Route::get('/articles/{article:slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// API для получения предметов (для использования в редакторах)
Route::get('/api/game-items', [\App\Http\Controllers\GameItemController::class, 'apiList'])->name('api.items.list');

// API для Wiki-контента
Route::prefix('api/wiki')->name('api.wiki.')->group(function () {
    Route::get('/{game}/weapons', [\AppHttp\Controllers\WikiController::class, 'getWeapons'])->name('weapons');
    Route::get('/{game}/maps', [\App\Http\Controllers\WikiController::class, 'getMaps'])->name('maps');
    Route::get('/{game}/zombie-maps', [\App\Http\Controllers\WikiController::class, 'getZombieMaps'])->name('zombie-maps');
    Route::get('/{game}/zombie-maps/{slug}', [\App\Http\Controllers\WikiController::class, 'getZombieMap'])->name('zombie-map');
});

// Warzone Meta Hub - Admin Routes
Route::middleware(['auth','admin'])->prefix('admin/warzone')->name('admin.warzone.')->group(function() {
    Route::get('weapons', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'index'])->name('weapons.index');
    Route::get('weapons/create', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'create'])->name('weapons.create');
    Route::post('weapons', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'store'])->name('weapons.store');
    Route::get('weapons/{weapon}/edit', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'edit'])->name('weapons.edit');
    Route::put('weapons/{weapon}', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'update'])->name('weapons.update');
    Route::post('weapons/{weapon}', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'update']); // Для загрузки файлов
    Route::delete('weapons/{weapon}', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'destroy'])->name('weapons.destroy');

    // Builds Management Page
    Route::get('weapons/{weapon}/builds', [\App\Http\Controllers\Admin\WarzoneWeaponController::class,'manageBuilds'])->name('weapons.builds');

    // Builds
    Route::post('weapons/{weapon}/builds', [\App\Http\Controllers\Admin\WarzoneWeaponBuildController::class,'store'])->name('builds.store');
    Route::put('builds/{build}', [\App\Http\Controllers\Admin\WarzoneWeaponBuildController::class,'update'])->name('builds.update');
    Route::delete('builds/{build}', [\App\Http\Controllers\Admin\WarzoneWeaponBuildController::class,'destroy'])->name('builds.destroy');

    // Attachments
    Route::post('builds/{build}/attachments', [\App\Http\Controllers\Admin\WarzoneWeaponAttachmentController::class,'store'])->name('attachments.store');
    Route::put('attachments/{attachment}', [\App\Http\Controllers\Admin\WarzoneWeaponAttachmentController::class,'update'])->name('attachments.update');
    Route::delete('attachments/{attachment}', [\App\Http\Controllers\Admin\WarzoneWeaponAttachmentController::class,'destroy'])->name('attachments.destroy');
});

// Warzone Meta Hub - Public Routes
Route::get('/warzone/meta', [\App\Http\Controllers\WarzoneMetaController::class,'index'])->name('warzone.meta');
Route::get('/warzone/meta/{slug}', [\App\Http\Controllers\WarzoneMetaController::class,'show'])->name('warzone.meta.show');

// Warzone Meta Hub - API для поиска (AJAX)
Route::get('/api/warzone/meta/weapons', [\App\Http\Controllers\WarzoneMetaController::class,'search'])->name('api.warzone.meta.search');
