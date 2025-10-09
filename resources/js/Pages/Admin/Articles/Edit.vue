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
              <span class="text-orange-600">&gt;</span> ARTICLE_EDITOR INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> MODE: EDIT_EXISTING
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> LOADING ARTICLE_ID: {{ article.id }}
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <Link
              href="/admin/articles"
              class="text-orange-500 hover:text-orange-400 font-mono text-sm mb-4 inline-flex items-center gap-2"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> BACK_TO_LIST
            </Link>
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                РЕДАКТИРОВАНИЕ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>СТАТЬИ</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Form -->
          <form @submit.prevent="submit" class="space-y-6">
            <!-- Title -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> TITLE:
              </label>
              <input
                v-model="form.title"
                type="text"
                placeholder="Введите название статьи..."
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono text-sm focus:border-orange-500 focus:outline-none"
                required
              />
              <div v-if="errors.title" class="text-red-500 text-xs font-mono mt-2">{{ errors.title }}</div>
            </div>

            <!-- Game -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> GAME:
              </label>
              <select
                v-model="form.game"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono text-sm focus:border-orange-500 focus:outline-none"
                required
              >
                <option value="">Выберите игру...</option>
                <optgroup label="Black Ops Series">
                  <option value="World at War">World at War</option>
                  <option value="Black Ops">Black Ops</option>
                  <option value="Black Ops 2">Black Ops 2</option>
                  <option value="Black Ops 3">Black Ops 3</option>
                  <option value="Black Ops 4">Black Ops 4</option>
                  <option value="Cold War">Cold War</option>
                  <option value="Black Ops 6">Black Ops 6</option>
                  <option value="Black Ops 7">Black Ops 7</option>
                </optgroup>
                <optgroup label="Modern Warfare Series">
                  <option value="COD 4: Modern Warfare">COD 4: Modern Warfare (2007)</option>
                  <option value="Modern Warfare 2">Modern Warfare 2 (2009)</option>
                  <option value="Modern Warfare 3">Modern Warfare 3 (2011)</option>
                  <option value="Modern Warfare">Modern Warfare (2019)</option>
                  <option value="Modern Warfare II">Modern Warfare II (2022)</option>
                  <option value="Modern Warfare III">Modern Warfare III (2023)</option>
                </optgroup>
              </select>
              <div v-if="errors.game" class="text-red-500 text-xs font-mono mt-2">{{ errors.game }}</div>
            </div>

            <!-- Category -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> CATEGORY:
              </label>
              <select
                v-model="form.category"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono text-sm focus:border-orange-500 focus:outline-none"
              >
                <option value="">Выберите категорию...</option>
                <option value="Новости">Новости</option>
                <option value="Обзоры">Обзоры</option>
                <option value="Гайды">Гайды</option>
              </select>
              <div v-if="errors.category" class="text-red-500 text-xs font-mono mt-2">{{ errors.category }}</div>
            </div>

            <!-- Excerpt -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> EXCERPT (краткое описание):
              </label>
              <textarea
                v-model="form.excerpt"
                placeholder="Краткое описание статьи..."
                rows="3"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono text-sm focus:border-orange-500 focus:outline-none resize-none"
              ></textarea>
              <div v-if="errors.excerpt" class="text-red-500 text-xs font-mono mt-2">{{ errors.excerpt }}</div>
            </div>

            <!-- Image -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> IMAGE:
              </label>

              <!-- Current Image -->
              <div v-if="article.image && !imagePreview" class="mb-4 border border-orange-500/30 p-2">
                <div class="text-xs font-mono text-gray-400 mb-2">Текущее изображение:</div>
                <img :src="`/storage/${article.image}`" alt="Current" class="max-w-full h-auto max-h-64 object-contain" />
              </div>

              <input
                @change="handleImageChange"
                type="file"
                accept="image/*"
                class="w-full bg-black border border-orange-500/30 text-white px-4 py-3 font-mono text-sm focus:border-orange-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-mono file:bg-orange-600 file:text-black hover:file:bg-orange-500 file:cursor-pointer"
              />

              <!-- New Image Preview -->
              <div v-if="imagePreview" class="mt-4 border border-orange-500/30 p-2">
                <div class="text-xs font-mono text-green-400 mb-2">Новое изображение:</div>
                <img :src="imagePreview" alt="Preview" class="max-w-full h-auto max-h-64 object-contain" />
              </div>

              <div v-if="errors.image" class="text-red-500 text-xs font-mono mt-2">{{ errors.image }}</div>
            </div>

            <!-- Content -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="block font-mono text-xs text-orange-600 mb-2">
                <span class="text-orange-600">&gt;</span> CONTENT:
              </label>
              <TiptapEditor v-model="form.content" />
              <div v-if="errors.content" class="text-red-500 text-xs font-mono mt-2">{{ errors.content }}</div>
            </div>

            <!-- Is Published -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6 relative">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <label class="flex items-center gap-3 cursor-pointer">
                <input
                  v-model="form.is_published"
                  type="checkbox"
                  class="w-5 h-5 bg-black border-2 border-orange-500/30 checked:bg-orange-600 checked:border-orange-600 focus:ring-0 focus:ring-offset-0"
                />
                <span class="font-mono text-sm text-orange-500">
                  <span class="text-orange-600">&gt;</span> ОПУБЛИКОВАНА
                </span>
              </label>
              <div v-if="article.published_at" class="text-xs font-mono text-gray-500 mt-2">
                Дата публикации: {{ formatDate(article.published_at) }}
              </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
              <button
                type="submit"
                :disabled="processing"
                class="flex-1 px-6 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black font-black font-mono tracking-wider transition-all disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span v-if="!processing"><span class="text-orange-900">&gt;</span> СОХРАНИТЬ_ИЗМЕНЕНИЯ</span>
                <span v-else><span class="text-orange-900">&gt;</span> ОБРАБОТКА...</span>
              </button>
              <Link
                href="/admin/articles"
                class="px-6 py-4 border-2 border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-black font-mono transition-all text-center"
              >
                ОТМЕНА
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
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import TiptapEditor from '@/Components/TiptapEditor.vue';

const props = defineProps({
  article: Object,
});

const form = useForm({
  title: props.article.title,
  game: props.article.game,
  category: props.article.category || '',
  excerpt: props.article.excerpt || '',
  content: props.article.content,
  image: null,
  is_published: props.article.is_published,
  _method: 'PUT',
});

const errors = ref({});
const processing = ref(false);
const imagePreview = ref(null);

function handleImageChange(event) {
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

function submit() {
  processing.value = true;

  form.post(`/admin/articles/${props.article.id}`, {
    onSuccess: () => {
      processing.value = false;
    },
    onError: (err) => {
      errors.value = err;
      processing.value = false;
    },
  });
}

function formatDate(date) {
  if (!date) return '';
  return new Date(date).toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
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
