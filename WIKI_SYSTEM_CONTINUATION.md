# Wiki System - Документация для продолжения работы

## Текущее состояние (Шаг 3 ЗАВЕРШЕН ✓)

### Что уже сделано:

#### 1. **Админка для управления Wiki-страницами** (Шаг 1 - ЗАВЕРШЕН)
Созданы файлы:
- `/app/Http/Controllers/Admin/WikiPageController.php` - контроллер для управления Wiki-страницами игр
- `/resources/js/Pages/Admin/Wiki/Pages/Index.vue` - список всех Wiki-страниц
- `/resources/js/Pages/Admin/Wiki/Pages/Edit.vue` - редактирование страницы с выбором оружия/карт/зомби-карт

#### 2. **Модели уже существуют:**
- `WikiPage` - страницы игр (связь с оружием, картами, зомби-картами через поле `content`)
- `WikiWeapon` - оружие
- `WikiMap` - карты
- `WikiZombieMap` - зомби-карты

#### 3. **Маршруты добавлены:**
```php
// Публичные маршруты:
Route::get('/wiki/{game}', [\App\Http\Controllers\WikiPageController::class, 'show'])->name('wiki.show');
Route::get('/wiki/zombie-maps/{slug}', [\App\Http\Controllers\ZombieMapController::class, 'show'])->name('wiki.zombie-map.show');

// Админские маршруты (внутри admin middleware):
Route::prefix('wiki')->name('wiki.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\WikiController::class, 'index'])->name('index');
    Route::resource('pages', \App\Http\Controllers\Admin\WikiPageController::class);
    Route::resource('weapons', \App\Http\Controllers\Admin\WikiWeaponController::class);
    Route::resource('maps', \App\Http\Controllers\Admin\WikiMapController::class);
    Route::resource('zombie-maps', \App\Http\Controllers\Admin\WikiZombieMapController::class);
});
```

#### 4. **Публичное отображение Wiki-страниц** (Шаг 2 - ЗАВЕРШЕН ✓)

**Созданы/обновлены контроллеры:**
- `/app/Http/Controllers/WikiPageController.php` - ✓ СОЗДАН
  - Метод `show($game)` загружает WikiPage для игры
  - Получает выбранное оружие, карты и зомби-карты по ID из `content`
  - Передает данные в соответствующий Vue-компонент

- `/app/Http/Controllers/ZombieMapController.php` - ✓ СОЗДАН
  - Метод `show($slug)` отображает детальную страницу зомби-карты

**Обновлены Vue-компоненты:**
- `/resources/js/Pages/WorldAtWarWiki.vue` - ✓ ОБНОВЛЕН
  - Добавлены props: `page`, `weapons`, `maps`, `zombieMaps`
  - Динамическое отображение зомби-карт с изображениями
  - Динамическое отображение оружия с иконками
  - Динамическое отображение карт с миникартами
  - Ссылки на детальные страницы зомби-карт
  - Fallback на статичные данные если динамические не загружены

- `/resources/js/Pages/ZombieMapDetail.vue` - ✓ СОЗДАН
  - Детальная страница зомби-карты
  - Отображение описания, истории, пасхалок
  - Отображение перков, персонажей, особенностей
  - Отображение советов
  - Breadcrumbs навигация
  - Кнопка возврата к Wiki игры

**Фронтенд скомпилирован:** ✓

#### 5. **Дополнительные улучшения** (Шаг 3 - ЗАВЕРШЕН ✓)

**✅ Галерея изображений для зомби-карт:**
- `/resources/js/Pages/ZombieMapDetail.vue` - ОБНОВЛЕН
  - Добавлена секция галереи изображений
  - Реализован полноценный лайтбокс для просмотра изображений
  - Навигация стрелками клавиатуры (Left/Right Arrow, Escape)
  - Навигация кнопками мыши (Предыдущее/Следующее)
  - Счетчик изображений (1 / 5)
  - Закрытие по клику вне изображения или по кнопке закрытия

**✅ Обновлены Wiki-страницы для всех игр:**
- `/resources/js/Pages/BlackOpsWiki.vue` - ✓ СОЗДАН (янтарная цветовая схема)
- `/resources/js/Pages/BlackOps2Wiki.vue` - ✓ СОЗДАН (синяя цветовая схема)
- `/resources/js/Pages/BlackOps3Wiki.vue` - ✓ СОЗДАН (фиолетовая цветовая схема)
- `/resources/js/Pages/BlackOps4Wiki.vue` - ✓ СОЗДАН (оранжевая цветовая схема)
- `/resources/js/Pages/BlackOps6Wiki.vue` - ✓ СОЗДАН (голубая цветовая схема)
- `/resources/js/Pages/ColdWarWiki.vue` - ✓ СОЗДАН (красная цветовая схема)

