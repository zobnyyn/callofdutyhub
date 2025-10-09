<template>
  <header class="fixed top-0 left-0 right-0 z-40 bg-black/95 backdrop-blur-sm border-b border-orange-500/30">
    <!-- Terminal status bar -->
    <div class="border-b border-orange-900/30 bg-orange-950/20 px-3 md:px-6 py-1 overflow-hidden">
      <div class="flex items-center justify-between text-[8px] md:text-[10px] font-mono text-orange-400">
        <div class="flex items-center space-x-2 md:space-x-4 truncate">
          <div class="flex items-center space-x-1 md:space-x-2">
            <div class="w-1.5 h-1.5 md:w-2 md:h-2 bg-orange-500 rounded-full"></div>
            <span class="hidden sm:inline">SYSTEM_ACTIVE</span>
            <span class="sm:hidden">SYS</span>
          </div>
          <span class="hidden md:inline">|</span>
          <span class="hidden md:inline">USER: OPERATOR_{{ Math.floor(Math.random() * 9999).toString().padStart(4, '0') }}</span>
          <span class="hidden lg:inline">|</span>
          <span class="hidden lg:inline">CLEARANCE: TOP_SECRET</span>
        </div>
        <div class="flex items-center space-x-2 md:space-x-4">
          <span id="terminal-time" class="text-[8px] md:text-[10px]">{{ currentTime }}</span>
          <span class="hidden md:inline">|</span>
          <span class="hidden md:inline">CONNECTION: SECURE</span>
        </div>
      </div>
    </div>

    <nav class="container mx-auto px-3 md:px-6 py-3 md:py-4 relative">
      <div class="flex items-center justify-between">
        <!-- Logo with Terminal Style -->
        <div class="flex items-center space-x-2 md:space-x-4">
          <div class="relative group">
            <!-- Terminal-style rotating diamond -->
            <div class="w-10 h-10 md:w-14 md:h-14 relative">
              <div class="absolute inset-0 bg-gradient-to-br from-orange-600 to-red-700 transform rotate-45 overflow-hidden">
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute inset-0 terminal-grid"></div>
              </div>
              <div class="absolute inset-2 bg-black transform rotate-45"></div>
              <div class="absolute inset-0 border-2 border-orange-500/40 transform rotate-45 group-hover:border-orange-400 transition-colors"></div>
              <!-- Static cursor in center -->
              <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-1.5 h-2 md:w-2 md:h-3 bg-orange-500"></div>
            </div>
          </div>
          <div>
            <div class="text-sm md:text-2xl font-black tracking-tighter font-mono">
                <span class="text-orange-500">&gt; <span class="hidden sm:inline">CALL OF DUTY</span><span class="sm:hidden">COD</span> <span class="text-white"></span></span>
            </div>
            <div class="text-[7px] md:text-[9px] text-white tracking-[0.2em] md:tracking-[0.3em] font-mono">TERMINAL_v3.0</div>
          </div>
        </div>

        <!-- Navigation - Desktop -->
        <div class="hidden lg:flex items-center space-x-2">
          <a href="/" class="terminal-nav-item group">
            <span class="text-orange-600 font-mono mr-1">&gt;</span>
            <span class="group-hover:text-orange-400">ГЛАВНАЯ</span>
          </a>
          <span class="text-orange-900">|</span>
          <a href="/zombies" class="terminal-nav-item group">
            <span class="text-orange-600 font-mono mr-1">&gt;</span>
            <span class="group-hover:text-orange-400">ZOMBIES</span>
          </a>
          <span class="text-orange-900">|</span>
          <div class="relative"
             @mouseenter="openCodWikiDropdown"
             @mouseleave="closeCodWikiDropdown"
             @focusin="openCodWikiDropdown"
             @focusout="closeCodWikiDropdown">
            <a href="/cod-wiki" class="terminal-nav-item flex items-center group">
              <span class="text-orange-600 font-mono mr-1">&gt;</span>
              <span class="group-hover:text-orange-400">COD WIKI</span>
            </a>
            <!-- Combined Dropdown -->
            <div v-show="showCodWikiDropdown" class="absolute left-0 mt-2 w-72 bg-black border border-orange-600/30 rounded-md shadow-lg opacity-100 pointer-events-auto transform translate-y-0 transition-all duration-150 z-50"
              @mouseenter="openCodWikiDropdown" @mouseleave="closeCodWikiDropdown">
              <ul class="py-2">
                <!-- Black Ops Section -->
                <li class="px-4 py-2 text-xs font-bold font-mono text-orange-500 uppercase border-b border-orange-500/20">
                  Black Ops Series
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="worldatwar" alt="World at War" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>World at War (2008)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="blackops1" alt="Black Ops" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Black Ops (2010)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="blackops2" alt="Black Ops II" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Black Ops II (2012)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="blackops3" alt="Black Ops III" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Black Ops III (2015)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="blackops4" alt="Black Ops 4" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Black Ops 4 (2018)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="coldwar" alt="Cold War" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Cold War (2020)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="blackops6" alt="Black Ops 6" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Black Ops 6 (2024)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="blackops7" alt="Black Ops 7" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>Black Ops 7 (2025)</span>
                  </a>
                </li>

                <!-- Modern Warfare Section -->
                <li class="px-4 py-2 text-xs font-bold font-mono text-orange-500 uppercase border-t border-b border-orange-500/20 mt-2">
                  Modern Warfare Series
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="mw2007" alt="COD 4: MW" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>COD 4: MW (2007)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="mw2009" alt="MW 2" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>MW 2 (2009)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="mw2011" alt="MW 3" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>MW 3 (2011)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="mw2019" alt="MW" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>MW (2019)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="mw2022" alt="MW II" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>MW II (2022)</span>
                  </a>
                </li>
                <li>
                  <a href="/cod-wiki" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                    <img :src="mw2023" alt="MW III" class="w-8 h-8 rounded object-cover border border-orange-500/30" />
                    <span>MW III (2023)</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <span class="text-orange-900">|</span>
          <a href="/community" class="terminal-nav-item group">
            <span class="text-orange-600 font-mono mr-1">&gt;</span>
            <span class="group-hover:text-orange-400">СООБЩЕСТВО</span>
          </a>
          <template v-if="user && user.is_admin">
            <span class="text-orange-900">|</span>
            <div class="relative"
               @mouseenter="openAdminDropdown"
               @mouseleave="closeAdminDropdown"
               @focusin="openAdminDropdown"
               @focusout="closeAdminDropdown">
              <button class="terminal-nav-item flex items-center group">
                <span class="text-orange-600 font-mono mr-1">&gt;</span>
                <span class="group-hover:text-orange-400">АДМИНКА</span>
              </button>
              <!-- Admin Dropdown -->
              <div v-show="showAdminDropdown" class="absolute left-0 mt-2 w-56 bg-black border border-orange-600/30 rounded-md shadow-lg opacity-100 pointer-events-auto transform translate-y-0 transition-all duration-150 z-50"
                @mouseenter="openAdminDropdown" @mouseleave="closeAdminDropdown">
                <ul class="py-2">
                  <li>
                    <a href="/admin/guides" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                      </svg>
                      <span>Управление гайдами</span>
                    </a>
                  </li>
                  <li>
                    <a href="/admin/items" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                      </svg>
                      <span>Управление предметами</span>
                    </a>
                  </li>
                  <li>
                    <a href="/admin/articles" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 transition-all">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                      </svg>
                      <span>Управление статьями</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </template>
        </div>

        <!-- Auth Buttons & Mobile Menu Button -->
        <div class="flex items-center space-x-2 md:space-x-3">
          <!-- Notification Bell (для авторизованных пользователей) -->
          <NotificationBell v-if="user" />

          <!-- Показываем профиль, если пользователь авторизован -->
          <UserProfile v-if="user" :user="user" />

          <!-- Показываем кнопки входа и регистрации для гостей - Desktop -->
          <template v-else>
            <a href="/login" class="hidden md:block px-3 lg:px-5 py-2 text-xs lg:text-sm font-bold font-mono text-orange-500 border border-orange-500/30 hover:bg-orange-500/10 transition-all relative group">
              <span class="text-orange-600 mr-1">&gt;</span>
              <span>ВОЙТИ</span>
            </a>
            <a href="/register" class="hidden md:block px-3 lg:px-6 py-2 lg:py-2.5 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-xs lg:text-sm font-black font-mono tracking-wider transition-all relative overflow-hidden group">
              <span class="absolute inset-0 terminal-grid opacity-20" aria-hidden="true"></span>
              <span class="relative z-10">&gt; <span class="hidden lg:inline">ЗАРЕГИСТРИРОВАТЬСЯ_</span><span class="lg:hidden">РЕГИСТР._</span></span>
              <span class="inline-block w-2 h-3 bg-black/50 ml-1 cursor-blink"></span>
            </a>
          </template>

          <!-- Mobile Menu Button -->
          <button
            @click="toggleMobileMenu"
            class="lg:hidden p-2 text-orange-500 border border-orange-500/30 hover:bg-orange-500/10 transition-all"
            aria-label="Toggle menu"
          >
            <svg v-if="!showMobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div
        v-show="showMobileMenu"
        class="lg:hidden fixed left-0 right-0 bg-black/95 border-b-2 border-orange-500/50 backdrop-blur-md shadow-2xl overflow-y-auto z-50"
        :style="{ top: headerHeight + 'px', maxHeight: `calc(100vh - ${headerHeight}px)` }"
      >
        <nav class="px-3 py-4 space-y-2 pb-20">
          <a href="/" class="block px-4 py-3 text-sm font-mono text-orange-500 bg-orange-500/10 border border-orange-500/40 hover:bg-orange-500/20 hover:border-orange-500 transition-all">
            <span class="text-orange-600 mr-2">&gt;</span>ГЛАВНАЯ
          </a>
          <a href="/zombies" class="block px-4 py-3 text-sm font-mono text-orange-500 bg-orange-500/10 border border-orange-500/40 hover:bg-orange-500/20 hover:border-orange-500 transition-all">
            <span class="text-orange-600 mr-2">&gt;</span>ZOMBIES
          </a>

          <!-- Mobile COD WIKI Combined Menu -->
          <div class="border border-orange-500/40 bg-orange-500/10">
            <button
              @click="toggleCodWikiMenu"
              class="w-full px-4 py-3 text-sm font-mono text-orange-500 hover:bg-orange-500/20 transition-all flex items-center justify-between"
            >
              <span><span class="text-orange-600 mr-2">&gt;</span>COD WIKI</span>
              <svg
                class="w-4 h-4 transition-transform"
                :class="{ 'rotate-180': showCodWikiMobile }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div v-show="showCodWikiMobile" class="bg-orange-950/30">
              <!-- Black Ops Section -->
              <div class="px-4 py-2 text-xs font-bold font-mono text-orange-500 uppercase border-t border-orange-500/20">
                Black Ops Series
              </div>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="worldatwar" alt="World at War" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>World at War (2008)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="blackops1" alt="Black Ops" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Black Ops (2010)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="blackops2" alt="Black Ops II" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Black Ops II (2012)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="blackops3" alt="Black Ops III" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Black Ops III (2015)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="blackops4" alt="Black Ops 4" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Black Ops 4 (2018)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="coldwar" alt="Cold War" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Cold War (2020)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="blackops6" alt="Black Ops 6" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Black Ops 6 (2024)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="blackops7" alt="Black Ops 7" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>Black Ops 7 (2025)</span>
              </a>

              <!-- Modern Warfare Section -->
              <div class="px-4 py-2 text-xs font-bold font-mono text-orange-500 uppercase border-t border-orange-500/20 mt-2">
                Modern Warfare Series
              </div>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="mw2007" alt="COD 4: MW" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>COD 4: MW (2007)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="mw2009" alt="MW 2" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>MW 2 (2009)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="mw2011" alt="MW 3" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>MW 3 (2011)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="mw2019" alt="MW" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>MW (2019)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="mw2022" alt="MW II" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>MW II (2022)</span>
              </a>
              <a href="/cod-wiki" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                <img :src="mw2023" alt="MW III" class="w-6 h-6 rounded object-cover border border-orange-500/30" />
                <span>MW III (2023)</span>
              </a>
            </div>
          </div>

          <a href="/community" class="block px-4 py-3 text-sm font-mono text-orange-500 bg-orange-500/10 border border-orange-500/40 hover:bg-orange-500/20 hover:border-orange-500 transition-all">
            <span class="text-orange-600 mr-2">&gt;</span>СООБЩЕСТВО
          </a>

          <template v-if="user && user.is_admin">
            <div class="border border-orange-500/40 bg-orange-500/10">
              <button
                @click="toggleAdminMenu"
                class="w-full px-4 py-3 text-sm font-mono text-orange-500 hover:bg-orange-500/20 transition-all flex items-center justify-between"
              >
                <span><span class="text-orange-600 mr-2">&gt;</span>АДМИНКА</span>
                <svg
                  class="w-4 h-4 transition-transform"
                  :class="{ 'rotate-180': showAdminMobile }"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div v-show="showAdminMobile" class="bg-orange-950/30">
                <a href="/admin/guides" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  <span>Управление гайдами</span>
                </a>
                <a href="/admin/items" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                  </svg>
                  <span>Управление предметами</span>
                </a>
                <a href="/admin/articles" class="flex items-center gap-3 px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                  </svg>
                  <span>Управление статьями</span>
                </a>
              </div>
            </div>
          </template>

          <!-- Mobile Auth Buttons -->
          <template v-if="!user">
            <div class="pt-4 space-y-2">
              <a href="/login" class="block px-4 py-3 text-sm font-bold font-mono text-orange-500 bg-orange-500/10 border-2 border-orange-500/60 hover:bg-orange-500/20 hover:border-orange-500 transition-all text-center">
                <span class="text-orange-600 mr-2">&gt;</span>ВОЙТИ
              </a>
              <a href="/register" class="block px-4 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono text-center transition-all">
                <span>&gt;</span> ЗАРЕГИСТРИРОВАТЬСЯ_
              </a>
            </div>
          </template>
        </nav>
      </div>
    </nav>
  </header>

  <!-- Floating Chat Component -->
  <FloatingChat v-if="user" :currentUserId="user.id" />
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch, nextTick } from 'vue';
import { usePage } from '@inertiajs/vue3';
import UserProfile from './UserProfile.vue';
import NotificationBell from './NotificationBell.vue';
import FloatingChat from './FloatingChat.vue';

