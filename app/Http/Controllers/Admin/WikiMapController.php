<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WikiMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WikiMapController extends Controller
{
    public function index(Request $request)
    {
        $query = WikiMap::query();

        if ($request->filled('game')) {
            $query->forGame($request->game);
        }

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $maps = $query->ordered()->paginate(20);

        return Inertia::render('Admin/Wiki/Maps/Index', [
            'maps' => $maps,
            'filters' => $request->only(['game', 'type', 'search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Wiki/Maps/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required|string',
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'minimap' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['game', 'name', 'type', 'description', 'game_modes', 'location', 'tips', 'meta_data', 'sort_order', 'is_active']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('wiki/maps/images', 'public');
        }

        if ($request->hasFile('minimap')) {
            $data['minimap'] = $request->file('minimap')->store('wiki/maps/minimaps', 'public');
        }

        WikiMap::create($data);

        return redirect()->route('admin.wiki.maps.index')->with('success', 'Карта добавлена!');
    }

    public function edit(WikiMap $map)
    {
        return Inertia::render('Admin/Wiki/Maps/Edit', [
            'map' => $map,
        ]);
    }

    public function update(Request $request, WikiMap $map)
    {
        $request->validate([
            'game' => 'required|string',
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'minimap' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['game', 'name', 'type', 'description', 'game_modes', 'location', 'tips', 'meta_data', 'sort_order', 'is_active']);

        if ($request->hasFile('image')) {
            if ($map->image) {
                Storage::disk('public')->delete($map->image);
            }
            $data['image'] = $request->file('image')->store('wiki/maps/images', 'public');
        }

        if ($request->hasFile('minimap')) {
            if ($map->minimap) {
                Storage::disk('public')->delete($map->minimap);
            }
            $data['minimap'] = $request->file('minimap')->store('wiki/maps/minimaps', 'public');
        }

        $map->update($data);

        return redirect()->route('admin.wiki.maps.index')->with('success', 'Карта обновлена!');
    }

    public function destroy(WikiMap $map)
    {
        if ($map->image) {
            Storage::disk('public')->delete($map->image);
        }
        if ($map->minimap) {
            Storage::disk('public')->delete($map->minimap);
        }

        $map->delete();

        return redirect()->route('admin.wiki.maps.index')->with('success', 'Карта удалена!');
    }
}

