<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img
        :src="backgroundImage"
        alt="World at War Background"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #dc2626 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-20 md:pt-32 pb-8 md:pb-12 px-3 md:px-6 relative">
      <!-- Background with blur effect -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-red-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(220, 38, 38, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(220, 38, 38, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <!-- Terminal Header -->
        <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
          <div class="text-red-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-red-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> LOADING WORLD_AT_WAR_ZOMBIES.exe
          </div>
          <div class="text-red-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> ACCESSING MAP DATABASE...
          </div>
          <div class="text-red-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> SELECT YOUR MAP
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 via-red-600 to-transparent mb-8"></div>
        </div>

        <!-- Main Title -->
        <div class="mb-6 md:mb-8">
          <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-red-600 to-red-700 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              WORLD AT WAR
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>ZOMBIES</span>
              <span class="inline-block w-3 h-8 sm:h-10 md:h-12 lg:h-16 bg-red-500 ml-2 md:ml-4 cursor-blink"></span>
            </span>
          </h1>

          <div class="text-red-600 font-mono text-xs md:text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-red-600">&gt;</span> YEAR: 2008
          </div>
          <p class="text-sm md:text-base lg:text-lg text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Выберите карту из Call of Duty: World at War - первой игры с режимом Zombies.
          </p>
        </div>

        <!-- Back Button -->
        <div class="mb-6 md:mb-8">
          <button
            @click="$inertia.visit('/zombies')"
            class="px-4 md:px-6 py-2 md:py-3 border-2 border-red-500/30 text-red-500 font-mono font-black hover:bg-red-500/10 transition-all flex items-center gap-2 text-sm md:text-base"
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
    <section class="py-8 md:py-12 px-3 md:px-6 relative">
      <div class="container mx-auto relative z-10">
        <!-- Section Header -->
        <div class="mb-6 md:mb-8 font-mono">
          <div class="text-red-500 text-xs md:text-sm mb-2">
            <span class="text-red-600">&gt;</span> AVAILABLE_MAPS: 4
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 to-transparent max-w-md mb-6 md:mb-8"></div>
        </div>

        <!-- Maps Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 max-w-7xl">

          <!-- Nacht der Untoten -->
          <div
            @click="navigateToGuides('nacht-der-untoten')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="nachtderuntoten"
                alt="Nacht der Untoten"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_01
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  NACHT DER<br/>UNTOTEN
                </h3>
                <p class="text-xs text-gray-400 font-mono">Night of the Undead</p>
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

          <!-- Verrückt -->
          <div
            @click="navigateToGuides('verruckt')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="verruct"
                alt="Verrückt"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_02
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  VERRÜCKT
                </h3>
                <p class="text-xs text-gray-400 font-mono">Asylum</p>
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

          <!-- Shi No Numa -->
          <div
            @click="navigateToGuides('shi-no-numa')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="shinonuma"
                alt="Shi No Numa"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_03
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  SHI NO NUMA
                </h3>
                <p class="text-xs text-gray-400 font-mono">Swamp of Death</p>
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

          <!-- Der Riese -->
          <div
            @click="navigateToGuides('der-riese')"
            class="group relative border-2 border-red-500/30 hover:border-red-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="derriese"
                alt="Der Riese"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-red-500 mb-2">
                  <span class="text-red-600">&gt;</span> MAP_04
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  DER RIESE
                </h3>
                <p class="text-xs text-gray-400 font-mono">The Giant</p>
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
import nachtderuntoten from '../../images/worldatwarzombies/nachtderuntoten.jpg';
import verruct from '../../images/worldatwarzombies/verruct.jpg';
import shinonuma from '../../images/worldatwarzombies/shinonuma.jpg';
import derriese from '../../images/worldatwarzombies/derrise.jpg';
import backgroundImage from '../../images/worlaatwarbackgound.png';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || null);

const navigateToGuides = (mapSlug) => {
  if (!user.value) {
    router.visit('/register');
    return;
  }
  router.visit(`/zombies/World at War/${mapSlug}/guides`);
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
  text-shadow: 0 0 20px rgba(220, 38, 38, 0.5);
}
</style>
