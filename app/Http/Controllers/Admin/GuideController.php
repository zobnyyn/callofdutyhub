<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZombieGuide;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    public function index()
    {
        $guides = ZombieGuide::with('user')
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Guides/Index', [
            'guides' => $guides
        ]);
    }

    public function create()
    {
        // Загружаем все активные предметы для выбора
        $weapons = \App\Models\GameItem::active()->ofType('weapon')->ordered()->get();
        $perks = \App\Models\GameItem::active()->ofType('perk')->ordered()->get();
        $gums = \App\Models\GameItem::active()->ofType('gum')->ordered()->get();

        return Inertia::render('Admin/Guides/Create', [
            'weapons' => $weapons,
            'perks' => $perks,
            'gums' => $gums,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string|max:255',
            'map_slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string|max:5000000',
            'image' => 'nullable|image|max:10240',
            'is_published' => 'boolean',
            'gives_achievement' => 'boolean',
            'selected_weapons' => 'nullable|array',
            'selected_weapons.*' => 'exists:game_items,id',
            'selected_perks' => 'nullable|array',
            'selected_perks.*' => 'exists:game_items,id',
            'selected_gums' => 'nullable|array',
            'selected_gums.*' => 'exists:game_items,id',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('guides', 'public');
        }

        $guide = ZombieGuide::create($validated);

        // Прикрепляем предметы к гайду
        $this->attachItems($guide, $request);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Гайд успешно создан!');
    }

    public function edit(ZombieGuide $guide)
    {
        // Загружаем все активные предметы
        $weapons = \App\Models\GameItem::active()->ofType('weapon')->ordered()->get();
        $perks = \App\Models\GameItem::active()->ofType('perk')->ordered()->get();
        $gums = \App\Models\GameItem::active()->ofType('gum')->ordered()->get();

        // Загружаем уже выбранные предметы
        $guide->load('items');

        return Inertia::render('Admin/Guides/Edit', [
            'guide' => $guide,
            'weapons' => $weapons,
            'perks' => $perks,
            'gums' => $gums,
            'selectedWeapons' => $guide->items->where('pivot.category', 'weapon')->values(),
            'selectedPerks' => $guide->items->where('pivot.category', 'perk')->values(),
            'selectedGums' => $guide->items->where('pivot.category', 'gum')->values(),
        ]);
    }

    public function update(Request $request, ZombieGuide $guide)
    {
        $validated = $request->validate([
            'game' => 'required|string|max:255',
            'map_slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string|max:5000000',
            'image' => 'nullable|image|max:10240',
            'is_published' => 'boolean',
            'gives_achievement' => 'boolean',
            'selected_weapons' => 'nullable|array',
            'selected_weapons.*' => 'exists:game_items,id',
            'selected_perks' => 'nullable|array',
            'selected_perks.*' => 'exists:game_items,id',
            'selected_gums' => 'nullable|array',
            'selected_gums.*' => 'exists:game_items,id',
        ]);

        // Обрабатываем изображение только если загружено новое
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($guide->image) {
                Storage::disk('public')->delete($guide->image);
            }
            // Сохраняем новое изображение
            $validated['image'] = $request->file('image')->store('guides', 'public');
        } else {
            // Если новое изображение не загружено, удаляем поле из validated
            // чтобы старое изображение не было перезаписано
            unset($validated['image']);
        }

        $guide->update($validated);

        // Отвязываем старые предметы и прикрепляем новые
        $guide->items()->detach();
        $this->attachItems($guide, $request);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Гайд успешно обновлен!');
    }

    public function destroy(ZombieGuide $guide)
    {
        if ($guide->image) {
            Storage::disk('public')->delete($guide->image);
        }

        $guide->delete();

        return redirect()->route('admin.guides.index')
            ->with('success', 'Гайд успешно удален!');
    }

    /**
     * Прикрепить предметы к гайду
     */
    private function attachItems(ZombieGuide $guide, Request $request)
    {
        $attachData = [];
        $sortOrder = 0;

        // Прикрепляем оружие
        if ($request->has('selected_weapons')) {
            foreach ($request->selected_weapons as $weaponId) {
                $attachData[$weaponId] = [
                    'category' => 'weapon',
                    'sort_order' => $sortOrder++,
                ];
            }
        }

        // Прикрепляем перки
        if ($request->has('selected_perks')) {
            foreach ($request->selected_perks as $perkId) {
                $attachData[$perkId] = [
                    'category' => 'perk',
                    'sort_order' => $sortOrder++,
                ];
            }
        }

        // Прикрепляем жвачки
        if ($request->has('selected_gums')) {
            foreach ($request->selected_gums as $gumId) {
                $attachData[$gumId] = [
                    'category' => 'gum',
                    'sort_order' => $sortOrder++,
                ];
            }
        }

        if (!empty($attachData)) {
            $guide->items()->attach($attachData);
        }
    }
}
