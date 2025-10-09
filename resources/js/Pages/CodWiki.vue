<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Video -->
    <video autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover z-0 opacity-30">
      <source :src="backgroundVideo" type="video/mp4">
    </video>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-20 md:pt-32 pb-8 md:pb-12 px-3 md:px-6 relative">
      <!-- Background with blur effect -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-orange-950/20 backdrop-blur-sm"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <!-- Terminal Header -->
        <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
          <div class="text-orange-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> LOADING COD_WIKI_DATABASE.exe
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> ACCESSING ALL GAME ARCHIVES...
          </div>
          <div class="text-orange-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SELECT YOUR MISSION
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-green-500 to-transparent mb-8"></div>
        </div>

        <!-- Main Title -->
        <div class="mb-8 md:mb-12">
          <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-orange-600 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              CALL OF DUTY
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>WIKI</span>
              <span class="inline-block w-3 h-8 sm:h-10 md:h-12 lg:h-20 bg-orange-500 ml-2 md:ml-4 cursor-blink"></span>
            </span>
          </h1>

          <div class="text-orange-600 font-mono text-xs md:text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> DESCRIPTION:
          </div>
          <p class="text-base md:text-xl text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Полная коллекция всех игр Call of Duty. Выберите серию и погрузитесь в легендарные боевые действия.
          </p>
        </div>
      </div>
    </section>

    <!-- Black Ops Series Section -->
    <section class="py-8 md:py-12 px-3 md:px-6 relative">
      <div class="container mx-auto relative z-10">
        <!-- Section Header -->
        <div class="mb-6 md:mb-8 font-mono">
          <div class="text-orange-500 text-lg md:text-2xl font-black mb-2">
            <span class="text-orange-600">&gt;</span> BLACK OPS SERIES
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 to-transparent max-w-md mb-6 md:mb-8"></div>
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 max-w-7xl mb-12">

          <!-- World at War -->
          <div class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-900/40 to-red-900/40 overflow-hidden" style="background-image: url('/images/worldatwar.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> 2008
                </div>
                <h3 class="text-3xl font-black text-white mb-3 uppercase font-mono leading-tight">
                  WORLD<br/>AT WAR
                </h3>
              </div>

              <div class="flex items-center space-x-2 text-orange-500 font-mono text-sm group-hover:text-orange-400 transition-colors">
                <span class="text-orange-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Black Ops 1 -->
          <div class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-black to-gray-900 overflow-hidden" style="background-image: url('/images/blackops1.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> 2010
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono">
                  BLACK OPS
                </h3>
              </div>

              <div class="text-orange-500 font-mono text-sm group-hover:text-orange-400 flex items-center space-x-2">
                <span class="text-orange-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Black Ops 2 -->
          <div class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 to-black overflow-hidden" style="background-image: url('/images/blackops2.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> 2012
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono leading-tight">
                  BLACK<br/>OPS II
                </h3>
              </div>

              <div class="text-orange-500 font-mono text-sm group-hover:text-orange-400 flex items-center space-x-2">
                <span class="text-orange-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Black Ops 3 -->
          <div class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/40 to-black overflow-hidden" style="background-image: url('/images/blackops3.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> 2015
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono leading-tight">
                  BLACK<br/>OPS III
                </h3>
              </div>

              <div class="text-orange-500 font-mono text-sm group-hover:text-orange-400 flex items-center space-x-2">
                <span class="text-orange-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Black Ops 4 -->
          <div class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-900/40 via-red-900/40 to-black overflow-hidden" style="background-image: url('/images/blackops4.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> 2018
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono">
                  BLACK OPS 4
                </h3>
              </div>

              <div class="text-orange-500 font-mono text-sm group-hover:text-orange-400 flex items-center space-x-2">
                <span class="text-orange-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Cold War -->
          <div class="group relative border-2 border-orange-500/30 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-b from-red-900/40 to-black overflow-hidden" style="background-image: url('/images/coldwar.jpeg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-500 mb-2">
                  <span class="text-orange-600">&gt;</span> 2020
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono leading-tight">
                  BLACK OPS<br/>COLD WAR
                </h3>
              </div>

              <div class="text-orange-500 font-mono text-sm group-hover:text-orange-400 flex items-center space-x-2">
                <span class="text-orange-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Black Ops 6 -->
          <div class="group relative border-2 border-orange-500/50 hover:border-orange-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-600/50 to-black overflow-hidden" style="background-image: url('/images/blackops6.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-500/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-400 mb-2">
                  <span class="text-orange-500">&gt;</span> 2024
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono mb-2">
                  BLACK OPS 6
                </h3>
              </div>

              <div class="flex items-center space-x-2 text-orange-400 font-mono text-sm group-hover:text-orange-300 transition-colors">
                <span class="text-orange-500">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-orange-500 group-hover:bg-orange-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Black Ops 7 -->
          <div class="group relative border-2 border-orange-400/60 hover:border-orange-400 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/60 via-red-600/50 to-black overflow-hidden" style="background-image: url('/images/blackops7.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-orange-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- Latest Badge -->
            <div class="absolute top-4 right-4 bg-orange-400 text-black px-3 py-1 font-mono text-xs font-black animate-pulse z-20">
              LATEST
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-orange-300 mb-2">
                  <span class="text-orange-400">&gt;</span> 2025
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono mb-2">
                  BLACK OPS 7
                </h3>
              </div>

              <div class="flex items-center space-x-2 text-orange-300 font-mono text-sm group-hover:text-orange-200 transition-colors">
                <span class="text-orange-400">&gt;</span>
                <span>ИГРАТЬ</span>
                <div class="w-3 h-4 bg-orange-400 group-hover:bg-orange-300 cursor-blink"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-orange-400 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-orange-400 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

        </div>
      </div>
    </section>

    <!-- Modern Warfare Series Section -->
    <section class="py-8 md:py-12 px-3 md:px-6 relative">
      <div class="container mx-auto relative z-10">
        <!-- Section Header -->
        <div class="mb-6 md:mb-8 font-mono">
          <div class="text-green-500 text-lg md:text-2xl font-black mb-2">
            <span class="text-green-600">&gt;</span> MODERN WARFARE SERIES
          </div>
          <div class="h-px bg-gradient-to-r from-green-500 to-transparent max-w-md mb-6 md:mb-8"></div>
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 max-w-7xl">

          <!-- COD 4: Modern Warfare (2007) -->
          <div class="group relative border-2 border-green-500/30 hover:border-green-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-green-900/40 to-emerald-900/40 overflow-hidden" style="background-image: url('/images/callofduty2007background.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-green-500 mb-2">
                  <span class="text-green-600">&gt;</span> 2007
                </div>
                <h3 class="text-3xl font-black text-white mb-3 uppercase font-mono leading-tight">
                  COD 4<br/>MW
                </h3>
              </div>

              <div class="flex items-center space-x-2 text-green-500 font-mono text-sm group-hover:text-green-400 transition-colors">
                <span class="text-green-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-green-500 group-hover:bg-green-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Modern Warfare 2 (2009) -->
          <div class="group relative border-2 border-green-500/30 hover:border-green-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-black to-gray-900 overflow-hidden" style="background-image: url('/images/callofduty2009background.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-green-500 mb-2">
                  <span class="text-green-600">&gt;</span> 2009
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono">
                  MW 2
                </h3>
              </div>

              <div class="text-green-500 font-mono text-sm group-hover:text-green-400 flex items-center space-x-2">
                <span class="text-green-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-green-500 group-hover:bg-green-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Modern Warfare 3 (2011) -->
          <div class="group relative border-2 border-green-500/30 hover:border-green-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 to-black overflow-hidden" style="background-image: url('/images/callofduty2011background.jpeg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-green-500 mb-2">
                  <span class="text-green-600">&gt;</span> 2011
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono leading-tight">
                  MW 3
                </h3>
              </div>

              <div class="text-green-500 font-mono text-sm group-hover:text-green-400 flex items-center space-x-2">
                <span class="text-green-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-green-500 group-hover:bg-green-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Modern Warfare (2019) -->
          <div class="group relative border-2 border-green-500/30 hover:border-green-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-green-900/40 to-black overflow-hidden" style="background-image: url('/images/callofduty2019background.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-green-500 mb-2">
                  <span class="text-green-600">&gt;</span> 2019
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono leading-tight">
                  MODERN<br/>WARFARE
                </h3>
              </div>

              <div class="text-green-500 font-mono text-sm group-hover:text-green-400 flex items-center space-x-2">
                <span class="text-green-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-green-500 group-hover:bg-green-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Modern Warfare II (2022) -->
          <div class="group relative border-2 border-green-500/50 hover:border-green-500 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/40 via-emerald-900/40 to-black overflow-hidden" style="background-image: url('/images/callofduty2022background.webp'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-green-500 mb-2">
                  <span class="text-green-600">&gt;</span> 2022
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono">
                  MW II
                </h3>
              </div>

              <div class="text-green-500 font-mono text-sm group-hover:text-green-400 flex items-center space-x-2">
                <span class="text-green-600">&gt;</span>
                <span>ЗАПУСТИТЬ</span>
                <div class="w-2 h-3 bg-green-500 group-hover:bg-green-400"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-green-500 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

          <!-- Modern Warfare III (2023) - Latest -->
          <div class="group relative border-2 border-green-400/60 hover:border-green-400 transition-all duration-300 cursor-pointer h-64">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/60 via-emerald-600/50 to-black overflow-hidden" style="background-image: url('/images/callofduty2023background.jpg'); background-size: cover; background-position: center;">
              <div class="absolute inset-0 bg-black/60 group-hover:bg-black/40 transition-all duration-300"></div>
              <div class="absolute inset-0 terminal-grid opacity-10"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-green-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
            </div>

            <!-- Latest Badge -->
            <div class="absolute top-4 right-4 bg-green-400 text-black px-3 py-1 font-mono text-xs font-black animate-pulse z-20">
              LATEST
            </div>

            <div class="relative h-full flex flex-col justify-between p-6 z-10">
              <div>
                <div class="font-mono text-xs text-green-300 mb-2">
                  <span class="text-green-400">&gt;</span> 2023
                </div>
                <h3 class="text-3xl font-black text-white uppercase font-mono mb-2">
                  MW III
                </h3>
              </div>

              <div class="flex items-center space-x-2 text-green-300 font-mono text-sm group-hover:text-green-200 transition-colors">
                <span class="text-green-400">&gt;</span>
                <span>ИГРАТЬ</span>
                <div class="w-3 h-4 bg-green-400 group-hover:bg-green-300 cursor-blink"></div>
              </div>
            </div>

            <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-green-400 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-green-400 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"></div>
          </div>

        </div>
      </div>
    </section>

    <!-- Info Section -->
    <section class="py-8 md:py-12 px-3 md:px-6 relative">
      <div class="container mx-auto relative z-10">
        <div class="font-mono">
          <div class="text-orange-600 text-sm mb-3">
            <span class="text-orange-600">&gt;</span> TOTAL_STATISTICS:
          </div>
          <div class="max-w-4xl bg-black/50 border border-orange-500/30 p-6">
            <div class="grid md:grid-cols-3 gap-6 text-sm">
              <div>
                <div class="text-orange-500 mb-1">ВСЕГО ИГР:</div>
                <div class="text-2xl font-black text-white">14</div>
                <div class="text-xs text-gray-500 mt-1">Black Ops: 8 | Modern Warfare: 6</div>
              </div>
              <div>
                <div class="text-orange-500 mb-1">РАЗРАБОТЧИКИ:</div>
                <div class="text-lg font-black text-white">TREYARCH</div>
                <div class="text-lg font-black text-green-500">INFINITY WARD</div>
              </div>
              <div>
                <div class="text-orange-500 mb-1">СТАТУС:</div>
                <div class="text-2xl font-black text-orange-500">ACTIVE</div>
              </div>
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
import { ref, onMounted } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

// Список всех доступных видео
const backgroundVideos = [
  '/backgroundvideo/3.mp4',
  '/backgroundvideo/4.mp4',
  '/backgroundvideo/5.mp4',
  '/backgroundvideo/6.mp4',
  '/backgroundvideo/7.mp4',
  '/backgroundvideo/8.mp4',
  '/backgroundvideo/9.mp4',
  '/backgroundvideo/10.mp4',
  '/backgroundvideo/test2.mp4'
];

// Выбираем случайное видео
const backgroundVideo = ref('');

onMounted(() => {
  // Получаем случайный индекс
  const randomIndex = Math.floor(Math.random() * backgroundVideos.length);
  backgroundVideo.value = backgroundVideos[randomIndex];
});
</script>

<style scoped>
/* Терминальное свечение (оранжевое) */
.terminal-glow {
  text-shadow:
    0 0 10px rgba(249, 115, 22, 0.7),
    0 0 20px rgba(249, 115, 22, 0.5),
    0 0 30px rgba(249, 115, 22, 0.3),
    0 0 40px rgba(249, 115, 22, 0.2);
}

/* Терминальная сетка */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

/* Мигающий курсор */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}
@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>
