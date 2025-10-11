# Wiki System - Полная документация

## ✅ Все ошибки исправлены!

### Исправленные файлы:
1. ✅ **WikiPage.php** - восстановлена модель
2. ✅ **WikiWeaponController.php** - восстановлен контроллер
3. ✅ **WikiZombieMapController.php** - добавлена закрывающая скобка
4. ✅ **WikiZombieMap.php** - без ошибок

---

## 📊 Созданная структура БД

### Таблицы (все успешно созданы):
- ✅ `wiki_pages` - основные страницы игр
- ✅ `wiki_weapons` - оружие с изображениями
- ✅ `wiki_maps` - мультиплеерные карты  
- ✅ `wiki_zombie_maps` - зомби-карты с галереей

---

## 🎮 Как использовать систему

### 1. Админ-панель (требует авторизации админа)

#### Управление оружием:
```
GET  /admin/wiki/weapons          - список оружия
GET  /admin/wiki/weapons/create   - форма создания
POST /admin/wiki/weapons          - сохранение
GET  /admin/wiki/weapons/{id}/edit - редактирование
PUT  /admin/wiki/weapons/{id}     - обновление
DEL  /admin/wiki/weapons/{id}     - удаление
```

**Поля для оружия:**
- `game` (обязательно) - код игры (world-at-war, black-ops и т.д.)
- `name` (обязательно) - название оружия
- `category` (обязательно) - категория (assault_rifle, sniper и т.д.)
- `description` - описание
- `image` - основное изображение (макс 2МБ)
- `icon` - иконка (макс 1МБ)
- `stats` - JSON статистика (урон, скорострельность)
- `attachments` - JSON модификации
- `availability` - JSON где доступно (мультиплеер, зомби)
- `sort_order` - порядок сортировки
- `is_active` - активно/неактивно

**Доступные категории оружия:**
- `assault_rifle` - Штурмовые винтовки
- `rifle` - Винтовки
- `lmg` - Пулемёты
- `sniper` - Снайперские
- `shotgun` - Дробовики
- `pistol` - Пистолеты
- `launcher` - Гранатомёты
- `melee` - Холодное оружие

#### Управление картами:
```
GET  /admin/wiki/maps          - список карт
GET  /admin/wiki/maps/create   - форма создания
POST /admin/wiki/maps          - сохранение
GET  /admin/wiki/maps/{id}/edit - редактирование
PUT  /admin/wiki/maps/{id}     - обновление
DEL  /admin/wiki/maps/{id}     - удаление
```

**Поля для карт:**
- `game` (обязательно)
- `name` (обязательно)
- `type` - тип (multiplayer, zombie, campaign)
- `description`
- `image` - скриншот карты (макс 3МБ)
- `minimap` - мини-карта (макс 2МБ)
- `game_modes` - JSON режимы игры
- `location` - локация в мире
- `tips` - советы
- `meta_data` - JSON дополнительная информация

#### Управление зомби-картами:
```
GET  /admin/wiki/zombie-maps          - список
GET  /admin/wiki/zombie-maps/create   - создание
POST /admin/wiki/zombie-maps          - сохранение
GET  /admin/wiki/zombie-maps/{id}/edit - редактирование
PUT  /admin/wiki/zombie-maps/{id}     - обновление
DEL  /admin/wiki/zombie-maps/{id}     - удаление
```

**Поля для зомби-карт:**
- `game` (обязательно)
- `name` (обязательно)
- `description`
- `story` - сюжет карты
- `background_image` - фоновое изображение (макс 3МБ)
- `thumbnail` - миниатюра (макс 2МБ)
- `images` - массив дополнительных изображений (макс 3МБ каждое)
- `release_date` - дата выхода
- `dlc_pack` - название DLC или "Base Game"
- `features` - JSON особенности (Pack-a-Punch, телепорты)
- `easter_eggs` - JSON пасхалки
- `perks` - JSON доступные перки
- `weapons` - JSON доступное оружие
- `characters` - JSON персонажи
- `tips` - советы по прохождению
- `sort_order`
- `is_published` - опубликовано/черновик

---

### 2. API для фронтенда (публичный доступ)

#### Получить оружие для игры:
```
GET /api/wiki/{game}/weapons

Пример: /api/wiki/world-at-war/weapons
Ответ: { "assault_rifle": [...], "sniper": [...] }
```

#### Получить карты для игры:
```
GET /api/wiki/{game}/maps

Пример: /api/wiki/world-at-war/maps
Ответ: [{ id, name, description, image_url, ... }]
```

#### Получить зомби-карты для игры:
```
GET /api/wiki/{game}/zombie-maps

Пример: /api/wiki/world-at-war/zombie-maps
Ответ: [{ id, name, description, thumbnail_url, ... }]
```

#### Получить одну зомби-карту:
```
GET /api/wiki/{game}/zombie-maps/{slug}

Пример: /api/wiki/world-at-war/zombie-maps/nacht-der-untoten
Ответ: { id, name, story, background_image_url, images_urls, ... }
```

---

## 💻 Использование в коде Vue

