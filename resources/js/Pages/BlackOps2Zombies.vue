<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img
        :src="backgroundImage"
        alt="Black Ops 2 Background"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-20 md:pt-32 pb-8 md:pb-12 px-3 md:px-6 relative">
      <!-- Background with blur effect -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-orange-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <!-- Terminal Header -->
        <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
          <div class="text-orange-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> LOADING BLACK_OPS_2_ZOMBIES.exe
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> ACCESSING MAP DATABASE...
          </div>
          <div class="text-orange-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SELECT YOUR MAP
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
        </div>

        <!-- Main Title -->
        <div class="mb-6 md:mb-8">
          <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              BLACK OPS II
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>ZOMBIES</span>
              <span class="inline-block w-3 h-8 sm:h-10 md:h-12 lg:h-16 bg-orange-500 ml-2 md:ml-4 cursor-blink"></span>
            </span>
          </h1>

          <div class="text-orange-600 font-mono text-xs md:text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> YEAR: 2012
          </div>
          <p class="text-sm md:text-base lg:text-lg text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Выберите карту из Call of Duty: Black Ops 2 - новая эра Zombies с открытым миром.
          </p>
        </div>

        <!-- Back Button -->
        <div class="mb-6 md:mb-8">
          <button
            @click="$inertia.visit('/zombies')"
            class="px-4 md:px-6 py-2 md:py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2 text-sm md:text-base"
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
    <section class="py-8 md:py-12 px-3 md:px-6 relative">
      <div class="container mx-auto relative z-10">
        <!-- Section Header -->
        <div class="mb-6 md:mb-8 font-mono">
          <div class="text-orange-500 text-xs md:text-sm mb-2">
            <span class="text-orange-600">&gt;</span> AVAILABLE_MAPS: 6
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 to-transparent max-w-md mb-6 md:mb-8"></div>
        </div>

        <!-- Maps Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 max-w-7xl">

          <!-- TranZit -->
          <div
            @click="navigateToGuides('tranzit')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="tranzit"
                alt="TranZit"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_01
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  TRANZIT
                </h3>
                <p class="text-xs text-gray-400 font-mono">Green Run</p>
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

          <!-- Nuketown Zombies -->
          <div
            @click="navigateToGuides('nuketown-zombies')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="nuketown"
                alt="Nuketown Zombies"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_02
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  NUKETOWN<br/>ZOMBIES
                </h3>
                <p class="text-xs text-gray-400 font-mono">Nuketown 2025</p>
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

          <!-- Die Rise -->
          <div
            @click="navigateToGuides('die-rise')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="dierise"
                alt="Die Rise"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_03
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  DIE RISE
                </h3>
                <p class="text-xs text-gray-400 font-mono">Great Leap Forward</p>
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

          <!-- Mob of the Dead -->
          <div
            @click="navigateToGuides('mob-of-the-dead')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="mobofthedead"
                alt="Mob of the Dead"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_04
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  MOB OF THE<br/>DEAD
                </h3>
                <p class="text-xs text-gray-400 font-mono">Alcatraz Island</p>
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

          <!-- Buried -->
          <div
            @click="navigateToGuides('buried')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="buried"
                alt="Buried"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_05
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  BURIED
                </h3>
                <p class="text-xs text-gray-400 font-mono">Resolution 1295</p>
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

          <!-- Origins -->
          <div
            @click="navigateToGuides('origins')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="origins"
                alt="Origins"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_06
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  ORIGINS
                </h3>
                <p class="text-xs text-gray-400 font-mono">Apocalypse</p>
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
import backgroundImage from '../../images/blackops2background.jpg';
import tranzit from '../../images/blackops2zombies/tranzit.jpg';
import nuketown from '../../images/blackops2zombies/nucketown.jpg';
import dierise from '../../images/blackops2zombies/dierise.jpg';
import mobofthedead from '../../images/blackops2zombies/mobofthedead.jpg';
import buried from '../../images/blackops2zombies/buried.jpg';
import origins from '../../images/blackops2zombies/origins.jpg';
import { router } from '@inertiajs/vue3';

const navigateToGuides = (mapSlug) => {
  router.visit(`/zombies/Black Ops 2/${mapSlug}/guides`);
};
</script>

<style scoped>
/* Terminal Grid */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

/* Cursor Blink */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}
</style>
