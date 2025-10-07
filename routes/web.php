<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZombiesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZombieGuideController;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);
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

// Маршруты для гайдов зомби-карт
Route::get('/zombies/{game}/{mapSlug}/guides', [ZombieGuideController::class, 'showByMap'])->name('zombies.guides.map');
Route::get('/zombies/{game}/{mapSlug}/guides/{id}', [ZombieGuideController::class, 'show'])->name('zombies.guides.show');
Route::post('/zombies/{game}/{mapSlug}/guides/{id}/complete', [ZombieGuideController::class, 'completeGuide'])->name('zombies.guides.complete');

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
});
