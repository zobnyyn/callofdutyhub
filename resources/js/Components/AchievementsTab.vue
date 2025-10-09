<template>
  <div>
    <!-- Loading State -->
    <div v-if="loading" class="text-center py-12">
      <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-orange-500"></div>
      <p class="text-orange-500 font-mono text-sm mt-4">
        <span class="text-orange-600">&gt;</span> LOADING_ACHIEVEMENTS...
      </p>
    </div>

    <!-- No Achievements -->
    <div v-else-if="achievements.length === 0" class="text-center py-12 border border-orange-500/30 bg-orange-500/5 p-8">
      <svg class="w-16 h-16 mx-auto text-orange-500/30 mb-4" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
      </svg>
      <p class="text-gray-400 font-mono text-sm">
        <span class="text-orange-600">&gt;</span> NO_ACHIEVEMENTS_UNLOCKED
      </p>
      <p class="text-gray-600 font-mono text-xs mt-2">
        Прочитайте гайды до конца, чтобы получить достижения
      </p>
    </div>

    <!-- Achievements List -->
    <div v-else>
      <!-- Displayed Achievements Section -->
      <div class="mb-8">
        <div class="text-orange-600 font-mono text-sm mb-4">
          <span class="text-orange-600 mr-2">&gt;</span> FEATURED_ACHIEVEMENTS ({{ displayedAchievements.length }}/3):
        </div>

        <div v-if="displayedAchievements.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
          <div
            v-for="achievement in displayedAchievements"
            :key="achievement.id"
            class="border-2 border-orange-500 bg-gradient-to-br from-orange-500/20 to-red-500/20 p-4 relative overflow-hidden group"
          >
            <!-- Background Image -->
            <div
              v-if="achievement.guide?.image"
              class="absolute inset-0 bg-cover bg-center opacity-60 group-hover:opacity-70 transition-opacity duration-300"
              :style="{ backgroundImage: `url(${getImagePath(achievement.guide.image)})` }"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>

            <!-- Content -->
            <div class="flex items-start gap-3 relative z-10">
              <svg class="w-8 h-8 text-orange-500 flex-shrink-0 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <div class="flex-1 min-w-0">
                <div class="text-orange-500 font-mono text-xs mb-1 drop-shadow-lg">GUIDE_MASTER</div>
                <div class="text-white font-bold text-sm mb-1 truncate drop-shadow-lg">{{ formatMapName(achievement.guide?.map_slug) }}</div>
                <div class="text-gray-300 font-mono text-xs drop-shadow-lg">{{ achievement.guide?.game }}</div>
              </div>
            </div>
            <div class="absolute top-2 right-2 px-2 py-1 bg-orange-500 text-black font-mono text-xs font-bold z-10">
              #{{ achievement.display_order }}
            </div>
          </div>
        </div>
        <div v-else class="text-center py-6 border border-orange-500/20 bg-black/30">
          <p class="text-gray-500 font-mono text-sm">
            <span class="text-orange-600">&gt;</span> NO_FEATURED_ACHIEVEMENTS
          </p>
        </div>
      </div>

      <!-- All Achievements Section -->
      <div>
        <div class="flex items-center justify-between mb-4">
          <div class="text-orange-600 font-mono text-sm">
            <span class="text-orange-600 mr-2">&gt;</span> ALL_ACHIEVEMENTS ({{ achievements.length }}):
          </div>
          <div v-if="isOwnProfile && editMode" class="flex items-center gap-2">
            <button
              @click="cancelEdit"
              class="px-4 py-2 border border-gray-500 text-gray-400 font-mono text-xs hover:bg-gray-500/10 transition-colors"
            >
              CANCEL
            </button>
            <button
              @click="saveDisplayed"
              :disabled="selectedAchievements.length === 0"
              class="px-4 py-2 border border-orange-500 text-orange-500 font-mono text-xs hover:bg-orange-500/10 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            >
              SAVE ({{ selectedAchievements.length }}/3)
            </button>
          </div>
          <button
            v-else-if="isOwnProfile"
            @click="startEdit"
            class="px-4 py-2 border border-orange-500 text-orange-500 font-mono text-xs hover:bg-orange-500/10 transition-colors"
          >
            <span class="text-orange-600">&gt;</span> EDIT_FEATURED
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div
            v-for="achievement in achievements"
            :key="achievement.id"
            @click="editMode && toggleSelection(achievement.id)"
            :class="[
              'border p-4 transition-all relative overflow-hidden group',
              editMode ? 'cursor-pointer hover:bg-orange-500/10' : '',
              editMode && selectedAchievements.includes(achievement.id)
                ? 'border-orange-500 bg-orange-500/20'
                : 'border-orange-500/30 bg-orange-500/5'
            ]"
          >
            <!-- Background Image -->
            <div
              v-if="achievement.guide?.image"
              class="absolute inset-0 bg-cover bg-center opacity-45 group-hover:opacity-55 transition-opacity duration-300"
              :style="{ backgroundImage: `url(${getImagePath(achievement.guide.image)})` }"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/55 to-black/35"></div>

            <!-- Content -->
            <div class="flex items-start gap-3 relative z-10">
              <div class="relative">
                <svg class="w-10 h-10 text-orange-500 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <div
                  v-if="editMode && selectedAchievements.includes(achievement.id)"
                  class="absolute -top-1 -right-1 w-5 h-5 bg-orange-500 rounded-full flex items-center justify-center"
                >
                  <svg class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <div class="text-orange-500 font-mono text-xs mb-1 drop-shadow-lg">GUIDE_MASTER</div>
                <div class="text-white font-bold text-sm mb-1 drop-shadow-lg">{{ achievement.guide?.title }}</div>
                <div class="text-gray-300 font-mono text-xs mb-2 drop-shadow-lg">
                  {{ achievement.guide?.game }} - {{ formatMapName(achievement.guide?.map_slug) }}
                </div>
                <div class="text-gray-400 font-mono text-xs drop-shadow">
                  {{ formatDate(achievement.completed_at) }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
  userId: {
    type: Number,
    required: true
  },
  isOwnProfile: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['achievements-loaded']);

