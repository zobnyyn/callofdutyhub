<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/blackops3background.jpg')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #8b5cf6 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Navigation Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-violet-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-violet-500 transition-colors">
              <span class="text-violet-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-violet-600">/</span>
            <span class="text-violet-500">BLACK_OPS_III_2015</span>
          </div>
          <div class="h-px bg-gradient-to-r from-violet-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-violet-500 via-purple-600 to-violet-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>BLACK OPS III</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-violet-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-violet-500/90">
                <span class="text-violet-600">&gt;</span> YEAR: 2015 | DEVELOPER: Treyarch | PUBLISHER: Activision
              </div>
            </div>
          </div>
        </div>

        <!-- Wiki Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

          <!-- Sidebar Navigation -->
          <aside class="lg:col-span-3">
            <div class="border-2 border-violet-500/20 bg-black/40 backdrop-blur-sm p-4 sticky top-24">
              <div class="font-mono text-xs text-violet-500 mb-3">
                <span class="text-violet-600">&gt;</span> СОДЕРЖАНИЕ
              </div>
              <div class="h-px bg-gradient-to-r from-violet-500/50 to-transparent mb-4"></div>

              <nav class="space-y-2 text-sm font-mono">
                <a
                  v-for="section in sections"
                  :key="section.id"
                  @click.prevent="scrollToSection(section.id)"
                  :class="[
                    'block py-2 px-3 border-l-2 transition-all cursor-pointer',
                    activeSection === section.id
                      ? 'border-violet-500 text-violet-500 bg-violet-500/5'
                      : 'border-violet-500/20 text-gray-400 hover:border-violet-500/50 hover:text-violet-500/80'
                  ]"
                >
                  <span class="text-violet-600">&gt;</span> {{ section.title }}
                </a>
              </nav>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="lg:col-span-9">
            <div class="border-2 border-violet-500/20 bg-black/60 backdrop-blur-sm">

              <!-- Section: Overview -->
              <section :id="sections[0].id" class="p-6 md:p-8 border-b-2 border-violet-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-violet-500 mb-4 flex items-center">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">{{ sections[0].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-violet-500">Call of Duty: Black Ops III</strong> — футуристический шутер от Treyarch, выпущенный 6 ноября 2015 года. Игра погружает в мир 2065 года с киберимплантами, роботами и продвинутой movement системой. BO3 заработала более $550 млн за первые три дня, став самой продаваемой игрой 2015 года на консолях.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops III представляет революционную систему Specialists с уникальными способностями, кооперативную кампанию на 4 игроков и легендарный Zombies с сюжетными линиями Shadows of Evil и Der Eisendrache.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-violet-500/30 p-4 bg-violet-500/5">
                      <div class="font-mono text-xs text-violet-500 mb-2">
                        <span class="text-violet-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-violet-500">Дата выхода:</span> 06.11.2015</li>
                        <li><span class="text-violet-500">Платформы:</span> PC, PS3, PS4, Xbox 360, Xbox One</li>
                        <li><span class="text-violet-500">Движок:</span> IW 3.0 (сильно модифицированный)</li>
                        <li><span class="text-violet-500">Режимы:</span> Кампания (4 игрока), МП, Zombies</li>
                      </ul>
                    </div>
                    <div class="border border-violet-500/30 p-4 bg-violet-500/5">
                      <div class="font-mono text-xs text-violet-500 mb-2">
                        <span class="text-violet-600">&gt;</span> ИННОВАЦИИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Specialists с abilities</li>
                        <li>• Thrust jump & wall running</li>
                        <li>• 4-player co-op кампания</li>
                        <li>• Gunsmith с Paint Shop</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaign -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-violet-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-violet-500 mb-4 flex items-center">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Кампания происходит в 2065 году, где солдаты используют киберимплантаты и усиления. Игрок играет за кастомизируемого оперативника, расследующего заговор с участием ИИ и черного рынка нелегальной военной технологии. Впервые в серии — 4-player co-op кампания!
                  </p>

                  <!-- Campaign Features -->
                  <div class="border border-violet-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-violet-500 mb-3">
                      <span class="text-violet-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-violet-500">4-Player Co-op:</strong> Впервые вся кампания играется в кооперативе</li>
                      <li>• <strong class="text-violet-500">Cyber Cores:</strong> 3 типа усилений (Control, Martial, Chaos)</li>
                      <li>• <strong class="text-violet-500">Нелинейность:</strong> Миссии можно играть в разном порядке</li>
                      <li>• <strong class="text-violet-500">Replay:</strong> Прокачка персонажа между миссиями</li>
                      <li>• <strong class="text-violet-500">Nightmares:</strong> Альтернативный зомби-режим кампании</li>
                    </ul>
                  </div>

                  <!-- Key Missions -->
                  <div class="border-l-4 border-violet-500 pl-4">
                    <h3 class="text-xl font-bold text-purple-500 mb-3 font-mono">
                      <span class="text-purple-600">&gt;</span> Основные миссии
                    </h3>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <ul class="space-y-1 text-gray-400">
                        <li>• Black Ops - Пролог, Эфиопия</li>
                        <li>• New World - Сингапур, первое задание</li>
                        <li>• In Darkness - Каир</li>
                        <li>• Provocation - Цюрих, битва с роботами</li>
                        <li>• Hypocenter - Сингапур, затопленный город</li>
                        <li>• Vengeance - Египет</li>
                        <li>• Rise and Fall - Coalescence база</li>
                        <li>• Demon Within - Цюрих</li>
                        <li>• Sand Castle - Египет</li>
                        <li>• Lotus Towers - Сингапур, финал</li>
                        <li>• Life - Швейцария, истинная концовка</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Cyber Cores -->
                  <div class="border-l-4 border-violet-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-purple-500 mb-4 font-mono">
                      <span class="text-purple-600">&gt;</span> CYBER CORES (3 ТИПА)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Control</div>
                        <div class="text-xs text-gray-400">Взлом роботов и техники</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Martial</div>
                        <div class="text-xs text-gray-400">Ближний бой и усиления</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Chaos</div>
                        <div class="text-xs text-gray-400">Агрессивные способности</div>
                      </div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-violet-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-violet-500 mb-4 flex items-center">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Мультиплеер BO3 революционизирован системой Specialists — 9 уникальных персонажей с особыми способностями и оружием. Movement включает thrust jumping, wall running и sliding.
                  </p>

                  <!-- Key Features -->
                  <div class="border border-violet-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-violet-500 mb-3">
                      <span class="text-violet-600">&gt;</span> КЛЮЧЕВЫЕ ОСОБЕННОСТИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-violet-500">Specialists:</strong> 9 персонажей с уникальными способностями</li>
                      <li>• <strong class="text-violet-500">Movement System:</strong> Wall running, thrust jumping, sliding</li>
                      <li>• <strong class="text-violet-500">Gunsmith:</strong> 5 модификаций + Paint Shop (кастом скины)</li>
                      <li>• <strong class="text-violet-500">Pick 10:</strong> Возвращение системы из BO2</li>
                      <li>• <strong class="text-violet-500">Arena Mode:</strong> Competitive ranked</li>
                    </ul>
                  </div>

                  <!-- Specialists -->
                  <div class="border-l-4 border-violet-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-purple-500 mb-4 font-mono">
                      <span class="text-purple-600">&gt;</span> SPECIALISTS (9 ПЕРСОНАЖЕЙ)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Ruin</div>
                        <div class="text-xs text-gray-400">Gravity Spikes + Overdrive</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Outrider</div>
                        <div class="text-xs text-gray-400">Sparrow Bow + Vision Pulse</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Prophet</div>
                        <div class="text-xs text-gray-400">Tempest + Glitch</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Battery</div>
                        <div class="text-xs text-gray-400">War Machine + Kinetic Armor</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Seraph</div>
                        <div class="text-xs text-gray-400">Annihilator + Combat Focus</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Nomad</div>
                        <div class="text-xs text-gray-400">H.I.V.E. + Rejack</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Reaper</div>
                        <div class="text-xs text-gray-400">Scythe + Psychosis</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Spectre</div>
                        <div class="text-xs text-gray-400">Ripper + Active Camo</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-violet-500 font-mono text-sm mb-1">Firebreak</div>
                        <div class="text-xs text-gray-400">Purifier + Heat Wave</div>
                      </div>
                    </div>
                  </div>

                  <!-- Game Modes -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-violet-500/30 p-4 bg-violet-500/5">
                      <div class="font-mono text-sm text-violet-500 mb-3">
                        <span class="text-violet-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Kill Confirmed</li>
                        <li>• Hardpoint</li>
                        <li>• Search & Destroy</li>
                        <li>• Uplink (новый!)</li>
                        <li>• Safeguard (новый!)</li>
                      </ul>
                    </div>
                    <div class="border border-violet-500/30 p-4 bg-violet-500/5">
                      <div class="font-mono text-sm text-violet-500 mb-3">
                        <span class="text-violet-600">&gt;</span> SCORESTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• UAV (500)</li>
                        <li>• Care Package (550)</li>
                        <li>• Counter-UAV (600)</li>
                        <li>• Hellstorm (800)</li>
                        <li>• Wraith (900)</li>
                        <li>• R.A.P.S. (1200)</li>
                        <li>• Mothership (1600)</li>
                      </ul>
                    </div>
                    <div class="border border-violet-500/30 p-4 bg-violet-500/5">
                      <div class="font-mono text-sm text-violet-500 mb-3">
                        <span class="text-violet-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 9 Specialists</li>
                        <li>• Gunsmith 5 модов</li>
                        <li>• Paint Shop</li>
                        <li>• Arena Mode</li>
                        <li>• Theater Mode</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Maps -->
                  <div class="border-l-4 border-violet-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-purple-500 mb-4 font-mono">
                      <span class="text-purple-600">&gt;</span> БАЗОВЫЕ КАРТЫ (12 ШТУК)
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Aquarium</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Breach</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Combine</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Evac</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Exodus</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Fringe</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Havoc</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Hunted</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Infection</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Metro</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Redwood</div>
                      </div>
                      <div class="border border-violet-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Stronghold</div>
                      </div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-violet-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-violet-500 mb-4 flex items-center">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO3 Zombies продолжает сюжетную линию Aether с Primis группой. Представляет GobbleGums, новые Wonder Weapons и самые эпичные карты в истории!
                  </p>

                  <!-- Zombies Maps -->
                  <div class="border-l-4 border-violet-500 pl-4">
                    <h3 class="text-xl font-bold text-purple-500 mb-4 font-mono">
                      <span class="text-purple-600">&gt;</span> КАРТЫ ЗОМБИ (8 ШТУК + CHRONICLES)
                    </h3>

                    <div class="space-y-4">
                      <!-- Base Maps -->
                      <div>
                        <div class="text-violet-500 font-mono text-sm mb-3">
                          <span class="text-violet-600">&gt;</span> БАЗОВЫЕ КАРТЫ:
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                          <div class="border border-violet-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-violet-500 mb-2">Shadows of Evil</div>
                            <div class="text-xs text-gray-400 mb-2">На старте</div>
                            <p class="text-xs text-gray-400">Noir Чикаго 1940-х. 4 новых героя!</p>
                          </div>
                          <div class="border border-violet-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-violet-500 mb-2">The Giant</div>
                            <div class="text-xs text-gray-400 mb-2">Pre-order бонус</div>
                            <p class="text-xs text-gray-400">Ремейк Der Riese. Primis возвращаются!</p>
                          </div>
                        </div>
                      </div>

                      <!-- DLC Maps -->
                      <div>
                        <div class="text-violet-500 font-mono text-sm mb-3">
                          <span class="text-violet-600">&gt;</span> DLC КАРТЫ:
                        </div>
                        <div class="space-y-3">
                          <div class="border border-violet-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-violet-500">Der Eisendrache</div>
                              <div class="text-xs text-gray-500">DLC 1</div>
                            </div>
                            <p class="text-xs text-gray-400">Замок в Австрии. 4 Elemental Bows!</p>
                          </div>

                          <div class="border border-violet-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-violet-500">Zetsubou No Shima</div>
                              <div class="text-xs text-gray-500">DLC 2</div>
                            </div>
                            <p class="text-xs text-gray-400">Тихоокеанский остров. Skull of Nan Sapwe!</p>
                          </div>

                          <div class="border border-violet-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-violet-500">Gorod Krovi</div>
                              <div class="text-xs text-gray-500">DLC 3</div>
                            </div>
                            <p class="text-xs text-gray-400">Сталинград с драконами! GKZ-45 Mk3!</p>
                          </div>

                          <div class="border border-violet-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-violet-500">Revelations</div>
                              <div class="text-xs text-gray-500">DLC 4</div>
                            </div>
                            <p class="text-xs text-gray-400">Финал Primis. Все карты в одной!</p>
                          </div>
                        </div>
                      </div>

                      <!-- Zombies Chronicles -->
                      <div>
                        <div class="text-violet-500 font-mono text-sm mb-3">
                          <span class="text-violet-600">&gt;</span> ZOMBIES CHRONICLES (DLC 5):
                        </div>
                        <div class="border border-violet-500/50 p-4 bg-violet-500/10">
                          <p class="text-sm text-gray-400 mb-3">8 ремастеров классических карт в одном паке!</p>
                          <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-xs text-gray-400">
                            <div>• Nacht der Untoten</div>
                            <div>• Verrückt</div>
                            <div>• Shi No Numa</div>
                            <div>• Kino der Toten</div>
                            <div>• Ascension</div>
                            <div>• Shangri-La</div>
                            <div>• Moon</div>
                            <div>• Origins</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombies Features -->
                  <div class="border border-violet-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-violet-500 mb-3">
                      <span class="text-violet-600">&gt;</span> НОВЫЕ МЕХАНИКИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-violet-500">GobbleGums:</strong> Перки-усиления с разными эффектами</li>
                      <li>• <strong class="text-violet-500">XP System:</strong> Прокачка и разблокировки</li>
                      <li>• <strong class="text-violet-500">Weapon Kits:</strong> Модификации оружия</li>
                      <li>• <strong class="text-violet-500">Mega GobbleGums:</strong> Редкие мощные усиления</li>
                      <li>• <strong class="text-violet-500">Double Pack-a-Punch:</strong> Двойное улучшение оружия</li>
                    </ul>
                  </div>

                </div>
              </section>

              <!-- Section: Weapons -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-violet-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-violet-500 mb-4 flex items-center">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO3 представляет футуристическое оружие с энергетическим вооружением и продвинутой системой Gunsmith.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-violet-500 pl-4">
                    <h3 class="text-xl font-bold text-purple-500 mb-4 font-mono">
                      <span class="text-purple-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">VMP</div>
                        <div class="text-xs text-gray-500 mb-2">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Мета ПП. Высокая скорострельность.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">M8A7</div>
                        <div class="text-xs text-gray-500 mb-2">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">4-round burst. Любимица профи.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">Kuda</div>
                        <div class="text-xs text-gray-500 mb-2">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Универсальный ПП с низкой отдачей.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">Man-O-War</div>
                        <div class="text-xs text-gray-500 mb-2">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Высокий урон, средняя скорострельность.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">Drakon</div>
                        <div class="text-xs text-gray-500 mb-2">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Semi-auto. Спамить на Fringe!</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">Brecci</div>
                        <div class="text-xs text-gray-500 mb-2">Дробовик</div>
                        <p class="text-xs text-gray-400">Автоматический. Имба на малых картах.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">XR-2</div>
                        <div class="text-xs text-gray-500 mb-2">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">3-round burst с высоким уроном.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">Dingo</div>
                        <div class="text-xs text-gray-500 mb-2">Пулемёт</div>
                        <p class="text-xs text-gray-400">Легкий ПК с хорошей мобильностью.</p>
                      </div>

                      <div class="border border-violet-500/30 p-4 bg-black/20">
                        <div class="font-mono text-sm text-violet-500 mb-2">Locus</div>
                        <div class="text-xs text-gray-500 mb-2">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Болтовка. Для квикскопов.</p>
                      </div>
                    </div>
                  </div>

                  <!-- Melee Weapons -->
                  <div class="border border-violet-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-violet-500 mb-3">
                      <span class="text-violet-600">&gt;</span> MELEE WEAPONS (SUPPLY DROP)
                    </div>
                    <p class="text-sm text-gray-400">BO3 представила множество холодного оружия через Supply Drops: Katana, Brass Knuckles, Wrench, Baseball Bat и другие!</p>
                  </div>

                </div>
              </section>

              <!-- Section: DLC -->
              <section :id="sections[5].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-violet-500 mb-4 flex items-center">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO3 получила 4 сезонных DLC + легендарный Zombies Chronicles.
                  </p>

                  <!-- DLC List -->
                  <div class="space-y-3">
                    <div class="border border-violet-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-violet-500">Awakening</div>
                        <div class="text-xs text-gray-500">2 фев 2016</div>
                      </div>
                      <p class="text-xs text-gray-400">4 MP карты + Der Eisendrache</p>
                    </div>

                    <div class="border border-violet-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-violet-500">Eclipse</div>
                        <div class="text-xs text-gray-500">19 апр 2016</div>
                      </div>
                      <p class="text-xs text-gray-400">4 MP карты + Zetsubou No Shima</p>
                    </div>

                    <div class="border border-violet-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-violet-500">Descent</div>
                        <div class="text-xs text-gray-500">12 июл 2016</div>
                      </div>
                      <p class="text-xs text-gray-400">4 MP карты + Gorod Krovi</p>
                    </div>

                    <div class="border border-violet-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-violet-500">Salvation</div>
                        <div class="text-xs text-gray-500">6 сен 2016</div>
                      </div>
                      <p class="text-xs text-gray-400">4 MP карты + Revelations (финал)</p>
                    </div>

                    <div class="border border-violet-500/50 p-4 bg-violet-500/10">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-violet-500 font-bold">Zombies Chronicles</div>
                        <div class="text-xs text-gray-500">16 май 2017</div>
                      </div>
                      <p class="text-xs text-gray-400">8 ремастеров классических карт! Самый успешный DLC!</p>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/black-ops-3')"
                class="border-2 border-violet-500/30 hover:border-violet-500 bg-black/40 hover:bg-violet-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-violet-500 flex items-center w-full">
                  <span class="text-violet-600">&gt;</span>
                  <span class="ml-2">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-violet-500/30 hover:border-violet-500 bg-black/40 hover:bg-violet-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-violet-500 flex items-center w-full">
                  <span class="text-violet-600">&gt;</span>
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
  { id: 'weapons', title: 'ОРУЖИЕ' },
  { id: 'dlc', title: 'DLC' },
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
  text-shadow: 0 0 10px rgba(139, 92, 246, 0.5),
               0 0 20px rgba(139, 92, 246, 0.3),
               0 0 30px rgba(139, 92, 246, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
