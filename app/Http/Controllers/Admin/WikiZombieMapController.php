<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WikiZombieMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WikiZombieMapController extends Controller
{
    public function index(Request $request)
    {
        $query = WikiZombieMap::query();

        if ($request->filled('game')) {
            $query->forGame($request->game);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $zombieMaps = $query->ordered()->paginate(20);

        return Inertia::render('Admin/Wiki/ZombieMaps/Index', [
            'zombieMaps' => $zombieMaps,
            'filters' => $request->only(['game', 'search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Wiki/ZombieMaps/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'story' => 'nullable|string',
            'background_image' => 'nullable|image|max:3072',
            'thumbnail' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:3072',
        ]);

        $data = $request->only([
            'game', 'name', 'description', 'story', 'release_date', 'dlc_pack',
            'features', 'easter_eggs', 'perks', 'weapons', 'characters', 'tips',
            'sort_order', 'is_published'
        ]);

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('wiki/zombie-maps/backgrounds', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('wiki/zombie-maps/thumbnails', 'public');
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('wiki/zombie-maps/gallery', 'public');
            }
            $data['images'] = $imagePaths;
        }

        WikiZombieMap::create($data);

        return redirect()->route('admin.wiki.zombie-maps.index')->with('success', 'Зомби-карта добавлена!');
    }

    public function edit(WikiZombieMap $zombieMap)
    {
        return Inertia::render('Admin/Wiki/ZombieMaps/Edit', [
            'map' => $zombieMap,
        ]);
    }

    public function update(Request $request, WikiZombieMap $zombieMap)
    {
        $request->validate([
            'game' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'story' => 'nullable|string',
            'background_image' => 'nullable|image|max:3072',
            'thumbnail' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:3072',
        ]);

        $data = $request->only([
            'game', 'name', 'description', 'story', 'release_date', 'dlc_pack',
            'features', 'easter_eggs', 'perks', 'weapons', 'characters', 'tips',
            'sort_order', 'is_published'
        ]);

        if ($request->hasFile('background_image')) {
            if ($zombieMap->background_image) {
                Storage::disk('public')->delete($zombieMap->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('wiki/zombie-maps/backgrounds', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($zombieMap->thumbnail) {
                Storage::disk('public')->delete($zombieMap->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('wiki/zombie-maps/thumbnails', 'public');
        }

        if ($request->hasFile('images')) {
            if ($zombieMap->images && is_array($zombieMap->images)) {
                foreach ($zombieMap->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('wiki/zombie-maps/gallery', 'public');
            }
            $data['images'] = $imagePaths;
        }

        $zombieMap->update($data);

        return redirect()->route('admin.wiki.zombie-maps.index')->with('success', 'Зомби-карта обновлена!');
    }

    public function destroy(WikiZombieMap $zombieMap)
    {
        if ($zombieMap->background_image) {
            Storage::disk('public')->delete($zombieMap->background_image);
        }
        if ($zombieMap->thumbnail) {
            Storage::disk('public')->delete($zombieMap->thumbnail);
        }
        if ($zombieMap->images && is_array($zombieMap->images)) {
            foreach ($zombieMap->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $zombieMap->delete();

        return redirect()->route('admin.wiki.zombie-maps.index')->with('success', 'Зомби-карта удалена!');
    }
}
