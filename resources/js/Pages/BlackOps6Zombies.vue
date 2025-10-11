<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img
        :src="backgroundImage"
        alt="Black Ops 6 Background"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-32 pb-12 px-6 relative">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-orange-950/20"></div>
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>
      <div class="container mx-auto relative z-10">
        <div class="mb-8 font-mono text-sm">
          <div class="text-orange-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> LOADING BLACK_OPS_6_ZOMBIES.exe
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> ACCESSING MAP DATABASE...
          </div>
          <div class="text-orange-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SELECT YOUR MAP
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-orange-600 to-transparent mb-8"></div>
        </div>
        <div class="mb-8">
          <h1 class="text-5xl md:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-600 to-orange-700 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              BLACK OPS 6
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>ZOMBIES</span>
              <span class="inline-block w-4 h-12 md:h-16 bg-orange-500 ml-4 cursor-blink"></span>
            </span>
          </h1>
          <div class="text-orange-600 font-mono text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> YEAR: 2024
          </div>
          <p class="text-lg text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Выберите карту из Call of Duty: Black Ops 6 — новейшая эпоха зомби-режима.
          </p>
        </div>
        <div class="mb-8">
          <button
            @click="$inertia.visit('/zombies')"
            class="px-6 py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-orange-600">&gt;</span> BACK_TO_GAMES
          </button>
        </div>
      </div>
    </section>
    <!-- Maps Grid Section -->
    <section class="py-12 px-6 relative">
      <div class="container mx-auto relative z-10">
        <div class="mb-8 font-mono">
          <div class="text-orange-500 text-sm mb-2">
            <span class="text-orange-600">&gt;</span> MAPS: 6
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 to-transparent max-w-md mb-8"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mb-16">
          <!-- Liberty Falls -->
          <div
            @click="navigateToGuides('liberty-falls')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="libertyfalls" alt="Liberty Falls" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_01
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">LIBERTY FALLS</h3>
                <p class="text-xs text-gray-400 font-mono">West Virginia Town</p>
              </div>
              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Terminus -->
          <div
            @click="navigateToGuides('terminus')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="terminus" alt="Terminus" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_02
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">TERMINUS</h3>
                <p class="text-xs text-gray-400 font-mono">Philippine Sea Prison</p>
              </div>
              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Citadelle des Morts -->
          <div
            @click="navigateToGuides('citadelle-des-morts')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="citadelledesmorts" alt="Citadelle des Morts" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_03
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">CITADELLE DES MORTS</h3>
                <p class="text-xs text-gray-400 font-mono">Medieval Castle</p>
              </div>
              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- The Tomb -->
          <div
            @click="navigateToGuides('the-tomb')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="thetomb" alt="The Tomb" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_04
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">THE TOMB</h3>
                <p class="text-xs text-gray-400 font-mono">Ancient Egypt</p>
              </div>
              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Shattered Veil -->
          <div
            @click="navigateToGuides('shattered-veil')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="shatteredveil" alt="Shattered Veil" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_05
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">SHATTERED VEIL</h3>
                <p class="text-xs text-gray-400 font-mono">Dimensional Rift</p>
              </div>
              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Reckoning -->
          <div
            @click="navigateToGuides('reckoning')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="reckoning" alt="Reckoning" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_06
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">RECKONING</h3>
                <p class="text-xs text-gray-400 font-mono">Final Battle</p>
              </div>
              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Header from '../Components/Header.vue';
import backgroundImage from '../../../public/images/blackops6background.jpg';
import libertyfalls from '../../images/blackops6zombies/libertyfalls.jpg';
import terminus from '../../images/blackops6zombies/terminus.jpg';
import citadelledesmorts from '../../images/blackops6zombies/citadelledesmorts.jpg';
import thetomb from '../../images/blackops6zombies/tomb.jpg';
import shatteredveil from '../../images/blackops6zombies/shatteredveil.jpg';
import reckoning from '../../images/blackops6zombies/reckoning.jpg';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || null);

const navigateToGuides = (mapSlug) => {
  if (!user.value) {
    router.visit('/register');
    return;
  }
  router.visit(`/zombies/Black Ops 6/${mapSlug}/guides`);
};
</script>

<style scoped>
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(249, 115, 22, 0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(249, 115, 22, 0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}
@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}
</style>
