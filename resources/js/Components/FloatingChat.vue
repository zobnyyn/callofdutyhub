<template>
  <!-- Floating Chat Button -->
  <div v-if="!showChatList && !selectedChat" class="fixed bottom-6 right-6 z-50">
    <button
      type="button"
      @click="toggleChatList"
      class="relative bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white rounded-full p-4 shadow-lg transition-all transform hover:scale-110"
      aria-label="Открыть чат"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
      </svg>
      <span v-if="unreadCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center" aria-live="polite">
        {{ unreadCount > 9 ? '9+' : unreadCount }}
      </span>
    </button>
  </div>

  <!-- Chat List -->
  <div v-if="showChatList && !selectedChat" class="fixed bottom-6 right-6 z-50 w-80 bg-gray-900 border-2 border-orange-600/50 rounded-lg shadow-2xl">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-600 to-red-600 p-4 rounded-t-lg flex items-center justify-between">
      <h3 class="text-white font-mono font-black flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        СООБЩЕНИЯ
      </h3>
      <button type="button" @click="closeChatList" class="text-white hover:text-gray-200" aria-label="Закрыть список чатов">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Conversations List (Personal + Group Chats) -->
    <div class="max-h-96 overflow-y-auto bg-black/30">
      <div v-if="loadingConversations" class="p-8 text-center">
        <div class="text-orange-500 font-mono text-sm">ЗАГРУЗКА...</div>
      </div>
      <div v-else-if="conversations.length === 0" class="p-8 text-center">
        <p class="text-gray-400 font-mono text-sm">Нет диалогов</p>
      </div>
      <div v-else>
        <button
          v-for="conversation in conversations"
          :key="conversation.type === 'personal' ? 'user-' + conversation.user?.id : 'group-' + conversation.group?.id"
          @click="handleConversationClick(conversation)"
          class="w-full p-3 border-b border-orange-500/20 hover:bg-orange-500/10 transition-all flex items-center space-x-3"
          type="button"
          :aria-label="conversation.type === 'personal' ? `Открыть чат с ${conversation.user?.name}` : `Открыть групповой чат ${conversation.group?.name}`"
        >
          <div class="relative">
            <!-- Personal chat avatar -->
            <template v-if="conversation.type === 'personal'">
              <img
                :src="getAvatarUrl(conversation.user?.avatar, conversation.user?.name)"
                :alt="conversation.user?.name"
                class="w-12 h-12 rounded-full border-2 border-orange-500 object-cover"
              />
              <div v-if="isOnline(conversation.user?.id)" class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900" aria-hidden="true"></div>
            </template>
            <!-- Group chat icon -->
            <template v-else>
              <div class="w-12 h-12 rounded-full border-2 border-orange-500 bg-orange-900/30 flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
            </template>
          </div>
          <div class="flex-1 text-left min-w-0">
            <div class="text-white font-mono font-bold text-sm truncate">
              {{ conversation.type === 'personal' ? conversation.user?.name : conversation.group?.name }}
            </div>
            <div class="text-gray-400 font-mono text-xs truncate">
              {{ conversation.last_message || 'Нет сообщений' }}
            </div>
            <div v-if="conversation.type === 'group'" class="text-orange-500/70 font-mono text-[10px]">
              Групповой чат
            </div>
          </div>
          <div v-if="conversation.unread_count > 0" class="bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center flex-shrink-0" aria-live="polite">
            {{ conversation.unread_count }}
          </div>
        </button>
      </div>
    </div>
  </div>

  <!-- Mini Chat Window -->
  <div v-if="selectedChat" class="fixed bottom-6 right-6 z-50 w-96 bg-gray-900 border-2 border-orange-600/50 rounded-lg shadow-2xl flex flex-col" style="height: 500px;" role="dialog" :aria-label="getChatLabel()" aria-modal="true">
    <!-- Chat Header -->
    <div class="bg-gradient-to-r from-orange-600 to-red-600 p-3 rounded-t-lg flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <!-- Personal chat header -->
        <template v-if="selectedChat.type === 'personal'">
          <img
            :src="getAvatarUrl(selectedChat.user.avatar, selectedChat.user.name)"
            :alt="selectedChat.user.name"
            class="w-8 h-8 rounded-full border-2 border-white object-cover"
          />
          <div>
            <h3 class="text-white font-mono font-bold text-sm">{{ selectedChat.user.name }}</h3>
            <div class="text-white/70 text-xs font-mono">{{ isOnline(selectedChat.user.id) ? 'Онлайн' : 'Оффлайн' }}</div>
          </div>
        </template>
        <!-- Group chat header -->
        <template v-else>
          <div class="w-8 h-8 rounded-full border-2 border-white bg-orange-900/50 flex items-center justify-center">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-white font-mono font-bold text-sm">{{ selectedChat.group.name }}</h3>
            <div class="text-white/70 text-xs font-mono">Групповой чат</div>
          </div>
        </template>
      </div>
      <div class="flex space-x-2">
        <button type="button" @click="minimizeChat" class="text-white hover:text-gray-200" aria-label="Свернуть чат">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
          </svg>
        </button>
        <button type="button" @click="closeChat" class="text-white hover:text-gray-200" aria-label="Закрыть чат">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Messages Area -->
    <div
      ref="messagesContainer"
      class="flex-1 overflow-y-auto p-4 bg-black/30 relative"
      style="scroll-behavior: auto;"
    >
      <div v-if="loadingMessages" class="text-center py-8">
        <div class="text-orange-500 font-mono text-sm">ЗАГРУЗКА...</div>
      </div>
      <div v-else-if="messages.length === 0" class="text-center py-8">
        <p class="text-gray-400 font-mono text-sm">Начните переписку!</p>
      </div>
      <div v-else class="space-y-3">
        <!-- Personal chat messages -->
        <template v-if="selectedChat.type === 'personal'">
          <div
            v-for="(message, index) in messages"
            :key="message.id"
            :data-message-index="index"
            :data-message-id="message.id"
            :class="message.sender_id === currentUserId ? 'flex justify-end' : 'flex justify-start'"
          >
            <div class="max-w-[75%]">
              <div :class="message.sender_id === currentUserId
                ? 'bg-gradient-to-r from-orange-600 to-red-600 text-white p-2 rounded-lg font-mono text-xs'
                : 'bg-gray-800 text-white p-2 rounded-lg font-mono text-xs border border-orange-500/30'">
                <LinkifiedText :text="message.message" />
              </div>
              <div class="text-xs text-gray-500 font-mono mt-1" :class="message.sender_id === currentUserId ? 'text-right' : ''">
                {{ formatTime(message.created_at) }}
              </div>
            </div>
          </div>
        </template>
        <!-- Group chat messages -->
        <template v-else>
          <div
            v-for="(message, index) in messages"
            :key="message.id"
            :data-message-index="index"
            :data-message-id="message.id"
            class="flex items-start space-x-2"
          >
            <div class="w-6 h-6 bg-orange-900/30 border border-orange-500/50 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
              <img v-if="message.user?.avatar" :src="`/storage/${message.user.avatar}`" :alt="message.user?.name" class="w-full h-full object-cover">
              <span v-else class="text-orange-500 text-[10px] font-bold">
                {{ message.user?.name?.charAt(0).toUpperCase() || '?' }}
              </span>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center space-x-1 mb-0.5">
                <span class="text-orange-500 font-mono text-[10px] font-bold">{{ message.user?.name }}</span>
                <span class="text-gray-600 text-[9px] font-mono">{{ formatTime(message.created_at) }}</span>
              </div>
              <div class="bg-gray-800 text-white p-2 rounded-lg font-mono text-xs border border-orange-500/30">
                <LinkifiedText :text="message.message" />
              </div>
            </div>
          </div>
        </template>
      </div>

      <!-- New messages indicator - FIXED POSITION -->
      <div v-if="newMessagesCount > 0" class="sticky bottom-2 left-0 right-0 text-center">
        <button
          @click="scrollToBottomAndClearCount"
          class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full font-mono text-xs font-bold transition-all shadow-lg"
        >
          ↓ {{ newMessagesCount }} новых
        </button>
      </div>
    </div>

    <!-- Input Area -->
    <div class="p-3 border-t border-orange-600/30 bg-gray-900 rounded-b-lg">
      <form @submit.prevent="sendMessage" class="flex space-x-2">
        <input
          v-model="newMessage"
          type="text"
          placeholder="Сообщение..."
          maxlength="1000"
          class="flex-1 px-3 py-2 bg-black border border-orange-600/30 rounded text-white font-mono text-sm focus:border-orange-500 focus:outline-none"
          :aria-label="getInputLabel()"
        />
        <button
          type="submit"
          :disabled="!newMessage.trim() || sending"
          class="px-4 py-2 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white text-xs font-bold font-mono rounded transition-all disabled:opacity-50"
          aria-label="Send message"
        >
          ▶
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, onUnmounted } from 'vue';
import axios from 'axios';
import LinkifiedText from '@/Components/LinkifiedText.vue';

