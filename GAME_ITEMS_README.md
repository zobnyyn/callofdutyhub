# Система управления игровыми предметами

## Описание

Система позволяет администраторам управлять игровыми предметами (оружие, перки, жвачки) через веб-интерфейс. Предметы можно использовать при написании гайдов, вики статей и другого контента.

## Возможности

- ✅ Добавление, редактирование и удаление предметов
- ✅ Загрузка изображений для каждого предмета
- ✅ Категоризация по типам (оружие, перки, жвачки)
- ✅ Привязка к конкретным играм серии Call of Duty
- ✅ Поиск и фильтрация предметов
- ✅ API для использования в редакторах контента

## Структура базы данных

### Таблица `game_items`

| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint | Уникальный идентификатор |
| name | string | Название предмета |
| slug | string | URL-friendly название |
| type | enum | Тип: weapon, perk, gum |
| description | text | Описание предмета |
| image | string | Путь к изображению |
| icon | string | Путь к иконке (опционально) |
| games | json | Массив игр, в которых доступен |
| properties | json | Дополнительные свойства |
| sort_order | integer | Порядок сортировки |
| is_active | boolean | Активен ли предмет |

## Доступ к админке

### URL маршруты

- **Список предметов**: `/admin/items`
- **Создание предмета**: `/admin/items/create`
- **Редактирование предмета**: `/admin/items/{id}/edit`

### Требования

Доступ к админке имеют только пользователи с флагом `is_admin = true`.

## Использование в коде

### API для получения предметов

```javascript
// Получить все активные предметы
const response = await axios.get('/api/game-items');

// Получить предметы определенного типа
const weapons = await axios.get('/api/game-items?type=weapon');
const perks = await axios.get('/api/game-items?type=perk');
const gums = await axios.get('/api/game-items?type=gum');

// Поиск предметов
const searched = await axios.get('/api/game-items?search=ray gun');
```

### Компонент ItemPicker

Для упрощения выбора предметов в редакторах создан компонент `ItemPicker.vue`:

```vue
<template>
  <ItemPicker 
    buttonText="ДОБАВИТЬ ОРУЖИЕ"
    type="weapon"
    @select="handleItemSelect"
  />
</template>

<script setup>
import ItemPicker from '@/Components/ItemPicker.vue';

function handleItemSelect(item) {
  console.log('Выбран предмет:', item);
  // Вставить предмет в редактор
}
</script>
```

## Примеры использования

### 1. Добавление нового оружия

1. Перейдите в `/admin/items`
2. Нажмите **CREATE_ITEM**
3. Заполните форму:
   - Название: `Ray Gun`
   - Тип: `Оружие`
   - Описание: `Легендарное чудо-оружие...`
   - Загрузите изображение
   - Выберите игры: `Black Ops`, `Black Ops 2`, и т.д.
4. Нажмите **CREATE_ITEM**

### 2. Использование в гайде

После создания предметов их можно использовать в редакторе гайдов:

```vue
<template>
  <div>
    <!-- Кнопка для добавления предмета -->
    <ItemPicker @select="insertItem" />
    
    <!-- Отображение выбранных предметов -->
    <div v-for="item in selectedItems" :key="item.id">
      <img :src="`/storage/${item.image}`" :alt="item.name" />
      <h3>{{ item.name }}</h3>
      <p>{{ item.description }}</p>
    </div>
  </div>
</template>
```

### 3. Отображение в статье

В контенте можно вставлять ссылки на предметы:

```html
<!-- HTML разметка в статье -->
<div class="game-item">
  <img src="/storage/game-items/images/ray-gun.png" alt="Ray Gun" />
  <h4>Ray Gun</h4>
  <p>Легендарное чудо-оружие зомби-режима</p>
</div>
```

## Структура файлов

```
app/
├── Http/Controllers/
│   └── GameItemController.php       # Контроллер для управления предметами
├── Models/
│   └── GameItem.php                 # Модель предмета

database/
└── migrations/
    └── 2025_10_09_000000_create_game_items_table.php

resources/
├── js/
│   ├── Components/
│   │   └── ItemPicker.vue           # Компонент выбора предметов
│   └── Pages/
│       └── Admin/
│           └── Items/
│               ├── Index.vue        # Список предметов
│               ├── Create.vue       # Создание предмета
│               └── Edit.vue         # Редактирование предмета

storage/
└── app/
    └── public/
        └── game-items/
            ├── images/              # Основные изображения
            └── icons/               # Иконки предметов
```

## API Endpoints

| Метод | URL | Описание |
|-------|-----|----------|
| GET | `/admin/items` | Список предметов (админка) |
| GET | `/admin/items/create` | Форма создания |
| POST | `/admin/items` | Создать предмет |
| GET | `/admin/items/{id}/edit` | Форма редактирования |
| PUT | `/admin/items/{id}` | Обновить предмет |
| DELETE | `/admin/items/{id}` | Удалить предмет |
| GET | `/api/game-items` | Получить предметы (API) |

## Рекомендации

### Изображения

- **Формат**: PNG или JPG
- **Размер**: до 2MB
- **Рекомендуемые размеры**: 512x512px для изображений, 64x64px для иконок
- **Фон**: прозрачный для PNG

### Названия

- Используйте официальные названия из игр
- Для оружия: `Ray Gun`, `Thunder Gun`, `Wunderwaffe DG-2`
- Для перков: `Juggernog`, `Speed Cola`, `Quick Revive`
- Для жвачек: `Alchemical Antithesis`, `Shopping Free`

### Описания

Включайте полезную информацию:
- Эффекты предмета
- Особенности использования
- Стоимость (если применимо)
- Локации на картах

## Расширение функциональности

### Добавление новых полей

Если нужно добавить дополнительные поля, используйте JSON-поле `properties`:

```php
// В контроллере
$item->properties = [
    'damage' => 1000,
    'fire_rate' => 'slow',
    'ammo_capacity' => 20,
    'cost' => 950,
];
```

### Интеграция с редактором

Компонент ItemPicker можно интегрировать с любым редактором:

```javascript
// Пример для TipTap редактора
editor.chain()
  .focus()
  .insertContent({
    type: 'gameItem',
    attrs: {
      id: item.id,
      name: item.name,
      image: item.image,
    },
  })
  .run();
```

## Поддержка

При возникновении проблем проверьте:

1. ✅ Права доступа к папке `storage/app/public/game-items`
2. ✅ Символическая ссылка: `php artisan storage:link`
3. ✅ Права администратора у пользователя
4. ✅ Размер загружаемых файлов в `php.ini`

## Команды

```bash
# Запустить миграцию
docker exec laravel_app php artisan migrate

# Создать символическую ссылку для storage
docker exec laravel_app php artisan storage:link

# Очистить кэш
docker exec laravel_app php artisan cache:clear
docker exec laravel_app php artisan config:clear
```

## Будущие улучшения

- [ ] Массовая загрузка предметов через CSV
- [ ] Версионирование изменений предметов
- [ ] Статистика использования предметов в статьях
- [ ] Автоматическая генерация превью
- [ ] Теги и категории для предметов
- [ ] История изменений

