<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/blackopsbackground.jpg')"
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
            <span class="text-orange-500">BLACK_OPS_2010</span>
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
                  <span>BLACK OPS</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-orange-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-orange-500/90">
                <span class="text-orange-600">&gt;</span> YEAR: 2010 | DEVELOPER: Treyarch | PUBLISHER: Activision
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
                    <strong class="text-orange-500">Call of Duty: Black Ops</strong> — культовый шутер от Treyarch, выпущенный 9 ноября 2010 года. Игра стала самым продаваемым релизом в истории США на тот момент, заработав более $650 млн за первые 5 дней и более $1 млрд к концу года.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops погружает в мир секретных операций времён Холодной войны (1961-1968), затрагивая такие события как вторжение в залив Свиней, война во Вьетнаме и секретные советские программы. Игра также представила легендарный Zombies режим с оригинальной сюжетной линией Aether.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-xs text-orange-500 mb-2">
                        <span class="text-orange-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-orange-500">Дата выхода:</span> 09.11.2010</li>
                        <li><span class="text-orange-500">Платформы:</span> PC, PS3, Xbox 360, Wii</li>
                        <li><span class="text-orange-500">Движок:</span> IW 3.0 (модифицированный)</li>
                        <li><span class="text-orange-500">Режимы:</span> Кампания, Мультиплеер, Zombies</li>
                      </ul>
                    </div>
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-xs text-orange-500 mb-2">
                        <span class="text-orange-600">&gt;</span> ДОСТИЖЕНИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• $1 млрд выручки за 42 дня</li>
                        <li>• 5.9 млн копий за первый день</li>
                        <li>• Game of the Year номинации</li>
                        <li>• Легендарный Zombies режим</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaign -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Кампания следует за агентом ЦРУ <strong class="text-orange-500">Алексом Мэйсоном</strong>, который участвует в секретных операциях времён Холодной войны. История рассказывается через флешбэки во время допроса в 1968 году, где Мэйсон пытается вспомнить ключевые события и разгадать загадку числовой станции, транслирующей загадочные сообщения.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-orange-500 pl-4">
                    <h3 class="text-xl font-bold text-amber-500 mb-3 font-mono">
                      <span class="text-amber-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Алекс Мэйсон</div>
                        <div class="text-xs text-gray-400">Главный протагонист, агент ЦРУ и SOG</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Джейсон Хадсон</div>
                        <div class="text-xs text-gray-400">Офицер ЦРУ, ведущий допрос</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Фрэнк Вудс</div>
                        <div class="text-xs text-gray-400">Сержант, лучший друг Мэйсона</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Виктор Резнов</div>
                        <div class="text-xs text-gray-400">Советский солдат, союзник (или нет?)</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Никита Драгович</div>
                        <div class="text-xs text-gray-400">Главный антагонист, советский генерал</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-orange-500 font-mono text-sm mb-1">Джозеф Боумэн</div>
                        <div class="text-xs text-gray-400">Агент ЦРУ, член команды</div>
                      </div>
                    </div>
                  </div>

                  <!-- Key Missions -->
                  <div class="border-l-4 border-orange-500 pl-4">
                    <h3 class="text-xl font-bold text-amber-500 mb-3 font-mono">
                      <span class="text-amber-600">&gt;</span> Знаковые миссии
                    </h3>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-orange-500 mb-2 text-xs">
                        <span class="text-orange-600">&gt;</span> ОСНОВНЫЕ МИССИИ:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Operation 40 - Покушение на Кастро, Куба 1961</li>
                        <li>• Vorkuta - Побег из ГУЛАГа (культовая)</li>
                        <li>• U.S.D.D. - Пентагон и SR-71</li>
                        <li>• Executive Order - Заброс во Вьетнам</li>
                        <li>• S.O.G. - Вертолётные бои во Вьетнаме</li>
                        <li>• The Defector - Гонконг, погоня на крышах</li>
                        <li>• Numbers - Операция в Гонконге</li>
                        <li>• Crash Site - Вьетнамские джунгли</li>
                        <li>• WMD - Снайперская миссия на Урале</li>
                        <li>• Payback - Лаос, спасение</li>
                        <li>• Rebirth - Остров Возрождения</li>
                        <li>• Redemption - Финал, правда раскрыта</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Campaign Features -->
                  <div class="border border-orange-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• Нелинейное повествование через флешбэки</li>
                      <li>• Твист с раскрытием личности Резнова</li>
                      <li>• Реальные исторические события</li>
                      <li>• Множественные концовки (секретная)</li>
                      <li>• Легендарная фраза "THE NUMBERS, MASON!"</li>
                    </ul>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Мультиплеер Black Ops революционизировал серию введением валюты COD Points для покупки оружия и перков, системой Wager Matches и Theater Mode для просмотра реплеев.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-sm text-orange-500 mb-3">
                        <span class="text-orange-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Search & Destroy</li>
                        <li>• Free-For-All</li>
                        <li>• Demolition</li>
                        <li>• Sabotage</li>
                        <li>• Wager Match (новое!)</li>
                      </ul>
                    </div>
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-sm text-orange-500 mb-3">
                        <span class="text-orange-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 3: Spy Plane (UAV)</li>
                        <li>• 4: RC-XD</li>
                        <li>• 5: Counter Spy Plane</li>
                        <li>• 6: SAM Turret</li>
                        <li>• 7: Napalm Strike</li>
                        <li>• 8: Attack Dogs</li>
                        <li>• 11: Chopper Gunner</li>
                      </ul>
                    </div>
                    <div class="border border-orange-500/30 p-4 bg-orange-500/5">
                      <div class="font-mono text-sm text-orange-500 mb-3">
                        <span class="text-orange-600">&gt;</span> ИННОВАЦИИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• COD Points валюта</li>
                        <li>• Theater Mode</li>
                        <li>• Combat Record</li>
                        <li>• Custom Emblems</li>
                        <li>• Dive to Prone</li>
                      </ul>
                    </div>
                  </div>

                  <!-- COD Points -->
                  <div class="mt-6 border border-orange-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> COD POINTS СИСТЕМА
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Революционная система, где оружие и перки покупаются за заработанную валюту вместо традиционной разблокировки по уровням. Позволяет игрокам выбирать свой путь прогрессии.</p>
                  </div>

                  <!-- Wager Match -->
                  <div class="mt-6 border border-orange-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> WAGER MATCH - НОВЫЙ РЕЖИМ
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Высокорискованные матчи, где игроки ставят COD Points. Топ-3 игрока забирают банк:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs text-gray-400">
                      <div>• One in the Chamber - 1 пуля, 1 убийство</div>
                      <div>• Sticks and Stones - Crossbow + томагавк</div>
                      <div>• Gun Game - Прогрессия через оружие</div>
                      <div>• Sharpshooter - Случайное оружие каждые 45 сек</div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Weapons -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops представляет арсенал времён Холодной войны с культовым оружием 60-х годов.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-orange-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-amber-500 mb-4 font-mono">
                      <span class="text-amber-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> AK-47
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Легендарная советская винтовка. Высокий урон.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> FAMAS
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Французская bullpup с очередями. Мета оружие.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> Commando
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">M16 вариант. Двойной магазин.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> MP5K
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Компактный ПП. Отлично для SMG раша.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> Galil
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Израильская винтовка. Низкая отдача.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> AUG
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Австрийская bullpup. Встроенный прицел.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> Stoner63
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пулемёт</div>
                        <p class="text-xs text-gray-400">Мощный ПК с большим магазином.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> L96A1
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Болтовка. Популярна для квикскопов.</p>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2">
                          <span class="text-orange-600">&gt;</span> Crossbow
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Специальное</div>
                        <p class="text-xs text-gray-400">Культовое оружие. Взрывные стрелы.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Maps -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops включает 14 базовых карт с разнообразными локациями времён Холодной войны.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-amber-500 mb-4">
                      <span class="text-amber-600">&gt;</span> БАЗОВЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Array</div>
                        <div class="text-xs text-gray-500 text-center">Арктика</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Cracked</div>
                        <div class="text-xs text-gray-500 text-center">Плотина</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Crisis</div>
                        <div class="text-xs text-gray-500 text-center">Куба</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Firing Range</div>
                        <div class="text-xs text-gray-500 text-center">Культовая</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Grid</div>
                        <div class="text-xs text-gray-500 text-center">Радарная база</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Hanoi</div>
                        <div class="text-xs text-gray-500 text-center">Вьетнам</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Havana</div>
                        <div class="text-xs text-gray-500 text-center">Куба</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Jungle</div>
                        <div class="text-xs text-gray-500 text-center">Вьетнам</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Launch</div>
                        <div class="text-xs text-gray-500 text-center">Ракеты</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Nuketown</div>
                        <div class="text-xs text-gray-500 text-center">ЛЕГЕНДА</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Radiation</div>
                        <div class="text-xs text-gray-500 text-center">СССР</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Summit</div>
                        <div class="text-xs text-gray-500 text-center">Горы</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Villa</div>
                        <div class="text-xs text-gray-500 text-center">Куба</div>
                      </div>

                      <div class="border border-orange-500/30 p-3 bg-black/20 hover:bg-orange-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">WMD</div>
                        <div class="text-xs text-gray-500 text-center">Урал</div>
                      </div>
                    </div>
                  </div>

                  <!-- Nuketown Highlight -->
                  <div class="border border-orange-500/50 p-4 bg-orange-500/10">
                    <div class="font-mono text-sm text-orange-500 mb-2 font-bold">
                      <span class="text-orange-600">&gt;</span> NUKETOWN - ЛЕГЕНДАРНАЯ КАРТА
                    </div>
                    <p class="text-sm text-gray-400">Культовая маленькая карта в стиле 50-х годов. Стала символом серии Black Ops и возвращалась в каждой последующей игре.</p>
                  </div>

                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-orange-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops Zombies продолжает сюжетную линию Aether с Ultimis группой и представляет новые карты с уникальными механиками.
                  </p>

                  <!-- Zombies Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-amber-500 mb-4">
                      <span class="text-amber-600">&gt;</span> КАРТЫ ЗОМБИ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2 font-bold">Kino der Toten</div>
                        <div class="text-xs text-gray-500 mb-2">Берлин, заброшенный кинотеатр</div>
                        <p class="text-xs text-gray-400 mb-2">Самая популярная карта BO1. Thundergun, Nova Crawlers.</p>
                        <div class="text-xs text-orange-500/80">Wonder Weapon: Thundergun</div>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2 font-bold">"Five"</div>
                        <div class="text-xs text-gray-500 mb-2">Пентагон, секретная карта</div>
                        <p class="text-xs text-gray-400 mb-2">JFK, Castro, Nixon играют! Thief Zombies крадут оружие.</p>
                        <div class="text-xs text-orange-500/80">Wonder Weapon: Winter's Howl</div>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2 font-bold">Ascension</div>
                        <div class="text-xs text-gray-500 mb-2">СССР, космодром</div>
                        <p class="text-xs text-gray-400 mb-2">Monkey Zombies, лунные модули. Первый DLC.</p>
                        <div class="text-xs text-orange-500/80">Wonder Weapon: Gersh Device, Matryoshka Dolls</div>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2 font-bold">Call of the Dead</div>
                        <div class="text-xs text-gray-500 mb-2">Сибирь, корабль</div>
                        <p class="text-xs text-gray-400 mb-2">Знаменитости: Rooker, Englund, Trejo, Gellar. George Romero босс!</p>
                        <div class="text-xs text-orange-500/80">Wonder Weapon: Scavenger, V-R11</div>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2 font-bold">Shangri-La</div>
                        <div class="text-xs text-gray-500 mb-2">Джунгли, храм</div>
                        <p class="text-xs text-gray-400 mb-2">Сложнейшая карта. Shrinking zombies, лабиринт.</p>
                        <div class="text-xs text-orange-500/80">Wonder Weapon: 31-79 JGb215</div>
                      </div>

                      <div class="border border-orange-500/30 p-4 bg-black/20 hover:bg-orange-500/5 transition-all">
                        <div class="font-mono text-sm text-orange-500 mb-2 font-bold">Moon</div>
                        <div class="text-xs text-gray-500 mb-2">Луна!</div>
                        <p class="text-xs text-gray-400 mb-2">Эпический финал Aether. No Man's Land, Excavators.</p>
                        <div class="text-xs text-orange-500/80">Wonder Weapon: Wave Gun, QED</div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombies Features -->
                  <div class="border border-orange-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-orange-500 mb-3">
                      <span class="text-orange-600">&gt;</span> КЛЮЧЕВЫЕ МЕХАНИКИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• Pack-a-Punch Machine (улучшение оружия)</li>
                      <li>• Перки: Juggernog, Speed Cola, Quick Revive, Double Tap</li>
                      <li>• Easter Eggs на каждой карте</li>
                      <li>• Ultimis группа: Dempsey, Nikolai, Takeo, Richtofen</li>
                      <li>• Загадочный Samantha и 115 элемент</li>
                    </ul>
                  </div>

                </div>
              </section>

              <!-- Section: DLC -->
              <section :id="sections[6].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-orange-500 mb-4 flex items-center">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-2">{{ sections[6].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops получил 4 крупных DLC пака с новыми мультиплеерными картами и зомби-контентом.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-l-4 border-orange-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-orange-500 font-mono mb-2">FIRST STRIKE</div>
                      <div class="text-xs text-gray-500 mb-2">Февраль 2011</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Ascension Zombies. Первый DLC.</p>
                      <div class="text-xs text-orange-500/80">Карты: Berlin Wall, Discovery, Kowloon, Stadium</div>
                    </div>

                    <div class="border-l-4 border-orange-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-orange-500 font-mono mb-2">ESCALATION</div>
                      <div class="text-xs text-gray-500 mb-2">Май 2011</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Call of the Dead Zombies.</p>
                      <div class="text-xs text-orange-500/80">Карты: Convoy, Hotel, Stockpile, Zoo</div>
                    </div>

                    <div class="border-l-4 border-orange-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-orange-500 font-mono mb-2">ANNIHILATION</div>
                      <div class="text-xs text-gray-500 mb-2">Июнь 2011</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Shangri-La Zombies.</p>
                      <div class="text-xs text-orange-500/80">Карты: Drive-In, Hangar 18, Hazard, Silo</div>
                    </div>

                    <div class="border-l-4 border-orange-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-orange-500 font-mono mb-2">REZURRECTION</div>
                      <div class="text-xs text-gray-500 mb-2">Август 2011</div>
                      <p class="text-sm text-gray-400 mb-2">Moon + все WaW зомби-карты ремастер!</p>
                      <div class="text-xs text-orange-500/80">Zombies: Moon, Nacht, Verrückt, Shi No Numa, Der Riese</div>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/black-ops')"
                class="border-2 border-orange-500/30 hover:border-orange-500 bg-black/40 hover:bg-orange-500/10 p-4 transition-all group h-16 flex items-center"
              >
                <div class="font-mono text-sm text-orange-500 flex items-center w-full">
                  <span class="text-orange-600">&gt;</span>
                  <span class="ml-1">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-orange-500/30 hover:border-orange-500 bg-black/40 hover:bg-orange-500/10 p-4 transition-all group h-16 flex items-center"
              >
                <div class="font-mono text-sm text-orange-500 flex items-center w-full">
                  <span class="text-orange-600">&gt;</span>
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
  { id: 'zombies', title: 'ZOMBIES' },
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
