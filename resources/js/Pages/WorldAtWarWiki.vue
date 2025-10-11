<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image with overlay -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-40"
        style="background-image: url('/images/worlaatwarbackgound.png')"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #dc2626 0px, transparent 1px, transparent 2px);"></div>

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
            <span class="text-red-500">WORLD_AT_WAR</span>
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-600 to-red-700 terminal-glow">
                  CALL OF DUTY:
                </span>
                <span class="flex items-center text-white mt-2">
                  <span>WORLD AT WAR</span>
                  <span class="inline-block w-3 h-10 md:h-16 bg-red-500 ml-3 cursor-blink"></span>
                </span>
              </h1>

              <div class="mt-4 font-mono text-sm md:text-base text-red-500/90">
                <span class="text-red-600">&gt;</span> YEAR: 2008 | DEVELOPER: Treyarch | PUBLISHER: Activision
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
                    <strong class="text-red-500">Call of Duty: World at War</strong> — шутер от первого лица, разработанный компанией Treyarch и изданный Activision. Игра была выпущена в ноябре 2008 года для ПК, PlayStation 3, Xbox 360, Wii и Nintendo DS.
                  </p>
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Действие игры происходит во время Второй мировой войны, фокусируясь на событиях на Тихоокеанском театре военных действий и Восточном фронте. World at War стала первой игрой серии Call of Duty, в которой появился режим Nazi Zombies.
                  </p>

                  <!-- Info Box -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-xs text-red-500 mb-2">
                        <span class="text-red-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300 font-mono">
                        <li><span class="text-red-500">Дата выхода:</span> 11.11.2008</li>
                        <li><span class="text-red-500">Платформы:</span> PC, PS3, X360, Wii, DS</li>
                        <li><span class="text-red-500">Движок:</span> IW 3.0</li>
                        <li><span class="text-red-500">Режимы:</span> Одиночная, Мультиплеер, Кооператив, Zombies</li>
                      </ul>
                    </div>
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-xs text-red-500 mb-2">
                        <span class="text-red-600">&gt;</span> НАГРАДЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Лучшая звуковая работа (IGN, 2008)</li>
                        <li>• Лучший мультиплеер (GameSpot, 2008)</li>
                        <li>• Игра года (номинация)</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Campaigns -->
              <section :id="sections[1].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[1].title }}</span>
                </h2>
                <div class="space-y-6">

                  <!-- American Campaign -->
                  <div class="border-l-4 border-red-500 pl-4">
                    <h3 class="text-xl font-bold text-orange-500 mb-3 font-mono">
                      <span class="text-orange-600">&gt;</span> Американская кампания
                    </h3>
                    <p class="text-gray-300 leading-relaxed mb-3">
                      Игрок управляет рядовым морской пехоты США <strong class="text-red-500">С. Миллером</strong>, участвующим в боях на Тихоокеанском театре военных действий, включая битвы на островах Маккин, Пелелиу и Окинава.
                    </p>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-red-500 mb-2 text-xs">
                        <span class="text-red-600">&gt;</span> КЛЮЧЕВЫЕ МИССИИ:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Semper Fi</li>
                        <li>• Little Resistance</li>
                        <li>• Hard Landing</li>
                        <li>• Breaking Point</li>
                        <li>• Heart of the Reich</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Soviet Campaign -->
                  <div class="border-l-4 border-red-500 pl-4">
                    <h3 class="text-xl font-bold text-orange-500 mb-3 font-mono">
                      <span class="text-orange-600">&gt;</span> Советская кампания
                    </h3>
                    <p class="text-gray-300 leading-relaxed mb-3">
                      Игрок выступает в роли красноармейца <strong class="text-red-500">Дмитрия Петренко</strong>, сражающегося на Восточном фронте от Сталинграда до штурма Берлина под командованием сержанта Виктора Резнова.
                    </p>
                    <div class="bg-black/40 p-4 rounded font-mono text-sm">
                      <div class="text-red-500 mb-2 text-xs">
                        <span class="text-red-600">&gt;</span> КЛЮЧЕВЫЕ МИССИИ:
                      </div>
                      <ul class="space-y-1 text-gray-400">
                        <li>• Vendetta</li>
                        <li>• Their Land, Their Blood</li>
                        <li>• Burn 'em Out</li>
                        <li>• Relentless</li>
                        <li>• Downfall</li>
                      </ul>
                    </div>
                  </div>

                </div>
              </section>

              <!-- Section: Multiplayer -->
              <section :id="sections[2].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[2].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Мультиплеер World at War сохранил систему перков и вызовов из Modern Warfare, добавив новые элементы геймплея, включая танки, атаки собак и артиллерию.
                  </p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-sm text-red-500 mb-3">
                        <span class="text-red-600">&gt;</span> РЕЖИМЫ ИГРЫ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Team Deathmatch</li>
                        <li>• Free-for-All</li>
                        <li>• Search & Destroy</li>
                        <li>• Domination</li>
                        <li>• War</li>
                        <li>• Capture the Flag</li>
                      </ul>
                    </div>
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-sm text-red-500 mb-3">
                        <span class="text-red-600">&gt;</span> KILLSTREAKS
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• 3 Kills: Recon Plane</li>
                        <li>• 5 Kills: Artillery Strike</li>
                        <li>• 7 Kills: Attack Dogs</li>
                      </ul>
                    </div>
                    <div class="border border-red-500/30 p-4 bg-red-500/5">
                      <div class="font-mono text-sm text-red-500 mb-3">
                        <span class="text-red-600">&gt;</span> ОСОБЕННОСТИ
                      </div>
                      <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Управление танками</li>
                        <li>• Система перков</li>
                        <li>• Кастомизация оружия</li>
                        <li>• Престиж режим</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Nazi Zombies - СТАТИЧЕСКИЙ -->
              <section :id="sections[3].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[3].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    <strong class="text-red-500">Nazi Zombies</strong> — кооперативный режим, который стал визитной карточкой Treyarch и положил начало популярной серии зомби-режимов в Call of Duty. До 4 игроков сражаются против бесконечных волн зомби, улучшая оружие и открывая новые области карты.
                  </p>

                  <!-- Zombie Maps Grid - Статические данные -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <!-- Nacht der Untoten -->
                    <div class="group border-2 border-red-500/30 hover:border-red-500 bg-black/40 p-5 transition-all relative overflow-hidden">
                      <div class="absolute inset-0 bg-gradient-to-br from-red-500/0 to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                      <div class="relative">
                        <div class="font-mono text-xs text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> BASE GAME
                        </div>
                        <h3 class="text-xl font-black text-white mb-2 font-mono group-hover:text-red-500 transition-colors">
                          NACHT DER UNTOTEN
                        </h3>
                        <p class="text-sm text-gray-400 mb-3">Первая зомби-карта в истории Call of Duty. Заброшенный бункер в Германии, где четыре солдата противостоят орде нежити.</p>
                        <div class="text-xs text-gray-500 font-mono space-y-1">
                          <div><span class="text-red-500">Локация:</span> Германия</div>
                          <div><span class="text-red-500">Особенности:</span> Mystery Box, Power-ups</div>
                        </div>
                      </div>
                    </div>

                    <!-- Verrückt -->
                    <div class="group border-2 border-red-500/30 hover:border-red-500 bg-black/40 p-5 transition-all relative overflow-hidden">
                      <div class="absolute inset-0 bg-gradient-to-br from-red-500/0 to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                      <div class="relative">
                        <div class="font-mono text-xs text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> MAP PACK 1
                        </div>
                        <h3 class="text-xl font-black text-white mb-2 font-mono group-hover:text-red-500 transition-colors">
                          VERRÜCKT
                        </h3>
                        <p class="text-sm text-gray-400 mb-3">Психиатрическая лечебница с мрачной атмосферой. Первая карта с перками и электрическими ловушками.</p>
                        <div class="text-xs text-gray-500 font-mono space-y-1">
                          <div><span class="text-red-500">Локация:</span> Германия, больница</div>
                          <div><span class="text-red-500">Особенности:</span> Perks, Electric traps, 2 spawn points</div>
                        </div>
                      </div>
                    </div>

                    <!-- Shi No Numa -->
                    <div class="group border-2 border-red-500/30 hover:border-red-500 bg-black/40 p-5 transition-all relative overflow-hidden">
                      <div class="absolute inset-0 bg-gradient-to-br from-red-500/0 to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                      <div class="relative">
                        <div class="font-mono text-xs text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> MAP PACK 2
                        </div>
                        <h3 class="text-xl font-black text-white mb-2 font-mono group-hover:text-red-500 transition-colors">
                          SHI NO NUMA
                        </h3>
                        <p class="text-sm text-gray-400 mb-3">Заброшенный рыбацкий поселок в японских болотах. Появление Wunderwaffe DG-2 и новых зомби-собак.</p>
                        <div class="text-xs text-gray-500 font-mono space-y-1">
                          <div><span class="text-red-500">Локация:</span> Япония, болота</div>
                          <div><span class="text-red-500">Особенности:</span> Wunderwaffe DG-2, Hellhounds, Ziplines</div>
                        </div>
                      </div>
                    </div>

                    <!-- Der Riese -->
                    <div class="group border-2 border-red-500/30 hover:border-red-500 bg-black/40 p-5 transition-all relative overflow-hidden">
                      <div class="absolute inset-0 bg-gradient-to-br from-red-500/0 to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                      <div class="relative">
                        <div class="font-mono text-xs text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> MAP PACK 3
                        </div>
                        <h3 class="text-xl font-black text-white mb-2 font-mono group-hover:text-red-500 transition-colors">
                          DER RIESE
                        </h3>
                        <p class="text-sm text-gray-400 mb-3">Легендарная карта в секретной фабрике Group 935. Телепорты и Pack-a-Punch впервые в серии.</p>
                        <div class="text-xs text-gray-500 font-mono space-y-1">
                          <div><span class="text-red-500">Локация:</span> Германия, фабрика</div>
                          <div><span class="text-red-500">Особенности:</span> Pack-a-Punch, Teleporters, Easter Eggs</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Zombie Perks -->
                  <div class="mt-6 border border-red-500/30 p-4 bg-black/20">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> ДОСТУПНЫЕ ПЕРКИ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
                      <div class="text-gray-400">
                        <div class="text-red-500 font-mono mb-1">Juggernog</div>
                        <div>Увеличение здоровья</div>
                      </div>
                      <div class="text-gray-400">
                        <div class="text-red-500 font-mono mb-1">Speed Cola</div>
                        <div>Быстрая перезарядка</div>
                      </div>
                      <div class="text-gray-400">
                        <div class="text-red-500 font-mono mb-1">Double Tap</div>
                        <div>Удвоенная скорострельность</div>
                      </div>
                      <div class="text-gray-400">
                        <div class="text-red-500 font-mono mb-1">Quick Revive</div>
                        <div>Быстрое воскрешение</div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Weapons - СТАТИЧЕСКИЙ -->
              <section :id="sections[4].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[4].title }}</span>
                </h2>
                <div class="space-y-6">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    World at War представляет широкий арсенал аутентичного оружия времен Второй мировой войны, разделенного по категориям для различных стилей игры.
                  </p>

                  <!-- Assault Rifles -->
                  <div class="border-l-4 border-red-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-orange-500 mb-4 font-mono">
                      <span class="text-orange-600">&gt;</span> ШТУРМОВЫЕ ВИНТОВКИ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> STG-44
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Первая в мире штурмовая винтовка. Сбалансированные характеристики и высокая точность.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> MP40
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Немецкий пистолет-пулемет с высокой скорострельностью, идеален для ближнего боя.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> PPSH-41
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">СССР</div>
                        <p class="text-xs text-gray-400">Легендарный советский ППШ с барабанным магазином на 71 патрон. Отличная скорострельность.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Thompson
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Знаменитый "Томми-ган". Мощный пистолет-пулемет с барабанным магазином.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Type 100
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Япония</div>
                        <p class="text-xs text-gray-400">Японский пистолет-пулемет с низкой отдачей и хорошей точностью.</p>
                      </div>
                    </div>
                  </div>

                  <!-- Rifles -->
                  <div class="border-l-4 border-red-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-orange-500 mb-4 font-mono">
                      <span class="text-orange-600">&gt;</span> ВИНТОВКИ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Mosin-Nagant
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">СССР</div>
                        <p class="text-xs text-gray-400">Культовая советская винтовка. Высокий урон и возможность установки оптического прицела.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Kar98k
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Немецкая снайперская винтовка с болтовым затвором. Точная и мощная.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Springfield
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">M1903 Springfield - американская снайперская винтовка с превосходной точностью.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Arisaka
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Япония</div>
                        <p class="text-xs text-gray-400">Японская болтовая винтовка Type 99. Надежная и точная на дальних дистанциях.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> PTRS-41
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">СССР</div>
                        <p class="text-xs text-gray-400">Противотанковое ружье. Убивает с одного выстрела, пробивает стены.</p>
                      </div>
                    </div>
                  </div>

                  <!-- Machine Guns -->
                  <div class="border-l-4 border-red-500 pl-4 mb-6">
                    <h3 class="text-xl font-bold text-orange-500 mb-4 font-mono">
                      <span class="text-orange-600">&gt;</span> ПУЛЕМЕТЫ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> MG42
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Легендарная "Пила Гитлера". Самая высокая скорострельность в игре - 1200 выстр./мин.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> DP-28
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">СССР</div>
                        <p class="text-xs text-gray-400">Советский ручной пулемет с дисковым магазином. Сбалансированные характеристики.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Browning M1919
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">США</div>
                        <p class="text-xs text-gray-400">Американский станковый пулемет. Большой магазин и стабильная стрельба.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Type 99 LMG
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Япония</div>
                        <p class="text-xs text-gray-400">Японский ручной пулемет с низкой отдачей.</p>
                      </div>
                    </div>
                  </div>

                  <!-- Special Weapons -->
                  <div class="border-l-4 border-red-500 pl-4">
                    <h3 class="text-xl font-bold text-orange-500 mb-4 font-mono">
                      <span class="text-orange-600">&gt;</span> СПЕЦИАЛЬНОЕ ОРУЖИЕ
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Wunderwaffe DG-2
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Зомби-режим</div>
                        <p class="text-xs text-gray-400">Электрическое чудо-оружие. Убивает группы зомби цепной молнией. 3 выстрела в обойме.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Ray Gun
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Зомби-режим</div>
                        <p class="text-xs text-gray-400">Инопланетный энергетический пистолет. Взрывные снаряды, 20 выстрелов.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Flamethrower
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Все фракции</div>
                        <p class="text-xs text-gray-400">Огнемет для зачистки окопов и бункеров. Эффективен на близкой дистанции.</p>
                      </div>

                      <div class="border border-red-500/30 p-4 bg-black/20 hover:bg-red-500/5 transition-all">
                        <div class="font-mono text-sm text-red-500 mb-2">
                          <span class="text-red-600">&gt;</span> Panzerschreck
                        </div>
                        <div class="text-xs text-gray-500 mb-2 font-mono">Германия</div>
                        <p class="text-xs text-gray-400">Ракетная установка для уничтожения техники и укреплений.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: Maps - СТАТИЧЕСКИЙ -->
              <section :id="sections[5].id" class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[5].title }}</span>
                </h2>
                <div class="prose prose-invert max-w-none">
                  <p class="text-gray-300 leading-relaxed mb-4">
                    Игра включает разнообразные мультиплеерные карты, расположенные в различных локациях Второй мировой войны на Тихоокеанском и Европейском театрах военных действий.
                  </p>

                  <!-- Base Game Maps -->
                  <div class="mb-8">
                    <div class="font-mono text-lg text-orange-500 mb-4">
                      <span class="text-orange-600">&gt;</span> БАЗОВЫЕ КАРТЫ
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Airfield</div>
                        <div class="text-xs text-gray-500 text-center">Окинава, Япония</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Аэродром</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Asylum</div>
                        <div class="text-xs text-gray-500 text-center">Япония</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Психбольница</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Castle</div>
                        <div class="text-xs text-gray-500 text-center">Япония</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Замок</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Cliffside</div>
                        <div class="text-xs text-gray-500 text-center">Япония</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Утес</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Courtyard</div>
                        <div class="text-xs text-gray-500 text-center">Берлин, Германия</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Внутренний двор</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Dome</div>
                        <div class="text-xs text-gray-500 text-center">Сталинград, СССР</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Планетарий</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Downfall</div>
                        <div class="text-xs text-gray-500 text-center">Берлин, Германия</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Падение</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Hangar</div>
                        <div class="text-xs text-gray-500 text-center">Пелелиу</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Ангар</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Makin</div>
                        <div class="text-xs text-gray-500 text-center">Острова Гилберта</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Джунгли</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Outskirts</div>
                        <div class="text-xs text-gray-500 text-center">Польша</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Окраины</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Roundhouse</div>
                        <div class="text-xs text-gray-500 text-center">Германия</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Депо</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Seelow</div>
                        <div class="text-xs text-gray-500 text-center">Германия</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Зееловские высоты</div>
                      </div>

                      <div class="border border-red-500/30 p-3 bg-black/20 hover:bg-red-500/5 transition-all group">
                        <div class="font-mono text-sm text-gray-300 text-center font-bold mb-1">Upheaval</div>
                        <div class="text-xs text-gray-500 text-center">Маршалловы острова</div>
                        <div class="text-xs text-gray-600 text-center mt-1">Переворот</div>
                      </div>
                    </div>
                  </div>

                  <!-- DLC Maps -->
                  <div class="mb-6">
                    <div class="font-mono text-lg text-orange-500 mb-4">
                      <span class="text-orange-600">&gt;</span> DLC КАРТЫ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                      <!-- Map Pack 1 -->
                      <div class="border-l-4 border-red-500 pl-4 bg-black/20 p-4">
                        <div class="text-sm text-red-500 font-mono mb-2">MAP PACK 1</div>
                        <div class="space-y-2 text-sm">
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Nightfire</strong>
                            <div class="text-xs text-gray-500 ml-3">Ночной бой в джунглях</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Knee Deep</strong>
                            <div class="text-xs text-gray-500 ml-3">Болота Новой Гвинеи</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Station</strong>
                            <div class="text-xs text-gray-500 ml-3">Берлинское метро</div>
                          </div>
                        </div>
                      </div>

                      <!-- Map Pack 2 -->
                      <div class="border-l-4 border-red-500 pl-4 bg-black/20 p-4">
                        <div class="text-sm text-red-500 font-mono mb-2">MAP PACK 2</div>
                        <div class="space-y-2 text-sm">
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Banzai</strong>
                            <div class="text-xs text-gray-500 ml-3">Тихоокеанская деревня</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Corrosion</strong>
                            <div class="text-xs text-gray-500 ml-3">Замок на утесе</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Sub Pens</strong>
                            <div class="text-xs text-gray-500 ml-3">Подводные доки</div>
                          </div>
                        </div>
                      </div>

                      <!-- Map Pack 3 -->
                      <div class="border-l-4 border-red-500 pl-4 bg-black/20 p-4">
                        <div class="text-sm text-red-500 font-mono mb-2">MAP PACK 3</div>
                        <div class="space-y-2 text-sm">
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Battery</strong>
                            <div class="text-xs text-gray-500 ml-3">Прибрежная батарея</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Revolution</strong>
                            <div class="text-xs text-gray-500 ml-3">Замерзший фонтан</div>
                          </div>
                          <div class="text-gray-300">
                            <span class="text-red-500">•</span> <strong>Breach</strong>
                            <div class="text-xs text-gray-500 ml-3">Берлинская стена</div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <!-- Map Features -->
                  <div class="border border-red-500/30 p-4 bg-black/20 mt-6">
                    <div class="font-mono text-sm text-red-500 mb-3">
                      <span class="text-red-600">&gt;</span> ОСОБЕННОСТИ КАРТ
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-400">
                      <div>
                        <div class="text-red-500 mb-2">Разнообразие локаций:</div>
                        <ul class="space-y-1 text-xs">
                          <li>• Тихоокеанские джунгли и острова</li>
                          <li>• Разрушенные города Европы</li>
                          <li>• Восточный фронт</li>
                          <li>• Военные базы и укрепления</li>
                        </ul>
                      </div>
                      <div>
                        <div class="text-red-500 mb-2">Игровые элементы:</div>
                        <ul class="space-y-1 text-xs">
                          <li>• Управляемые танки на некоторых картах</li>
                          <li>• Интерактивные ловушки</li>
                          <li>• Динамическая погода и время суток</li>
                          <li>• Разрушаемые укрытия</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <!-- Section: DLC - СТАТИЧЕСКИЙ -->
              <section :id="sections[6].id" class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-2">{{ sections[6].title }}</span>
                </h2>
                <div class="space-y-4">
                  <div
                    v-for="dlc in dlcPacks"
                    :key="dlc.name"
                    class="border-l-4 border-red-500 pl-4 bg-black/20 p-4"
                  >
                    <h3 class="text-lg font-bold text-orange-500 mb-2 font-mono">
                      <span class="text-orange-600">&gt;</span> {{ dlc.name }}
                    </h3>
                    <div class="text-xs text-red-500 mb-2 font-mono">{{ dlc.date }}</div>
                    <p class="text-sm text-gray-400 mb-2">{{ dlc.description }}</p>
                    <div class="text-xs text-gray-500 font-mono">
                      <span class="text-red-600">&gt;</span> Контент: {{ dlc.content }}
                    </div>
                  </div>
                </div>
              </section>

            </div>

            <!-- Quick Links -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
              <button
                @click="$inertia.visit('/zombies/world-at-war')"
                class="border-2 border-red-500/30 hover:border-red-500 bg-black/40 hover:bg-red-500/10 p-4 transition-all group"
              >
                <div class="font-mono text-sm text-red-500 mb-2 flex items-center">
                  <span class="text-red-600">&gt;</span>
                  <span class="ml-1">ПЕРЕЙТИ К ЗОМБИ РЕЖИМУ</span>
                  <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </div>
              </button>

              <button
                @click="$inertia.visit('/cod-wiki')"
                class="border-2 border-red-500/30 hover:border-red-500 bg-black/40 hover:bg-red-500/10 p-4 transition-all group"
              >
                <div class="font-mono text-sm text-red-500 mb-2 flex items-center">
                  <span class="text-red-600">&gt;</span>
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

    <!-- Footer (опционально) -->
    <footer class="relative z-10 border-t border-red-500/20 bg-black/80 backdrop-blur-sm py-6 mt-12">
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center font-mono text-xs text-gray-500">
          <span class="text-red-600">&gt;</span> LAST_UPDATED: {{ lastUpdated }}
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from '@/Components/Header.vue';

