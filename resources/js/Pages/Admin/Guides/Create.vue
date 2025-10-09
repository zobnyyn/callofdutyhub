<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Create Guide Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-5xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> GUIDE_EDITOR INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> CREATING NEW_GUIDE.md
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> EDITOR READY
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                СОЗДАТЬ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>ГАЙД</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Form -->
          <form @submit.prevent="submit" class="space-y-6">
            <!-- Error Messages -->
            <div v-if="Object.keys(errors).length > 0" class="border border-red-500/30 bg-red-900/20 p-4 font-mono">
              <div class="text-red-500 text-sm mb-2">
                <span class="text-red-600">&gt;</span> ERRORS DETECTED:
              </div>
              <ul class="list-disc list-inside text-red-400 text-xs space-y-1">
                <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
              </ul>
            </div>

            <!-- Game Selection -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> GAME:
              </label>
              <select
                v-model="form.game"
                required
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              >
                <option value="">Выберите игру</option>
                <option value="World at War">Call of Duty: World at War</option>
                <option value="Black Ops">Call of Duty: Black Ops</option>
                <option value="Black Ops 2">Call of Duty: Black Ops 2</option>
                <option value="Black Ops 3">Call of Duty: Black Ops 3</option>
                <option value="Black Ops 4">Call of Duty: Black Ops 4</option>
                <option value="Cold War">Call of Duty: Black Ops Cold War</option>
                <option value="Black Ops 6">Call of Duty: Black Ops 6</option>
                <option value="Black Ops 7">Call of Duty: Black Ops 7</option>
              </select>
            </div>

            <!-- Map Name -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> MAP_NAME:
              </label>
              <select
                v-model="form.map_slug"
                required
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              >
                <option value="">Выберите карту</option>
                <option v-for="map in availableMaps" :key="map.slug" :value="map.slug">
                  {{ map.name }}
                </option>
              </select>
            </div>

            <!-- Title -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> TITLE:
              </label>
              <input
                v-model="form.title"
                type="text"
                required
                placeholder="Заголовок гайда"
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              />
            </div>

            <!-- Description -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> DESCRIPTION:
              </label>
              <textarea
                v-model="form.description"
                rows="3"
                placeholder="Краткое описание гайда (опционально)"
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors resize-none"
              ></textarea>
            </div>

            <!-- Content Editor -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> CONTENT:
              </label>
              <TiptapEditor v-model="form.content" />
              <div class="mt-2 text-xs text-gray-500 font-mono">
                <span class="text-orange-600">&gt;</span> Используйте панель инструментов для форматирования текста, вставки изображений и видео
              </div>
            </div>

            <!-- Image Upload -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> IMAGE:
              </label>
              <div
                @drop.prevent="handleDrop"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @click="$refs.imageInput.click()"
                :class="[
                  'border-2 border-dashed rounded p-6 text-center cursor-pointer transition-all',
                  isDragging ? 'border-orange-500 bg-orange-500/10' : 'border-orange-600/30 hover:border-orange-500/50'
                ]"
              >
                <div v-if="previewUrl" class="mb-4">
                  <img :src="previewUrl" alt="Preview" class="max-h-48 mx-auto border-2 border-orange-500" />
                </div>
                <div class="text-gray-400 font-mono text-sm">
                  <svg class="w-12 h-12 mx-auto mb-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                  </svg>
                  <p v-if="form.image">{{ form.image.name }}</p>
                  <p v-else>Перетащите изображение или нажмите для выбора</p>
                  <p class="text-xs text-gray-500 mt-1">PNG, JPG до 2MB</p>
                </div>
              </div>
              <input
                ref="imageInput"
                type="file"
                accept="image/jpeg,image/png,image/jpg"
                @change="handleImageSelect"
                class="hidden"
              />
            </div>

            <!-- Published Status -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="flex items-center cursor-pointer">
                <input
                  v-model="form.is_published"
                  type="checkbox"
                  class="w-5 h-5 bg-black border-2 border-orange-500/30 text-orange-500 focus:ring-orange-500 focus:ring-offset-black cursor-pointer"
                />
                <span class="ml-3 text-orange-600 font-mono text-sm">
                  <span class="text-orange-600">&gt;</span> ОПУБЛИКОВАТЬ СРАЗУ
                </span>
              </label>
            </div>

            <!-- Achievement Status -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="flex items-center cursor-pointer">
                <input
                  v-model="form.gives_achievement"
                  type="checkbox"
                  class="w-5 h-5 bg-black border-2 border-orange-500/30 text-orange-500 focus:ring-orange-500 focus:ring-offset-black cursor-pointer"
                />
                <span class="ml-3 text-orange-600 font-mono text-sm">
                  <span class="text-orange-600">&gt;</span> ДАВАТЬ ДОСТИЖЕНИЕ ЗА ПРОСМОТР
                </span>
              </label>
              <div class="mt-2 text-xs text-gray-400 font-mono ml-8">
                Если включено, пользователи получат достижение за просмотр этого гайда
              </div>
            </div>

            <!-- Recommended Items Section -->
            <div class="border-2 border-orange-500/50 bg-orange-500/5 p-6">
              <div class="text-orange-500 font-mono text-lg mb-6 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span class="text-orange-600">&gt;</span> РЕКОМЕНДУЕМЫЕ ПРЕДМЕТЫ
              </div>
              <div class="text-gray-400 text-sm font-mono mb-6">
                Выберите предметы, которые будут отображаться в начале гайда
              </div>

              <div class="space-y-6">
                <!-- Weapons -->
                <GuideItemSelector
                  label="РЕКОМЕНДУЕМОЕ ОРУЖИЕ"
                  buttonText="ОРУЖИЕ"
                  type="weapon"
                  :selectedGame="form.game"
                  v-model="selectedWeapons"
                />

                <!-- Perks -->
                <GuideItemSelector
                  label="РЕКОМЕНДУЕМЫЕ ПЕРКИ"
                  buttonText="ПЕРК"
                  type="perk"
                  :selectedGame="form.game"
                  v-model="selectedPerks"
                />

                <!-- Gums -->
                <GuideItemSelector
                  label="РЕКОМЕНДУЕМЫЕ ЖВАЧКИ"
                  buttonText="ЖВАЧКУ"
                  type="gum"
                  :selectedGame="form.game"
                  v-model="selectedGums"
                />
              </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                :disabled="processing"
                class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-lg font-black font-mono tracking-wider transition-all disabled:opacity-50"
              >
                <span class="text-orange-600 mr-2">&gt;</span>
                {{ processing ? 'SAVING...' : 'SAVE_GUIDE_' }}
              </button>

              <Link
                href="/admin/guides"
                class="px-8 py-4 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all"
              >
                <span class="text-orange-600 mr-2">&gt;</span> CANCEL
              </Link>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import Header from '../../../Components/Header.vue';