const props = defineProps({
  currentUserId: {
    type: Number,
    required: true
  }
});

const showChatList = ref(false);
const selectedChat = ref(null);
const messages = ref([]);
const newMessage = ref('');
const loadingMessages = ref(false);
const sending = ref(false);
const messagesContainer = ref(null);
const onlineUsers = ref([]);
const unreadCount = ref(0);
const unreadByUser = ref({});
const messagePollingInterval = ref(null);
const unreadPollingInterval = ref(null);
const conversations = ref([]);
const loadingConversations = ref(false);
const isUserScrolling = ref(false); // Флаг для отслеживания скроллинга пользователем
const lastMessageId = ref(null); // ID последнего сообщения
const newMessagesCount = ref(0); // Количество новых сообщений

onMounted(() => {
  loadOnlineUsers();
  loadUnreadCount();
  loadUnreadByUser();
  loadConversations();

  // Обновляем онлайн пользователей каждые 30 секунд
  setInterval(loadOnlineUsers, 30000);

  // Обновляем количество непрочитанных каждые 5 секунд
  unreadPollingInterval.value = setInterval(() => {
    loadUnreadCount();
    loadUnreadByUser();
  }, 5000);
});

onUnmounted(() => {
  stopMessagePolling();
  if (unreadPollingInterval.value) {
    clearInterval(unreadPollingInterval.value);
  }
});

