<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Guide Content -->
    <article class="pt-32 pb-12 px-6 relative">
      <div class="container mx-auto max-w-4xl relative z-10">

        <!-- Terminal Header -->
        <div class="mb-8 font-mono text-sm">
          <div class="text-orange-500 mb-2">
            <span class="text-orange-600">&gt;</span> LOADING_GUIDE...
          </div>
          <div class="text-orange-500/70 mb-2">
            <span class="text-orange-600">&gt;</span> {{ guide.game }} / {{ guide.map_name }}
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
        </div>

        <!-- Back Button -->
        <div class="mb-8">
          <button
            @click="$inertia.visit(`/zombies/${guide.game}/${guide.map_slug}/guides`)"
            class="px-6 py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-orange-600">&gt;</span> BACK_TO_GUIDES
          </button>
        </div>

        <!-- Guide Image -->
        <div v-if="guide.image" class="mb-8 border-2 border-orange-500/30 overflow-hidden">
          <img
            :src="`/storage/${guide.image}`"
            :alt="guide.title"
            class="w-full aspect-video object-cover"
          />
        </div>

        <!-- Guide Header -->
        <header class="mb-12">
          <h1 class="text-4xl md:text-6xl font-black mb-6 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
              {{ guide.title }}
            </span>
          </h1>

          <!-- Meta Information -->
          <div class="flex flex-wrap items-center gap-6 text-sm font-mono">
            <!-- Author -->
            <div class="flex items-center gap-2">
              <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center text-orange-500 font-bold">
                {{ guide.user?.name?.charAt(0)?.toUpperCase() || '?' }}
              </div>
              <div>
                <div class="text-orange-500/70 text-xs">AUTHOR</div>
                <div class="text-white">{{ guide.user?.name || 'Unknown' }}</div>
              </div>
            </div>

            <!-- Views -->
            <div class="flex items-center gap-2 text-orange-500/70">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
              <span>{{ guide.views }} views</span>
            </div>

            <!-- Date -->
            <div class="text-orange-500/70">
              <span class="text-orange-600">&gt;</span> {{ formatDate(guide.created_at) }}
            </div>
          </div>

          <!-- Description -->
          <div v-if="guide.description" class="mt-6 p-4 border-l-4 border-orange-500/50 bg-orange-500/5">
            <p class="text-gray-300 text-lg">{{ guide.description }}</p>
          </div>
        </header>

        <!-- Guide Content -->
        <div class="prose prose-invert prose-orange max-w-none">
          <div class="guide-content text-gray-300 leading-relaxed" v-html="guide.content"></div>
        </div>

        <!-- Footer -->
        <footer class="mt-12 pt-8 border-t border-orange-500/20">
          <div class="font-mono text-orange-500/70 text-sm">
            <span class="text-orange-600">&gt;</span> END_OF_GUIDE
          </div>
        </footer>
      </div>
    </article>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import Header from '../../Components/Header.vue';

const props = defineProps({
  guide: Object
});

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
};
</script>

<style scoped>
/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

/* Guide Content Styles */
:deep(.guide-content) {
  font-size: 1.125rem;
  line-height: 1.75;
}

:deep(.guide-content h2) {
  font-size: 2rem;
  font-weight: 900;
  color: #f97316;
  margin-top: 2rem;
  margin-bottom: 1rem;
  text-transform: uppercase;
  font-family: monospace;
}

:deep(.guide-content h3) {
  font-size: 1.5rem;
  font-weight: 700;
  color: #fb923c;
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
  font-family: monospace;
}

:deep(.guide-content p) {
  margin-bottom: 1rem;
}

:deep(.guide-content ul),
:deep(.guide-content ol) {
  margin-left: 1.5rem;
  margin-bottom: 1rem;
}

:deep(.guide-content li) {
  margin-bottom: 0.5rem;
}

:deep(.guide-content a) {
  color: #f97316;
  text-decoration: underline;
}

:deep(.guide-content a:hover) {
  color: #fb923c;
}

:deep(.guide-content code) {
  background-color: rgba(249, 115, 22, 0.1);
  padding: 0.25rem 0.5rem;
  border-radius: 0.25rem;
  font-family: monospace;
  color: #fb923c;
}

:deep(.guide-content pre) {
  background-color: rgba(249, 115, 22, 0.05);
  border: 1px solid rgba(249, 115, 22, 0.3);
  padding: 1rem;
  border-radius: 0.25rem;
  overflow-x: auto;
  margin-bottom: 1rem;
}

:deep(.guide-content img) {
  max-width: 100%;
  height: auto;
  border: 2px solid rgba(249, 115, 22, 0.3);
  margin: 1.5rem 0;
}

:deep(.guide-content blockquote) {
  border-left: 4px solid #f97316;
  padding-left: 1rem;
  margin-left: 0;
  margin-bottom: 1rem;
  color: #d1d5db;
  font-style: italic;
  background-color: rgba(249, 115, 22, 0.05);
  padding: 1rem;
}
</style>

