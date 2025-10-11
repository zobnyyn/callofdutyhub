<template>
  <Head>
    <title>Warzone Meta Оружие - Лучшие Сборки и Билды | Call of Duty Wiki</title>
    <meta name="description" content="Актуальная мета Warzone: лучшие сборки оружия для MW2, MW3 и Black Ops 6. Проверенные билды от профи с описанием всех аксессуаров и тактик.">
    <meta name="keywords" content="warzone meta, мета варзон, лучшее оружие warzone, сборки оружия warzone, билды warzone, warzone builds, mw3 meta, bo6 meta">

    <!-- Open Graph -->
    <meta property="og:title" content="Warzone Meta Оружие - Лучшие Сборки и Билды">
    <meta property="og:description" content="Актуальная мета Warzone: лучшие сборки оружия для MW2, MW3 и Black Ops 6. Проверенные билды от профи.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/images/og-warzone-meta.jpg">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Warzone Meta Оружие - Лучшие Сборки и Билды">
    <meta name="twitter:description" content="Актуальная мета Warzone: лучшие сборки оружия для MW2, MW3 и Black Ops 6.">
    <meta name="twitter:image" content="/images/og-warzone-meta.jpg">
  </Head>

  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <div
        class="w-full h-full opacity-30"
        style="background-image: url('/images/warzonebackground1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
      ></div>
      <!-- Darker overlay for better text readability -->
      <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <!-- Terminal Background Pattern -->
    <div class="fixed inset-0 opacity-[0.02] z-0" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header -->
    <Header />

    <!-- Main Content -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen z-10">
      <div class="container mx-auto relative z-10">
        <div class="max-w-7xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm bg-black/40 backdrop-blur-sm p-4 border border-orange-500/20">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> WARZONE_META_DATABASE INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING WEAPON_DATA.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> FOUND {{ weapons.total }} WEAPONS
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-0"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10 bg-black/40 backdrop-blur-sm p-6 border border-orange-500/20">
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                WARZONE
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>META WEAPONS</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Filters Section -->
          <div class="mb-8 border-2 border-orange-500/30 bg-black/60 backdrop-blur-sm p-6 relative">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

            <!-- Search & Selects -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
              <!-- Search -->
              <div class="md:col-span-2">
                <div class="font-mono text-xs text-orange-600 mb-2">
                  <span class="text-orange-600">&gt;</span> SEARCH_WEAPON:
                </div>
                <input
                  v-model="filters.search"
                  @input="applyFilters"
                  type="text"
                  placeholder="Введите название..."
                  class="w-full bg-black/60 border-2 border-orange-500/30 text-white px-4 py-2.5 text-sm font-mono focus:border-orange-500 focus:outline-none transition-colors"
                />
              </div>

              <!-- Tier -->
              <div>
                <div class="font-mono text-xs text-orange-600 mb-2">
                  <span class="text-orange-600">&gt;</span> TIER:
                </div>
                <select
                  v-model="filters.tier"
                  @change="applyFilters"
                  class="w-full bg-black/60 border-2 border-orange-500/30 text-white px-4 py-2.5 text-sm font-mono focus:border-orange-500 focus:outline-none transition-colors select-custom"
                >
                  <option value="">ВСЕ</option>
                  <option value="imba_patch">ИМБА ПАТЧА</option>
                  <option value="meta">МЕТА</option>
                  <option value="normal">НОРМИК</option>
                  <option value="avoid">ИЗБЕГАТЬ</option>
                </select>
              </div>

              <!-- Origin -->
              <div>
                <div class="font-mono text-xs text-orange-600 mb-2">
                  <span class="text-orange-600">&gt;</span> GAME:
                </div>
                <select
                  v-model="filters.origin"
                  @change="applyFilters"
                  class="w-full bg-black/60 border-2 border-orange-500/30 text-white px-4 py-2.5 text-sm font-mono focus:border-orange-500 focus:outline-none transition-colors select-custom"
                >
                  <option value="">ВСЕ ИГРЫ</option>
                  <option value="mw2022">MW2 (2022)</option>
                  <option value="mw2023">MW3 (2023)</option>
                  <option value="bo6">BO6 (2024)</option>
                </select>
              </div>
            </div>

            <!-- Category Pills -->
            <div>
              <div class="font-mono text-xs text-orange-600 mb-3">
                <span class="text-orange-600">&gt;</span> FILTER_BY_CATEGORY:
              </div>
              <div class="flex flex-wrap gap-2">
                <button
                  @click="toggleCategory('')"
                  :class="[
                    'px-4 py-2 font-mono text-xs border-2 transition-all uppercase',
                    filters.category === ''
                      ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                      : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5'
                  ]"
                >
                  ВСЕ
                </button>
                <button
                  v-for="cat in categories"
                  :key="cat.value"
                  @click="toggleCategory(cat.value)"
                  :class="[
                    'px-4 py-2 font-mono text-xs border-2 transition-all uppercase',
                    filters.category === cat.value
                      ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                      : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5'
                  ]"
                >
                  {{ cat.label }}
                </button>
              </div>
            </div>
          </div>

          <!-- Loading -->
          <div v-if="loading" class="flex flex-col items-center justify-center py-20 border-2 border-orange-500/30 bg-orange-500/5">
            <div class="w-16 h-16 border-4 border-orange-500/30 border-t-orange-500 animate-spin mb-4"></div>
            <p class="text-orange-500 font-mono text-sm uppercase">
              <span class="text-orange-600">&gt;</span> LOADING...
            </p>
          </div>

          <!-- Weapons List -->
          <div v-else-if="weapons.data.length > 0">
            <!-- ИМБА ПАТЧА -->
            <div v-if="groupedWeapons.imba_patch.length > 0" class="mb-16">
              <div class="mb-4 font-mono">
                <div class="flex items-center gap-3 text-sm">
                  <span class="text-orange-600">&gt;</span>
                  <span class="text-red-500 font-bold">TIER: ИМБА_ПАТЧА</span>
                  <span class="text-gray-600">|</span>
                  <span class="text-red-400/60">{{ groupedWeapons.imba_patch.length }} ед.</span>
                </div>
              </div>
              <div class="space-y-3">
                <WeaponListItem
                  v-for="weapon in groupedWeapons.imba_patch"
                  :key="weapon.id"
                  :weapon="weapon"
                />
              </div>
            </div>

            <!-- МЕТА -->
            <div v-if="groupedWeapons.meta.length > 0" class="mb-16">
              <div class="mb-4 font-mono">
                <div class="flex items-center gap-3 text-sm">
                  <span class="text-orange-600">&gt;</span>
                  <span class="text-orange-500 font-bold">TIER: META</span>
                  <span class="text-gray-600">|</span>
                  <span class="text-orange-400/60">{{ groupedWeapons.meta.length }} ед.</span>
                </div>
              </div>
              <div class="space-y-3">
                <WeaponListItem
                  v-for="weapon in groupedWeapons.meta"
                  :key="weapon.id"
                  :weapon="weapon"
                />
              </div>
            </div>

            <!-- НОРМИК -->
            <div v-if="groupedWeapons.normal.length > 0" class="mb-16">
              <div class="mb-4 font-mono">
                <div class="flex items-center gap-3 text-sm">
                  <span class="text-orange-600">&gt;</span>
                  <span class="text-blue-400 font-bold">TIER: НОРМАЛЬНО</span>
                  <span class="text-gray-600">|</span>
                  <span class="text-blue-400/60">{{ groupedWeapons.normal.length }} ед.</span>
                </div>
              </div>
              <div class="space-y-3">
                <WeaponListItem
                  v-for="weapon in groupedWeapons.normal"
                  :key="weapon.id"
                  :weapon="weapon"
                />
              </div>
            </div>

            <!-- ИЗБЕГАТЬ -->
            <div v-if="groupedWeapons.avoid.length > 0" class="mb-16">
              <div class="mb-4 font-mono">
                <div class="flex items-center gap-3 text-sm">
                  <span class="text-orange-600">&gt;</span>
                  <span class="text-gray-500 font-bold">TIER: ИЗБЕГАТЬ</span>
                  <span class="text-gray-600">|</span>
                  <span class="text-gray-500/60">{{ groupedWeapons.avoid.length }} ед.</span>
                </div>
              </div>
              <div class="space-y-3">
                <WeaponListItem
                  v-for="weapon in groupedWeapons.avoid"
                  :key="weapon.id"
                  :weapon="weapon"
                />
              </div>
            </div>

            <!-- Pagination -->
            <div v-if="weapons.last_page > 1" class="flex justify-center gap-2 pt-10 border-t border-orange-500/30">
              <button
                v-for="page in paginationPages"
                :key="page"
                @click="goToPage(page)"
                :disabled="page === weapons.current_page || page === '...'"
                :class="[
                  'px-4 py-2 font-mono text-sm border-2 transition-all',
                  page === weapons.current_page
                    ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                    : page === '...'
                    ? 'border-transparent text-gray-600 cursor-default'
                    : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5'
                ]"
              >
                {{ page }}
              </button>
            </div>
          </div>

          <!-- Empty State -->
          <div v-else class="border-2 border-emerald-500/30 bg-emerald-500/5 p-12 text-center">
            <div class="text-emerald-400 font-mono text-lg mb-2">
              <span class="text-emerald-400">&gt;</span> NO_WEAPONS_FOUND
            </div>
            <p class="text-gray-400">Оружие не найдено. Попробуйте изменить фильтры.</p>
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import WeaponListItem from '@/Components/Warzone/WeaponListItem.vue';