Все компоненты:
- Используют динамические данные из контроллера (props)
- Отображают зомби-карты с превью и ссылками на детальные страницы
- Отображают оружие и карты
- Имеют уникальную цветовую схему для каждой игры
- Полностью адаптивны и соответствуют дизайну терминала

**Фронтенд скомпилирован:** ✓

---

## Как работает система:

### Для админа:
1. Заходит в `/admin/wiki/pages`
2. Редактирует страницу игры (например, "World at War")
3. Галочками выбирает нужное оружие, карты и зомби-карты
4. Сохраняет - данные записываются в `wiki_pages.content` как JSON:
```json
{
  "weapons": [1, 3, 5, 7],
  "maps": [2, 4, 6],
  "zombie_maps": [1, 2]
}
```

### Для пользователей:
1. Заходят на `/wiki/world-at-war`
2. Видят динамически загруженный контент:
   - Оружие с иконками
   - Карты с миникартами
   - Зомби-карты с превью
3. Кликают на зомби-карту → переходят на `/wiki/zombie-maps/nacht-der-untoten`
4. Видят полную информацию о карте

---

## Что было реализовано в Шаге 3:

### 1. **Галерея изображений с лайтбоксом**
```vue
// В ZombieMapDetail.vue теперь есть:
- Сетка превью изображений (2-3 колонки)
- Клик по превью открывает полноэкранный лайтбокс
- Навигация стрелками: ← → для переключения изображений
- Навигация клавиатурой: Arrow Left/Right, Escape
- Счетчик: "3 / 8" показывает текущее изображение
- Плавные transitions и hover-эффекты
```

### 2. **Wiki-компоненты для всех игр**
Каждая игра имеет свой компонент с уникальным дизайном:

| Игра | Компонент | Цветовая схема | Статус |
|------|-----------|----------------|---------|
| World at War | WorldAtWarWiki.vue | Красная | ✓ Обновлен |
| Black Ops | BlackOpsWiki.vue | Янтарная | ✓ Создан |
| Black Ops 2 | BlackOps2Wiki.vue | Синяя | ✓ Создан |
| Black Ops 3 | BlackOps3Wiki.vue | Фиолетовая | ✓ Создан |
| Black Ops 4 | BlackOps4Wiki.vue | Оранжевая | ✓ Создан |
| Black Ops 6 | BlackOps6Wiki.vue | Голубая | ✓ Создан |
| Cold War | ColdWarWiki.vue | Красная | ✓ Создан |

### 3. **Структура каждого Wiki-компонента:**
```vue
Разделы:
- ОБЗОР - краткое описание игры
- ЗОМБИ - динамический список зомби-карт с изображениями
- ОРУЖИЕ - динамический список оружия с иконками
- КАРТЫ - динамический список мультиплеерных карт

Особенности:
- Props: page, weapons, maps, zombieMaps
- Динамическая загрузка контента из БД
- Fallback сообщения если данных нет
- Ссылки на детальные страницы зомби-карт
- Быстрые ссылки на зомби-режим и возврат к COD Wiki
```

---

## Готово к использованию:

✅ **Шаг 1:** Админка для управления Wiki-страницами  
✅ **Шаг 2:** Публичное отображение Wiki-страниц с динамическим контентом  
✅ **Шаг 3:** Галерея изображений + Wiki-компоненты для всех игр

### Доступные маршруты:

**Публичные Wiki-страницы:**
- `/wiki/world-at-war` → WorldAtWarWiki.vue
- `/wiki/black-ops` → BlackOpsWiki.vue
- `/wiki/black-ops-2` → BlackOps2Wiki.vue
- `/wiki/black-ops-3` → BlackOps3Wiki.vue
- `/wiki/black-ops-4` → BlackOps4Wiki.vue
- `/wiki/black-ops-6` → BlackOps6Wiki.vue
- `/wiki/cold-war` → ColdWarWiki.vue

**Детальные страницы зомби-карт:**
- `/wiki/zombie-maps/{slug}` → ZombieMapDetail.vue с галереей

**Админка:**
- `/admin/wiki/pages` - управление Wiki-страницами
- `/admin/wiki/weapons` - управление оружием
- `/admin/wiki/maps` - управление картами
- `/admin/wiki/zombie-maps` - управление зомби-картами