### Пример загрузки оружия на странице:
```vue
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const weapons = ref({});

onMounted(async () => {
  try {
    const response = await axios.get('/api/wiki/world-at-war/weapons');
    weapons.value = response.data;
  } catch (error) {
    console.error('Ошибка загрузки оружия:', error);
  }
});
</script>

<template>
  <div v-for="(weaponList, category) in weapons" :key="category">
    <h3>{{ category }}</h3>
    <div v-for="weapon in weaponList" :key="weapon.id">
      <img :src="weapon.icon_url" :alt="weapon.name">
      <h4>{{ weapon.name }}</h4>
      <p>{{ weapon.description }}</p>
    </div>
  </div>
</template>
```

### Пример загрузки зомби-карт:
```vue
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const zombieMaps = ref([]);

onMounted(async () => {
  const response = await axios.get('/api/wiki/world-at-war/zombie-maps');
  zombieMaps.value = response.data;
});
</script>

<template>
  <div v-for="map in zombieMaps" :key="map.id">
    <img :src="map.thumbnail_url" :alt="map.name">
    <h3>{{ map.name }}</h3>
    <p>{{ map.description }}</p>
  </div>
</template>
```

---

## 🔧 Модели и их методы

### WikiWeapon
```php
// Scopes
WikiWeapon::forGame('world-at-war')->get();
WikiWeapon::byCategory('assault_rifle')->get();
WikiWeapon::active()->ordered()->get();

// Accessors
$weapon->image_url      // Полный URL изображения
$weapon->icon_url       // Полный URL иконки
```

### WikiMap
```php
// Scopes
WikiMap::forGame('world-at-war')->get();
WikiMap::byType('multiplayer')->get();
WikiMap::active()->ordered()->get();

// Accessors
$map->image_url    // URL скриншота
$map->minimap_url  // URL мини-карты
```

### WikiZombieMap
```php
// Scopes
WikiZombieMap::forGame('world-at-war')->get();
WikiZombieMap::published()->ordered()->get();

// Accessors
$map->background_image_url  // URL фона
$map->thumbnail_url         // URL миниатюры
$map->image_urls           // Массив URL всех изображений
```

---

## 🎨 Примеры JSON полей

### stats (для оружия):
```json
{
  "damage": 45,
  "fire_rate": 750,
  "accuracy": 75,
  "range": 60,
  "magazine": 30
}
```

### features (для зомби-карт):
```json
[
  "Pack-a-Punch",
  "Телепорты",
  "Mystery Box",
  "Электричество"
]
```

### easter_eggs (для зомби-карт):
```json
[
  {
    "name": "Главное пасхальное яйцо",
    "description": "Активация всех генераторов",
    "reward": "Достижение"
  }
]
```

---

## 📁 Структура хранения файлов

Все файлы сохраняются в `storage/app/public/`:

```
storage/app/public/
├── wiki/
│   ├── weapons/
│   │   ├── images/      # Изображения оружия
│   │   └── icons/       # Иконки оружия
│   ├── maps/
│   │   ├── images/      # Скриншоты карт
│   │   └── minimaps/    # Мини-карты
│   └── zombie-maps/
│       ├── backgrounds/ # Фоновые изображения
│       ├── thumbnails/  # Миниатюры
│       └── gallery/     # Дополнительные изображения
```

**Не забудьте создать симлинк:**
```bash
docker exec laravel_app php artisan storage:link
```

---

## 🚀 Быстрый старт

### 1. Запустите миграции (уже выполнено ✓)
```bash
docker exec laravel_app php artisan migrate
```

### 2. Создайте симлинк для storage
```bash
docker exec laravel_app php artisan storage:link
```

### 3. Зайдите в админку
```
/admin/wiki/weapons
/admin/wiki/maps
/admin/wiki/zombie-maps
```

### 4. Добавьте контент
- Загрузите изображения
- Заполните описания
- Укажите игру (world-at-war, black-ops и т.д.)

### 5. Используйте API на фронтенде
```javascript
const weapons = await axios.get('/api/wiki/world-at-war/weapons');
const maps = await axios.get('/api/wiki/world-at-war/zombie-maps');
```

---

## ✨ Особенности системы

✅ **Универсальность** - работает для всех игр COD
✅ **Масштабируемость** - легко добавлять новые поля
✅ **Безопасность** - валидация и защита от SQL-инъекций
✅ **Удобство** - простой API и админ-интерфейс
✅ **Гибкость** - JSON поля для любых данных
✅ **Производительность** - индексы в БД, пагинация

---

## 🎯 Следующие шаги

1. **Создайте Vue компоненты** для админки
2. **Обновите WorldAtWarWiki.vue** для использования API
3. **Добавьте загрузку данных** через axios
4. **Создайте формы** для добавления контента
5. **Добавьте фильтры и поиск** в админке

---

## 📝 Коды игр

Используйте эти коды для поля `game`:

- `world-at-war` - Call of Duty: World at War
- `black-ops` - Call of Duty: Black Ops
- `black-ops-2` - Call of Duty: Black Ops II
- `black-ops-3` - Call of Duty: Black Ops 3
- `black-ops-4` - Call of Duty: Black Ops 4
- `cold-war` - Call of Duty: Black Ops Cold War
- `black-ops-6` - Call of Duty: Black Ops 6
- `modern-warfare` - Call of Duty 4: Modern Warfare
- `modern-warfare-2` - Call of Duty: Modern Warfare 2
- `modern-warfare-3` - Call of Duty: Modern Warfare 3

---

Система готова к использованию! 🎮

