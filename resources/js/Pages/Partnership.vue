<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Video -->
    <video autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover z-0 opacity-20">
      <source :src="backgroundVideo" type="video/mp4">
    </video>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Partnership Hero Section -->
    <section class="pt-24 md:pt-40 pb-12 md:pb-24 px-3 md:px-6 relative min-h-screen">
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
        <div class="max-w-5xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING PARTNERSHIP_MODULE.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ESTABLISHING CONNECTION...
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-6 md:mb-8"></div>
          </div>

          <!-- Main Title -->
          <h1 class="text-5xl md:text-7xl font-black mb-8 leading-none uppercase font-mono">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
              ПАРТНЁРСТВО
            </span>
            <span class="flex items-center text-white mt-2">
              <span>И СОТРУДНИЧЕСТВО</span>
              <span class="inline-block w-3 h-12 md:h-16 bg-orange-500 ml-3 cursor-blink"></span>
            </span>
          </h1>

          <!-- Introduction -->
          <div class="border border-orange-500/30 bg-orange-500/5 p-6 md:p-8 mb-12 relative">
            <div class="absolute top-0 left-0 w-full h-px bg-orange-500"></div>
            <div class="font-mono text-xs text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> PARTNERSHIP_INFO:
            </div>
            <p class="text-gray-300 leading-relaxed text-lg mb-4">
              Мы всегда открыты для сотрудничества! Если вы хотите стать частью нашего сообщества, предложить идею или обсудить партнёрство, свяжитесь со мной любым удобным способом.
            </p>
            <div class="font-mono text-sm text-orange-500">
              <span class="text-orange-600">&gt;</span> Готов обсудить любые предложения по развитию проекта
            </div>
          </div>

          <!-- Contact Methods -->
          <div class="space-y-6 mb-12">

            <!-- Telegram -->
            <div class="border-l-4 border-orange-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm group hover:bg-orange-500/5 transition-all">
              <div class="flex items-start">
                <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center font-mono font-black text-3xl text-black mr-6 group-hover:scale-110 transition-transform">
                  <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.161c-.18 1.897-.962 6.502-1.359 8.627-.168.9-.5 1.201-.82 1.23-.697.064-1.226-.461-1.901-.903-1.056-.692-1.653-1.123-2.678-1.799-1.185-.781-.417-1.21.258-1.911.177-.184 3.247-2.977 3.307-3.23.007-.032.015-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.139-5.062 3.345-.479.329-.913.489-1.302.481-.428-.009-1.252-.241-1.865-.44-.752-.244-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.831-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635.099-.002.321.023.465.141.121.099.155.232.171.325.016.093.036.305.02.469z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <div class="font-mono text-xs text-orange-600 mb-2">
                    <span class="text-orange-600">&gt;</span> TELEGRAM
                  </div>
                  <h3 class="text-2xl font-black text-orange-500 mb-3 font-mono">@zobnyyn</h3>
                  <p class="text-gray-400 mb-4">
                    Самый быстрый способ связи. Отвечаю обычно в течение нескольких часов.
                  </p>
                  <a href="https://t.me/zobnyyn" target="_blank" class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-black font-mono font-bold transition-colors">
                    <span class="mr-2">&gt;</span>
                    НАПИСАТЬ В TELEGRAM
                  </a>
                </div>
              </div>
            </div>

            <!-- Discord -->
            <div class="border-l-4 border-orange-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm group hover:bg-orange-500/5 transition-all">
              <div class="flex items-start">
                <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-[#5865F2] to-[#4752C4] flex items-center justify-center font-mono font-black text-3xl text-white mr-6 group-hover:scale-110 transition-transform">
                  <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <div class="font-mono text-xs text-[#5865F2] mb-2">
                    <span class="text-[#5865F2]">&gt;</span> DISCORD
                  </div>
                  <h3 class="text-2xl font-black text-[#5865F2] mb-3 font-mono">missortega</h3>
                  <p class="text-gray-400 mb-4">
                    Для обсуждения проектов, коллабораций и совместной работы.
                  </p>
                  <div class="inline-flex items-center px-6 py-3 border-2 border-[#5865F2] text-[#5865F2] font-mono font-bold">
                    <span class="mr-2">&gt;</span>
                    Discord: missortega
                  </div>
                </div>
              </div>
            </div>

            <!-- Email -->
            <div class="border-l-4 border-orange-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm group hover:bg-orange-500/5 transition-all">
              <div class="flex items-start">
                <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center font-mono font-black text-3xl text-white mr-6 group-hover:scale-110 transition-transform">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <div class="font-mono text-xs text-red-600 mb-2">
                    <span class="text-red-600">&gt;</span> EMAIL
                  </div>
                  <h3 class="text-2xl font-black text-red-500 mb-3 font-mono">therealzobnyyn@vk.com</h3>
                  <p class="text-gray-400 mb-4">
                    Для официальных предложений и деловой переписки.
                  </p>
                  <a href="mailto:therealzobnyyn@vk.com" class="inline-flex items-center px-6 py-3 border-2 border-red-500 hover:bg-red-500/10 text-red-500 font-mono font-bold transition-colors">
                    <span class="mr-2">&gt;</span>
                    ОТПРАВИТЬ EMAIL
                  </a>
                </div>
              </div>
            </div>

          </div>

          <!-- What We Offer -->
          <div class="mb-12">
            <div class="font-mono text-xs text-orange-600 mb-6">
              <span class="text-orange-600">&gt;</span> PARTNERSHIP_OPTIONS:
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-orange-500 mb-8 font-mono uppercase">
              ЧТО МЫ ПРЕДЛАГАЕМ
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <div class="flex items-center mb-4">
                  <div class="w-8 h-8 bg-orange-500 flex items-center justify-center font-mono font-black text-black mr-3">
                    01
                  </div>
                  <h3 class="text-xl font-black text-orange-500 font-mono">РЕКЛАМНЫЕ ИНТЕГРАЦИИ</h3>
                </div>
                <p class="text-gray-400 text-sm">
                  Размещение рекламы вашего продукта или сервиса на нашей платформе с охватом активной аудитории Call of Duty.
                </p>
              </div>

              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <div class="flex items-center mb-4">
                  <div class="w-8 h-8 bg-orange-500 flex items-center justify-center font-mono font-black text-black mr-3">
                    02
                  </div>
                  <h3 class="text-xl font-black text-orange-500 font-mono">КОНТЕНТ-КОЛЛАБОРАЦИИ</h3>
                </div>
                <p class="text-gray-400 text-sm">
                  Совместное создание гайдов, видео, стримов и другого контента по Call of Duty.
                </p>
              </div>

              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <div class="flex items-center mb-4">
                  <div class="w-8 h-8 bg-orange-500 flex items-center justify-center font-mono font-black text-black mr-3">
                    03
                  </div>
                  <h3 class="text-xl font-black text-orange-500 font-mono">ТЕХНИЧЕСКИЕ ПАРТНЁРСТВА</h3>
                </div>
                <p class="text-gray-400 text-sm">
                  Интеграция ваших сервисов и API для расширения функционала платформы.
                </p>
              </div>

              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <div class="flex items-center mb-4">
                  <div class="w-8 h-8 bg-orange-500 flex items-center justify-center font-mono font-black text-black mr-3">
                    04
                  </div>
                  <h3 class="text-xl font-black text-orange-500 font-mono">СПОНСОРСТВО</h3>
                </div>
                <p class="text-gray-400 text-sm">
                  Поддержка проекта и получение эксклюзивных возможностей для продвижения бренда.
                </p>
              </div>
            </div>
          </div>

          <!-- Stats -->
          <div class="border-2 border-orange-500/50 bg-orange-500/10 p-6 md:p-8 relative mb-12">
            <div class="absolute top-0 left-0 w-full h-1 bg-orange-500"></div>
            <div class="font-mono text-xs text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> PLATFORM_STATISTICS:
            </div>
            <h3 class="text-2xl font-black text-orange-500 mb-6 font-mono uppercase">НАША АУДИТОРИЯ</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 mb-2 font-mono">1000+</div>
                <div class="text-sm text-gray-400 font-mono">Пользователей</div>
              </div>
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 mb-2 font-mono">500+</div>
                <div class="text-sm text-gray-400 font-mono">Гайдов</div>
              </div>
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 mb-2 font-mono">24/7</div>
                <div class="text-sm text-gray-400 font-mono">Активность</div>
              </div>
              <div class="text-center">
                <div class="text-4xl font-black text-orange-500 mb-2 font-mono">RU</div>
                <div class="text-sm text-gray-400 font-mono">Регион</div>
              </div>
            </div>
          </div>

          <!-- CTA -->
          <div class="border border-orange-500/30 bg-black/30 p-6 md:p-8 text-center">
            <div class="font-mono text-xs text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> READY_TO_CONNECT:
            </div>
            <h3 class="text-2xl md:text-3xl font-black text-white mb-4 font-mono uppercase">
              ГОТОВЫ НАЧАТЬ СОТРУДНИЧЕСТВО?
            </h3>
            <p class="text-gray-300 mb-6 max-w-2xl mx-auto">
              Выберите удобный способ связи и напишите мне. Обсудим детали и найдём лучшее решение для взаимовыгодного партнёрства.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
              <a href="https://t.me/zobnyyn" target="_blank" class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-black font-mono font-bold transition-colors text-lg">
                <span class="mr-2">&gt;</span>
                НАПИСАТЬ В TELEGRAM
              </a>
              <a href="/" class="inline-flex items-center px-8 py-4 border-2 border-orange-500 hover:bg-orange-500/10 text-orange-500 font-mono font-bold transition-colors text-lg">
                <span class="mr-2">&gt;</span>
                НА ГЛАВНУЮ
              </a>
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

/* Мигающий курсор */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}
@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>