// Импорт иконок для Black Ops
import worldatwar from '../../images/icons/worldatwar.jpg';
import blackops1 from '../../images/icons/blackops1.jpg';
import blackops2 from '../../images/icons/blackops2.jpg';
import blackops3 from '../../images/icons/blackops3.jpg';
import blackops4 from '../../images/icons/blackops4.jpg';
import coldwar from '../../images/icons/coldwar.jpg';
import blackops6 from '../../images/icons/blackops6.jpg';
import blackops7 from '../../images/icons/blackops7.jpg';

// Импорт иконок для Modern Warfare
import mw2007 from '../../images/icons/mw2007.jpg';
import mw2009 from '../../images/icons/mw2009.jpg';
import mw2011 from '../../images/icons/mw2011.jpg';
import mw2019 from '../../images/icons/mw2019.jpg';
import mw2022 from '../../images/icons/mw2022.jpg';
import mw2023 from '../../images/icons/mw2023.jpg';

const page = usePage();
const user = ref(page.props.auth?.user || null);

const currentTime = ref('00:00:00');
const showMobileMenu = ref(false);
const showAdminDropdown = ref(false);
const showAdminMobile = ref(false);
const showCodWikiDropdown = ref(false);
const showCodWikiMobile = ref(false);
const headerHeight = ref(100); // Примерная высота header
let adminDropdownTimeout = null;
let codWikiDropdownTimeout = null;

