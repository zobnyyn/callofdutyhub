# SEO Оптимизация COD Terminal

## ✅ Выполненные работы

### 1. Создан универсальный SEO-компонент
**Файл:** `/resources/js/Components/SEO.vue`

Компонент автоматически генерирует:
- Title с постфиксом "| COD Terminal"
- Meta description
- Meta keywords
- Open Graph теги для соцсетей (Facebook, VK)
- Twitter Cards
- Canonical URL
- Robots meta
- Author meta

**Использование:**
```vue
<SEO
  title="Заголовок страницы"
  description="Описание страницы"
  keywords="ключевые, слова, через, запятую"
  image="/images/og-image.jpg"
/>
```

### 2. Оптимизированные страницы

#### ✅ Главная страница (HomeBlackOpsTerminal.vue)
- **Title:** Call of Duty Terminal - Гайды, Сборки Оружия, Мета Warzone | COD Wiki
- **Description:** Лучший русскоязычный портал по Call of Duty: актуальные гайды по Warzone, Black Ops 6, MW3. Мета-сборки оружия, карты, тактики и комьюнити из 1000+ игроков.
- **Keywords:** Call of Duty, Warzone, Black Ops 6, MW3, Modern Warfare, гайды по cod, сборки оружия warzone, мета warzone, cod wiki, калл оф дюти, зомби гайды, карты cod

#### ✅ Страница сообщества (Community.vue)
- **Title:** Сообщество | COD Terminal
- **Description:** Присоединяйся к сообществу Call of Duty! Найди игроков, изучай гайды по картам зомби, читай статьи и общайся с другими фанатами COD.
- **Keywords:** Call of Duty сообщество, COD игроки, зомби гайды, статьи COD, чат игроков, Black Ops, Modern Warfare

#### ✅ О проекте (About.vue)
- **Title:** О проекте COD Terminal
- **Description:** Узнай о COD Terminal - крупнейшем русскоязычном сообществе игроков Call of Duty. Гайды, стратегии, Wiki по всем играм серии от World at War до Black Ops 6.
- **Keywords:** Call of Duty сообщество, о проекте COD Terminal, русское комьюнити COD, история проекта, команда разработчиков

#### ✅ Zombies (Zombies.vue)
- **Title:** Zombies - Гайды по всем картам Call of Duty
- **Description:** Полные гайды по зомби-картам Call of Duty: World at War, Black Ops, BO2, BO3, BO4, Cold War, BO6. Easter Eggs, стратегии выживания, секреты и тактики прохождения.
- **Keywords:** Call of Duty Zombies, гайды зомби, Easter Eggs, Black Ops зомби, Cold War зомби, карты зомби, прохождение зомби COD, стратегии выживания

### 3. Создан robots.txt
**Файл:** `/public/robots.txt`

Настроен для корректной индексации:
- Разрешена индексация всех публичных страниц
- Запрещена индексация админ-панели и API
- Указана ссылка на sitemap (требуется создать)
- Установлен Crawl-delay для уважительного краулинга

---

## 📋 Рекомендации для дальнейшей оптимизации

### 1. Динамические SEO-теги для специфичных страниц

Необходимо добавить SEO-оптимизацию для:

#### Wiki-страницы (для каждой игры)
```vue
// Пример для WorldAtWarWiki.vue
<SEO
  :title="`World at War Wiki - Оружие, карты, перки | COD Terminal`"
  :description="`Полный гайд по Call of Duty: World at War - характеристики оружия, описания карт, перки, killstreaks и игровая механика.`"
  :keywords="`World at War, WaW, Call of Duty 2008, оружие WaW, карты World at War, перки`"
/>
```

#### Страницы отдельных зомби-карт
```vue
// Динамический SEO на основе данных карты
<SEO
  :title="`${map.title} - Гайд по зомби-карте | ${map.game}`"
  :description="`Полный гайд по зомби-карте ${map.title} в ${map.game}: Easter Egg, секреты, стратегии выживания, Pack-a-Punch и все тайники.`"
  :keywords="`${map.title}, ${map.game} зомби, Easter Egg ${map.title}, гайд зомби карта`"
  :image="map.image"
/>
```

#### Страницы гайдов
```vue
<SEO
  :title="`${guide.title} | COD Terminal`"
  :description="guide.description"
  :keywords="`${guide.game}, гайд зомби, ${guide.map_name}, Easter Egg`"
  :image="guide.image"
/>
```

#### Страницы статей
```vue
<SEO
  :title="`${article.title} | COD Terminal`"
  :description="article.excerpt"
  :keywords="`${article.game}, ${article.category}, Call of Duty новости`"
  :image="article.image"
/>
```

### 2. Создание Sitemap.xml

Необходимо создать маршрут и контроллер для генерации sitemap:

**routes/web.php:**
```php
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
```

