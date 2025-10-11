<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WikiPage;
use App\Models\WikiWeapon;
use App\Models\WikiMap;
use App\Models\WikiZombieMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WikiPageController extends Controller
{
    public function index()
    {
        $pages = WikiPage::orderBy('game')->get();

        return Inertia::render('Admin/Wiki/Pages/Index', [
            'pages' => $pages
        ]);
    }

    public function edit($id)
    {
        $page = WikiPage::findOrFail($id);

        // Получаем весь контент для этой игры
        $allWeapons = WikiWeapon::forGame($page->game)->active()->ordered()->get();
        $allMaps = WikiMap::forGame($page->game)->active()->ordered()->get();
        $allZombieMaps = WikiZombieMap::forGame($page->game)->published()->ordered()->get();

        // Получаем текущие выбранные ID из content
        $selectedWeaponIds = $page->content['weapons'] ?? [];
        $selectedMapIds = $page->content['maps'] ?? [];
        $selectedZombieMapIds = $page->content['zombie_maps'] ?? [];

        return Inertia::render('Admin/Wiki/Pages/Edit', [
            'page' => $page,
            'allWeapons' => $allWeapons,
            'allMaps' => $allMaps,
            'allZombieMaps' => $allZombieMaps,
            'selectedWeaponIds' => $selectedWeaponIds,
            'selectedMapIds' => $selectedMapIds,
            'selectedZombieMapIds' => $selectedZombieMapIds,
        ]);
    }

    public function update(Request $request, $id)
    {
        $page = WikiPage::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'is_published' => 'boolean',
            'weapons' => 'array',
            'maps' => 'array',
            'zombie_maps' => 'array',
        ]);

        $data = [
            'title' => $request->title,
            'short_description' => $request->short_description,
            'is_published' => $request->boolean('is_published'),
            'content' => [
                'weapons' => $request->weapons ?? [],
                'maps' => $request->maps ?? [],
                'zombie_maps' => $request->zombie_maps ?? [],
            ],
        ];

        if ($request->hasFile('background_image')) {
            if ($page->background_image) {
                Storage::disk('public')->delete($page->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('wiki/pages/backgrounds', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($page->thumbnail) {
                Storage::disk('public')->delete($page->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('wiki/pages/thumbnails', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.wiki.pages.index')->with('success', 'Wiki-страница обновлена!');
    }

    public function create()
    {
        return Inertia::render('Admin/Wiki/Pages/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required|string',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'background_image' => 'nullable|image|max:3072',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = [
            'game' => $request->game,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'is_published' => $request->boolean('is_published'),
            'content' => [
                'weapons' => [],
                'maps' => [],
                'zombie_maps' => [],
            ],
        ];

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('wiki/pages/backgrounds', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('wiki/pages/thumbnails', 'public');
        }

        WikiPage::create($data);

        return redirect()->route('admin.wiki.pages.index')->with('success', 'Wiki-страница создана!');
    }

    public function destroy($id)
    {
        $page = WikiPage::findOrFail($id);

        if ($page->background_image) {
            Storage::disk('public')->delete($page->background_image);
        }
        if ($page->thumbnail) {
            Storage::disk('public')->delete($page->thumbnail);
        }

        $page->delete();

        return redirect()->route('admin.wiki.pages.index')->with('success', 'Wiki-страница удалена!');
    }
}

