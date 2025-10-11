<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- About Hero Section -->
    <section class="pt-24 md:pt-40 pb-12 md:pb-24 px-3 md:px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-5xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING ABOUT_PROJECT.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> DISPLAYING PROJECT_INFORMATION
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-6 md:mb-8"></div>
          </div>

          <!-- Main Title -->
          <h1 class="text-5xl md:text-7xl font-black mb-8 leading-none uppercase font-mono">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
              О ПРОЕКТЕ
            </span>
          </h1>

          <!-- Project Description -->
          <div class="space-y-8 mb-12">
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 md:p-8 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> MISSION_BRIEF:
              </div>
              <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
                <span class="text-orange-500 font-bold">COD Terminal</span> — это мощнейший русскоязычный портал по Call of Duty, объединяющий
                <span class="text-orange-500 font-bold">краткую энциклопедию COD Wiki</span>,
                <span class="text-orange-500 font-bold">актуальные мета-сборки для Warzone</span> и
                <span class="text-orange-500 font-bold">детальные гайды по зомби-картам всех частей Treyarch</span>.
                Мы создаём место, где тысячи игроков находят всё необходимое для доминирования в Call of Duty.
              </p>
            </div>

            <div class="border border-orange-500/30 bg-orange-500/5 p-6 md:p-8 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> CORE_MODULES:
              </div>
              <ul class="space-y-4 text-gray-300">
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1 text-xl">▸</span>
                  <div>
                    <span class="text-base md:text-lg font-bold text-orange-400">COD Wiki</span>
                    <span class="text-base md:text-lg"> — Энциклопедия Call of Duty: оружие, операторы, карты, перки, killstreaks и игровая механика</span>
                  </div>
                </li>
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1 text-xl">▸</span>
                  <div>
                    <span class="text-base md:text-lg font-bold text-orange-400">Warzone Meta Hub</span>
                    <span class="text-base md:text-lg"> — Актуальные мета-сборки оружия для Warzone с детальным разбором аксессуаров для MW2, MW3 и Black Ops 6</span>
                  </div>
                </li>
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1 text-xl">▸</span>
                  <div>
                    <span class="text-base md:text-lg font-bold text-orange-400">Zombies Archive</span>
                    <span class="text-base md:text-lg"> — Профессиональные гайды по всем зомби-картам Treyarch: от World at War до Black Ops 6. Пошаговые прохождения Easter Eggs, тактики выживания, секретные комнаты</span>
                  </div>
                </li>
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1 text-xl">▸</span>
                  <div>
                    <span class="text-base md:text-lg font-bold text-orange-400">Tactical Community</span>
                    <span class="text-base md:text-lg"> — Активное комьюнити с системой поиска тиммейтов, личными профилями и достижениями</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- Stats Section -->
          <div class="mb-12 font-mono">
            <div class="text-orange-600 text-sm mb-4">
              <span class="text-orange-600">&gt;</span> OPERATIONAL_STATISTICS:
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">ИГРОКОВ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">1K+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">ГАЙДОВ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">200+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">WIKI СТАТЕЙ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">500+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">META СБОРОК:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">100+</div>
              </div>
            </div>
          </div>

          <!-- Features Section -->
          <div class="mb-12">
            <div class="font-mono text-sm text-orange-600 mb-6">
              <span class="text-orange-600">&gt;</span> FEATURES_BREAKDOWN:
            </div>
            <div class="grid md:grid-cols-2 gap-6">
              <!-- Feature 1 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative hover:bg-orange-500/5 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">COD WIKI</h3>
                    <p class="text-gray-400 text-sm">База знаний по всем играм серии: оружие, описания перков, карты, операторы и игровая механика</p>
                  </div>
                </div>
              </div>

              <!-- Feature 2 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative hover:bg-orange-500/5 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">WARZONE META</h3>
                    <p class="text-gray-400 text-sm">Актуальные билды топового оружия для Warzone с детальным разбором каждого аксессуара и тактики применения</p>
                  </div>
                </div>
              </div>

              <!-- Feature 3 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative hover:bg-orange-500/5 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">ZOMBIES GUIDES</h3>
                    <p class="text-gray-400 text-sm">Профессиональные гайды по всем зомби-картам Treyarch: Easter Eggs, стратегии выживания, секретные квесты от WaW до BO6</p>
                  </div>
                </div>
              </div>

              <!-- Feature 4 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative hover:bg-orange-500/5 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">ACTIVE COMMUNITY</h3>
                    <p class="text-gray-400 text-sm">Найдите тиммейтов для любого режима, общайтесь в Discord и участвуйте в турнирах и ивентах</p>
                  </div>
                </div>
              </div>

              <!-- Feature 5 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative hover:bg-orange-500/5 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">META ANALYTICS</h3>
                    <p class="text-gray-400 text-sm">Аналитика популярности оружия, статистика win-rate и тренды мета-игры на основе данных про-игроков</p>
                  </div>
                </div>
              </div>

              <!-- Feature 6 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative hover:bg-orange-500/5 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">INSTANT UPDATES</h3>
                    <p class="text-gray-400 text-sm">Мгновенные уведомления о новых гайдах, обновлениях мета-сборок и важных игровых апдейтах</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- What We Offer -->
          <div class="mb-12">
            <div class="font-mono text-sm text-orange-600 mb-6">
              <span class="text-orange-600">&gt;</span> CONTENT_LIBRARY:
            </div>
            <div class="grid md:grid-cols-3 gap-4">
              <div class="border border-orange-500/30 bg-gradient-to-br from-orange-900/10 to-black p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-4xl font-black text-orange-500 mb-2">📚</div>
                <h4 class="font-mono text-orange-400 font-bold mb-2">COD WIKI</h4>
                <p class="text-gray-400 text-sm">Мини энциклопедия по всем играм Call of Duty </p>
              </div>
              <div class="border border-orange-500/30 bg-gradient-to-br from-red-900/10 to-black p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-4xl font-black text-orange-500 mb-2">⚡</div>
                <h4 class="font-mono text-orange-400 font-bold mb-2">WARZONE META</h4>
                <p class="text-gray-400 text-sm">Топовые сборки оружия с разбором каждого аксессуара</p>
              </div>
              <div class="border border-orange-500/30 bg-gradient-to-br from-green-900/10 to-black p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-4xl font-black text-orange-500 mb-2">🧟</div>
                <h4 class="font-mono text-orange-400 font-bold mb-2">ZOMBIES</h4>
                <p class="text-gray-400 text-sm">Гайды по всем зомби-картам Treyarch с Easter Eggs</p>
              </div>
            </div>
          </div>

          <!-- Team Section -->
          <div class="mb-12">
            <div class="font-mono text-sm text-orange-600 mb-6">
              <span class="text-orange-600">&gt;</span> TEAM_INFO:
            </div>
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 md:p-8 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <h3 class="text-2xl font-black text-white mb-4 font-mono">
                <span class="text-orange-500">&gt;</span> НАША КОМАНДА
              </h3>
              <p class="text-gray-300 text-lg leading-relaxed mb-4">
                Проект создан командой фанатичных игроков Call of Duty с многолетним опытом.
                Мы прошли все зомби-карты на высших раундах, достигли топ-рангов в Warzone
                и знаем механику каждой игры серии от и до.
              </p>
              <p class="text-gray-400 leading-relaxed">
                Наша миссия — создать самый полный и актуальный русскоязычный ресурс по Call of Duty,
                где каждый игрок найдёт нужную информацию: от новичка, изучающего базовую механику,
                до хардкорного ветерана, ищущего секреты на зомби-картах.
              </p>
            </div>
          </div>

          <!-- CTA Section -->
          <div class="font-mono">
            <div class="text-orange-600 text-sm mb-4">
              <span class="text-orange-600">&gt;</span> AVAILABLE_ACTIONS:
            </div>
            <div class="flex flex-col sm:flex-row items-start gap-4">
              <a href="/register" class="group relative px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black font-black text-lg tracking-wider transition-all overflow-hidden border-2 border-orange-700">
                <span class="absolute inset-0 terminal-grid opacity-20" aria-hidden="true"></span>
                <span class="relative z-10 flex items-center">
                  <span class="text-black/60 mr-2">&gt;</span>
                  <span>ПРИСОЕДИНИТЬСЯ</span>
                  <span class="inline-block w-2 h-4 bg-black/30 ml-2 cursor-blink"></span>
                </span>
              </a>
              <a href="/zombies" class="px-8 py-4 border-2 border-orange-500/50 hover:bg-orange-500/10 text-orange-500 font-black text-lg tracking-wider transition-all">
                <span class="text-orange-600/60 mr-2">&gt;</span>
                <span>ПЕРЕЙТИ К ГАЙДАМ</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted, computed } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
</script>

<style scoped>
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}
</style>
