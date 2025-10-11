<?php

namespace App\Http\Controllers;

use App\Models\WarzoneWeapon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WarzoneMetaController extends Controller
{
    public function index(Request $request)
    {
        $query = WarzoneWeapon::withCount('builds')->active();

        // Фильтры
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('tier')) {
            $query->byTier($request->tier);
        }

        if ($request->filled('origin')) {
            $query->byOrigin($request->origin);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Сортировка по tier (по умолчанию)
        $query->orderByRaw("CASE
            WHEN tier = 'imba_patch' THEN 1
            WHEN tier = 'meta' THEN 2
            WHEN tier = 'normal' THEN 3
            WHEN tier = 'avoid' THEN 4
            ELSE 999
        END")
        ->orderBy('sort_order')
        ->orderBy('name');

        $weapons = $query->paginate(24)->withQueryString();

        return Inertia::render('Warzone/MetaIndex', [
            'weapons' => $weapons,
            'categories' => $this->getCategories(),
            'filters' => $request->only(['search', 'tier', 'origin', 'category']),
        ]);
    }

    public function show($slug)
    {
        $weapon = WarzoneWeapon::where('slug', $slug)
            ->where('is_active', true)
            ->with(['builds' => function ($query) {
                $query->where('is_active', true)->with('attachments');
            }])
            ->firstOrFail();

        return Inertia::render('Warzone/MetaShow', [
            'weapon' => $weapon,
        ]);
    }

    public function search(Request $request)
    {
        $query = WarzoneWeapon::with('builds')->active();

        // Поиск по тексту
        if ($request->filled('q')) {
            $query->search($request->q);
        }

        // Фильтр по tier
        if ($request->filled('tier')) {
            $tiers = is_array($request->tier) ? $request->tier : [$request->tier];
            $query->byTier($tiers);
        }

        // Фильтр по origin
        if ($request->filled('origin')) {
            $origins = is_array($request->origin) ? $request->origin : [$request->origin];
            $query->byOrigin($origins);
        }

        // Фильтр по category
        if ($request->filled('category')) {
            $categories = is_array($request->category) ? $request->category : [$request->category];
            $query->byCategory($categories);
        }

        // Сортировка
        $sort = $request->get('sort', 'tier');
        switch ($sort) {
            case 'tier':
                $query->orderByRaw("CASE
                    WHEN tier = 'imba_patch' THEN 1
                    WHEN tier = 'meta' THEN 2
                    WHEN tier = 'normal' THEN 3
                    WHEN tier = 'avoid' THEN 4
                    ELSE 999
                END");
                break;
            case 'popularity':
                $query->orderBy('popularity', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'updated':
                $query->orderBy('updated_at', 'desc');
                break;
        }

        $weapons = $query->paginate(24);

        return response()->json([
            'data' => $weapons->items(),
            'meta' => [
                'current_page' => $weapons->currentPage(),
                'last_page' => $weapons->lastPage(),
                'per_page' => $weapons->perPage(),
                'total' => $weapons->total(),
            ],
            'filters_applied' => $request->only(['q', 'tier', 'origin', 'category', 'sort']),
        ]);
    }

    private function getTiers()
    {
        return [
            ['value' => 'imba_patch', 'label' => 'ИМБА ПАТЧА', 'color' => 'from-orange-500 via-red-500'],
            ['value' => 'meta', 'label' => 'МЕТА', 'color' => 'from-emerald-500'],
            ['value' => 'normal', 'label' => 'НОРМИК', 'color' => 'from-sky-500'],
            ['value' => 'avoid', 'label' => 'НЕ СТОИТ БРАТЬ', 'color' => 'from-gray-500'],
        ];
    }

    private function getOrigins()
    {
        return [
            ['value' => 'mw2022', 'label' => 'MW II (2022)'],
            ['value' => 'mw2023', 'label' => 'MW III (2023)'],
            ['value' => 'bo6', 'label' => 'BO6 (2024)'],
        ];
    }

    private function getCategories()
    {
        return [
            ['value' => 'ar', 'label' => 'AR'],
            ['value' => 'smg', 'label' => 'SMG'],
            ['value' => 'lmg', 'label' => 'LMG'],
            ['value' => 'marksman', 'label' => 'Marksman'],
            ['value' => 'sniper', 'label' => 'Sniper'],
            ['value' => 'shotgun', 'label' => 'Shotgun'],
            ['value' => 'pistol', 'label' => 'Pistol'],
            ['value' => 'launcher', 'label' => 'Launcher'],
            ['value' => 'melee', 'label' => 'Melee'],
            ['value' => 'tactical', 'label' => 'Tactical'],
            ['value' => 'battlerifle', 'label' => 'Battle Rifle'],
        ];
    }
}
