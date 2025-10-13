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
            <div class="w-10 h-10 relative">
              <img :src="faviconAlt3" alt="COD Terminal" class="w-full h-full object-contain" />
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
            <li><a href="/zombies" class="text-gray-500 hover:text-orange-500 transition-colors" title="Zombies">
              <span class="text-orange-800">&gt;</span> Zombies Режим
            </a></li>
            <li><a href="/cod-wiki" class="text-gray-500 hover:text-orange-500 transition-colors" title="COD Info">
              <span class="text-orange-800">&gt;</span> COD Info
            </a></li>
            <li><a href="/warzone/meta" class="text-gray-500 hover:text-orange-500 transition-colors" title="Warzone Meta">
              <span class="text-orange-800">&gt;</span> Warzone Meta
            </a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-sm font-black text-orange-500 mb-4 tracking-wider uppercase font-mono">
            <span class="text-orange-600">&gt;</span> СОЦИАЛЬНЫЕ СЕТИ
          </h3>
          <ul class="space-y-2 text-sm font-mono">
            <li><a href="https://discord.gg/dsdkKyKPUB" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#5865F2] transition-colors flex items-center gap-2" aria-label="Discord server" title="Discord server">
              <span class="text-orange-800">&gt;</span> Discord <span class="text-xs text-gray-600">(100+)</span>
            </a></li>
            <li><a href="https://www.youtube.com/channel/UCJv6yWPDLMVhE-t-ispe2vA" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#FF0000] transition-colors flex items-center gap-2" aria-label="YouTube channel" title="YouTube channel">
              <span class="text-orange-800">&gt;</span> YouTube <span class="text-xs text-gray-600">(3000+)</span>
            </a></li>
            <li><a href="https://www.twitch.tv/zobnyyn" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#9146FF] transition-colors" aria-label="Twitch channel" title="Twitch channel">
              <span class="text-orange-800">&gt;</span> Twitch
            </a></li>
            <li><a href="https://t.me/teoryaigr" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#0088cc] transition-colors" aria-label="Telegram" title="Telegram">
              <span class="text-orange-800">&gt;</span> Telegram
            </a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-sm font-black text-orange-500 mb-4 tracking-wider uppercase font-mono">
            <span class="text-orange-600">&gt;</span> ИНФОРМАЦИЯ
          </h3>
          <ul class="space-y-2 text-sm font-mono">
            <li><a href="/about" class="text-gray-500 hover:text-orange-500 transition-colors" title="О проекте">
              <span class="text-orange-800">&gt;</span> О проекте
            </a></li>
            <li><a href="/rules" class="text-gray-500 hover:text-orange-500 transition-colors" title="Правила">
              <span class="text-orange-800">&gt;</span> Правила
            </a></li>
            <li><a href="/partnership" class="text-gray-500 hover:text-orange-500 transition-colors" title="Партнёрство">
              <span class="text-orange-800">&gt;</span> Партнёрство
            </a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-sm font-black text-orange-500 mb-4 tracking-wider uppercase font-mono">
            <span class="text-orange-600">&gt;</span> ПОДДЕРЖКА
          </h3>
          <ul class="space-y-2 text-sm font-mono">
            <li><a href="https://www.donationalerts.com/r/zobnyyn" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#F7931E] transition-colors flex items-center gap-2" aria-label="Donate via DonationAlerts" title="Donate via DonationAlerts">
              <span class="text-orange-800">&gt;</span>
              <svg class="w-4 h-4 text-[#F7931E]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
              </svg>
              Донат
            </a></li>
          </ul>
          <div class="mt-4 p-3 bg-orange-500/5 border border-orange-500/20 rounded">
            <p class="text-xs text-gray-500 font-mono leading-relaxed">
              Поддержите проект! Все средства идут на развитие и оплату хостинга.
            </p>
          </div>
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
import faviconAlt3 from '../../images/favicon-alt-3.svg';
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
