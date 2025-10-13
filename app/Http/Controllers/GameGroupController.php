<?php

namespace App\Http\Controllers;

use App\Models\GameGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameGroupController extends Controller
{
    /**
     * Получить список всех групп с фильтрами
     */
    public function index(Request $request)
    {
        $currentUserId = $request->user()->id;

        $query = GameGroup::with(['creator:id,name,avatar', 'acceptedMembers:id'])
            ->where('is_active', true);

        // Фильтр по игре
        if ($request->has('game') && $request->game) {
            $query->where('game', $request->game);
        }

        // Фильтр по режиму игры
        if ($request->has('game_mode') && $request->game_mode) {
            $query->where('game_mode', $request->game_mode);
        }

        // Фильтр по платформе
        if ($request->has('platform') && $request->platform) {
            $query->where('platform', $request->platform);
        }

        // Фильтр по уровню скилла
        if ($request->has('skill_level') && $request->skill_level) {
            $query->where('skill_level', $request->skill_level);
        }

        // Поиск по названию
        if ($request->has('query') && $request->query) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('query') . '%')
                  ->orWhere('description', 'like', '%' . $request->input('query') . '%');
            });
        }

        $groups = $query->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(function($group) use ($currentUserId) {
                $isCreator = $group->creator_id == $currentUserId;
                // is_member должен быть true только для обычных участников, НЕ для создателя
                $isMember = !$isCreator && $group->members()
                    ->where('user_id', $currentUserId)
                    ->wherePivot('status', 'accepted')
                    ->exists();

                return [
                    'id' => $group->id,
                    'name' => $group->name,
                    'description' => $group->description,
                    'contact_link' => $group->contact_link,
                    'game' => $group->game,
                    'game_mode' => $group->game_mode,
                    'platform' => $group->platform,
                    'skill_level' => $group->skill_level,
                    'language' => $group->language,
                    'max_members' => $group->max_members,
                    'current_members' => $group->getCurrentMembersCount(),
                    'has_slots' => $group->hasAvailableSlots(),
                    'creator' => $group->creator,
                    'creator_id' => $group->creator_id,
                    'is_creator' => $isCreator,
                    'is_member' => $isMember,
                    'created_at' => $group->created_at,
                ];
            });

        return response()->json($groups);
    }

    /**
     * Создать новую группу
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'contact_link' => 'nullable|string|max:500',
            'game' => 'required|string',
            'game_mode' => 'nullable|string',
            'platform' => 'nullable|string',
            'max_members' => 'required|integer|min:2|max:50',
            'skill_level' => 'nullable|string',
            'language' => 'nullable|string',
        ]);

        $group = GameGroup::create([
            'creator_id' => $request->user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'contact_link' => $validated['contact_link'] ?? null,
            'game' => $validated['game'],
            'game_mode' => $validated['game_mode'] ?? null,
            'platform' => $validated['platform'] ?? null,
            'max_members' => $validated['max_members'],
            'skill_level' => $validated['skill_level'] ?? null,
            'language' => $validated['language'] ?? 'Русский',
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Группа успешно создана!',
            'group' => $group->load('creator:id,name,avatar'),
        ]);
    }

    /**
     * Присоединиться к группе
     */
    public function join(Request $request, GameGroup $group)
    {
        $user = $request->user();

        // Проверка, не является ли пользователь создателем
        if ($group->isCreator($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Вы создатель этой группы'
            ], 400);
        }

        // Проверка, не состоит ли уже в группе
        if ($group->isMember($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже в этой группе'
            ], 400);
        }

        // Проверка свободных мест
        if (!$group->hasAvailableSlots()) {
            return response()->json([
                'success' => false,
                'message' => 'В группе нет свободных мест'
            ], 400);
        }

        // Автоматически принимаем в группу
        $group->members()->attach($user->id, [
            'status' => 'accepted',
            'joined_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Вы успешно присоединились к группе!',
        ]);
    }

    /**
     * Покинуть группу
     */
    public function leave(Request $request, GameGroup $group)
    {
        $user = $request->user();

        // Проверка, является ли создателем
        if ($group->isCreator($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Создатель не может покинуть группу. Удалите её вместо этого.'
            ], 400);
        }

        // Проверка, состоит ли в группе
        if (!$group->isMember($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не состоите в этой группе'
            ], 400);
        }

        $group->members()->detach($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Вы покинули группу',
        ]);
    }

    /**
     * Удалить группу (только создатель)
     */
    public function destroy(Request $request, GameGroup $group)
    {
        $user = $request->user();

        if (!$group->isCreator($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Только создатель может удалить группу'
            ], 403);
        }

        $group->delete();

        return response()->json([
            'success' => true,
            'message' => 'Группа успешно удалена',
        ]);
    }

    /**
     * Получить участников группы
     */
    public function members(GameGroup $group)
    {
        $creator = $group->creator;
        $members = $group->acceptedMembers()->get();

        // Объединяем создателя и участников
        $allMembers = collect([$creator])->merge($members)->unique('id');

        return response()->json([
            'creator' => $creator,
            'members' => $allMembers,
        ]);
    }
}
