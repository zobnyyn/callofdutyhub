<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Background Video -->
    <video autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover z-0 opacity-20">
      <source :src="backgroundVideo" type="video/mp4">
    </video>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #dc2626 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Rules Hero Section -->
    <section class="pt-24 md:pt-40 pb-12 md:pb-24 px-3 md:px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-red-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(220, 38, 38, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(220, 38, 38, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-5xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
            <div class="text-red-500 mb-2">
              <span class="text-red-600">&gt;</span> SYSTEM INITIALIZED...
            </div>
            <div class="text-red-500/70 mb-2">
              <span class="text-red-600">&gt;</span> LOADING RULES_PROTOCOL.exe
            </div>
            <div class="text-red-500 mb-4">
              <span class="text-red-600">&gt;</span> DISPLAYING COMMUNITY_GUIDELINES
            </div>
            <div class="h-px bg-gradient-to-r from-red-500 via-red-600 to-transparent mb-6 md:mb-8"></div>
          </div>

          <!-- Main Title -->
          <h1 class="text-5xl md:text-7xl font-black mb-8 leading-none uppercase font-mono">
            <span class="text-red-600 terminal-glow-red">
              ПРАВИЛА
            </span>
            <span class="flex items-center text-white mt-2">
              <span>СООБЩЕСТВА</span>
              <span class="inline-block w-3 h-12 md:h-16 bg-red-500 ml-3 cursor-blink"></span>
            </span>
          </h1>

          <!-- Introduction -->
          <div class="border border-red-500/30 bg-red-500/5 p-6 md:p-8 mb-8 relative">
            <div class="absolute top-0 left-0 w-full h-px bg-red-500"></div>
            <div class="font-mono text-xs text-red-600 mb-4">
              <span class="text-red-600">&gt;</span> SYSTEM_MESSAGE:
            </div>
            <p class="text-gray-300 leading-relaxed mb-4">
              Добро пожаловать в крупнейшее русскоязычное сообщество Call of Duty! Для поддержания дружелюбной и безопасной атмосферы просим всех участников соблюдать следующие правила.
            </p>
            <div class="font-mono text-sm text-red-500">
              <span class="text-red-600">&gt;</span> Нарушение правил может привести к блокировке аккаунта
            </div>
          </div>

          <!-- Rules Sections -->
          <div class="space-y-6">

            <!-- Rule 1: Уважение -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  01
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">УВАЖЕНИЕ К УЧАСТНИКАМ</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Запрещены оскорбления, угрозы, травля и любые формы дискриминации</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Общайтесь вежливо даже при разногласиях</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Уважайте мнение других игроков</span>
                </li>
              </ul>
            </div>

            <!-- Rule 2: Запрещенный контент -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  02
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">ЗАПРЕЩЕННЫЙ КОНТЕНТ</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Запрещена публикация NSFW контента, порнографии</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Запрещен экстремистский контент и пропаганда насилия</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Запрещены читы, взломы и их распространение</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Запрещены ссылки на подозрительные сайты и вредоносное ПО</span>
                </li>
              </ul>
            </div>

            <!-- Rule 3: Спам -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  03
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">ЗАПРЕТ СПАМА</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не флудите одинаковыми сообщениями</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Запрещена реклама без разрешения администрации</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не злоупотребляйте CAPS LOCK</span>
                </li>
              </ul>
            </div>

            <!-- Rule 4: Конфиденциальность -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  04
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">КОНФИДЕНЦИАЛЬНОСТЬ</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не публикуйте личную информацию других пользователей</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не раскрывайте свои пароли и данные аккаунтов</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Уважайте приватность переписок</span>
                </li>
              </ul>
            </div>

            <!-- Rule 5: Авторские права -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  05
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">АВТОРСКИЕ ПРАВА</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не присваивайте чужие гайды и контент</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Указывайте авторов при использовании материалов</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не распространяйте пиратский контент</span>
                </li>
              </ul>
            </div>

            <!-- Rule 6: Использование платформы -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  06
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">ИСПОЛЬЗОВАНИЕ ПЛАТФОРМЫ</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Один аккаунт на одного пользователя</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Не пытайтесь обойти блокировки и баны</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Публикуйте контент в соответствующих разделах</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Сообщайте о нарушениях администрации</span>
                </li>
              </ul>
            </div>

            <!-- Rule 7: Гайды и контент -->
            <div class="border-l-4 border-red-500 bg-black/50 p-6 md:p-8 backdrop-blur-sm">
              <div class="flex items-start mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-500 flex items-center justify-center font-mono font-black text-2xl text-black mr-4">
                  07
                </div>
                <div class="flex-1">
                  <h3 class="text-2xl font-black text-red-500 mb-2 font-mono uppercase">КАЧЕСТВО ГАЙДОВ</h3>
                  <div class="h-px bg-red-500/30 mb-4"></div>
                </div>
              </div>
              <ul class="space-y-3 text-gray-300 ml-16">
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Публикуйте только качественный и проверенный контент</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Пишите понятно и структурированно</span>
                </li>
                <li class="flex items-start">
                  <span class="text-red-600 mr-2 mt-1">&gt;</span>
                  <span>Обновляйте устаревшую информацию</span>
                </li>
              </ul>
            </div>

          </div>

          <!-- Sanctions -->
          <div class="mt-12 border-2 border-red-500/50 bg-red-500/10 p-6 md:p-8 relative">
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500"></div>
            <div class="font-mono text-xs text-red-500 mb-4">
              <span class="text-red-600">&gt;</span> WARNING_SYSTEM:
            </div>
            <h3 class="text-2xl font-black text-red-500 mb-4 font-mono uppercase">СИСТЕМА НАКАЗАНИЙ</h3>
            <div class="space-y-3 text-gray-300">
              <div class="flex items-start">
                <span class="text-red-600 mr-2 mt-1 font-mono">[1]</span>
                <span><strong class="text-red-500">Предупреждение</strong> - за первое незначительное нарушение</span>
              </div>
              <div class="flex items-start">
                <span class="text-red-600 mr-2 mt-1 font-mono">[2]</span>
                <span><strong class="text-red-500">Временная блокировка</strong> - от 1 до 30 дней</span>
              </div>
              <div class="flex items-start">
                <span class="text-red-600 mr-2 mt-1 font-mono">[3]</span>
                <span><strong class="text-red-500">Постоянная блокировка</strong> - за серьезные или повторные нарушения</span>
              </div>
            </div>
            <div class="mt-6 p-4 bg-black/50 border-l-4 border-red-600">
              <p class="text-sm text-red-400 font-mono">
                <span class="text-red-600">&gt;</span> Администрация оставляет за собой право на окончательное решение в спорных ситуациях
              </p>
            </div>
          </div>

          <!-- Contact -->
          <div class="mt-8 border border-red-500/30 bg-black/30 p-6 md:p-8">
            <div class="font-mono text-xs text-red-600 mb-4">
              <span class="text-red-600">&gt;</span> CONTACT_INFO:
            </div>
            <h3 class="text-xl font-black text-white mb-4 font-mono">ВОЗНИКЛИ ВОПРОСЫ?</h3>
            <p class="text-gray-300 mb-4">
              Если у вас есть вопросы по правилам или вы хотите сообщить о нарушении, свяжитесь с администрацией через систему сообщений или на странице сообщества.
            </p>
            <div class="flex flex-wrap gap-4">
              <a href="/community" class="inline-flex items-center px-6 py-3 bg-red-500 hover:bg-red-600 text-black font-mono font-bold transition-colors">
                <span class="mr-2">&gt;</span>
                ПЕРЕЙТИ В СООБЩЕСТВО
              </a>
              <a href="/" class="inline-flex items-center px-6 py-3 border-2 border-red-500 hover:bg-red-500/10 text-red-500 font-mono font-bold transition-colors">
                <span class="mr-2">&gt;</span>
                НА ГЛАВНУЮ
              </a>
            </div>
          </div>

          <!-- Footer note -->
          <div class="mt-8 text-center">
            <div class="font-mono text-xs text-red-500/50">
              <div class="mb-1">
                <span class="text-red-600">&gt;</span> RULES_VERSION: 1.0.0
              </div>
              <div>
                <span class="text-red-600">&gt;</span> LAST_UPDATE: {{ currentDate }}
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
import { ref, onMounted, computed } from 'vue';
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

// Текущая дата
const currentDate = computed(() => {
  const date = new Date();
  return date.toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
});

onMounted(() => {
  // Получаем случайный индекс
  const randomIndex = Math.floor(Math.random() * backgroundVideos.length);
  backgroundVideo.value = backgroundVideos[randomIndex];
});
</script>

<style scoped>
/* Терминальное свечение (красное усиленное) */
.terminal-glow-red {
  text-shadow:
    0 0 10px rgba(220, 38, 38, 0.7),
    0 0 20px rgba(220, 38, 38, 0.5),
    0 0 30px rgba(220, 38, 38, 0.3),
    0 0 40px rgba(220, 38, 38, 0.2);
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
