<template>
  <Link
    :href="`/warzone/meta/${weapon.slug}`"
    class="group block border-2 border-orange-500/30 bg-black/50 hover:bg-orange-500/5 transition-all relative"
  >
    <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

    <div class="p-3 md:p-4 flex items-center gap-3 md:gap-4">
      <!-- Weapon Info - всё в одну строку -->
      <div class="flex-1 min-w-0 flex items-center gap-3 md:gap-4 flex-wrap md:flex-nowrap">
        <!-- Weapon Name -->
        <h3 class="text-base md:text-lg font-black text-white uppercase tracking-tight truncate group-hover:text-orange-500 transition-colors font-mono min-w-[120px]">
          {{ weapon.name }}
        </h3>

        <!-- Divider -->
        <span class="hidden md:inline text-orange-500/30">|</span>

        <!-- Origin - цветной тег -->
        <span :class="getOriginColorClass(weapon.origin_game)" class="font-bold border px-2 py-0.5 rounded text-[10px] md:text-xs whitespace-nowrap">
          {{ getOriginLabel(weapon.origin_game) }}
        </span>

        <!-- Category -->
        <span class="text-gray-500 font-semibold text-xs whitespace-nowrap">
          {{ getCategoryLabel(weapon.category) }}
        </span>

        <!-- Builds Count -->
        <span v-if="weapon.builds_count > 0" class="text-gray-400 font-semibold text-xs whitespace-nowrap">
          {{ weapon.builds_count }} {{ weapon.builds_count === 1 ? 'сборка' : weapon.builds_count < 5 ? 'сборки' : 'сборок' }}
        </span>
      </div>

      <!-- Arrow Icon -->
      <div class="flex-shrink-0">
        <div class="text-orange-500/50 group-hover:text-orange-500 transition-all group-hover:translate-x-1 font-mono text-lg md:text-xl">
          &gt;
        </div>
      </div>
    </div>
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

const getOriginLabel = (origin) => {
  const labels = {
    'mw2022': 'MW2',
    'mw2023': 'MW3',
    'bo6': 'BO6'
  };
  return labels[origin] || origin;
};

const getOriginColorClass = (origin) => {
  const classes = {
    'mw2022': 'text-green-400 border-green-500/50 bg-black',
    'mw2023': 'text-red-400 border-red-500/50 bg-black',
    'bo6': 'text-orange-400 border-orange-500/50 bg-black'
  };
  return classes[origin] || 'text-white border-white/50 bg-white/10';
};

const getCategoryLabel = (category) => {
  const labels = {
    'ar': 'AR',
    'smg': 'SMG',
    'lmg': 'LMG',
    'marksman': 'MARKSMAN',
    'sniper': 'SNIPER',
    'shotgun': 'SHOTGUN',
    'pistol': 'PISTOL',
    'launcher': 'LAUNCHER',
    'melee': 'MELEE',
    'tactical': 'TACTICAL',
    'battlerifle': 'BR'
  };
  return labels[category] || category;
};
</script>
