<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/callofduty2011background.jpeg')"
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
            <span class="text-green-500">MODERN_WARFARE_3</span>
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
                  <span>MODERN WARFARE 3</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-green-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-green-500/90">
                <span class="text-green-600">&gt;</span> YEAR: 2011 | DEVELOPER: Infinity Ward / Sledgehammer Games | PUBLISHER: Activision
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
                    <strong class="text-green-500">Call of Duty: Modern Warfare 3</strong> — эпический финал трилогии Modern Warfare, разработанный совместно Infinity Ward и Sledgehammer Games. Выпущенная в ноябре 2011 года, игра завершает историю капитана Прайса и Task Force 141 в их противостоянии с Владимиром Макаровым.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    MW3 установила новый рекорд, заработав $775 млн за первые 5 дней и став самой быстропродаваемой развлекательной продукцией в истории на момент релиза. Игра представила глобальный конфликт Третьей мировой войны с миссиями в крупнейших городах мира.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-green-500">Дата выхода:</span> 08.11.2011</li>
                        <li><span class="text-green-500">Платформы:</span> PC, PS3, X360, Wii, DS</li>
                        <li><span class="text-green-500">Движок:</span> IW 5.0</li>
                        <li><span class="text-green-500">Режимы:</span> Кампания, Spec Ops, Мультиплеер</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-xs text-green-500 mb-2">
                        <span class="text-green-600">&gt;</span> РЕКОРДЫ И НАГРАДЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• $775 млн за 5 дней (рекорд 2011)</li>
                        <li>• 26.5 млн копий за 2011 год</li>
                        <li>• Лучший мультиплеер (IGN, 2011)</li>
                        <li>• Игра года (номинации)</li>
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
                    События начинаются сразу после MW2. Третья мировая война в полном разгаре, российские войска вторгаются в Европу и США. <strong class="text-green-500">Капитан Прайс</strong>, <strong class="text-green-500">Юрий</strong> и остатки Task Force 141 выслеживают Макарова по всему миру, чтобы остановить конфликт и отомстить за павших товарищей.
                  </p>

                  <!-- Key Characters -->
                  <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="text-xl font-bold text-emerald-500 mb-3 font-mono">
                      <span class="text-emerald-600">&gt;</span> Ключевые персонажи
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Капитан Джон Прайс</div>
                        <div class="text-xs text-gray-400">Главный герой, командир Task Force 141</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Юрий</div>
                        <div class="text-xs text-gray-400">Бывший сподвижник Макарова, новый персонаж</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Владимир Макаров</div>
                        <div class="text-xs text-gray-400">Главный антагонист трилогии</div>
                      </div>
                      <div class="bg-black/40 p-3 rounded">
                        <div class="text-green-500 font-mono text-sm mb-1">Сержант Дерек "Фрост" Уэстбрук</div>
                        <div class="text-xs text-gray-400">Оператор Delta Force</div>
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
                        <li>• Black Tuesday - Вторжение в Нью-Йорк</li>
                        <li>• Hunter Killer - Подводная лодка</li>
                        <li>• Persona Non Grata - Бразильская фавела</li>
                        <li>• Turbulence - Захват самолёта президента</li>
                        <li>• Eye of the Storm - Битва за Берлин</li>
                        <li>• Blood Brothers - Откровение Юрия</li>
                        <li>• Stronghold - Замок в Праге</li>
                        <li>• Dust to Dust - Финальное противостояние</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Global Conflict -->
                  <div class="border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ГЛОБАЛЬНЫЙ КОНФЛИКТ
                    </div>
                    <p class="text-sm text-gray-400 mb-3">Миссии проходят в крупнейших городах мира:</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-xs text-gray-400">
                      <div>• Нью-Йорк, США</div>
                      <div>• Париж, Франция</div>
                      <div>• Лондон, Англия</div>
                      <div>• Берлин, Германия</div>
                      <div>• Гамбург, Германия</div>
                      <div>• Прага, Чехия</div>
                      <div>• Сомали, Африка</div>
                      <div>• Сибирь, Россия</div>
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
                    <strong class="text-green-500">Special Ops</strong> получили масштабное расширение с двумя режимами: Mission Mode и новый режим Survival (волны врагов).
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> MISSION MODE
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 16 миссий различной сложности</li>
                        <li>• Alpha, Bravo, Charlie, Delta секции</li>
                        <li>• Кооператив до 2 игроков</li>
                        <li>• Система звёзд за прохождение</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> SURVIVAL MODE
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Волны врагов на 16 картах</li>
                        <li>• Покупка оружия и экипировки</li>
                        <li>• Авианалёты и поддержка</li>
                        <li>• Таблица лидеров</li>
                      </ul>
                    </div>
                  </div>

                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> ПОПУЛЯРНЫЕ МИССИИ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-400">
                      <div>• Stay Sharp - Боевая подготовка</div>
                      <div>• Mile High Jack - Самолёт</div>
                      <div>• Over Reactor - Реактор</div>
                      <div>• Fire Mission - Артиллерия</div>
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
                    Мультиплеер MW3 сбалансировал систему из MW2, убрав Stopping Power и One Man Army, но добавив новые механики: Strike Packages (3 типа killstreaks) и улучшенную систему перков.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Kill Confirmed</li>
                        <li>• Search & Destroy</li>
                        <li>• Domination</li>
                        <li>• Team Defender</li>
                        <li>• Drop Zone</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> STRIKE PACKAGES
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li><strong>Assault:</strong> UAV, IMS, Predator, Reaper, AC-130</li>
                        <li><strong>Support:</strong> UAV, Ballistic Vests, SAM Turret, Stealth Bomber, EMP</li>
                        <li><strong>Specialist:</strong> Бонусные перки</li>
                      </ul>
                    </div>
                    <div class="border border-green-500/30 p-4 bg-green-500/5">
                      <div class="font-mono text-sm text-green-500 mb-3">
                        <span class="text-green-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Weapon Proficiency</li>
                        <li>• 80 уровней</li>
                        <li>• 10 престижей + Prestige Shop</li>
                        <li>• Elite режим</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Weapon Proficiencies -->
                  <div class="mt-6 border border-green-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-green-500 mb-3">
                      <span class="text-green-600">&gt;</span> WEAPON PROFICIENCIES (НОВОЕ)
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-xs text-gray-400">
                      <div>• Kick - меньше отдачи</div>
                      <div>• Impact - больше урона</div>
                      <div>• Attachments - 2 модификации</div>
                      <div>• Focus - меньше flinch</div>
                      <div>• Range - дальность</div>
                      <div>• Speed - быстрее ADS</div>
                      <div>• Stability - точность</div>
                      <div>• Melee - урон прикладом</div>
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
                    MW3 представляет самый большой арсенал в серии на момент релиза, с возможностью кастомизации через профессиональные навыки оружия.
                  </p>

                  <!-- Popular Weapons -->
                  <div class="border-l-4 border-green-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-emerald-500 mb-4 font-mono">
                      <span class="text-emerald-600">&gt;</span> ПОПУЛЯРНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> ACR 6.8
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Возвращение легенды. Минимальная отдача и высокая точность.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MP7
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">Новое ПП с высокой скорострельностью и большим магазином.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MSR
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Быстрая болтовая винтовка, любимец квикскоуперов.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> TYPE 95
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Трёхочередная винтовка с убийством за один burst.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> PP90M1
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Пистолет-пулемёт</div>
                        <p class="text-xs text-gray-400">ПП с огромным магазином на 64 патрона.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> SPAS-12
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Дробовик</div>
                        <p class="text-xs text-gray-400">Возвращение культового дробовика из MW2.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> FMG9 Akimbo
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Вторичное оружие</div>
                        <p class="text-xs text-gray-400">Парные автоматы во вторичном слоте (до нерфа).</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> MK14
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Штурмовая винтовка</div>
                        <p class="text-xs text-gray-400">Полуавтоматическая винтовка с высоким уроном.</p>
                      </div>

                      <div class="border border-green-500/30 p-4 bg-black/20 hover:bg-green-500/5 transition-all">
                        <div class="font-mono text-sm text-green-500 mb-2">
                          <span class="text-green-600">&gt;</span> L118A
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Снайперская винтовка</div>
                        <p class="text-xs text-gray-400">Британская снайперская винтовка с быстрым прицеливанием.</p>
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
                    MW3 включает разнообразные карты по всему миру, отражающие глобальный масштаб конфликта.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-emerald-500 mb-4">
                      <span class="text-emerald-600">&gt;</span> БАЗОВЫЕ КАРТЫ (16 КАРТ)
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Arkaden</div>
                        <div class="text-xs text-gray-500 text-center">Берлин</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Bakaara</div>
                        <div class="text-xs text-gray-500 text-center">Сомали</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Bootleg</div>
                        <div class="text-xs text-gray-500 text-center">Париж</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Carbon</div>
                        <div class="text-xs text-gray-500 text-center">Париж</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Dome</div>
                        <div class="text-xs text-gray-500 text-center">Маленькая</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Downturn</div>
                        <div class="text-xs text-gray-500 text-center">Город</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Fallen</div>
                        <div class="text-xs text-gray-500 text-center">Париж</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Hardhat</div>
                        <div class="text-xs text-gray-500 text-center">Стройка</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Interchange</div>
                        <div class="text-xs text-gray-500 text-center">Нью-Йорк</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Lockdown</div>
                        <div class="text-xs text-gray-500 text-center">Индия</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Mission</div>
                        <div class="text-xs text-gray-500 text-center">Африка</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Outpost</div>
                        <div class="text-xs text-gray-500 text-center">Заснеженная</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Resistance</div>
                        <div class="text-xs text-gray-500 text-center">Париж</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Seatown</div>
                        <div class="text-xs text-gray-500 text-center">Африка</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Underground</div>
                        <div class="text-xs text-gray-500 text-center">Лондон</div>
                      </div>

                      <div class="border border-green-500/30 p-3 bg-black/20 hover:bg-green-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Village</div>
                        <div class="text-xs text-gray-500 text-center">Африка</div>
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
    name: 'Collection 1',
    date: '20.03.2012',
    description: 'Первая коллекция карт с двумя Spec Ops миссиями',
    content: '5 карт (Liberation, Piazza, Overwatch, Black Box, Negotiator)'
  },
  {
    name: 'Collection 2',
    date: '03.05.2012',
    description: 'Вторая коллекция с Face Off картами',
    content: '5 карт (Sanctuary, Foundation, Oasis, Erosion, Aground)'
  },
  {
    name: 'Collection 3',
    date: '12.06.2012',
    description: 'Третья коллекция с дополнительными миссиями',
    content: '5 карт (Vortex, U-Turn, Intersection, Goldrush, Parish)'
  },
  {
    name: 'Collection 4',
    date: '10.09.2012',
    description: 'Финальная коллекция карт',
    content: '5 карт (Decommission, Off Shore, Gulch, Boardwalk, Terminal)'
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

