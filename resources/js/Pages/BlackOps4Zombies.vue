<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img
        :src="backgroundImage"
        alt="Black Ops 4 Background"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f59e42 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-32 pb-12 px-6 relative">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-yellow-900/20"></div>
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(245, 158, 66, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(245, 158, 66, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>
      <div class="container mx-auto relative z-10">
        <div class="mb-8 font-mono text-sm">
          <div class="text-yellow-400 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-yellow-500">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-yellow-400/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-yellow-500">&gt;</span> LOADING BLACK_OPS_4_ZOMBIES.exe
          </div>
          <div class="text-yellow-400/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-yellow-500">&gt;</span> ACCESSING MAP DATABASE...
          </div>
          <div class="text-yellow-400 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-yellow-500">&gt;</span> SELECT YOUR MAP
          </div>
          <div class="h-px bg-gradient-to-r from-yellow-400 via-orange-400 to-transparent mb-8"></div>
        </div>
        <div class="mb-8">
          <h1 class="text-5xl md:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-orange-400 to-yellow-600 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              BLACK OPS IV
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>ZOMBIES</span>
              <span class="inline-block w-4 h-12 md:h-16 bg-yellow-400 ml-4 cursor-blink"></span>
            </span>
          </h1>
          <div class="text-yellow-500 font-mono text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-yellow-500">&gt;</span> YEAR: 2018
          </div>
          <p class="text-lg text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Выберите карту из Call of Duty: Black Ops 4 — новая эра зомби-режима с уникальными сюжетами.
          </p>
        </div>
        <div class="mb-8">
          <button
            @click="$inertia.visit('/zombies')"
            class="px-6 py-3 border-2 border-yellow-400/30 text-yellow-400 font-mono font-black hover:bg-yellow-400/10 transition-all flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-yellow-500">&gt;</span> BACK_TO_GAMES
          </button>
        </div>
      </div>
    </section>
    <!-- Maps Grid Section -->
    <section class="py-12 px-6 relative">
      <div class="container mx-auto relative z-10">
        <!-- Aether Story Section -->
        <div class="mb-16">
          <div class="mb-8 font-mono">
            <div class="text-yellow-400 text-xl font-black mb-2 uppercase">
              <span class="text-yellow-500">&gt;</span> AETHER STORY
            </div>
            <div class="text-yellow-400/70 text-sm mb-2">
              <span class="text-yellow-500">&gt;</span> MAPS: 4
            </div>
            <div class="h-px bg-gradient-to-r from-yellow-400 to-transparent max-w-md mb-8"></div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl">
            <!-- Blood of the Dead -->
            <div
              @click="navigateToGuides('blood-of-the-dead')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="bloodofthedead" alt="Blood of the Dead" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> AETHER_01
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">BLOOD OF THE DEAD</h3>
                  <p class="text-xs text-gray-400 font-mono">Alcatraz Penitentiary</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <!-- Classified -->
            <div
              @click="navigateToGuides('classified')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="classified" alt="Classified" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> AETHER_02
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">CLASSIFIED</h3>
                  <p class="text-xs text-gray-400 font-mono">Pentagon</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <!-- Alpha Omega -->
            <div
              @click="navigateToGuides('alpha-omega')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="alphaomega" alt="Alpha Omega" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> AETHER_03
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">ALPHA OMEGA</h3>
                  <p class="text-xs text-gray-400 font-mono">Broken Arrow Facility</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <!-- Tag Der Toten -->
            <div
              @click="navigateToGuides('tag-der-toten')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="tagdertoten" alt="Tag Der Toten" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> AETHER_04
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">TAG DER TOTEN</h3>
                  <p class="text-xs text-gray-400 font-mono">Siberia</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Chaos Story Section -->
        <div class="mb-16">
          <div class="mb-8 font-mono">
            <div class="text-yellow-400 text-xl font-black mb-2 uppercase">
              <span class="text-yellow-500">&gt;</span> CHAOS STORY
            </div>
            <div class="text-yellow-400/70 text-sm mb-2">
              <span class="text-yellow-500">&gt;</span> MAPS: 4
            </div>
            <div class="h-px bg-gradient-to-r from-yellow-400 to-transparent max-w-md mb-8"></div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl">
            <!-- IX -->
            <div
              @click="navigateToGuides('ix')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="ix" alt="IX" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> CHAOS_01
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">IX</h3>
                  <p class="text-xs text-gray-400 font-mono">Gladiator Arena</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <!-- Voyage of Despair -->
            <div
              @click="navigateToGuides('voyage-of-despair')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="voyageofdespair" alt="Voyage of Despair" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> CHAOS_02
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">VOYAGE OF DESPAIR</h3>
                  <p class="text-xs text-gray-400 font-mono">Titanic</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <!-- Dead of the Night -->
            <div
              @click="navigateToGuides('dead-of-the-night')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="deadofthenight" alt="Dead of the Night" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> CHAOS_03
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">DEAD OF THE NIGHT</h3>
                  <p class="text-xs text-gray-400 font-mono">Alistair's Mansion</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <!-- Ancient Evil -->
            <div
              @click="navigateToGuides('ancient-evil')"
              class="group relative border-2 border-yellow-400/30 hover:border-yellow-400 transition-all duration-300 cursor-pointer h-80"
            >
              <div class="absolute inset-0 overflow-hidden">
                <img :src="ancientevil" alt="Ancient Evil" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
                <div class="absolute inset-0 terminal-grid opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-yellow-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
              </div>
              <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
                <div>
                  <div class="font-mono text-xs text-yellow-400 mb-2">
                    <span class="text-yellow-500">&gt;</span> CHAOS_04
                  </div>
                  <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">ANCIENT EVIL</h3>
                  <p class="text-xs text-gray-400 font-mono">Delphi</p>
                </div>
                <div class="flex items-center space-x-2 text-yellow-400 font-mono text-sm group-hover:text-yellow-300 transition-colors">
                  <span class="text-yellow-500">&gt;</span>
                  <span>VIEW_GUIDE</span>
                  <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
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
import backgroundImage from '../../images/blackops4background.jpg';
import ix from '../../images/blackops4zombies/ix.jpg';
import bloodofthedead from '../../images/blackops4zombies/bloodofthedead.jpg';
import voyageofdespair from '../../images/blackops4zombies/voyageofdespair.jpg';
import classified from '../../images/blackops4zombies/classified.jpg';
import deadofthenight from '../../images/blackops4zombies/deadofthenight.jpg';
import ancientevil from '../../images/blackops4zombies/ancientevil.jpg';
import alphaomega from '../../images/blackops4zombies/alphaomega.jpg';
import tagdertoten from '../../images/blackops4zombies/tagdertoten.jpg';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || null);

const navigateToGuides = (mapSlug) => {
  if (!user.value) {
    // Если пользователь не авторизован, перенаправляем на страницу регистрации
    router.visit('/register');
    return;
  }
  router.visit(`/zombies/Black Ops 4/${mapSlug}/guides`);
};
</script>

<style scoped>
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(255,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(255,255,128,0.07) 0px, transparent 1px, transparent 2px);
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
  text-shadow: 0 0 20px rgba(245, 158, 66, 0.5);
}
</style>
