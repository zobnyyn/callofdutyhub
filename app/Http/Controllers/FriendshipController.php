<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    /**
     * Получить список друзей текущего пользователя
     */
    public function index()
    {
        $user = Auth::user();

        $friends = $user->friendsOfMine()
            ->select('users.id', 'users.name', 'users.avatar')
            ->get()
            ->merge(
                $user->friendOf()
                    ->select('users.id', 'users.name', 'users.avatar')
                    ->get()
            );

        return response()->json([
            'friends' => $friends,
            'count' => $friends->count()
        ]);
    }

    /**
     * Получить входящие запросы в друзья
     */
    public function pendingRequests()
    {
        $user = Auth::user();

        $requests = $user->friendRequestsReceived()
            ->select('users.id', 'users.name', 'users.avatar', 'friendships.created_at')
            ->get();

        return response()->json([
            'requests' => $requests,
            'count' => $requests->count()
        ]);
    }

    /**
     * Получить исходящие запросы в друзья
     */
    public function sentRequests()
    {
        $user = Auth::user();

        $requests = $user->friendRequestsSent()
            ->select('users.id', 'users.name', 'users.avatar', 'friendships.created_at')
            ->get();

        return response()->json([
            'requests' => $requests,
            'count' => $requests->count()
        ]);
    }

    /**
     * Отправить запрос в друзья
     */
    public function sendRequest(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:users,id'
        ]);

        $user = Auth::user();
        $friendId = $request->friend_id;

        // Нельзя добавить самого себя
        if ($user->id === (int)$friendId) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете добавить себя в друзья'
            ], 400);
        }

        // Проверяем, есть ли уже запрос или дружба
        $existingFriendship = Friendship::where(function ($query) use ($user, $friendId) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($user, $friendId) {
            $query->where('user_id', $friendId)
                ->where('friend_id', $user->id);
        })->first();

        if ($existingFriendship) {
            if ($existingFriendship->status === 'accepted') {
                return response()->json([
                    'success' => false,
                    'message' => 'Вы уже друзья'
                ], 400);
            }

            if ($existingFriendship->status === 'pending') {
                // Если получатель отправляет запрос отправителю - автоматически принимаем
                if ($existingFriendship->friend_id === $user->id) {
                    $existingFriendship->status = 'accepted';
                    $existingFriendship->save();

                    // Создаем уведомление о принятии
                    Notification::create([
                        'user_id' => $existingFriendship->user_id,
                        'from_user_id' => $user->id,
                        'type' => 'friend_accepted',
                        'message' => $user->name . ' принял ваш запрос в друзья!',
                        'data' => ['friendship_id' => $existingFriendship->id]
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Запрос принят! Теперь вы друзья',
                        'status' => 'friends'
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Запрос уже отправлен'
                ], 400);
            }
        }

        // Создаем новый запрос
        $friendship = Friendship::create([
            'user_id' => $user->id,
            'friend_id' => $friendId,
            'status' => 'pending'
        ]);

        // Создаем уведомление для получателя
        Notification::create([
            'user_id' => $friendId,
            'from_user_id' => $user->id,
            'type' => 'friend_request',
            'message' => $user->name . ' отправил вам запрос в друзья',
            'data' => ['friendship_id' => $friendship->id]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Запрос в друзья отправлен',
            'status' => 'request_sent'
        ]);
    }

    /**
     * Принять запрос в друзья
     */
    public function acceptRequest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $currentUser = Auth::user();
        $userId = $request->user_id;

        $friendship = Friendship::where('user_id', $userId)
            ->where('friend_id', $currentUser->id)
            ->where('status', 'pending')
            ->first();

        if (!$friendship) {
            return response()->json([
                'success' => false,
                'message' => 'Запрос не найден'
            ], 404);
        }

        $friendship->status = 'accepted';
        $friendship->save();

        // Помечаем ВСЕ уведомления о запросе в друзья от этого пользователя как прочитанные
        Notification::where('user_id', $currentUser->id)
            ->where('from_user_id', $userId)
            ->where('type', 'friend_request')
            ->update(['read' => true]);

        // Создаем уведомление для отправителя запроса
        Notification::create([
            'user_id' => $userId,
            'from_user_id' => $currentUser->id,
            'type' => 'friend_accepted',
            'message' => $currentUser->name . ' принял ваш запрос в друзья!',
            'data' => json_encode(['friendship_id' => $friendship->id]),
            'read' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Запрос принят! Теперь вы друзья',
            'status' => 'friends'
        ]);
    }

    /**
     * Отклонить запрос в друзья
     */
    public function declineRequest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $currentUser = Auth::user();
        $userId = $request->user_id;

        $friendship = Friendship::where('user_id', $userId)
            ->where('friend_id', $currentUser->id)
            ->where('status', 'pending')
            ->first();

        if (!$friendship) {
            return response()->json([
                'success' => false,
                'message' => 'Запрос не найден'
            ], 404);
        }

        $friendship->delete();

        // Помечаем ВСЕ уведомления о запросе в друзья от этого пользователя как прочитанные
        Notification::where('user_id', $currentUser->id)
            ->where('from_user_id', $userId)
            ->where('type', 'friend_request')
            ->update(['read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Запрос отклонен'
        ]);
    }

    /**
     * Удалить из друзей или отменить запрос
     */
    public function removeFriend(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:users,id'
        ]);

        $user = Auth::user();
        $friendId = $request->friend_id;

        $friendship = Friendship::where(function ($query) use ($user, $friendId) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($user, $friendId) {
            $query->where('user_id', $friendId)
                ->where('friend_id', $user->id);
        })->first();

        if (!$friendship) {
            return response()->json([
                'success' => false,
                'message' => 'Дружеская связь не найдена'
            ], 404);
        }

        $friendship->delete();

        return response()->json([
            'success' => true,
            'message' => 'Удалено из друзей',
            'status' => 'none'
        ]);
    }

    /**
     * Получить статус дружбы с пользователем
     */
    public function getStatus($userId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'none'
            ]);
        }

        $status = $user->getFriendshipStatusWith($userId);

        return response()->json([
            'status' => $status
        ]);
    }
}
