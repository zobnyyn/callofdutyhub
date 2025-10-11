<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <div class="fixed inset-0 z-0">
      <div class="w-full h-full bg-cover bg-center opacity-40" style="background-image: url('/images/blackopscoldwarbackground.jpg')"></div>
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
    </div>
    <Header />
    <div class="relative z-10 pt-20 md:pt-28 pb-12">
      <div class="container mx-auto px-4 md:px-6 max-w-7xl">
        <div class="mb-6 font-mono text-xs md:text-sm">
          <div class="flex items-center gap-2 text-red-500/70">
            <button @click="$inertia.visit('/cod-wiki')" class="hover:text-red-500 transition-colors">
              <span class="text-red-600">&gt;</span> COD_WIKI
            </button>
            <span class="text-red-600">/</span>
            <span class="text-red-500">COLD_WAR</span>
          </div>
        </div>
        <div class="mb-8 md:mb-12">
          <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-3 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-red-600 to-red-700 terminal-glow">CALL OF DUTY:</span>
            <span class="flex items-center text-white mt-2"><span>BLACK OPS COLD WAR</span></span>
          </h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
          <main class="lg:col-span-12">
            <div class="border-2 border-red-500/20 bg-black/60 backdrop-blur-sm">
              <section class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl font-black font-mono text-red-500 mb-4"><span class="text-red-600">&gt;</span> ЗОМБИ</h2>
                <div v-if="props.zombieMaps && props.zombieMaps.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <Link v-for="zombieMap in props.zombieMaps" :key="zombieMap.id" :href="`/wiki/zombie-maps/${zombieMap.slug}`"
                    class="group border-2 border-red-500/30 hover:border-red-500 bg-black/40 p-5 cursor-pointer transition-all">
                    <div v-if="zombieMap.thumbnail" class="mb-3 overflow-hidden rounded">
                      <img :src="`/storage/${zombieMap.thumbnail}`" :alt="zombieMap.name" class="w-full h-32 object-cover" />
                    </div>
                    <h3 class="text-xl font-black text-white mb-2">{{ zombieMap.name }}</h3>
                    <p class="text-sm text-gray-400">{{ zombieMap.description }}</p>
                  </Link>
                </div>
              </section>
              <section class="p-6 md:p-8 border-b-2 border-red-500/10">
                <h2 class="text-2xl font-black font-mono text-red-500 mb-4"><span class="text-red-600">&gt;</span> ОРУЖИЕ</h2>
                <div v-if="props.weapons && props.weapons.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                  <div v-for="weapon in props.weapons" :key="weapon.id" class="border border-red-500/30 p-3 bg-black/20">
                    <div class="font-mono text-sm text-red-500">{{ weapon.name }}</div>
                  </div>
                </div>
              </section>
              <section class="p-6 md:p-8">
                <h2 class="text-2xl font-black font-mono text-red-500 mb-4"><span class="text-red-600">&gt;</span> КАРТЫ</h2>
                <div v-if="props.maps && props.maps.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-3">
                  <div v-for="map in props.maps" :key="map.id" class="border border-red-500/30 p-3 bg-black/20">
                    <div class="font-mono text-sm text-gray-300 text-center">{{ map.name }}</div>
                  </div>
                </div>
              </section>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
const props = defineProps({ page: Object, weapons: Array, maps: Array, zombieMaps: Array });
</script>
