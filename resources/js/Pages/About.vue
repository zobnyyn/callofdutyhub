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
                <span class="text-orange-500 font-bold">COD Terminal</span> — это крупнейшее русскоязычное сообщество фанатов серии игр Call of Duty.
                Мы объединяем тысячи игроков, которые разделяют страсть к этой легендарной франшизе.
              </p>
            </div>

            <div class="border border-orange-500/30 bg-orange-500/5 p-6 md:p-8 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> OBJECTIVES:
              </div>
              <ul class="space-y-4 text-gray-300">
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1">▸</span>
                  <span class="text-base md:text-lg">Создание активного комьюнити для общения и поиска тиммейтов</span>
                </li>
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1">▸</span>
                  <span class="text-base md:text-lg">Публикация детальных гайдов по зомби-режимам всех частей игры</span>
                </li>
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1">▸</span>
                  <span class="text-base md:text-lg">Актуальные новости, обзоры оружия и мета-аналитика</span>
                </li>
                <li class="flex items-start">
                  <span class="text-orange-500 mr-3 mt-1">▸</span>
                  <span class="text-base md:text-lg">Организация турниров и совместных игровых сессий</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Stats Section -->
          <div class="mb-12 font-mono">
            <div class="text-orange-600 text-sm mb-4">
              <span class="text-orange-600">&gt;</span> PROJECT_STATISTICS:
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">УЧАСТНИКОВ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">1000+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">ГАЙДОВ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">500+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">АКТИВНОСТЬ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">24/7</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-xs text-orange-600 mb-2">ЛЕТ РАБОТЫ:</div>
                <div class="text-3xl md:text-4xl font-black text-orange-500">3+</div>
              </div>
            </div>
          </div>

          <!-- Features Section -->
          <div class="mb-12">
            <div class="font-mono text-sm text-orange-600 mb-6">
              <span class="text-orange-600">&gt;</span> FEATURES_LIST:
            </div>
            <div class="grid md:grid-cols-2 gap-6">
              <!-- Feature 1 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">БАЗА ЗНАНИЙ</h3>
                    <p class="text-gray-400 text-sm">Обширная коллекция гайдов по всем зомби-картам, от World at War до Black Ops 7</p>
                  </div>
                </div>
              </div>

              <!-- Feature 2 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">КОМЬЮНИТИ</h3>
                    <p class="text-gray-400 text-sm">Активное сообщество с системой друзей, личными сообщениями и достижениями</p>
                  </div>
                </div>
              </div>

              <!-- Feature 3 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">УВЕДОМЛЕНИЯ</h3>
                    <p class="text-gray-400 text-sm">Будьте в курсе новых гайдов, событий и обновлений в режиме реального времени</p>
                  </div>
                </div>
              </div>

              <!-- Feature 4 -->
              <div class="border border-orange-500/30 bg-black/50 p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 border border-orange-500/40 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-black text-orange-500 mb-2 font-mono">ДОСТИЖЕНИЯ</h3>
                    <p class="text-gray-400 text-sm">Зарабатывайте награды за прохождение гайдов и участие в жизни сообщества</p>
                  </div>
                </div>
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
                Проект создан и поддерживается командой энтузиастов Call of Duty, которые посвятили годы изучению механик игры
                и созданию качественного контента для русскоязычного комьюнити.
              </p>
              <p class="text-gray-400 leading-relaxed">
                Мы постоянно работаем над улучшением платформы, добавлением новых функций и созданием
                актуального контента для всех режимов Call of Duty.
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
