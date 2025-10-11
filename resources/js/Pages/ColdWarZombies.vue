<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img
        :src="backgroundImage"
        alt="Cold War Background"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #dc2626 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-32 pb-12 px-6 relative">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-red-950/20"></div>
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(220, 38, 38, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(220, 38, 38, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>
      <div class="container mx-auto relative z-10">
        <div class="mb-8 font-mono text-sm">
          <div class="text-red-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-red-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> LOADING COLD_WAR_ZOMBIES.exe
          </div>
          <div class="text-red-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> ACCESSING MAP DATABASE...
          </div>
          <div class="text-red-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> SELECT YOUR MAP
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 via-red-600 to-transparent mb-8"></div>
        </div>
        <div class="mb-8">
          <h1 class="text-5xl md:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-red-600 to-red-700 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              BLACK OPS
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>COLD WAR</span>
              <span class="inline-block w-4 h-12 md:h-16 bg-red-500 ml-4 cursor-blink"></span>
            </span>
          </h1>
          <div class="text-red-600 font-mono text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> YEAR: 2020
          </div>
          <p class="text-lg text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Выберите карту из Call of Duty: Black Ops Cold War — новая эпоха Dark Aether.
          </p>
        </div>
        <div class="mb-8">
          <button
            @click="$inertia.visit('/zombies')"
            class="px-6 py-3 border-2 border-red-500/30 text-red-500 font-mono font-black hover:bg-red-500/10 transition-all flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-red-600">&gt;</span> BACK_TO_GAMES
          </button>
        </div>
      </div>
    </section>
    <!-- Maps Grid Section -->
    <section class="py-12 px-6 relative">
      <div class="container mx-auto relative z-10">
        <div class="mb-8 font-mono">
          <div class="text-red-500 text-sm mb-2">
            <span class="text-red-600">&gt;</span> MAPS: 5
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 to-transparent max-w-md mb-8"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mb-16">
          <!-- Die Maschine -->
          <div
            @click="navigateToGuides('die-maschine')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="diemaschine" alt="Die Maschine" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_01
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">DIE MASCHINE</h3>
                <p class="text-xs text-gray-400 font-mono">Nacht der Untoten Facility</p>
              </div>
              <div class="flex items-center space-x-2 text-red-500 font-mono text-sm group-hover:text-red-400 transition-colors">
                <span class="text-red-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Firebase Z -->
          <div
            @click="navigateToGuides('firebase-z')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="firebasez" alt="Firebase Z" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_02
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">FIREBASE Z</h3>
                <p class="text-xs text-gray-400 font-mono">Outpost 25</p>
              </div>
              <div class="flex items-center space-x-2 text-red-500 font-mono text-sm group-hover:text-red-400 transition-colors">
                <span class="text-red-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Outbreak -->
          <div
            @click="navigateToGuides('outbreak')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="outbreak" alt="Outbreak" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_03
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">OUTBREAK</h3>
                <p class="text-xs text-gray-400 font-mono">Open World</p>
              </div>
              <div class="flex items-center space-x-2 text-red-500 font-mono text-sm group-hover:text-red-400 transition-colors">
                <span class="text-red-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Mauer der Toten -->
          <div
            @click="navigateToGuides('mauer-der-toten')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="mauerdertoten" alt="Mauer der Toten" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_04
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">MAUER DER TOTEN</h3>
                <p class="text-xs text-gray-400 font-mono">Berlin</p>
              </div>
              <div class="flex items-center space-x-2 text-red-500 font-mono text-sm group-hover:text-red-400 transition-colors">
                <span class="text-red-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
          <!-- Forsaken -->
          <div
            @click="navigateToGuides('forsaken')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img :src="forsaken" alt="Forsaken" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>
            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_05
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">FORSAKEN</h3>
                <p class="text-xs text-gray-400 font-mono">Abandoned Mall</p>
              </div>
              <div class="flex items-center space-x-2 text-red-500 font-mono text-sm group-hover:text-red-400 transition-colors">
                <span class="text-red-600">&gt;</span>
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
import backgroundImage from '../../../public/images/blackopscoldwarbackground.jpg';
import diemaschine from '../../images/blackopscoldwarzombies/diemashin.jpg';
import firebasez from '../../images/blackopscoldwarzombies/firebazez.jpg';
import outbreak from '../../images/blackopscoldwarzombies/outbreak.jpg';
import mauerdertoten from '../../images/blackopscoldwarzombies/mauerdertoten.jpg';
import forsaken from '../../images/blackopscoldwarzombies/forsaken.jpg';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || null);

const navigateToGuides = (mapSlug) => {
  if (!user.value) {
    router.visit('/register');
    return;
  }
  router.visit(`/zombies/Cold War/${mapSlug}/guides`);
};
</script>

<style scoped>
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(220, 38, 38, 0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(220, 38, 38, 0.07) 0px, transparent 1px, transparent 2px);
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
  text-shadow: 0 0 20px rgba(220, 38, 38, 0.5);
}
</style>
