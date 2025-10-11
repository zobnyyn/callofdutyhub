<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/blackops4background.jpg')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Navigation Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-orange-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-orange-500 transition-colors">
              <span class="text-orange-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-orange-600">/</span>
            <span class="text-orange-500">BLACK_OPS_4_2018</span>
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-amber-600 to-orange-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>BLACK OPS 4</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-orange-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-orange-500/90">
                <span class="text-orange-600">&gt;</span> YEAR: 2018 | DEVELOPER: Treyarch | PUBLISHER: Activision
              </div>
            </div>
          </div>
        </div>

        <!-- Wiki Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

          <!-- Sidebar Navigation -->
          <aside class="lg:col-span-3">
            <div class="border-2 border-orange-500/20 bg-black/40 backdrop-blur-sm p-4 sticky top-24">
              <div class="font-mono text-xs text-orange-500 mb-3">
                <span class="text-orange-600">&gt;</span> СОДЕРЖАНИЕ
              </div>
              <div class="h-px bg-gradient-to-r from-orange-500/50 to-transparent mb-4"></div>

              <nav class="space-y-2 text-sm font-mono">
                <a
                  v-for="section in sections"
                  :key="section.id"
                  @click.prevent="scrollToSection(section.id)"
                  :class="[
                    'block py-2 px-3 border-l-2 transition-all cursor-pointer',
                    activeSection === section.id
                      ? 'border-orange-500 text-orange-500 bg-orange-500/5'
                      : 'border-orange-500/20 text-gray-400 hover:border-orange-500/50 hover:text-orange-500/80'
                  ]"
                >
                  <span class="text-orange-600">&gt;</span> {{ section.title }}
                </a>
              </nav>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="lg:col-span-9">
            <div class="border-2 border-orange-500/20 bg-black/60 backdrop-blur-sm">

              <!-- Section: Overview -->
              <section :id="sections[0].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[0].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-orange-500">Call of Duty: Black Ops 4</strong> — первая игра серии БЕЗ традиционной сольной кампании! Выпущена 12 октября 2018 года. BO4 сфокусирована на мультиплеере, Battle Royale режиме Blackout и расширенном Zombies с 3 сюжетными линиями.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops 4 представляет возврат к boots-on-the-ground геймплею без jetpacks, ручное лечение, увеличенный TTK (150 HP) и режим Blackout — первую Battle Royale от Treyarch на картах из всех Black Ops игр.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-xs text-orange-500 mb-2">
                        <span class="text-orange-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-orange-500">Дата выхода:</span> 12.10.2018</li>
                        <li><span class="text-orange-500">Платформы:</span> PC (Battle.net), PS4, Xbox One</li>
                        <li><span class="text-orange-500">Движок:</span> IW 3.0 (улучшенный)</li>
                        <li><span class="text-orange-500">Режимы:</span> Мультиплеер, Blackout, Zombies</li>
                      </ul>
                    </div>
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-xs text-orange-500 mb-2">
                        <span class="text-orange-600">&gt;</span> РЕВОЛЮЦИОННЫЕ ИЗМЕНЕНИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• НЕТ кампании!</li>
                        <li>• Blackout Battle Royale</li>
                        <li>• 150 HP + manual healing</li>
                        <li>• Boots-on-the-ground</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Мультиплеер возвращается к классическому boots-on-the-ground геймплею. Увеличен TTK (150 HP вместо 100), добавлено ручное лечение. Specialists возвращаются с BO3.
                  </p>

                  <!-- Key Features -->
                  <div class="border border-orange-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> КЛЮЧЕВЫЕ ИЗМЕНЕНИЯ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-orange-500">150 HP:</strong> Увеличенное здоровье</li>
                      <li>• <strong class="text-orange-500">Manual Healing:</strong> Стимпак на кнопку</li>
                      <li>• <strong class="text-orange-500">Fog of War:</strong> Мини-радар показывает направление</li>
                      <li>• <strong class="text-orange-500">Predictive Recoil:</strong> Фиксированные паттерны отдачи</li>
                      <li>• <strong class="text-orange-500">Gear System:</strong> Дополнительное снаряжение</li>
                    </ul>
                  </div>

                  <!-- Game Modes -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-sm text-orange-500 mb-3">
                        <span class="text-orange-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Control (новый!)</li>
                        <li>• Hardpoint</li>
                        <li>• Search & Destroy</li>
                        <li>• Heist (новый!)</li>
                      </ul>
                    </div>
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-sm text-orange-500 mb-3">
                        <span class="text-orange-600">&gt;</span> SCORESTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• UAV (500)</li>
                        <li>• Hellstorm (600)</li>
                        <li>• Lightning Strike (700)</li>
                        <li>• Snipers Nest (1000)</li>
                        <li>• Attack Chopper (1050)</li>
                        <li>• Strike Team (1250)</li>
                      </ul>
                    </div>
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-sm text-orange-500 mb-3">
                        <span class="text-orange-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 10 Specialists</li>
                        <li>• Операторские моды</li>
                        <li>• Реактивное снаряжение</li>
                        <li>• Баллистический щит</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Specialists -->
                  <div class="border-l-4 border-orange-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-amber-500 mb-4 font-mono">
                      <span class="text-amber-600">&gt;</span> SPECIALISTS (10 ОПЕРАТИВНИКОВ)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Battery</div>
                        <div class="text-xs text-gray-400">War Machine + Cluster Grenade</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Ruin</div>
                        <div class="text-xs text-gray-400">Grapple Gun + Grav Slam</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Nomad</div>
                        <div class="text-xs text-gray-400">Mesh Mines + K9 Unit</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Prophet</div>
                        <div class="text-xs text-gray-400">Seeker Drone + Tempest</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Firebreak</div>
                        <div class="text-xs text-gray-400">Reactor Core + Purifier</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Crash</div>
                        <div class="text-xs text-gray-400">TAK-5 + Assault Pack (поддержка)</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Ajax</div>
                        <div class="text-xs text-gray-400">9-Bang + Ballistic Shield</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Torque</div>
                        <div class="text-xs text-gray-400">Barricade + Razor Wire</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Recon</div>
                        <div class="text-xs text-gray-400">Sensor Dart + Vision Pulse</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Seraph</div>
                        <div class="text-xs text-gray-400">Tac-Deploy + Annihilator</div>
                      </div>
                    </div>
                  </div>

                  <!-- Maps -->
                  <div class="border-l-4 border-orange-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-amber-500 mb-4 font-mono">
                      <span class="text-amber-600">&gt;</span> БАЗОВЫЕ КАРТЫ (14 ШТУК)
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Contraband</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Frequency</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Gridlock</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Hacienda</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Icebreaker</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Jungle</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Militia</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Morocco</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Payload</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Seaside</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Summit</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Arsenal</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Firing Range</div>
                      </div>
                      <div class="border border-orange-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Slums</div>
                      </div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Blackout -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-orange-500">Blackout</strong> — первый Battle Royale от Treyarch! Огромная карта объединяет локации из Black Ops 1, 2, 3. До 100 игроков в соло, дуо и квадах!
                  </p>

                  <!-- Blackout Features -->
                  <div class="border border-orange-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> ОСОБЕННОСТИ BLACKOUT
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-orange-500">До 100 игроков:</strong> Соло, дуо, квады</li>
                      <li>• <strong class="text-orange-500">Огромная карта:</strong> 1500x больше Nuketown</li>
                      <li>• <strong class="text-orange-500">Иконичные локации:</strong> Nuketown, Firing Range, Array, Asylum и др.</li>
                      <li>• <strong class="text-orange-500">Наземные и воздушные транспорты:</strong> ATV, вертолёты, лодки</li>
                      <li>• <strong class="text-orange-500">Зомби:</strong> На карте есть зоны с зомби!</li>
                      <li>• <strong class="text-orange-500">Perks:</strong> Система перков из мультиплеера</li>
                    </ul>
                  </div>

                  <!-- Iconic Locations -->
                  <div class="border-l-4 border-orange-500 pl-4">
                    <h3 class="text-xl font-bold text-amber-500 mb-4 font-mono">
                      <span class="text-amber-600">&gt;</span> ИКОНИЧНЫЕ ЛОКАЦИИ НА КАРТЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Nuketown Island</div>
                        <div class="text-xs text-gray-400">Легендарная карта посреди острова</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Firing Range</div>
                        <div class="text-xs text-gray-400">Из Black Ops 1</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Array</div>
                        <div class="text-xs text-gray-400">Радарная база из BO1</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Asylum</div>
                        <div class="text-xs text-gray-400">Зомби карта из WaW</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Hijacked</div>
                        <div class="text-xs text-gray-400">Яхта из BO2</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Cargo</div>
                        <div class="text-xs text-gray-400">Доки из BO2</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Turbine</div>
                        <div class="text-xs text-gray-400">Ветряные турбины BO2</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Fracking Tower</div>
                        <div class="text-xs text-gray-400">Из BO3</div>
                      </div>
                    </div>
                  </div>

                  <!-- Limited Time Modes -->
                  <div class="border border-orange-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> LTM (LIMITED TIME MODES)
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-400">
                      <div>• <strong class="text-orange-500">Alcatraz:</strong> Компактная карта-тюрьма</div>
                      <div>• <strong class="text-orange-500">Hot Pursuit:</strong> Все с транспортом</div>
                      <div>• <strong class="text-orange-500">Ambush:</strong> Только снайперки</div>
                      <div>• <strong class="text-orange-500">Hardcore:</strong> Без HUD</div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO4 Zombies представляет ТРИ сюжетные линии: продолжение Aether с Primis, новая Chaos история и Zombies Rush режим. Самая масштабная зомби-экспансия в истории!
                  </p>

                  <!-- Zombies Maps -->
                  <div class="border-l-4 border-orange-500 pl-4">
                    <h3 class="text-xl font-bold text-amber-500 mb-4 font-mono">
                      <span class="text-amber-600">&gt;</span> КАРТЫ ЗОМБИ (8 ШТУК)
                    </h3>

                    <div class="space-y-4">
                      <!-- Launch Maps -->
                      <div>
                        <div class="text-orange-500 font-mono text-sm mb-3">
                          <span class="text-orange-600">&gt;</span> КАРТЫ НА СТАРТЕ (3 КАРТЫ):
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-orange-500 mb-2">IX</div>
                            <div class="text-xs text-gray-400 mb-2">Chaos Story</div>
                            <p class="text-xs text-gray-400">Римский колизей. Гладиаторские бои с зомби!</p>
                          </div>
                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-orange-500 mb-2">Voyage of Despair</div>
                            <div class="text-xs text-gray-400 mb-2">Chaos Story</div>
                            <p class="text-xs text-gray-400">Титаник! Тонущий лайнер с зомби.</p>
                          </div>
                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-orange-500 mb-2">Blood of the Dead</div>
                            <div class="text-xs text-gray-400 mb-2">Aether Story</div>
                            <p class="text-xs text-gray-400">Ремейк Mob of the Dead. Алькатрас!</p>
                          </div>
                        </div>
                      </div>

                      <!-- DLC Maps -->
                      <div>
                        <div class="text-orange-500 font-mono text-sm mb-3">
                          <span class="text-orange-600">&gt;</span> DLC КАРТЫ:
                        </div>
                        <div class="space-y-3">
                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-orange-500">Dead of the Night</div>
                              <div class="text-xs text-gray-500">DLC 1</div>
                            </div>
                            <div class="text-xs text-gray-400 mb-2">Chaos Story</div>
                            <p class="text-xs text-gray-400">Особняк с вампирами. Знаменитые актёры озвучки!</p>
                          </div>

                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-orange-500">Ancient Evil</div>
                              <div class="text-xs text-gray-500">DLC 2</div>
                            </div>
                            <div class="text-xs text-gray-400 mb-2">Chaos Story</div>
                            <p class="text-xs text-gray-400">Древняя Греция. Подземный город с Пегасом!</p>
                          </div>

                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-orange-500">Alpha Omega</div>
                              <div class="text-xs text-gray-500">DLC 3</div>
                            </div>
                            <div class="text-xs text-gray-400 mb-2">Aether Story</div>
                            <p class="text-xs text-gray-400">Ремейк Nuketown Zombies. Правда о Broken Arrow.</p>
                          </div>

                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-orange-500">Tag Der Toten</div>
                              <div class="text-xs text-gray-500">DLC 4</div>
                            </div>
                            <div class="text-xs text-gray-400 mb-2">Aether Story - ФИНАЛ</div>
                            <p class="text-xs text-gray-400">Ремейк Call of the Dead. КОНЕЦ истории Aether!</p>
                          </div>

                          <div class="border border-orange-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-orange-500">Classified</div>
                              <div class="text-xs text-gray-500">Season Pass</div>
                            </div>
                            <div class="text-xs text-gray-400 mb-2">Aether Story</div>
                            <p class="text-xs text-gray-400">Ремейк Five. Пентагон с Ultimis!</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombies Features -->
                  <div class="border border-orange-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> НОВЫЕ МЕХАНИКИ ЗОМБИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-orange-500">Elixirs:</strong> Заменяют GobbleGums</li>
                      <li>• <strong class="text-orange-500">Special Weapons:</strong> Уникальное оружие для каждой карты</li>
                      <li>• <strong class="text-orange-500">Bots:</strong> AI товарищи в соло</li>
                      <li>• <strong class="text-orange-500">Custom Mutations:</strong> Настраиваемые правила</li>
                      <li>• <strong class="text-orange-500">Rush Mode:</strong> Быстрый режим на очки</li>
                      <li>• <strong class="text-orange-500">Callings:</strong> Ежедневные челленджи</li>
                    </ul>
                  </div>

                  <!-- Aether Storyline End -->
                  <div class="border border-orange-500/50 p-4 bg-orange-500/10">
                    <div class="font-mono text-sm text-orange-500 mb-2 font-bold">
                      <span class="text-orange-600">&gt;</span> КОНЕЦ ИСТОРИИ AETHER
                    </div>
                    <p class="text-sm text-gray-400">Tag Der Toten завершает 11-летнюю историю Aether, начавшуюся в World at War. Финал путешествия Primis и Ultimis экипажей!</p>
                  </div>
                </div>
              </section>

              <!-- Section: Seasons -->
              <section :id="sections[4].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO4 использует систему Operation с Battle Pass. Бесплатный контент для всех, косметика в премиум-пропуске.
                  </p>

                  <!-- Seasons List -->
                  <div class="space-y-3">
                    <div class="border border-orange-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-orange-500">Operation Absolute Zero</div>
                        <div class="text-xs text-gray-500">11 дек 2018</div>
                      </div>
                      <p class="text-xs text-gray-400">Zero Specialist, Hijacked карта</p>
                    </div>

                    <div class="border border-orange-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-orange-500">Operation Grand Heist</div>
                        <div class="text-xs text-gray-500">19 фев 2019</div>
                      </div>
                      <p class="text-xs text-gray-400">Outrider, новые карты MP и Blackout</p>
                    </div>

                    <div class="border border-orange-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-orange-500">Operation Spectre Rising</div>
                        <div class="text-xs text-gray-500">30 апр 2019</div>
                      </div>
                      <p class="text-xs text-gray-400">Spectre возвращается, Alcatraz в Blackout</p>
                    </div>

                    <div class="border border-orange-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-orange-500">Operation Apocalypse Z</div>
                        <div class="text-xs text-gray-500">9 июл 2019</div>
                      </div>
                      <p class="text-xs text-gray-400">Зомби в Blackout! Alpha Omega карта</p>
                    </div>

                    <div class="border border-orange-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-orange-500">Operation Dark Divide</div>
                        <div class="text-xs text-gray-500">24 сен 2019</div>
                      </div>
                      <p class="text-xs text-gray-400">Tag Der Toten - финал Aether!</p>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/black-ops-4')"
                class="border-2 border-orange-500/30 hover:border-orange-500 bg-black/40 hover:bg-orange-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-orange-500 flex items-center w-full">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-orange-500/30 hover:border-orange-500 bg-black/40 hover:bg-orange-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-orange-500 flex items-center w-full">
                  <span class="text-orange-600">&gt;</span>
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
  { id: 'multiplayer', title: 'МУЛЬТИПЛЕЕР' },
  { id: 'blackout', title: 'BLACKOUT' },
  { id: 'zombies', title: 'ZOMBIES' },
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
  text-shadow: 0 0 10px rgba(249, 115, 22, 0.5),
               0 0 20px rgba(249, 115, 22, 0.3),
               0 0 30px rgba(249, 115, 22, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
