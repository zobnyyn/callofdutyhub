{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    @foreach($articles as $article)
    <url>
        <loc>{{ url('/articles/'.$article->slug) }}</loc>
        <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($guides as $guide)
    <url>
        <loc>{{ url("/zombies/{$guide->game}/{$guide->map_slug}/guides/{$guide->id}") }}</loc>
        <lastmod>{{ $guide->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    @foreach($maps as $map)
    <url>
        <loc>{{ url('/wiki/zombie-maps/'.$map->slug) }}</loc>
        <lastmod>{{ $map->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.85</priority>
    </url>
    @endforeach
</urlset>