// Props от контроллера (больше не используются, но оставляем для совместимости)
const props = defineProps({
  page: Object,
  weapons: Array,
  maps: Array,
  zombieMaps: Array,
});

// Reactive data
const activeSection = ref('overview');
const lastUpdated = ref('2025-01-10');

// Navigation sections
const sections = [
  { id: 'overview', title: 'ОБЗОР' },
  { id: 'campaigns', title: 'КАМПАНИИ' },
  { id: 'multiplayer', title: 'МУЛЬТИПЛЕЕР' },
  { id: 'zombies', title: 'NAZI ZOMBIES' },
  { id: 'weapons', title: 'ОРУЖИЕ' },
  { id: 'maps', title: 'КАРТЫ' },
  { id: 'dlc', title: 'DLC' },
];

// DLC Packs - СТАТИЧЕСКИЙ
const dlcPacks = [
  {
    name: 'Map Pack 1',
    date: '19.03.2009',
    description: 'Первый набор карт для мультиплеера и зомби-режима',
    content: '3 мультиплеер карты + Verrückt'
  },
  {
    name: 'Map Pack 2',
    date: '11.06.2009',
    description: 'Второй набор карт с новой зомби-картой',
    content: '3 мультиплеер карты + Shi No Numa'
  },
  {
    name: 'Map Pack 3',
    date: '03.09.2009',
    description: 'Финальный набор карт с легендарной Der Riese',
    content: '3 мультиплеер карты + Der Riese'
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
  text-shadow: 0 0 10px rgba(239, 68, 68, 0.5),
               0 0 20px rgba(239, 68, 68, 0.3),
               0 0 30px rgba(239, 68, 68, 0.2);
}

/* Cursor blink animation */
.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Line clamp utility */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Terminal grid pattern */
.terminal-grid {
  background-image:
    linear-gradient(rgba(220, 38, 38, 0.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(220, 38, 38, 0.1) 1px, transparent 1px);
  background-size: 20px 20px;
}

/* Smooth scroll behavior */
html {
  scroll-behavior: smooth;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #000;
}

::-webkit-scrollbar-thumb {
  background: rgba(220, 38, 38, 0.5);
  border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(220, 38, 38, 0.7);
}
</style>