const loading = ref(true);
const achievements = ref([]);
const editMode = ref(false);
const selectedAchievements = ref([]);

const displayedAchievements = computed(() => {
  return achievements.value
    .filter(a => a.display_order !== null)
    .sort((a, b) => a.display_order - b.display_order)
    .slice(0, 3);
});

const loadAchievements = async () => {
  loading.value = true;
  try {
    const response = await axios.get(`/api/achievements/user/${props.userId}`);
    console.log('Achievements API response:', response.data);
    achievements.value = response.data.achievements;
    emit('achievements-loaded', response.data.total_count);
  } catch (error) {
    console.error('Error loading achievements:', error);
    console.error('Error response:', error.response?.data);
  } finally {
    loading.value = false;
  }
};

const startEdit = () => {
  editMode.value = true;
  selectedAchievements.value = displayedAchievements.value.map(a => a.id);
};

const cancelEdit = () => {
  editMode.value = false;
  selectedAchievements.value = [];
};

const toggleSelection = (achievementId) => {
  const index = selectedAchievements.value.indexOf(achievementId);
  if (index > -1) {
    selectedAchievements.value.splice(index, 1);
  } else {
    if (selectedAchievements.value.length < 3) {
      selectedAchievements.value.push(achievementId);
    }
  }
};

const saveDisplayed = async () => {
  try {
    await axios.post('/api/achievements/update-displayed', {
      achievements: selectedAchievements.value
    });

    // Перезагружаем достижения
    await loadAchievements();
    editMode.value = false;
    selectedAchievements.value = [];
  } catch (error) {
    console.error('Error saving displayed achievements:', error);
    alert('Ошибка при сохранении достижений');
  }
};

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
};

const formatMapName = (mapSlug) => {
  if (!mapSlug) return '';

  // Преобразуем slug в читаемое название
  // Например: "nacht-der-untoten" -> "Nacht Der Untoten"
  return mapSlug
    .split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ');
};

// Функция для получения правильного пути к изображению
const getImagePath = (imagePath) => {
  if (!imagePath) return '';

  // Если путь начинается с /, это уже полный путь
  if (imagePath.startsWith('/')) {
    return imagePath;
  }

  // Если путь содержит расширение файла, это путь к файлу в storage
  if (imagePath.includes('.jpg') || imagePath.includes('.png') || imagePath.includes('.jpeg')) {
    // Проверяем, начинается ли с images/ (путь из public)
    if (imagePath.startsWith('images/')) {
      return `/${imagePath}`;
    }
    // Иначе это путь в storage
    return `/storage/${imagePath}`;
  }

  return `/storage/${imagePath}`;
};

onMounted(() => {
  loadAchievements();
});
</script>
