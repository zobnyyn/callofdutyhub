<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div v-if="zombieMap.background_image" class="fixed inset-0 z-0">
      <div
        class="w-full h-full bg-cover bg-center opacity-30"
        :style="`background-image: url('/storage/${zombieMap.background_image}')`"
      ></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/90"></div>
    </div>

    <!-- Header Component -->
    <Header />

    <!-- Main Container -->
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">

        <!-- Breadcrumbs -->
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-red-500/70">
            <Link href="/cod-wiki" class="hover:text-red-500 transition-colors">
              <span class="text-red-600">&gt;</span> COD_WIKI
            </Link>
            <span class="text-red-600">/</span>
            <Link :href="`/wiki/${zombieMap.game}`" class="hover:text-red-500 transition-colors">
              {{ zombieMap.game.toUpperCase().replace('-', '_') }}
            </Link>
            <span class="text-red-600">/</span>
            <span class="text-red-500">{{ zombieMap.name.toUpperCase() }}</span>
          </div>
          <div class="h-px bg-gradient-to-r from-red-500 to-transparent mt-3 max-w-md"></div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 md:mb-12">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-600 to-red-700 terminal-glow">
                  {{ zombieMap.name }}
                </span>
              </h1>

              <div v-if="zombieMap.dlc_pack || zombieMap.release_date" class="mt-4 font-mono text-sm md:text-base text-red-500/90">
                <span class="text-red-600">&gt;</span>
                <span v-if="zombieMap.dlc_pack"> {{ zombieMap.dlc_pack }}</span>
                <span v-if="zombieMap.release_date"> | {{ zombieMap.release_date }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

          <!-- Main Content Column -->
          <div class="lg:col-span-2 space-y-6">

            <!-- Image Gallery Section -->
            <section v-if="zombieMap.images && zombieMap.images.length > 0" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6 md:p-8">
              <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ГАЛЕРЕЯ</span>
              </h2>
              <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div
                  v-for="(image, index) in zombieMap.images"
                  :key="index"
                  @click="openLightbox(index)"
                  class="group relative overflow-hidden border-2 border-red-500/30 hover:border-red-500 cursor-pointer transition-all aspect-video"
                >
                  <img
                    :src="`/storage/${image}`"
                    :alt="`${zombieMap.name} - изображение ${index + 1}`"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                  />
                  <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </section>

            <!-- Description Section -->
            <section v-if="zombieMap.description" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6 md:p-8">
              <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ОПИСАНИЕ</span>
              </h2>
              <div class="prose prose-invert max-w-none">
                <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ zombieMap.description }}</p>
              </div>
            </section>

            <!-- Story Section -->
            <section v-if="zombieMap.story" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6 md:p-8">
              <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ИСТОРИЯ</span>
              </h2>
              <div class="prose prose-invert max-w-none">
                <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ zombieMap.story }}</p>
              </div>
            </section>

            <!-- Easter Eggs Section -->
            <section v-if="zombieMap.easter_eggs && zombieMap.easter_eggs.length > 0" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6 md:p-8">
              <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ПАСХАЛКИ</span>
              </h2>
              <div class="space-y-4">
                <div
                  v-for="(egg, index) in zombieMap.easter_eggs"
                  :key="index"
                  class="border-l-4 border-red-500 pl-4 bg-black/20 p-4"
                >
                  <h3 v-if="egg.title" class="text-lg font-bold text-orange-500 mb-2 font-mono">
                    <span class="text-orange-600">&gt;</span> {{ egg.title }}
                  </h3>
                  <p class="text-sm text-gray-300">{{ egg.description }}</p>
                </div>
              </div>
            </section>

            <!-- Tips Section -->
            <section v-if="zombieMap.tips" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6 md:p-8">
              <h2 class="text-2xl md:text-3xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">СОВЕТЫ</span>
              </h2>
              <div class="prose prose-invert max-w-none">
                <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ zombieMap.tips }}</p>
              </div>
            </section>

          </div>

          <!-- Sidebar -->
          <aside class="space-y-6">

            <!-- Perks Section -->
            <div v-if="zombieMap.perks && zombieMap.perks.length > 0" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6">
              <h3 class="text-xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ПЕРКИ</span>
              </h3>
              <ul class="space-y-2 text-sm text-gray-300">
                <li v-for="(perk, index) in zombieMap.perks" :key="index" class="flex items-start">
                  <span class="text-red-500 mr-2">•</span>
                  <span>{{ perk }}</span>
                </li>
              </ul>
            </div>

            <!-- Characters Section -->
            <div v-if="zombieMap.characters && zombieMap.characters.length > 0" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6">
              <h3 class="text-xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ПЕРСОНАЖИ</span>
              </h3>
              <ul class="space-y-2 text-sm text-gray-300">
                <li v-for="(character, index) in zombieMap.characters" :key="index" class="flex items-start">
                  <span class="text-red-500 mr-2">•</span>
                  <span>{{ character }}</span>
                </li>
              </ul>
            </div>

            <!-- Features Section -->
            <div v-if="zombieMap.features && zombieMap.features.length > 0" class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm p-6">
              <h3 class="text-xl font-black font-mono text-red-500 mb-4 flex items-center">
                <span class="text-red-600">&gt;</span>
                <span class="ml-2">ОСОБЕННОСТИ</span>
              </h3>
              <ul class="space-y-2 text-sm text-gray-300">
                <li v-for="(feature, index) in zombieMap.features" :key="index" class="flex items-start">
                  <span class="text-red-500 mr-2">•</span>
                  <span>{{ feature }}</span>
                </li>
              </ul>
            </div>

          </aside>

        </div>

        <!-- Back Button -->
        <div class="mt-8">
          <Link
            :href="`/wiki/${zombieMap.game}`"
            class="inline-flex items-center border-2 border-red-500/30 hover:border-red-500 bg-black/40 hover:bg-red-500/10 px-6 py-3 transition-all group font-mono text-red-500"
          >
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
            </svg>
            <span class="text-red-600">&gt;</span>
            <span class="ml-1">ВЕРНУТЬСЯ К WIKI</span>
          </Link>
        </div>

      </div>
    </div>

    <!-- Lightbox -->
    <Teleport to="body">
      <Transition name="fade">
        <div
          v-if="lightboxOpen"
          @click="closeLightbox"
          class="fixed inset-0 z-[9999] bg-black/95 flex items-center justify-center p-4"
        >
          <!-- Close Button -->
          <button
            @click.stop="closeLightbox"
            class="absolute top-4 right-4 w-12 h-12 flex items-center justify-center border-2 border-red-500/50 hover:border-red-500 bg-black/50 hover:bg-red-500/10 transition-all text-red-500 font-mono text-xl z-10"
          >
            ×
          </button>

          <!-- Navigation Buttons -->
          <button
            v-if="currentImageIndex > 0"
            @click.stop="previousImage"
            class="absolute left-4 w-12 h-12 flex items-center justify-center border-2 border-red-500/50 hover:border-red-500 bg-black/50 hover:bg-red-500/10 transition-all text-red-500 z-10"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>

          <button
            v-if="currentImageIndex < zombieMap.images.length - 1"
            @click.stop="nextImage"
            class="absolute right-4 w-12 h-12 flex items-center justify-center border-2 border-red-500/50 hover:border-red-500 bg-black/50 hover:bg-red-500/10 transition-all text-red-500 z-10"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- Image -->
          <div @click.stop class="max-w-7xl w-full">
            <img
              :src="`/storage/${zombieMap.images[currentImageIndex]}`"
              :alt="`${zombieMap.name} - изображение ${currentImageIndex + 1}`"
              class="w-full h-auto max-h-[90vh] object-contain border-2 border-red-500/30"
            />
            <div class="text-center mt-4 font-mono text-red-500 text-sm">
              <span class="text-red-600">&gt;</span> {{ currentImageIndex + 1 }} / {{ zombieMap.images.length }}
            </div>
          </div>
        </div>
      </Transition>
    </Teleport>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-red-500/20 bg-black/80 backdrop-blur-sm py-6 mt-12">
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center font-mono text-xs text-gray-500">
          <span class="text-red-600">&gt;</span> ZOMBIE_MAP_DETAILS
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

defineProps({
  zombieMap: {
    type: Object,
    required: true
  }
});

// Lightbox state
const lightboxOpen = ref(false);
const currentImageIndex = ref(0);

const openLightbox = (index) => {
  currentImageIndex.value = index;
  lightboxOpen.value = true;
  document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
  lightboxOpen.value = false;
  document.body.style.overflow = '';
};

const nextImage = () => {
  if (currentImageIndex.value < zombieMap.images.length - 1) {
    currentImageIndex.value++;
  }
};

const previousImage = () => {
  if (currentImageIndex.value > 0) {
    currentImageIndex.value--;
  }
};

// Keyboard navigation
const handleKeydown = (e) => {
  if (!lightboxOpen.value) return;

  if (e.key === 'Escape') {
    closeLightbox();
  } else if (e.key === 'ArrowRight') {
    nextImage();
  } else if (e.key === 'ArrowLeft') {
    previousImage();
  }
};

onMounted(() => {
  window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
  document.body.style.overflow = '';
});
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 10px rgba(239, 68, 68, 0.5),
               0 0 20px rgba(239, 68, 68, 0.3),
               0 0 30px rgba(239, 68, 68, 0.2);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Fade transition for lightbox */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
