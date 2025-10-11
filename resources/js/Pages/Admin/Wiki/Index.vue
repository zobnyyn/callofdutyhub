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
              <span class="text-orange-600">&gt;</span> LOADING WIKI_MANAGER.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                УПРАВЛЕНИЕ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>WIKI-КОНТЕНТОМ</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Wiki Management Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Wiki Pages Card -->
            <Link href="/admin/wiki/pages" class="group relative border border-orange-500/30 bg-orange-500/5 hover:bg-orange-500/10 transition-all overflow-hidden">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="p-8">
                <div class="mb-4">
                  <svg class="w-16 h-16 text-orange-500 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase font-mono mb-2">
                  СТРАНИЦЫ ИГР
                </h3>
                <p class="text-orange-500/70 font-mono text-sm mb-4">
                  Редактирование Wiki-страниц игр, выбор контента
                </p>
                <div class="flex items-center gap-2 text-orange-500 font-mono text-sm font-bold">
                  <span>&gt;</span>
                  <span>ПЕРЕЙТИ К УПРАВЛЕНИЮ</span>
                  <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </Link>

            <!-- Weapons Card -->
            <Link href="/admin/wiki/weapons" class="group relative border border-orange-500/30 bg-orange-500/5 hover:bg-orange-500/10 transition-all overflow-hidden">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="p-8">
                <div class="mb-4">
                  <svg class="w-16 h-16 text-orange-500 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase font-mono mb-2">
                  ОРУЖИЕ
                </h3>
                <p class="text-orange-500/70 font-mono text-sm mb-4">
                  Управление описаниями оружия для всех игр серии Call of Duty
                </p>
                <div class="flex items-center gap-2 text-orange-500 font-mono text-sm font-bold">
                  <span>&gt;</span>
                  <span>ПЕРЕЙТИ К УПРАВЛЕНИЮ</span>
                  <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </Link>

            <!-- Maps Card -->
            <Link href="/admin/wiki/maps" class="group relative border border-orange-500/30 bg-orange-500/5 hover:bg-orange-500/10 transition-all overflow-hidden">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="p-8">
                <div class="mb-4">
                  <svg class="w-16 h-16 text-orange-500 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase font-mono mb-2">
                  КАРТЫ
                </h3>
                <p class="text-orange-500/70 font-mono text-sm mb-4">
                  Управление описаниями мультиплеерных карт для всех игр
                </p>
                <div class="flex items-center gap-2 text-orange-500 font-mono text-sm font-bold">
                  <span>&gt;</span>
                  <span>ПЕРЕЙТИ К УПРАВЛЕНИЮ</span>
                  <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </Link>

            <!-- Zombie Maps Card -->
            <Link href="/admin/wiki/zombie-maps" class="group relative border border-orange-500/30 bg-orange-500/5 hover:bg-orange-500/10 transition-all overflow-hidden">
              <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
              <div class="p-8">
                <div class="mb-4">
                  <svg class="w-16 h-16 text-orange-500 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase font-mono mb-2">
                  ЗОМБИ-КАРТЫ
                </h3>
                <p class="text-orange-500/70 font-mono text-sm mb-4">
                  Управление описаниями зомби-карт, пасхалками и механиками
                </p>
                <div class="flex items-center gap-2 text-orange-500 font-mono text-sm font-bold">
                  <span>&gt;</span>
                  <span>ПЕРЕЙТИ К УПРАВЛЕНИЮ</span>
                  <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </Link>
          </div>

          <!-- Statistics -->
          <div class="mt-10 border border-orange-500/30 bg-orange-500/5 p-6">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
            <div class="font-mono text-xs text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> СТАТИСТИКА:
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 font-mono mb-2">{{ stats.pages || 0 }}</div>
                <div class="text-orange-500/70 font-mono text-sm uppercase">Wiki-страниц</div>
              </div>
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 font-mono mb-2">{{ stats.weapons || 0 }}</div>
                <div class="text-orange-500/70 font-mono text-sm uppercase">Единиц оружия</div>
              </div>
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 font-mono mb-2">{{ stats.maps || 0 }}</div>
                <div class="text-orange-500/70 font-mono text-sm uppercase">Карт</div>
              </div>
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 font-mono mb-2">{{ stats.zombieMaps || 0 }}</div>
                <div class="text-orange-500/70 font-mono text-sm uppercase">Зомби-карт</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

defineProps({
  stats: {
    type: Object,
    default: () => ({
      weapons: 0,
      maps: 0,
      zombieMaps: 0
    })
  }
});
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
</style>
