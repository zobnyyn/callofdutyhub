<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-32 pb-12 px-6 relative">
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
        <div class="mb-8 font-mono text-sm">
          <div class="text-orange-500 mb-2">
            <span class="text-orange-600">&gt;</span> LOADING {{ mapInfo?.name?.toUpperCase() }}
          </div>
          <div class="text-orange-500/70 mb-2">
            <span class="text-orange-600">&gt;</span> {{ mapInfo?.description }}
          </div>
          <div class="text-orange-500 mb-4">
            <span class="text-orange-600">&gt;</span> GUIDES_FOUND: {{ guides.length }}
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
        </div>

        <!-- Map Title -->
        <div class="mb-8">
          <h1 class="text-5xl md:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              {{ mapInfo?.name }}
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>GUIDES</span>
              <span class="inline-block w-4 h-12 md:h-16 bg-orange-500 ml-4 cursor-blink"></span>
            </span>
          </h1>
        </div>

        <!-- Back Button -->
        <div class="mb-8">
          <button
            @click="backToMaps"
            class="px-6 py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-orange-600">&gt;</span> BACK_TO_MAPS
          </button>
        </div>
      </div>
    </section>

    <!-- Guides List Section -->
    <section class="py-12 px-6 relative">
      <div class="container mx-auto relative z-10">

        <!-- No guides message -->
        <div v-if="guides.length === 0" class="text-center py-20">
          <div class="font-mono text-orange-500 mb-4">
            <span class="text-orange-600">&gt;</span> NO_GUIDES_FOUND
          </div>
          <p class="text-gray-400">Для этой карты пока нет опубликованных гайдов.</p>
        </div>

        <!-- Guides Grid -->
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl">
          <div
            v-for="guide in guides"
            :key="guide.id"
            @click="openGuide(guide)"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer"
          >
            <!-- Guide Image -->
            <div class="aspect-video overflow-hidden relative">
              <img
                v-if="guide.image"
                :src="`/storage/${guide.image}`"
                :alt="guide.title"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div v-else class="w-full h-full bg-gradient-to-br from-orange-900/20 to-black flex items-center justify-center">
                <svg class="w-16 h-16 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- Guide Content -->
            <div class="p-6">
              <div class="font-mono text-xs text-orange-500 mb-2 flex items-center justify-between">
                <span>
                  <span class="text-orange-600">&gt;</span> GUIDE_{{ String(guide.id).padStart(3, '0') }}
                </span>
                <span class="flex items-center gap-2 text-orange-500/70">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  {{ guide.views }}
                </span>
              </div>

              <h3 class="text-xl font-black text-white mb-3 uppercase font-mono leading-tight group-hover:text-orange-500 transition-colors">
                {{ guide.title }}
              </h3>

              <p v-if="guide.description" class="text-sm text-gray-400 mb-4 line-clamp-2">
                {{ guide.description }}
              </p>

              <div class="flex items-center justify-between pt-4 border-t border-orange-500/20">
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 rounded-full bg-orange-500/20 flex items-center justify-center text-orange-500 font-mono text-xs font-bold">
                    {{ guide.user?.name?.charAt(0)?.toUpperCase() || '?' }}
                  </div>
                  <span class="text-sm text-gray-400 font-mono">{{ guide.user?.name || 'Unknown' }}</span>
                </div>

                <div class="flex items-center space-x-2 text-orange-500 font-mono text-xs group-hover:text-orange-400 transition-colors">
                  <span>READ</span>
                  <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';

const props = defineProps({
  guides: Array,
  game: String,
  mapSlug: String,
  mapInfo: Object
});

const openGuide = (guide) => {
  router.visit(`/zombies/${props.game}/${props.mapSlug}/guides/${guide.id}`);
};

const backToMaps = () => {
  // Динамическое определение страницы возврата на основе названия игры
  const gameRoutes = {
    'World at War': '/zombies/world-at-war',
    'Black Ops': '/zombies/black-ops',
    'Black Ops 2': '/zombies/black-ops-2',
    'Black Ops 3': '/zombies/black-ops-3',
    'Black Ops 4': '/zombies/black-ops-4',
    'Cold War': '/zombies/cold-war',
    'Black Ops 6': '/zombies/black-ops-6',
  };

  const route = gameRoutes[props.game] || '/zombies';
  router.visit(route);
};
</script>

<style scoped>
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

/* Line clamp utility */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
