<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Weapon Detail Section -->
    <section class="pt-40 pb-24 px-6 relative">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-7xl mx-auto">
          <!-- Breadcrumb -->
          <div class="mb-8 font-mono text-sm">
            <Link href="/warzone/meta" class="text-orange-500 hover:text-orange-400 transition-colors">
              <span class="text-orange-600">&gt;</span> WARZONE_META
            </Link>
            <span class="text-orange-600 mx-2">/</span>
            <span class="text-gray-500">{{ weapon.name }}</span>
          </div>

          <!-- Weapon Header -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Image -->
            <div class="lg:col-span-1">
              <div class="border-2 border-orange-500/30 bg-black/60 p-6 aspect-square flex items-center justify-center">
                <img v-if="weapon.image" :src="`/storage/${weapon.image}`" :alt="weapon.name" class="max-w-full max-h-full object-contain" />
                <svg v-else class="w-32 h-32 text-orange-500/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
            </div>

            <!-- Info -->
            <div class="lg:col-span-2 space-y-6">
              <!-- Title & Tier -->
              <div>
                <h1 class="text-4xl md:text-6xl font-black mb-4 leading-none uppercase font-mono text-white">
                  {{ weapon.name }}
                </h1>
                <div class="flex flex-wrap items-center gap-3">
                  <span class="px-3 py-1 text-sm font-mono bg-orange-500/10 border border-orange-500/30 text-orange-400 uppercase">
                    {{ formatCategory(weapon.category) }}
                  </span>
                  <span class="px-3 py-1 text-sm font-mono bg-black border border-orange-500/30 text-orange-400">
                    {{ formatOrigin(weapon.origin_game) }}
                  </span>
                </div>
              </div>

              <!-- Description -->
              <div v-if="weapon.description" class="border-l-2 border-orange-500 pl-4">
                <div class="text-xs text-orange-600 font-mono mb-2">DESCRIPTION:</div>
                <p class="text-gray-300 font-mono text-sm leading-relaxed">{{ weapon.description }}</p>
              </div>

              <!-- Meta Info -->
              <div class="border border-orange-500/30 bg-orange-500/5 p-4">
                <div class="grid grid-cols-2 gap-4 text-sm font-mono">
                  <div>
                    <div class="text-orange-600 text-xs mb-1">BUILDS:</div>
                    <div class="text-white">{{ weapon.builds.length }}</div>
                  </div>
                  <div>
                    <div class="text-orange-600 text-xs mb-1">UPDATED:</div>
                    <div class="text-white">{{ formatDate(weapon.updated_at) }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Builds Section -->
          <div class="border-t-2 border-orange-500/30 pt-12">
            <div class="mb-8">
              <h2 class="text-3xl md:text-4xl font-black text-orange-500 uppercase font-mono flex items-center">
                <span class="text-orange-600">&gt;</span>
                <span class="ml-2">WEAPON BUILDS</span>
                <span class="inline-block w-2 h-6 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>

            <div v-if="weapon.builds.length === 0" class="text-center py-16 border-2 border-orange-500/30 bg-orange-500/5">
              <div class="text-gray-500 font-mono text-lg mb-2">
                <span class="text-orange-600">&gt;</span> NO_BUILDS_AVAILABLE
              </div>
              <p class="text-sm text-gray-600 font-mono">Сборки для этого оружия пока не добавлены</p>
            </div>

            <div v-else class="space-y-6">
              <BuildBlock v-for="build in weapon.builds" :key="build.id" :build="build" />
            </div>
          </div>

          <!-- Back Button -->
          <div class="mt-12 flex justify-center">
            <Link href="/warzone/meta" class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black font-black font-mono transition-all">
              <span class="text-orange-900">&gt;</span> BACK_TO_META
            </Link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import BuildBlock from '@/Components/Warzone/BuildBlock.vue';

defineProps({
  weapon: {
    type: Object,
    required: true
  }
});

const formatOrigin = (origin) => {
  const map = {
    'mw2022': 'Modern Warfare II (2022)',
    'mw2023': 'Modern Warfare III (2023)',
    'bo6': 'Black Ops 6 (2024)'
  };
  return map[origin] || origin;
};

const formatCategory = (category) => {
  const map = {
    'ar': 'Assault Rifle',
    'smg': 'SMG',
    'lmg': 'LMG',
    'marksman': 'Marksman Rifle',
    'sniper': 'Sniper Rifle',
    'shotgun': 'Shotgun',
    'pistol': 'Pistol',
    'launcher': 'Launcher',
    'melee': 'Melee',
    'tactical': 'Tactical',
    'battlerifle': 'Battle Rifle'
  };
  return map[category] || category.toUpperCase();
};

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  });
};
</script>

<style scoped>
.cursor-blink { animation: blink 1s steps(1) infinite; }
@keyframes blink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }
</style>