---

## Следующие возможные улучшения (опционально):

### 1. **Создать Wiki для Modern Warfare серии**
Нужно создать компоненты (по аналогии с Black Ops):
- `ModernWarfareWiki.vue`
- `ModernWarfare2Wiki.vue`
- `ModernWarfare3Wiki.vue`

### 2. **Добавить поиск по Wiki**
- Компонент поиска в Header
- Фильтрация по названию оружия/карт
- API endpoint для поиска

### 3. **SEO оптимизация**
- Использовать `<Head>` от Inertia.js
- Добавить meta-теги через `meta_data` в WikiPage
- Open Graph теги для социальных сетей

### 4. **Связь с системой гайдов**
- Добавить на страницы зомби-карт ссылки на гайды
- Интеграция с существующей системой ZombieGuide

### 5. **Статистика и аналитика**
- Счетчик просмотров Wiki-страниц
- Популярное оружие/карты
- Рейтинговая система

---

## Файлы для работы:

### Контроллеры:
- ✅ `/app/Http/Controllers/WikiPageController.php` - публичные страницы
- ✅ `/app/Http/Controllers/ZombieMapController.php` - детальные страницы зомби-карт
- ✅ `/app/Http/Controllers/Admin/WikiPageController.php` - админка

### Vue-компоненты:
- ✅ `/resources/js/Pages/WorldAtWarWiki.vue` - обновлен (Шаг 2)
- ✅ `/resources/js/Pages/BlackOpsWiki.vue` - создан (Шаг 3)
- ✅ `/resources/js/Pages/BlackOps2Wiki.vue` - создан (Шаг 3)
- ✅ `/resources/js/Pages/BlackOps3Wiki.vue` - создан (Шаг 3)
- ✅ `/resources/js/Pages/BlackOps4Wiki.vue` - создан (Шаг 3)
- ✅ `/resources/js/Pages/BlackOps6Wiki.vue` - создан (Шаг 3)
- ✅ `/resources/js/Pages/ColdWarWiki.vue` - создан (Шаг 3)
- ✅ `/resources/js/Pages/ZombieMapDetail.vue` - обновлен с галереей (Шаг 3)
- ⏳ Modern Warfare серия - не созданы (опционально)

### Модели:
- ✅ `/app/Models/WikiPage.php`
- ✅ `/app/Models/WikiWeapon.php`
- ✅ `/app/Models/WikiMap.php`
- ✅ `/app/Models/WikiZombieMap.php`

---

## Технические детали Шага 3:

### Лайтбокс в ZombieMapDetail.vue:
```vue
Функционал:
- openLightbox(index) - открывает лайтбокс
- closeLightbox() - закрывает лайтбокс
- nextImage() - следующее изображение
- previousImage() - предыдущее изображение
- handleKeydown(e) - обработка клавиатуры

Клавиши:
- Escape - закрыть лайтбокс
- Arrow Right - следующее изображение
- Arrow Left - предыдущее изображение

Используется:
- <Teleport to="body"> - для рендера поверх всего
- <Transition name="fade"> - плавное появление/исчезновение
- z-index: 9999 - поверх всех элементов
```

### Цветовые схемы игр:
```css
World at War:    #dc2626 (red-600)     - красный
Black Ops:       #f59e0b (amber-500)   - янтарный
Black Ops 2:     #3b82f6 (blue-500)    - синий
Black Ops 3:     #8b5cf6 (violet-500)  - фиолетовый
Black Ops 4:     #f97316 (orange-500)  - оранжевый
Black Ops 6:     #06b6d4 (cyan-500)    - голубой
Cold War:        #ef4444 (red-500)     - красный
```

---

**Дата обновления:** 2025-01-10  
**Статус:** Все три шага полностью завершены ✓

## Итого реализовано:

✅ Админка для управления Wiki-контентом  
✅ Публичные Wiki-страницы с динамическим контентом  
✅ Детальные страницы зомби-карт с галереей  
✅ 7 уникальных Wiki-компонентов для разных игр  
✅ Лайтбокс для просмотра изображений  
✅ Полностью responsive дизайн  
✅ Терминальный стиль интерфейса  

**Система полностью готова к использованию и наполнению контентом!** 🚀


**Шаг 4: Отображение зомби-карт на страницах игр**
Добавим кнопки/ссылки на статьи зомби-карт на страницах игр.
