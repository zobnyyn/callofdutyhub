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
              <span class="text-orange-600">&gt;</span> LOADING WARZONE_META_MANAGER.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title & Actions -->
          <div class="mb-10 flex justify-between items-center">
            <div>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  WARZONE
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>META HUB</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>

            <Link
              href="/admin/warzone/weapons/create"
              class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono tracking-wider transition-all flex items-center gap-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> CREATE_WEAPON
            </Link>
          </div>

          <!-- Success Message -->
          <div v-if="$page.props.flash?.success" class="mb-6 border border-green-500/30 bg-green-900/20 p-4 font-mono">
            <div class="text-green-500 text-sm">
              <span class="text-green-600">&gt;</span> {{ $page.props.flash.success }}
            </div>
          </div>

          <!-- Filters -->
          <div class="mb-6 border border-orange-500/30 bg-orange-500/5 p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <!-- Search -->
              <div>
                <label class="text-orange-600 font-mono text-xs mb-2 block">
                  <span class="text-orange-600">&gt;</span> SEARCH:
                </label>
                <input
                  v-model="filters.search"
                  type="text"
                  placeholder="Название оружия..."
                  class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white text-sm font-mono focus:outline-none focus:border-orange-500 transition-colors"
                  @input="debouncedSearch"
                >
              </div>

              <!-- Tier Filter -->
              <div>
                <label class="text-orange-600 font-mono text-xs mb-2 block">
                  <span class="text-orange-600">&gt;</span> TIER:
                </label>
                <select
                  v-model="filters.tier"
                  class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white text-sm font-mono focus:outline-none focus:border-orange-500 transition-colors"
                  @change="applyFilters"
                >
                  <option value="">Все</option>
                  <option value="imba_patch">ИМБА ПАТЧА</option>
                  <option value="meta">МЕТА</option>
                  <option value="normal">НОРМИК</option>
                  <option value="avoid">НЕ СТОИТ БРАТЬ</option>
                </select>
              </div>

              <!-- Origin Filter -->
              <div>
                <label class="text-orange-600 font-mono text-xs mb-2 block">
                  <span class="text-orange-600">&gt;</span> ORIGIN:
                </label>
                <select
                  v-model="filters.origin"
                  class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white text-sm font-mono focus:outline-none focus:border-orange-500 transition-colors"
                  @change="applyFilters"
                >
                  <option value="">Все</option>
                  <option value="mw2022">MW II (2022)</option>
                  <option value="mw2023">MW III (2023)</option>
                  <option value="bo6">BO6 (2024)</option>
                </select>
              </div>

              <!-- Category Filter -->
              <div>
                <label class="text-orange-600 font-mono text-xs mb-2 block">
                  <span class="text-orange-600">&gt;</span> CATEGORY:
                </label>
                <select
                  v-model="filters.category"
                  class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white text-sm font-mono focus:outline-none focus:border-orange-500 transition-colors"
                  @change="applyFilters"
                >
                  <option value="">Все</option>
                  <option value="ar">AR</option>
                  <option value="smg">SMG</option>
                  <option value="lmg">LMG</option>
                  <option value="marksman">Marksman</option>
                  <option value="sniper">Sniper</option>
                  <option value="shotgun">Shotgun</option>
                  <option value="pistol">Pistol</option>
                  <option value="launcher">Launcher</option>
                  <option value="melee">Melee</option>
                  <option value="tactical">Tactical</option>
                  <option value="battlerifle">Battle Rifle</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Weapons Table -->
          <div class="border border-orange-500/30 bg-orange-500/5">
            <!-- Table Header -->
            <div class="p-4 border-b border-orange-500/30 bg-orange-500/10">
              <div class="text-orange-600 font-mono text-sm">
                <span class="text-orange-600">&gt;</span> ВСЕГО ОРУЖИЯ: {{ weapons.total }}
              </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
              <table class="w-full font-mono text-sm">
                <thead class="bg-black/50">
                  <tr class="border-b border-orange-500/20">
                    <th class="px-4 py-3 text-left text-orange-500">ID</th>
                    <th class="px-4 py-3 text-left text-orange-500">NAME</th>
                    <th class="px-4 py-3 text-left text-orange-500">TIER</th>
                    <th class="px-4 py-3 text-left text-orange-500">ORIGIN</th>
                    <th class="px-4 py-3 text-left text-orange-500">CATEGORY</th>
                    <th class="px-4 py-3 text-left text-orange-500">BUILDS</th>
                    <th class="px-4 py-3 text-left text-orange-500">STATUS</th>
                    <th class="px-4 py-3 text-left text-orange-500">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="weapons.data.length === 0">
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                      <span class="text-orange-600">&gt;</span> Оружия пока нет. Создайте первое!
                    </td>
                  </tr>
                  <tr
                    v-for="weapon in weapons.data"
                    :key="weapon.id"
                    class="border-b border-orange-500/10 hover:bg-orange-500/5 transition-colors"
                  >
                    <td class="px-4 py-3 text-gray-400">#{{ weapon.id }}</td>
                    <td class="px-4 py-3 text-white">{{ weapon.name }}</td>
                    <td class="px-4 py-3">
                      <TierBadge :tier="weapon.tier" />
                    </td>
                    <td class="px-4 py-3 text-white text-xs">{{ getOriginLabel(weapon.origin_game) }}</td>
                    <td class="px-4 py-3 text-orange-500 text-xs uppercase">{{ weapon.category }}</td>
                    <td class="px-4 py-3 text-orange-500">{{ weapon.builds_count || 0 }}</td>
                    <td class="px-4 py-3">
                      <span
                        :class="weapon.is_active ? 'text-green-500 bg-green-500/20' : 'text-gray-500 bg-gray-500/20'"
                        class="px-2 py-1 text-xs rounded"
                      >
                        {{ weapon.is_active ? 'ACTIVE' : 'INACTIVE' }}
                      </span>
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center gap-2">
                        <Link
                          :href="`/admin/warzone/weapons/${weapon.id}/edit`"
                          class="px-3 py-1 bg-orange-600/20 border border-orange-500/30 text-orange-500 text-xs hover:bg-orange-500/20 transition-colors"
                        >
                          EDIT
                        </Link>
                        <button
                          @click="deleteWeapon(weapon.id)"
                          class="px-3 py-1 bg-red-600/20 border border-red-500/30 text-red-500 text-xs hover:bg-red-500/20 transition-colors"
                        >
                          DELETE
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div v-if="weapons.last_page > 1" class="p-4 border-t border-orange-500/30 flex justify-between items-center">
              <div class="text-orange-600 font-mono text-xs">
                Страница {{ weapons.current_page }} из {{ weapons.last_page }}
              </div>
              <div class="flex gap-2">
                <Link
                  v-for="page in weapons.links"
                  :key="page.label"
                  :href="page.url"
                  :class="[
                    'px-3 py-1 text-xs font-mono border transition-colors',
                    page.active
                      ? 'bg-orange-500 text-black border-orange-500'
                      : 'bg-black text-orange-500 border-orange-500/30 hover:bg-orange-500/10'
                  ]"
                  :disabled="!page.url"
                  v-html="page.label"
                ></Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import TierBadge from '@/Components/Warzone/TierBadge.vue';

const props = defineProps({
  weapons: Object,
  filters: Object
});

const filters = reactive({
  search: props.filters?.search || '',
  tier: props.filters?.tier || '',
  origin: props.filters?.origin || '',
  category: props.filters?.category || ''
});

let searchTimeout = null;

const debouncedSearch = () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    applyFilters();
  }, 500);
};

const applyFilters = () => {
  router.get('/admin/warzone/weapons', filters, {
    preserveState: true,
    preserveScroll: true
  });
};

const deleteWeapon = (id) => {
  if (confirm('Вы уверены, что хотите удалить это оружие? Все связанные билды также будут удалены.')) {
    router.delete(`/admin/warzone/weapons/${id}`, {
      preserveScroll: true
    });
  }
};

const getOriginLabel = (origin) => {
  const labels = {
    'mw2022': 'MW II (2022)',
    'mw2023': 'MW III (2023)',
    'bo6': 'BO6 (2024)'
  };
  return labels[origin] || origin;
};
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 10px rgba(249, 115, 22, 0.5);
}

.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>
