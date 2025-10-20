<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- SEO Meta Tags -->
    <SEO
      title="Групповой чат | COD Terminal"
      description="Общайтесь с участниками группы Call of Duty в реальном времени. Обсуждайте стратегии, ищите напарников и делитесь опытом."
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

              <!-- Group Info -->
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-orange-900/30 border-2 border-orange-500/50 flex items-center justify-center overflow-hidden">
                  <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                </div>
                <div>
                  <h2 class="text-white font-mono font-bold text-lg">
                    {{ group?.name || 'Загрузка...' }}
                  </h2>
                  <p class="text-gray-500 text-xs font-mono">
                    Групповой чат
                  </p>
                </div>
              </div>
            </div>

            <!-- Group Info Button -->
            <button @click="showGroupInfo = !showGroupInfo" class="bg-orange-500/20 hover:bg-orange-500 text-orange-500 hover:text-black border border-orange-500 px-4 py-2 text-sm font-mono font-bold transition-all">
              ИНФО
            </button>
          </div>

          <!-- Group Info Panel -->
          <div v-if="showGroupInfo" class="mt-4 pt-4 border-t border-orange-500/30">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm font-mono">
              <div>
                <p class="text-orange-500 mb-2">
                  <span class="text-orange-600">›</span> Игра: <span class="text-white">{{ group?.game }}</span>
                </p>
                <p v-if="group?.game_mode" class="text-orange-500 mb-2">
                  <span class="text-orange-600">›</span> Режим: <span class="text-white">{{ group?.game_mode }}</span>
                </p>
                <p v-if="group?.platform" class="text-orange-500 mb-2">
                  <span class="text-orange-600">›</span> Платформа: <span class="text-white">{{ group?.platform }}</span>
                </p>
              </div>
              <div>
                <p class="text-orange-500 mb-2">
                  <span class="text-orange-600">›</span> Создатель:
                  <a :href="`/profile/${group?.creator?.id}`" class="hover:text-orange-400 underline inline-flex items-center gap-1 flex-wrap">
                    <span v-if="group?.creator?.admin_prefix" class="text-orange-500 text-xs font-bold">{{ group.creator.admin_prefix }}</span>
                    <span class="text-white">{{ group?.creator?.name }}</span>
                    <span v-if="group?.creator?.is_vip" class="text-yellow-400 text-xs" title="VIP пользователь">⭐</span>
                  </a>
                </p>
                <div class="flex gap-1 mb-2">
                  <span v-if="group?.creator?.is_admin" class="px-1.5 py-0.5 bg-red-500/20 text-red-400 text-[10px] font-bold border border-red-500/30 font-mono">ADMIN</span>
                  <span v-if="group?.creator?.is_vip" class="px-1.5 py-0.5 bg-yellow-500/20 text-yellow-400 text-[10px] font-bold border border-yellow-500/30 font-mono">VIP</span>
                </div>
                <p v-if="group?.description" class="text-gray-400 text-xs">
                  {{ group?.description }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Messages Container -->
        <div class="bg-black/50 border-2 border-orange-500/30 mb-4 flex flex-col" style="height: calc(100vh - 280px); min-height: 750px;">
          <!-- Messages List -->
          <div ref="messagesContainer" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4" @scroll="handleScroll">
            <div v-if="messages.length === 0" class="text-center py-12">
              <div class="font-mono text-orange-500/50">
                <span class="text-orange-600">&gt;</span> НЕТ СООБЩЕНИЙ
              </div>
              <p class="text-gray-500 text-sm font-mono mt-2">
                Будьте первым, кто напишет в этом чате
              </p>
            </div>

            <div
              v-for="message in messages"
              :key="message.id"
              class="flex items-start space-x-3"
            >
              <!-- Avatar -->
              <div class="w-10 h-10 bg-orange-900/30 border-2 border-orange-500/50 flex items-center justify-center overflow-hidden flex-shrink-0">
                <img v-if="message.user?.avatar" :src="`/storage/${message.user.avatar}`" :alt="message.user?.name" class="w-full h-full object-cover">
                <span v-else class="text-orange-500 text-sm font-bold font-mono">
                  {{ message.user?.name?.charAt(0).toUpperCase() || '?' }}
                </span>
              </div>

              <!-- Message Content -->
              <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 flex-wrap mb-1">
                  <span v-if="message.user?.admin_prefix" class="text-orange-500 text-xs font-bold font-mono">{{ message.user.admin_prefix }}</span>
                  <a :href="`/profile/${message.user?.id}`" class="text-orange-500 font-mono text-sm font-bold hover:text-orange-400">
                    {{ message.user?.name || 'Пользователь' }}
                  </a>
                  <span v-if="message.user?.is_vip" class="text-yellow-400 text-xs" title="VIP пользователь">⭐</span>
                  <span v-if="message.user?.is_admin" class="px-1.5 py-0.5 bg-red-500/20 text-red-400 text-[8px] font-bold border border-red-500/30 font-mono">ADMIN</span>
                  <span v-if="message.user?.is_vip" class="px-1.5 py-0.5 bg-yellow-500/20 text-yellow-400 text-[8px] font-bold border border-yellow-500/30 font-mono">VIP</span>
                  <span class="text-gray-600 text-xs font-mono">
                    {{ formatMessageDate(message.created_at) }}
                  </span>
                </div>
                <div class="bg-orange-500/10 border border-orange-500/30 px-4 py-2 rounded-sm">
                  <p class="text-white font-mono text-sm break-words whitespace-pre-wrap">
                    <LinkifiedText :text="message.message" />
                  </p>
                </div>
              </div>
            </div>

            <!-- Loading indicator -->
            <div v-if="isLoading" class="text-center py-4">
              <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500"></div>
            </div>

            <!-- New messages indicator -->
            <div v-if="newMessagesCount > 0" class="text-center py-4">
              <button
                @click="scrollToBottomAndClearCount"
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
                maxlength="1000"
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

        <!-- New Messages Counter -->
        <div v-if="newMessagesCount > 0" class="fixed bottom-20 right-4 z-50">
          <div class="bg-orange-500 text-black font-mono text-sm font-bold px-4 py-2 rounded-full shadow-md flex items-center space-x-2">
            <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span>Новые сообщения: {{ newMessagesCount }}</span>
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
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import Header from '@/Components/Header.vue';
import SEO from '@/Components/SEO.vue';
import LinkifiedText from '@/Components/LinkifiedText.vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  group: Object,
  initialMessages: Array,
});

