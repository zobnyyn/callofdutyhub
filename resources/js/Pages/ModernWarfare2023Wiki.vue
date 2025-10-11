<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/callofduty2023background.jpg')"
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
            <span class="text-green-500">MODERN_WARFARE_III_2023</span>
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
                  <span>MODERN WARFARE III</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-green-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-green-500/90">
                <span class="text-green-600">&gt;</span> YEAR: 2023 | DEVELOPER: Sledgehammer Games | PUBLISHER: Activision
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
                    <strong class="text-green-500">Call of Duty: Modern Warfare III (2023)</strong> — прямое продолжение MWII, разработанное Sledgehammer Games при поддержке Infinity Ward. Игра вышла 10 ноября 2023 года и стала завершающей частью новой трилогии Modern Warfare.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MWIII привносит финал истории Task Force 141 против Владимира Макарова, а также полностью переработанный мультиплеер с возвращением всех 16 классических карт из MW2 (2009), улучшенное движение и новый режим Zombies с открытым миром.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-green-500">Дата выхода:</span> 10.11.2023</li>
                        <li><span class="text-green-500">Платформы:</span> PC, PS4/5, Xbox</li>
                        <li><span class="text-green-500">Движок:</span> IW 9.0</li>
                        <li><span class="text-green-500">Режимы:</span> Кампания, МП, Zombies</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ГЛАВНЫЕ ФИЧИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Все 16 карт из MW2 (2009)</li>
                        <li>• Open World Zombies</li>
                        <li>• Tac-Stance (новая стойка)</li>
                        <li>• Макаров возвращается</li>
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
                    Кампания фокусируется на охоте Task Force 141 за <strong class="text-green-500">Владимиром Макаровым</strong>, легендарным российским террористом. События разворачиваются по всему миру, от России до США, с драматичными последствиями для команды.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Капитан Джон Прайс</div>
                        <div class="text-xs text-gray-400">Командир Task Force 141, одержим поимкой Макарова</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Сержант "Соуп" МакТавиш</div>
                        <div class="text-xs text-gray-400">Ключевой оператор 141, переживает потерю</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Саймон "Гоуст" Райли</div>
                        <div class="text-xs text-gray-400">Легендарный оператор, играет важную роль</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Владимир Макаров</div>
                        <div class="text-xs text-gray-400">Главный антагонист, безжалостный террорист</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Кейт Ласуэлл</div>
                        <div class="text-xs text-gray-400">Офицер CIA, координирует операции</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Юрий Волков</div>
                        <div class="text-xs text-gray-400">Новый персонаж с связью с прошлым Макарова</div>
                      </div>
                    </div>
                  </div>

                  <!-- Key Missions -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Основные миссии
                    </h3>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-green-500 mb-2 text-xs">
                        <span class="text-green-600">&gt;</span> КАМПАНИЯ (Open Combat Missions):
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Operation 627 - Побег из ГУЛАГа</li>
                        <li>• Precious Cargo - Перехват конвоя</li>
                        <li>• Reactor - Диверсия на АЭС</li>
                        <li>• Payload - Поезд с химоружием</li>
                        <li>• Deep Cover - Под прикрытием в России</li>
                        <li>• Passenger - Теракт в самолёте</li>
                        <li>• Crash Site - Выживание после крушения</li>
                        <li>• Flashpoint - Битва на улицах</li>
                        <li>• Trojan Horse - Инфильтрация</li>
                        <li>• Countdown - Финальное противостояние</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Campaign Features -->
                  <div class="border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ КАМПАНИИ
                    </div>
                    <ul class="space-y-2 text-sm text-gray-400">
                      <li>• Open Combat Missions - свобода выбора подхода</li>
                      <li>• Эмоциональная история с шокирующими моментами</li>
                      <li>• Возвращение Макарова из оригинальной MW2</li>
                      <li>• Драматичная концовка с последствиями</li>
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
                    Мультиплеер MWIII возвращает все 16 классических карт из MW2 (2009) при запуске, плюс улучшенное движение с Tac-Stance, обновлённые перки и более быстрый темп игры.
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
                        <li>• Control (новый)</li>
                        <li>• Cutthroat (3v3v3)</li>
                        <li>• War Mode</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 4: UAV</li>
                        <li>• 5: Care Package</li>
                        <li>• 6: SAE</li>
                        <li>• 7: Cruise Missile</li>
                        <li>• 8: Guardian-SC</li>
                        <li>• 10: Wheelson-HS</li>
                        <li>• 12: Juggernaut</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> НОВЫЕ ФИЧИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Tac-Stance (новая стойка)</li>
                        <li>• Slide canceling вернулся</li>
                        <li>• Более быстрое TTK</li>
                        <li>• Классические перки</li>
                        <li>• Aftermarket Parts</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Tac-Stance -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> TAC-STANCE - НОВАЯ МЕХАНИКА
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Новая стойка стрельбы между hip-fire и ADS. Активируется одновременным нажатием ADS + Sprint. Улучшает мобильность при сохранении точности.</p>
                  </div>

                  <!-- Movement Changes -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> УЛУЧШЕННОЕ ДВИЖЕНИЕ
                    </div>
                    <p class="text-sm text-gray-400">Slide canceling вернулся по просьбам игроков. Более быстрый спринт, улучшенный mantling и плавное движение делают геймплей более динамичным.</p>
                  </div>

                  <!-- Aftermarket Parts -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> AFTERMARKET PARTS
                    </div>
                    <p class="text-sm text-gray-400">Новая система модификаций оружия, которая радикально меняет оружие (например, превращает винтовку в DMR). Еженедельные челленджи для разблокировки.</p>
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
                    MWIII наследует всё оружие из MWII и добавляет новое, включая классические пушки из MW2 (2009). Gunsmith 2.0 сохраняется с улучшениями.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> SVA 545
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Новая AR с отличной точностью и контролем отдачи.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MCW
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">ACR возвращается под новым именем. Легендарная винтовка.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Rival-9
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Новый ПП с агрессивным стилем игры.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MTZ-556
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Сбалансированная винтовка для средних дистанций.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Longbow
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Intervention возвращается! Культовая снайперка.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> AMR9
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Быстрый ПП для близких дистанций.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> KV Inhibitor
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Barrett .50 Cal. Максимальная мощь.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> Holger 556
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">G36C возвращается с отличной стабильностью.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> WSP Swarm
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Высочайшая скорострельность среди ПП.</p>
                      </div>
                    </div>
                  </div>

                  <!-- Classic Weapons Return -->
                  <div class="border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ВОЗВРАЩЕНИЕ КЛАССИКИ
                    </div>
                    <p class="text-sm text-gray-400 mb-2">Легендарное оружие из MW2 (2009) вернулось:</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-xs text-gray-400">
                      <div>• ACR (как MCW)</div>
                      <div>• Intervention (как Longbow)</div>
                      <div>• Barrett .50 Cal (как KV Inhibitor)</div>
                      <div>• UMP45 (как Striker 9)</div>
                      <div>• Vector (как Fennec 45)</div>
                      <div>• G36C (как Holger 556)</div>
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
                    MWIII запустилась с <strong class="text-green-500">всеми 16 классическими картами из MW2 (2009)</strong>, полностью переработанными на новом движке.
                  </p>

                  <!-- Classic Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> КЛАССИЧЕСКИЕ КАРТЫ MW2 (2009)
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Afghan</div>
                        <div class="text-xs text-gray-500 text-center">Пустыня</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Derail</div>
                        <div class="text-xs text-gray-500 text-center">Поезд</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Estate</div>
                        <div class="text-xs text-gray-500 text-center">Особняк</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Favela</div>
                        <div class="text-xs text-gray-500 text-center">Трущобы</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Highrise</div>
                        <div class="text-xs text-gray-500 text-center">Небоскрёб</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Invasion</div>
                        <div class="text-xs text-gray-500 text-center">Пригород</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Karachi</div>
                        <div class="text-xs text-gray-500 text-center">Город</div>
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
                        <div class="text-xs text-gray-500 text-center">Культовая</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Scrapyard</div>
                        <div class="text-xs text-gray-500 text-center">Свалка</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Skidrow</div>
                        <div class="text-xs text-gray-500 text-center">Городская</div>
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
                        <div class="text-xs text-gray-500 text-center">Тоннель</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Wasteland</div>
                        <div class="text-xs text-gray-500 text-center">Поле боя</div>
                      </div>
                    </div>
                  </div>

                  <!-- New Maps -->
                  <div class="mb-6">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> НОВЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">6 Star (Launch)</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Rio (Season 1)</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Meat (Season 1)</div>
                      <div class="border border-green-500/30 p-2 bg-black/20 text-center text-gray-400">Creek (Season 2)</div>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Zombies -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-green-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-green-500 mb-4 flex items-center">
                  <span class="text-green-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-green-500">Modern Warfare Zombies (MWZ)</strong> — революционный PvE режим с открытым миром, объединяющий элементы DMZ и традиционных зомби. Действие на карте Urzikstan.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ГЕЙМПЛЕЙ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Открытый мир Urzikstan</li>
                        <li>• Extraction формат</li>
                        <li>• 3 зоны сложности (Low/Mid/High Threat)</li>
                        <li>• Контракты и миссии</li>
                        <li>• Постоянное сохранение оружия</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Классические перки возвращаются</li>
                        <li>• Pack-a-Punch система</li>
                        <li>• Wunderfizz машины</li>
                        <li>• Специальные боссы</li>
                        <li>• Темный эфир (Dark Aether)</li>
                      </ul>
                    </div>
                  </div>

                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ZONE THREAT LEVELS
                    </div>
                    <div class="space-y-2 text-sm text-gray-400">
                      <p><strong class="text-green-500">Low Threat (зелёная):</strong> Базовые зомби, легко начать</p>
                      <p><strong class="text-yellow-500">Medium Threat (жёлтая):</strong> Усиленные враги, лучший лут</p>
                      <p><strong class="text-red-500">High Threat (красная):</strong> Экстремальная сложность, эксклюзивные награды</p>
                    </div>
                  </div>

                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ACT MISSIONS
                    </div>
                    <p class="text-sm text-gray-400">Сюжетные миссии, раскрывающие историю Dark Aether и связь с Operation Deadbolt. Включают boss-файты и уникальные награды.</p>
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
                    MWIII продолжает модель живой службы с сезонными обновлениями контента для мультиплеера, зомби и интеграции с Warzone.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 1</div>
                      <p class="text-sm text-gray-400">Новые карты Shoot House, Shipment. Новый оператор Makarov. Zombies Act 2. Warzone интеграция.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 2</div>
                      <p class="text-sm text-gray-400">Карты Dome, Creek. Ranked Play запуск. Новое zombies Act. Ground War расширение.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">СЕЗОН 3</div>
                      <p class="text-sm text-gray-400">Новые операторы и оружие. Zombies финал Dark Aether. Warzone events.</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 bg-black/20 p-4">
                      <div class="text-sm text-green-500 font-mono mb-2">БУДУЩЕЕ</div>
                      <p class="text-sm text-gray-400">Продолжение поддержки через 2024 год с новым контентом и интеграцией с Black Ops 6.</p>
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

