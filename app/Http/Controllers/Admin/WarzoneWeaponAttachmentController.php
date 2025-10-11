<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarzoneWeaponBuildAttachment;
use App\Models\WarzoneWeaponBuild;
use Illuminate\Http\Request;

class WarzoneWeaponAttachmentController extends Controller
{
    public function store(Request $request, WarzoneWeaponBuild $build)
    {
        $validated = $request->validate([
            'slot' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'stat_mods' => 'nullable|array',
            'sort_order' => 'integer|min:0',
        ]);

        $build->attachments()->create($validated);

        return redirect()->route('admin.warzone.weapons.edit', $build->weapon)
            ->with('success', 'Attachment успешно добавлен!');
    }

    public function update(Request $request, WarzoneWeaponBuildAttachment $attachment)
    {
        $validated = $request->validate([
            'slot' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'stat_mods' => 'nullable|array',
            'sort_order' => 'integer|min:0',
        ]);

        $attachment->update($validated);

        return redirect()->route('admin.warzone.weapons.edit', $attachment->build->weapon)
            ->with('success', 'Attachment успешно обновлён!');
    }

    public function destroy(WarzoneWeaponBuildAttachment $attachment)
    {
        $weapon = $attachment->build->weapon;
        $attachment->delete();

        return redirect()->route('admin.warzone.weapons.edit', $weapon)
            ->with('success', 'Attachment успешно удалён!');
    }
}


