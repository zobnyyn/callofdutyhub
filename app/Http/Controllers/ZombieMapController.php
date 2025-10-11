<?php

namespace App\Http\Controllers;

use App\Models\WikiZombieMap;
use Inertia\Inertia;

class ZombieMapController extends Controller
{
    public function show($slug)
    {
        $zombieMap = WikiZombieMap::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return Inertia::render('ZombieMapDetail', [
            'zombieMap' => $zombieMap
        ]);
    }
}

