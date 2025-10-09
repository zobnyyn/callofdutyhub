<template>
  <div class="relative">
    <button
      @click="showModal = true"
      type="button"
      class="px-4 py-2 border border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-mono text-sm transition-all flex items-center gap-2"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
      </svg>
      <span class="text-orange-600">&gt;</span> {{ buttonText }}
    </button>

    <!-- Modal -->
    <Teleport to="body">
      <div
        v-if="showModal"
        class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 px-4"
        @click.self="showModal = false"
      >
        <div class="bg-zinc-900 border-2 border-orange-500/50 p-8 max-w-4xl w-full max-h-[80vh] overflow-y-auto relative">
          <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

          <!-- Header -->
          <div class="flex items-center justify-between mb-6">
            <div class="font-mono text-sm text-orange-600">
              <span class="text-orange-600">&gt;</span> SELECT_ITEM
            </div>
            <button
              @click="showModal = false"
              class="text-gray-400 hover:text-white transition-all"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <!-- Filters -->
          <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <input
              v-model="search"
              type="text"
              placeholder="Поиск предметов..."
              class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
            />
            <select
              v-model="typeFilter"
              class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
            >
              <option value="">Все типы</option>
              <option value="weapon">Оружие</option>
              <option value="perk">Перки</option>
              <option value="gum">Жвачки</option>
            </select>
          </div>

          <!-- Items List -->
          <div v-if="loading" class="text-center py-8 text-gray-400 font-mono">
            LOADING...
          </div>

          <div v-else-if="filteredItems.length === 0" class="text-center py-8 text-gray-400 font-mono">
            NO_ITEMS_FOUND
          </div>

          <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div
              v-for="item in filteredItems"
              :key="item.id"
              @click="selectItem(item)"
              class="border border-orange-500/30 bg-black/50 p-4 hover:bg-orange-500/5 cursor-pointer transition-all flex items-center gap-4"
            >
              <div class="w-16 h-16 border border-orange-500/30 flex items-center justify-center flex-shrink-0 overflow-hidden">
                <img
                  v-if="item.image"
                  :src="`/storage/${item.image}`"
                  :alt="item.name"
                  class="w-full h-full object-cover"
                />
                <svg v-else class="w-8 h-8 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <h3 class="text-orange-500 font-mono font-bold mb-1">{{ item.name }}</h3>
                <span class="text-xs font-mono px-2 py-1 border border-orange-500/30 bg-orange-500/10 text-orange-500">
                  {{ getTypeName(item.type) }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Teleport>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  buttonText: {
    type: String,
    default: 'ДОБАВИТЬ ПРЕДМЕТ',
  },
  type: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['select']);

const showModal = ref(false);
const items = ref([]);
const loading = ref(false);
const search = ref('');
const typeFilter = ref(props.type);

const filteredItems = computed(() => {
  return items.value.filter(item => {
    const matchesSearch = !search.value ||
      item.name.toLowerCase().includes(search.value.toLowerCase());
    const matchesType = !typeFilter.value || item.type === typeFilter.value;
    return matchesSearch && matchesType;
  });
});

function getTypeName(type) {
  const types = {
    weapon: 'ОРУЖИЕ',
    perk: 'ПЕРК',
    gum: 'ЖВАЧКА',
  };
  return types[type] || type;
}

async function loadItems() {
  loading.value = true;
  try {
    const response = await axios.get('/api/game-items', {
      params: { type: props.type },
    });
    items.value = response.data.items;
  } catch (error) {
    console.error('Error loading items:', error);
  } finally {
    loading.value = false;
  }
}

function selectItem(item) {
  emit('select', item);
  showModal.value = false;
}

onMounted(() => {
  loadItems();
});
</script>

