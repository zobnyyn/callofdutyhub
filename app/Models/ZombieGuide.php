<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class ZombieGuide extends Model
{
    protected $fillable = [
        'game',
        'map_slug',
        'title',
        'description',
        'content',
        'image',
        'is_published',
        'gives_achievement',
        'views',
        'user_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'gives_achievement' => 'boolean',
        'views' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Автоматически извлекаем base64 изображения перед сохранением
        static::saving(function ($guide) {
            if ($guide->isDirty('content') && $guide->content) {
                $guide->content = self::extractBase64Images($guide->content, $guide->map_slug);
            }
        });

        // Очищаем кэш после сохранения гайда
        static::saved(function ($guide) {
            $guide->clearCache();
        });

        // Очищаем кэш после удаления гайда
        static::deleted(function ($guide) {
            $guide->clearCache();
        });
    }

    /**
     * Очистить кэш для этого гайда
     */
    public function clearCache()
    {
        $cacheKey = "guide_{$this->game}_{$this->map_slug}_{$this->id}";
        Cache::forget($cacheKey);

        // Также очищаем кэш списка гайдов для этой карты
        $mapCacheKey = "guides_map_{$this->game}_{$this->map_slug}";
        Cache::forget($mapCacheKey);
    }

    /**
     * Извлекает base64 изображения из контента и сохраняет их как файлы
     */
    protected static function extractBase64Images($content, $mapSlug)
    {
        // Проверяем, есть ли base64 изображения
        if (!preg_match('/data:image/', $content)) {
            return $content;
        }

        // Создаём директорию для изображений
        $imageDir = public_path('images/guides/' . $mapSlug);
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }

        $newContent = $content;
        $imageCount = 0;

        // Находим все base64 изображения
        preg_match_all('/<img[^>]+src="data:image\/([^;]+);base64,([^"]+)"([^>]*)>/i', $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $imageCount++;
            $fullMatch = $match[0];
            $imageType = $match[1];
            $base64Data = $match[2];
            $otherAttrs = $match[3] ?? '';

            // Декодируем base64
            $imageData = base64_decode($base64Data);
            if ($imageData === false) {
                continue;
            }

            // Определяем расширение
            $extension = ($imageType === 'jpeg') ? 'jpg' : $imageType;

            // Создаём уникальное имя файла
            $filename = 'img_' . time() . '_' . $imageCount . '.' . $extension;
            $filepath = $imageDir . '/' . $filename;
            $webPath = '/images/guides/' . $mapSlug . '/' . $filename;

            // Сохраняем изображение
            if (file_put_contents($filepath, $imageData)) {
                // Заменяем base64 на путь к файлу
                $newImg = '<img src="' . $webPath . '"' . $otherAttrs . '>';
                $newContent = str_replace($fullMatch, $newImg, $newContent);
            }
        }

        return $newContent;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(GameItem::class, 'game_item_zombie_guide')
            ->withPivot('category', 'sort_order')
            ->withTimestamps()
            ->orderBy('sort_order');
    }

    /**
     * Синхронизировать предметы с очисткой кэша
     */
    public function syncItemsWithCache($items, $detaching = true)
    {
        $result = $this->items()->sync($items, $detaching);
        $this->clearCache();
        return $result;
    }

    /**
     * Прикрепить предметы с очисткой кэша
     */
    public function attachItemsWithCache($items)
    {
        $result = $this->items()->attach($items);
        $this->clearCache();
        return $result;
    }

    /**
     * Открепить предметы с очисткой кэша
     */
    public function detachItemsWithCache($items = null)
    {
        $result = $this->items()->detach($items);
        $this->clearCache();
        return $result;
    }

    /**
     * Принудительно очистить кэш (для вызова из админки)
     */
    public function forceClearCache()
    {
        $this->clearCache();

        // Также инвалидируем все возможные варианты кэша
        Cache::forget("guide_{$this->game}_{$this->map_slug}_{$this->id}");
        Cache::forget("guides_map_{$this->game}_{$this->map_slug}");

        \Log::info("Принудительная очистка кэша для гайда ID: {$this->id}");
    }

    // Получить предметы по категориям
    public function getWeapons()
    {
        return $this->items()->wherePivot('category', 'weapon')->get();
    }

    public function getPerks()
    {
        return $this->items()->wherePivot('category', 'perk')->get();
    }

    public function getGums()
    {
        return $this->items()->wherePivot('category', 'gum')->get();
    }
}