// Background image
const backgroundImage = '/images/warzonebackground.jpg';

const props = defineProps({
    weapons: Object,
    categories: Array,
    filters: { type: Object, default: () => ({}) }
});

const loading = ref(false);
const filters = reactive({
    search: props.filters.search || '',
    tier: props.filters.tier || '',
    origin: props.filters.origin || '',
    category: props.filters.category || ''
});

const groupedWeapons = computed(() => {
    const groups = {
        imba_patch: [],
        meta: [],
        normal: [],
        avoid: []
    };

    props.weapons.data.forEach(weapon => {
        if (groups[weapon.tier]) {
            groups[weapon.tier].push(weapon);
        }
    });

    return groups;
});

const toggleCategory = (value) => {
    filters.category = value;
    applyFilters();
};

const applyFilters = () => {
    loading.value = true;
    router.get('/warzone/meta', filters, {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => { loading.value = false; }
    });
};

const goToPage = (page) => {
    if (page === '...') return;
    loading.value = true;
    router.get('/warzone/meta', { ...filters, page }, {
        preserveState: true,
        preserveScroll: false,
        onFinish: () => { loading.value = false; }
    });
};

const paginationPages = computed(() => {
    const pages = [];
    const current = props.weapons.current_page;
    const last = props.weapons.last_page;

    if (last <= 7) {
        for (let i = 1; i <= last; i++) pages.push(i);
    } else {
        if (current <= 3) {
            for (let i = 1; i <= 5; i++) pages.push(i);
            pages.push('...', last);
        } else if (current >= last - 2) {
            pages.push(1, '...');
            for (let i = last - 4; i <= last; i++) pages.push(i);
        } else {
            pages.push(1, '...');
            for (let i = current - 1; i <= current + 1; i++) pages.push(i);
            pages.push('...', last);
        }
    }
    return pages;
});
</script>

<style scoped>
/* Custom Select */
.select-custom {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%23f97316' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.25em 1.25em;
    padding-right: 2.5rem;
}

/* Terminal Glow Effect */
.terminal-glow {
    text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

/* Cursor Blink Animation */
.cursor-blink {
    animation: blink 1s step-end infinite;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}
</style>
