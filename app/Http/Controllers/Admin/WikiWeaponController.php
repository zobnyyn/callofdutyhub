<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WikiWeapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WikiWeaponController extends Controller
{
    public function index(Request $request)
    {
        $query = WikiWeapon::query();

        if ($request->filled('game')) {
            $query->forGame($request->game);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $weapons = $query->ordered()->paginate(20);

        return Inertia::render('Admin/Wiki/Weapons/Index', [
            'weapons' => $weapons,
            'filters' => $request->only(['game', 'category', 'search']),
            'categories' => WikiWeapon::getCategories(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Wiki/Weapons/Create', [
            'categories' => WikiWeapon::getCategories(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required|string',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:1024',
        ]);

        $data = $request->only(['game', 'name', 'category', 'description', 'stats', 'attachments', 'availability', 'sort_order', 'is_active']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('wiki/weapons/images', 'public');
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('wiki/weapons/icons', 'public');
        }

        WikiWeapon::create($data);

        return redirect()->route('admin.wiki.weapons.index')->with('success', 'Оружие добавлено!');
    }

    public function edit(WikiWeapon $weapon)
    {
        return Inertia::render('Admin/Wiki/Weapons/Edit', [
            'weapon' => $weapon,
            'categories' => WikiWeapon::getCategories(),
        ]);
    }

    public function update(Request $request, WikiWeapon $weapon)
    {
        $request->validate([
            'game' => 'required|string',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:1024',
        ]);

        $data = $request->only(['game', 'name', 'category', 'description', 'stats', 'attachments', 'availability', 'sort_order', 'is_active']);

        if ($request->hasFile('image')) {
            if ($weapon->image) {
                Storage::disk('public')->delete($weapon->image);
            }
            $data['image'] = $request->file('image')->store('wiki/weapons/images', 'public');
        }

        if ($request->hasFile('icon')) {
            if ($weapon->icon) {
                Storage::disk('public')->delete($weapon->icon);
            }
            $data['icon'] = $request->file('icon')->store('wiki/weapons/icons', 'public');
        }

        $weapon->update($data);

        return redirect()->route('admin.wiki.weapons.index')->with('success', 'Оружие обновлено!');
    }

    public function destroy(WikiWeapon $weapon)
    {
        if ($weapon->image) {
            Storage::disk('public')->delete($weapon->image);
        }
        if ($weapon->icon) {
            Storage::disk('public')->delete($weapon->icon);
        }

        $weapon->delete();

        return redirect()->route('admin.wiki.weapons.index')->with('success', 'Оружие удалено!');
    }
}

