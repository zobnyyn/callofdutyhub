<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/callofduty2019background.jpg')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #10b981 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Navigation Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-green-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-green-500 transition-colors">
              <span class="text-green-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-green-600">/</span>
            <span class="text-green-500">MODERN_WARFARE_2019</span>
          </div>
          <div class="h-px bg-gradient-to-r from-green-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-green-500 via-emerald-600 to-green-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>MODERN WARFARE</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-green-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-green-500/90">
                <span class="text-green-600">&gt;</span> YEAR: 2019 | DEVELOPER: Infinity Ward | PUBLISHER: Activision
              </div>
            </div>
          </div>
        </div>

        <!-- Wiki Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

          <!-- Sidebar Navigation -->
          <aside class="lg:col-span-3">
            <div class="border-2 border-green-500/20 bg-black/40 backdrop-blur-sm p-4 sticky top-24">
              <div class="font-mono text-xs text-green-500 mb-3">
                <span class="text-green-600">&gt;</span> СОДЕРЖАНИЕ
              </div>
              <div class="h-px bg-gradient-to-r from-green-500/50 to-transparent mb-4"></div>

              <nav class="space-y-2 text-sm font-mono">
                <a
                  v-for="section in sections"
                  :key="section.id"
                  @click.prevent="scrollToSection(section.id)"
                  :class="[
                    'block py-2 px-3 border-l-2 transition-all cursor-pointer',
                    activeSection === section.id
                      ? 'border-green-500 text-green-500 bg-green-500/5'
                      : 'border-green-500/20 text-gray-400 hover:border-green-500/50 hover:text-green-500/80'
                  ]"
                >
                  <span class="text-green-600">&gt;</span> {{ section.title }}
                </a>
              </nav>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="lg:col-span-9">
            <div class="border-2 border-green-500/20 bg-black/60 backdrop-blur-sm">

              <!-- Section: Overview -->
              <section :id="sections[0].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[0].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-green-500">Call of Duty: Modern Warfare (2019)</strong> — масштабная перезагрузка легендарной серии, разработанная Infinity Ward и выпущенная в октябре 2019 года. Игра представляет новую, более реалистичную и мрачную интерпретацию современной войны с использованием нового движка IW 8.0.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW 2019 получила признание за технологические достижения, включая рейтрейсинг, фотореалистичную графику и кроссплатформенный мультиплеер. Игра заработала более $600 млн за первые три дня и стала основой для интеграции с Warzone.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-green-500">Дата выхода:</span> 25.10.2019</li>
                        <li><span class="text-green-500">Платформы:</span> PC, PS4, Xbox One</li>
                        <li><span class="text-green-500">Движок:</span> IW 8.0 (новый)</li>
                        <li><span class="text-green-500">Режимы:</span> Кампания, Мультиплеер, Spec Ops</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ИННОВАЦИИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Кроссплатформенная игра</li>
                        <li>• Ray tracing поддержка</li>
                        <li>• Gunsmith система (5 модификаций)</li>
                        <li>• Интеграция с Warzone</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaign -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    События разворачиваются в вымышленной стране Урзикстан на Ближнем Востоке. CIA офицер <strong class="text-green-500">Алекс</strong>, капитан SAS <strong class="text-green-500">Прайс</strong> и лидер повстанцев <strong class="text-green-500">Фарах Карим</strong> объединяются против террористической организации Аль-Катала и коррумпированных российских военных.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Капитан Джон Прайс</div>
                        <div class="text-xs text-gray-400">Легендарный оператор SAS, перезагруженный персонаж</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Алекс</div>
                        <div class="text-xs text-gray-400">Оператор CIA, главный игровой персонаж</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Фарах Карим</div>
                        <div class="text-xs text-gray-400">Командир Сил освобождения Урзикстана</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Кайл "Газ" Гэррик</div>
                        <div class="text-xs text-gray-400">Сержант SAS, становится Газом</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Роман Барков</div>
                        <div class="text-xs text-gray-400">Главный антагонист, российский генерал</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Хадир Карим</div>
                        <div class="text-xs text-gray-400">Брат Фарах, противоречивый персонаж</div>
                      </div>
                    </div>
                  </div>

                  <!-- Key Missions -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Знаковые миссии
                    </h3>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-green-500 mb-2 text-xs">
                        <span class="text-green-600">&gt;</span> ОСНОВНЫЕ МИССИИ:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Fog of War - Пролог, детство Фарах</li>
                        <li>• Piccadilly - Теракт в Лондоне</li>
                        <li>• Embedded - Репортёр в зоне боевых действий</li>
                        <li>• Clean House - Тактический штурм дома (культовая)</li>
                        <li>• Hunting Party - Снайперская миссия в горах</li>
                        <li>• The Wolf's Den - Миссия под прикрытием</li>
                        <li>• Going Dark - Ночная операция с ПНВ</li>
                        <li>• Into the Furnace - Финальное противостояние</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Campaign Features -->
                  <div class="border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• Реалистичное изображение современной войны</li>
                      <li>• Моральные дилеммы и серые зоны</li>
                      <li>• Фотореалистичная графика и motion capture</li>
                      <li>• Впечатляющие сетпиисы и кинематографичность</li>
                    </ul>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Мультиплеер MW 2019 революционизировал серию с кроссплатформенной игрой, новым Gunsmith и разнообразием режимов от 2v2 до Ground War 32v32.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Search & Destroy</li>
                        <li>• Gunfight (2v2)</li>
                        <li>• Ground War (32v32)</li>
                        <li>• Cyber Attack</li>
                        <li>• Realism Mode</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 3: Personal Radar / UAV</li>
                        <li>• 4: Counter UAV</li>
                        <li>• 5: Cluster Strike</li>
                        <li>• 7: Precision Airstrike</li>
                        <li>• 8: Wheelson / Sentry Gun</li>
                        <li>• 10: VTOL Jet</li>
                        <li>• 12: Chopper Gunner</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ИННОВАЦИИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Gunsmith (5 модификаций)</li>
                        <li>• Тактический спринт</li>
                        <li>• Mounting (упор оружия)</li>
                        <li>• Удаление миникарты (Realism)</li>
                        <li>• 155 уровней + сезоны</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Gunsmith System -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> GUNSMITH СИСТЕМА (НОВОЕ)
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Беспрецедентная кастомизация оружия с 5 слотами модификаций:</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-xs text-gray-400">
                      <div>• Дуло (глушители, компенсаторы)</div>
                      <div>• Лазер (целеуказатели)</div>
                      <div>• Оптика (прицелы всех типов)</div>
                      <div>• Цевье (тактические/подствол)</div>
                      <div>• Магазин (размер, тип патронов)</div>
                      <div>• Приклад (стабильность, ADS)</div>
                      <div>• Рукоять (отдача, контроль)</div>
                      <div>• Перк оружия (FMJ, Sleight of Hand)</div>
                    </div>
                  </div>

                  <!-- Gunfight Mode -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> GUNFIGHT - НОВЫЙ РЕЖИМ
                    </div>
                    <p class="text-sm text-gray-400">Интенсивный 2v2 режим на маленьких картах с случайным оружием каждый раунд. Первые до 6 побед.</p>
                  </div>

                </div>
              </section>

              <!-- Section: Weapons -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW 2019 представляет огромный арсенал современного оружия с беспрецедентным уровнем кастомизации через Gunsmith.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M4A1
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Универсальная винтовка, доступна с начала. Огромный потенциал кастомизации.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MP5
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Классический ПП возвращается. Отличная точность и скорострельность.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Kar98k
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Болтовая винтовка из WW2. Любима за быстрый ADS.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Grau 5.56
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Низкая отдача, популярна в Warzone. Добавлена в Season 2.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> PKM
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пулемёт</div>
                        <p class="text-xs text-gray-400">Мощный пулемёт с большим магазином на 100 патронов.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> 725
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Дробовик</div>
                        <p class="text-xs text-gray-400">Двустволка с огромной дальностью (до нерфа была имбовой).</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> HDR
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Тяжёлая снайперка с максимальной дальностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> RAM-7
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Bullpup винтовка с высокой скорострельностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> AX-50
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Сбалансированная снайперка с хорошим ADS.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Maps -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW 2019 включает разнообразные карты от маленьких Gunfight арен до огромных Ground War полей боя.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> БАЗОВЫЕ 6v6 КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Hackney Yard</div>
                        <div class="text-xs text-gray-500 text-center">Лондон</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Gun Runner</div>
                        <div class="text-xs text-gray-500 text-center">Средняя</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">St. Petrograd</div>
                        <div class="text-xs text-gray-500 text-center">Россия</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Grazna Raid</div>
                        <div class="text-xs text-gray-500 text-center">Большая</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Azhir Cave</div>
                        <div class="text-xs text-gray-500 text-center">Пещера</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Rammaza</div>
                        <div class="text-xs text-gray-500 text-center">Урзикстан</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Piccadilly</div>
                        <div class="text-xs text-gray-500 text-center">Лондон</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Euphrates Bridge</div>
                        <div class="text-xs text-gray-500 text-center">Мост</div>
                      </div>
                    </div>
                  </div>

                  <!-- Ground War Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> GROUND WAR КАРТЫ (32v32)
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-1">Karst River Quarry</div>
                        <div class="text-xs text-gray-400">Огромная карьерная карта с танками</div>
                      </div>
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-1">Tavorsk District</div>
                        <div class="text-xs text-gray-400">Городская карта с высотками</div>
                      </div>
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-1">Port of Verdansk</div>
                        <div class="text-xs text-gray-400">Порт (из Warzone)</div>
                      </div>
                    </div>
                  </div>

                  <!-- Gunfight Maps -->
                  <div class="mb-6">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> GUNFIGHT КАРТЫ (2v2)
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Pine</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">King</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Stack</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Speedball</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Docks</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Hill</div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Warzone -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-green-500">Call of Duty: Warzone</strong> — free-to-play Battle Royale режим, запущенный 10 марта 2020 года. Интегрирован с Modern Warfare и стал отдельным массивным проектом.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> РЕЖИМЫ WARZONE
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Battle Royale (150 игроков)</li>
                        <li>• Plunder (деньги вместо выживания)</li>
                        <li>• Resurgence (остров Rebirth)</li>
                        <li>• DMZ режим (позже)</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Карта Verdansk</li>
                        <li>• Gulag (1v1 за второй шанс)</li>
                        <li>• Buy Stations</li>
                        <li>• Loadout Drops</li>
                        <li>• Contracts</li>
                      </ul>
                    </div>
                  </div>

                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> VERDANSK
                    </div>
                    <p class="text-sm text-gray-400">Массивная карта 9x9 км с разнообразными локациями: города, аэропорт, плотина, военные базы, стадион и многое другое.</p>
                  </div>
                </div>
              </section>

              <!-- Section: Seasons -->
              <section :id="sections[6].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[6].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW 2019 представила новую модель контента - сезонную систему вместо традиционных DLC. Все карты и режимы бесплатны, косметика в Battle Pass.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 1-2</div>
                      <p class="text-sm text-gray-400">Запуск Warzone, добавление операторов Мара, Таллон, Никто. Новые карты Shipment, Vacant, Rust.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 3-4</div>
                      <p class="text-sm text-gray-400">Операторы Ghost и Price. Карты Talsik Backlot, Hovec Sawmill, Cheshire Park.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 5-6</div>
                      <p class="text-sm text-gray-400">Shadow Company, оператор Velikan. Stadium открыт, Train добавлен в Verdansk.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">ИНТЕГРАЦИЯ</div>
                      <p class="text-sm text-gray-400">Полная интеграция с Black Ops Cold War, переход на новую систему прогрессии.</p>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 gap-4">
              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-green-500/30 hover:border-green-500 bg-black/40 hover:bg-green-500/10 p-4 transition-all group"
              >
                <div class="font-mono text-sm text-green-500 mb-2 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-1">ВЕРНУТЬСЯ К COD WIKI</span>
                  <svg class="w-4 h-4 ml-auto group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                  </svg>
                </div>
              </button>
            </div>
          </main>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-green-500/20 bg-black/80 backdrop-blur-sm py-6 mt-12">
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center font-mono text-xs text-gray-500">
          <span class="text-green-600">&gt;</span> LAST_UPDATED: {{ lastUpdated }}
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from '@/Components/Header.vue';

const activeSection = ref('overview');
const lastUpdated = ref('2025-01-10');

const sections = [
  { id: 'overview', title: 'ОБЗОР' },
  { id: 'campaign', title: 'КАМПАНИЯ' },
  { id: 'multiplayer', title: 'МУЛЬТИПЛЕЕР' },
  { id: 'weapons', title: 'ОРУЖИЕ' },
  { id: 'maps', title: 'КАРТЫ' },
  { id: 'warzone', title: 'WARZONE' },
  { id: 'seasons', title: 'СЕЗОНЫ' },
];

const scrollToSection = (sectionId) => {
  const element = document.getElementById(sectionId);
  if (element) {
    const offset = 100;
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - offset;

    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    });
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
  text-shadow: 0 0 10px rgba(16, 185, 129, 0.5),
               0 0 20px rgba(16, 185, 129, 0.3),
               0 0 30px rgba(16, 185, 129, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>

