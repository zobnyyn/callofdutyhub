<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Получить все уведомления текущего пользователя
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->with('fromUser:id,name,avatar')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $unreadCount = Notification::where('user_id', $user->id)
            ->unread()
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Получить только непрочитанные уведомления
     */
    public function unread()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->unread()
            ->with('fromUser:id,name,avatar')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'notifications' => $notifications,
            'count' => $notifications->count()
        ]);
    }

    /**
     * Отметить уведомление как прочитанное
     */
    public function markAsRead($id)
    {
        $user = Auth::user();

        $notification = Notification::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Уведомление отмечено как прочитанное'
        ]);
    }

    /**
     * Отметить все уведомления как прочитанные
     */
    public function markAllAsRead()
    {
        $user = Auth::user();

        Notification::where('user_id', $user->id)
            ->unread()
            ->update(['read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Все уведомления отмечены как прочитанные'
        ]);
    }

    /**
     * Удалить уведомление
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $notification = Notification::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Уведомление удалено'
        ]);
    }

    /**
     * Удалить все прочитанные уведомления
     */
    public function clearRead()
    {
        $user = Auth::user();

        Notification::where('user_id', $user->id)
            ->where('read', true)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Прочитанные уведомления удалены'
        ]);
    }

    /**
     * Получить количество непрочитанных уведомлений
     */
    public function getUnreadCount()
    {
        $user = Auth::user();

        $count = Notification::where('user_id', $user->id)
            ->unread()
            ->count();

        return response()->json([
            'count' => $count
        ]);
    }
}

