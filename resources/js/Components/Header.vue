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
             @mouseenter="openDropdown"
             @mouseleave="closeDropdown"
             @focusin="openDropdown"
             @focusout="closeDropdown">
            <a href="#" class="terminal-nav-item flex items-center group">
              <span class="text-orange-600 font-mono mr-1">&gt;</span>
              <span class="group-hover:text-orange-400">BLACK OPS</span>
            </a>
            <!-- Dropdown -->
            <div v-show="showDropdown" class="absolute left-0 mt-2 w-56 bg-black border border-orange-600/30 rounded-md shadow-lg opacity-100 pointer-events-auto transform translate-y-0 transition-all duration-150 z-50"
              @mouseenter="openDropdown" @mouseleave="closeDropdown">
              <ul class="py-2">
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: World at War (2008)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops (2010)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops II (2012)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops III (2015)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops 4 (2018)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops Cold War (2020)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops 6 (2024)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Black Ops 7 (2025)</a></li>
              </ul>
            </div>
          </div>
          <span class="text-orange-900">|</span>
          <div class="relative"
             @mouseenter="openMWDropdown"
             @mouseleave="closeMWDropdown"
             @focusin="openMWDropdown"
             @focusout="closeMWDropdown">
            <a href="#" class="terminal-nav-item flex items-center group">
              <span class="text-orange-600 font-mono mr-1">&gt;</span>
              <span class="group-hover:text-orange-400">MODERN WARFARE</span>
            </a>
            <div v-show="showMWDropdown" class="absolute left-0 mt-2 w-56 bg-black border border-orange-600/30 rounded-md shadow-lg opacity-100 pointer-events-auto transform translate-y-0 transition-all duration-150 z-50"
              @mouseenter="openMWDropdown" @mouseleave="closeMWDropdown">
              <ul class="py-2">
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty 4: Modern Warfare (2007)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Modern Warfare 2 (2009)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Modern Warfare 3 (2011)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Modern Warfare Remastered (2016)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Modern Warfare (2019)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Modern Warfare II (2022)</a></li>
                <li><a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400">Call of Duty: Modern Warfare III (2023)</a></li>
              </ul>
            </div>
          </div>
          <span class="text-orange-900">|</span>
          <a href="#" class="terminal-nav-item group">
            <span class="text-orange-600 font-mono mr-1">&gt;</span>
            <span class="group-hover:text-orange-400">СООБЩЕСТВО</span>
          </a>
          <template v-if="user && user.is_admin">
            <span class="text-orange-900">|</span>
            <a href="/admin/guides" class="terminal-nav-item group">
              <span class="text-orange-600 font-mono mr-1">&gt;</span>
              <span class="group-hover:text-orange-400">АДМИНКА</span>
            </a>
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

          <!-- Mobile Black Ops Submenu -->
          <div class="border border-orange-500/40 bg-orange-500/10">
            <button
              @click="toggleBlackOpsMenu"
              class="w-full px-4 py-3 text-sm font-mono text-orange-500 hover:bg-orange-500/20 transition-all flex items-center justify-between"
            >
              <span><span class="text-orange-600 mr-2">&gt;</span>BLACK OPS</span>
              <svg
                class="w-4 h-4 transition-transform"
                :class="{ 'rotate-180': showBlackOpsMobile }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div v-show="showBlackOpsMobile" class="bg-orange-950/30">
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">World at War (2008)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Black Ops (2010)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Black Ops II (2012)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Black Ops III (2015)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Black Ops 4 (2018)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Cold War (2020)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Black Ops 6 (2024)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">Black Ops 7 (2025)</a>
            </div>
          </div>

          <!-- Mobile Modern Warfare Submenu -->
          <div class="border border-orange-500/40 bg-orange-500/10">
            <button
              @click="toggleMWMenu"
              class="w-full px-4 py-3 text-sm font-mono text-orange-500 hover:bg-orange-500/20 transition-all flex items-center justify-between"
            >
              <span><span class="text-orange-600 mr-2">&gt;</span>MODERN WARFARE</span>
              <svg
                class="w-4 h-4 transition-transform"
                :class="{ 'rotate-180': showMWMobile }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div v-show="showMWMobile" class="bg-orange-950/30">
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">COD 4: MW (2007)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">MW 2 (2009)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">MW 3 (2011)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">MW Remastered (2016)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">MW (2019)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">MW II (2022)</a>
              <a href="#" class="block px-6 py-2 text-xs text-gray-300 hover:bg-orange-500/20 hover:text-orange-400 border-t border-orange-500/20">MW III (2023)</a>
            </div>
          </div>

          <a href="#" class="block px-4 py-3 text-sm font-mono text-orange-500 bg-orange-500/10 border border-orange-500/40 hover:bg-orange-500/20 hover:border-orange-500 transition-all">
            <span class="text-orange-600 mr-2">&gt;</span>СООБЩЕСТВО
          </a>

          <template v-if="user && user.is_admin">
            <a href="/admin/guides" class="block px-4 py-3 text-sm font-mono text-orange-500 bg-orange-500/10 border border-orange-500/40 hover:bg-orange-500/20 hover:border-orange-500 transition-all">
              <span class="text-orange-600 mr-2">&gt;</span>АДМИНКА
            </a>
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

const page = usePage();
const user = ref(page.props.auth?.user || null);

const currentTime = ref('00:00:00');
const showDropdown = ref(false);
const showMWDropdown = ref(false);
const showMobileMenu = ref(false);
const showBlackOpsMobile = ref(false);
const showMWMobile = ref(false);
const headerHeight = ref(100); // Примерная высота header
let dropdownTimeout = null;
let mwDropdownTimeout = null;

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

function openDropdown() {
  if (dropdownTimeout) clearTimeout(dropdownTimeout);
  showDropdown.value = true;
}
function closeDropdown() {
  dropdownTimeout = window.setTimeout(() => {
    showDropdown.value = false;
  }, 150);
}
function openMWDropdown() {
  if (mwDropdownTimeout) clearTimeout(mwDropdownTimeout);
  showMWDropdown.value = true;
}
function closeMWDropdown() {
  mwDropdownTimeout = window.setTimeout(() => {
    showMWDropdown.value = false;
  }, 150);
}
function toggleMobileMenu() {
  showMobileMenu.value = !showMobileMenu.value;
  if (!showMobileMenu.value) {
    showBlackOpsMobile.value = false;
    showMWMobile.value = false;
  }
}
function toggleBlackOpsMenu() {
  showBlackOpsMobile.value = !showBlackOpsMobile.value;
}
function toggleMWMenu() {
  showMWMobile.value = !showMWMobile.value;
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
