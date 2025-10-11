<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WikiWeapon;
use App\Models\WikiMap;
use App\Models\WikiZombieMap;
use App\Models\WikiPage;
use Inertia\Inertia;

class WikiController extends Controller
{
    public function index()
    {
        $stats = [
            'pages' => WikiPage::count(),
            'weapons' => WikiWeapon::count(),
            'maps' => WikiMap::count(),
            'zombieMaps' => WikiZombieMap::count(),
        ];

        return Inertia::render('Admin/Wiki/Index', [
            'stats' => $stats
        ]);
    }
}
