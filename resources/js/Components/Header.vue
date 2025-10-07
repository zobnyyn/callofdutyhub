<template>
  <header class="fixed top-0 left-0 right-0 z-40 bg-black/95 backdrop-blur-sm border-b border-orange-500/30">
    <!-- Terminal status bar -->
    <div class="border-b border-orange-900/30 bg-orange-950/20 px-6 py-1">
      <div class="flex items-center justify-between text-[10px] font-mono text-orange-400">
        <div class="flex items-center space-x-4">
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
            <span>SYSTEM_ACTIVE</span>
          </div>
          <span>|</span>
          <span>USER: OPERATOR_{{ Math.floor(Math.random() * 9999).toString().padStart(4, '0') }}</span>
          <span>|</span>
          <span>CLEARANCE: TOP_SECRET</span>
        </div>
        <div class="flex items-center space-x-4">
          <span id="terminal-time">{{ currentTime }}</span>
          <span>|</span>
          <span>CONNECTION: SECURE</span>
        </div>
      </div>
    </div>

    <nav class="container mx-auto px-6 py-4 relative">
      <div class="flex items-center justify-between">
        <!-- Logo with Terminal Style -->
        <div class="flex items-center space-x-4">
          <div class="relative group">
            <!-- Terminal-style rotating diamond -->
            <div class="w-14 h-14 relative">
              <div class="absolute inset-0 bg-gradient-to-br from-orange-600 to-red-700 transform rotate-45 overflow-hidden">
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute inset-0 terminal-grid"></div>
              </div>
              <div class="absolute inset-2 bg-black transform rotate-45"></div>
              <div class="absolute inset-0 border-2 border-orange-500/40 transform rotate-45 group-hover:border-orange-400 transition-colors"></div>
              <!-- Static cursor in center -->
              <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-2 h-3 bg-orange-500"></div>
            </div>
          </div>
          <div>
            <div class="text-2xl font-black tracking-tighter font-mono">
                <span class="text-orange-500">&gt; CALL OF DUTY <span class="text-white"></span></span>
            </div>
            <div class="text-[9px] text-white tracking-[0.3em] font-mono">TERMINAL_v3.0</div>
          </div>
        </div>

        <!-- Navigation - Terminal Style -->
        <div class="hidden md:flex items-center space-x-2">
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

        <!-- Auth Buttons - Terminal Style -->
        <div class="flex items-center space-x-3">
          <!-- Показываем профиль, если пользователь авторизован -->
          <UserProfile v-if="user" :user="user" />

          <!-- Показываем кнопки входа и регистрации для гостей -->
          <template v-else>
            <a href="/login" class="px-5 py-2 text-sm font-bold font-mono text-orange-500 border border-orange-500/30 hover:bg-orange-500/10 transition-all relative group">
              <span class="text-orange-600 mr-1">&gt;</span>
              <span>ВОЙТИ</span>
            </a>
            <a href="/register" class="px-6 py-2.5 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono tracking-wider transition-all relative overflow-hidden group">
              <span class="absolute inset-0 terminal-grid opacity-20" aria-hidden="true"></span>
              <span class="relative z-10">&gt; ЗАРЕГИСТРИРОВАТЬСЯ_</span>
              <span class="inline-block w-2 h-3 bg-black/50 ml-1 cursor-blink"></span>
            </a>
          </template>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import UserProfile from './UserProfile.vue';

const page = usePage();
const user = ref(page.props.auth?.user || null);

const currentTime = ref('00:00:00');
const showDropdown = ref(false);
const showMWDropdown = ref(false);
let dropdownTimeout = null;
let mwDropdownTimeout = null;

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
