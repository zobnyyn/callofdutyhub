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
              <span class="text-orange-600">&gt;</span> LOADING ITEM_EDIT.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> READY FOR INPUT
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
                <span>ПРЕДМЕТА</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>
            <Link
              href="/admin/items"
              class="px-6 py-3 border-2 border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-black font-mono text-sm transition-all"
            >
              <span class="text-orange-600">&gt;</span> BACK
            </Link>
          </div>

          <!-- Form -->
          <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Name -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> NAME*:
              </label>
              <input
                v-model="form.name"
                type="text"
                required
                placeholder="Например: Ray Gun, Juggernog, Alchemical Antithesis"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
              />
              <p v-if="errors.name" class="text-red-500 text-sm mt-2">{{ errors.name }}</p>
            </div>

            <!-- Type -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> TYPE*:
              </label>
              <div class="grid grid-cols-3 gap-4">
                <label class="cursor-pointer">
                  <input
                    v-model="form.type"
                    type="radio"
                    value="weapon"
                    class="hidden peer"
                  />
                  <div class="border-2 border-orange-500/30 bg-black p-4 text-center peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all">
                    <div class="text-2xl mb-2">🔫</div>
                    <div class="font-mono text-sm">ОРУЖИЕ</div>
                  </div>
                </label>
                <label class="cursor-pointer">
                  <input
                    v-model="form.type"
                    type="radio"
                    value="perk"
                    class="hidden peer"
                  />
                  <div class="border-2 border-orange-500/30 bg-black p-4 text-center peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all">
                    <div class="text-2xl mb-2">⚡</div>
                    <div class="font-mono text-sm">ПЕРК</div>
                  </div>
                </label>
                <label class="cursor-pointer">
                  <input
                    v-model="form.type"
                    type="radio"
                    value="gum"
                    class="hidden peer"
                  />
                  <div class="border-2 border-orange-500/30 bg-black p-4 text-center peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all">
                    <div class="text-2xl mb-2">🍬</div>
                    <div class="font-mono text-sm">ЖВАЧКА</div>
                  </div>
                </label>
              </div>
              <p v-if="errors.type" class="text-red-500 text-sm mt-2">{{ errors.type }}</p>
            </div>

            <!-- Rarity (только для жвачек) -->
            <div v-if="form.type === 'gum'" class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> RARITY:
              </label>
              <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <label class="cursor-pointer">
                  <input
                    v-model="form.rarity"
                    type="radio"
                    value="rare"
                    class="hidden peer"
                  />
                  <div class="border-2 border-blue-500/30 bg-black p-3 text-center peer-checked:border-blue-500 peer-checked:bg-blue-500/10 transition-all">
                    <div class="font-mono text-xs mb-1 text-blue-500">RARE</div>
                    <div class="text-sm text-blue-400">Редкая</div>
                  </div>
                </label>
                <label class="cursor-pointer">
                  <input
                    v-model="form.rarity"
                    type="radio"
                    value="epic"
                    class="hidden peer"
                  />
                  <div class="border-2 border-purple-500/30 bg-black p-3 text-center peer-checked:border-purple-500 peer-checked:bg-purple-500/10 transition-all">
                    <div class="font-mono text-xs mb-1 text-purple-500">EPIC</div>
                    <div class="text-sm text-purple-400">Эпическая</div>
                  </div>
                </label>
                <label class="cursor-pointer">
                  <input
                    v-model="form.rarity"
                    type="radio"
                    value="legendary"
                    class="hidden peer"
                  />
                  <div class="border-2 border-amber-500/30 bg-black p-3 text-center peer-checked:border-amber-500 peer-checked:bg-amber-500/10 transition-all">
                    <div class="font-mono text-xs mb-1 text-amber-500">LEGENDARY</div>
                    <div class="text-sm text-amber-400">Легендарная</div>
                  </div>
                </label>
                <label class="cursor-pointer">
                  <input
                    v-model="form.rarity"
                    type="radio"
                    value="ultra"
                    class="hidden peer"
                  />
                  <div class="border-2 border-red-600/30 bg-black p-3 text-center peer-checked:border-red-600 peer-checked:bg-red-600/10 transition-all">
                    <div class="font-mono text-xs mb-1 text-red-600">ULTRA</div>
                    <div class="text-sm text-red-500">Ультра</div>
                  </div>
                </label>
                <label class="cursor-pointer">
                  <input
                    v-model="form.rarity"
                    type="radio"
                    value="whimsical"
                    class="hidden peer"
                  />
                  <div class="border-2 border-orange-500/30 bg-black p-3 text-center peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all">
                    <div class="font-mono text-xs mb-1 bg-gradient-to-r from-green-500 via-purple-500 to-orange-500 bg-clip-text text-transparent">WHIMSICAL</div>
                    <div class="text-sm text-gray-400">Причудливая</div>
                  </div>
                </label>
              </div>
              <p v-if="errors.rarity" class="text-red-500 text-sm mt-2">{{ errors.rarity }}</p>
            </div>

            <!-- Description -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> DESCRIPTION:
              </label>
              <textarea
                v-model="form.description"
                rows="4"
                placeholder="Подробное описание предмета, его эффектов и особенностей..."
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none resize-none"
              ></textarea>
              <p v-if="errors.description" class="text-red-500 text-sm mt-2">{{ errors.description }}</p>
            </div>

            <!-- Image Upload -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> IMAGE:
              </label>
              <div class="border-2 border-dashed border-orange-500/30 p-8 text-center hover:border-orange-500/50 transition-all">
                <input
                  ref="imageInput"
                  type="file"
                  accept="image/*"
                  @change="handleImageUpload"
                  class="hidden"
                />
                <div v-if="!imagePreview && !item.image" @click="$refs.imageInput.click()" class="cursor-pointer">
                  <svg class="w-16 h-16 mx-auto mb-4 text-orange-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  <p class="text-orange-500 font-mono mb-2">Click to upload image</p>
                  <p class="text-gray-500 text-sm">PNG, JPG up to 2MB</p>
                </div>
                <div v-else class="relative">
                  <img :src="imagePreview || `/storage/${item.image}`" class="max-h-64 mx-auto mb-4" />
                  <div class="flex gap-4 justify-center">
                    <button
                      type="button"
                      @click="$refs.imageInput.click()"
                      class="px-4 py-2 border border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-mono text-sm transition-all"
                    >
                      <span class="text-orange-600">&gt;</span> CHANGE
                    </button>
                    <button
                      type="button"
                      @click="removeImage"
                      class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white font-mono text-sm transition-all"
                    >
                      <span class="text-red-900">&gt;</span> REMOVE
                    </button>
                  </div>
                </div>
              </div>
              <p v-if="errors.image" class="text-red-500 text-sm mt-2">{{ errors.image }}</p>
            </div>

            <!-- Game Selection (Multiple) -->
            <div class="border border-orange-500/30 bg-black/50 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> GAMES* (выберите одну или несколько):
              </label>
              <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <label
                  v-for="game in availableGames"
                  :key="game.value"
                  class="cursor-pointer"
                >
                  <input
                    v-model="form.games"
                    type="checkbox"
                    :value="game.value"
                    class="hidden peer"
                  />
                  <div class="border-2 border-orange-500/30 bg-black p-3 text-center peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all">
                    <div class="font-mono text-xs text-orange-500">{{ game.label }}</div>
                  </div>
                </label>
              </div>
              <p v-if="form.games && form.games.length === 0" class="text-yellow-500 text-xs mt-2 font-mono">
                <span class="text-yellow-600">&gt;</span> Выберите хотя бы одну игру
              </p>
              <p v-if="errors.games" class="text-red-500 text-sm mt-2">{{ errors.games }}</p>
            </div>

            <!-- Sort Order & Status -->
            <div class="grid grid-cols-2 gap-6">
              <div class="border border-orange-500/30 bg-black/50 p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <label class="block font-mono text-xs text-orange-600 mb-2">
                  <span class="text-orange-600">&gt;</span> SORT_ORDER:
                </label>
                <input
                  v-model.number="form.sort_order"
                  type="number"
                  min="0"
                  placeholder="0"
                  class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono focus:border-orange-500 focus:outline-none"
                />
              </div>

              <div class="border border-orange-500/30 bg-black/50 p-6 relative">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <label class="block font-mono text-xs text-orange-600 mb-2">
                  <span class="text-orange-600">&gt;</span> STATUS:
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                  <input
                    v-model="form.is_active"
                    type="checkbox"
                    class="w-6 h-6 accent-orange-500"
                  />
                  <span class="font-mono text-sm">ACTIVE</span>
                </label>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                :disabled="processing"
                class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 disabled:opacity-50 disabled:cursor-not-allowed text-black font-black font-mono text-lg transition-all"
              >
                <span class="text-orange-900">&gt;</span> {{ processing ? 'UPDATING...' : 'UPDATE_ITEM' }}
              </button>
              <Link
                href="/admin/items"
                class="px-8 py-4 border-2 border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-black font-mono text-lg transition-all"
              >
                CANCEL
              </Link>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  item: Object,
});

