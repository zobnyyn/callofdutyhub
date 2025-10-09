<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackOnlineUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $expiresAt = now()->addMinutes(5); // Пользователь считается онлайн 5 минут после последней активности

            Cache::put('user-online-' . auth()->user()->id, [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'avatar' => auth()->user()->avatar,
                'last_activity' => now()->toDateTimeString(),
            ], $expiresAt);
        } else {
            // Отслеживаем гостей по session ID
            $sessionId = session()->getId();
            $expiresAt = now()->addMinutes(5);

            Cache::put('guest-online-' . $sessionId, [
                'session_id' => $sessionId,
                'last_activity' => now()->toDateTimeString(),
            ], $expiresAt);

            // Добавляем session ID в список активных гостей
            $guestSessions = Cache::get('guest-sessions', []);
            if (!in_array($sessionId, $guestSessions)) {
                $guestSessions[] = $sessionId;
                Cache::put('guest-sessions', $guestSessions, now()->addHours(1));
            }
        }

        return $next($request);
    }
}