const page = usePage();
const currentUserId = page.props.auth?.user?.id;

const messages = ref(props.initialMessages || []);
const newMessage = ref('');
const isSending = ref(false);
const isLoading = ref(false);
const messagesContainer = ref(null);
const shouldAutoScroll = ref(true);
const showGroupInfo = ref(false);
const newMessagesCount = ref(0); // Количество новых сообщений
let messageInterval = null;

// Check if user is at bottom of chat
const isAtBottom = () => {
  if (!messagesContainer.value) return true;

  const { scrollTop, scrollHeight, clientHeight } = messagesContainer.value;
  return scrollHeight - scrollTop - clientHeight < 100;
};

// Scroll to bottom of messages
const scrollToBottom = (force = false) => {
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
    const response = await axios.post(`/api/community/groups/${props.group.id}/messages`, {
      message: messageText,
    });

    messages.value.push(response.data);
    shouldAutoScroll.value = true;
    scrollToBottom(true);
  } catch (error) {
    console.error('Error sending message:', error);
    newMessage.value = messageText;

    if (error.response?.status === 403) {
      alert('Вы не являетесь участником этой группы');
    } else {
      alert(error.response?.data?.error || 'Ошибка при отправке сообщения');
    }
  } finally {
    isSending.value = false;
  }
};

// Load messages
const loadMessages = async () => {
  if (!props.group?.id || isLoading.value) return;

  isLoading.value = true;
  try {
    const response = await axios.get(`/api/community/groups/${props.group.id}/messages`);
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

  if (d.toDateString() === now.toDateString()) {
    return d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
  }

  const yesterday = new Date(now);
  yesterday.setDate(yesterday.getDate() - 1);
  if (d.toDateString() === yesterday.toDateString()) {
    return 'Вчера ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
  }

  return d.toLocaleDateString('ru-RU', { day: 'numeric', month: 'short' }) + ' ' +
         d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
};

// Scroll to bottom and clear new messages count
const scrollToBottomAndClearCount = () => {
  scrollToBottom(true);
  newMessagesCount.value = 0;
};

onMounted(() => {
  scrollToBottom(true);
  loadMessages(); // Загружаем сообщения при монтировании

  // Add scroll listener
  if (messagesContainer.value) {
    messagesContainer.value.addEventListener('scroll', handleScroll);
  }
});

onUnmounted(() => {
  if (messagesContainer.value) {
    messagesContainer.value.removeEventListener('scroll', handleScroll);
  }
});
</script>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.5);
}

::-webkit-scrollbar-thumb {
  background: rgba(249, 115, 22, 0.5);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(249, 115, 22, 0.7);
}
</style>
