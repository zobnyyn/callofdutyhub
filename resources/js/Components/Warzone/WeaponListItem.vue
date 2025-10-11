<template>
  <Link
    :href="`/warzone/meta/${weapon.slug}`"
    :class="[
      'group block border-2 bg-black/50 hover:bg-orange-500/5 transition-all relative',
      getTierBorderClass(weapon.tier)
    ]"
  >
    <div :class="['absolute top-0 left-0 w-full h-px', getTierLineClass(weapon.tier)]"></div>

    <div class="p-3 md:p-4 flex items-center gap-3 md:gap-4">
      <!-- Weapon Info - всё в одну строку -->
      <div class="flex-1 min-w-0 flex items-center gap-3 md:gap-4 flex-wrap md:flex-nowrap">
        <!-- Weapon Name -->
        <h3 :class="['text-base md:text-lg font-black uppercase tracking-tight truncate transition-colors font-mono min-w-[120px]', getTierTextClass(weapon.tier)]">
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
        <div :class="['transition-all group-hover:translate-x-1 font-mono text-lg md:text-xl', getTierArrowClass(weapon.tier)]">
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

const getTierBorderClass = (tier) => {
  const classes = {
    'imba_patch': 'border-red-500/30 hover:border-red-500/60',
    'meta': 'border-orange-500/30 hover:border-orange-500/60',
    'normal': 'border-blue-400/30 hover:border-blue-400/60',
    'avoid': 'border-gray-500/30 hover:border-gray-500/60'
  };
  return classes[tier] || 'border-orange-500/30 hover:border-orange-500/60';
};

const getTierLineClass = (tier) => {
  const classes = {
    'imba_patch': 'bg-red-500',
    'meta': 'bg-orange-500',
    'normal': 'bg-blue-400',
    'avoid': 'bg-gray-500'
  };
  return classes[tier] || 'bg-orange-500';
};

const getTierTextClass = (tier) => {
  const classes = {
    'imba_patch': 'text-white group-hover:text-red-500',
    'meta': 'text-white group-hover:text-orange-500',
    'normal': 'text-white group-hover:text-blue-400',
    'avoid': 'text-white group-hover:text-gray-400'
  };
  return classes[tier] || 'text-white group-hover:text-orange-500';
};

const getTierArrowClass = (tier) => {
  const classes = {
    'imba_patch': 'text-red-500/50 group-hover:text-red-500',
    'meta': 'text-orange-500/50 group-hover:text-orange-500',
    'normal': 'text-blue-400/50 group-hover:text-blue-400',
    'avoid': 'text-gray-500/50 group-hover:text-gray-500'
  };
  return classes[tier] || 'text-orange-500/50 group-hover:text-orange-500';
};
</script>
