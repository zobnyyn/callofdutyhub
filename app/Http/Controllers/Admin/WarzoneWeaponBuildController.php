<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarzoneWeaponBuild;
use App\Models\WarzoneWeapon;
use Illuminate\Http\Request;

class WarzoneWeaponBuildController extends Controller
{
    public function store(Request $request, WarzoneWeapon $weapon)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'tier_override' => 'nullable|in:imba_patch,meta,normal,avoid',
            'is_active' => 'boolean',
            'attachments' => 'nullable|array|max:8',
            'attachments.*.slot' => 'required|string|max:50',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.stat_mods' => 'nullable|array',
        ]);

        $attachments = $validated['attachments'] ?? [];
        unset($validated['attachments']);

        $build = $weapon->builds()->create($validated);

        // Создаём attachments
        if (!empty($attachments)) {
            foreach ($attachments as $index => $attachmentData) {
                $attachmentData['sort_order'] = $index;
                $build->attachments()->create($attachmentData);
            }
        }

        return redirect()->route('admin.warzone.weapons.edit', $weapon)
            ->with('success', 'Билд успешно добавлен!');
    }

    public function update(Request $request, WarzoneWeaponBuild $build)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'tier_override' => 'nullable|in:imba_patch,meta,normal,avoid',
            'is_active' => 'boolean',
            'attachments' => 'nullable|array|max:8',
            'attachments.*.slot' => 'required|string|max:50',
            'attachments.*.name' => 'required|string|max:255',
            'attachments.*.stat_mods' => 'nullable|array',
            'attachments.*.sort_order' => 'nullable|integer',
        ]);

        $attachments = $validated['attachments'] ?? [];
        unset($validated['attachments']);

        $build->update($validated);

        // Удаляем старые attachments и создаём новые
        $build->attachments()->delete();

        if (!empty($attachments)) {
            foreach ($attachments as $attachmentData) {
                $build->attachments()->create($attachmentData);
            }
        }

        return redirect()->route('admin.warzone.weapons.edit', $build->weapon)
            ->with('success', 'Билд успешно обновлён!');
    }

    public function destroy(WarzoneWeaponBuild $build)
    {
        $weapon = $build->weapon;
        $build->delete();

        return redirect()->route('admin.warzone.weapons.edit', $weapon)
            ->with('success', 'Билд успешно удалён!');
    }
}
