<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Article Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-4xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> ARTICLE_VIEWER INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING ARTICLE_ID: {{ article.id }}
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> GAME: {{ article.game }}
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Back Button -->
          <Link
            href="/articles"
            class="text-orange-500 hover:text-orange-400 font-mono text-sm mb-6 inline-flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-orange-600">&gt;</span> BACK_TO_ARTICLES
          </Link>

          <!-- Article Content -->
          <article class="border border-orange-500/30 bg-black/50 relative">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

            <!-- Featured Image -->
            <div v-if="article.image" class="w-full h-96 border-b border-orange-500/30 overflow-hidden bg-zinc-900">
              <img
                :src="`/storage/${article.image}`"
                :alt="article.title"
                class="w-full h-full object-cover"
              />
            </div>

            <!-- Article Header -->
            <div class="p-8 border-b border-orange-500/30">
              <div class="flex items-center gap-3 mb-4 flex-wrap">
                <span class="text-xs font-mono px-3 py-1 border border-blue-500/30 bg-blue-500/10 text-blue-400">
                  {{ article.game }}
                </span>
                <span
                  v-if="article.category"
                  :class="[
                    'text-xs font-mono px-3 py-1 border',
                    getCategoryColor(article.category)
                  ]"
                >
                  {{ article.category }}
                </span>
                <span class="text-xs font-mono text-gray-500">
                  👁 {{ article.views_count || 0 }} просмотров
                </span>
                <span class="text-xs font-mono text-gray-500">
                  📅 {{ formatDate(article.published_at) }}
                </span>
              </div>

              <h1 class="text-4xl md:text-5xl font-black mb-4 leading-tight uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  {{ article.title }}
                </span>
              </h1>

              <div v-if="article.excerpt" class="text-xl text-gray-400 mb-6">
                {{ article.excerpt }}
              </div>

              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-orange-500/20 border border-orange-500/30 flex items-center justify-center overflow-hidden">
                  <img
                    v-if="article.user?.avatar"
                    :src="`/storage/${article.user.avatar}`"
                    :alt="article.user.name"
                    class="w-full h-full object-cover"
                  />
                  <span v-else class="font-mono text-orange-500 font-black">
                    {{ article.user?.name?.charAt(0).toUpperCase() || 'A' }}
                  </span>
                </div>
                <div>
                  <div class="text-sm font-mono text-orange-500">
                    {{ article.user?.name || 'Автор' }}
                  </div>
                  <div class="text-xs font-mono text-gray-500">
                    Опубликовано {{ formatFullDate(article.published_at) }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Article Content -->
            <div class="p-8">
              <div class="prose prose-invert prose-orange max-w-none">
                <div class="text-gray-300 leading-relaxed article-content" v-html="article.content"></div>
              </div>
            </div>
          </article>

          <!-- Admin Actions -->
          <div v-if="$page.props.auth.user?.role === 'admin'" class="mt-6 flex gap-4">
            <Link
              :href="`/admin/articles/${article.id}/edit`"
              class="px-6 py-3 border border-orange-500/30 hover:bg-orange-500/10 text-orange-500 font-mono text-sm transition-all"
            >
              <span class="text-orange-600">&gt;</span> РЕДАКТИРОВАТЬ
            </Link>
          </div>

          <!-- Related Articles -->
          <div v-if="relatedArticles && relatedArticles.length > 0" class="mt-16">
            <div class="mb-6 font-mono text-sm">
              <div class="text-orange-500 mb-2">
                <span class="text-orange-600">&gt;</span> RELATED_ARTICLES
              </div>
              <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <Link
                v-for="related in relatedArticles"
                :key="related.id"
                :href="`/articles/${related.slug}`"
                class="border border-orange-500/30 bg-black/50 overflow-hidden hover:bg-orange-500/5 transition-all group"
              >
                <div class="w-full h-32 border-b border-orange-500/30 flex items-center justify-center overflow-hidden bg-zinc-900">
                  <img
                    v-if="related.image"
                    :src="`/storage/${related.image}`"
                    :alt="related.title"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  />
                </div>
                <div class="p-4">
                  <h3 class="text-sm font-bold text-orange-500 font-mono mb-2 line-clamp-2 group-hover:text-orange-400">
                    {{ related.title }}
                  </h3>
                  <div class="text-xs font-mono text-gray-500">
                    {{ related.game }}
                  </div>
                </div>
              </Link>
            </div>
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
  article: Object,
  relatedArticles: Array,
});

function formatDate(date) {
  if (!date) return '';
  return new Date(date).toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
}

function formatFullDate(date) {
  if (!date) return '';
  return new Date(date).toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
}

function getCategoryColor(category) {
  const colors = {
    'Новости': 'border-red-500/30 bg-red-500/10 text-red-400',
    'Обзоры': 'border-green-500/30 bg-green-500/10 text-green-400',
    'Гайды': 'border-purple-500/30 bg-purple-500/10 text-purple-400',
  };

  return colors[category] || 'border-gray-500/30 bg-gray-500/10 text-gray-400';
}
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

.article-content {
  font-size: 1.125rem;
  line-height: 1.8;
}

/* Стили для HTML-контента статьи */
.article-content :deep(p) {
  margin-bottom: 1rem;
}

.article-content :deep(br) {
  display: block;
  content: "";
  margin-top: 0.5rem;
}

.article-content :deep(h1),
.article-content :deep(h2),
.article-content :deep(h3),
.article-content :deep(h4),
.article-content :deep(h5),
.article-content :deep(h6) {
  font-weight: bold;
  margin-top: 1.5rem;
  margin-bottom: 1rem;
  color: #f97316;
}

.article-content :deep(h1) { font-size: 2rem; }
.article-content :deep(h2) { font-size: 1.75rem; }
.article-content :deep(h3) { font-size: 1.5rem; }

.article-content :deep(ul),
.article-content :deep(ol) {
  margin-left: 1.5rem;
  margin-bottom: 1rem;
}

.article-content :deep(li) {
  margin-bottom: 0.5rem;
}

.article-content :deep(strong) {
  font-weight: bold;
  color: #fb923c;
}

.article-content :deep(em) {
  font-style: italic;
}

.article-content :deep(a) {
  color: #f97316;
  text-decoration: underline;
}

.article-content :deep(a:hover) {
  color: #fb923c;
}

.article-content :deep(blockquote) {
  border-left: 4px solid #f97316;
  padding-left: 1rem;
  margin: 1rem 0;
  font-style: italic;
  color: #d1d5db;
}

.article-content :deep(code) {
  background-color: #1f2937;
  padding: 0.2rem 0.4rem;
  border-radius: 0.25rem;
  font-family: monospace;
  font-size: 0.9em;
}

.article-content :deep(pre) {
  background-color: #1f2937;
  padding: 1rem;
  border-radius: 0.5rem;
  overflow-x: auto;
  margin: 1rem 0;
}

.article-content :deep(pre code) {
  background-color: transparent;
  padding: 0;
}

.article-content :deep(img) {
  max-width: 100%;
  height: auto;
  border-radius: 0.5rem;
  margin: 1rem 0;
}

.article-content :deep(hr) {
  border: none;
  border-top: 1px solid #374151;
  margin: 2rem 0;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
