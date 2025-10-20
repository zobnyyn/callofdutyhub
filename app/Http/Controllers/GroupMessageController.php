<?php

namespace App\Http\Controllers;

use App\Models\GameGroup;
use App\Models\GroupMessage;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMessageController extends Controller
{
    /**
     * Получить сообщения группы
     */
    public function getMessages($groupId)
    {
        $group = GameGroup::findOrFail($groupId);
        $userId = Auth::id();

        // Проверяем, является ли пользователь участником группы
        if (!$group->isMember($userId)) {
            return response()->json(['error' => 'Вы не являетесь участником этой группы'], 403);
        }

        // Получаем сообщения с информацией об авторах
        $messages = GroupMessage::where('game_group_id', $groupId)
            ->with('user:id,name,avatar,admin_prefix,is_admin,is_vip')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Отправить сообщение в группу
     */
    public function sendMessage(Request $request, $groupId)
    {
        $group = GameGroup::findOrFail($groupId);
        $userId = Auth::id();

        // Проверяем, является ли пользователь участником группы
        if (!$group->isMember($userId)) {
            return response()->json(['error' => 'Вы не являетесь участником этой группы'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = GroupMessage::create([
            'game_group_id' => $groupId,
            'user_id' => $userId,
            'message' => $request->message,
        ]);

        // Загружаем информацию о пользователе
        $message->load('user:id,name,avatar,admin_prefix,is_admin,is_vip');

        // Создаём уведомления для всех участников группы (кроме отправителя)
        $this->notifyGroupMembers($group, $message, $userId);

        return response()->json($message, 201);
    }

    /**
     * Отправить уведомления всем участникам группы о новом сообщении
     */
    private function notifyGroupMembers(GameGroup $group, GroupMessage $message, $senderId)
    {
        $sender = User::find($senderId);

        // Получаем всех участников группы (создатель + принятые участники)
        $memberIds = $group->acceptedMembers()->pluck('user_id')->toArray();

        // Добавляем создателя
        if ($group->creator_id != $senderId) {
            $memberIds[] = $group->creator_id;
        }

        // Удаляем отправителя из списка получателей уведомлений
        $memberIds = array_filter($memberIds, function($id) use ($senderId) {
            return $id != $senderId;
        });

        // Создаём уведомление для каждого участника
        foreach ($memberIds as $memberId) {
            Notification::create([
                'user_id' => $memberId,
                'from_user_id' => $senderId,
                'type' => 'group_message',
                'title' => 'Новое сообщение в группе',
                'message' => $sender->name . ' в "' . $group->name . '": ' . mb_substr($message->message, 0, 50) . (mb_strlen($message->message) > 50 ? '...' : ''),
                'data' => json_encode([
                    'group_id' => $group->id,
                    'group_name' => $group->name,
                    'sender_id' => $senderId,
                    'sender_name' => $sender->name,
                    'message_id' => $message->id,
                ]),
                'read' => false,
            ]);
        }
    }

    /**
     * Получить количество непрочитанных сообщений для всех групп пользователя
     */
    public function getUnreadCounts()
    {
        $userId = Auth::id();

        // Получаем группы, в которых состоит пользователь
        $groups = GameGroup::where('creator_id', $userId)
            ->orWhereHas('members', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status', 'accepted');
            })
            ->with(['messages' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get();

        $unreadCounts = [];

        foreach ($groups as $group) {
            // Для простоты считаем все непрочитанные сообщения
            // В будущем можно добавить таблицу для отслеживания прочитанных сообщений
            $unreadCounts[$group->id] = 0;
        }

        return response()->json($unreadCounts);
    }
}
