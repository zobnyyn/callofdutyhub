<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/blackops2background.jpg')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #3b82f6 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Navigation Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-blue-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-blue-500 transition-colors">
              <span class="text-blue-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-blue-600">/</span>
            <span class="text-blue-500">BLACK_OPS_II_2012</span>
          </div>
          <div class="h-px bg-gradient-to-r from-blue-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-sky-600 to-blue-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>BLACK OPS II</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-blue-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-blue-500/90">
                <span class="text-blue-600">&gt;</span> YEAR: 2012 | DEVELOPER: Treyarch | PUBLISHER: Activision
              </div>
            </div>
          </div>
        </div>

        <!-- Wiki Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

          <!-- Sidebar Navigation -->
          <aside class="lg:col-span-3">
            <div class="border-2 border-blue-500/20 bg-black/40 backdrop-blur-sm p-4 sticky top-24">
              <div class="font-mono text-xs text-blue-500 mb-3">
                <span class="text-blue-600">&gt;</span> СОДЕРЖАНИЕ
              </div>
              <div class="h-px bg-gradient-to-r from-blue-500/50 to-transparent mb-4"></div>

              <nav class="space-y-2 text-sm font-mono">
                <a
                  v-for="section in sections"
                  :key="section.id"
                  @click.prevent="scrollToSection(section.id)"
                  :class="[
                    'block py-2 px-3 border-l-2 transition-all cursor-pointer',
                    activeSection === section.id
                      ? 'border-blue-500 text-blue-500 bg-blue-500/5'
                      : 'border-blue-500/20 text-gray-400 hover:border-blue-500/50 hover:text-blue-500/80'
                  ]"
                >
                  <span class="text-blue-600">&gt;</span> {{ section.title }}
                </a>
              </nav>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="lg:col-span-9">
            <div class="border-2 border-blue-500/20 bg-black/60 backdrop-blur-sm">

              <!-- Section: Overview -->
              <section :id="sections[0].id" class="p-6 md:p-8 border-b-2 border-blue-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[0].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-blue-500">Call of Duty: Black Ops II</strong> — революционный шутер от Treyarch, выпущенный 13 ноября 2012 года. Игра стала первой в серии с действием в будущем (2025 год) наряду с событиями 80-х годов, заработав более $500 млн за первые 24 часа и $1 млрд за 15 дней.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Black Ops II представляет инновационную нелинейную кампанию с Strike Force миссиями и множественными концовками, переработанный мультиплеер с Pick 10 системой и расширенный Zombies с двумя сюжетными линиями (Tranzit и Origins).
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-blue-500/30 p-4 bg-blue-500/5">
                      <div class="font-mono text-xs text-blue-500 mb-2">
                        <span class="text-blue-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-blue-500">Дата выхода:</span> 13.11.2012</li>
                        <li><span class="text-blue-500">Платформы:</span> PC, PS3, Xbox 360, Wii U</li>
                        <li><span class="text-blue-500">Движок:</span> IW 3.0 (улучшенный)</li>
                        <li><span class="text-blue-500">Режимы:</span> Кампания, МП, Zombies</li>
                      </ul>
                    </div>
                    <div class="border border-blue-500/30 p-4 bg-blue-500/5">
                      <div class="font-mono text-xs text-blue-500 mb-2">
                        <span class="text-blue-600">&gt;</span> ИННОВАЦИИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Нелинейная кампания</li>
                        <li>• Pick 10 система</li>
                        <li>• League Play (ranked)</li>
                        <li>• Livestreaming поддержка</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaign -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-blue-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <p class="text-gray-300 leading-relaxed">
                    Революционная кампания переключается между двумя временными периодами: 1980-е годы (Холодная война) с <strong class="text-blue-500">Алексом Мэйсоном</strong> и 2025 год с его сыном <strong class="text-blue-500">Дэвидом Мэйсоном</strong>. Главный антагонист — <strong class="text-blue-500">Рауль Менендес</strong>, террорист, жаждущий мести и стремящийся вызвать глобальный кибернетический хаос.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-blue-500 pl-4">
                    <h3 class="text-xl font-bold text-sky-500 mb-3 font-mono">
                      <span class="text-sky-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-blue-500 font-mono text-sm mb-1">Дэвид "Section" Мэйсон</div>
                        <div class="text-xs text-gray-400">Протагонист 2025, сын Алекса Мэйсона</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-blue-500 font-mono text-sm mb-1">Алекс Мэйсон</div>
                        <div class="text-xs text-gray-400">Протагонист 80-х, ветеран BO1</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-blue-500 font-mono text-sm mb-1">Рауль Менендес</div>
                        <div class="text-xs text-gray-400">Главный антагонист, лидер Cordis Die</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-blue-500 font-mono text-sm mb-1">Фрэнк Вудс</div>
                        <div class="text-xs text-gray-400">Ветеран, наставник Section</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-blue-500 font-mono text-sm mb-1">Джейсон Хадсон</div>
                        <div class="text-xs text-gray-400">Офицер ЦРУ в 80-х</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-blue-500 font-mono text-sm mb-1">Майк Харпер</div>
                        <div class="text-xs text-gray-400">Оператор SEAL Team Six</div>
                      </div>
                    </div>
                  </div>

                  <!-- Key Missions -->
                  <div class="border-l-4 border-blue-500 pl-4">
                    <h3 class="text-xl font-bold text-sky-500 mb-3 font-mono">
                      <span class="text-sky-600">&gt;</span> Основные миссии
                    </h3>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-blue-500 mb-2 text-xs">
                        <span class="text-blue-600">&gt;</span> 1980-е ГОДЫ:
                      </div>
                      <ul class="space-y-1 text-gray-400 mb-3">
                        <li>• Pyrrhic Victory - Ангола 1986</li>
                        <li>• Old Wounds - Афганистан 1986</li>
                        <li>• Time and Fate - Каймановы острова 1989</li>
                        <li>• Suffer With Me - Никарагуа 1989</li>
                      </ul>
                      <div class="text-blue-500 mb-2 text-xs">
                        <span class="text-blue-600">&gt;</span> 2025 ГОД:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Celerium - Мьянма, дрон атака</li>
                        <li>• Fallen Angel - Лос-Анджелес под атакой</li>
                        <li>• Karma - Ночной клуб в Пакистане</li>
                        <li>• Achilles' Veil - Йемен, маскировка</li>
                        <li>• Odysseus - USS Obama под контролем</li>
                        <li>• Cordis Die - Финал (множественные концовки)</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Strike Force -->
                  <div class="border border-blue-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-blue-500 mb-3">
                      <span class="text-blue-600">&gt;</span> STRIKE FORCE МИССИИ
                    </div>
                    <p class="text-sm text-gray-400 mb-2">Опциональные RTS-style миссии, влияющие на сюжет. Управление дронами, солдатами. Провал = постоянные последствия.</p>
                    <ul class="space-y-1 text-xs text-gray-400">
                      <li>• F.O.B. Spectre - Защита базы</li>
                      <li>• I.E.D. - Обезвреживание бомб</li>
                      <li>• Second Chance - Спасение</li>
                      <li>• Dispatch - Перехват конвоя</li>
                    </ul>
                  </div>

                  <!-- Multiple Endings -->
                  <div class="border border-blue-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-blue-500 mb-3">
                      <span class="text-blue-600">&gt;</span> МНОЖЕСТВЕННЫЕ КОНЦОВКИ
                    </div>
                    <p class="text-sm text-gray-400">Ваши действия определяют судьбу персонажей и мира. Может выжить или погибнуть: Алекс, Харпер, Karma, Менендес. 4 основных концовки!</p>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-blue-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Мультиплеер BO2 революционизирован системой Pick 10 и League Play ranked режимом, сделавшим игру киберспортивной классикой.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-blue-500/30 p-4 bg-blue-500/5">
                      <div class="font-mono text-sm text-blue-500 mb-3">
                        <span class="text-blue-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Domination</li>
                        <li>• Search & Destroy</li>
                        <li>• Hardpoint (новый!)</li>
                        <li>• League Play (ranked)</li>
                        <li>• Multi-Team modes</li>
                        <li>• Party Games</li>
                      </ul>
                    </div>
                    <div class="border border-blue-500/30 p-4 bg-blue-500/5">
                      <div class="font-mono text-sm text-blue-500 mb-3">
                        <span class="text-blue-600">&gt;</span> SCORESTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• UAV (375)</li>
                        <li>• Hunter Killer (400)</li>
                        <li>• Counter-UAV (450)</li>
                        <li>• Lightning Strike (550)</li>
                        <li>• Hellstorm Missile (600)</li>
                        <li>• VTOL Warship (900)</li>
                        <li>• Swarm (1100)</li>
                      </ul>
                    </div>
                    <div class="border border-blue-500/30 p-4 bg-blue-500/5">
                      <div class="font-mono text-sm text-blue-500 mb-3">
                        <span class="text-blue-600">&gt;</span> НОВЫЕ ФИЧИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Pick 10 система</li>
                        <li>• Scorestreaks (не kills!)</li>
                        <li>• League Play</li>
                        <li>• CODcaster режим</li>
                        <li>• Wildcards</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Pick 10 System -->
                  <div class="mt-6 border border-blue-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-blue-500 mb-3">
                      <span class="text-blue-600">&gt;</span> PICK 10 - РЕВОЛЮЦИЯ В CREATE-A-CLASS
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Полная свобода кастомизации класса с 10 слотами. Распределяй их как хочешь между оружием, перками, гранатами. Wildcards открывают дополнительные возможности.</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-xs text-gray-400">
                      <div>• Основное оружие + модификации</div>
                      <div>• Вторичное оружие</div>
                      <div>• Летальная/Тактическая граната</div>
                      <div>• 3 перка (по 1 из каждой категории)</div>
                      <div>• Wildcards для экстра слотов</div>
                      <div>• Можно отказаться от всего для 6 перков!</div>
                    </div>
                  </div>

                  <!-- League Play -->
                  <div class="mt-6 border border-blue-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-blue-500 mb-3">
                      <span class="text-blue-600">&gt;</span> LEAGUE PLAY - RANKED РЕЖИМ
                    </div>
                    <p class="text-sm text-gray-400">Первый настоящий ranked в COD! Деления: Iron, Bronze, Silver, Gold, Platinum, Master. Правила как в MLG. Сделал BO2 киберспортом.</p>
                  </div>

                </div>
              </section>

              <!-- Section: Weapons -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-blue-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO2 представляет футуристическое оружие 2025 года с продвинутыми модификациями и технологиями.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-blue-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-sky-500 mb-4 font-mono">
                      <span class="text-sky-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> MSMC
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Мета ПП. Быстрая мобильность, отличный урон.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> AN-94
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">2-round burst при полном авто. Имба в League Play.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> M8A1
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">4-round burst. Favourite профессионалов.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> PDW-57
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Огромный магазин на 50 патронов.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> DSR 50
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Болтовка с огромным уроном. Для квикскопов.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> FAL OSW
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Semi-auto с высоким уроном. Select Fire = имба.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> Ballista
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Быстрый ADS. Идеальна для агрессии.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> Skorpion EVO
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Высочайшая скорострельность среди ПП.</p>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2">
                          <span class="text-blue-600">&gt;</span> HAMR
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пулемёт</div>
                        <p class="text-xs text-gray-400">Универсальный ПК с низкой отдачей.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Maps -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-blue-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO2 включает 14 базовых карт с футуристическими и современными локациями.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-sky-500 mb-4">
                      <span class="text-sky-600">&gt;</span> БАЗОВЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Aftermath</div>
                        <div class="text-xs text-gray-500 text-center">LA разрушен</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Cargo</div>
                        <div class="text-xs text-gray-500 text-center">Сингапур</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Carrier</div>
                        <div class="text-xs text-gray-500 text-center">Авианосец</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Drone</div>
                        <div class="text-xs text-gray-500 text-center">Мьянма</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Express</div>
                        <div class="text-xs text-gray-500 text-center">Стамбул</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Hijacked</div>
                        <div class="text-xs text-gray-500 text-center">Яхта</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Meltdown</div>
                        <div class="text-xs text-gray-500 text-center">Пакистан</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Overflow</div>
                        <div class="text-xs text-gray-500 text-center">Плотина</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Plaza</div>
                        <div class="text-xs text-gray-500 text-center">Каймановы о-ва</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Raid</div>
                        <div class="text-xs text-gray-500 text-center">Голливуд</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Slums</div>
                        <div class="text-xs text-gray-500 text-center">Панама</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Standoff</div>
                        <div class="text-xs text-gray-500 text-center">Мьянма</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Turbine</div>
                        <div class="text-xs text-gray-500 text-center">Йемен</div>
                      </div>

                      <div class="border border-blue-500/30 p-3 bg-black/20 hover:bg-blue-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Yemen</div>
                        <div class="text-xs text-gray-500 text-center">Йемен</div>
                      </div>
                    </div>
                  </div>

                  <!-- Popular Maps Highlight -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border border-blue-500/50 p-4 bg-blue-500/10">
                      <div class="font-mono text-sm text-blue-500 mb-2 font-bold">
                        <span class="text-blue-600">&gt;</span> RAID
                      </div>
                      <p class="text-sm text-gray-400">Голливудский особняк. Стала легендарной competitive картой и вернулась в BO3, BO4, BOCW.</p>
                    </div>
                    <div class="border border-blue-500/50 p-4 bg-blue-500/10">
                      <div class="font-mono text-sm text-blue-500 mb-2 font-bold">
                        <span class="text-blue-600">&gt;</span> STANDOFF
                      </div>
                      <p class="text-sm text-gray-400">Сбалансированная средняя карта. MLG favourite, вернулась в BO4.</p>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-blue-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO2 Zombies представляет революционные изменения: открытый мир Tranzit, Grief режим PvP и продолжение Aether storyline с Origins.
                  </p>

                  <!-- Zombies Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-sky-500 mb-4">
                      <span class="text-sky-600">&gt;</span> КАРТЫ ЗОМБИ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2 font-bold">Tranzit</div>
                        <div class="text-xs text-gray-500 mb-2">Открытый мир, автобус</div>
                        <p class="text-xs text-gray-400 mb-2">Революционная карта с путешествием на автобусе между локациями. Lava, Denizens, туман.</p>
                        <div class="text-xs text-blue-500/80">Wonder Weapon: Jet Gun</div>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2 font-bold">Nuketown Zombies</div>
                        <div class="text-xs text-gray-500 mb-2">Nuketown, 60-е годы</div>
                        <p class="text-xs text-gray-400 mb-2">Chaotic маленькая карта. Быстрый темп, Perks падают с неба.</p>
                        <div class="text-xs text-blue-500/80">Бонусная карта</div>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2 font-bold">Die Rise</div>
                        <div class="text-xs text-gray-500 mb-2">Китай, небоскрёбы</div>
                        <p class="text-xs text-gray-400 mb-2">Вертикальная карта с лифтами. Jumping Jacks враги. Тяжёлая навигация.</p>
                        <div class="text-xs text-blue-500/80">Wonder Weapon: Sliquifier</div>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2 font-bold">Mob of the Dead</div>
                        <div class="text-xs text-gray-500 mb-2">Алькатрас, 1933</div>
                        <p class="text-xs text-gray-400 mb-2">ЛУЧШАЯ КАРТА BO2! Мафиози, Afterlife механика. Невероятный сюжет.</p>
                        <div class="text-xs text-blue-500/80">Wonder Weapon: Blundergat, Acid Gat</div>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2 font-bold">Buried</div>
                        <div class="text-xs text-gray-500 mb-2">Дикий Запад, шахта</div>
                        <p class="text-xs text-gray-400 mb-2">Подземный город. Arthur гигант-помощник. Банк и оружейная система.</p>
                        <div class="text-xs text-blue-500/80">Wonder Weapon: Paralyzer</div>
                      </div>

                      <div class="border border-blue-500/30 p-4 bg-black/20 hover:bg-blue-500/5 transition-all">
                        <div class="font-mono text-sm text-blue-500 mb-2 font-bold">Origins</div>
                        <div class="text-xs text-gray-500 mb-2">Франция, WWI</div>
                        <p class="text-xs text-gray-400 mb-2">ЭПИЧЕСКИЙ ФИНАЛ! Начало истории. Primis crew. Роботы-гиганты, staffs.</p>
                        <div class="text-xs text-blue-500/80">Wonder Weapon: 4 Elemental Staffs</div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombies Modes -->
                  <div class="border border-blue-500/30 p-4 bg-black/20 mb-6">
                    <div class="font-mono text-sm text-blue-500 mb-3">
                      <span class="text-blue-600">&gt;</span> НОВЫЕ РЕЖИМЫ ЗОМБИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li><strong class="text-blue-500">Tranzit:</strong> Открытый мир с путешествием на автобусе</li>
                      <li><strong class="text-blue-500">Survival:</strong> Классический режим на частях Tranzit</li>
                      <li><strong class="text-blue-500">Grief:</strong> 4v4 PvP зомби! Мешайте врагам</li>
                      <li><strong class="text-blue-500">Turned:</strong> 1 человек против зомби-игроков</li>
                    </ul>
                  </div>

                  <!-- Origins Highlight -->
                  <div class="border border-blue-500/50 p-4 bg-blue-500/10">
                    <div class="font-mono text-sm text-blue-500 mb-2 font-bold">
                      <span class="text-blue-600">&gt;</span> ORIGINS - ЛЕГЕНДАРНАЯ КАРТА
                    </div>
                    <p class="text-sm text-gray-400 mb-2">Origins считается одной из лучших зомби-карт всех времён. Показывает начало истории Primis (молодые версии героев). 4 элементальных staffs, роботы-гиганты, невероятный Easter Egg с шокирующей концовкой.</p>
                    <p class="text-xs text-blue-500/80">Staffs: Ice, Fire, Lightning, Wind</p>
                  </div>

                </div>
              </section>

              <!-- Section: DLC -->
              <section :id="sections[6].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-blue-500 mb-4 flex items-center">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-2">{{ sections[6].title }}</span>
                </h2>
                <div class="space-y-4">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    BO2 получил 4 крупных DLC пака, каждый с новыми мультиплеерными картами и зомби-контентом.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-l-4 border-blue-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-blue-500 font-mono mb-2">REVOLUTION</div>
                      <div class="text-xs text-gray-500 mb-2">Январь 2013</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Die Rise Zombies. Peacekeeper оружие.</p>
                      <div class="text-xs text-blue-500/80">Карты: Downhill, Hydro, Mirage, Grind</div>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-blue-500 font-mono mb-2">UPRISING</div>
                      <div class="text-xs text-gray-500 mb-2">Апрель 2013</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Mob of the Dead. Studio ремейк.</p>
                      <div class="text-xs text-blue-500/80">Карты: Encore, Magma, Studio, Vertigo</div>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-blue-500 font-mono mb-2">VENGEANCE</div>
                      <div class="text-xs text-gray-500 mb-2">Июль 2013</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Buried Zombies.</p>
                      <div class="text-xs text-blue-500/80">Карты: Cove, Detour, Rush, Uplink</div>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-blue-500 font-mono mb-2">APOCALYPSE</div>
                      <div class="text-xs text-gray-500 mb-2">Август 2013</div>
                      <p class="text-sm text-gray-400 mb-2">4 MP карты + Origins. Pod ремейк из WaW!</p>
                      <div class="text-xs text-blue-500/80">Карты: Dig, Frost, Pod, Takeoff</div>
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/black-ops-2')"
                class="border-2 border-blue-500/30 hover:border-blue-500 bg-black/40 hover:bg-blue-500/10 p-4 transition-all group h-16 flex items-center"
              >
                <div class="font-mono text-sm text-blue-500 flex items-center w-full">
                  <span class="text-blue-600">&gt;</span>
                  <span class="ml-1">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-blue-500/30 hover:border-blue-500 bg-black/40 hover:bg-blue-500/10 p-4 transition-all group h-16 flex items-center"
              >
                <div class="font-mono text-sm text-blue-500 flex items-center w-full">
                  <span class="text-blue-600">&gt;</span>
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
  text-shadow: 0 0 10px rgba(59, 130, 246, 0.5),
               0 0 20px rgba(59, 130, 246, 0.3),
               0 0 30px rgba(59, 130, 246, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
