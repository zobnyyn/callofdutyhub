<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- SEO Meta Tags -->
    <SEO
      title="Чат сообщества | COD Terminal"
      description="Общайтесь с другими игроками Call of Duty в реальном времени. Обсуждайте стратегии, ищите напарников и делитесь опытом."
      keywords="чат COD, общение игроков, Call of Duty чат, поиск напарников, сообщество COD"
      image="/images/og-chat.jpg"
    />

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Main Chat Section -->
    <section class="pt-20 md:pt-24 pb-8 px-3 md:px-6 relative min-h-screen">
      <div class="container mx-auto relative z-10 max-w-5xl">

        <!-- Chat Header -->
        <div class="bg-black/50 border-2 border-orange-500/30 p-4 md:p-6 mb-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <!-- Back Button -->
              <a href="/community" class="text-orange-500 hover:text-orange-400 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
              </a>

              <!-- User Info -->
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-orange-900/30 border-2 border-orange-500/50 flex items-center justify-center overflow-hidden">
                  <img v-if="companion?.avatar" :src="`/storage/${companion.avatar}`" :alt="companion.name" class="w-full h-full object-cover">
                  <span v-else class="text-orange-500 text-xl font-bold font-mono">
                    {{ companion?.name?.charAt(0).toUpperCase() || '?' }}
                  </span>
                </div>
                <div>
                  <h2 class="text-white font-mono font-bold text-lg">
                    {{ companion?.name || 'Загрузка...' }}
                  </h2>
                  <p class="text-gray-500 text-xs font-mono">
                    {{ companion?.is_online ? 'В сети' : 'Не в сети' }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Profile Link -->
            <a :href="`/profile/${companion?.id}`" class="bg-orange-500/20 hover:bg-orange-500 text-orange-500 hover:text-black border border-orange-500 px-4 py-2 text-sm font-mono font-bold transition-all">
              ПРОФИЛЬ
            </a>
          </div>
        </div>

        <!-- Messages Container -->
        <div class="bg-black/50 border-2 border-orange-500/30 mb-4 flex flex-col" style="height: calc(100vh - 280px); min-height: 750px;">
          <!-- Messages List -->
          <div ref="messagesContainer" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4">
            <div v-if="messages.length === 0" class="text-center py-12">
              <div class="font-mono text-orange-500/50">
                <span class="text-orange-600">&gt;</span> НАЧНИТЕ ДИАЛОГ
              </div>
            </div>

            <div
              v-for="message in messages"
              :key="message.id"
              :class="[
                'flex',
                message.sender_id === currentUserId ? 'justify-end' : 'justify-start'
              ]"
            >
              <div
                :class="[
                  'max-w-[70%] p-3 md:p-4',
                  message.sender_id === currentUserId
                    ? 'bg-orange-500/20 border border-orange-500/50'
                    : 'bg-gray-800/50 border border-gray-700/50'
                ]"
              >
                <div class="flex items-start space-x-2 mb-2">
                  <div class="w-8 h-8 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img v-if="message.sender?.avatar" :src="`/storage/${message.sender.avatar}`" :alt="message.sender.name" class="w-full h-full object-cover">
                    <span v-else class="text-orange-500 text-xs font-bold font-mono">
                      {{ message.sender?.name?.charAt(0).toUpperCase() || '?' }}
                    </span>
                  </div>
                  <div>
                    <p class="text-orange-500 text-xs font-mono font-bold">
                      {{ message.sender?.name || 'Пользователь' }}
                    </p>
                    <p class="text-gray-500 text-xs font-mono">
                      {{ formatMessageDate(message.created_at) }}
                    </p>
                  </div>
                </div>
                <p class="text-white font-mono text-sm break-words whitespace-pre-wrap">
                  {{ message.message }}
                </p>
              </div>
            </div>

            <!-- Loading indicator -->
            <div v-if="isLoading" class="text-center py-4">
              <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500"></div>
            </div>

            <!-- New messages indicator -->
            <div v-if="newMessagesCount > 0" class="text-center py-4">
              <button
                @click="scrollToBottom(true)"
                class="bg-orange-500 hover:bg-orange-600 text-black px-4 py-2 rounded-full font-mono text-sm transition-all"
              >
                {{ newMessagesCount }} новых сообщ. внизу
              </button>
            </div>
          </div>

          <!-- Message Input -->
          <div class="border-t-2 border-orange-500/30 p-4 md:p-6">
            <form @submit.prevent="sendMessage" class="flex space-x-3">
              <input
                v-model="newMessage"
                type="text"
                placeholder="Введите сообщение..."
                class="flex-1 bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-3 font-mono text-sm outline-none transition-all"
                :disabled="isSending"
              >
              <button
                type="submit"
                :disabled="!newMessage.trim() || isSending"
                class="bg-orange-500 hover:bg-orange-600 disabled:bg-gray-700 disabled:cursor-not-allowed text-black disabled:text-gray-500 px-6 py-3 font-mono font-bold transition-all"
              >
                {{ isSending ? 'ОТПРАВКА...' : 'ОТПРАВИТЬ' }}
              </button>
            </form>
          </div>
        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 border-t border-orange-500/20 bg-black/50 relative">
      <div class="container mx-auto">
        <div class="font-mono text-sm text-orange-600">
          <div class="mb-2">
            <span class="text-orange-600">&gt;</span> SYSTEM_TERMINAL © 2025
          </div>
          <div class="text-orange-500/50 text-xs">
            <span class="text-orange-600">&gt;</span> Call of Duty Community - COD Terminal
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import Header from '@/Components/Header.vue';
import SEO from '@/Components/SEO.vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  companion: Object,
  initialMessages: Array,
});