function toggleChatList() {
  showChatList.value = !showChatList.value;
  if (showChatList.value) {
    loadConversations();
    loadUnreadByUser();
  }
}

function closeChatList() {
  showChatList.value = false;
}

async function loadOnlineUsers() {
  try {
    const response = await axios.get('/api/online-users');
    onlineUsers.value = response.data.users || [];
  } catch (error) {
    console.error('Error loading online users:', error);
  }
}

async function loadUnreadCount() {
  try {
    const response = await axios.get('/api/messages/unread-count');
    unreadCount.value = response.data.count || 0;
  } catch (error) {
    console.error('Error loading unread count:', error);
  }
}

async function loadUnreadByUser() {
  try {
    const response = await axios.get('/api/messages/unread-by-user');
    unreadByUser.value = response.data || {};
  } catch (error) {
    console.error('Error loading unread by user:', error);
  }
}

async function loadConversations() {
  loadingConversations.value = true;
  try {
    const response = await axios.get('/api/messages/conversations');
    conversations.value = response.data || [];
  } catch (error) {
    console.error('Error loading conversations:', error);
    conversations.value = [];
  } finally {
    loadingConversations.value = false;
  }
}

function handleConversationClick(conversation) {
  selectedChat.value = conversation;
  showChatList.value = false;
  isUserScrolling.value = false;
  lastMessageId.value = null;
  loadMessages();
  startMessagePolling();

  // Добавляем обработчик скролла
  nextTick(() => {
    if (messagesContainer.value) {
      messagesContainer.value.addEventListener('scroll', handleScroll);
    }
  });
}

function minimizeChat() {
  selectedChat.value = null;
  stopMessagePolling();
  showChatList.value = true;

  // Удаляем обработчик скролла
  if (messagesContainer.value) {
    messagesContainer.value.removeEventListener('scroll', handleScroll);
  }
}

function closeChat() {
  selectedChat.value = null;
  stopMessagePolling();

  // Удаляем обработчик скролла
  if (messagesContainer.value) {
    messagesContainer.value.removeEventListener('scroll', handleScroll);
  }
}

// Проверяем, находится ли пользователь внизу чата
function isAtBottom() {
  if (!messagesContainer.value) return true;
  const { scrollTop, scrollHeight, clientHeight } = messagesContainer.value;
  return scrollHeight - scrollTop - clientHeight < 50;
}

// Обработчик скролла
function handleScroll() {
  if (!messagesContainer.value) return;
  isUserScrolling.value = !isAtBottom();
}

async function loadMessages(showLoading = true) {
  if (!selectedChat.value) return;

  // Показываем загрузку только при первом открытии чата
  if (showLoading) {
    loadingMessages.value = true;
  }

  try {
    let response;

    if (selectedChat.value.type === 'personal') {
      response = await axios.get(`/api/messages/${selectedChat.value.user.id}`);
    } else {
      response = await axios.get(`/api/community/groups/${selectedChat.value.group.id}/messages`);
    }

    messages.value = response.data;

    if (showLoading) {
      loadingMessages.value = false;
      await nextTick();
      await new Promise(resolve => setTimeout(resolve, 100));
      scrollToBottom();
    }

    await loadUnreadCount();
    await loadUnreadByUser();
  } catch (error) {
    console.error('Error loading messages:', error);
    if (showLoading) {
      loadingMessages.value = false;
    }
  }
}

