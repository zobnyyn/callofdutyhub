<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ZombieGuide;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    /**
     * Показать страницу сообщества
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Получаем все уникальные карты из гайдов
        $maps = ZombieGuide::select('game', 'map_slug')
            ->where('is_published', true)
            ->groupBy('game', 'map_slug')
            ->orderBy('game')
            ->orderBy('map_slug')
            ->get()
            ->map(function($map) {
                // Преобразуем map_slug в читаемое название
                $title = str_replace('-', ' ', $map->map_slug);
                $title = ucwords($title);

                return [
                    'game' => $map->game,
                    'map_slug' => $map->map_slug,
                    'title' => $title,
                ];
            });

        // Получаем последние опубликованные статьи для сообщества
        $articles = \App\Models\Article::published()
            ->with('user:id,name,avatar')
            ->orderBy('published_at', 'desc')
            ->limit(50)
            ->get();

        return Inertia::render('Community', [
            'maps' => $maps,
            'articles' => $articles,
        ]);
    }

    /**
     * API: Поиск пользователей
     */
    public function searchUsers(Request $request)
    {
        $query = $request->input('query', '');
        $currentUserId = $request->user()?->id;

        $users = User::select('id', 'name', 'avatar', 'telegram', 'discord', 'steam', 'psn', 'xbox', 'created_at')
            ->where('id', '!=', $currentUserId)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('email', 'like', '%' . $query . '%');
            })
            ->limit(10) // Уменьшили лимит с 50 до 10
            ->get();

        return response()->json($users);
    }

    /**
     * API: Поиск гайдов по картам
     */
    public function searchGuides(Request $request)
    {
        $query = $request->input('query', '');
        $game = $request->input('game', '');
        $mapSlug = $request->input('map_slug', '');

        \Log::info('Search Guides params:', [
            'query' => $query,
            'game' => $game,
            'mapSlug' => $mapSlug
        ]);

        $guides = ZombieGuide::with('user:id,name,avatar')
            ->where('is_published', true);

        // Фильтр по поисковому запросу
        if ($query) {
            $guides->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        // Фильтр по игре
        if ($game) {
            $guides->where('game', $game);
        }

        // Фильтр по карте
        if ($mapSlug) {
            $guides->where('map_slug', $mapSlug);
        }

        $result = $guides->orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        \Log::info('Search Guides result count:', ['count' => $result->count()]);

        return response()->json($result);
    }

    /**
     * API: Поиск статей
     */
    public function searchArticles(Request $request)
    {
        $query = $request->input('query', '');
        $game = $request->input('game', '');
        $category = $request->input('category', '');

        \Log::info('Search Articles params:', [
            'query' => $query,
            'game' => $game,
            'category' => $category
        ]);

        $articles = \App\Models\Article::published()
            ->with('user:id,name,avatar');

        // Фильтр по поисковому запросу
        if ($query) {
            $articles->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%');
            });
        }

        // Фильтр по игре
        if ($game) {
            $articles->where('game', $game);
        }

        // Фильтр по категории
        if ($category) {
            $articles->where('category', $category);
        }

        $result = $articles->orderBy('published_at', 'desc')
            ->limit(50)
            ->get();

        \Log::info('Search Articles result count:', ['count' => $result->count()]);

        return response()->json($result);
    }
}
