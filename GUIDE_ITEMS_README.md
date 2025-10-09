# Система рекомендуемых предметов для гайдов

## Описание

Теперь при создании гайдов администраторы могут выбирать рекомендуемые предметы (оружие, перки, жвачки), которые будут красиво отображаться в начале гайда.

## Что было реализовано

### ✅ Backend (PHP/Laravel)

1. **Миграция** - создана связующая таблица `game_item_zombie_guide` для связи гайдов с предметами
2. **Модель ZombieGuide** - добавлена связь many-to-many с GameItem
3. **Модель GameItem** - добавлена обратная связь с ZombieGuide
4. **Контроллер GuideController** - обновлён для сохранения и загрузки связей с предметами

### ✅ Frontend (Vue.js)

1. **GuideItemSelector.vue** - компонент для удобного выбора предметов с модальным окном
2. **Create.vue** - добавлена секция "Рекомендуемые предметы" в форму создания гайда
3. Автоматическая отправка ID выбранных предметов на сервер

## Как использовать

### Для администраторов

1. Перейдите в **Админка → Управление гайдами → CREATE_GUIDE**

2. Заполните обычные поля (игра, карта, название, описание, контент)

3. Прокрутите до секции **"РЕКОМЕНДУЕМЫЕ ПРЕДМЕТЫ"**

4. Нажмите кнопку **"ДОБАВИТЬ ОРУЖИЕ"** / **"ДОБАВИТЬ ПЕРК"** / **"ДОБАВИТЬ ЖВАЧКУ"**

5. В открывшемся модальном окне:
   - Используйте поиск для быстрого нахождения предмета
   - Нажмите на предмет для добавления
   - Предмет появится в списке выбранных

6. Удалите предмет нажав на крестик, если он больше не нужен

7. Сохраните гайд - выбранные предметы сохранятся автоматически

### Структура базы данных

```
game_item_zombie_guide
├── id
├── zombie_guide_id (FK)
├── game_item_id (FK)
├── category (weapon/perk/gum)
├── sort_order
└── timestamps
```

## API

### Получение предметов гайда

```php
$guide = ZombieGuide::with('items')->find($id);

// Все предметы
$allItems = $guide->items;

// По категориям
$weapons = $guide->getWeapons();
$perks = $guide->getPerks();
$gums = $guide->getGums();
```

### Прикрепление предметов к гайду

```php
$guide->items()->attach([
    $weaponId => ['category' => 'weapon', 'sort_order' => 0],
    $perkId => ['category' => 'perk', 'sort_order' => 1],
]);
```

### Отвязывание предметов

```php
$guide->items()->detach(); // Отвязать все
$guide->items()->detach($itemId); // Отвязать конкретный
```

## Отображение предметов в гайде (Frontend)

В следующем обновлении нужно будет добавить красивое отображение выбранных предметов в самом гайде. Предполагаемая структура:

```vue
<!-- В начале гайда -->
<div class="recommended-items">
  <!-- Оружие -->
  <div v-if="weapons.length" class="weapons-section">
    <h3>🔫 Рекомендуемое оружие</h3>
    <div class="items-grid">
      <div v-for="weapon in weapons" :key="weapon.id" class="item-card">
        <img :src="`/storage/${weapon.image}`" :alt="weapon.name">
        <h4>{{ weapon.name }}</h4>
        <p>{{ weapon.description }}</p>
      </div>
    </div>
  </div>

  <!-- Перки -->
  <div v-if="perks.length" class="perks-section">
    <h3>⚡ Рекомендуемые перки</h3>
    <!-- ... -->
  </div>

  <!-- Жвачки -->
  <div v-if="gums.length" class="gums-section">
    <h3>🍬 Рекомендуемые жвачки</h3>
    <!-- ... -->
  </div>
</div>
```

## Преимущества новой системы

✅ **Проще для авторов** - не нужно вставлять HTML-код вручную  
✅ **Единообразие** - все гайды имеют одинаковый стиль отображения предметов  
✅ **Управляемость** - предметы можно редактировать централизованно  
✅ **Гибкость** - можно легко добавлять/удалять предметы из гайда  
✅ **Поиск** - встроенный поиск для быстрого нахождения предметов  

## TODO (будущие улучшения)

- [ ] Добавить отображение предметов при просмотре гайда
- [ ] Обновить форму редактирования гайда (Edit.vue)
- [ ] Добавить drag & drop для изменения порядка предметов
- [ ] Добавить количество использований предмета в статистике
- [ ] Возможность добавления комментариев к рекомендациям
- [ ] Фильтр предметов по играм при выборе

## Технические детали

### Компонент GuideItemSelector

Принимает props:
- `label` - заголовок секции
- `buttonText` - текст на кнопке добавления
- `type` - тип предметов (weapon/perk/gum)
- `modelValue` - массив выбранных предметов (v-model)

Эмитит:
- `update:modelValue` - при изменении списка выбранных предметов

### Валидация на сервере

```php
'selected_weapons' => 'nullable|array',
'selected_weapons.*' => 'exists:game_items,id',
'selected_perks' => 'nullable|array',
'selected_perks.*' => 'exists:game_items,id',
'selected_gums' => 'nullable|array',
'selected_gums.*' => 'exists:game_items,id',
```

## Команды для проверки

```bash
# Проверить созданные связи
docker exec -i mysql_db mysql -ucallofduty -psecret callofduty -e "SELECT * FROM game_item_zombie_guide;"

# Проверить гайд с предметами
docker exec -i mysql_db mysql -ucallofduty -psecret callofduty -e "
SELECT zg.title, gi.name, gizg.category 
FROM zombie_guides zg 
JOIN game_item_zombie_guide gizg ON zg.id = gizg.zombie_guide_id 
JOIN game_items gi ON gi.id = gizg.game_item_id;
"
```

