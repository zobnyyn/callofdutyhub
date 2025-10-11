<template>
  <div class="border-2 border-orange-500/30 bg-black/60">
    <!-- Build Header -->
    <div class="p-4 bg-orange-500/10 border-b-2 border-orange-500/30">
      <div class="flex items-start justify-between gap-4">
        <div class="flex-1">
          <h3 class="text-xl font-black font-mono text-orange-500 uppercase mb-1">
            <span class="text-orange-600">&gt;</span> {{ build.title }}
          </h3>
          <div v-if="build.role" class="text-sm text-gray-400 font-mono">
            ROLE: <span class="text-orange-400">{{ build.role }}</span>
          </div>
        </div>
        <TierBadge v-if="build.tier_override" :tier="build.tier_override" />
      </div>
    </div>

    <!-- Build Notes -->
    <div v-if="build.notes" class="p-4 border-b border-orange-500/20 bg-orange-500/5">
      <div class="text-xs text-orange-600 font-mono mb-2">NOTES:</div>
      <p class="text-sm text-gray-300 font-mono leading-relaxed">{{ build.notes }}</p>
    </div>

    <!-- Attachments -->
    <div class="p-4">
      <div class="text-xs text-orange-600 font-mono mb-3">ATTACHMENTS:</div>

      <div v-if="build.attachments.length === 0" class="text-center py-8 text-gray-500 font-mono text-sm">
        <span class="text-orange-600">&gt;</span> No attachments configured
      </div>

      <div v-else class="space-y-2">
        <div v-for="attachment in sortedAttachments" :key="attachment.id"
             class="border border-orange-500/20 bg-black/40 p-3 hover:bg-orange-500/5 transition-colors">
          <div class="flex items-start justify-between gap-3">
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 text-xs font-black font-mono bg-orange-600 text-black uppercase">
                  {{ formatSlot(attachment.slot) }}
                </span>
                <span class="text-sm font-mono text-white">{{ attachment.name }}</span>
              </div>

              <!-- Stat Mods -->
              <div v-if="attachment.stat_mods && Object.keys(attachment.stat_mods).length > 0"
                   class="mt-2 flex flex-wrap gap-2">
                <span v-for="(value, stat) in attachment.stat_mods" :key="stat"
                      :class="['px-2 py-0.5 text-xs font-mono border', getStatColor(value)]">
                  {{ stat.toUpperCase() }}: {{ value }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import TierBadge from '@/Components/Warzone/TierBadge.vue';

const props = defineProps({
  build: {
    type: Object,
    required: true
  }
});

const sortedAttachments = computed(() => {
  return [...props.build.attachments].sort((a, b) => (a.sort_order || 0) - (b.sort_order || 0));
});

const formatSlot = (slot) => {
  return slot.replace(/_/g, ' ').toUpperCase();
};

const getStatColor = (value) => {
  const strValue = String(value);
  if (strValue.includes('+') || strValue.includes('increase')) {
    return 'bg-green-500/20 border-green-500/50 text-green-400';
  } else if (strValue.includes('-') || strValue.includes('decrease')) {
    return 'bg-red-500/20 border-red-500/50 text-red-400';
  }
  return 'bg-orange-500/20 border-orange-500/50 text-orange-400';
};
</script>

