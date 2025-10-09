<template>
  <div class="border border-orange-500/30 bg-black/50 p-6 relative">
    <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

    <label class="block font-mono text-xs text-orange-600 mb-4">
      <span class="text-orange-600">&gt;</span> {{ label }}:
    </label>

    <!-- Selected Items -->
    <div v-if="selectedItems.length > 0" class="mb-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
      <div
        v-for="item in selectedItems"
        :key="item.id"
        class="border border-orange-500/30 bg-orange-500/5 p-3 flex items-center gap-3 relative group"
      >
        <div class="w-12 h-12 border border-orange-500/30 flex items-center justify-center flex-shrink-0 overflow-hidden">
          <img
            v-if="item.image"
            :src="`/storage/${item.image}`"
            :alt="item.name"
            class="w-full h-full object-cover"
          />
          <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
        <div class="flex-1 min-w-0">
          <div class="text-sm font-mono text-orange-500 truncate">{{ item.name }}</div>
          <div v-if="item.available_games && item.available_games.length > 0" class="text-xs text-gray-500 font-mono">
            {{ item.available_games.join(', ') }}
          </div>
          <div v-else-if="item.game" class="text-xs text-gray-500 font-mono">{{ item.game }}</div>
        </div>
        <button
          type="button"
          @click="removeItem(item.id)"
          class="text-red-500 hover:text-red-400 transition-colors flex-shrink-0"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Add Button -->
    <button
      type="button"
      @click="openModal"
      class="w-full px-4 py-3 border-2 border-dashed border-orange-500/30 hover:border-orange-500/50 hover:bg-orange-500/5 text-orange-500 font-mono text-sm transition-all"
    >
      <span class="text-orange-600">&gt;</span> ДОБАВИТЬ {{ buttonText }}
    </button>

    <!-- Warning for gums and perks without game selection -->
    <div v-if="(type === 'gum' || type === 'perk' || type === 'weapon') && !selectedGame" class="mt-2 text-xs text-yellow-500 font-mono">
      <span class="text-yellow-600">&gt;</span> Выберите игру, чтобы увидеть доступные {{ type === 'gum' ? 'жвачки' : type === 'perk' ? 'перки' : 'оружие' }}
    </div>

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
              <span class="text-orange-600">&gt;</span> ВЫБРАТЬ {{ buttonText.toUpperCase() }}
              <span v-if="(type === 'gum' || type === 'perk') && selectedGame" class="text-gray-400 ml-2">({{ selectedGame }})</span>
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

          <!-- Search -->
          <div class="mb-6">
            <input
              v-model="search"
              type="text"
              placeholder="Поиск..."
              class="w-full bg-black border border-orange-500/30 text-white px-4 py-2 font-mono text-sm focus:border-orange-500 focus:outline-none"
            />
          </div>

          <!-- Items List -->
          <div v-if="loading" class="text-center py-8 text-gray-400 font-mono">
            LOADING...
          </div>

          <div v-else-if="filteredAvailableItems.length === 0" class="text-center py-8 text-gray-400 font-mono">
            НЕТ ДОСТУПНЫХ ПРЕДМЕТОВ
            <div v-if="type === 'gum' && !selectedGame" class="mt-2 text-xs text-yellow-500">
              Выберите игру в форме гайда
            </div>
          </div>

          <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div
              v-for="item in filteredAvailableItems"
              :key="item.id"
              @click="addItem(item)"
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
                <div v-if="item.available_games && item.available_games.length > 0" class="text-xs text-gray-500 font-mono mb-1">
                  {{ item.available_games.join(', ') }}
                </div>
                <div v-else-if="item.game" class="text-xs text-gray-500 font-mono mb-1">{{ item.game }}</div>
                <p v-if="item.description" class="text-gray-400 text-xs line-clamp-2">{{ item.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Teleport>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  label: {
    type: String,
    required: true,
  },
  buttonText: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    required: true, // weapon, perk, gum
  },
  modelValue: {
    type: Array,
    default: () => [],
  },
  selectedGame: {
    type: String,
    default: null,
  },
});

const emit = defineEmits(['update:modelValue']);

const showModal = ref(false);
const items = ref([]);
const loading = ref(false);
const search = ref('');
const selectedItems = ref([...props.modelValue]);

const filteredAvailableItems = computed(() => {
  const selectedIds = selectedItems.value.map(item => item.id);
  return items.value.filter(item => {
    const matchesSearch = !search.value ||
      item.name.toLowerCase().includes(search.value.toLowerCase());
    const notSelected = !selectedIds.includes(item.id);
    return matchesSearch && notSelected;
  });
});

async function loadItems() {
  loading.value = true;
  try {
    const params = { type: props.type };

    // Для всех типов предметов добавляем фильтр по игре
    if (props.selectedGame) {
      params.game = props.selectedGame;
    }

    const response = await axios.get('/api/game-items', { params });
    items.value = response.data.items;
  } catch (error) {
    console.error('Error loading items:', error);
  } finally {
    loading.value = false;
  }
}

function openModal() {
  // Для всех типов предметов проверяем, выбрана ли игра
  if (!props.selectedGame) {
    alert('Пожалуйста, сначала выберите игру для гайда');
    return;
  }
  showModal.value = true;
}

function addItem(item) {
  selectedItems.value.push(item);
  emit('update:modelValue', selectedItems.value);
  showModal.value = false;
  search.value = '';
}

function removeItem(itemId) {
  selectedItems.value = selectedItems.value.filter(item => item.id !== itemId);
  emit('update:modelValue', selectedItems.value);
}

watch(() => props.modelValue, (newValue) => {
  selectedItems.value = [...newValue];
}, { deep: true });

// Перезагружаем предметы при изменении игры
watch(() => props.selectedGame, () => {
  loadItems();
});

onMounted(() => {
  loadItems();
});
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
