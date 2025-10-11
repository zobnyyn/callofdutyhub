# Промт для создания Wiki-страниц Call of Duty

## Контекст проекта
Это Laravel + Inertia.js (Vue 3) проект Call of Duty Wiki с терминальным дизайном. Проект работает в Docker.

**⚠️ ВАЖНО: Файлы создавай через IDE, а не через терминал!**

**Текущая дата:** 10 января 2025

## Уже выполненная работа

### ✅ Созданные страницы Modern Warfare:
1. **ModernWarfare2007Wiki.vue** (COD 4: Modern Warfare)
   - Путь: `/resources/js/Pages/ModernWarfare2007Wiki.vue`
   - Маршрут: `/wiki/cod4-modern-warfare`
   - Цвет темы: зеленый (#10b981)
   - Фон: `/images/callofduty2007background.jpg`
   - Полностью детализированная страница с:
     - Обзор игры
     - Кампания (SAS и USMC миссии)
     - Мультиплеер (перки, killstreaks, режимы)
     - Оружие (все категории)
     - Карты (базовые + DLC)
     - DLC информация

2. **ModernWarfare2009Wiki.vue** (Modern Warfare 2)
   - Путь: `/resources/js/Pages/ModernWarfare2009Wiki.vue`
   - Маршрут: `/wiki/modern-warfare-2`
   - Цвет темы: зеленый (#10b981)
   - Фон: `/images/callofduty2009background.jpg`
   - Полностью детализированная страница с:
     - Обзор с рекордами продаж
     - Кампания с ключевыми персонажами
     - Special Ops (кооперативный режим)
     - Мультиплеер (расширенные killstreaks, включая Tactical Nuke)
     - Популярное оружие
     - Все базовые карты
     - DLC паки

3. **ModernWarfare2011Wiki.vue** (Modern Warfare 3)
   - Путь: `/resources/js/Pages/ModernWarfare2011Wiki.vue`
   - Маршрут: `/wiki/modern-warfare-3`
   - Цвет темы: зеленый (#10b981)
   - Фон: `/images/callofduty2011background.jpeg`
   - Полностью детализированная страница

4. **ModernWarfare2019Wiki.vue** (Modern Warfare 2019)
   - Путь: `/resources/js/Pages/ModernWarfare2019Wiki.vue`
   - Маршрут: `/wiki/modern-warfare-2019`
   - Цвет темы: зеленый (#10b981)
   - Фон: `/images/callofduty2019background.jpg`
   - Полностью детализированная страница с:
     - Обзор игры, технологии IW 8.0
     - Кампания с Task Force 141
     - Мультиплеер (Gunsmith, режимы, Gunfight 2v2)
     - Оружие (популярные пушки)
     - Карты (6v6, Ground War, Gunfight)
     - Warzone интеграция
     - Сезонная система

5. **ModernWarfare2022Wiki.vue** (Modern Warfare II 2022)
   - Путь: `/resources/js/Pages/ModernWarfare2022Wiki.vue`
   - Маршрут: `/wiki/modern-warfare-2022`
   - Цвет темы: зеленый (#10b981)
   - Фон: `/images/callofduty2022background.webp`
   - Полностью детализированная страница с:
     - Обзор (IW 9.0, $1+ млрд выручки)
     - Кампания (Task Force 141 vs картель)
     - Мультиплеер (Gunsmith 2.0, семейства оружия, Perk Packages)
     - Оружие (M4, TAQ-56, Lachmann Sub и др.)
     - Карты (базовые + Battle Maps)
     - Warzone 2.0 (Al Mazrah, круговая зона, Gulag 2.0)
     - DMZ режим (extraction, фракции)
     - **Сезоны (6 сезонов с датами и контентом)**

6. **ModernWarfare2023Wiki.vue** (Modern Warfare III 2023)
   - Путь: `/resources/js/Pages/ModernWarfare2023Wiki.vue`
   - Маршрут: `/wiki/modern-warfare-2023`
   - Цвет темы: зеленый (#10b981)
   - Фон: `/images/callofduty2023background.jpg`
   - Полностью детализированная страница с:
     - Обзор (завершение трилогии, Макаров)
     - Кампания (Open Combat Missions)
     - Мультиплеер (все 16 карт из MW2 2009, Tac-Stance, Aftermarket Parts)
     - Оружие (возвращение классики: ACR, Intervention, Barrett)
     - Карты (все классические: Afghan, Terminal, Rust, Highrise и др.)
     - Zombies (Open World на Urzikstan)
     - Сезоны

### ✅ Настроенные маршруты:
```php
// В routes/web.php добавлено:
Route::get('/wiki/cod4-modern-warfare', function () {
    return Inertia::render('ModernWarfare2007Wiki');
})->name('wiki.cod4');

Route::get('/wiki/modern-warfare-2', function () {
    return Inertia::render('ModernWarfare2009Wiki');
})->name('wiki.mw2');

Route::get('/wiki/modern-warfare-3', function () {
    return Inertia::render('ModernWarfare2011Wiki');
})->name('wiki.mw3');

Route::get('/wiki/modern-warfare-2019', function () {
    return Inertia::render('ModernWarfare2019Wiki');
})->name('wiki.mw2019');

Route::get('/wiki/modern-warfare-2022', function () {
    return Inertia::render('ModernWarfare2022Wiki');
})->name('wiki.mw2022');

Route::get('/wiki/modern-warfare-2023', function () {
    return Inertia::render('ModernWarfare2023Wiki');
})->name('wiki.mw2023');
```

### ✅ Интеграция в CodWiki.vue:
Все кнопки Modern Warfare с обработчиками `@click="$inertia.visit('/wiki/...')"` для перехода на страницы добавлены.

## Эталонный шаблон
Используй **WorldAtWarWiki.vue** или **ModernWarfare2022Wiki.vue** как эталонные шаблоны для создания новых Wiki-страниц:
- Путь: `/resources/js/Pages/WorldAtWarWiki.vue` или `/resources/js/Pages/ModernWarfare2022Wiki.vue`
- Все секции являются **статическими** (не используют данные из БД)
- Структура с боковым меню навигации
- Плавная прокрутка между секциями
- Активное выделение текущей секции при скролле
- Компонент Footer (импортируется из `@/Components/Footer.vue`)

## Структура Wiki-страницы

### Обязательные секции:
1. **ОБЗОР** - описание игры, основная информация, награды, технологии
2. **КАМПАНИЯ** - сюжет, миссии, персонажи
3. **МУЛЬТИПЛЕЕР** - режимы игры, особенности, система прогрессии
4. **ОРУЖИЕ** - все категории оружия с описаниями (статически)
5. **КАРТЫ** - базовые и DLC карты (статически)
6. **СЕЗОНЫ** - информация о сезонах с датами и контентом (для игр с live-service)

### Дополнительные секции (если применимо):
- **SPECIAL OPS** / **СПЕЦОПЕРАЦИИ** - для MW2, MW3
- **NAZI ZOMBIES** / **ZOMBIES** - для Treyarch игр и MWIII
- **WARZONE** / **WARZONE 2.0** - для современных MW игр (2019, 2022)
- **DMZ РЕЖИМ** - для MWII
- **DLC** - информация о дополнениях (для старых игр)

## Требования к созданию новых страниц

### 1. Цветовая схема по сериям:
- **Black Ops серия**: оранжевый/янтарный (#f97316, #f59e0b, #3b82f6)
- **Modern Warfare серия**: зеленый (#10b981)
- **World at War**: красный (#ef4444)

### 2. Структура компонента Vue:

```vue
<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div class="w-full h-full bg-cover bg-center opacity-40"
           style="background-image: url('/images/[BACKGROUND_NAME]')"></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" 
         style="background-image: repeating-linear-gradient(0deg, [COLOR] 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">
        <!-- Navigation Breadcrumbs -->
        <!-- Page Header -->
        <!-- Wiki Layout (Sidebar + Content) -->
      </div>
    </div>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const activeSection = ref('overview');

const sections = [
  { id: 'overview', title: 'ОБЗОР' },
  { id: 'campaign', title: 'КАМПАНИЯ' },
  { id: 'multiplayer', title: 'МУЛЬТИПЛЕЕР' },
  { id: 'weapons', title: 'ОРУЖИЕ' },
  { id: 'maps', title: 'КАРТЫ' },
  // ...остальные секции по необходимости
];

// Функции для скролла и навигации
const scrollToSection = (sectionId) => {
  const element = document.getElementById(sectionId);
  if (element) {
    const offset = 100;
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - offset;
    window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
    activeSection.value = sectionId;
  }
};

const handleScroll = () => {
  const scrollPosition = window.scrollY + 150;
  for (const section of sections) {
    const element = document.getElementById(section.id);
    if (element) {
      const offsetTop = element.offsetTop;
      const offsetHeight = element.offsetHeight;
      if (scrollPosition >= offsetTop && scrollPosition < offsetTop + offsetHeight) {
        activeSection.value = section.id;
        break;
      }
    }
  }
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 10px rgba([R], [G], [B], 0.5),
               0 0 20px rgba([R], [G], [B], 0.3),
               0 0 30px rgba([R], [G], [B], 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
```

### 3. Фоновые изображения:
Фоны лежат в `public/images/` и называются следующим образом:

#### Modern Warfare серия:
- `callofduty2007background.jpg` - COD 4: Modern Warfare (2007)
- `callofduty2009background.jpg` - Modern Warfare 2 (2009)
- `callofduty2011background.jpeg` - Modern Warfare 3 (2011)
- `callofduty2019background.jpg` - Modern Warfare (2019)
- `callofduty2022background.webp` - Modern Warfare II (2022)
- `callofduty2023background.jpg` - Modern Warfare III (2023)

#### Black Ops серия:
- `worldatwar.jpg` - World at War (2008)
- `blackopsbackground.jpg` - Black Ops (2010)
- `blackops2background.jpg` - Black Ops 2 (2012)
- `blackops3background.jpg` - Black Ops 3 (2015)
- `blackops4background.jpg` - Black Ops 4 (2018)
- `blackopscoldwarbackground.jpg` - Black Ops Cold War (2020)
- `blackops6background.jpg` - Black Ops 6 (2024)
- `blackops7background.jpg` - Black Ops 7 (2025)

**Примечание:** Все изображения находятся в `public/images/`, в коде используются как `/images/[filename]`

### 4. Маршруты Laravel:
Добавляй маршруты в `routes/web.php` **ПЕРЕД** динамическим маршрутом `Route::get('/wiki/{game}', ...)`:

```php
// Пример для новой игры Black Ops:
Route::get('/wiki/black-ops', function () {
    return Inertia::render('BlackOpsWiki');
})->name('wiki.blackops');
```

### 5. Интеграция в CodWiki.vue:
Добавь обработчик клика на карточку игры:

```vue
<div @click="$inertia.visit('/wiki/black-ops')" class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
  <!-- Содержимое карточки -->
</div>
```

## Рекомендации по контенту

### Для сезонных игр (2019+):
- Включай детальную информацию о сезонах с точными датами
- Описывай Battle Pass систему
- Упоминай кросс-игровую прогрессию
- Добавляй информацию о Warzone интеграции

### Для классических игр (до 2019):
- Фокус на DLC паках
- Детальное описание кампании и мультиплеера
- Полный список карт и оружия
- Культовые моменты и особенности

### Для Zombies режимов:
- Список всех карт
- Описание механик (Pack-a-Punch, перки, Easter Eggs)
- Wonder Weapons
- Сюжетные линии (Aether, Dark Aether, Chaos)

## Примеры успешно созданных страниц:
- ✅ WorldAtWarWiki.vue - эталон для структуры
- ✅ ModernWarfare2019Wiki.vue - эталон для современных игр
- ✅ ModernWarfare2022Wiki.vue - эталон с детальными сезонами
- ✅ ModernWarfare2023Wiki.vue - эталон с Zombies режимом

## Статус проекта (по состоянию на 10.01.2025):
- **Полностью готово:** 6 страниц Modern Warfare (2007-2023)
- **В разработке:** Страницы Black Ops серии
- **Планируется:** Детальные страницы для Zombies карт

## Технические требования:
- Все данные статические (хардкод в Vue компонентах)
- Responsive дизайн (mobile-first)
- Терминальный стиль с эффектами свечения
- Плавная навигация и скролл
- Breadcrumbs для навигации назад
- Sidebar меню с активным состоянием
