<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ZombieGuide;
use App\Models\WikiZombieMap;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Cache::remember('sitemap-xml', 3600, function () {
            $articles = Article::orderBy('updated_at', 'desc')->get();
            $guides = ZombieGuide::orderBy('updated_at', 'desc')->get();
            $maps = WikiZombieMap::orderBy('updated_at', 'desc')->get();

            return view('sitemap', [
                'articles' => $articles,
                'guides' => $guides,
                'maps' => $maps,
            ])->render();
        });

        return response($sitemap, 200, ['Content-Type' => 'application/xml']);
    }
}

