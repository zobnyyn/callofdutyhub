<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/blackopscoldwarbackground.jpg')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #ef4444 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Navigation Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-red-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-red-500 transition-colors">
              <span class="text-red-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-red-600">/</span>
            <span class="text-red-500">BLACK_OPS_COLD_WAR_2020</span>
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-red-600 to-red-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>BLACK OPS COLD WAR</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-red-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-red-500/90">
                <span class="text-red-600">&gt;</span> YEAR: 2020 | DEVELOPER: Treyarch/Raven | PUBLISHER: Activision
              </div>
            </div>
          </div>
        </div>

        <!-- Wiki Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

          <!-- Sidebar Navigation -->
          <aside class="lg:col-span-3">
            <div class="border-2 border-red-500/20 bg-black/40 backdrop-blur-sm p-4 sticky top-24">
              <div class="font-mono text-xs text-red-500 mb-3">
                <span class="text-red-600">&gt;</span> СОДЕРЖАНИЕ
              </div>
              <div class="h-px bg-gradient-to-r from-red-500/50 to-transparent mb-4"></div>

              <nav class="space-y-2 text-sm font-mono">
                <a
                  v-for="section in sections"
                  :key="section.id"
                  @click.prevent="scrollToSection(section.id)"
                  :class="[
                    'block py-2 px-3 border-l-2 transition-all cursor-pointer',
                    activeSection === section.id
                      ? 'border-red-500 text-red-500 bg-red-500/5'
                      : 'border-red-500/20 text-gray-400 hover:border-red-500/50 hover:text-red-500/80'
                  ]"
                >
                  <span class="text-red-600">&gt;</span> {{ section.title }}
                </a>
              </nav>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="lg:col-span-9">
            <div class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm">

              <!-- Section: Overview -->
              <section :id="sections[0].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[0].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-red-500">Call of Duty: Black Ops Cold War</strong> — шпионский триллер от Treyarch и Raven Software, выпущенный 13 ноября 2020 года. Действие разворачивается в начале 1980-х годов в разгар Холодной войны. Игра стала прямым сиквелом оригинальной Black Ops (2010).
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Cold War представляет возвращение к классическому boots-on-the-ground геймплею, историческую кампанию с множественными концовками, обновленный мультиплеер и совершенно новую Dark Aether историю Zombies с открытым миром.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-xs text-red-500 mb-2">
                        <span class="text-red-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-red-500">Дата выхода:</span> 13.11.2020</li>
                        <li><span class="text-red-500">Платформы:</span> PC, PS4, PS5, Xbox One, Xbox Series X|S</li>
                        <li><span class="text-red-500">Движок:</span> IW 8.0 (модифицированный)</li>
                        <li><span class="text-red-500">Режимы:</span> Кампания, Мультиплеер, Zombies, Warzone</li>
                      </ul>
                    </div>
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-xs text-red-500 mb-2">
                        <span class="text-red-600">&gt;</span> КЛЮЧЕВЫЕ ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Сиквел Black Ops 1</li>
                        <li>• Множественные концовки</li>
                        <li>• Dark Aether Zombies</li>
                        <li>• Warzone интеграция</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaign -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Кампания происходит в начале 1980-х годов. Игрок создает собственного персонажа <strong class="text-red-500">"Bell"</strong>, который работает с <strong class="text-red-500">Russell Adler</strong> и командой, чтобы выследить советского шпиона <strong class="text-red-500">Perseus</strong>, угрожающего изменить баланс сил в мире.
                  </p>

                  <!-- Campaign Features -->
                  <div class="border border-red-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-red-500">Множественные концовки:</strong> Ваш выбор определяет финал</li>
                      <li>• <strong class="text-red-500">Создание персонажа:</strong> Кастомизация пола, происхождения, перков</li>
                      <li>• <strong class="text-red-500">Safehouse:</strong> База между миссиями с секретами</li>
                      <li>• <strong class="text-red-500">Side Missions:</strong> Опциональные задания с расшифровкой кодов</li>
                      <li>• <strong class="text-red-500">Исторические события:</strong> Реальные локации и события 80-х</li>
                    </ul>
                  </div>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-red-500 pl-4">
                    <h3 class="text-xl font-bold text-rose-500 mb-4 font-mono">
                      <span class="text-rose-600">&gt;</span> КЛЮЧЕВЫЕ ПЕРСОНАЖИ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-red-500 font-mono text-sm mb-1">Bell (вы)</div>
                        <div class="text-xs text-gray-400">Кастомизируемый протагонист, агент ЦРУ</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-red-500 font-mono text-sm mb-1">Russell Adler</div>
                        <div class="text-xs text-gray-400">Офицер ЦРУ, лидер команды</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-red-500 font-mono text-sm mb-1">Perseus</div>
                        <div class="text-xs text-gray-400">Главный антагонист, советский шпион</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-red-500 font-mono text-sm mb-1">Frank Woods</div>
                        <div class="text-xs text-gray-400">Возвращается из BO1</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-red-500 font-mono text-sm mb-1">Alex Mason</div>
                        <div class="text-xs text-gray-400">Легенда BO1 возвращается</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-red-500 font-mono text-sm mb-1">Jason Hudson</div>
                        <div class="text-xs text-gray-400">Офицер ЦРУ из BO1</div>
                      </div>
                    </div>
                  </div>

                  <!-- Key Missions -->
                  <div class="border-l-4 border-red-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-rose-500 mb-3 font-mono">
                      <span class="text-rose-600">&gt;</span> Основные миссии
                    </h3>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <ul class="space-y-1 text-gray-400">
                        <li>• Nowhere to Run - Пролог, Турция 1981</li>
                        <li>• Nowhere Left to Run - Восточный Берлин</li>
                        <li>• Fracture Jaw - Кубинская операция</li>
                        <li>• Brick in the Wall - Берлин, инфильтрация</li>
                        <li>• Redlight, Greenlight - Вьетнам, флешбэк</li>
                        <li>• Echoes of a Cold War - Допрос, ментальный лабиринт</li>
                        <li>• Desperate Measures - КГБ штаб-квартира</li>
                        <li>• End of the Line - Поезд в Советском Союзе</li>
                        <li>• Break on Through - Психологическая миссия</li>
                        <li>• Identity Crisis - Финал, множественные концовки</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Side Missions -->
                  <div class="border border-red-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> ПОБОЧНЫЕ МИССИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-red-500">Operation Chaos:</strong> Расшифруйте код и найдите шпиона</li>
                      <li>• <strong class="text-red-500">Operation Red Circus:</strong> Головоломка для разоблачения агентов</li>
                      <li>• Требуют сбора улик по всей кампании!</li>
                    </ul>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Мультиплеер Cold War возвращается к классическому boots-on-the-ground стилю Black Ops. Баланс между arcade и реализмом, быстрый TTK, без дверей!
                  </p>

                  <!-- Key Features -->
                  <div class="border border-red-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> КЛЮЧЕВЫЕ ОСОБЕННОСТИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-red-500">Классический геймплей:</strong> Без wallrunning и jetpacks</li>
                      <li>• <strong class="text-red-500">Create-a-Class:</strong> Wildcard система</li>
                      <li>• <strong class="text-red-500">Scorestreaks:</strong> Не сбрасываются при смерти!</li>
                      <li>• <strong class="text-red-500">Cross-play:</strong> Между всеми платформами</li>
                      <li>• <strong class="text-red-500">Prestige возвращается:</strong> Сезонная система</li>
                    </ul>
                  </div>

                  <!-- Game Modes -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-sm text-red-500 mb-3">
                        <span class="text-red-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Hardpoint</li>
                        <li>• Search & Destroy</li>
                        <li>• Control</li>
                        <li>• Combined Arms (новый!)</li>
                        <li>• Fireteam (новый!)</li>
                      </ul>
                    </div>
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-sm text-red-500 mb-3">
                        <span class="text-red-600">&gt;</span> SCORESTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Spy Plane (UAV) - 550</li>
                        <li>• RC-XD - 600</li>
                        <li>• Counter Spy Plane - 750</li>
                        <li>• Napalm Strike - 1200</li>
                        <li>• Artillery - 1600</li>
                        <li>• Attack Helicopter - 2400</li>
                        <li>• VTOL Escort - 3000</li>
                      </ul>
                    </div>
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-sm text-red-500 mb-3">
                        <span class="text-red-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 8 карт на старте</li>
                        <li>• Gunsmith кастомизация</li>
                        <li>• League Play</li>
                        <li>• Warzone интеграция</li>
                        <li>• 120 FPS на next-gen</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Maps -->
                  <div class="border-l-4 border-red-500 pl-4 mt-6">
                    <h3 class="text-xl font-bold text-rose-500 mb-4 font-mono">
                      <span class="text-rose-600">&gt;</span> БАЗОВЫЕ КАРТЫ (8 ШТУК)
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Armada</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Crossroads</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Cartel</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Miami</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Moscow</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Satellite</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Garrison</div>
                      </div>
                      <div class="border border-red-500/30 p-3 bg-black/20">
                        <div class="font-mono text-sm text-gray-300 text-center">Checkmate</div>
                      </div>
                    </div>
                  </div>

                  <!-- Combined Arms -->
                  <div class="border border-red-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> COMBINED ARMS - НОВЫЙ РЕЖИМ
                    </div>
                    <p class="text-sm text-gray-400">12v12 на больших картах с транспортом! Танки, снегоходы и лодки. Режим Domination и Assault.</p>
                  </div>

                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Cold War Zombies запускает совершенно НОВУЮ историю <strong class="text-red-500">Dark Aether</strong>! Отряд Requiem борется с межизмерительной угрозой. Больше доступности для новичков!
                  </p>

                  <!-- Zombies Maps -->
                  <div class="border-l-4 border-red-500 pl-4">
                    <h3 class="text-xl font-bold text-rose-500 mb-4 font-mono">
                      <span class="text-rose-600">&gt;</span> КАРТЫ ЗОМБИ (8 ШТУК)
                    </h3>

                    <div class="space-y-4">
                      <!-- Launch Map -->
                      <div>
                        <div class="text-red-500 font-mono text-sm mb-3">
                          <span class="text-red-600">&gt;</span> КАРТА НА СТАРТЕ:
                        </div>
                        <div class="border border-red-500/30 p-4 bg-black/20">
                          <div class="font-mono text-sm text-red-500 mb-2">Die Maschine</div>
                          <div class="text-xs text-gray-400 mb-2">Nacht der Untoten reimagined</div>
                          <p class="text-xs text-gray-400">Ремейк классики! Подземный комплекс в Польше. D.I.E. Wonder Weapon!</p>
                        </div>
                      </div>

                      <!-- Season Maps -->
                      <div>
                        <div class="text-red-500 font-mono text-sm mb-3">
                          <span class="text-red-600">&gt;</span> СЕЗОННЫЕ КАРТЫ:
                        </div>
                        <div class="space-y-3">
                          <div class="border border-red-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-red-500">Firebase Z</div>
                              <div class="text-xs text-gray-500">Season 1</div>
                            </div>
                            <p class="text-xs text-gray-400">Вьетнам. R.A.I. K-84 Wonder Weapon! Mimic зомби!</p>
                          </div>

                          <div class="border border-red-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-red-500">Outbreak</div>
                              <div class="text-xs text-gray-500">Season 2</div>
                            </div>
                            <p class="text-xs text-gray-400">ОТКРЫТЫЙ МИР! Огромные карты, объективы, экстракция.</p>
                          </div>

                          <div class="border border-red-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-red-500">Mauer der Toten</div>
                              <div class="text-xs text-gray-500">Season 4</div>
                            </div>
                            <p class="text-xs text-gray-400">Берлинская стена. CRBR-S Wonder Weapon! Krasny Soldat!</p>
                          </div>

                          <div class="border border-red-500/30 p-4 bg-black/20">
                            <div class="flex justify-between items-start mb-2">
                              <div class="font-mono text-sm text-red-500">Forsaken</div>
                              <div class="text-xs text-gray-500">Season 5 - ФИНАЛ</div>
                            </div>
                            <p class="text-xs text-gray-400">Финал Dark Aether истории! Chrysalax Wonder Weapon!</p>
                          </div>

                          <div class="border border-red-500/30 p-4 bg-black/20">
                            <div class="font-mono text-sm text-red-500 mb-2">Onslaught</div>
                            <p class="text-xs text-gray-400">PlayStation эксклюзив. Выживание на MP картах.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombies Features -->
                  <div class="border border-red-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> НОВЫЕ МЕХАНИКИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-red-500">Weapon Rarity:</strong> Синее, фиолетовое, золотое оружие</li>
                      <li>• <strong class="text-red-500">Armor System:</strong> Покупаемая броня</li>
                      <li>• <strong class="text-red-500">Field Upgrades:</strong> Healing Aura, Ring of Fire и др.</li>
                      <li>• <strong class="text-red-500">Exfil:</strong> Опциональная эвакуация с наградами</li>
                      <li>• <strong class="text-red-500">Loadouts:</strong> Берите оружие из мультиплеера!</li>
                      <li>• <strong class="text-red-500">Progression:</strong> Общий уровень с MP</li>
                    </ul>
                  </div>

                  <!-- Dark Aether Story -->
                  <div class="border border-red-500/50 p-4 bg-red-500/10">
                    <div class="font-mono text-sm text-red-500 mb-2 font-bold">
                      <span class="text-red-600">&gt;</span> DARK AETHER ИСТОРИЯ
                    </div>
                    <p class="text-sm text-gray-400">Новая вселенная! Requiem vs Omega Group. Разлом между измерениями угрожает человечеству. Финал в карте Forsaken!</p>
                  </div>
                </div>
              </section>

              <!-- Section: Warzone Integration -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Cold War полностью интегрирована с Warzone. Оружие, операторы и прогрессия общие!
                  </p>

                  <div class="border border-red-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> WARZONE FEATURES
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• <strong class="text-red-500">Rebirth Island:</strong> Новая Resurgence карта (Алькатрас)</li>
                      <li>• <strong class="text-red-500">Verdansk 1984:</strong> Карта времен 80-х</li>
                      <li>• <strong class="text-red-500">CW Weapons:</strong> Все оружие из Cold War в Warzone</li>
                      <li>• <strong class="text-red-500">Shared Progression:</strong> Единая прогрессия</li>
                    </ul>
                  </div>
                </div>
              </section>

              <!-- Section: Seasons -->
              <section :id="sections[5].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Cold War получила 6 полноценных сезонов с Battle Pass, новыми картами и оружием!
                  </p>

                  <!-- Seasons List -->
                  <div class="space-y-3">
                    <div class="border border-red-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-red-500">Season 1</div>
                        <div class="text-xs text-gray-500">16 дек 2020</div>
                      </div>
                      <p class="text-xs text-gray-400">Firebase Z, Rebirth Island (Warzone), Raid карта, Groza/MAC-10</p>
                    </div>

                    <div class="border border-red-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-red-500">Season 2</div>
                        <div class="text-xs text-gray-500">25 фев 2021</div>
                      </div>
                      <p class="text-xs text-gray-400">Outbreak режим, Miami Strike, Apocalypse карты, LC10/FARA 83</p>
                    </div>

                    <div class="border border-red-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-red-500">Season 3</div>
                        <div class="text-xs text-gray-500">22 апр 2021</div>
                      </div>
                      <p class="text-xs text-gray-400">Verdansk 1984 (Warzone), Yamantau/Diesel карты, PPSH-41/Swiss K31</p>
                    </div>

                    <div class="border border-red-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-red-500">Season 4</div>
                        <div class="text-xs text-gray-500">17 июн 2021</div>
                      </div>
                      <p class="text-xs text-gray-400">Mauer der Toten, Collateral Strike карты, MG 82/C58</p>
                    </div>

                    <div class="border border-red-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-red-500">Season 5</div>
                        <div class="text-xs text-gray-500">12 авг 2021</div>
                      </div>
                      <p class="text-xs text-gray-400">Forsaken (финал Zombies!), Zoo карта, EM2/TEC-9</p>
                    </div>

                    <div class="border border-red-500/30 p-4 bg-black/20">
                      <div class="flex justify-between items-start mb-2">
                        <div class="font-mono text-sm text-red-500">Season 6</div>
                        <div class="text-xs text-gray-500">7 окт 2021</div>
                      </div>
                      <p class="text-xs text-gray-400">Deprogram/Amerika карты, финальный сезон перед Vanguard</p>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/black-ops-cold-war')"
                class="border-2 border-red-500/30 hover:border-red-500 bg-black/40 hover:bg-red-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-red-500 flex items-center w-full">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-red-500/30 hover:border-red-500 bg-black/40 hover:bg-red-500/10 p-4 transition-all group flex items-center min-h-[4rem]"
              >
                <div class="font-mono text-sm text-red-500 flex items-center w-full">
                  <span class="text-red-600">&gt;</span>
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
  text-shadow: 0 0 10px rgba(239, 68, 68, 0.5),
               0 0 20px rgba(239, 68, 68, 0.3),
               0 0 30px rgba(239, 68, 68, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>

