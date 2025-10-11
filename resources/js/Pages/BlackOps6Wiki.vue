<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/blackops6background.jpg')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #06b6d4 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Navigation Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-cyan-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-cyan-500 transition-colors">
              <span class="text-cyan-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-cyan-600">/</span>
            <span class="text-cyan-500">BLACK_OPS_6_2024</span>
          </div>
          <div class="h-px bg-gradient-to-r from-cyan-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 via-cyan-600 to-cyan-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>BLACK OPS 6</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-cyan-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-cyan-500/90">
                <span class="text-cyan-600">&gt;</span> YEAR: 2024 | DEVELOPER: Treyarch/Raven | PUBLISHER: Activision
              </div>
            </div>
          </div>
        </div>

        <!-- Wiki Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

          <!-- Sidebar Navigation -->
          <aside class="lg:col-span-3">
            <div class="border-2 border-cyan-500/20 bg-black/40 backdrop-blur-sm p-4 sticky top-24">
              <div class="font-mono text-xs text-cyan-500 mb-3">
                <span class="text-cyan-600">&gt;</span> СОДЕРЖАНИЕ
              </div>
              <div class="h-px bg-gradient-to-r from-cyan-500/50 to-transparent mb-4"></div>

              <nav class="space-y-2 text-sm font-mono">
                <a
                  v-for="section in sections"
                  :key="section.id"
                  @click.prevent="scrollToSection(section.id)"
                  :class="[
                    'block py-2 px-3 border-l-2 transition-all cursor-pointer',
                    activeSection === section.id
                      ? 'border-cyan-500 text-cyan-500 bg-cyan-500/5'
                      : 'border-cyan-500/20 text-gray-400 hover:border-cyan-500/50 hover:text-cyan-500/80'
                  ]"
                >
                  <span class="text-cyan-600">&gt;</span> {{ section.title }}
                </a>
              </nav>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="lg:col-span-9">
            <div class="border-2 border-cyan-500/20 bg-black/60 backdrop-blur-sm">

              <!-- Section: Overview -->
              <section :id="sections[0].id" class="p-6 md:p-8 border-b-2 border-cyan-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-cyan-500 mb-4 flex items-center">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">{{ sections[0].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-cyan-500">Call of Duty: Black Ops 6</strong> — новейшая игра в легендарной серии Black Ops, выпущенная 25 октября 2024 года. Действие разворачивается в начале 1990-х годов в конце Холодной войны. BO6 стала первой игрой COD с одновременным запуском в Game Pass!
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops 6 представляет революционную Omnimovement систему (спринт и слайд во всех направлениях), возвращение классической кампании, обновленный мультиплеер и совершенно новую Zombies историю с открытым миром.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-cyan-500/30 p-4 bg-cyan-500/5">
                      <div class="font-mono text-xs text-cyan-500 mb-2">
                        <span class="text-cyan-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-cyan-500">Дата выхода:</span> 25.10.2024</li>
                        <li><span class="text-cyan-500">Платформы:</span> PC, PS4, PS5, Xbox One, Xbox Series X|S</li>
                        <li><span class="text-cyan-500">Движок:</span> IW 9.0 (модифицированный)</li>
                        <li><span class="text-cyan-500">Режимы:</span> Кампания, Мультиплеер, Zombies, Warzone</li>
                      </ul>
                    </div>
                    <div class="border border-cyan-500/30 p-4 bg-cyan-500/5">
                      <div class="font-mono text-xs text-cyan-500 mb-2">
                        <span class="text-cyan-600">&gt;</span> РЕВОЛЮЦИОННЫЕ ФИЧИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Omnimovement система</li>
                        <li>• Game Pass день 1</li>
                        <li>• Round-Based Zombies возвращается</li>
                        <li>• Theatre режим возвращается</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaign -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-cyan-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-cyan-500 mb-4 flex items-center">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Кампания происходит в начале 1990-х годов. Команда оперативников расследует заговор в правительстве США. Игроки играют за <strong class="text-cyan-500">Уильяма "Case" Колдуэлла</strong>, который работает с командой включающей знакомых персонажей из Black Ops Cold War.
                  </p>

                  <!-- Campaign Features -->
                  <div class="border border-cyan-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-cyan-500 mb-3">
                      <span class="text-cyan-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-cyan-500">Шпионский триллер:</strong> Глубокий сюжет о заговорах</li>
                      <li>• <strong class="text-cyan-500">Сафхаус:</strong> Настраиваемая база между миссиями</li>
                      <li>• <strong class="text-cyan-500">Разнообразие миссий:</strong> От скрытности до масштабных баталий</li>
                      <li>• <strong class="text-cyan-500">Returning characters:</strong> Связь с Cold War</li>
                      <li>• <strong class="text-cyan-500">Множественные подходы:</strong> Разные способы прохождения</li>
                    </ul>
                  </div>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-cyan-500 pl-4">
                    <h3 class="text-xl font-bold text-cyan-400 mb-4 font-mono">
                      <span class="text-cyan-600">&gt;</span> КЛЮЧЕВЫЕ ПЕРСОНАЖИ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-cyan-500 font-mono text-sm mb-1">William "Case" Caldwell</div>
                        <div class="text-xs text-gray-400">Главный протагонист, оперативник ЦРУ</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-cyan-500 font-mono text-sm mb-1">Russell Adler</div>
                        <div class="text-xs text-gray-400">Возвращается из Cold War</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-cyan-500 font-mono text-sm mb-1">Frank Woods</div>
                        <div class="text-xs text-gray-400">Легенда серии возвращается</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-cyan-500 font-mono text-sm mb-1">Troy Marshall</div>
                        <div class="text-xs text-gray-400">Новый член команды</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-cyan-500 font-mono text-sm mb-1">Sevati "Sev" Dumas</div>
                        <div class="text-xs text-gray-400">Эксперт по технологиям</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-cyan-500 font-mono text-sm mb-1">Jane Harrow</div>
                        <div class="text-xs text-gray-400">Главный антагонист</div>
                      </div>
                    </div>
                  </div>

                  <!-- Safehouse -->
                  <div class="border border-cyan-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-cyan-500 mb-3">
                      <span class="text-cyan-600">&gt;</span> САФХАУС - БАЗА ОПЕРАЦИЙ
                    </div>
                    <p class="text-sm text-gray-400">Между миссиями возвращайтесь в настраиваемый сафхаус. Улучшайте снаряжение, разгадывайте головоломки, находите секреты и взаимодействуйте с командой!</p>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-cyan-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-cyan-500 mb-4 flex items-center">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Мультиплеер BO6 революционизирован системой <strong class="text-cyan-500">Omnimovement</strong> — возможность спринтить, прыгать и скользить в любом направлении, включая назад и в стороны. Престиж система возвращается!
                  </p>

                  <!-- Key Features -->
                  <div class="border border-cyan-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-cyan-500 mb-3">
                      <span class="text-cyan-600">&gt;</span> КЛЮЧЕВЫЕ ОСОБЕННОСТИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-cyan-500">Omnimovement:</strong> Спринт/слайд в любом направлении на 360°</li>
                      <li>• <strong class="text-cyan-500">Intelligent Movement:</strong> Умное преодоление препятствий</li>
                      <li>• <strong class="text-cyan-500">Prestige System:</strong> Возвращение классической прогрессии</li>
                      <li>• <strong class="text-cyan-500">Theatre Mode:</strong> Запись и просмотр матчей</li>
                      <li>• <strong class="text-cyan-500">Hit-Reg улучшен:</strong> Лучшая регистрация попаданий</li>
                    </ul>
                  </div>

                  <!-- Game Modes -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-cyan-500/30 p-4 bg-cyan-500/5">
                      <div class="font-mono text-sm text-cyan-500 mb-3">
                        <span class="text-cyan-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Hardpoint</li>
                        <li>• Search & Destroy</li>
                        <li>• Control</li>
                        <li>• Kill Order (новый!)</li>
                        <li>• Face Off (новый!)</li>
                      </ul>
                    </div>
                    <div class="border border-cyan-500/30 p-4 bg-cyan-500/5">
                      <div class="font-mono text-sm text-cyan-500 mb-3">
                        <span class="text-cyan-600">&gt;</span> SCORESTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• UAV (500)</li>
                        <li>• RC-XD (600)</li>
                        <li>• Counter-UAV (625)</li>
                        <li>• Care Package (700)</li>
                        <li>• Hellstorm (850)</li>
                        <li>• Chopper Gunner (1200)</li>
                        <li>• Dreadnought (1600)</li>
                      </ul>
                    </div>
                    <div class="border border-cyan-500/30 p-4 bg-cyan-500/5">
                      <div class="font-mono text-sm text-cyan-500 mb-3">
                        <span class="text-cyan-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 16 карт на старте</li>
                        <li>• Gunsmith кастомизация</li>
                        <li>• Ranked Play</li>
                        <li>• Cross-play/Cross-progression</li>
                        <li>• 120 FPS на консолях</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Maps -->
                  <div class="border-l-4 border-cyan-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-cyan-400 mb-4 font-mono">
                      <span class="text-cyan-600">&gt;</span> БАЗОВЫЕ КАРТЫ (16 ШТУК)
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Babylon</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Derelict</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Lowtown</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Protocol</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Rewind</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Scud</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Skyline</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Subsonic</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Vorkuta</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Warhead</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Nuketown Holiday</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Red Card</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Stakeout</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Pit</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Gala</div>
                      </div>
                      <div class="border border-cyan-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Vault</div>
                      </div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-cyan-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-cyan-500 mb-4 flex items-center">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO6 Zombies возвращается к классическому <strong class="text-cyan-500">Round-Based</strong> формату! Новая Dark Aether история продолжается. Две карты на старте + сезонный контент!
                  </p>

                  <!-- Zombies Maps -->
                  <div class="border-l-4 border-cyan-500 pl-4">
                    <h3 class="text-xl font-bold text-cyan-400 mb-4 font-mono">
                      <span class="text-cyan-600">&gt;</span> КАРТЫ ЗОМБИ
                    </h3>

                    <div class="space-y-4">
                      <!-- Launch Maps -->
                      <div>
                        <div class="text-cyan-500 font-mono text-sm mb-3">
                          <span class="text-cyan-600">&gt;</span> КАРТЫ НА СТАРТЕ (2 КАРТЫ):
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                          <div class="border border-cyan-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-cyan-500 mb-2">Liberty Falls</div>
                            <div class="text-xs text-gray-400 mb-2">West Virginia</div>
                            <p class="text-xs text-gray-400">Маленький американский городок. Идеальна для новичков!</p>
                          </div>
                          <div class="border border-cyan-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-cyan-500 mb-2">Terminus</div>
                            <div class="text-xs text-gray-400 mb-2">Тюрьма Алькатрас</div>
                            <p class="text-xs text-gray-400">Заброшенная тюрьма-остров. Сложная карта для ветеранов!</p>
                          </div>
                        </div>
                      </div>

                      <!-- Season Maps -->
                      <div>
                        <div class="text-cyan-500 font-mono text-sm mb-3">
                          <span class="text-cyan-600">&gt;</span> СЕЗОННЫЕ КАРТЫ:
                        </div>
                        <div class="space-y-3">
                          <div class="border border-cyan-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-cyan-500">Citadelle des Morts</div>
                              <div class="text-xs text-gray-500">Season 1 - 5 дек 2024</div>
                            </div>
                            <p class="text-xs text-gray-400">Средневековый замок с рыцарями-зомби. Sword of Invigorations!</p>
                          </div>

                          <div class="border border-cyan-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-cyan-500">The Tomb</div>
                              <div class="text-xs text-gray-500">Season 2 - Q1 2025</div>
                            </div>
                            <p class="text-xs text-gray-400">Скоро! Египетская гробница...</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombies Features -->
                  <div class="border border-cyan-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-cyan-500 mb-3">
                      <span class="text-cyan-600">&gt;</span> НОВЫЕ МЕХАНИКИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-cyan-500">Omnimovement в Zombies:</strong> Уклоняйтесь от зомби в любом направлении!</li>
                      <li>• <strong class="text-cyan-500">GobbleGums возвращаются:</strong> Классические баффы из BO3</li>
                      <li>• <strong class="text-cyan-500">Augments:</strong> Новая система апгрейдов</li>
                      <li>• <strong class="text-cyan-500">Directed Mode:</strong> Сюжетные задания с подсказками</li>
                      <li>• <strong class="text-cyan-500">Arsenal:</strong> Берите оружие из мультиплеера</li>
                      <li>• <strong class="text-cyan-500">Season Pass Integration:</strong> Общая прогрессия</li>
                    </ul>
                  </div>

                  <!-- Dark Aether Story -->
                  <div class="border border-cyan-500/50 p-4 bg-cyan-500/10">
                    <div class="font-mono text-sm text-cyan-500 mb-2 font-bold">
                      <span class="text-cyan-600">&gt;</span> DARK AETHER ИСТОРИЯ ПРОДОЛЖАЕТСЯ
                    </div>
                    <p class="text-sm text-gray-400">Новая история Dark Aether началась в Cold War. BO6 продолжает эпос о борьбе с межизмерительной угрозой. Requiem вернулись!</p>
                  </div>
                </div>
              </section>

              <!-- Section: Warzone Integration -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-cyan-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-cyan-500 mb-4 flex items-center">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops 6 полностью интегрирована с Warzone. Все оружие и прогрессия переносятся между режимами!
                  </p>

                  <div class="border border-cyan-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-cyan-500 mb-3">
                      <span class="text-cyan-600">&gt;</span> WARZONE FEATURES
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-cyan-500">Area 99 карта:</strong> Новая Resurgence карта в пустыне</li>
                      <li>• <strong class="text-cyan-500">Shared Progression:</strong> Единая прогрессия с BO6</li>
                      <li>• <strong class="text-cyan-500">BO6 Weapons:</strong> Все оружие из BO6 в Warzone</li>
                      <li>• <strong class="text-cyan-500">Omnimovement:</strong> Новая система движения в Warzone</li>
                    </ul>
                  </div>
                </div>
              </section>

              <!-- Section: Seasons -->
              <section :id="sections[5].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-cyan-500 mb-4 flex items-center">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO6 следует модели сезонов с Battle Pass. Новый контент каждые ~2 месяца!
                  </p>

                  <!-- Seasons List -->
                  <div class="space-y-3">
                    <div class="border border-cyan-500/50 p-4 bg-cyan-500/10">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-cyan-500 font-bold">Season 0 - Preseason</div>
                        <div class="text-xs text-gray-500">25 окт 2024</div>
                      </div>
                      <p class="text-xs text-gray-400">Запуск игры. 16 MP карт, 2 Zombies карты</p>
                    </div>

                    <div class="border border-cyan-500/50 p-4 bg-cyan-500/10">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-cyan-500 font-bold">Season 1</div>
                        <div class="text-xs text-gray-500">5 дек 2024</div>
                      </div>
                      <p class="text-xs text-gray-400">Citadelle des Morts (Zombies), новые MP карты, оружие</p>
                    </div>

                    <div class="border border-cyan-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-cyan-500">Season 2</div>
                        <div class="text-xs text-gray-500">Q1 2025</div>
                      </div>
                      <p class="text-xs text-gray-400">The Tomb (Zombies), новый контент...</p>
                    </div>

                    <div class="border border-cyan-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-cyan-500">Season 3-6</div>
                        <div class="text-xs text-gray-500">2025</div>
                      </div>
                      <p class="text-xs text-gray-400">Запланированы дополнительные сезоны с новым контентом</p>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/black-ops-6')"
                class="border-2 border-cyan-500/30 hover:border-cyan-500 bg-black/40 hover:bg-cyan-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-cyan-500 flex items-center w-full">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-cyan-500/30 hover:border-cyan-500 bg-black/40 hover:bg-cyan-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-cyan-500 flex items-center w-full">
                  <span class="text-cyan-600">&gt;</span>
                  <span class="ml-2">ВЕРНУТЬСЯ К COD WIKI</span>
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
  { id: 'zombies', title: 'ZOMBIES' },
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
  text-shadow: 0 0 10px rgba(6, 182, 212, 0.5),
               0 0 20px rgba(6, 182, 212, 0.3),
               0 0 30px rgba(6, 182, 212, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