async function sendMessage() {
  if (!newMessage.value.trim() || sending.value || !selectedChat.value) return;

  sending.value = true;
  try {
    let response;

    if (selectedChat.value.type === 'personal') {
      response = await axios.post('/api/messages/send', {
        receiver_id: selectedChat.value.user.id,
        message: newMessage.value
      });
    } else {
      response = await axios.post(`/api/community/groups/${selectedChat.value.group.id}/messages`, {
        message: newMessage.value
      });
    }

    messages.value.push(response.data);
    newMessage.value = '';
    await nextTick();
    await new Promise(resolve => setTimeout(resolve, 50));
    scrollToBottom();
  } catch (error) {
    console.error('Error sending message:', error);
    alert(error.response?.data?.error || 'Ошибка при отправке сообщения');
  } finally {
    sending.value = false;
  }
}

function scrollToBottom(smooth = true) {
  if (messagesContainer.value) {
    messagesContainer.value.scrollTo({
      top: messagesContainer.value.scrollHeight,
      behavior: smooth ? 'smooth' : 'instant'
    });
  }
}

function scrollToBottomAndClearCount() {
  newMessagesCount.value = 0;
  isUserScrolling.value = false;
  scrollToBottom(true);
}

function startMessagePolling() {
  stopMessagePolling();
  messagePollingInterval.value = setInterval(async () => {
    if (!selectedChat.value) return;

    try {
      let response;

      if (selectedChat.value.type === 'personal') {
        response = await axios.get(`/api/messages/${selectedChat.value.user.id}`);
      } else {
        response = await axios.get(`/api/community/groups/${selectedChat.value.group.id}/messages`);
      }

      const newMessages = response.data;

      // Если нет сообщений вообще
      if (newMessages.length === 0) {
        return;
      }

      // Если массив пустой
      if (!messages.value || messages.value.length === 0) {
        return;
      }

      // Проверяем ID последнего сообщения
      const newLastMessageId = newMessages[newMessages.length - 1]?.id;
      const currentLastMessageId = messages.value[messages.value.length - 1]?.id;

      // Если ID последнего сообщения не изменился - НИЧЕГО НЕ ДЕЛАЕМ
      if (newLastMessageId === currentLastMessageId) {
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

          // Если пользователь внизу - просто сбрасываем счётчик, НЕ прокручиваем
          if (!isUserScrolling.value) {
            newMessagesCount.value = 0;
          } else {
            // Если пользователь НЕ внизу - показываем счётчик
            newMessagesCount.value += messagesToAdd.length;
          }
        }
      }

    } catch (error) {
      console.error('Error polling messages:', error);
    }
  }, 3000);
}

function stopMessagePolling() {
  if (messagePollingInterval.value) {
    clearInterval(messagePollingInterval.value);
    messagePollingInterval.value = null;
  }
}

function getAvatarUrl(avatar, name) {
  if (!avatar || avatar === 'null' || avatar === '0' || avatar === 0) {
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name) + '&background=ea580c&color=fff';
  }
  if (avatar.startsWith('http')) {
    return avatar;
  }
  return '/storage/' + avatar;
}

function isOnline(userId) {
  return onlineUsers.value.some(user => user.id === userId);
}

function getUnreadForUser(userId) {
  return unreadByUser.value[userId] || 0;
}

function getChatLabel() {
  if (!selectedChat.value) return '';
  return selectedChat.value.type === 'personal'
    ? `Chat with ${selectedChat.value.user.name}`
    : `Group chat ${selectedChat.value.group.name}`;
}

function getInputLabel() {
  if (!selectedChat.value) return 'Message';
  return selectedChat.value.type === 'personal'
    ? `Message to ${selectedChat.value.user.name}`
    : `Message to group ${selectedChat.value.group.name}`;
}

function formatTime(dateString) {
  const date = new Date(dateString);
  const now = new Date();
  const diffInSeconds = Math.floor((now - date) / 1000);

  if (diffInSeconds < 60) {
    return 'только что';
  } else if (diffInSeconds < 3600) {
    const minutes = Math.floor(diffInSeconds / 60);
    return `${minutes} мин`;
  } else if (diffInSeconds < 86400) {
    const hours = Math.floor(diffInSeconds / 3600);
    return `${hours} ч`;
  } else {
    return date.toLocaleDateString('ru-RU', {
      day: 'numeric',
      month: 'short'
    });
  }
}
</script>

<style scoped>
.auto-scroll {
  scroll-behavior: smooth !important;
}
</style>
