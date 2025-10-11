<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Admin Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-7xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> ADMIN_PANEL INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING PAGE_EDITOR.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <Link href="/admin/wiki/pages" class="text-orange-500 hover:text-orange-400 font-mono text-sm mb-4 inline-flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              <span>&lt;</span> НАЗАД К СПИСКУ
            </Link>
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                РЕДАКТИРОВАНИЕ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>{{ page.title }}</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Form -->
          <form @submit.prevent="submit" class="space-y-6">
            <!-- Basic Info -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4 uppercase">
                <span class="text-orange-600">&gt;</span> ОСНОВНАЯ ИНФОРМАЦИЯ
              </div>

              <div class="space-y-4">
                <div>
                  <label class="block text-orange-500 font-mono text-sm mb-2">НАЗВАНИЕ</label>
                  <input
                    v-model="form.title"
                    type="text"
                    class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono focus:border-orange-500 focus:outline-none"
                    required
                  />
                </div>

                <div>
                  <label class="block text-orange-500 font-mono text-sm mb-2">КРАТКОЕ ОПИСАНИЕ</label>
                  <textarea
                    v-model="form.short_description"
                    rows="3"
                    class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono focus:border-orange-500 focus:outline-none"
                  ></textarea>
                </div>

                <div class="flex items-center gap-3">
                  <input
                    v-model="form.is_published"
                    type="checkbox"
                    id="is_published"
                    class="w-5 h-5 bg-black border-2 border-orange-500/50 checked:bg-orange-600 focus:ring-0 focus:ring-offset-0"
                  />
                  <label for="is_published" class="text-orange-500 font-mono text-sm cursor-pointer">
                    ОПУБЛИКОВАТЬ СТРАНИЦУ
                  </label>
                </div>
              </div>
            </div>

            <!-- Weapons Selection -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4 uppercase flex items-center justify-between">
                <span><span class="text-orange-600">&gt;</span> ОРУЖИЕ ({{ form.weapons.length }})</span>
                <button
                  type="button"
                  @click="selectAllWeapons"
                  class="px-3 py-1 bg-orange-600/20 hover:bg-orange-600/40 border border-orange-500/30 text-orange-500 text-xs transition-colors"
                >
                  ВЫБРАТЬ ВСЁ
                </button>
              </div>

              <div v-if="allWeapons.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-2">
                <label
                  v-for="weapon in allWeapons"
                  :key="weapon.id"
                  class="flex items-center gap-3 p-3 bg-black/50 border border-orange-500/20 hover:border-orange-500/50 cursor-pointer transition-colors"
                >
                  <input
                    type="checkbox"
                    :value="weapon.id"
                    v-model="form.weapons"
                    class="w-4 h-4 bg-black border-2 border-orange-500/50 checked:bg-orange-600 focus:ring-0"
                  />
                  <img v-if="weapon.icon" :src="`/storage/${weapon.icon}`" :alt="weapon.name" class="w-10 h-10 object-contain" />
                  <span class="text-white font-mono text-sm flex-1">{{ weapon.name }}</span>
                </label>
              </div>
              <div v-else class="text-orange-500/50 font-mono text-sm text-center py-8">
                Нет доступного оружия для {{ page.game }}
              </div>
            </div>

            <!-- Maps Selection -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4 uppercase flex items-center justify-between">
                <span><span class="text-orange-600">&gt;</span> КАРТЫ ({{ form.maps.length }})</span>
                <button
                  type="button"
                  @click="selectAllMaps"
                  class="px-3 py-1 bg-orange-600/20 hover:bg-orange-600/40 border border-orange-500/30 text-orange-500 text-xs transition-colors"
                >
                  ВЫБРАТЬ ВСЁ
                </button>
              </div>

              <div v-if="allMaps.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-2">
                <label
                  v-for="map in allMaps"
                  :key="map.id"
                  class="flex items-center gap-3 p-3 bg-black/50 border border-orange-500/20 hover:border-orange-500/50 cursor-pointer transition-colors"
                >
                  <input
                    type="checkbox"
                    :value="map.id"
                    v-model="form.maps"
                    class="w-4 h-4 bg-black border-2 border-orange-500/50 checked:bg-orange-600 focus:ring-0"
                  />
                  <img v-if="map.minimap" :src="`/storage/${map.minimap}`" :alt="map.name" class="w-10 h-10 object-cover" />
                  <span class="text-white font-mono text-sm flex-1">{{ map.name }}</span>
                </label>
              </div>
              <div v-else class="text-orange-500/50 font-mono text-sm text-center py-8">
                Нет доступных карт для {{ page.game }}
              </div>
            </div>

            <!-- Zombie Maps Selection -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4 uppercase flex items-center justify-between">
                <span><span class="text-orange-600">&gt;</span> ЗОМБИ-КАРТЫ ({{ form.zombie_maps.length }})</span>
                <button
                  type="button"
                  @click="selectAllZombieMaps"
                  class="px-3 py-1 bg-orange-600/20 hover:bg-orange-600/40 border border-orange-500/30 text-orange-500 text-xs transition-colors"
                >
                  ВЫБРАТЬ ВСЁ
                </button>
              </div>

              <div v-if="allZombieMaps.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-96 overflow-y-auto p-2">
                <label
                  v-for="zombieMap in allZombieMaps"
                  :key="zombieMap.id"
                  class="flex items-center gap-3 p-3 bg-black/50 border border-orange-500/20 hover:border-orange-500/50 cursor-pointer transition-colors"
                >
                  <input
                    type="checkbox"
                    :value="zombieMap.id"
                    v-model="form.zombie_maps"
                    class="w-4 h-4 bg-black border-2 border-orange-500/50 checked:bg-orange-600 focus:ring-0"
                  />
                  <img v-if="zombieMap.thumbnail" :src="`/storage/${zombieMap.thumbnail}`" :alt="zombieMap.name" class="w-16 h-10 object-cover" />
                  <div class="flex-1">
                    <div class="text-white font-mono text-sm">{{ zombieMap.name }}</div>
                    <div v-if="zombieMap.dlc_pack" class="text-orange-500/70 font-mono text-xs">{{ zombieMap.dlc_pack }}</div>
                  </div>
                </label>
              </div>
              <div v-else class="text-orange-500/50 font-mono text-sm text-center py-8">
                Нет доступных зомби-карт для {{ page.game }}
              </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
              <button
                type="submit"
                :disabled="form.processing"
                class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 disabled:opacity-50 text-black text-lg font-black font-mono tracking-wider transition-all"
              >
                <span v-if="form.processing">СОХРАНЕНИЕ...</span>
                <span v-else><span class="text-orange-600">&gt;</span> СОХРАНИТЬ ИЗМЕНЕНИЯ</span>
              </button>
              <Link
                href="/admin/wiki/pages"
                class="px-8 py-4 border border-orange-500/30 text-orange-500 text-lg font-black font-mono hover:bg-orange-500/10 transition-all text-center"
              >
                ОТМЕНА
              </Link>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  page: Object,
  allWeapons: Array,
  allMaps: Array,
  allZombieMaps: Array,
  selectedWeaponIds: Array,
  selectedMapIds: Array,
  selectedZombieMapIds: Array,
});

const form = useForm({
  title: props.page.title,
  short_description: props.page.short_description,
  is_published: props.page.is_published,
  weapons: props.selectedWeaponIds,
  maps: props.selectedMapIds,
  zombie_maps: props.selectedZombieMapIds,
});

const selectAllWeapons = () => {
  if (form.weapons.length === props.allWeapons.length) {
    form.weapons = [];
  } else {
    form.weapons = props.allWeapons.map(w => w.id);
  }
};

const selectAllMaps = () => {
  if (form.maps.length === props.allMaps.length) {
    form.maps = [];
  } else {
    form.maps = props.allMaps.map(m => m.id);
  }
};

const selectAllZombieMaps = () => {
  if (form.zombie_maps.length === props.allZombieMaps.length) {
    form.zombie_maps = [];
  } else {
    form.zombie_maps = props.allZombieMaps.map(zm => zm.id);
  }
};

const submit = () => {
  form.put(`/admin/wiki/pages/${props.page.id}`, {
    preserveScroll: true,
  });
};
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

.cursor-blink {
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 49% {
    opacity: 1;
  }
  50%, 100% {
    opacity: 0;
  }
}
</style>

