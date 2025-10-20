<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Регистрация нового пользователя
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Отправляем письмо с подтверждением email
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Регистрация успешна! Мы отправили письмо с подтверждением на ваш email. Пожалуйста, подтвердите email перед входом.',
            'user' => $user,
            'email_verification_required' => true,
            'must_verify_email' => true,
        ], 201);
    }

    /**
     * Вход пользователя
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные.'],
            ]);
        }

        $user = Auth::user();

        // Проверяем, подтвержден ли email
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();

            return response()->json([
                'message' => 'Пожалуйста, подтвердите ваш email перед входом. Проверьте почту и перейдите по ссылке для подтверждения.',
                'email_verified' => false,
                'email' => $user->email,
            ], 403);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Вход выполнен успешно',
            'user' => $user,
            'email_verified' => true,
        ]);
    }

    /**
     * Выход пользователя
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Выход выполнен успешно',
        ]);
    }

    /**
     * Получить текущего пользователя
     */
    public function user(Request $request)
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }

    /**
     * Обновить профиль пользователя
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'telegram' => 'nullable|string|max:255',
            'discord' => 'nullable|string|max:255',
            'xbox' => 'nullable|string|max:255',
            'steam' => 'nullable|string|max:255',
            'psn' => 'nullable|string|max:255',
        ]);

        // Обновление имени и социальных сетей
        $user->name = $request->name;
        $user->telegram = $request->telegram;
        $user->discord = $request->discord;
        $user->xbox = $request->xbox;
        $user->steam = $request->steam;
        $user->psn = $request->psn;

        // Обработка загрузки аватара
        if ($request->hasFile('avatar')) {
            // Удаление старого аватара, если он существует и это не дефолтное значение
            if ($user->avatar && $user->avatar !== '0' && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Сохранение нового аватара
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            // Установка правильных прав доступа на файл
            $fullPath = storage_path('app/public/' . $avatarPath);
            chmod($fullPath, 0644);

            $user->avatar = $avatarPath;

            // Очистка кэша всех гайдов пользователя
            $this->clearUserGuidesCache($user->id);
        }

        $user->save();

        return response()->json([
            'message' => 'Профиль обновлен успешно',
            'user' => $user,
        ]);
    }

    /**
     * Очистить кэш всех гайдов пользователя
     */
    private function clearUserGuidesCache($userId)
    {
        // Получаем все гайды пользователя
        $guides = \App\Models\ZombieGuide::where('user_id', $userId)->get();

        // Очищаем кэш для каждого гайда
        foreach ($guides as $guide) {
            $cacheKey = "guide_{$guide->game}_{$guide->map_slug}_{$guide->id}";
            Cache::forget($cacheKey);

            // Также очищаем кэш списка гайдов карты
            $mapCacheKey = "guides_map_{$guide->game}_{$guide->map_slug}";
            Cache::forget($mapCacheKey);
        }
    }

    /**
     * Повторная отправка письма для подтверждения email
     */
    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email уже подтвержден',
            ], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Письмо с подтверждением отправлено!',
        ]);
    }

    /**
     * Верификация email
     */
    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                'message' => 'Неверная ссылка для подтверждения',
            ], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email уже подтвержден',
            ], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'message' => 'Email успешно подтвержден!',
        ]);
    }

    /**
     * Отправка ссылки для восстановления пароля
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Ссылка для восстановления пароля отправлена!'])
            : response()->json(['message' => 'Ошибка при отправке ссылки для восстановления пароля'], 500);
    }

    /**
     * Сброс пароля
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $response == Password::PASSWORD_RESET
            ? response()->json(['message' => 'Пароль успешно сброшен!'])
            : response()->json(['message' => 'Ошибка при сбросе пароля'], 500);
    }
}
