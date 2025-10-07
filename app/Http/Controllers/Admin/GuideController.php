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
        return Inertia::render('Admin/Guides/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string|max:255',
            'map_slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string|max:5000000', // Увеличен лимит для больших гайдов
            'image' => 'nullable|image|max:10240', // Увеличен до 10MB
            'is_published' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('guides', 'public');
        }

        $guide = ZombieGuide::create($validated);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Гайд успешно создан!');
    }

    public function edit(ZombieGuide $guide)
    {
        return Inertia::render('Admin/Guides/Edit', [
            'guide' => $guide
        ]);
    }

    public function update(Request $request, ZombieGuide $guide)
    {
        $validated = $request->validate([
            'game' => 'required|string|max:255',
            'map_slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string|max:5000000', // Увеличен лимит для больших гайдов
            'image' => 'nullable|image|max:10240', // Увеличен до 10MB
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($guide->image) {
                Storage::disk('public')->delete($guide->image);
            }
            $validated['image'] = $request->file('image')->store('guides', 'public');
        }

        $guide->update($validated);

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
}
