<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class OnlineUsersController extends Controller
{
    public function index()
    {
        $onlineUsers = $this->getOnlineUsers();
        $guestCount = $this->getOnlineGuestsCount();

        return response()->json([
            'users' => $onlineUsers,
            'guests' => $guestCount,
            'total' => count($onlineUsers) + $guestCount,
        ]);
    }

    private function getOnlineUsers()
    {
        $users = [];

        // Получаем всех пользователей и проверяем их статус в кеше
        $allUsers = User::all();

        foreach ($allUsers as $user) {
            $onlineData = Cache::get('user-online-' . $user->id);
            if ($onlineData) {
                $users[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->avatar,
                ];
            }
        }

        return $users;
    }

    private function getOnlineGuestsCount()
    {
        // Подсчитываем гостей через отдельный счетчик
        $count = 0;

        // Получаем список активных сессий гостей
        $guestSessions = Cache::get('guest-sessions', []);

        foreach ($guestSessions as $sessionId) {
            if (Cache::has('guest-online-' . $sessionId)) {
                $count++;
            }
        }

        return $count;
    }
}

