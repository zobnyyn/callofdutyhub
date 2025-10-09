<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuideAchievement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller
{
    /**
     * Получить все достижения пользователя
     */
    public function getUserAchievements($userId)
    {
        $achievements = GuideAchievement::where('user_id', $userId)
            ->with(['guide' => function ($query) {
                $query->select('id', 'title', 'game', 'image', 'map_slug');
            }])
            ->orderBy('completed_at', 'desc')
            ->get();

        return response()->json([
            'achievements' => $achievements,
            'total_count' => $achievements->count()
        ]);
    }

    /**
     * Обновить отображаемые достижения
     */
    public function updateDisplayedAchievements(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'achievements' => 'required|array|max:3',
            'achievements.*' => 'exists:guide_achievements,id'
        ]);

        DB::beginTransaction();
        try {
            // Сначала сбрасываем все display_order для текущего пользователя
            GuideAchievement::where('user_id', Auth::id())
                ->update(['display_order' => null]);

            // Устанавливаем новые display_order для выбранных достижений
            foreach ($request->achievements as $index => $achievementId) {
                GuideAchievement::where('id', $achievementId)
                    ->where('user_id', Auth::id())
                    ->update(['display_order' => $index + 1]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Displayed achievements updated successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update achievements',
                'success' => false
            ], 500);
        }
    }

    /**
     * Получить отображаемые достижения пользователя
     */
    public function getDisplayedAchievements($userId)
    {
        $achievements = GuideAchievement::where('user_id', $userId)
            ->whereNotNull('display_order')
            ->with(['guide' => function ($query) {
                $query->select('id', 'title', 'game', 'image', 'map_slug');
            }])
            ->orderBy('display_order', 'asc')
            ->limit(3)
            ->get();

        return response()->json([
            'achievements' => $achievements
        ]);
    }
}
