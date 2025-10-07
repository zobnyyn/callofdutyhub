<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

        Auth::login($user);

        return response()->json([
            'message' => 'Регистрация успешна',
            'user' => $user,
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

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Вход выполнен успешно',
            'user' => Auth::user(),
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
        }

        $user->save();

        return response()->json([
            'message' => 'Профиль обновлен успешно',
            'user' => $user,
        ]);
    }
}
