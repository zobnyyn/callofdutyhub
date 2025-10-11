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
        <div class="max-w-4xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> ADMIN_PANEL INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING ZOMBIE_MAP_EDIT.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> EDITING: {{ map.name }}
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10 flex items-center justify-between">
            <div>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  РЕДАКТИРОВАНИЕ
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>ЗОМБИ КАРТЫ</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>
            <Link
              href="/admin/wiki/zombie-maps"
              class="px-6 py-3 border-2 border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-black font-mono text-sm transition-all"
            >
              <span class="text-orange-600">&gt;</span> BACK
            </Link>
          </div>

          <!-- Form -->
          <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Game -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> ИГРА*:
              </label>
              <select
                v-model="form.game"
                required
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              >
                <option value="">Выберите игру</option>
                <option value="world-at-war">World at War</option>
                <option value="black-ops">Black Ops</option>
                <option value="black-ops-2">Black Ops 2</option>
                <option value="black-ops-3">Black Ops 3</option>
                <option value="black-ops-4">Black Ops 4</option>
                <option value="cold-war">Cold War</option>
                <option value="black-ops-6">Black Ops 6</option>
              </select>
              <p v-if="errors.game" class="text-red-500 text-sm mt-2">{{ errors.game }}</p>
            </div>

            <!-- Name -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> НАЗВАНИЕ КАРТЫ*:
              </label>
              <input
                v-model="form.name"
                type="text"
                required
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
              <p v-if="errors.name" class="text-red-500 text-sm mt-2">{{ errors.name }}</p>
            </div>

            <!-- DLC Pack -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> DLC ПАКЕТ:
              </label>
              <input
                v-model="form.dlc_pack"
                type="text"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
            </div>

            <!-- Description -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> КРАТКОЕ ОПИСАНИЕ:
              </label>
              <textarea
                v-model="form.description"
                rows="3"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none resize-none"
              ></textarea>
              <p v-if="errors.description" class="text-red-500 text-sm mt-2">{{ errors.description }}</p>
            </div>

            <!-- Story -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> ИСТОРИЯ КАРТЫ:
              </label>
              <textarea
                v-model="form.story"
                rows="6"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none resize-none"
              ></textarea>
              <p v-if="errors.story" class="text-red-500 text-sm mt-2">{{ errors.story }}</p>
            </div>

            <!-- Release Date -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> ДАТА ВЫХОДА:
              </label>
              <input
                v-model="form.release_date"
                type="date"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
            </div>

            <!-- Current Background Image -->
            <div v-if="map.background_image" class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> ТЕКУЩЕЕ ФОНОВОЕ ИЗОБРАЖЕНИЕ:
              </label>
              <img :src="`/storage/${map.background_image}`" alt="Current background" class="h-40 object-cover border border-orange-500/20 p-2">
            </div>

            <!-- Background Image -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> НОВОЕ ФОНОВОЕ ИЗОБРАЖЕНИЕ:
              </label>
              <input
                @change="handleBackgroundUpload"
                type="file"
                accept="image/*"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
              <p class="text-gray-500 text-xs mt-2">Оставьте пустым, чтобы сохранить текущее изображение</p>
              <p v-if="errors.background_image" class="text-red-500 text-sm mt-2">{{ errors.background_image }}</p>
            </div>

            <!-- Current Thumbnail -->
            <div v-if="map.thumbnail" class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> ТЕКУЩАЯ МИНИАТЮРА:
              </label>
              <img :src="`/storage/${map.thumbnail}`" alt="Current thumbnail" class="h-32 object-cover border border-orange-500/20 p-2">
            </div>

            <!-- Thumbnail -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> НОВАЯ МИНИАТЮРА:
              </label>
              <input
                @change="handleThumbnailUpload"
                type="file"
                accept="image/*"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
              <p class="text-gray-500 text-xs mt-2">Оставьте пустым, чтобы сохранить текущую миниатюру</p>
              <p v-if="errors.thumbnail" class="text-red-500 text-sm mt-2">{{ errors.thumbnail }}</p>
            </div>

            <!-- Sort Order -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> ПОРЯДОК СОРТИРОВКИ:
              </label>
              <input
                v-model.number="form.sort_order"
                type="number"
                min="0"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
            </div>

            <!-- Is Published -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="flex items-center cursor-pointer">
                <input
                  v-model="form.is_published"
                  type="checkbox"
                  class="w-5 h-5 bg-black border-2 border-orange-500/30 checked:bg-orange-500 focus:ring-0 focus:ring-offset-0"
                />
                <span class="ml-3 font-mono text-sm text-orange-500">
                  <span class="text-orange-600">&gt;</span> ОПУБЛИКОВАНО (отображать на сайте)
                </span>
              </label>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
              <button
                type="submit"
                :disabled="processing"
                class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 disabled:from-gray-600 disabled:to-gray-700 text-black font-black font-mono text-lg tracking-wider transition-all"
              >
                <span class="text-orange-600">&gt;</span> {{ processing ? 'СОХРАНЕНИЕ...' : 'СОХРАНИТЬ ИЗМЕНЕНИЯ' }}
              </button>
              <Link
                href="/admin/wiki/zombie-maps"
                class="px-8 py-4 border-2 border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-black font-mono text-lg transition-all"
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
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
  map: Object,
  errors: {
    type: Object,
    default: () => ({})
  },
});

const form = ref({
  game: props.map.game,
  name: props.map.name,
  dlc_pack: props.map.dlc_pack,
  description: props.map.description,
  story: props.map.story,
  release_date: props.map.release_date,
  background_image: null,
  thumbnail: null,
  sort_order: props.map.sort_order || 0,
  is_published: props.map.is_published,
  _method: 'PUT',
});

const processing = ref(false);

const handleBackgroundUpload = (e) => {
  form.value.background_image = e.target.files[0];
};

const handleThumbnailUpload = (e) => {
  form.value.thumbnail = e.target.files[0];
};

const submitForm = () => {
  processing.value = true;

  const formData = new FormData();
  Object.keys(form.value).forEach(key => {
    if (form.value[key] !== null && form.value[key] !== undefined) {
      // Конвертируем булевые значения в числа для MySQL
      if (key === 'is_published') {
        formData.append(key, form.value[key] ? 1 : 0);
      } else {
        formData.append(key, form.value[key]);
      }
    }
  });

  router.post(`/admin/wiki/zombie-maps/${props.map.id}`, formData, {
    onFinish: () => {
      processing.value = false;
    },
  });
};
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 10px rgba(249, 115, 22, 0.5),
               0 0 20px rgba(249, 115, 22, 0.3),
               0 0 30px rgba(249, 115, 22, 0.2);
}

.cursor-blink {
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>
