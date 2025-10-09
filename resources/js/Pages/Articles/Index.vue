<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Articles Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-7xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> ARTICLES_DATABASE INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING ARTICLES.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> FOUND {{ articles.total }} ARTICLES
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                СТАТЬИ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>СООБЩЕСТВА</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Filters -->
          <div class="mb-8 border border-orange-500/30 bg-orange-500/5 p-6 relative">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
            <div class="font-mono text-xs text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> FILTER_BY_GAME:
            </div>
            <div class="flex flex-wrap gap-3">
              <Link
                href="/articles"
                :class="[
                  'px-4 py-2 font-mono text-sm border transition-all',
                  !filters.game
                    ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                    : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5'
                ]"
              >
                ВСЕ
              </Link>
              <Link
                v-for="game in games"
                :key="game"
                :href="`/articles?game=${encodeURIComponent(game)}`"
                :class="[
                  'px-4 py-2 font-mono text-sm border transition-all',
                  filters.game === game
                    ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                    : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5'
                ]"
              >
                {{ game }}
              </Link>
            </div>
          </div>

          <!-- Articles Grid -->
          <div v-if="articles.data.length === 0" class="border border-orange-500/30 bg-orange-500/5 p-12 text-center">
            <div class="text-orange-600 font-mono text-lg mb-2">
              <span class="text-orange-600">&gt;</span> NO_ARTICLES_FOUND
            </div>
            <p class="text-gray-400">Статьи не найдены</p>
          </div>

          <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <Link
              v-for="article in articles.data"
              :key="article.id"
              :href="`/articles/${article.slug}`"
              class="border border-orange-500/30 bg-black/50 overflow-hidden hover:bg-orange-500/5 transition-all group relative"
            >
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

              <!-- Image -->
              <div class="w-full h-48 border-b border-orange-500/30 flex items-center justify-center overflow-hidden bg-zinc-900">
                <img
                  v-if="article.image"
                  :src="`/storage/${article.image}`"
                  :alt="article.title"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <svg v-else class="w-16 h-16 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>

              <!-- Content -->
              <div class="p-6">
                <div class="flex items-center gap-2 mb-3">
                  <span class="text-xs font-mono px-2 py-1 border border-blue-500/30 bg-blue-500/10 text-blue-400">
                    {{ article.game }}
                  </span>
                  <span class="text-xs font-mono text-gray-500">
                    👁 {{ article.views_count || 0 }}
                  </span>
                </div>

                <h3 class="text-xl font-black text-orange-500 font-mono mb-2 line-clamp-2 group-hover:text-orange-400 transition-colors">
                  {{ article.title }}
                </h3>

                <p v-if="article.excerpt" class="text-gray-400 text-sm mb-4 line-clamp-3">
                  {{ article.excerpt }}
                </p>

                <div class="flex items-center justify-between text-xs font-mono text-gray-500">
                  <span>{{ article.user?.username || 'Автор' }}</span>
                  <span>{{ formatDate(article.published_at) }}</span>
                </div>
              </div>
            </Link>
          </div>

          <!-- Pagination -->
          <div v-if="articles.last_page > 1" class="flex justify-center gap-2">
            <Link
              v-for="page in articles.links"
              :key="page.label"
              :href="page.url"
              :class="[
                'px-4 py-2 font-mono text-sm border transition-all',
                page.active
                  ? 'border-orange-500 bg-orange-500/10 text-orange-500'
                  : 'border-orange-500/30 text-gray-400 hover:bg-orange-500/5',
                !page.url && 'opacity-50 cursor-not-allowed'
              ]"
              v-html="page.label"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
  articles: Object,
  filters: Object,
});

const games = [
  'World at War',
  'Black Ops',
  'Black Ops 2',
  'Black Ops 3',
  'Black Ops 4',
  'Cold War',
  'Black Ops 6',
  'Black Ops 7'
];

function formatDate(date) {
  if (!date) return '';
  return new Date(date).toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
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

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

