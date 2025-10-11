<?php

namespace App\Http\Controllers;

use App\Models\GameItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GameItemController extends Controller
{
    public function index(Request $request)
    {
        $query = GameItem::query();

        // Фильтр по типу
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Фильтр по игре
        if ($request->has('game') && $request->game) {
            $query->forGame($request->game); // Используем новый scope
        }

        // Поиск
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Фильтр по активности - проверяем что значение не пустое
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $items = $query->ordered()->paginate(20);

        // Добавляем атрибут available_games к каждому предмету
        $items->getCollection()->transform(function ($item) {
            $item->available_games = $item->available_games;
            return $item;
        });

        return Inertia::render('Admin/Items/Index', [
            'items' => $items,
            'filters' => $request->only(['type', 'search', 'status', 'game']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Items/Create');
    }

    public function store(Request $request)
    {
        // Отладка: посмотрим что приходит
        \Log::info('Store request data:', [
            'has_file' => $request->hasFile('image'),
            'image_value' => $request->input('image'),
            'all_data' => $request->except(['image', 'icon']),
        ]);

        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'games' => $request->input('games', []), // Массив игр
            'rarity' => $request->input('rarity'),
            // Slug генерируется автоматически в модели
            'description' => $request->input('description'),
            'properties' => $request->input('properties', []),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->input('is_active', true),
        ];

        // Валидируем только если файл действительно загружен
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $request->validate(['image' => 'image|max:2048']);
            $data['image'] = $request->file('image')->store('game-items/images', 'public');
            \Log::info('Image stored:', ['path' => $data['image']]);
        }

        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $request->validate(['icon' => 'image|max:1024']);
            $data['icon'] = $request->file('icon')->store('game-items/icons', 'public');
        }

        $item = GameItem::create($data);

        return redirect()->route('admin.items.index')->with('success', 'Предмет успешно создан!');
    }

    public function edit(GameItem $item)
    {
        return Inertia::render('Admin/Items/Edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, GameItem $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:weapon,perk,gum,wonder_weapon,special_weapon,elixir,field_upgrade,talisman',
            'game' => 'nullable|string',
            'games' => 'nullable|array', // Добавляем валидацию для массива игр
            'rarity' => 'nullable|in:rare,epic,legendary,ultra,whimsical',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:1024',
            'properties' => 'nullable|array',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Обработка изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('game-items/images', 'public');
        } else {
            // Сохраняем старое изображение, если новое не загружено
            unset($validated['image']);
        }

        // Обработка иконки
        if ($request->hasFile('icon')) {
            // Удаляем старую иконку
            if ($item->icon) {
                Storage::disk('public')->delete($item->icon);
            }
            $validated['icon'] = $request->file('icon')->store('game-items/icons', 'public');
        } else {
            // Сохраняем старую иконку, если новая не загружена
            unset($validated['icon']);
        }

        // Slug теперь генерируется автоматически в модели при обновлении
        // Убираем ручную генерацию: $validated['slug'] = Str::slug($validated['name']);

        // Добавляем rarity в данные для обновления
        $validated['rarity'] = $request->input('rarity');

        $item->update($validated);

        return redirect()->route('admin.items.index')->with('success', 'Предмет успешно обновлен!');
    }

    public function destroy(GameItem $item)
    {
        // Удаляем файлы
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        if ($item->icon) {
            Storage::disk('public')->delete($item->icon);
        }

        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Предмет успешно удален!');
    }

    // API для получения предметов (для использования в редакторах)
    public function apiList(Request $request)
    {
        $query = GameItem::active();

        if ($request->has('type')) {
            $query->ofType($request->type);
        }

        // Фильтрация по игре - используем новый scope для поддержки множественных игр
        if ($request->has('game') && $request->game) {
            $query->forGame($request->game);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Добавляем атрибут available_games к каждому предмету
        $items = $query->ordered()->get()->map(function ($item) {
            $item->available_games = $item->available_games;
            return $item;
        });

        return response()->json([
            'items' => $items,
        ]);
    }
}
