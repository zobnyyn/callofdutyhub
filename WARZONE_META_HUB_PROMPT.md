# WARZONE META HUB (Оружие и Сборки) — Подробный Промт для ИИ Агентов

**СТАТУС:** 🟡 В ПРОЦЕССЕ (Бэкенд готов, фронтенд в разработке)  
**ДАТА ПОСЛЕДНЕГО ОБНОВЛЕНИЯ:** 2025-10-11  
**ВЕРСИЯ:** 1.1

Этот документ — максимально детализированное техзадание / промт. Его можно напрямую передавать ИИ агенту для реализации функционала "Warzone Meta Hub" в текущем проекте (Laravel + Inertia + Vue + Tailwind, терминальный стиль интерфейса). Сначала реализуем АДМИН-ЧАСТЬ (CRUD оружия и сборок), затем публичную страницу.

## ✅ ВЫПОЛНЕНО (2025-10-11)

### База данных
- ✅ Миграция `2025_10_11_100000_create_warzone_weapons_table.php`
- ✅ Миграция `2025_10_11_100100_create_warzone_weapon_builds_table.php`
- ✅ Миграция `2025_10_11_100200_create_warzone_weapon_build_attachments_table.php`
- ✅ Все миграции выполнены успешно

### Модели
- ✅ `app/Models/WarzoneWeapon.php` - со всеми scopes и helper методами
- ✅ `app/Models/WarzoneWeaponBuild.php` - с связями
- ✅ `app/Models/WarzoneWeaponBuildAttachment.php` - с кастами

### Контроллеры (Backend)
- ✅ `app/Http/Controllers/Admin/WarzoneWeaponController.php` - полный CRUD
- ✅ `app/Http/Controllers/Admin/WarzoneWeaponBuildController.php` - управление билдами
- ✅ `app/Http/Controllers/Admin/WarzoneWeaponAttachmentController.php` - управление attachments
- ✅ `app/Http/Controllers/WarzoneMetaController.php` - публичный + API поиска

### Маршруты
- ✅ Добавлены админские маршруты в `routes/web.php` (с middleware auth + admin)
- ✅ Добавлены публичные маршруты
- ✅ Добавлен API endpoint для поиска

### Навигация
- ✅ Добавлена ссылка "WARZONE META" в основное меню Header.vue
- ✅ Добавлена ссылка "Warzone Meta Hub" в админское выпадающее меню (desktop + mobile)

---

## 🔄 В РАБОТЕ / СЛЕДУЮЩИЕ ШАГИ

### Фронтенд (Vue компоненты)
**Приоритет:** ВЫСОКИЙ

#### Админ-панель страницы:
- ⏳ `resources/js/Pages/Admin/Warzone/Weapons/Index.vue`
- ⏳ `resources/js/Pages/Admin/Warzone/Weapons/Create.vue`
- ⏳ `resources/js/Pages/Admin/Warzone/Weapons/Edit.vue`

#### Публичные страницы:
- ⏳ `resources/js/Pages/Warzone/MetaIndex.vue`
- ⏳ `resources/js/Pages/Warzone/MetaShow.vue`

#### Компоненты:
- ⏳ `resources/js/Components/Warzone/TierBadge.vue`
- ⏳ `resources/js/Components/Warzone/WeaponCard.vue`
- ⏳ `resources/js/Components/Warzone/FiltersPanel.vue`
- ⏳ `resources/js/Components/Warzone/BuildBlock.vue`
- ⏳ `resources/js/Components/Warzone/AttachmentsTable.vue`

#### Тесты:
- ⏳ Feature тесты для CRUD операций
- ⏳ API тесты для поиска и фильтрации

---

## 1. ЦЕЛЬ
Создать систему управления и отображения Meta-оружия Warzone (оружие + сборки) с возможностью:
- Админ: добавлять / редактировать / архивировать оружие и его сборки (варианты билдов).
- Публичная страница: искать и фильтровать оружие по статусу меты, происхождению (игровой части), категории, текстовому запросу.
- Отображать для каждого оружия один или несколько билдов с прикреплёнными слотами (attachments/насадки).

