# Система гайдов для Zombie карт

## Как работает система

### 1. Создание гайда (Админ панель)

При создании гайда в админ-панели нужно указать:
- **Game** - Выбрать игру из выпадающего списка (например: "World at War", "Black Ops")
- **Map Name** - Выбрать карту из выпадающего списка (список карт меняется в зависимости от выбранной игры)
- **Title** - Заголовок гайда
- **Description** - Краткое описание
- **Content** - Основной контент гайда (с WYSIWYG редактором)
- **Image** - Изображение для гайда
- **Is Published** - Опубликован ли гайд

**Важно:** При выборе игры автоматически загружаются соответствующие карты. Вам не нужно вводить названия вручную - просто выбирайте из списка!

### 2. Привязка гайдов к картам

Гайды автоматически привязываются к картам на основе двух полей:
- `game` - название игры (например: "World at War", "Black Ops")
- `map_slug` - URL-friendly slug карты (например: "kino-der-toten", "moon")

### 3. Навигация пользователя

1. **Страница выбора игры**: `/zombies`
2. **Страница карт игры**: 
   - World at War: `/zombies/world-at-war`
   - Black Ops: `/zombies/black-ops`
3. **Список гайдов карты**: `/zombies/{Game}/{map-slug}/guides`
   - Пример для WaW: `/zombies/World at War/nacht-der-untoten/guides`
   - Пример для BO: `/zombies/Black Ops/kino-der-toten/guides`
4. **Конкретный гайд**: `/zombies/{Game}/{map-slug}/guides/{id}`
   - Пример: `/zombies/Black Ops/moon/guides/1`

### 4. Map Slugs для World at War

- `nacht-дер-унтотен` - Nacht der Untoten
- `веррюккт` - Verrückt (без 'e', так генерируется из символа 'ü')
- `ши-но-нума` - Shi No Numa
- `дер-риесе` - Der Riese

### 5. Map Slugs для Black Ops

- `kino-дер-тoten` - Kino der Toten
- `five` - "Five"
- `ascension` - Ascension
- `call-of-the-dead` - Call of the Dead
- `shangri-la` - Shangri-La
- `moon` - Moon

### 6. Важно при создании гайдов

При создании гайда:
1. **Выберите игру** из выпадающего списка
2. **Список карт обновится автоматически** - выберите нужную карту
3. Map slug устанавливается автоматически при выборе карты
4. Заполните остальные поля и сохраните

**Больше не нужно вручную вводить названия карт или создавать слаги!**

## Примеры создания гайдов

### Пример 1: Гайд для Nacht der Untoten
```
1. Game: World at War (выбрать из списка)
2. Map Name: Nacht der Untoten (выбрать из списка)
3. Title: Пасхалки Nacht der Untoten
4. Description: Все секреты и пасхалки карты
5. Content: [Ваш контент в WYSIWYG редакторе]
6. Image: [Загрузить изображение]
7. Is Published: ✓
```

### Пример 2: Гайд для Kino der Toten
```
1. Game: Black Ops (выбрать из списка)
2. Map Name: Kino der Toten (выбрать из списка)
3. Title: Полное прохождение Kino der Toten
4. Description: Все стратегии и секреты
5. Content: [Ваш контент в WYSIWYG редакторе]
6. Image: [Загрузить изображение]
7. Is Published: ✓
```

### Пример 3: Гайд для Moon
```
1. Game: Black Ops (выбрать из списка)
2. Map Name: Moon (выбрать из списка)
3. Title: Пасхалка Moon - Большой Взрыв
4. Description: Пошаговое прохождение главного квеста
5. Content: [Ваш контент в WYSIWYG редакторе]
6. Image: [Загрузить изображение]
7. Is Published: ✓
```

## Файловая структура

```
app/
  Http/Controllers/
    ZombieGuideController.php - Контроллер для отображения гайдов
    Admin/
      GuideController.php - Контроллер админки

routes/
  web.php - Маршруты приложения

resources/js/Pages/
  WorldAtWarZombies.vue - Страница выбора карт World at War
  BlackOpsZombies.vue - Страница выбора карт Black Ops
  ZombieGuides/
    MapGuides.vue - Список гайдов для конкретной карты
    ShowGuide.vue - Страница просмотра гайда
  Admin/Guides/
    Create.vue - Форма создания гайда (с выпадающими списками)
    Edit.vue - Форма редактирования (с выпадающими списками)
    Index.vue - Список всех гайдов
```

## Преимущества новой системы

✅ **Выбор из списка** - не нужно вручную вводить названия карт  
✅ **Автоматическая валидация** - невозможно ввести неправильное название  
✅ **Динамические списки** - список карт меняется в зависимости от игры  
✅ **Консистентность** - все слаги гарантированно правильные  
✅ **Удобство** - быстрое создание и редактирование гайдов  

## Расширение системы

Чтобы добавить поддержку других игр (Black Ops 2, Black Ops 3 и т.д.):

1. Создайте страницу выбора карт (по аналогии с WorldAtWarZombies.vue или BlackOpsZombies.vue)
2. Добавьте маршрут в routes/web.php
3. Добавьте карты в массив `gameMaps` в файлах Create.vue и Edit.vue
4. В контроллере ZombieGuideController добавьте информацию о картах новой игры в метод `getMapInfo()`
5. Обновите метод `backToMaps()` в MapGuides.vue

### Доступные игры на данный момент

- **World at War** (2008) - 4 карты
  - Страница: `/zombies/world-at-war`
  - Карты добавлены в выпадающий список ✅
  
- **Black Ops** (2010) - 6 карт
  - Страница: `/zombies/black-ops`
  - Карты добавлены в выпадающий список ✅

### Как добавить карты для новой игры

В файлах `Create.vue` и `Edit.vue` найдите объект `gameMaps` и добавьте карты для вашей игры:

```javascript
const gameMaps = {
  'World at War': [...],
  'Black Ops': [...],
  'Black Ops 2': [
    { slug: 'tranzit', name: 'TranZit' },
    { slug: 'nuketown-zombies', name: 'Nuketown Zombies' },
    // ... остальные карты
  ],
  // ... другие игры
};
```
