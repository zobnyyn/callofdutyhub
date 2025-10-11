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
              <span class="text-orange-600">&gt;</span> LOADING MAP_MANAGER.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title & Actions -->
          <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
              <Link href="/admin/wiki" class="text-orange-500 hover:text-orange-400 font-mono text-sm mb-4 inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>&lt;</span> НАЗАД К WIKI
              </Link>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  УПРАВЛЕНИЕ
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>КАРТАМИ</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>

            <Link
              href="/admin/wiki/maps/create"
              class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono tracking-wider transition-all flex items-center gap-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> CREATE_MAP
            </Link>
          </div>

          <!-- Success Message -->
          <div v-if="$page.props.flash.success" class="mb-6 border border-green-500/30 bg-green-900/20 p-4 font-mono">
            <div class="text-green-500 text-sm">
              <span class="text-green-600">&gt;</span> {{ $page.props.flash.success }}
            </div>
          </div>

          <!-- Filters -->
          <div class="mb-6 border border-orange-500/30 bg-orange-500/5 p-6">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
            <div class="font-mono text-xs text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> FILTERS:
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <!-- Search -->
              <div>
                <input
                  v-model="searchQuery"
                  @input="applyFilters"
                  type="text"
                  placeholder="Поиск по названию..."
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                />
              </div>

              <!-- Game Filter -->
              <div>
                <select
                  v-model="gameFilter"
                  @change="applyFilters"
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                >
                  <option value="">Все игры</option>
                  <optgroup label="Black Ops Series">
                    <option value="world-at-war">World at War</option>
                    <option value="black-ops">Black Ops</option>
                    <option value="black-ops-2">Black Ops 2</option>
                    <option value="black-ops-3">Black Ops 3</option>
                    <option value="black-ops-4">Black Ops 4</option>
                    <option value="cold-war">Cold War</option>
                    <option value="black-ops-6">Black Ops 6</option>
                    <option value="black-ops-7">Black Ops 7</option>
                  </optgroup>
                  <optgroup label="Modern Warfare Series">
                    <option value="cod-4-modern-warfare">COD 4: Modern Warfare (2007)</option>
                    <option value="modern-warfare-2">Modern Warfare 2 (2009)</option>
                    <option value="modern-warfare-3">Modern Warfare 3 (2011)</option>
                    <option value="modern-warfare">Modern Warfare (2019)</option>
                    <option value="modern-warfare-ii">Modern Warfare II (2022)</option>
                    <option value="modern-warfare-iii">Modern Warfare III (2023)</option>
                  </optgroup>
                </select>
              </div>

              <!-- Type Filter -->
              <div>
                <select
                  v-model="typeFilter"
                  @change="applyFilters"
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                >
                  <option value="">Все типы</option>
                  <option value="multiplayer">Multiplayer</option>
                  <option value="campaign">Campaign</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Maps Table -->
          <div class="border border-orange-500/30 bg-orange-500/5">
            <!-- Table Header -->
            <div class="p-4 border-b border-orange-500/30 bg-orange-500/10">
              <div class="text-orange-600 font-mono text-sm">
                <span class="text-orange-600">&gt;</span> ВСЕГО КАРТ: {{ maps.total }}
              </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
              <table class="w-full font-mono text-sm">
                <thead class="bg-black/50">
                  <tr class="border-b border-orange-500/20">
                    <th class="px-4 py-3 text-left text-orange-500">ID</th>
                    <th class="px-4 py-3 text-left text-orange-500">ИЗОБРАЖЕНИЕ</th>
                    <th class="px-4 py-3 text-left text-orange-500">НАЗВАНИЕ</th>
                    <th class="px-4 py-3 text-left text-orange-500">ИГРА</th>
                    <th class="px-4 py-3 text-left text-orange-500">ТИП</th>
                    <th class="px-4 py-3 text-left text-orange-500">ЛОКАЦИЯ</th>
                    <th class="px-4 py-3 text-left text-orange-500">СТАТУС</th>
                    <th class="px-4 py-3 text-right text-orange-500">ДЕЙСТВИЯ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="map in maps.data"
                    :key="map.id"
                    class="border-b border-orange-500/10 hover:bg-orange-500/5 transition-colors"
                  >
                    <td class="px-4 py-3 text-orange-400">#{{ map.id }}</td>
                    <td class="px-4 py-3">
                      <img v-if="map.minimap" :src="map.minimap" :alt="map.name" class="w-16 h-16 object-cover" />
                      <div v-else class="w-16 h-16 bg-orange-500/10 border border-orange-500/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-orange-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-white">{{ map.name }}</td>
                    <td class="px-4 py-3 text-orange-300 uppercase">{{ map.game }}</td>
                    <td class="px-4 py-3 text-orange-300">{{ map.type }}</td>
                    <td class="px-4 py-3 text-orange-300/70">{{ map.location || '-' }}</td>
                    <td class="px-4 py-3">
                      <span
                        :class="map.is_active ? 'text-green-500' : 'text-red-500'"
                        class="text-xs"
                      >
                        {{ map.is_active ? '● ACTIVE' : '○ INACTIVE' }}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                      <div class="flex items-center justify-end gap-2">
                        <Link
                          :href="`/admin/wiki/maps/${map.id}/edit`"
                          class="px-3 py-1 bg-orange-600/20 hover:bg-orange-600/40 border border-orange-500/30 text-orange-500 text-xs transition-colors"
                        >
                          EDIT
                        </Link>
                        <button
                          @click="deleteMap(map.id)"
                          class="px-3 py-1 bg-red-600/20 hover:bg-red-600/40 border border-red-500/30 text-red-500 text-xs transition-colors"
                        >
                          DELETE
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr v-if="maps.data.length === 0">
                    <td colspan="8" class="px-4 py-8 text-center text-orange-500/50">
                      <span class="text-orange-600">&gt;</span> Карты не найдены
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div v-if="maps.data.length > 0" class="p-4 border-t border-orange-500/30 bg-orange-500/10">
              <div class="flex justify-between items-center">
                <div class="text-orange-600 font-mono text-xs">
                  Показано {{ maps.from }} - {{ maps.to }} из {{ maps.total }}
                </div>
                <div class="flex gap-2">
                  <Link
                    v-for="link in maps.links"
                    :key="link.label"
                    :href="link.url"
                    :class="{
                      'bg-orange-600 text-black': link.active,
                      'bg-orange-600/20 text-orange-500 hover:bg-orange-600/40': !link.active && link.url,
                      'opacity-50 cursor-not-allowed': !link.url
                    }"
                    class="px-3 py-1 border border-orange-500/30 text-xs font-mono transition-colors"
                    v-html="link.label"
                  />
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
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  maps: Object,
  filters: Object
});

const searchQuery = ref(props.filters?.search || '');
const gameFilter = ref(props.filters?.game || '');
const typeFilter = ref(props.filters?.type || '');

const applyFilters = () => {
  router.get('/admin/wiki/maps', {
    search: searchQuery.value,
    game: gameFilter.value,
    type: typeFilter.value
  }, {
    preserveState: true,
    preserveScroll: true
  });
};

const deleteMap = (id) => {
  if (confirm('Вы уверены, что хотите удалить эту карту?')) {
    router.delete(`/admin/wiki/maps/${id}`, {
      preserveScroll: true
    });
  }
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
