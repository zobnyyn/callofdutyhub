<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarzoneWeapon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class WarzoneWeaponController extends Controller
{
    public function index(Request $request)
    {
        $query = WarzoneWeapon::with('builds');

        // Фильтры
        if ($request->filled('tier')) {
            $query->byTier($request->tier);
        }

        if ($request->filled('origin')) {
            $query->byOrigin($request->origin);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $weapons = $query->latest()->paginate(15);

        return Inertia::render('Admin/Warzone/Weapons/Index', [
            'weapons' => $weapons,
            'filters' => $request->only(['tier', 'origin', 'category', 'search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Warzone/Weapons/Create', [
            'tiers' => $this->getTiers(),
            'origins' => $this->getOrigins(),
            'categories' => $this->getCategories(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tier' => 'required|in:imba_patch,meta,normal,avoid',
            'origin_game' => 'required|in:mw2022,mw2023,bo6',
            'category' => 'required|in:ar,smg,lmg,marksman,sniper,shotgun,pistol,launcher,melee,tactical,battlerifle',
            'categories' => 'nullable|array',
            'categories.*' => 'in:ar,smg,lmg,marksman,sniper,shotgun,pistol,launcher,melee,tactical,battlerifle',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'builds' => 'nullable|array',
            'builds.*.title' => 'required|string|max:255',
            'builds.*.role' => 'nullable|string|max:255',
            'builds.*.notes' => 'nullable|string',
            'builds.*.tier_override' => 'nullable|in:imba_patch,meta,normal,avoid',
            'builds.*.attachments' => 'nullable|array|max:8',
            'builds.*.attachments.*.slot' => 'required|string|max:50',
            'builds.*.attachments.*.name' => 'required|string|max:255',
            'builds.*.attachments.*.stat_mods' => 'nullable|array',
        ]);

        // Загрузка изображения
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('warzone/weapons', 'public');
        }

        // Создаём оружие
        $weapon = WarzoneWeapon::create($validated);

        // Создаём билды если есть
        if (!empty($validated['builds'])) {
            foreach ($validated['builds'] as $buildData) {
                $attachments = $buildData['attachments'] ?? [];
                unset($buildData['attachments']);

                $build = $weapon->builds()->create($buildData);

                // Создаём attachments
                if (!empty($attachments)) {
                    foreach ($attachments as $index => $attachmentData) {
                        $attachmentData['sort_order'] = $index;
                        $build->attachments()->create($attachmentData);
                    }
                }
            }
        }

        return redirect()->route('admin.warzone.weapons.index')
            ->with('success', 'Оружие успешно создано!');
    }

    public function edit(WarzoneWeapon $weapon)
    {
        $weapon->load(['builds.attachments']);

        return Inertia::render('Admin/Warzone/Weapons/Edit', [
            'weapon' => $weapon,
            'tiers' => $this->getTiers(),
            'origins' => $this->getOrigins(),
            'categories' => $this->getCategories(),
        ]);
    }

    public function manageBuilds(WarzoneWeapon $weapon)
    {
        $weapon->load(['builds.attachments']);

        return Inertia::render('Admin/Warzone/Weapons/ManageBuilds', [
            'weapon' => $weapon,
            'tiers' => $this->getTiers(),
        ]);
    }

    public function update(Request $request, WarzoneWeapon $weapon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tier' => 'required|in:imba_patch,meta,normal,avoid',
            'origin_game' => 'required|in:mw2022,mw2023,bo6',
            'category' => 'required|in:ar,smg,lmg,marksman,sniper,shotgun,pistol,launcher,melee,tactical,battlerifle',
            'categories' => 'nullable|array',
            'categories.*' => 'in:ar,smg,lmg,marksman,sniper,shotgun,pistol,launcher,melee,tactical,battlerifle',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Загрузка нового изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($weapon->image) {
                Storage::disk('public')->delete($weapon->image);
            }
            $validated['image'] = $request->file('image')->store('warzone/weapons', 'public');
        } else {
            // Сохраняем старое изображение, если новое не загружено
            unset($validated['image']);
        }

        $weapon->update($validated);

        return redirect()->route('admin.warzone.weapons.edit', $weapon)
            ->with('success', 'Оружие успешно обновлено!');
    }

    public function destroy(WarzoneWeapon $weapon)
    {
        // Удаляем изображение
        if ($weapon->image) {
            Storage::disk('public')->delete($weapon->image);
        }

        $weapon->delete();

        return redirect()->route('admin.warzone.weapons.index')
            ->with('success', 'Оружие успешно удалено!');
    }

    // Вспомогательные методы
    private function getTiers()
    {
        return [
            ['value' => 'imba_patch', 'label' => 'ИМБА ПАТЧА'],
            ['value' => 'meta', 'label' => 'МЕТА'],
            ['value' => 'normal', 'label' => 'НОРМИК'],
            ['value' => 'avoid', 'label' => 'НЕ СТОИТ БРАТЬ'],
        ];
    }

    private function getOrigins()
    {
        return [
            ['value' => 'mw2022', 'label' => 'Modern Warfare II (2022)'],
            ['value' => 'mw2023', 'label' => 'Modern Warfare III (2023)'],
            ['value' => 'bo6', 'label' => 'Black Ops 6 (2024)'],
        ];
    }

    private function getCategories()
    {
        return [
            ['value' => 'ar', 'label' => 'Assault Rifle'],
            ['value' => 'smg', 'label' => 'SMG'],
            ['value' => 'lmg', 'label' => 'LMG'],
            ['value' => 'marksman', 'label' => 'Marksman Rifle'],
            ['value' => 'sniper', 'label' => 'Sniper Rifle'],
            ['value' => 'shotgun', 'label' => 'Shotgun'],
            ['value' => 'pistol', 'label' => 'Pistol'],
            ['value' => 'launcher', 'label' => 'Launcher'],
            ['value' => 'melee', 'label' => 'Melee'],
            ['value' => 'tactical', 'label' => 'Tactical'],
            ['value' => 'battlerifle', 'label' => 'Battle Rifle'],
        ];
    }
}
