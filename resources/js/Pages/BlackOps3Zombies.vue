<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img
        :src="backgroundImage"
        alt="Black Ops 3 Background"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-32 pb-12 px-6 relative">
      <!-- Background with blur effect -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-orange-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <!-- Terminal Header -->
        <div class="mb-8 font-mono text-sm">
          <div class="text-orange-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> LOADING BLACK_OPS_3_ZOMBIES.exe
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> ACCESSING MAP DATABASE...
          </div>
          <div class="text-orange-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SELECT YOUR MAP
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
        </div>

        <!-- Main Title -->
        <div class="mb-8">
          <h1 class="text-5xl md:text-7xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              BLACK OPS III
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>ZOMBIES</span>
              <span class="inline-block w-4 h-12 md:h-16 bg-orange-500 ml-4 cursor-blink"></span>
            </span>
          </h1>

          <div class="text-orange-600 font-mono text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> YEAR: 2015
          </div>
          <p class="text-lg text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Выберите карту из Call of Duty: Black Ops 3 - новая глава истории с Zombie Chronicles.
          </p>
        </div>

        <!-- Back Button -->
        <div class="mb-8">
          <button
            @click="$inertia.visit('/zombies')"
            class="px-6 py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-orange-600">&gt;</span> BACK_TO_GAMES
          </button>
        </div>
      </div>
    </section>

    <!-- Maps Grid Section -->
    <section class="py-12 px-6 relative">
      <div class="container mx-auto relative z-10">
        <!-- Original Maps Section Header -->
        <div class="mb-8 font-mono">
          <div class="text-orange-500 text-sm mb-2">
            <span class="text-orange-600">&gt;</span> ORIGINAL_MAPS: 6
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 to-transparent max-w-md mb-8"></div>
        </div>

        <!-- Original Maps Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mb-16">

          <!-- Shadows of Evil -->
          <div
            @click="navigateToGuides('shadows-of-evil')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="shadowsofevil"
                alt="Shadows of Evil"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_01
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  SHADOWS OF<br/>EVIL
                </h3>
                <p class="text-xs text-gray-400 font-mono">Morg City</p>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- The Giant -->
          <div
            @click="navigateToGuides('the-giant')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="thegiant"
                alt="The Giant"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_02
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  THE GIANT
                </h3>
                <p class="text-xs text-gray-400 font-mono">Der Riese Remake</p>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Der Eisendrache -->
          <div
            @click="navigateToGuides('der-eisendrache')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="derraisendragh"
                alt="Der Eisendrache"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_03
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  DER<br/>EISENDRACHE
                </h3>
                <p class="text-xs text-gray-400 font-mono">Awakening DLC</p>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Zetsubou No Shima -->
          <div
            @click="navigateToGuides('zetsubou-no-shima')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="zetsubou"
                alt="Zetsubou No Shima"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_04
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  ZETSUBOU<br/>NO SHIMA
                </h3>
                <p class="text-xs text-gray-400 font-mono">Eclipse DLC</p>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Gorod Krovi -->
          <div
            @click="navigateToGuides('gorod-krovi')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="gorodkrovi"
                alt="Gorod Krovi"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_05
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  GOROD KROVI
                </h3>
                <p class="text-xs text-gray-400 font-mono">Descent DLC</p>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Revelations -->
          <div
            @click="navigateToGuides('revelations')"
            class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="revelations"
                alt="Revelations"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> MAP_06
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  REVELATIONS
                </h3>
                <p class="text-xs text-gray-400 font-mono">Salvation DLC</p>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

        </div>

        <!-- Zombie Chronicles Section Header -->
        <div class="mb-8 font-mono mt-16">
          <div class="text-purple-500 text-sm mb-2">
            <span class="text-purple-600">&gt;</span> ZOMBIE_CHRONICLES: 8
          </div>
          <div class="text-xs text-purple-400/70 mb-3">Remastered Classic Maps</div>
          <div class="h-px bg-gradient-to-r from-purple-500 to-transparent max-w-md mb-8"></div>
        </div>

        <!-- Zombie Chronicles Maps Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl">

          <!-- Nacht Der Untoten (ZC) -->
          <div
            @click="navigateToGuides('bo3-nacht-der-untoten')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="nachtderuntoten"
                alt="Nacht Der Untoten"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_01
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  NACHT DER<br/>UNTOTEN
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Verruckt (ZC) -->
          <div
            @click="navigateToGuides('bo3-verruckt')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="verruckt"
                alt="Verruckt"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_02
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  VERRÜCKT
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Shi No Numa (ZC) -->
          <div
            @click="navigateToGuides('bo3-shi-no-numa')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="shinonuma"
                alt="Shi No Numa"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_03
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  SHI NO NUMA
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Kino Der Toten (ZC) -->
          <div
            @click="navigateToGuides('bo3-kino-der-toten')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="kinodertoten"
                alt="Kino Der Toten"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_04
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  KINO DER<br/>TOTEN
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Ascension (ZC) -->
          <div
            @click="navigateToGuides('bo3-ascension')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="ascension"
                alt="Ascension"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_05
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  ASCENSION
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Shangri-La (ZC) -->
          <div
            @click="navigateToGuides('bo3-shangri-la')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="shangrila"
                alt="Shangri-La"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_06
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  SHANGRI-LA
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Moon (ZC) -->
          <div
            @click="navigateToGuides('bo3-moon')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="moon"
                alt="Moon"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_07
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  MOON
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Origins (ZC) -->
          <div
            @click="navigateToGuides('bo3-origins')"
            class="group relative border-2 border-purple-500/30 hover:border-purple-500 transition-all duration-300 cursor-pointer h-80"
          >
            <div class="absolute inset-0 overflow-hidden">
              <img
                :src="originsZC"
                alt="Origins"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- ZC Badge -->
            <div class="absolute top-4 right-4 bg-purple-500 text-black px-2 py-1 font-mono text-xs font-black z-20">
              ZC
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10 pointer-events-none">
              <div>
                <div class="font-mono text-xs text-purple-500 mb-2">
                  <span class="text-purple-600">&gt;</span> CHRONICLES_08
                </div>
                <h3 class="text-2xl font-black text-white mb-2 uppercase font-mono leading-tight">
                  ORIGINS
                </h3>
                <p class="text-xs text-gray-400 font-mono">Zombie Chronicles</p>
              </div>

              <div class="flex items-center space-x-2 text-purple-500 font-mono text-sm group-hover:text-purple-400 transition-colors">
                <span class="text-purple-600">&gt;</span>
                <span>VIEW_GUIDE</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Header from '../Components/Header.vue';
