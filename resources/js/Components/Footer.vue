<template>
  <!-- Footer - Terminal Style -->
  <footer class="py-16 px-6 bg-zinc-950 border-t border-orange-500/20 relative overflow-hidden">
    <div class="absolute inset-0 terminal-grid opacity-5"></div>

    <div class="container mx-auto relative z-10">
      <!-- Terminal prompt -->
      <div class="font-mono text-sm text-orange-500 mb-8">
        <span class="text-orange-600">&gt;</span> SYSTEM_INFO --footer
      </div>

      <div class="grid md:grid-cols-4 gap-8 mb-12">
        <div>
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-gradient-to-br from-orange-600 to-red-700 transform rotate-45 flex items-center justify-center relative">
              <div class="absolute inset-0 terminal-grid opacity-30"></div>
              <div class="w-8 h-8 bg-black transform -rotate-45"></div>
            </div>
            <div>
              <div class="text-lg font-black font-mono">
                <span class="text-orange-500">COD</span><span class="text-white">TERMINAL</span>
              </div>
              <div class="text-[8px] text-orange-600/70 tracking-widest font-mono">TERMINAL_v3.0</div>
            </div>
          </div>
          <p class="text-gray-500 text-sm leading-relaxed font-mono">
            Крупнейшее русскоязычное сообщество Call of Duty с гайдами, новостями и активным комьюнити.
          </p>
        </div>

        <div>
          <h3 class="text-sm font-black text-orange-500 mb-4 tracking-wider uppercase font-mono">
            <span class="text-orange-600">&gt;</span> ИГРЫ
          </h3>
          <ul class="space-y-2 text-sm font-mono">
            <li><a href="/zombies" class="text-gray-500 hover:text-orange-500 transition-colors">
              <span class="text-orange-800">&gt;</span> Zombies Режим
            </a></li>
            <li><a href="/cod-wiki" class="text-gray-500 hover:text-orange-500 transition-colors">
              <span class="text-orange-800">&gt;</span> COD Info
            </a></li>
            <li><a href="/warzone/meta" class="text-gray-500 hover:text-orange-500 transition-colors">
              <span class="text-orange-800">&gt;</span> Warzone Meta
            </a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-sm font-black text-orange-500 mb-4 tracking-wider uppercase font-mono">
            <span class="text-orange-600">&gt;</span> СОЦИАЛЬНЫЕ СЕТИ
          </h3>
          <ul class="space-y-2 text-sm font-mono">
            <li><a href="#" target="_blank" class="text-gray-500 hover:text-[#5865F2] transition-colors flex items-center gap-2">
              <span class="text-orange-800">&gt;</span> Discord <span class="text-xs text-gray-600">(100+)</span>
            </a></li>
            <li><a href="https://www.youtube.com/channel/UCJv6yWPDLMVhE-t-ispe2vA" target="_blank" class="text-gray-500 hover:text-[#FF0000] transition-colors flex items-center gap-2">
              <span class="text-orange-800">&gt;</span> YouTube <span class="text-xs text-gray-600">(3000+)</span>
            </a></li>
            <li><a href="#" target="_blank" class="text-gray-500 hover:text-[#9146FF] transition-colors">
              <span class="text-orange-800">&gt;</span> Twitch
            </a></li>
            <li><a href="#" target="_blank" class="text-gray-500 hover:text-[#0088cc] transition-colors">
              <span class="text-orange-800">&gt;</span> Telegram
            </a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-sm font-black text-orange-500 mb-4 tracking-wider uppercase font-mono">
            <span class="text-orange-600">&gt;</span> ИНФОРМАЦИЯ
          </h3>
          <ul class="space-y-2 text-sm font-mono">
            <li><a href="/about" class="text-gray-500 hover:text-orange-500 transition-colors">
              <span class="text-orange-800">&gt;</span> О проекте
            </a></li>
            <li><a href="/rules" class="text-gray-500 hover:text-orange-500 transition-colors">
              <span class="text-orange-800">&gt;</span> Правила
            </a></li>
            <li><a href="/partnership" class="text-gray-500 hover:text-orange-500 transition-colors">
              <span class="text-orange-800">&gt;</span> Партнёрство
            </a></li>
          </ul>
        </div>
      </div>

      <div class="border-t border-orange-500/20 pt-8">
        <div class="font-mono text-xs text-orange-600 mb-4">
          <span class="text-orange-600">&gt;</span> EXIT_STATUS: <span class="text-green-500">[OK]</span>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-between text-gray-600 text-sm font-mono gap-4">
          <div>&copy; 2025 COD_Terminal // Unofficial_Community_Project</div>
          <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
              <div class="w-2 h-2 bg-green-500 animate-pulse"></div>
              <span class="text-green-500">SYSTEM_ONLINE</span>
            </div>
            <div class="text-gray-700">|</div>
            <span class="text-orange-500">v3.0.1</span>
          </div>
        </div>
        <div class="mt-4 text-center md:text-left">
          <p class="text-xs text-gray-700 font-mono">
            Call of Duty и все связанные с ним названия являются товарными знаками Activision Publishing, Inc.
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
// Footer component - Terminal Style
</script>

<style scoped>
/* Терминальная сетка */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}
</style>
