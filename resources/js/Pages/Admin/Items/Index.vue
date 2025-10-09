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
              <span class="text-orange-600">&gt;</span> LOADING ITEM_MANAGER.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title & Actions -->
          <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  УПРАВЛЕНИЕ
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>ПРЕДМЕТАМИ</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>

            <Link
              href="/admin/items/create"
              class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono tracking-wider transition-all flex items-center gap-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> CREATE_ITEM
            </Link>
          </div>

          <!-- Filters -->
          <div class="mb-6 border border-orange-500/30 bg-orange-500/5 p-6">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
            <div class="font-mono text-xs text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> FILTERS:
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
              <!-- Search -->
              <div>
                <input
                  v-model="searchQuery"
                  @input="applyFilters"
                  type="text"
                  placeholder="Поиск предметов..."
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                />
              </div>

              <!-- Type Filter -->
              <div>
                <select
                  v-model="typeFilter"
                  @change="applyFilters"
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                >
                  <option value="all">Все типы</option>
                  <option value="weapon">Оружие</option>
                  <option value="perk">Перки</option>
                  <option value="gum">Жвачки</option>
                </select>
              </div>

              <!-- Game Filter -->
              <div>
                <select
                  v-model="gameFilter"
                  @change="applyFilters"
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                >
                  <option value="">Все игры</option>
                  <option value="World at War">World at War</option>
                  <option value="Black Ops">Black Ops</option>
                  <option value="Black Ops 2">Black Ops 2</option>
                  <option value="Black Ops 3">Black Ops 3</option>
                  <option value="Black Ops 4">Black Ops 4</option>
                  <option value="Cold War">Cold War</option>
                  <option value="Black Ops 6">Black Ops 6</option>
                  <option value="Black Ops 7">Black Ops 7</option>
                </select>
              </div>

              <!-- Status Filter -->
              <div>
                <select
                  v-model="statusFilter"
                  @change="applyFilters"
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
                >
                  <option value="">Все статусы</option>
                  <option value="active">Активные</option>
                  <option value="inactive">Неактивные</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Items Grid -->
          <div class="space-y-4">
            <div v-if="items.data.length === 0" class="border border-orange-500/30 bg-orange-500/5 p-12 text-center">
              <div class="text-orange-600 font-mono text-lg mb-2">
                <span class="text-orange-600">&gt;</span> NO_ITEMS_FOUND
              </div>
              <p class="text-gray-400">Предметы не найдены. Создайте первый предмет!</p>
            </div>

            <div
              v-for="item in items.data"
              :key="item.id"
              class="border border-orange-500/30 bg-black/50 p-6 hover:bg-orange-500/5 transition-all relative"
            >
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="flex items-start gap-6">
                <!-- Image -->
                <div class="w-24 h-24 border border-orange-500/30 flex items-center justify-center flex-shrink-0 overflow-hidden">
                  <img
                    v-if="item.image"
                    :src="`/storage/${item.image}`"
                    :alt="item.name"
                    class="w-full h-full object-cover"
                  />
                  <svg v-else class="w-12 h-12 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>

                <!-- Info -->
                <div class="flex-1">
                  <div class="flex items-start justify-between mb-2">
                    <div>
                      <h3 class="text-xl font-black text-orange-500 font-mono mb-1">{{ item.name }}</h3>
                      <div class="flex items-center gap-3 flex-wrap">
                        <span class="text-xs font-mono px-2 py-1 border border-orange-500/30 bg-orange-500/10 text-orange-500">
                          {{ getTypeName(item.type) }}
                        </span>
                        <span
                          :class="[
                            'text-xs font-mono px-2 py-1 border',
                            item.is_active
                              ? 'border-green-500/30 bg-green-500/10 text-green-500'
                              : 'border-red-500/30 bg-red-500/10 text-red-500'
                          ]"
                        >
                          {{ item.is_active ? 'АКТИВЕН' : 'НЕАКТИВЕН' }}
                        </span>
                        <!-- Отображаем игры из available_games -->
                        <span v-if="item.available_games && item.available_games.length > 0" class="text-xs font-mono px-2 py-1 border border-blue-500/30 bg-blue-500/10 text-blue-400">
                          {{ item.available_games.join(', ') }}
                        </span>
                        <span v-else class="text-xs font-mono px-2 py-1 border border-yellow-500/30 bg-yellow-500/10 text-yellow-500">
                          БЕЗ ИГРЫ
                        </span>
                      </div>
                    </div>
                  </div>

                  <p v-if="item.description" class="text-gray-400 text-sm mb-4 line-clamp-2">
                    {{ item.description }}
                  </p>

                  <!-- Убираем дублирующий блок с играми, т.к. теперь отображается выше -->

                  <!-- Actions -->
                  <div class="flex items-center gap-3">
                    <Link
                      :href="`/admin/items/${item.id}/edit`"
                      class="text-xs font-mono px-4 py-2 border border-orange-500/30 hover:bg-orange-500/10 text-orange-500 transition-all"
                    >
                      <span class="text-orange-600">&gt;</span> EDIT
                    </Link>
                    <button
                      @click="confirmDelete(item)"
                      class="text-xs font-mono px-4 py-2 border border-red-500/30 hover:bg-red-500/10 text-red-500 transition-all"
                    >
                      <span class="text-red-600">&gt;</span> DELETE
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="items.last_page > 1" class="mt-8 flex justify-center gap-2">
            <template v-for="page in items.links" :key="page.label">
              <Link
                v-if="page.url"
                :href="page.url"
                :class="[
                  'px-4 py-2 font-mono text-sm border transition-all',
                  page.active
                    ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                    : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5'
                ]"
                v-html="page.label"
              />
              <span
                v-else
                :class="[
                  'px-4 py-2 font-mono text-sm border transition-all',
                  'border-orange-500/30 text-gray-400 opacity-50 cursor-not-allowed'
                ]"
                v-html="page.label"
              />
            </template>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <Footer />

    <!-- Delete Confirmation Modal -->
    <div
      v-if="showDeleteModal"
      class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 px-4"
      @click.self="showDeleteModal = false"
    >
      <div class="bg-zinc-900 border-2 border-orange-500/50 p-8 max-w-md w-full relative">
        <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
        <div class="font-mono text-sm text-orange-600 mb-4">
          <span class="text-orange-600">&gt;</span> CONFIRM_DELETION
        </div>
        <h3 class="text-2xl font-black text-orange-500 mb-4">УДАЛИТЬ ПРЕДМЕТ?</h3>
        <p class="text-gray-300 mb-6">
          Вы уверены, что хотите удалить "{{ itemToDelete?.name }}"? Это действие нельзя отменить.
        </p>
        <div class="flex gap-4">
          <button
            @click="deleteItem"
            class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-500 text-white font-black font-mono transition-all"
          >
            <span class="text-red-900">&gt;</span> УДАЛИТЬ
          </button>
          <button
            @click="showDeleteModal = false"
            class="flex-1 px-6 py-3 border-2 border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-black font-mono transition-all"
          >
            ОТМЕНА
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  items: Object,
  filters: Object,
});

const searchQuery = ref(props.filters.search || '');
const typeFilter = ref(props.filters.type || 'all');
const statusFilter = ref(props.filters.status || '');
const gameFilter = ref(props.filters.game || '');
const showDeleteModal = ref(false);
const itemToDelete = ref(null);

function getTypeName(type) {
  const types = {
    weapon: 'ОРУЖИЕ',
    perk: 'ПЕРК',
    gum: 'ЖВАЧКА',
  };
  return types[type] || type;
}

function applyFilters() {
  router.get('/admin/items', {
    search: searchQuery.value,
    type: typeFilter.value,
    status: statusFilter.value,
    game: gameFilter.value,
  }, {
    preserveState: true,
    preserveScroll: true,
  });
}

function confirmDelete(item) {
  itemToDelete.value = item;
  showDeleteModal.value = true;
}

function deleteItem() {
  if (itemToDelete.value) {
    router.delete(`/admin/items/${itemToDelete.value.id}`, {
      onSuccess: () => {
        showDeleteModal.value = false;
        itemToDelete.value = null;
      },
    });
  }
}
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
