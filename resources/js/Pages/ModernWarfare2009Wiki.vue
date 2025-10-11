<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/callofduty2009background.jpg')"
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
            <span class="text-green-500">MODERN_WARFARE_2</span>
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
                  <span>MODERN WARFARE 2</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-green-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-green-500/90">
                <span class="text-green-600">&gt;</span> YEAR: 2009 | DEVELOPER: Infinity Ward | PUBLISHER: Activision
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
                    <strong class="text-green-500">Call of Duty: Modern Warfare 2</strong> — прямое продолжение революционного COD4, выпущенное в ноябре 2009 года. Игра побила все рекорды продаж, став самой быстропродаваемой развлекательной продукцией в истории на момент релиза.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW2 довела до совершенства геймплейную формулу предшественника, добавив больше оружия, перков, killstreaks и спецопераций. Игра известна своей интенсивной кампанией, спорной миссией "No Russian" и невероятно затягивающим мультиплеером.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-green-500">Дата выхода:</span> 10.11.2009</li>
                        <li><span class="text-green-500">Платформы:</span> PC, PS3, X360, Mac</li>
                        <li><span class="text-green-500">Движок:</span> IW 4.0</li>
                        <li><span class="text-green-500">Режимы:</span> Кампания, Спецоперации, Мультиплеер</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> РЕКОРДЫ И НАГРАДЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• $550 млн за 5 дней (рекорд 2009)</li>
                        <li>• Игра года (множество изданий)</li>
                        <li>• Лучший мультиплеер (IGN, 2009)</li>
                        <li>• 25+ миллионов копий продано</li>
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
                    События разворачиваются через 5 лет после первой части. Российские ультранационалисты под командованием <strong class="text-green-500">Владимира Макарова</strong> развязывают Третью мировую войну. Task Force 141 во главе с капитаном Прайсом и сержантом "Соуп" МакТавишем пытаются остановить конфликт.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Капитан "Соуп" МакТавиш</div>
                        <div class="text-xs text-gray-400">Главный герой, член Task Force 141</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Капитан Джон Прайс</div>
                        <div class="text-xs text-gray-400">Легендарный командир SAS</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Генерал Шепард</div>
                        <div class="text-xs text-gray-400">Командующий американскими силами</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Владимир Макаров</div>
                        <div class="text-xs text-gray-400">Главный антагонист</div>
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
                        <li>• S.S.D.D. - Обучающая миссия</li>
                        <li>• No Russian - Спорная миссия в аэропорту</li>
                        <li>• Takedown - Захват фавел в Бразилии</li>
                        <li>• The Gulag - Освобождение Прайса</li>
                        <li>• Of Their Own Accord - Защита Вашингтона</li>
                        <li>• Whiskey Hotel - Штурм Белого дома</li>
                        <li>• Loose Ends - Предательство Шепарда</li>
                        <li>• Endgame - Финальное противостояние</li>
                      </ul>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Spec Ops -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-green-500">Special Ops</strong> — кооперативный режим на 2 игроков с 23 миссиями различной сложности. Миссии разделены на категории по сложности (от 1 до 3 звезд).
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> КАТЕГОРИИ МИССИЙ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Alpha - Проникновение и штурм</li>
                        <li>• Bravo - Защита и выживание</li>
                        <li>• Charlie - Снайперские миссии</li>
                        <li>• Delta - Транспортные миссии</li>
                        <li>• Echo - Специальные задания</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ПОПУЛЯРНЫЕ МИССИИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• The Pit - Скоростной забег</li>
                        <li>• Breach & Clear - Взлом и зачистка</li>
                        <li>• Body Count - Уничтожить 40 врагов</li>
                        <li>• Armor Piercing - Бронетехника</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Мультиплеер MW2 считается одним из лучших в серии. Расширенная система killstreaks, которые теперь могут комбоироваться, создала невероятно динамичный геймплей.
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
                        <li>• Demolition</li>
                        <li>• Ground War</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 3: UAV / Care Package</li>
                        <li>• 4: Counter-UAV / Predator</li>
                        <li>• 5: Sentry Gun / Airstrike</li>
                        <li>• 7: Harrier / Attack Heli</li>
                        <li>• 9: Emergency Airdrop</li>
                        <li>• 11: Chopper Gunner / AC-130</li>
                        <li>• 25: Tactical Nuke</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Deathstreaks (помощь проигрывающим)</li>
                        <li>• Pro перки (улучшенные)</li>
                        <li>• Титулы и эмблемы</li>
                        <li>• 70 уровней + 10 престижей</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Weapons -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW2 расширила арсенал, добавив множество нового оружия и модификаций, включая подствольные гранатометы, глушители и акимбо.
                  </p>

                  <!-- Assault Rifles -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> ACR
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Почти нулевая отдача. Одна из лучших винтовок в игре.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> UMP45
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемет</div>
                        <p class="text-xs text-gray-400">Высокий урон и точность для ПП. Очень популярен.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Intervention
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Культовая снайперка. Любимец трикшотеров.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> SCAR-H
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Высокий урон, умеренная отдача. Сбалансированное оружие.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Model 1887 Akimbo
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Дробовик (до патча)</div>
                        <p class="text-xs text-gray-400">Легендарно имбовое оружие до нерфа. Снайперский дробовик.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Barrett .50cal
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Полуавтоматическая .50 калибра. Максимальная мощь.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> SPAS-12
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Дробовик</div>
                        <p class="text-xs text-gray-400">Мощный помповый дробовик с большим разбросом.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> TAR-21
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Буллпап с высокой скорострельностью и уроном.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Vector
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемет</div>
                        <p class="text-xs text-gray-400">Самая высокая скорострельность среди ПП.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Maps -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW2 включает разнообразные карты от небольших CQB арен до больших открытых пространств.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> БАЗОВЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Afghan</div>
                        <div class="text-xs text-gray-500 text-center">Афганистан</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Derail</div>
                        <div class="text-xs text-gray-500 text-center">Снежная</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Estate</div>
                        <div class="text-xs text-gray-500 text-center">Особняк</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Favela</div>
                        <div class="text-xs text-gray-500 text-center">Бразилия</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Highrise</div>
                        <div class="text-xs text-gray-500 text-center">Небоскрёб</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Invasion</div>
                        <div class="text-xs text-gray-500 text-center">Город</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Karachi</div>
                        <div class="text-xs text-gray-500 text-center">Пакистан</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Quarry</div>
                        <div class="text-xs text-gray-500 text-center">Карьер</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Rundown</div>
                        <div class="text-xs text-gray-500 text-center">Джунгли</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Rust</div>
                        <div class="text-xs text-gray-500 text-center">Нефтевышка</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Scrapyard</div>
                        <div class="text-xs text-gray-500 text-center">Свалка</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Skidrow</div>
                        <div class="text-xs text-gray-500 text-center">Трущобы</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Sub Base</div>
                        <div class="text-xs text-gray-500 text-center">База</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Terminal</div>
                        <div class="text-xs text-gray-500 text-center">Аэропорт</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Underpass</div>
                        <div class="text-xs text-gray-500 text-center">Путепровод</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Wasteland</div>
                        <div class="text-xs text-gray-500 text-center">Пустошь</div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: DLC -->
              <section :id="sections[6].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[6].title }}</span>
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
  { id: 'specops', title: 'СПЕЦОПЕРАЦИИ' },
  { id: 'multiplayer', title: 'МУЛЬТИПЛЕЕР' },
  { id: 'weapons', title: 'ОРУЖИЕ' },
  { id: 'maps', title: 'КАРТЫ' },
  { id: 'dlc', title: 'DLC' },
];

const dlcPacks = [
  {
    name: 'Stimulus Package',
    date: '30.03.2010',
    description: 'Первый набор карт, включая ремейки из COD4',
    content: '5 карт (Bailout, Crash, Overgrown, Salvage, Storm)'
  },
  {
    name: 'Resurgence Pack',
    date: '03.06.2010',
    description: 'Второй и финальный набор карт',
    content: '5 карт (Carnival, Fuel, Strike, Trailer Park, Vacant)'
  }
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