const page = usePage();
const currentUserId = page.props.auth?.user?.id;

const messages = ref(props.initialMessages || []);
const newMessage = ref('');
const isSending = ref(false);
const isLoading = ref(false);
const messagesContainer = ref(null);
const shouldAutoScroll = ref(true); // Флаг для автопрокрутки
const newMessagesCount = ref(0); // Количество новых сообщений

// Check if user is at bottom of chat
const isAtBottom = () => {
  if (!messagesContainer.value) return true;

  const { scrollTop, scrollHeight, clientHeight } = messagesContainer.value;
  // Считаем что пользователь внизу, если до конца осталось менее 100px
  return scrollHeight - scrollTop - clientHeight < 100;
};

// Scroll to bottom of messages
const scrollToBottom = (force = false) => {
  newMessagesCount.value = 0; // Сбрасываем счётчик при ручной прокрутке
  nextTick(() => {
    if (messagesContainer.value && (force || shouldAutoScroll.value)) {
      messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
    }
  });
};

// Handle scroll event
const handleScroll = () => {
  shouldAutoScroll.value = isAtBottom();
};

// Send message
const sendMessage = async () => {
  if (!newMessage.value.trim() || isSending.value) return;

  isSending.value = true;
  const messageText = newMessage.value;
  newMessage.value = '';

  try {
    const response = await axios.post('/api/messages/send', {
      receiver_id: props.companion.id,
      message: messageText,
    });

    messages.value.push(response.data);
    shouldAutoScroll.value = true; // Всегда прокручиваем при отправке своего сообщения
    scrollToBottom(true);
  } catch (error) {
    console.error('Error sending message:', error);
    newMessage.value = messageText; // Restore message on error

    if (error.response?.status === 403) {
      alert('Вы можете писать только друзьям');
    } else {
      alert('Ошибка при отправке сообщения');
    }
  } finally {
    isSending.value = false;
  }
};

// Load messages
const loadMessages = async () => {
  if (!props.companion?.id || isLoading.value) return;

  isLoading.value = true;
  try {
    const response = await axios.get(`/api/messages/${props.companion.id}`);
    const newMessages = response.data;

    // Если массив пустой - первая загрузка
    if (!messages.value || messages.value.length === 0) {
      messages.value = newMessages;
      newMessagesCount.value = 0;
      isLoading.value = false;
      return;
    }

    // Проверяем ID последнего сообщения
    const newLastMessageId = newMessages[newMessages.length - 1]?.id;
    const currentLastMessageId = messages.value[messages.value.length - 1]?.id;

    // Если ID последнего сообщения не изменился - НИЧЕГО НЕ ДЕЛАЕМ
    if (newLastMessageId === currentLastMessageId) {
      isLoading.value = false;
      return;
    }

    // Находим индекс последнего известного сообщения в новом массиве
    const lastKnownIndex = newMessages.findIndex(msg => msg.id === currentLastMessageId);

    if (lastKnownIndex !== -1 && lastKnownIndex < newMessages.length - 1) {
      // Добавляем только новые сообщения через push
      const messagesToAdd = newMessages.slice(lastKnownIndex + 1);

      if (messagesToAdd.length > 0) {
        // Добавляем сообщения БЕЗ прокрутки
        for (const msg of messagesToAdd) {
          messages.value.push(msg);
        }

        // Если пользователь внизу - автоматически прокручиваем и сбрасываем счётчик
        if (shouldAutoScroll.value) {
          newMessagesCount.value = 0;
          setTimeout(() => {
            if (messagesContainer.value && shouldAutoScroll.value) {
              messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
            }
          }, 0);
        } else {
          // Если пользователь НЕ внизу - показываем количество новых сообщений
          newMessagesCount.value += messagesToAdd.length;
        }
      }
    }
  } catch (error) {
    console.error('Error loading messages:', error);
  } finally {
    isLoading.value = false;
  }
};

// Format message date
const formatMessageDate = (date) => {
  if (!date) return '';
  const d = new Date(date);
  const now = new Date();
  const diff = now - d;
  const seconds = Math.floor(diff / 1000);
  const minutes = Math.floor(seconds / 60);
  const hours = Math.floor(minutes / 60);
  const days = Math.floor(hours / 24);

  if (seconds < 60) return 'только что';
  if (minutes < 60) return `${minutes} мин. назад`;
  if (hours < 24) return `${hours} ч. назад`;
  return `${days} д. назад`;
};

// Mounted lifecycle hook
onMounted(() => {
  scrollToBottom(); // Прокручиваем вниз при первом монтировании
  loadMessages(); // Загружаем сообщения при монтировании

  // Подписываемся на событие прокрутки
  const container = messagesContainer.value;
  if (container) {
    container.addEventListener('scroll', handleScroll);
  }

  // Очистка при размонтировании
  return () => {
    if (container) {
      container.removeEventListener('scroll', handleScroll);
    }
  };
});
</script>

<style scoped>
/* Custom scrollbar styles */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
  background-color: rgba(255, 165, 0, 0.7);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background-color: rgba(255, 165, 0, 0.9);
}
</style>

