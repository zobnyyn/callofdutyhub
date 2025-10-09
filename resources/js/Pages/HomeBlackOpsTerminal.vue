<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Video -->
    <video autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover z-0 opacity-30">
      <source :src="backgroundVideo" type="video/mp4">
    </video>

    <!-- CRT Screen Effect -->
    <!-- <div class="fixed inset-0 pointer-events-none z-50 crt-overlay"></div> -->
    <!-- <div class="fixed inset-0 pointer-events-none z-50 scanlines"></div> -->

    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section - Terminal Style -->
    <section class="pt-24 md:pt-40 pb-12 md:pb-24 px-3 md:px-6 relative min-h-screen flex items-center">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-6xl">
          <!-- Terminal Header -->
          <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING COMBAT_OPERATIONS.exe
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> AUTHENTICATING USER... <span class="text-green-500">[OK]</span>
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> WELCOME TO BLACK OPS TERMINAL
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-6 md:mb-8"></div>
          </div>

          <!-- Main Terminal Output -->
          <div class="mb-8 md:mb-10">
            <div class="text-orange-600 font-mono text-xs md:text-sm mb-3 md:mb-4">
              <span class="text-orange-600">&gt;</span> DISPLAY MISSION_BRIEF
            </div>

            <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-9xl font-black mb-4 md:mb-6 leading-none uppercase font-mono">
              <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 mb-2 terminal-glow">
                CALL OF DUTY
              </span>
              <span class="block text-white flex items-center">
                <span>TERMINAL</span>
                <span class="inline-block w-3 h-10 sm:h-12 md:h-16 lg:h-24 bg-orange-500 ml-2 md:ml-4 cursor-blink"></span>
              </span>
            </h1>

            <div class="text-orange-600 font-mono text-xs md:text-sm mb-3 md:mb-4">
              <span class="text-orange-600">&gt;</span> DESCRIPTION:
            </div>
            <p class="text-base md:text-xl lg:text-2xl text-gray-400 leading-relaxed mb-4 md:mb-6 font-mono">
              <span class="text-orange-500">[CLASSIFIED]</span> Лучшее и большое комьюнити людей, которые обожают Call of Duty.
            </p>
          </div>

          <!-- Stats - Terminal Style -->
          <div class="mb-8 md:mb-10 font-mono text-xs md:text-sm">
            <div class="text-orange-600 mb-3 md:mb-4">
              <span class="text-orange-600">&gt;</span> SYSTEM_STATS:
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 max-w-3xl">
              <div class="border border-orange-500/30 bg-orange-500/5 p-3 md:p-4 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-[10px] md:text-xs text-orange-600 mb-1">OPERATORS:</div>
                <div class="text-2xl md:text-3xl font-black text-orange-500">1K+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-3 md:p-4 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-[10px] md:text-xs text-orange-600 mb-1">MISSIONS:</div>
                <div class="text-2xl md:text-3xl font-black text-orange-500">500+</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-3 md:p-4 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-[10px] md:text-xs text-orange-600 mb-1">STATUS:</div>
                <div class="text-2xl md:text-3xl font-black text-orange-500">24/7</div>
              </div>
              <div class="border border-orange-500/30 bg-orange-500/5 p-3 md:p-4 relative group hover:bg-orange-500/10 transition-all">
                <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
                <div class="text-[10px] md:text-xs text-orange-600 mb-1">LEVEL:</div>
                <div class="text-2xl md:text-3xl font-black text-orange-500">MAX</div>
              </div>
            </div>
          </div>

          <!-- Command Input Style CTA -->
          <div class="font-mono">
            <div class="text-orange-600 text-xs md:text-sm mb-3">
              <span class="text-orange-600">&gt;</span> AVAILABLE_COMMANDS:
            </div>
            <div class="flex flex-col sm:flex-row items-start gap-3">
              <a href="/register" class="group relative px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black font-black text-lg tracking-wider transition-all overflow-hidden border-2 border-orange-700">
                <span class="absolute inset-0 terminal-grid opacity-20" aria-hidden="true"></span>
                <span class="relative z-10 flex items-center">
                  <span class="text-black/60 mr-2">&gt;</span>
                  <span>ПРИСОЕДИНИТЬСЯ</span>
                  <span class="inline-block w-2 h-4 bg-black/30 ml-2 cursor-blink"></span>
                </span>
              </a>
              <a href="/about" class="px-8 py-4 border-2 border-orange-500/50 hover:bg-orange-500/10 text-orange-500 font-black text-lg tracking-wider transition-all">
                <span class="text-orange-600/60 mr-2">&gt;</span>
                <span>УЗНАТЬ БОЛЬШЕ</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section - Terminal Style -->
    <section class="py-24 px-6 bg-zinc-950 relative overflow-hidden border-t border-orange-500/20">
      <div class="absolute inset-0 opacity-5" style="background: repeating-linear-gradient(0deg, #f97316, #f97316 1px, transparent 1px, transparent 3px);"></div>

      <div class="container mx-auto relative z-10">
        <!-- Section Header - Terminal Style -->
        <div class="mb-16 font-mono">
          <div class="text-orange-500 text-sm mb-2">
            <span class="text-orange-600">&gt;</span> LOADING TACTICAL_MODULES...
          </div>
          <div class="text-orange-500/70 text-sm mb-4">
            <span class="text-orange-600">&gt;</span> STATUS: <span class="text-green-500">[READY]</span>
          </div>
          <h2 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase">
            <span class="text-orange-500">&gt;</span> ОПЕРАТИВНЫЕ_МОДУЛИ
          </h2>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent max-w-2xl"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
          <!-- Module 1 -->
          <div class="group relative bg-black border border-orange-500/30 hover:border-orange-500/60 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-0 left-0 right-0 h-px bg-orange-500"></div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="flex items-center justify-between mb-6 font-mono text-xs text-orange-600">
                <span>&gt; MODULE_01</span>
                <div class="flex items-center space-x-1">
                  <div class="w-2 h-2 bg-orange-500"></div>
                  <span>ACTIVE</span>
                </div>
              </div>

              <div class="w-16 h-16 border-2 border-orange-500/40 flex items-center justify-center mb-6 relative">
                <div class="absolute inset-0 terminal-grid opacity-20"></div>
                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>

              <h3 class="text-2xl font-black text-white mb-4 uppercase font-mono">
                <span class="text-orange-600">&gt;</span> АНАЛИТИКА
              </h3>
              <p class="text-gray-400 leading-relaxed mb-6 text-sm min-h-[3rem]">
                Актуальные новости, обзоры оружия, карт, мета-гайды и многое другое.
              </p>

              <div class="font-mono text-xs text-orange-500 group-hover:text-orange-400 transition-colors mt-auto">
                <span class="text-orange-600">&gt;</span> ACCESS_MODULE
              </div>
            </div>
          </div>

          <!-- Module 2 -->
          <div class="group relative bg-black border border-orange-500/30 hover:border-orange-500/60 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-0 left-0 right-0 h-px bg-orange-500"></div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="flex items-center justify-between mb-6 font-mono text-xs text-orange-600">
                <span>&gt; MODULE_02</span>
                <div class="flex items-center space-x-1">
                  <div class="w-2 h-2 bg-orange-500"></div>
                  <span>ACTIVE</span>
                </div>
              </div>

              <div class="w-16 h-16 border-2 border-orange-500/40 flex items-center justify-center mb-6 relative">
                <div class="absolute inset-0 terminal-grid opacity-20"></div>
                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="8"/>
                  <path d="M12 2v4M12 18v4M2 12h4M18 12h4" stroke-linecap="round"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </div>

              <h3 class="text-2xl font-black text-white mb-4 uppercase font-mono">
                <span class="text-orange-600">&gt;</span> ОТРЯДЫ
              </h3>
              <p class="text-gray-400 leading-relaxed mb-6 text-sm min-h-[3rem]">
                Найдите тиммейтов для warzone, multiplayer и других режимов.
              </p>

              <div class="font-mono text-xs text-orange-500 group-hover:text-orange-400 transition-colors mt-auto">
                <span class="text-orange-600">&gt;</span> ACCESS_MODULE
              </div>
            </div>
          </div>

          <!-- Module 3 -->
          <div class="group relative bg-black border border-orange-500/30 hover:border-orange-500/60 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-0 left-0 right-0 h-px bg-orange-500"></div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="flex items-center justify-between mb-6 font-mono text-xs text-orange-600">
                <span>&gt; MODULE_03</span>
                <div class="flex items-center space-x-1">
                  <div class="w-2 h-2 bg-orange-500"></div>
                  <span>ACTIVE</span>
                </div>
              </div>

              <div class="w-16 h-16 border-2 border-orange-500/40 flex items-center justify-center mb-6 relative">
                <div class="absolute inset-0 terminal-grid opacity-20"></div>
                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>

              <h3 class="text-2xl font-black text-white mb-4 uppercase font-mono">
                <span class="text-orange-600">&gt;</span> СВЯЗЬ
              </h3>
              <p class="text-gray-400 leading-relaxed mb-6 text-sm min-h-[3rem]">
                Общение с другими игроками через встроенный чат и discord канал.
              </p>

              <div class="font-mono text-xs text-orange-500 group-hover:text-orange-400 transition-colors mt-auto">
                <span class="text-orange-600">&gt;</span> ACCESS_MODULE
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Network Section - Terminal Style -->
    <section class="py-24 px-6 bg-black relative overflow-hidden border-t border-orange-500/20">
      <div class="absolute inset-0 opacity-5">
        <div style="background-image: radial-gradient(circle, #f97316 1px, transparent 1px); background-size: 30px 30px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <div class="mb-16 font-mono">
          <div class="text-orange-500 text-sm mb-2">
            <span class="text-orange-600">&gt;</span> INITIALIZING COMMUNICATION_CHANNELS...
          </div>
          <div class="text-orange-500/70 text-sm mb-4">
            <span class="text-orange-600">&gt;</span> ENCRYPTION: <span class="text-green-500">[ENABLED]</span>
          </div>
          <h2 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase">
            <span class="text-orange-500">&gt;</span> БОЕВАЯ_СЕТЬ
          </h2>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent max-w-2xl"></div>
        </div>

        <div class="grid md:grid-cols-4 gap-6 max-w-6xl mx-auto">
          <!-- Discord -->
          <div class="group relative bg-gradient-to-br from-zinc-900 to-black border-2 border-[#5865F2]/30 hover:border-[#5865F2] p-8 transition-all overflow-hidden flex flex-col h-full">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-3 right-3 font-mono text-[10px] text-[#5865F2] flex items-center space-x-1">
              <div class="w-2 h-2 bg-[#5865F2]"></div>
              <span>ONLINE</span>
            </div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> CHANNEL_01
              </div>

              <svg class="w-16 h-16 text-[#5865F2] mb-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
              </svg>

              <h3 class="text-2xl font-black text-white mb-3 uppercase font-mono">
                <span class="text-[#5865F2]">&gt;</span> DISCORD
              </h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                Оперативный канал для координации боевых действий и стратегического планирования
              </p>

              <div class="flex justify-end mt-auto">
                <button class="w-full py-3 bg-[#5865F2] hover:bg-[#4752C4] text-white font-bold font-mono transition-all border border-[#5865F2]/50">
                  <span class="text-white/60">&gt;</span> CONNECT_
                </button>
              </div>
            </div>
          </div>

          <!-- YouTube -->
          <div class="group relative bg-gradient-to-br from-zinc-900 to-black border-2 border-[#FF0000]/30 hover:border-[#FF0000] p-8 transition-all overflow-hidden flex flex-col h-full">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-3 right-3 font-mono text-[10px] text-[#FF0000] flex items-center space-x-1">
              <div class="w-2 h-2 bg-[#FF0000]"></div>
              <span>LIVE</span>
            </div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> CHANNEL_02
              </div>

              <svg class="w-16 h-16 text-[#FF0000] mb-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
              </svg>

              <h3 class="text-2xl font-black text-white mb-3 uppercase font-mono">
                <span class="text-[#FF0000]">&gt;</span> YOUTUBE
              </h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                Архив боевых операций, тактические брифинги и обучающие материалы от профи
              </p>

              <div class="flex justify-end mt-auto">
                <a href="https://www.youtube.com/channel/UCJv6yWPDLMVhE-t-ispe2vA" target="_blank" class="w-full py-3 bg-[#FF0000] hover:bg-[#CC0000] text-white font-bold font-mono transition-all border border-[#FF0000]/50 text-center">
                  <span class="text-white/60">&gt;</span> WATCH_
                </a>
              </div>
            </div>
          </div>

          <!-- Twitch -->
          <div class="group relative bg-gradient-to-br from-zinc-900 to-black border-2 border-[#9146FF]/30 hover:border-[#9146FF] p-8 transition-all overflow-hidden flex flex-col h-full">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-3 right-3 font-mono text-[10px] text-[#9146FF] flex items-center space-x-1">
              <div class="w-2 h-2 bg-[#9146FF]"></div>
              <span>STREAMING</span>
            </div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> CHANNEL_03
              </div>

              <svg class="w-16 h-16 text-[#9146FF] mb-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2.149 0l-1.612 4.119v16.836h5.731v3.045h3.224l3.045-3.045h4.657l6.269-6.269v-14.686h-21.314zm19.164 13.612l-3.582 3.582h-5.731l-3.045 3.045v-3.045h-4.836v-15.045h17.194v11.463zm-3.582-7.343v6.262h-2.149v-6.262h2.149zm-5.731 0v6.262h-2.149v-6.262h2.149z" fill-rule="evenodd" clip-rule="evenodd"/>
              </svg>

              <h3 class="text-2xl font-black text-white mb-3 uppercase font-mono">
                <span class="text-[#9146FF]">&gt;</span> TWITCH
              </h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                Прямые трансляции операций и турниров в режиме реального времени
              </p>

              <div class="flex justify-end mt-auto">
                <button class="w-full py-3 bg-[#9146FF] hover:bg-[#7d3dd1] text-white font-bold font-mono transition-all border border-[#9146FF]/50">
                  <span class="text-white/60">&gt;</span> STREAM_
                </button>
              </div>
            </div>
          </div>

          <!-- Telegram -->
          <div class="group relative bg-gradient-to-br from-zinc-900 to-black border-2 border-[#0088cc]/30 hover:border-[#0088cc] p-8 transition-all overflow-hidden flex flex-col h-full">
            <div class="absolute inset-0 terminal-grid opacity-5"></div>
            <div class="absolute top-3 right-3 font-mono text-[10px] text-[#0088cc] flex items-center space-x-1">
              <div class="w-2 h-2 bg-[#0088cc]"></div>
              <span>ACTIVE</span>
            </div>

            <div class="relative z-10 flex flex-col h-full">
              <div class="font-mono text-xs text-orange-600 mb-4">
                <span class="text-orange-600">&gt;</span> CHANNEL_04
              </div>

              <svg class="w-16 h-16 text-[#0088cc] mb-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
              </svg>

              <h3 class="text-2xl font-black text-white mb-3 uppercase font-mono">
                <span class="text-[#0088cc]">&gt;</span> TELEGRAM
              </h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                Мгновенные уведомления о боевых операциях и быстрая связь с командой
              </p>

              <div class="flex justify-end mt-auto">
                <button class="w-full py-3 bg-[#0088cc] hover:bg-[#006699] text-white font-bold font-mono transition-all border border-[#0088cc]/50">
                  <span class="text-white/60">&gt;</span> JOIN_
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer - Terminal Style -->
    <Footer />
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const currentTime = ref('00:00:00');
const showDropdown = ref(false);
const showMWDropdown = ref(false);
let dropdownTimeout: number | null = null;
let mwDropdownTimeout: number | null = null;

// Массив фоновых видео
const backgroundVideos = [
  '/backgroundvideo/homepage/cod_main_page_1.mp4',
  '/backgroundvideo/homepage/cod_main_page_2.mp4',
  '/backgroundvideo/homepage/cod_main_page_3.mp4',
];

// Выбираем случайное видео
const backgroundVideo = ref('');

const updateTime = () => {
  const now = new Date();
  currentTime.value = now.toLocaleTimeString('ru-RU');
};

let intervalId: number;

onMounted(() => {
  // Получаем случайный индекс
  const randomIndex = Math.floor(Math.random() * backgroundVideos.length);
  backgroundVideo.value = backgroundVideos[randomIndex];

  updateTime();
  intervalId = window.setInterval(updateTime, 1000);
});

onUnmounted(() => {
  if (intervalId) {
    clearInterval(intervalId);
  }
});

function openDropdown() {
  if (dropdownTimeout) clearTimeout(dropdownTimeout);
  showDropdown.value = true;
}
function closeDropdown() {
  dropdownTimeout = window.setTimeout(() => {
    showDropdown.value = false;
  }, 150);
}
function openMWDropdown() {
  if (mwDropdownTimeout) clearTimeout(mwDropdownTimeout);
  showMWDropdown.value = true;
}
function closeMWDropdown() {
  mwDropdownTimeout = window.setTimeout(() => {
    showMWDropdown.value = false;
  }, 150);
}
</script>

<style scoped>
/* Эффект CRT-экрана (более нейтральный, ретро-терминал) */
/*
.crt-overlay {
  pointer-events: none;
  background: repeating-linear-gradient(0deg, rgba(255,255,255,0.07) 0px, transparent 2px, transparent 4px);
  mix-blend-mode: lighten;
}
*/

/* Эффект горизонтальных полос (scanlines, бело-серый) */
/*
.scanlines {
  pointer-events: none;
  background: repeating-linear-gradient(
    0deg,
    transparent 0px,
    transparent 2px,
    rgba(255,255,255,0.06) 2px,
    rgba(255,255,255,0.06) 4px
  );
  background-size: 100% 4px;
  animation: scanline 8s linear infinite;
}
@keyframes scanline {
  0% { background-position: 0 0; }
  100% { background-position: 0 100%; }
}
*/

/* Терминальная сетка (бледно-зелёная, как старые мониторы) */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

/* Мигающий курсор (оставим оранжевый для акцента) */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}
@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Терминальное свечение (оставить оранжевый для акцента) */
.terminal-glow {
  text-shadow:
    0 0 10px rgba(249, 115, 22, 0.6),
    0 0 20px rgba(249, 115, 22, 0.4),
    0 0 30px rgba(249, 115, 22, 0.3),
    0 0 40px rgba(249, 115, 22, 0.2);
}

/* Терминальный пункт меню */
.terminal-nav-item {
  @apply px-4 py-2 text-sm font-bold tracking-wider text-gray-400 transition-all font-mono;
}
.terminal-nav-item:hover {
  @apply text-orange-400;
}
</style>
