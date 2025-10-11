<?php

namespace App\Services;

use App\Models\GameItem;
use DOMDocument;
use DOMXPath;

class GuideContentProcessor
{
    /**
     * Обработать контент гайда, добавляя data-атрибуты к игровым предметам
     */
    public static function processContent(string $content): string
    {
        if (empty($content)) {
            return $content;
        }

        // Создаем DOMDocument для парсинга HTML
        $dom = new DOMDocument();

        // Отключаем предупреждения для некорректного HTML
        libxml_use_internal_errors(true);

        // Загружаем HTML с поддержкой UTF-8
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Очищаем ошибки
        libxml_clear_errors();

        // Создаем XPath для поиска элементов
        $xpath = new DOMXPath($dom);

        // Ищем все элементы с классом game-item-link или data-item-id
        $elements = $xpath->query("//*[contains(@class, 'game-item-link') or @data-item-id]");

        foreach ($elements as $element) {
            // Получаем ID предмета
            $itemId = $element->getAttribute('data-item-id');

            if (!$itemId) {
                continue;
            }

            // Загружаем предмет из базы данных
            $item = GameItem::find($itemId);

            if (!$item) {
                continue;
            }

            // Добавляем data-атрибуты
            $element->setAttribute('data-item-name', $item->name);
            $element->setAttribute('data-item-description', $item->description ?? 'Нет описания');

            if ($item->image) {
                $element->setAttribute('data-item-image', '/storage/' . $item->image);
            }

            // Добавляем информацию о редкости для жвачек, эликсиров и талисманов
            if (in_array($item->category, ['gum', 'elixir']) && $item->rarity) {
                $element->setAttribute('data-item-rarity', self::getGumRarityName($item->rarity));
                $element->setAttribute('data-item-rarity-color', self::getGumRarityColor($item->rarity));
            } elseif ($item->category === 'talisman' && $item->rarity) {
                $element->setAttribute('data-item-rarity', self::getTalismanRarityName($item->rarity));
                $element->setAttribute('data-item-rarity-color', self::getTalismanRarityColor($item->rarity));
            }

            // Добавляем класс для стилизации
            $classes = $element->getAttribute('class');
            if (strpos($classes, 'game-item-link') === false) {
                $element->setAttribute('class', trim($classes . ' game-item-link'));
            }
        }

        // Получаем обработанный HTML
        $processedContent = $dom->saveHTML();

        // Удаляем добавленный XML declaration
        $processedContent = str_replace('<?xml encoding="UTF-8">', '', $processedContent);

        return $processedContent;
    }

    /**
     * Получить название редкости жвачки/эликсира
     */
    private static function getGumRarityName(string $rarity): string
    {
        $names = [
            'rare' => 'Редкая',
            'epic' => 'Эпическая',
            'legendary' => 'Легендарная',
            'ultra' => 'Ультра',
            'whimsical' => 'Причудливая'
        ];

        return $names[$rarity] ?? $rarity;
    }

    /**
     * Получить цвет редкости жвачки/эликсира
     */
    private static function getGumRarityColor(string $rarity): string
    {
        $colors = [
            'rare' => '#3b82f6',
            'epic' => '#a855f7',
            'legendary' => '#f59e0b',
            'ultra' => '#dc2626',
            'whimsical' => '#10b981'
        ];

        return $colors[$rarity] ?? '#6b7280';
    }

    /**
     * Получить название редкости талисмана
     */
    private static function getTalismanRarityName(string $rarity): string
    {
        $names = [
            'common' => 'Обычный',
            'rare' => 'Редкий',
            'epic' => 'Эпический',
            'legendary' => 'Легендарный'
        ];

        return $names[$rarity] ?? $rarity;
    }

    /**
     * Получить цвет редкости талисмана
     */
    private static function getTalismanRarityColor(string $rarity): string
    {
        $colors = [
            'common' => '#9ca3af',
            'rare' => '#3b82f6',
            'epic' => '#a855f7',
            'legendary' => '#f59e0b'
        ];

        return $colors[$rarity] ?? '#6b7280';
    }
}