import TiptapEditor from '../../../Components/TiptapEditor.vue';
import GuideItemSelector from '../../../Components/GuideItemSelector.vue';

// Высота хэдера для правильного позиционирования
const HEADER_HEIGHT = 120; // примерная высота хэдера в пикселях

// Выбранные предметы
const selectedWeapons = ref([]);
const selectedPerks = ref([]);
const selectedGums = ref([]);

const form = useForm({
  game: '',
  map_slug: '',
  title: '',
  description: '',
  content: '',
  image: null,
  is_published: false,
  gives_achievement: true
});

// Карты для каждой игры
const gameMaps = {
  'World at War': [
    { slug: 'nacht-der-untoten', name: 'Nacht der Untoten' },
    { slug: 'verruckt', name: 'Verrückt' },
    { slug: 'shi-no-numa', name: 'Shi No Numa' },
    { slug: 'der-riese', name: 'Der Riese' }
  ],
  'Black Ops': [
    { slug: 'kino-der-toten', name: 'Kino der Toten' },
    { slug: 'five', name: '"Five"' },
    { slug: 'ascension', name: 'Ascension' },
    { slug: 'call-of-the-dead', name: 'Call of the Dead' },
    { slug: 'shangri-la', name: 'Shangри-La' },
    { slug: 'moon', name: 'Moon' }
  ],
  'Black Ops 2': [
    { slug: 'tranzit', name: 'TranZit' },
    { slug: 'nuketown-zombies', name: 'Nuketown Zombies' },
    { slug: 'die-rise', name: 'Die Rise' },
    { slug: 'mob-of-the-dead', name: 'Mob of the Dead' },
    { slug: 'buried', name: 'Buried' },
    { slug: 'origins', name: 'Origins' }
  ],
  'Black Ops 3': [
    // Original Maps
    { slug: 'shadows-of-evil', name: 'Shadows of Evil' },
    { slug: 'the-giant', name: 'The Giant' },
    { slug: 'der-eisendrache', name: 'Der Eisendrache' },
    { slug: 'zetsubou-no-shima', name: 'Zetsubou No Shima' },
    { slug: 'gorod-krovi', name: 'Gorod Krovi' },
    { slug: 'revelations', name: 'Revelations' },
    // Zombie Chronicles
    { slug: 'bo3-nacht-der-untoten', name: 'Nacht der Untoten (ZC)' },
    { slug: 'bo3-verruckt', name: 'Verrückt (ZC)' },
    { slug: 'bo3-shi-no-numa', name: 'Shi No Numa (ZC)' },
    { slug: 'bo3-kino-der-toten', name: 'Kino der Toten (ZC)' },
    { slug: 'bo3-ascension', name: 'Ascension (ZC)' },
    { slug: 'bo3-shangri-la', name: 'Shangri-La (ZC)' },
    { slug: 'bo3-moon', name: 'Moon (ZC)' },
    { slug: 'bo3-origins', name: 'Origins (ZC)' }
  ],
  'Black Ops 4': [
    { slug: 'ix', name: 'IX' },
    { slug: 'blood-of-the-dead', name: 'Blood of the Dead' },
    { slug: 'voyage-of-despair', name: 'Voyage of Despair' },
    { slug: 'classified', name: 'Classified' },
    { slug: 'dead-of-the-night', name: 'Dead of the Night' },
    { slug: 'ancient-evil', name: 'Ancient Evil' },
    { slug: 'alpha-omega', name: 'Alpha Omega' },
    { slug: 'tag-der-toten', name: 'Tag der Toten' }
  ],
  'Cold War': [
    { slug: 'die-maschine', name: 'Die Maschine' },
    { slug: 'firebase-z', name: 'Firebase Z' },
    { slug: 'outbreak', name: 'Outbreak' },
    { slug: 'mauer-der-toten', name: 'Mauer der Toten' },
    { slug: 'forsaken', name: 'Forsaken' }
  ],
  'Black Ops 6': [
    { slug: 'liberty-falls', name: 'Liberty Falls' },
    { slug: 'terminus', name: 'Terminus' },
    { slug: 'citadelle-des-morts', name: 'Citadelle des Morts' },
    { slug: 'the-tomb', name: 'The Tomb' },
    { slug: 'shattered-veil', name: 'Shattered Veil' },
    { slug: 'reckoning', name: 'Reckoning' }
  ],
  'Black Ops 7': [
    { slug: 'ashes-of-the-damned', name: 'Ashes of the Damned' }
  ]
};