## 2. ТЕРМИНЫ
- Оружие (Weapon) — базовая сущность.
- Сборка / билд (Build) — конкретная конфигурация оружия (набор модулей, описание, роль).
- Attachment (насадка) — элемент в слоте (модуль оружия), например: Muzzle, Barrel, Optic.
- Tier (уровень меты) — статус силы.
- Origin Game — из какого набора (MW2022, MW2023, BO6).
- Category — класс оружия (AR, SMG, LMG, Marksman, Sniper, Shotgun, Pistol, Launcher, Melee, Tactical, BattleRifle и т.п.).

## 3. КЛЮЧЕВЫЕ СПРАВОЧНИКИ
### 3.1. Tiers (enum)
| Машинное | Визуал | Сортировка (вес) | Цвет (Tailwind) |
|----------|--------|------------------|-----------------|
| imba_patch | ИМБА ПАТЧА | 1 | from-orange-500 via-red-500 |
| meta | МЕТА | 2 | from-emerald-500 |
| normal | НОРМИК | 3 | from-sky-500 |
| avoid | НЕ СТОИТ БРАТЬ | 4 | from-gray-500 |

Сортировка по метовости — по возрастанию веса (ИМБА выше).

### 3.2. Origin Games (enum)
- mw2022 → Modern Warfare II (2022)
- mw2023 → Modern Warfare III (2023)
- bo6 → Black Ops 6 (2024)

### 3.3. Weapon Categories (enum)
`ar, smg, lmg, marksman, sniper, shotgun, pistol, launcher, melee, tactical, battlerifle`
(дополнительно допускаем расширение).

### 3.4. Attachment Slots (рекомендуемый минимальный набор)
`muzzle, barrel, underbarrel, optic, stock, rear_grip, magazine, ammunition, laser, bolt, trigger, guard, perk1, perk2`
— хранить как свободно расширяемый текстовый slot.

## 4. СТРУКТУРА БАЗЫ ДАННЫХ ✅ ВЫПОЛНЕНО
### 4.1. Таблица: warzone_weapons ✅
| Поле | Тип | Описание |
|------|-----|----------|
| id | id | PK |
| name | string | Название оружия |
| slug | string unique | Slug (автогенерация) |
| tier | enum(imba_patch,meta,normal,avoid) | Текущий уровень меты |
| origin_game | enum(mw2022,mw2023,bo6) | Происхождение |
| category | enum(...) | Основная категория |
| categories | json nullable | Доп.категории (массив строк) |
| image | string nullable | Путь к картинке (public storage) |
| description | text nullable | Краткое описание / контекст |
| is_active | boolean default true | Показывать ли публично |
| popularity | integer default 0 | Метрика сортировки (в будущем) |
| sort_order | integer default 0 | Ручной порядок |
| created_at / updated_at | timestamps |  |
| published_at | timestamp nullable | Когда добавлено в мету |

Индексы: `tier, origin_game, category, is_active, sort_order`.

### 4.2. Таблица: warzone_weapon_builds ✅
| Поле | Тип | Описание |
|------|-----|----------|
| id | id | PK |
| warzone_weapon_id | foreignId | FK → warzone_weapons (cascade) |
| title | string | Название билда (например: "Long Range Beam") |
| role | string nullable | Роль (range, sniper support, mobility) |
| notes | text nullable | Комментарии / тактика |
| tier_override | enum(...) nullable | Перекрытие tier для конкретной сборки |
| is_active | boolean default true | Используется ли |
| created_at / updated_at | timestamps |  |

Индекс: `warzone_weapon_id, is_active`.

