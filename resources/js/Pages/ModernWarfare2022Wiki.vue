<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/callofduty2022background.webp')"
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
            <span class="text-green-500">MODERN_WARFARE_II_2022</span>
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
                  <span>MODERN WARFARE II</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-green-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-green-500/90">
                <span class="text-green-600">&gt;</span> YEAR: 2022 | DEVELOPER: Infinity Ward | PUBLISHER: Activision
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
                    <strong class="text-green-500">Call of Duty: Modern Warfare II (2022)</strong> — продолжение перезагрузки серии 2019 года, разработанное Infinity Ward. Игра вышла 28 октября 2022 года и стала одним из самых успешных релизов года с более чем $1 млрд выручки за первые 10 дней.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW II продолжает историю Task Force 141 с улучшенной графикой, новым движком IW 9.0 и расширенным Gunsmith 2.0. Игра знаменует начало новой эры COD с интеграцией Warzone 2.0 и DMZ режима.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-green-500">Дата выхода:</span> 28.10.2022</li>
                        <li><span class="text-green-500">Платформы:</span> PC, PS4/5, Xbox</li>
                        <li><span class="text-green-500">Движок:</span> IW 9.0</li>
                        <li><span class="text-green-500">Режимы:</span> Кампания, Мультиплеер, Spec Ops, DMZ</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> КЛЮЧЕВЫЕ ФИЧИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Gunsmith 2.0 (семейства оружия)</li>
                        <li>• Улучшенный AI и графика</li>
                        <li>• Warzone 2.0 интеграция</li>
                        <li>• DMZ extraction режим</li>
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
                    Кампания следует за Task Force 141 в погоне за иранским террористом <strong class="text-green-500">Хасаном Зяни</strong> и мексиканским картелем, который украл американские ракеты. Действие происходит по всему миру: от Амстердама до Мексики и Ближнего Востока.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Капитан Джон Прайс</div>
                        <div class="text-xs text-gray-400">Командир Task Force 141, ветеран SAS</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Сержант "Соуп" МакТавиш</div>
                        <div class="text-xs text-gray-400">Шотландский оператор SAS, протеже Прайса</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Саймон "Гоуст" Райли</div>
                        <div class="text-xs text-gray-400">Легендарный оператор в маске, правая рука Прайса</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Кайл "Газ" Гэррик</div>
                        <div class="text-xs text-gray-400">Сержант SAS, член 141</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Алехандро Варгас</div>
                        <div class="text-xs text-gray-400">Полковник мексиканских спецназовцев</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Родольфо "Руди" Парра</div>
                        <div class="text-xs text-gray-400">Сержант-майор, напарник Алехандро</div>
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
                        <li>• Strike - Удар по складу ракет в Аль-Мазре</li>
                        <li>• Wetwork - Нефтяная платформа в Атлантике</li>
                        <li>• Tradecraft - Слежка в Амстердаме</li>
                        <li>• Borderline - Погоня на границе США-Мексика</li>
                        <li>• Cartel Protection - Инфильтрация в картель</li>
                        <li>• Close Air - Битва в небе над городом</li>
                        <li>• Violence and Timing - Побег из тюрьмы</li>
                        <li>• El Sin Nombre - Миссия под прикрытием на вечеринке</li>
                        <li>• Alone - Гоуст в одиночку против армии</li>
                        <li>• Countdown - Финальный штурм</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Campaign Features -->
                  <div class="border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• Более длинная кампания (~8-10 часов)</li>
                      <li>• Невероятные сетпиисы (полёты, погони)</li>
                      <li>• Миссия "Alone" - выживание с крафтом</li>
                      <li>• Фотореалистичная графика и мокап</li>
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
                    Мультиплеер MWII использует Gunsmith 2.0 с новой системой семейств оружия, улучшенный Perk System и инновационные режимы включая новый 3rd Person режим.
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
                        <li>• Hardpoint</li>
                        <li>• Knockout (новый)</li>
                        <li>• Prisoner Rescue (новый)</li>
                        <li>• Third Person Mode</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 4: UAV</li>
                        <li>• 5: Bomb Drone</li>
                        <li>• 6: Counter UAV</li>
                        <li>• 7: Cruise Missile</li>
                        <li>• 8: Mortar Strike</li>
                        <li>• 12: Chopper Gunner</li>
                        <li>• 15: Stealth Bomber</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> НОВЫЕ ФИЧИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Gunsmith 2.0</li>
                        <li>• Perk Packages</li>
                        <li>• Advanced AI</li>
                        <li>• Water mechanics</li>
                        <li>• Vehicle customization</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Gunsmith 2.0 -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> GUNSMITH 2.0 - СЕМЕЙСТВА ОРУЖИЯ
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Революционная система, где оружие объединено в семейства (например, M4 Platform). Модификации разблокируются прокачкой всех родственных оружий в семействе.</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-xs text-gray-400">
                      <div>• M4 Platform (M4, M16, FTAC Recon)</div>
                      <div>• Lachmann Platform (MP5, Lachmann-556)</div>
                      <div>• Kastov Platform (AK семейство)</div>
                      <div>• TAQ Platform (SCAR семейство)</div>
                      <div>• Bryson Platform (дробовики)</div>
                      <div>• SP-R Platform (снайперки)</div>
                    </div>
                  </div>

                  <!-- Perk System -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> НОВАЯ СИСТЕМА ПЕРКОВ
                    </div>
                    <p class="text-sm text-gray-400">Перки теперь работают как пакеты с 4 перками: 2 базовых (сразу), 1 бонусный (4 мин), 1 ультимативный (8 мин). Разблокировка зависит от счёта.</p>
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
                    MWII представляет огромный арсенал организованный в семейства оружия через Gunsmith 2.0. Более 50 единиц оружия с тысячами комбинаций модификаций.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M4
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Универсальная винтовка платформы M4. Отличный баланс.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Kastov-74u
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Компактный АК с высокой скорострельностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Lachmann Sub
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">MP5 под новым именем. Легенда возвращается.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> TAQ-56
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">SCAR-L с низкой отдачей. Мета в первом сезоне.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> SP-R 208
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Быстрая болтовка для агрессивного снайпинга.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Fennec 45
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Самая высокая скорострельность среди ПП.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Signal 50
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">.50 Cal снайперка с огромным уроном.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> RPK
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пулемёт</div>
                        <p class="text-xs text-gray-400">Мощный ПК из семейства Kastov.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> FTAC Recon
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Битв. винтовка</div>
                        <p class="text-xs text-gray-400">Версия M4 в конфигурации DMR.</p>
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
                    MWII запустилась с 10 базовыми картами 6v6 и несколькими Battle Map картами для Ground War и Invasion.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> БАЗОВЫЕ 6v6 КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Farm 18</div>
                        <div class="text-xs text-gray-500 text-center">Ферма</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Mercado Las Almas</div>
                        <div class="text-xs text-gray-500 text-center">Рынок</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Museum</div>
                        <div class="text-xs text-gray-500 text-center">Музей</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Breenbergh Hotel</div>
                        <div class="text-xs text-gray-500 text-center">Отель</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Crown Raceway</div>
                        <div class="text-xs text-gray-500 text-center">Гонки</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">El Asilo</div>
                        <div class="text-xs text-gray-500 text-center">Приют</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Zarqwa Hydroelectric</div>
                        <div class="text-xs text-gray-500 text-center">ГЭС</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Santa Seña Border</div>
                        <div class="text-xs text-gray-500 text-center">Граница</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Sa'id</div>
                        <div class="text-xs text-gray-500 text-center">Город</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Taraq</div>
                        <div class="text-xs text-gray-500 text-center">Пустыня</div>
                      </div>
                    </div>
                  </div>

                  <!-- Battle Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> BATTLE MAPS (Ground War / Invasion)
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-1">Al Bagra Fortress</div>
                        <div class="text-xs text-gray-400">Крепость в пустыне с танками</div>
                      </div>
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-1">Sariff Bay</div>
                        <div class="text-xs text-gray-400">Прибрежный город</div>
                      </div>
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-1">Sa'id District</div>
                        <div class="text-xs text-gray-400">Городские кварталы</div>
                      </div>
                    </div>
                  </div>

                  <!-- Season Maps -->
                  <div class="mb-6">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> СЕЗОННЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Shoot House (S1)</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Shipment (S1)</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Dome (S2)</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Zaya Observatory (S2)</div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Warzone 2.0 -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-green-500">Warzone 2.0</strong> — полная перезагрузка BR режима, запущенная 16 ноября 2022. Новая карта Al Mazrah, новый движок, новые механики.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> НОВЫЕ МЕХАНИКИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Круговая зона (движется)</li>
                        <li>• Новый лут и рюкзаки</li>
                        <li>• Strongholds и Black Sites</li>
                        <li>• AI враги на карте</li>
                        <li>• Third Person режим</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> AL MAZRAH
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Карта на Ближнем Востоке</li>
                        <li>• 18 POI локаций</li>
                        <li>• Пустыни, города, порты</li>
                        <li>• Улучшенные водные механики</li>
                      </ul>
                    </div>
                  </div>

                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> GULAG 2.0
                    </div>
                    <p class="text-sm text-gray-400">Новый Gulag теперь 2v2 формата. Игроки могут работать вместе или предать друг друга. Jailer добавляет дополнительную угрозу.</p>
                  </div>
                </div>
              </section>

              <!-- Section: DMZ -->
              <section :id="sections[6].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[6].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-green-500">DMZ</strong> — революционный PvEvP extraction режим, вдохновлённый Escape from Tarkov. Запущен одновременно с Warzone 2.0.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">ГЕЙМПЛЕЙ</div>
                      <p class="text-sm text-gray-400">Заходите на карту Al Mazrah, выполняйте миссии, собирайте лут и экстрактитесь через точки эвакуации. Если умрёте - теряете всё.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">ФРАКЦИИ</div>
                      <p class="text-sm text-gray-400">Три фракции: Legion, White Lotus, Black Mous. Каждая с уникальными миссиями и наградами.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">МИССИИ</div>
                      <p class="text-sm text-gray-400">Tier-based миссии от каждой фракции. Награды включают эксклюзивное оружие и чертежи.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">STRONGHOLDS</div>
                      <p class="text-sm text-gray-400">AI-защищённые базы с боссами. Зачистка даёт доступ к Black Site и лучшему луту.</p>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Seasons -->
              <section :id="sections[7].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[7].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MWII поддерживает модель живой службы с сезонными обновлениями, добавляющими новые карты, оружие, операторов и режимы каждые 2-3 месяца.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 1: RELOADED</div>
                      <div class="text-xs text-gray-500 mb-2">16 ноября 2022 - 31 января 2023</div>
                      <p class="text-sm text-gray-400 mb-2">Запуск Warzone 2.0 и DMZ. Карты Shoot House и Shipment. Новое оружие: M13B, Victus XMR.</p>
                      <div class="text-xs text-green-500/80">• Операторы: Klaus, Zeus</div>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 2: POWER GRAB</div>
                      <div class="text-xs text-gray-500 mb-2">15 февраля - 11 апреля 2023</div>
                      <p class="text-sm text-gray-400 mb-2">Карты Dome, Valderas Museum. Resurgence режим в Warzone. Ashika Island.</p>
                      <div class="text-xs text-green-500/80">• Оружие: ISO Hemlock, KV Broadside</div>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 3: CLASSIFIED</div>
                      <div class="text-xs text-gray-500 mb-2">12 апреля - 13 июня 2023</div>
                      <p class="text-sm text-gray-400 mb-2">Ranked Play запуск. Новые карты: Gunfight. Vondel карта в Warzone.</p>
                      <div class="text-xs text-green-500/80">• Оружие: TR-76 Geist, Tempus Torrent</div>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 4: MERCENARIES</div>
                      <div class="text-xs text-gray-500 mb-2">14 июня - 1 августа 2023</div>
                      <div class="text-sm text-gray-400 mb-2">Новые карты, режимы. Crossover события. Последние обновления перед MWIII.</div>
                      <div class="text-xs text-green-500/80">• Финальный контент, подготовка к MWIII</div>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 5: DARK RITUALS</div>
                      <div class="text-xs text-gray-500 mb-2">2 августа - 20 сентября 2023</div>
                      <p class="text-sm text-gray-400 mb-2">Событие The Haunting. Новые операторы. Crossover с другими франшизами.</p>
                      <div class="text-xs text-green-500/80">• Операторы: Spawn, Nicki Minaj</div>
                    </div>

                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 6: THE HAUNTING</div>
                      <div class="text-xs text-gray-500 mb-2">21 сентября - 9 ноября 2023</div>
                      <p class="text-sm text-gray-400 mb-2">Финальный сезон перед MWIII. Halloween событие. Переход прогрессии в MWIII.</p>
                      <div class="text-xs text-green-500/80">• Интеграция с Modern Warfare III</div>
                    </div>
                  </div>

                  <!-- Battle Pass System -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> BATTLE PASS СИСТЕМА
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Каждый сезон включает Battle Pass с 100+ уровнями наград. Бесплатные и премиум треки с оружием, операторами, скинами и косметикой.</p>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• Бесплатный трек: базовое оружие, XP токены</li>
                      <li>• Премиум трек: эксклюзивные операторы, скины оружия</li>
                      <li>• BlackCell: премиум Bundle с дополнительными наградами</li>
                    </ul>
                  </div>

                  <!-- Cross-Game Progression -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> КРОСС-ИГРОВАЯ ПРОГРЕССИЯ
                    </div>
                    <p class="text-sm text-gray-400">MWII, Warzone 2.0 и DMZ делят единую прогрессию. Все разблокированное оружие и контент доступен во всех режимах. С выходом MWIII прогрессия перешла в новую игру.</p>
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
  { id: 'warzone2', title: 'WARZONE 2.0' },
  { id: 'dmz', title: 'DMZ РЕЖИМ' },
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