// Доступные карты для выбранной игры
const availableMaps = computed(() => {
  return gameMaps[form.game] || [];
});

// Сбросить выбор карты при смене игры
watch(() => form.game, () => {
  form.map_slug = '';
});

const errors = ref({});
const processing = ref(false);
const isDragging = ref(false);
const previewUrl = ref('');
const imageInput = ref(null);

function handleDrop(e) {
  isDragging.value = false;
  const files = e.dataTransfer.files;
  if (files.length > 0) {
    handleImage(files[0]);
  }
}

function handleImageSelect(e) {
  const files = e.target.files;
  if (files.length > 0) {
    handleImage(files[0]);
  }
}

function handleImage(file) {
  if (!file.type.match('image.*')) {
    alert('Пожалуйста, выберите изображение');
    return;
  }

  if (file.size > 2 * 1024 * 1024) {
    alert('Размер файла не должен превышать 2MB');
    return;
  }

  form.image = file;

  const reader = new FileReader();
  reader.onload = (e) => {
    previewUrl.value = e.target.result;
  };
  reader.readAsDataURL(file);
}

function submit() {
  processing.value = true;
  errors.value = {};

  // Добавляем ID выбранных предметов в форму
  const formData = {
    ...form.data(),
    selected_weapons: selectedWeapons.value.map(item => item.id),
    selected_perks: selectedPerks.value.map(item => item.id),
    selected_gums: selectedGums.value.map(item => item.id),
  };

  form.transform(() => formData).post('/admin/guides', {
    preserveScroll: true,
    forceFormData: true,
    onError: (err) => {
      errors.value = err;
      processing.value = false;
    },
    onSuccess: () => {
      processing.value = false;
    }
  });
}
</script>

<style scoped>
/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

/* Cursor Blink */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>