### 4.3. Таблица: warzone_weapon_build_attachments ✅
| Поле | Тип | Описание |
|------|-----|----------|
| id | id | PK |
| warzone_weapon_build_id | foreignId | FK → warzone_weapon_builds (cascade) |
| slot | string | Название слота (muzzle и т.д.) |
| name | string | Название насадки |
| stat_mods | json nullable | Модификаторы (например: {"recoil":"-5%","ads":"+20ms"}) |
| sort_order | integer default 0 | Порядок отображения |
| created_at / updated_at | timestamps |  |

Уникальность: (warzone_weapon_build_id, slot) — опционально (если хотим 1 слот = 1 attachment). Можно НЕ ограничивать, если допускаем альтернативы.

## 5. МОДЕЛИ (Eloquent) ✅ ВЫПОЛНЕНО
Созданы модели:
- ✅ `WarzoneWeapon` - с автогенерацией slug, scopes (active, byTier, byOrigin, byCategory, search), helper методы
- ✅ `WarzoneWeaponBuild` - с методом getEffectiveTier()
- ✅ `WarzoneWeaponBuildAttachment`

Связи:
```php
WarzoneWeapon hasMany WarzoneWeaponBuild -> builds
WarzoneWeaponBuild belongsTo WarzoneWeapon
WarzoneWeaponBuild hasMany WarzoneWeaponBuildAttachment -> attachments
WarzoneWeaponBuildAttachment belongsTo WarzoneWeaponBuild
```

Casts:
- `categories` (array)
- `stat_mods` (array)
- `tier` и `tier_override` валидируются через enum.

Slug: генерируется через `Str::slug(name)` с проверкой уникальности (как в `GameItem`).

## 6. ВАЛИДАЦИЯ
### 6.1. Создание / обновление оружия
```
name: required|string|max:255
image: nullable|image|max:2048
tier: required|in:imba_patch,meta,normal,avoid
origin_game: required|in:mw2022,mw2023,bo6
category: required|in:ar,smg,lmg,marksman,sniper,shotgun,pistol,launcher,melee,tactical,battlerifle
categories: array|nullable
categories.*: in:ar,smg,lmg,marksman,sniper,shotgun,pistol,launcher,melee,tactical,battlerifle
description: nullable|string
is_active: boolean
sort_order: integer|min:0
published_at: nullable|date
```

### 6.2. Создание / обновление билда
```
warzone_weapon_id: required|exists:warzone_weapons,id
title: required|string|max:255
role: nullable|string|max:255
notes: nullable|string
tier_override: nullable|in:imba_patch,meta,normal,avoid
is_active: boolean
attachments: array (при массовом создании)
attachments.*.slot: required|string|max:50
attachments.*.name: required|string|max:255
attachments.*.stat_mods: array|nullable
attachments.*.sort_order: integer|min:0
```

## 7. АВТОРИЗАЦИЯ ✅ ВЫПОЛНЕНО
Только пользователи `is_admin = true` имеют доступ к префиксу `/admin/warzone/weapons`.
Используется middleware `['auth', 'admin']` (уже существующий в проекте).

