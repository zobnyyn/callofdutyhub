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
