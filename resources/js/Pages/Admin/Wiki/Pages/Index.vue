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
        <div class="max-w-7xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> ADMIN_PANEL INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING WIKI_PAGE_MANAGER.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title & Actions -->
          <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
              <Link href="/admin/wiki" class="text-orange-500 hover:text-orange-400 font-mono text-sm mb-4 inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>&lt;</span> НАЗАД К WIKI
              </Link>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  WIKI-СТРАНИЦЫ
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>ИГР</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>

            <Link
              href="/admin/wiki/pages/create"
              class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono tracking-wider transition-all flex items-center gap-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> CREATE_PAGE
            </Link>
          </div>

          <!-- Success Message -->
          <div v-if="$page.props.flash.success" class="mb-6 border border-green-500/30 bg-green-900/20 p-4 font-mono">
            <div class="text-green-500 text-sm">
              <span class="text-green-600">&gt;</span> {{ $page.props.flash.success }}
            </div>
          </div>

          <!-- Pages Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
              v-for="page in pages"
              :key="page.id"
              class="border border-orange-500/30 bg-orange-500/5 hover:bg-orange-500/10 transition-all overflow-hidden group"
            >
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>

              <!-- Thumbnail -->
              <div class="relative h-48 bg-black overflow-hidden">
                <img
                  v-if="page.thumbnail"
                  :src="`/storage/${page.thumbnail}`"
                  :alt="page.title"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div v-else class="w-full h-full bg-orange-500/10 border-b border-orange-500/30 flex items-center justify-center">
                  <svg class="w-16 h-16 text-orange-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                  </svg>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                  <span
                    :class="page.is_published ? 'bg-green-500/90 text-black' : 'bg-red-500/90 text-white'"
                    class="px-3 py-1 text-xs font-bold font-mono"
                  >
                    {{ page.is_published ? 'PUBLISHED' : 'DRAFT' }}
                  </span>
                </div>
              </div>

              <div class="p-6">
                <h3 class="text-xl font-black text-white uppercase font-mono mb-2">
                  {{ page.title }}
                </h3>
                <div class="text-orange-500 font-mono text-sm mb-3 uppercase">
                  <span class="text-orange-600">&gt;</span> {{ page.game }}
                </div>
                <p v-if="page.short_description" class="text-orange-500/70 text-sm mb-4 line-clamp-2">
                  {{ page.short_description }}
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                  <div class="bg-black/50 border border-orange-500/20 p-2">
                    <div class="text-orange-500 font-mono text-lg font-bold">
                      {{ page.content?.weapons?.length || 0 }}
                    </div>
                    <div class="text-orange-500/50 text-xs font-mono">ОРУЖИЕ</div>
                  </div>
                  <div class="bg-black/50 border border-orange-500/20 p-2">
                    <div class="text-orange-500 font-mono text-lg font-bold">
                      {{ page.content?.maps?.length || 0 }}
                    </div>
                    <div class="text-orange-500/50 text-xs font-mono">КАРТЫ</div>
                  </div>
                  <div class="bg-black/50 border border-orange-500/20 p-2">
                    <div class="text-orange-500 font-mono text-lg font-bold">
                      {{ page.content?.zombie_maps?.length || 0 }}
                    </div>
                    <div class="text-orange-500/50 text-xs font-mono">ЗОМБИ</div>
                  </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                  <Link
                    :href="`/admin/wiki/pages/${page.id}/edit`"
                    class="flex-1 px-4 py-2 bg-orange-600/20 hover:bg-orange-600/40 border border-orange-500/30 text-orange-500 text-sm font-bold font-mono text-center transition-colors"
                  >
                    EDIT
                  </Link>
                  <button
                    @click="deletePage(page.id)"
                    class="px-4 py-2 bg-red-600/20 hover:bg-red-600/40 border border-red-500/30 text-red-500 text-sm font-bold font-mono transition-colors"
                  >
                    DEL
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="pages.length === 0" class="text-center py-20">
            <svg class="w-24 h-24 mx-auto text-orange-500/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <p class="text-orange-500/50 font-mono text-lg">
              <span class="text-orange-600">&gt;</span> Нет созданных Wiki-страниц
            </p>
            <p class="text-orange-500/30 font-mono text-sm mt-2">
              Создайте первую страницу для игры
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

defineProps({
  pages: Array
});

const deletePage = (id) => {
  if (confirm('Вы уверены, что хотите удалить эту Wiki-страницу?')) {
    router.delete(`/admin/wiki/pages/${id}`, {
      preserveScroll: true
    });
  }
};
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

.cursor-blink {
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 49% {
    opacity: 1;
  }
  50%, 100% {
    opacity: 0;
  }
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