## 8. МАРШРУТЫ (Routes) ✅ ВЫПОЛНЕНО
Добавлены в `routes/web.php`:
```php
// Warzone Meta Hub - Admin Routes
Route::middleware(['auth','admin'])->prefix('admin/warzone')->name('admin.warzone.')->group(function() {
    Route::get('weapons', [Admin\WarzoneWeaponController::class,'index'])->name('weapons.index');
    Route::get('weapons/create', [Admin\WarzoneWeaponController::class,'create'])->name('weapons.create');
    Route::post('weapons', [Admin\WarzoneWeaponController::class,'store'])->name('weapons.store');
    Route::get('weapons/{weapon}/edit', [Admin\WarzoneWeaponController::class,'edit'])->name('weapons.edit');
    Route::put('weapons/{weapon}', [Admin\WarzoneWeaponController::class,'update'])->name('weapons.update');
    Route::delete('weapons/{weapon}', [Admin\WarzoneWeaponController::class,'destroy'])->name('weapons.destroy');

    // Builds
    Route::post('weapons/{weapon}/builds', [Admin\WarzoneWeaponBuildController::class,'store'])->name('builds.store');
    Route::put('builds/{build}', [Admin\WarzoneWeaponBuildController::class,'update'])->name('builds.update');
    Route::delete('builds/{build}', [Admin\WarzoneWeaponBuildController::class,'destroy'])->name('builds.destroy');

    // Attachments
    Route::post('builds/{build}/attachments', [Admin\WarzoneWeaponAttachmentController::class,'store'])->name('attachments.store');
    Route::put('attachments/{attachment}', [Admin\WarzoneWeaponAttachmentController::class,'update'])->name('attachments.update');
    Route::delete('attachments/{attachment}', [Admin\WarzoneWeaponAttachmentController::class,'destroy'])->name('attachments.destroy');
});

// Warzone Meta Hub - Public Routes
Route::get('/warzone/meta', [WarzoneMetaController::class,'index'])->name('warzone.meta');
Route::get('/warzone/meta/weapons/{slug}', [WarzoneMetaController::class,'show'])->name('warzone.meta.show');

// Warzone Meta Hub - API для поиска (AJAX)
Route::get('/api/warzone/meta/weapons', [WarzoneMetaController::class,'search'])->name('api.warzone.meta.search');
```

## 9. КОНТРОЛЛЕРЫ (Backend) ✅ ВЫПОЛНЕНО
### 9.1. Admin\\WarzoneWeaponController ✅
Реализованы все методы:
- ✅ index: пагинация, фильтры по tier/origin/category, кнопки перехода
- ✅ create: возвращает списки enums для форм
- ✅ store: создаёт weapon + (опционально build + attachments из одного payload)
- ✅ edit: грузит weapon + builds + attachments
- ✅ update: обновляет данные; возможность перезалить image
- ✅ destroy: удаляет weapon и изображение

### 9.2. Admin\\WarzoneWeaponBuildController ✅
CRUD для билдов реализован.

### 9.3. Admin\\WarzoneWeaponAttachmentController ✅
Создание/обновление/удаление attachments реализовано.

### 9.4. WarzoneMetaController (публично) ✅
- ✅ index: возвращает базовые фильтры (tiers, origins, categories) + начальные данные
- ✅ search (GET API): параметры: `q, tier, origin, category, sort`
- ✅ show: подробный просмотр оружия и его билдов

### 9.5. Параметры поиска (search)
```
q: строка (LIKE name, description)
tier: один или массив
origin: один или массив
category: один или массив
sort: tier (по весу), popularity(desc), name(asc), updated(desc)
page: пагинация
```
Ответ JSON: `data: [], meta: { pagination }, filters_applied: {...}`.

## 10. ФРОНТЕНД (Vue / Inertia) ⏳ В РАБОТЕ
### 10.1. Добавление ссылки в Header ✅ ВЫПОЛНЕНО
В `Header.vue` добавлены пункты:
- ✅ Основное меню: "WARZONE META" → `/warzone/meta`
- ✅ Админское меню: "Warzone Meta Hub" → `/admin/warzone/weapons`
- ✅ Мобильное меню также обновлено

### 10.2. Admin/Weapons/Index.vue ⏳ СЛЕДУЮЩИЙ ШАГ
Функционал:
- Таблица: Name, Tier (с цветным бейджем), Origin, Category, Builds count, Updated, Actions.
- Фильтры (select): Tier, Origin, Category.
- Поиск (input) — по name.
- Кнопка: "Добавить оружие" → create.

**Пример структуры (следовать стилю Admin/Guides/Index.vue):**
```vue
<template>
  <!-- Terminal Background -->
  <!-- Header Component -->
  <Header />
  
  <!-- Admin Section с терминальным стилем -->
  <section class="pt-40 pb-24 px-6">
    <!-- Terminal Header с анимацией -->
    <!-- Page Title & Create Button -->
    <!-- Filters Row (tier, origin, category, search) -->
    <!-- Weapons Table -->
    <!-- Pagination -->
  </section>
</template>
```

