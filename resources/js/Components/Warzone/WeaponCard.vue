<template>
  <Link :href="`/warzone/meta/weapons/${weapon.slug}`" class="block border-2 border-orange-500/30 bg-black/80 hover:border-orange-500 hover:bg-orange-500/5 transition-all duration-300 group">
    <!-- Image Section -->
    <div class="relative h-48 bg-gradient-to-br from-zinc-900 to-black overflow-hidden">
      <div v-if="weapon.image" class="absolute inset-0">
        <img :src="`/storage/${weapon.image}`" :alt="weapon.name" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500" />
      </div>
      <div v-else class="absolute inset-0 flex items-center justify-center">
        <svg class="w-20 h-20 text-orange-500/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
      </div>

      <!-- Origin Badge -->
      <div class="absolute top-3 right-3 z-10">
        <span class="px-2 py-1 text-xs font-mono bg-black/80 border border-orange-500/30 text-orange-400">
          {{ formatOrigin(weapon.origin_game) }}
        </span>
      </div>

      <!-- Builds Count -->
      <div v-if="weapon.builds_count > 0" class="absolute bottom-3 right-3 z-10">
        <span class="px-2 py-1 text-xs font-black font-mono bg-orange-600 text-black">
          {{ weapon.builds_count }} BUILD{{ weapon.builds_count > 1 ? 'S' : '' }}
        </span>
      </div>
    </div>

    <!-- Info Section -->
    <div class="p-4 border-t-2 border-orange-500/30">
      <h3 class="text-lg font-black font-mono text-white uppercase mb-2 group-hover:text-orange-500 transition-colors">
        {{ weapon.name }}
      </h3>

      <div class="flex items-center gap-2 mb-2">
        <span class="px-2 py-1 text-xs font-mono bg-orange-500/10 border border-orange-500/30 text-orange-400 uppercase">
          {{ formatCategory(weapon.category) }}
        </span>
      </div>

      <p v-if="weapon.description" class="text-xs text-gray-400 font-mono line-clamp-2 mt-2">
        {{ weapon.description }}
      </p>
    </div>

    <!-- Hover Effect -->
    <div class="h-0.5 bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  weapon: {
    type: Object,
    required: true
  }
});

const formatOrigin = (origin) => {
  const map = {
    'mw2022': 'MW2 22',
    'mw2023': 'MW3 23',
    'bo6': 'BO6 24'
  };
  return map[origin] || origin;
};

const formatCategory = (category) => {
  const map = {
    'ar': 'Assault Rifle',
    'smg': 'SMG',
    'lmg': 'LMG',
    'marksman': 'Marksman',
    'sniper': 'Sniper',
    'shotgun': 'Shotgun',
    'pistol': 'Pistol',
    'launcher': 'Launcher',
    'melee': 'Melee',
    'tactical': 'Tactical',
    'battlerifle': 'Battle Rifle'
  };
  return map[category] || category.toUpperCase();
};
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