import backgroundImage from '../../images/blackops3background.jpg';
import shadowsofevil from '../../images/blackops3zombies/shadowsofevil.jpg';
import thegiant from '../../images/blackops3zombies/derrise.jpg';
import derraisendragh from '../../images/blackops3zombies/derraisendragh.jpg';
import zetsubou from '../../images/blackops3zombies/zetsubou.jpg';
import gorodkrovi from '../../images/blackops3zombies/gorodkrovi.jpg';
import revelations from '../../images/blackops3zombies/revalations.jpg';
import nachtderuntoten from '../../images/blackops3zombies/nachtderuntoten.jpg';
import verruckt from '../../images/blackops3zombies/verruct.jpg';
import shinonuma from '../../images/blackops3zombies/shinonuma.jpg';
import kinodertoten from '../../images/blackops3zombies/kinodertoten.jpg';
import ascension from '../../images/blackops3zombies/ascension.jpg';
import shangrila from '../../images/blackops3zombies/shangrila.jpg';
import moon from '../../images/blackops3zombies/moon.jpg';
import originsZC from '../../images/blackops3zombies/origins.jpg';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || null);

const navigateToGuides = (mapSlug) => {
  if (!user.value) {
    router.visit('/register');
    return;
  }
  router.visit(`/zombies/Black Ops 3/${mapSlug}/guides`);
};
</script>

<style scoped>
/* Terminal Grid */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

/* Cursor Blink */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}
</style>