### 10.3. Admin/Weapons/Create.vue ⏳
Форма:
- Name
- Tier (select с цветными бейджами)
- Origin Game (select)
- Category (select)
- Доп.категории (multi-select или чекбоксы)
- Image upload (с preview)
- Description (textarea)
- Switch: is_active
- **Опционально** Primary Build:
  - Title, Role, Notes
  - Tier Override (select)
  - Attachments (динамическая таблица):
    - Slot (input или select)
    - Name (input)
    - Stat Mods (key-value pairs, например JSON editor или простые инпуты)

**Стиль:** Следовать `Admin/Guides/Create.vue` (терминальный стиль, оранжевые акценты).

### 10.4. Admin/Weapons/Edit.vue ⏳
- Те же поля что и в Create
- **Список билдов:**
  - Для каждого билда: collapsible panel (аккордеон)
  - Inline формы редактирования
  - CRUD билдов (кнопки добавить/удалить)
  - CRUD attachments внутри билда
- Кнопка "Добавить новый билд"

### 10.5. Визуальные бейджи Tier
Компонент `TierBadge.vue`:
```vue
<template>
  <span :class="tierClasses" class="px-3 py-1 text-xs font-black font-mono uppercase border-2">
    {{ label }}
  </span>
</template>

<script setup>
const props = defineProps({
  tier: String,
  label: String
});

const tierClasses = computed(() => {
  switch (props.tier) {
    case 'imba_patch':
      return 'bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 text-black border-orange-400';
    case 'meta':
      return 'bg-gradient-to-r from-emerald-500 to-green-600 text-black border-emerald-400';
    case 'normal':
      return 'bg-gradient-to-r from-sky-500 to-blue-600 text-white border-sky-400';
    case 'avoid':
      return 'bg-gradient-to-r from-gray-500 to-gray-700 text-white border-gray-400';
    default:
      return 'bg-gray-800 text-gray-400 border-gray-600';
  }
});
</script>
```

### 10.6. Публичная страница MetaIndex.vue ⏳
Секции:
1. **Hero** (терминальный стиль) — заголовок "WARZONE META HUB".
2. **Панель фильтров** (sticky при скролле):
   - Поиск (input с иконкой, debounce 300мс).
   - Tier (кнопки-тоггл с цветами).
   - Origin (три кнопки MW2022/MW2023/BO6).
   - Categories (грид чекбоксов или кнопок).
   - Сортировка (select): `tier, popularity, name, updated`.
3. **Сетка карточек оружия** (4 колонки на desktop, 2 на tablet, 1 на mobile):
   - Image, Name, Tier badge, Origin icon, Category label, Кол-во билдов.
   - Клик → подробный просмотр (`/warzone/meta/weapons/{slug}`).
4. **Пагинация** (Inertia Links).

**Стиль:** Тёмный фон, оранжевые акценты, терминальная сетка, font-mono для заголовков.

### 10.7. Публичная страница MetaShow.vue ⏳
Отображает:
- **Header секция:**
  - Крупное изображение оружия (слева)
  - Справа: Name, Tier badge (крупный), Origin, Category
  - Description
- **Список билдов** (аккордеоны/tabs):
  - Title + Role + (Tier override если есть)
  - **Attachments Table:**
    - Колонки: Slot | Name | Stat Mods
    - Терминальный стиль таблицы
  - Notes (под таблицей, может быть Markdown render)

### 10.8. UX деталь
- Сохранять состояние фильтров в query-параметрах (Inertia preserveState).
- При переходе назад — фильтры восстанавлиются.

