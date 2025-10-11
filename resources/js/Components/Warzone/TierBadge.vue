<template>
  <span :class="tierClasses" class="px-2.5 py-1 text-[10px] font-black uppercase tracking-wider border-2 inline-block font-mono">
    {{ displayLabel }}
  </span>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  tier: {
    type: String,
    required: true
  },
  label: {
    type: String,
    default: null
  }
});

const tierClasses = computed(() => {
  switch (props.tier) {
    case 'imba_patch':
      return 'border-pink-500 bg-pink-500/10 text-pink-500';
    case 'meta':
      return 'border-purple-500 bg-purple-500/10 text-purple-500';
    case 'normal':
      return 'border-blue-400 bg-blue-400/10 text-blue-400';
    case 'avoid':
      return 'border-gray-600 bg-gray-600/10 text-gray-400';
    default:
      return 'border-gray-700 bg-gray-700/10 text-gray-300';
  }
});

const displayLabel = computed(() => {
  if (props.label) {
    return props.label;
  }

  switch (props.tier) {
    case 'imba_patch':
      return 'ИМБА';
    case 'meta':
      return 'МЕТА';
    case 'normal':
      return 'OK';
    case 'avoid':
      return 'NO';
    default:
      return props.tier.toUpperCase();
  }
});
</script>
