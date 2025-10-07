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
              <span class="text-orange-600">&gt;</span> LOADING GUIDE_MANAGER.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS GRANTED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title & Actions -->
          <div class="mb-10 flex justify-between items-center">
            <div>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  УПРАВЛЕНИЕ
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>ГАЙДАМИ</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>

            <Link
              href="/admin/guides/create"
              class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono tracking-wider transition-all flex items-center gap-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> CREATE_GUIDE
            </Link>
          </div>

          <!-- Success Message -->
          <div v-if="$page.props.flash.success" class="mb-6 border border-green-500/30 bg-green-900/20 p-4 font-mono">
            <div class="text-green-500 text-sm">
              <span class="text-green-600">&gt;</span> {{ $page.props.flash.success }}
            </div>
          </div>

          <!-- Guides Table -->
          <div class="border border-orange-500/30 bg-orange-500/5">
            <!-- Table Header -->
            <div class="p-4 border-b border-orange-500/30 bg-orange-500/10">
              <div class="text-orange-600 font-mono text-sm">
                <span class="text-orange-600">&gt;</span> ВСЕГО ГАЙДОВ: {{ guides.total }}
              </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
              <table class="w-full font-mono text-sm">
                <thead class="bg-black/50">
                  <tr class="border-b border-orange-500/20">
                    <th class="px-4 py-3 text-left text-orange-500">ID</th>
                    <th class="px-4 py-3 text-left text-orange-500">GAME</th>
                    <th class="px-4 py-3 text-left text-orange-500">MAP</th>
                    <th class="px-4 py-3 text-left text-orange-500">TITLE</th>
                    <th class="px-4 py-3 text-left text-orange-500">STATUS</th>
                    <th class="px-4 py-3 text-left text-orange-500">VIEWS</th>
                    <th class="px-4 py-3 text-left text-orange-500">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="guides.data.length === 0">
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                      <span class="text-orange-600">&gt;</span> Гайдов пока нет. Создайте первый!
                    </td>
                  </tr>
                  <tr
                    v-for="guide in guides.data"
                    :key="guide.id"
                    class="border-b border-orange-500/10 hover:bg-orange-500/5 transition-colors"
                  >
                    <td class="px-4 py-3 text-gray-400">#{{ guide.id }}</td>
                    <td class="px-4 py-3 text-white">{{ guide.game }}</td>
                    <td class="px-4 py-3 text-white">{{ guide.map_name }}</td>
                    <td class="px-4 py-3 text-white">{{ guide.title }}</td>
                    <td class="px-4 py-3">
                      <span
                        :class="guide.is_published ? 'text-green-500 bg-green-500/20' : 'text-gray-500 bg-gray-500/20'"
                        class="px-2 py-1 text-xs rounded"
                      >
                        {{ guide.is_published ? 'PUBLISHED' : 'DRAFT' }}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-orange-500">{{ guide.views }}</td>
                    <td class="px-4 py-3">
                      <div class="flex items-center gap-2">
                        <Link
                          :href="`/admin/guides/${guide.id}/edit`"
                          class="px-3 py-1 bg-orange-600/20 border border-orange-500/30 text-orange-500 text-xs hover:bg-orange-500/20 transition-colors"
                        >
                          EDIT
                        </Link>
                        <button
                          @click="deleteGuide(guide.id)"
                          class="px-3 py-1 bg-red-600/20 border border-red-500/30 text-red-500 text-xs hover:bg-red-500/20 transition-colors"
                        >
                          DELETE
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div v-if="guides.last_page > 1" class="p-4 border-t border-orange-500/30 flex justify-between items-center">
              <div class="text-gray-400 text-xs">
                Показано {{ guides.from }}-{{ guides.to }} из {{ guides.total }}
              </div>
              <div class="flex gap-2">
                <Link
                  v-for="page in guides.links"
                  :key="page.label"
                  :href="page.url"
                  :class="[
                    'px-3 py-1 text-xs font-mono',
                    page.active
                      ? 'bg-orange-500 text-black'
                      : page.url
                      ? 'bg-orange-500/20 text-orange-500 hover:bg-orange-500/30'
                      : 'text-gray-600 cursor-not-allowed'
                  ]"
                  v-html="page.label"
                ></Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Header from '../../../Components/Header.vue';

defineProps({
  guides: {
    type: Object,
    required: true
  }
});

function deleteGuide(id) {
  if (confirm('Вы уверены, что хотите удалить этот гайд?')) {
    router.delete(`/admin/guides/${id}`);
  }
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