## 11. API ПРИМЕРЫ
### 11.1. Создание оружия (POST /admin/warzone/weapons)
```json
{
  "name": "MCW",
  "tier": "imba_patch",
  "origin_game": "mw2023",
  "category": "ar",
  "categories": ["ar"],
  "description": "Топовая штурмовка для дальних дистанций.",
  "is_active": true,
  "sort_order": 10,
  "builds": [
    {
      "title": "Long Range Beam",
      "role": "range",
      "tier_override": null,
      "notes": "Фокус на стабильность и контроль отдачи.",
      "attachments": [
        {"slot": "muzzle", "name": "VT-7 Spitfire Suppressor", "stat_mods": {"recoil":"-7%"}},
        {"slot": "barrel", "name": "XRK Horizon Barrel"},
        {"slot": "optic", "name": "Corio Eagleseye 2.5x"},
        {"slot": "underbarrel", "name": "Bore-490 Handstop"},
        {"slot": "magazine", "name": "40 Round Mag"}
      ]
    }
  ]
}
```

### 11.2. Поиск публичный (GET /api/warzone/meta/weapons)
Пример: `/api/warzone/meta/weapons?q=mcw&tier=imba_patch&origin=mw2023&category=ar&sort=tier&page=1`
Ответ:
```json
{
  "data": [
    {
      "id": 1,
      "name": "MCW",
      "slug": "mcw",
      "tier": "imba_patch",
      "origin_game": "mw2023",
      "category": "ar",
      "image": "/storage/warzone/weapons/mcw.png",
      "builds_count": 2
    }
  ],
  "meta": {"current_page":1, "last_page":3, ...},
  "filters_applied": {...}
}
```

## 12. СОРТИРОВКА
- `tier`: ORDER BY tier_weight ASC (маппинг через CASE) ✅ реализовано в контроллере
- `popularity`: ORDER BY popularity DESC
- `updated`: ORDER BY updated_at DESC
- `name`: ORDER BY name ASC

## 13. БЕЗОПАСНОСТЬ ✅ ВЫПОЛНЕНО
- ✅ Проверка `is_admin` через middleware
- ✅ Валидация входных данных
- ✅ Ограничение загрузки файлов (размер <= 2MB, только изображения)

## 14. ОПТИМИЗАЦИЯ
- ✅ Индексы в БД созданы
- ✅ Eager load builds/attachments точечно (show, edit) реализовано
- Кэш списков фильтров (справочники enums можно хардкодить на фронте) - по желанию

## 15. ТЕСТЫ (минимум) ⏳ TODO
Создать Feature-тесты:
1. Admin может создать оружие с билдом и attachments.
2. Публичный поиск фильтрует по tier + origin.
3. Slug генерируется и уникален.
4. Tier сортировка возвращает imba_patch первым.
5. Обновление оружия меняет tier и сохраняет.

## 16. ПОТОК РАБОТЫ (ШАГИ ИМПЛЕМЕНТАЦИИ)
1. ✅ Создать миграции (3 таблицы).
2. ✅ Создать модели + связи + касты.
3. ✅ Создать контроллеры (Admin + Public).
4. ✅ Middleware is_admin (уже существует).
5. ✅ Добавить маршруты.
6. ✅ Добавить ссылки в Header.
7. ⏳ Создать Vue страницы Admin (Index/Create/Edit).
8. ⏳ Создать публичные страницы (MetaIndex/MetaShow + компоненты фильтров, карточки оружия, бейдж tier).
9. ⏳ Реализовать API поиска (уже реализован на бэкенде, нужен только фронтенд).
10. ✅ Добавить загрузку изображений (disk public) — папка `warzone/weapons`.
11. ⏳ Написать тесты.
12. ⏳ Прогнать phpunit.
13. ⏳ Проверить кэш/очистку.

## 17. СОГЛАСОВАННЫЙ СТИЛЬ UI
- Использовать терминальные элементы (анимации, цветовые градиенты, moноширинный шрифт) как в `Header.vue` и админ-страницах гайдов.
- Цвет tier бейджей: градиент + border + uppercase + font-mono.
- Карточки оружия: border-orange-500/30 hover:border-orange-400/60 bg-black/60 backdrop-blur-sm.