const imageInput = ref(null);
const imagePreview = ref(null);
const processing = ref(false);
const errors = ref({});

const form = reactive({
  name: props.item.name,
  type: props.item.type,
  game: props.item.game || '',
  rarity: props.item.rarity || null,
  description: props.item.description || '',
  image: null,
  sort_order: props.item.sort_order || 0,
  is_active: props.item.is_active,
  games: props.item.games || [],
});

const availableGames = [
  { value: 'World at War', label: 'World at War' },
  { value: 'Black Ops', label: 'Black Ops' },
  { value: 'Black Ops 2', label: 'Black Ops 2' },
  { value: 'Black Ops 3', label: 'Black Ops 3' },
  { value: 'Black Ops 4', label: 'Black Ops 4' },
  { value: 'Cold War', label: 'Cold War' },
  { value: 'Black Ops 6', label: 'Black Ops 6' },
  { value: 'Black Ops 7', label: 'Black Ops 7' },
];

function handleImageUpload(event) {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
}

function removeImage() {
  form.image = null;
  imagePreview.value = null;
  if (imageInput.value) {
    imageInput.value.value = '';
  }
}

function submitForm() {
  processing.value = true;
  errors.value = {};

  // Проверяем, что выбрана хотя бы одна игра
  if (!form.games || form.games.length === 0) {
    errors.value.games = 'Выберите хотя бы одну игру';
    processing.value = false;
    return;
  }

  // Создаем FormData вручную, чтобы правильно обработать файлы
  const formData = {
    name: form.name,
    type: form.type,
    games: form.games, // Отправляем массив игр
    rarity: form.rarity,
    description: form.description,
    sort_order: form.sort_order,
    is_active: form.is_active,
    _method: 'PUT',
  };

  // Добавляем изображение только если оно было выбрано
  if (form.image && form.image instanceof File) {
    formData.image = form.image;
  }

  router.post(`/admin/items/${props.item.id}`, formData, {
    forceFormData: true,
    onSuccess: () => {
      processing.value = false;
    },
    onError: (err) => {
      errors.value = err;
      processing.value = false;
    },
  });
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
</style>