**app/Http/Controllers/SitemapController.php:**
```php
public function index()
{
    $articles = Article::all();
    $guides = ZombieGuide::all();
    $maps = ZombieMap::all();
    
    return response()->view('sitemap', [
        'articles' => $articles,
        'guides' => $guides,
        'maps' => $maps,
    ])->header('Content-Type', 'application/xml');
}
```

**resources/views/sitemap.blade.php:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    @foreach($articles as $article)
    <url>
        <loc>{{ url('/articles/'.$article->slug) }}</loc>
        <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    
    @foreach($guides as $guide)
    <url>
        <loc>{{ url("/zombies/{$guide->game}/{$guide->map_slug}/guides/{$guide->id}") }}</loc>
        <lastmod>{{ $guide->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach
</urlset>
```

### 3. Структурированные данные (Schema.org)

Добавить JSON-LD разметку для лучшего понимания контента поисковиками:

**Для статей:**
```vue
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ article.title }}",
  "description": "{{ article.excerpt }}",
  "image": "{{ article.image }}",
  "author": {
    "@type": "Person",
    "name": "{{ article.user.name }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "COD Terminal",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ url('/logo.png') }}"
    }
  },
  "datePublished": "{{ article.created_at }}",
  "dateModified": "{{ article.updated_at }}"
}
</script>
```

**Для организации:**
```vue
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "COD Terminal",
  "url": "{{ url('/') }}",
  "logo": "{{ url('/logo.png') }}",
  "description": "Крупнейшее русскоязычное сообщество игроков Call of Duty",
  "sameAs": [
    "https://discord.gg/dsdkKyKPUB",
    "https://www.youtube.com/channel/UCJv6yWPDLMVhE-t-ispe2vA",
    "https://www.twitch.tv/zobnyyn",
    "https://t.me/teoryaigr"
  ]
}
</script>
```

### 4. Улучшение производительности (Core Web Vitals)

- **Оптимизация изображений:** Использовать WebP формат
- **Lazy loading:** Для изображений за пределами viewport
- **Preload критичных ресурсов:** Шрифты, критичный CSS
- **Минификация:** CSS и JS файлов

### 5. Semantic HTML

Убедиться в правильном использовании:
- `<h1>` - только один на странице
- `<h2>`, `<h3>` - логическая иерархия
- `<article>` для статей
- `<nav>` для навигации
- `<main>` для основного контента

### 6. Внутренняя перелинковка

- Добавить "Похожие статьи" в конце статей
- "Другие карты этой игры" на страницах зомби-карт
- Breadcrumbs (хлебные крошки) для навигации

### 7. Alt-теги для изображений

Убедиться, что все изображения имеют описательные alt-теги:
```vue
<img :src="article.image" :alt="`${article.title} - ${article.game}`">
```

---

## 🎯 Приоритетные задачи

1. ✅ Создать базовый SEO-компонент
2. ✅ Оптимизировать главные страницы
3. ✅ Создать robots.txt
4. ⏳ Создать sitemap.xml
5. ⏳ Добавить динамические SEO-теги для контентных страниц
6. ⏳ Внедрить Schema.org разметку
7. ⏳ Оптимизировать изображения (WebP, lazy loading)
8. ⏳ Добавить breadcrumbs
9. ⏳ Настроить Google Search Console
10. ⏳ Настроить Yandex Webmaster

---

## 📊 Метрики для отслеживания

1. **Органический трафик** - Google Analytics/Yandex Metrica
2. **Позиции в поиске** - по ключевым запросам
3. **CTR** - процент кликов из поиска
4. **Core Web Vitals** - скорость загрузки, интерактивность
5. **Индексация** - количество проиндексированных страниц

---

## 🔧 Технические детали

### Важные ключевые слова для таргетинга:

**Общие:**
- Call of Duty
- COD
- Калл оф дюти
- КОД (русская транслитерация)

**По играм:**
- Warzone, Warzone 2, Warzone 3
- Black Ops, Black Ops 2, Black Ops 3, Black Ops 4, Black Ops 6
- Modern Warfare, MW2, MW3
- Cold War
- World at War

**По контенту:**
- гайды, руководства, тактики
- сборки оружия, билды
- мета, мета-сборки
- зомби, zombies
- Easter Egg, пасхалки
- карты, maps
- оружие, перки
- wiki, энциклопедия

**Длинные запросы:**
- "лучшие сборки warzone"
- "гайд по зомби black ops 6"
- "как пройти easter egg"
- "мета оружие warzone 2025"
- "карта зомби прохождение"

---

## ✨ Следующие шаги

1. Проверить все оставшиеся страницы и добавить SEO-компонент
2. Создать динамические sitemap для статей, гайдов и карт
3. Добавить Schema.org разметку
4. Оптимизировать скорость загрузки
5. Настроить Google Search Console и Yandex Webmaster
6. Начать мониторинг позиций в поиске