## 18. РАСШИРЕНИЯ (ПОТОМ)
- Отдельная таблица для статистики (K/D, winrate).
- Голосование пользователей за актуальность билда.
- История изменений tier (audit table).
- Импорт/экспорт JSON.
- Сравнение билдов side-by-side.

## 19. EDGE CASES
| Ситуация | Решение |
|----------|---------|
| Оружие без билдов | Отображать сообщение "Нет активных билдов" |
| Attachment дублирует слот | Разрешаем несколько attachments на один слот (нет unique constraint) |
| Поиск пустой | Возвращать пагинацию с `data: []` |
| Tier Override в билде | Если задан — отображать бейдж билда, иначе оружия |
| Отключено is_active | Исключить из публичного поиска (scope active) ✅ реализовано |

## 20. ПРИМЕР СТРУКТУРЫ ПАПОК (Front)
```
resources/js/Pages/Warzone/
  MetaIndex.vue ⏳
  MetaShow.vue ⏳
resources/js/Pages/Admin/Warzone/Weapons/
  Index.vue ⏳
  Create.vue ⏳
  Edit.vue ⏳
resources/js/Components/Warzone/
  TierBadge.vue ⏳
  WeaponCard.vue ⏳
  FiltersPanel.vue ⏳
  BuildBlock.vue ⏳
  AttachmentsTable.vue ⏳
```

## 21. ПРИМЕР ПОЛЕЙ ДЛЯ ТЕСТОВОГО ОРУЖИЯ
```
Name: MCW
Tier: imba_patch
Origin: mw2023
Category: ar
Image: mcw.png
Description: "Стабильная и универсальная штурмовая винтовка."
Build: "Long Range Beam" + 5 attachments
```

## 22. КРАТКИЙ ЧЕКЛИСТ ДЛЯ АГЕНТА
- [x] Миграции созданы
- [x] Модели и связи
- [x] Контроллеры Admin + Public
- [x] Маршруты прописаны
- [x] Middleware is_admin
- [ ] Фронтенд админ: Index/Create/Edit ⏳
- [ ] Public MetaIndex/MetaShow ⏳
- [ ] Поиск + фильтры + сортировка (фронтенд) ⏳
- [x] Добавлен пункт меню в Header
- [ ] Тесты покрывают CRUD и поиск ⏳
- [x] Изображения загружаются
- [ ] Tier бейдж оформлен ⏳
- [ ] Пагинация работает ⏳

## 23. ИТОГОВОЕ ТРЕБОВАНИЕ
Реализовать в точности по описанию. Код чистый, минимальные дубли, следовать уже принятому стилю (смотреть существующие контроллеры `Admin/GuideController` и компонент `Header.vue`).

## 24. ТЕКУЩИЕ ФАЙЛЫ В ПРОЕКТЕ (Созданы)
### Backend ✅
- `database/migrations/2025_10_11_100000_create_warzone_weapons_table.php`
- `database/migrations/2025_10_11_100100_create_warzone_weapon_builds_table.php`
- `database/migrations/2025_10_11_100200_create_warzone_weapon_build_attachments_table.php`
- `app/Models/WarzoneWeapon.php`
- `app/Models/WarzoneWeaponBuild.php`
- `app/Models/WarzoneWeaponBuildAttachment.php`
- `app/Http/Controllers/Admin/WarzoneWeaponController.php`
- `app/Http/Controllers/Admin/WarzoneWeaponBuildController.php`
- `app/Http/Controllers/Admin/WarzoneWeaponAttachmentController.php`
- `app/Http/Controllers/WarzoneMetaController.php`

### Frontend ✅
- `resources/js/Components/Header.vue` (обновлён с ссылками)

### Routes ✅
- `routes/web.php` (добавлены маршруты Warzone Meta Hub)

---
**Этот файл предназначен для передачи ИИ: он должен, не задавая лишних вопросов, выполнить все описанные шаги.**

**СЛЕДУЮЩИЙ ШАГ:** Создание Vue компонентов для админ-панели (Index → Create → Edit), затем публичных страниц.
