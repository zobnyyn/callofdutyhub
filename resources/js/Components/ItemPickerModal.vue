<template>
  <Teleport to="body">
    <Transition name="fade">
      <div
        v-if="isOpen"
        class="fixed inset-0 bg-black/90 backdrop-blur-sm z-[200] flex items-center justify-center p-4"
        @click.self="close"
      >
        <div class="bg-gradient-to-br from-orange-900 to-red-900 border-2 border-orange-400 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl shadow-orange-500/50 animate-fadeIn">
          <!-- Header -->
          <div class="flex justify-between items-center p-6 border-b-2 border-orange-400/50">
            <h3 class="text-2xl font-bold text-orange-300 font-mono flex items-center gap-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> ВЫБЕРИТЕ ПРЕДМЕТ
            </h3>
            <button
              @click="close"
              class="text-orange-300 hover:text-white text-3xl font-bold leading-none transition-colors"
            >
              ×
            </button>
          </div>

          <!-- Category Tabs -->
          <div class="border-b-2 border-orange-400/50 bg-black/30">
            <div class="flex overflow-x-auto">
              <button
                v-for="category in categories"
                :key="category.value"
                @click="selectedCategory = category.value"
                :class="{
                  'bg-orange-600 text-black': selectedCategory === category.value,
                  'text-orange-400 hover:bg-orange-500/20': selectedCategory !== category.value
                }"
                class="px-6 py-3 font-mono font-bold text-sm whitespace-nowrap transition-all border-r border-orange-400/30"
              >
                {{ category.label }}
              </button>
            </div>
          </div>

          <!-- Search -->
          <div class="p-4 bg-black/30 border-b border-orange-400/30">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Поиск предметов..."
              class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
            />
          </div>

          <!-- Items Grid -->
          <div class="p-6 overflow-y-auto max-h-[50vh]">
            <div v-if="loading" class="text-center py-12 text-orange-300 font-mono">
              <span class="text-orange-600">&gt;</span> LOADING...
            </div>
            <div v-else-if="filteredItems.length === 0" class="text-center py-12 text-orange-300/50 font-mono">
              Предметы не найдены
            </div>
            <div v-else class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              <button
                v-for="item in filteredItems"
                :key="item.id"
                @click="selectItem(item)"
                class="border-2 border-orange-500/30 bg-black/50 p-3 hover:bg-orange-500/20 hover:border-orange-500 transition-all group text-left"
              >
                <div class="aspect-square border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black relative">
                  <img
                    v-if="item.image"
                    :src="`/storage/${item.image}`"
                    :alt="item.name"
                    class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                  />
                  <svg v-else class="w-8 h-8 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>

                  <!-- Rarity Badge for Gums/Elixirs/Talismans -->
                  <div v-if="item.rarity" class="absolute top-1 right-1">
                    <div
                      class="w-2 h-2 rounded-full border border-black/50"
                      :class="getRarityClasses(item.rarity)"
                    ></div>
                  </div>
                </div>
                <div class="text-xs font-mono text-orange-500 truncate text-center">{{ item.name }}</div>
              </button>
            </div>
          </div>

          <!-- Footer -->
          <div class="p-4 bg-black/30 border-t-2 border-orange-400/50 flex justify-end">
            <button
              @click="close"
              class="px-6 py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-bold hover:bg-orange-500/10 transition-all"
            >
              <span class="text-orange-600">&gt;</span> ЗАКРЫТЬ
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  isOpen: Boolean,
  game: String
});

const emit = defineEmits(['close', 'select']);

const selectedCategory = ref('weapons');
const searchQuery = ref('');
const loading = ref(false);
const items = ref([]);

const categories = [
  { value: 'weapons', label: 'Оружие' },
  { value: 'wonder-weapons', label: 'Чудо-оружие' },
  { value: 'special-weapons', label: 'Спец. оружие' },
  { value: 'perks', label: 'Перки' },
  { value: 'gums', label: 'Жвачки' },
  { value: 'elixirs', label: 'Элексиры' },
  { value: 'field-upgrades', label: 'Полевые модификации' },
  { value: 'talismans', label: 'Талисманы' }
];

const filteredItems = computed(() => {
  if (!searchQuery.value) return items.value;

  const query = searchQuery.value.toLowerCase();
  return items.value.filter(item =>
    item.name.toLowerCase().includes(query) ||
    (item.description && item.description.toLowerCase().includes(query))
  );
});

const getRarityClasses = (rarity) => {
  const rarityClasses = {
    common: 'bg-gray-400',
    rare: 'bg-blue-500',
    epic: 'bg-purple-500',
    legendary: 'bg-amber-500',
    ultra: 'bg-red-600',
    whimsical: 'bg-gradient-to-r from-green-500 via-purple-500 to-orange-500'
  };
  return rarityClasses[rarity] || 'bg-gray-500';
};

const loadItems = async () => {
  if (!props.game) return;

  loading.value = true;
  try {
    const response = await axios.get(`/api/items/${selectedCategory.value}`, {
      params: { game: props.game }
    });
    items.value = response.data;
  } catch (error) {
    console.error('Error loading items:', error);
    items.value = [];
  } finally {
    loading.value = false;
  }
};

const selectItem = (item) => {
  emit('select', item);
  close();
};

const close = () => {
  emit('close');
  searchQuery.value = '';
};

// Load items when category changes
watch(selectedCategory, loadItems);

// Load items when modal opens
watch(() => props.isOpen, (isOpen) => {
  if (isOpen) {
    loadItems();
  }
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>

