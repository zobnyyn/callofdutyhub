<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'game',
        'category',
        'excerpt',
        'content',
        'image',
        'user_id',
        'is_published',
        'published_at',
        'views_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'views_count' => 'integer',
    ];

    // Автоматическое создание slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    // Связь с пользователем (автор)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope для опубликованных статей
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }

    // Scope для фильтрации по игре
    public function scopeForGame($query, $game)
    {
        return $query->where('game', $game);
    }

    // Получить URL изображения
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Увеличить счетчик просмотров
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