// Блокировка прокрутки при открытии мобильного меню
watch(showMobileMenu, (isOpen) => {
  if (isOpen) {
    document.body.style.overflow = 'hidden';
    // Вычисляем точную высоту header
    nextTick(() => {
      const header = document.querySelector('header');
      if (header) {
        headerHeight.value = header.offsetHeight;
      }
    });
  } else {
    document.body.style.overflow = '';
  }
});

const updateTime = () => {
  const now = new Date();
  currentTime.value = now.toLocaleTimeString('ru-RU');
};

let intervalId;

onMounted(() => {
  updateTime();
  intervalId = window.setInterval(updateTime, 1000);
});

onUnmounted(() => {
  if (intervalId) {
    clearInterval(intervalId);
  }
  // Восстанавливаем прокрутку при размонтировании компонента
  document.body.style.overflow = '';
});

function openAdminDropdown() {
  if (adminDropdownTimeout) clearTimeout(adminDropdownTimeout);
  showAdminDropdown.value = true;
}
function closeAdminDropdown() {
  adminDropdownTimeout = window.setTimeout(() => {
    showAdminDropdown.value = false;
  }, 150);
}
function openCodWikiDropdown() {
  if (codWikiDropdownTimeout) clearTimeout(codWikiDropdownTimeout);
  showCodWikiDropdown.value = true;
}
function closeCodWikiDropdown() {
  codWikiDropdownTimeout = window.setTimeout(() => {
    showCodWikiDropdown.value = false;
  }, 150);
}
function toggleMobileMenu() {
  showMobileMenu.value = !showMobileMenu.value;
  if (!showMobileMenu.value) {
    showCodWikiMobile.value = false;
  }
}
function toggleCodWikiMenu() {
  showCodWikiMobile.value = !showCodWikiMobile.value;
}
function toggleAdminMenu() {
  showAdminMobile.value = !showAdminMobile.value;
}
</script>

<style scoped>
/* Терминальная сетка */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

/* Мигающий курсор */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}
@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Терминальный пункт меню */
.terminal-nav-item {
  @apply px-4 py-2 text-sm font-bold tracking-wider text-gray-400 transition-all font-mono;
}
.terminal-nav-item:hover {
  @apply text-orange-400;
}
</style>
