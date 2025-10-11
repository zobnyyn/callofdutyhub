<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/callofduty2007background.jpg')"
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
            <span class="text-green-500">COD4_MODERN_WARFARE</span>
          </div>
          <div class="h-px bg-gradient-to-r from-green-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-green-500 via-emerald-600 to-green-700 terminal-glow">
                  CALL OF DUTY 4:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>MODERN WARFARE</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-green-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-green-500/90">
                <span class="text-green-600">&gt;</span> YEAR: 2007 | DEVELOPER: Infinity Ward | PUBLISHER: Activision
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
                    <strong class="text-green-500">Call of Duty 4: Modern Warfare</strong> — революционный шутер от первого лица, разработанный Infinity Ward и выпущенный в ноябре 2007 года. Игра стала первой в серии, покинувшей сеттинг Второй мировой войны и перенесшей действие в современность.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    COD4 произвела революцию в жанре мультиплеерных шутеров, представив систему перков, killstreaks и прогрессии, которая стала стандартом индустрии. Игра получила множество наград и считается одной из лучших в серии.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-green-500">Дата выхода:</span> 05.11.2007</li>
                        <li><span class="text-green-500">Платформы:</span> PC, PS3, X360, Wii, Mac</li>
                        <li><span class="text-green-500">Движок:</span> IW 3.0</li>
                        <li><span class="text-green-500">Режимы:</span> Одиночная, Мультиплеер</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> НАГРАДЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Игра года (множество изданий)</li>
                        <li>• Лучший звук (BAFTA, 2008)</li>
                        <li>• Лучшая графика (IGN, 2007)</li>
                        <li>• Лучший шутер (GameSpot, 2007)</li>
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
                    Сюжет следует за группой спецназовцев SAS и морских пехотинцев США в их борьбе с российскими ультранационалистами и ближневосточным террористом Халедом Аль-Асадом. Игрок управляет двумя персонажами: сержантом <strong class="text-green-500">Джоном "Соуп" МакТавишем</strong> (SAS) и сержантом <strong class="text-green-500">Полом Джексоном</strong> (USMC).
                  </p>

                  <!-- SAS Missions -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Миссии SAS
                    </h3>
                    <p class="text-gray-300 leading-relaxed mb-3">
                      Под командованием <strong class="text-green-500">капитана Прайса</strong>, отряд SAS выслеживает террориста Имрана Захаева по всему миру.
                    </p>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-green-500 mb-2 text-xs">
                        <span class="text-green-600">&gt;</span> КЛЮЧЕВЫЕ МИССИИ:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Crew Expendable - Проникновение на корабль</li>
                        <li>• All Ghillied Up - Легендарная снайперская миссия в Припяти</li>
                        <li>• One Shot, One Kill - Чернобыль</li>
                        <li>• Sins of the Father - Финальная миссия</li>
                      </ul>
                    </div>
                  </div>

                  <!-- USMC Missions -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Миссии USMC
                    </h3>
                    <p class="text-gray-300 leading-relaxed mb-3">
                      Морская пехота США охотится за Аль-Асадом на Ближнем Востоке.
                    </p>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-green-500 mb-2 text-xs">
                        <span class="text-green-600">&gt;</span> КЛЮЧЕВЫЕ МИССИИ:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• The Coup - Эмоциональная вступительная сцена</li>
                        <li>• Charlie Don't Surf - Штурм телестанции</li>
                        <li>• Shock and Awe - Ядерный взрыв</li>
                        <li>• War Pig - Танковая миссия</li>
                      </ul>
                    </div>
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
                    Мультиплеер COD4 установил новый стандарт для онлайн-шутеров. Система рангов, разблокировок и killstreaks создала невероятно затягивающий игровой процесс.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Free-for-All</li>
                        <li>• Search & Destroy</li>
                        <li>• Domination</li>
                        <li>• Sabotage</li>
                        <li>• Headquarters</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 3 Kills: UAV Recon</li>
                        <li>• 5 Kills: Airstrike</li>
                        <li>• 7 Kills: Helicopter</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 3 перка на класс</li>
                        <li>• Система рангов 1-55</li>
                        <li>• Престиж режим (10 уровней)</li>
                        <li>• Кастомные классы</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Perks System -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> СИСТЕМА ПЕРКОВ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                      <div>
                        <div class="text-emerald-500 font-mono mb-2 text-sm">PERK 1</div>
                        <ul class="space-y-1 text-gray-400">
                          <li>• Bandolier - доп. патроны</li>
                          <li>• Bomb Squad - видеть взрывчатку</li>
                          <li>• Claymore x2</li>
                          <li>• Special Grenades x3</li>
                        </ul>
                      </div>
                      <div>
                        <div class="text-emerald-500 font-mono mb-2 text-sm">PERK 2</div>
                        <ul class="space-y-1 text-gray-400">
                          <li>• Stopping Power - больше урона</li>
                          <li>• Juggernaut - больше HP</li>
                          <li>• Sleight of Hand - быстрая перезарядка</li>
                          <li>• Double Tap - выше скорострельность</li>
                        </ul>
                      </div>
                      <div>
                        <div class="text-emerald-500 font-mono mb-2 text-sm">PERK 3</div>
                        <ul class="space-y-1 text-gray-400">
                          <li>• Deep Impact - пробитие стен</li>
                          <li>• Extreme Conditioning - дольше бег</li>
                          <li>• Steady Aim - лучшая точность</li>
                          <li>• Last Stand - предсмертный режим</li>
                        </ul>
                      </div>
                    </div>
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
                    COD4 представляет широкий арсенал современного оружия с возможностью кастомизации через камуфляжи и модификации.
                  </p>

                  <!-- Assault Rifles -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ШТУРМОВЫЕ ВИНТОВКИ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M16A4
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Трёхочередная винтовка с высокой точностью. Доступна с начала игры.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> AK-47
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Россия</div>
                        <p class="text-xs text-gray-400">Легендарный автомат Калашникова. Высокий урон, средняя точность.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M4 Carbine
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Универсальный карабин с хорошей точностью и скорострельностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> G3
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Мощная винтовка с высоким уроном и отдачей.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> G36C
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Компактная винтовка с низкой отдачей и высокой точностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M14
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Полуавтоматическая винтовка с максимальным уроном.</p>
                      </div>
                    </div>
                  </div>

                  <!-- SMGs -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПИСТОЛЕТЫ-ПУЛЕМЁТЫ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MP5
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Классический ПП с отличной точностью и контролем отдачи.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Skorpion
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Чехия</div>
                        <p class="text-xs text-gray-400">Компактный автомат с высокой скорострельностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Mini-Uzi
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Израиль</div>
                        <p class="text-xs text-gray-400">Очень высокая скорострельность для ближнего боя.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> AK-74u
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Россия</div>
                        <p class="text-xs text-gray-400">Укороченный автомат Калашникова. Высокий урон.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> P90
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Бельгия</div>
                        <p class="text-xs text-gray-400">Большой магазин (50 патронов) и низкая отдача.</p>
                      </div>
                    </div>
                  </div>

                  <!-- Sniper Rifles -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> СНАЙПЕРСКИЕ ВИНТОВКИ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M40A3
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Болтовая винтовка с высоким уроном. Убийство с одного выстрела в корпус.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M21
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Полуавтоматическая снайперская винтовка с низкой отдачей.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Dragunov
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Россия</div>
                        <p class="text-xs text-gray-400">СВД - советская полуавтоматическая винтовка.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> R700
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Мощная болтовая винтовка с высокой точностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Barrett .50cal
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Полуавтоматическая винтовка .50 калибра. Максимальный урон.</p>
                      </div>
                    </div>
                  </div>

                  <!-- LMGs -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПУЛЕМЁТЫ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M249 SAW
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Лёгкий пулемёт с большим магазином (100 патронов).</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> RPD
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Россия</div>
                        <p class="text-xs text-gray-400">Советский ручной пулемёт с низкой отдачей.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> M60E4
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Тяжёлый пулемёт с максимальным уроном и отдачей.</p>
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
                    COD4 включает разнообразные мультиплеерные карты, от городских локаций до сельской местности.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> БАЗОВЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Ambush</div>
                        <div class="text-xs text-gray-500 text-center">Ирак</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Городская карта</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Backlot</div>
                        <div class="text-xs text-gray-500 text-center">Ближний Восток</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Узкие улицы</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Bog</div>
                        <div class="text-xs text-gray-500 text-center">Европа</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Болотистая местность</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Crash</div>
                        <div class="text-xs text-gray-500 text-center">Ближний Восток</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Разбитый вертолёт</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Crossfire</div>
                        <div class="text-xs text-gray-500 text-center">Ближний Восток</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Городской перекрёсток</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">District</div>
                        <div class="text-xs text-gray-500 text-center">Ближний Восток</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Торговый район</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Downpour</div>
                        <div class="text-xs text-gray-500 text-center">Россия</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Дождливая ферма</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Overgrown</div>
                        <div class="text-xs text-gray-500 text-center">Припять</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Заброшенная деревня</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Pipeline</div>
                        <div class="text-xs text-gray-500 text-center">Азербайджан</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Нефтепровод</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Shipment</div>
                        <div class="text-xs text-gray-500 text-center">Порт</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Очень маленькая</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Strike</div>
                        <div class="text-xs text-gray-500 text-center">Ближний Восток</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Жилой квартал</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Vacant</div>
                        <div class="text-xs text-gray-500 text-center">Россия</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Офисное здание</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Wet Work</div>
                        <div class="text-xs text-gray-500 text-center">Море</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Танкер</div>
                      </div>
                    </div>
                  </div>

                  <!-- DLC Maps -->
                  <div class="mb-6">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> DLC КАРТЫ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                      <!-- Variety Map Pack -->
                      <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                        <div class="text-sm text-green-500 font-mono mb-2">VARIETY MAP PACK</div>
                        <div class="space-y-2 text-sm">
                          <div class="text-gray-300">
                            <span class="text-green-500">•</span> <strong>Broadcast</strong>
                            <div class="text-xs text-gray-500 ml-3">Телестанция</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-green-500">•</span> <strong>Chinatown</strong>
                            <div class="text-xs text-gray-500 ml-3">Китайский квартал</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-green-500">•</span> <strong>Creek</strong>
                            <div class="text-xs text-gray-500 ml-3">Лесной ручей</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-green-500">•</span> <strong>Killhouse</strong>
                            <div class="text-xs text-gray-500 ml-3">Тренировочная база (бонус)</div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: DLC -->
              <section :id="sections[5].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="space-y-4">
                  <div
                    v-for="dlc in dlcPacks"
                    :key="dlc.name"
                    class="border-l-4 border-green-500 pl-4 bg-black/20 p-4"
                  >
                    <h3 class="text-lg font-bold text-emerald-500 mb-2 font-mono">
                      <span class="text-emerald-600">&gt;</span> {{ dlc.name }}
                    </h3>
                    <div class="text-xs text-green-500 mb-2 font-mono">{{ dlc.date }}</div>
                    <p class="text-sm text-gray-400 mb-2">{{ dlc.description }}</p>
                    <div class="text-xs text-gray-500 font-mono">
                      <span class="text-green-600">&gt;</span> Контент: {{ dlc.content }}
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
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

// Reactive data
const activeSection = ref('overview');
const lastUpdated = ref('2025-01-10');

// Navigation sections
const sections = [
  { id: 'overview', title: 'ОБЗОР' },
  { id: 'campaign', title: 'КАМПАНИЯ' },
  { id: 'multiplayer', title: 'МУЛЬТИПЛЕЕР' },
  { id: 'weapons', title: 'ОРУЖИЕ' },
  { id: 'maps', title: 'КАРТЫ' },
  { id: 'dlc', title: 'DLC' },
];

// DLC Packs
const dlcPacks = [
  {
    name: 'Variety Map Pack',
    date: '04.04.2008',
    description: 'Единственный набор карт для COD4, включающий 4 новые карты',
    content: '4 мультиплеер карты (Broadcast, Chinatown, Creek, Killhouse)'
  }
];

// Scroll to section
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

// Track active section on scroll
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
/* Terminal glow effect */
.terminal-glow {
  text-shadow: 0 0 10px rgba(16, 185, 129, 0.5),
               0 0 20px rgba(16, 185, 129, 0.3),
               0 0 30px rgba(16, 185, 129, 0.2);
}

/* Cursor blink animation */
.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
