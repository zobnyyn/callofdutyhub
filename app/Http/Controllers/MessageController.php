<?php
namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MessageController extends Controller
{
    /**
     * Показать страницу чата с пользователем
     */
    public function showChat($userId)
    {
        $currentUserId = Auth::id();

        // Проверяем, что пользователи друзья
        if (!$this->areFriends($currentUserId, $userId)) {
            return redirect()->route('community')->with('error', 'Вы можете писать только друзьям');
        }

        // Получаем информацию о собеседнике
        $companion = User::findOrFail($userId);

        // Получаем сообщения
        $messages = Message::where(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $currentUserId);
        })
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'asc')
        ->get();

        // Помечаем сообщения как прочитанные
        Message::where('sender_id', $userId)
            ->where('receiver_id', $currentUserId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Помечаем уведомления о сообщениях от этого пользователя как прочитанные
        Notification::where('user_id', $currentUserId)
            ->where('type', 'message')
            ->where('read', false)
            ->where('data', 'like', '%"sender_id":' . $userId . '%')
            ->update(['read' => true]);

        return Inertia::render('Chat', [
            'companion' => $companion,
            'initialMessages' => $messages,
        ]);
    }

    /**
     * Проверка являются ли пользователи друзьями
     */
    private function areFriends($userId1, $userId2)
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(function ($query) use ($userId1, $userId2) {
                $query->where(function ($q) use ($userId1, $userId2) {
                    $q->where('user_id', $userId1)
                      ->where('friend_id', $userId2);
                })
                ->orWhere(function ($q) use ($userId1, $userId2) {
                    $q->where('user_id', $userId2)
                      ->where('friend_id', $userId1);
                });
            })
            ->exists();
    }
    /**
     * Получить список всех диалогов
     */
    public function getConversations()
    {
        $userId = Auth::id();
        $conversations = DB::table('messages')
            ->select(
                DB::raw("CASE
                    WHEN sender_id = {$userId} THEN receiver_id
                    ELSE sender_id
                END as user_id"),
                DB::raw('MAX(created_at) as last_message_at'),
                DB::raw("SUM(CASE WHEN receiver_id = {$userId} AND is_read = 0 THEN 1 ELSE 0 END) as unread_count")
            )
            ->where(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->groupBy('user_id')
            ->orderBy('last_message_at', 'desc')
            ->get();
        $userIds = $conversations->pluck('user_id')->toArray();
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');
        return response()->json($conversations->map(function ($conversation) use ($users) {
            $user = $users[$conversation->user_id] ?? null;
            if (!$user) return null;
            return [
                'user' => $user,
                'last_message_at' => $conversation->last_message_at,
                'unread_count' => $conversation->unread_count,
            ];
        })->filter());
    }
    /**
     * Получить сообщения с конкретным пользователем
     */
    public function getMessages($userId)
    {
        $currentUserId = Auth::id();
        // Проверяем, что пользователи друзья
        if (!$this->areFriends($currentUserId, $userId)) {
            return response()->json(['error' => 'Вы можете писать только друзьям'], 403);
        }
        // Получаем сообщения
        $messages = Message::where(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $currentUserId);
        })
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'asc')
        ->get();
        // Помечаем сообщения как прочитанные
        Message::where('sender_id', $userId)
            ->where('receiver_id', $currentUserId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        // Помечаем уведомления о сообщениях от этого пользователя как прочитанные
        Notification::where('user_id', $currentUserId)
            ->where('type', 'message')
            ->where('read', false)
            ->where('data', 'like', '%"sender_id":' . $userId . '%')
            ->update(['read' => true]);
        return response()->json($messages);
    }
    /**
     * Отправить сообщение
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);
        $currentUserId = Auth::id();
        $receiverId = $request->receiver_id;
        // Проверяем, что пользователи друзья
        if (!$this->areFriends($currentUserId, $receiverId)) {
            return response()->json(['error' => 'Вы можете писать только друзьям'], 403);
        }
        $message = Message::create([
            'sender_id' => $currentUserId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);
        $message->load(['sender', 'receiver']);
        // Создаем уведомление для получателя
        $sender = User::find($currentUserId);
        Notification::create([
            'user_id' => $receiverId,
            'type' => 'message',
            'title' => 'Новое сообщение',
            'message' => $sender->name . ': ' . mb_substr($request->message, 0, 50) . (mb_strlen($request->message) > 50 ? '...' : ''),
            'data' => json_encode([
                'sender_id' => $currentUserId,
                'sender_name' => $sender->name,
                'message_id' => $message->id,
            ]),
            'read' => false,
        ]);
        return response()->json($message, 201);
    }
    /**
     * Получить количество непрочитанных сообщений
     */
    public function getUnreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Получить количество непрочитанных сообщений от каждого пользователя
     */
    public function getUnreadCountByUser()
    {
        $userId = Auth::id();

        $unreadCounts = Message::where('receiver_id', $userId)
            ->where('is_read', false)
            ->select('sender_id', DB::raw('count(*) as count'))
            ->groupBy('sender_id')
            ->get()
            ->pluck('count', 'sender_id');

        return response()->json($unreadCounts);
    }

    /**
     * Пометить сообщения как прочитанные
     */
    public function markAsRead($userId)
    {
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
