<template>
  <!-- Floating Chat Button -->
  <div v-if="!showChatList && !selectedFriend" class="fixed bottom-6 right-6 z-50">
    <button
      @click="toggleChatList"
      class="relative bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white rounded-full p-4 shadow-lg transition-all transform hover:scale-110"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
      </svg>
      <span v-if="unreadCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
        {{ unreadCount > 9 ? '9+' : unreadCount }}
      </span>
    </button>
  </div>

  <!-- Chat List -->
  <div v-if="showChatList && !selectedFriend" class="fixed bottom-6 right-6 z-50 w-80 bg-gray-900 border-2 border-orange-600/50 rounded-lg shadow-2xl">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-600 to-red-600 p-4 rounded-t-lg flex items-center justify-between">
      <h3 class="text-white font-mono font-black flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        СООБЩЕНИЯ
      </h3>
      <button @click="closeChatList" class="text-white hover:text-gray-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Friends List -->
    <div class="max-h-96 overflow-y-auto bg-black/30">
      <div v-if="loadingFriends" class="p-8 text-center">
        <div class="text-orange-500 font-mono text-sm">ЗАГРУЗКА...</div>
      </div>
      <div v-else-if="friends.length === 0" class="p-8 text-center">
        <p class="text-gray-400 font-mono text-sm">Нет друзей для чата</p>
      </div>
      <div v-else>
        <button
          v-for="friend in friends"
          :key="friend.id"
          @click="openChat(friend)"
          class="w-full p-3 border-b border-orange-500/20 hover:bg-orange-500/10 transition-all flex items-center space-x-3"
        >
          <div class="relative">
            <img
              :src="getAvatarUrl(friend.avatar, friend.name)"
              :alt="friend.name"
              class="w-12 h-12 rounded-full border-2 border-orange-500 object-cover"
            />
            <div v-if="isOnline(friend.id)" class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
          </div>
          <div class="flex-1 text-left">
            <div class="text-white font-mono font-bold text-sm">{{ friend.name }}</div>
            <div class="text-gray-400 font-mono text-xs">{{ isOnline(friend.id) ? 'Онлайн' : 'Оффлайн' }}</div>
          </div>
          <div v-if="getUnreadForUser(friend.id) > 0" class="bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
            {{ getUnreadForUser(friend.id) }}
          </div>
        </button>
      </div>
    </div>
  </div>

  <!-- Mini Chat Window -->
  <div v-if="selectedFriend" class="fixed bottom-6 right-6 z-50 w-96 bg-gray-900 border-2 border-orange-600/50 rounded-lg shadow-2xl flex flex-col" style="height: 500px;">
    <!-- Chat Header -->
    <div class="bg-gradient-to-r from-orange-600 to-red-600 p-3 rounded-t-lg flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <img
          :src="getAvatarUrl(selectedFriend.avatar, selectedFriend.name)"
          :alt="selectedFriend.name"
          class="w-8 h-8 rounded-full border-2 border-white object-cover"
        />
        <div>
          <h3 class="text-white font-mono font-bold text-sm">{{ selectedFriend.name }}</h3>
          <div class="text-white/70 text-xs font-mono">{{ isOnline(selectedFriend.id) ? 'Онлайн' : 'Оффлайн' }}</div>
        </div>
      </div>
      <div class="flex space-x-2">
        <button @click="minimizeChat" class="text-white hover:text-gray-200" title="Свернуть">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
          </svg>
        </button>
        <button @click="closeChat" class="text-white hover:text-gray-200" title="Закрыть">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Messages Area -->
    <div ref="messagesContainer" class="flex-1 overflow-y-auto p-4 bg-black/30">
      <div v-if="loadingMessages" class="text-center py-8">
        <div class="text-orange-500 font-mono text-sm">ЗАГРУЗКА...</div>
      </div>
      <div v-else-if="messages.length === 0" class="text-center py-8">
        <p class="text-gray-400 font-mono text-sm">Начните переписку!</p>
      </div>
      <div v-else class="space-y-3">
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
              {{ message.message }}
            </div>
            <div class="text-xs text-gray-500 font-mono mt-1" :class="message.sender_id === currentUserId ? 'text-right' : ''">
              {{ formatTime(message.created_at) }}
            </div>
          </div>
        </div>
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
        />
        <button
          type="submit"
          :disabled="!newMessage.trim() || sending"
          class="px-4 py-2 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white text-xs font-bold font-mono rounded transition-all disabled:opacity-50"
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

const props = defineProps({
  currentUserId: {
    type: Number,
    required: true
  }
});

const showChatList = ref(false);
const selectedFriend = ref(null);
const friends = ref([]);
const messages = ref([]);
const newMessage = ref('');
const loadingFriends = ref(false);
const loadingMessages = ref(false);
const sending = ref(false);
const messagesContainer = ref(null);
const onlineUsers = ref([]);
const unreadCount = ref(0);
const unreadByUser = ref({}); // Хранит количество непрочитанных от каждого пользователя
const messagePollingInterval = ref(null);
const unreadPollingInterval = ref(null);

onMounted(() => {
  loadOnlineUsers();
  loadUnreadCount();
  loadUnreadByUser();

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
    loadFriends();
    loadUnreadByUser(); // Загружаем счётчики при открытии списка
  }
}

function closeChatList() {
  showChatList.value = false;
}

async function loadFriends() {
  loadingFriends.value = true;
  try {
    const response = await axios.get('/api/friends/');
    friends.value = response.data.friends || [];
  } catch (error) {
    console.error('Error loading friends:', error);
  } finally {
    loadingFriends.value = false;
  }
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
    console.log('Unread by user:', unreadByUser.value); // Для отладки
  } catch (error) {
    console.error('Error loading unread by user:', error);
  }
}

function openChat(friend) {
  selectedFriend.value = friend;
  showChatList.value = false;
  loadMessages();
  startMessagePolling();
}

function minimizeChat() {
  selectedFriend.value = null;
  stopMessagePolling();
  showChatList.value = true;
}

function closeChat() {
  selectedFriend.value = null;
  stopMessagePolling();
}

async function loadMessages() {
  if (!selectedFriend.value) return;

  loadingMessages.value = true;
  try {
    // Сначала получаем количество непрочитанных от этого пользователя
    const unreadCountForUser = getUnreadForUser(selectedFriend.value.id);
    console.log('Unread count for user:', unreadCountForUser);

    const response = await axios.get(`/api/messages/${selectedFriend.value.id}`);
    messages.value = response.data;

    // ВАЖНО: Сбрасываем флаг загрузки ДО поиска элементов
    loadingMessages.value = false;

    // Ждем рендеринга DOM - НЕСКОЛЬКО nextTick для гарантии
    await nextTick();
    await nextTick();
    await new Promise(resolve => setTimeout(resolve, 200));

    console.log('Messages container exists:', !!messagesContainer.value);

    // Если были непрочитанные, прокручиваем к первому непрочитанному
    if (unreadCountForUser > 0 && messagesContainer.value) {
      console.log('Total messages:', messages.value.length);

      // Ищем сообщения от собеседника (не от нас)
      const theirMessages = messages.value.filter(msg => msg.sender_id !== props.currentUserId);
      console.log('Their messages count:', theirMessages.length);

      // Первое непрочитанное = (всего сообщений от них) - (количество непрочитанных)
      const firstUnreadIndexAmongTheirs = Math.max(0, theirMessages.length - unreadCountForUser);
      const firstUnreadMessage = theirMessages[firstUnreadIndexAmongTheirs];

      console.log('First unread index among theirs:', firstUnreadIndexAmongTheirs);
      console.log('First unread message:', firstUnreadMessage);

      if (firstUnreadMessage) {
        // Находим индекс этого сообщения в общем массиве
        const messageIndex = messages.value.findIndex(msg => msg.id === firstUnreadMessage.id);
        console.log('Message index in full array:', messageIndex);

        if (messageIndex !== -1 && messagesContainer.value) {
          // Сразу проверяем, сколько элементов в контейнере
          const allElements = messagesContainer.value.querySelectorAll('[data-message-index]');
          console.log('Total elements with data-message-index:', allElements.length);
          console.log('Looking for index:', messageIndex);

          if (allElements.length > 0) {
            const existingIndexes = Array.from(allElements).map(el => el.getAttribute('data-message-index'));
            console.log('Existing indexes:', existingIndexes.join(', '));
          }

          // Ждем пока элемент появится в DOM (максимум 2 секунды)
          let targetElement = null;
          let attempts = 0;
          const maxAttempts = 20;

          while (!targetElement && attempts < maxAttempts) {
            targetElement = messagesContainer.value.querySelector(`[data-message-index="${messageIndex}"]`);

            if (!targetElement) {
              await new Promise(resolve => setTimeout(resolve, 100));
              attempts++;
              console.log(`Waiting for element, attempt ${attempts}/${maxAttempts}`);
            }
          }

          console.log('Found target element:', targetElement);

          if (targetElement) {
            console.log('Scrolling to element at index:', messageIndex);

            // Прокручиваем контейнер так, чтобы элемент был в начале видимой области
            const elementTop = targetElement.offsetTop;
            const offset = 20; // Небольшой отступ сверху

            messagesContainer.value.scrollTo({
              top: elementTop - offset,
              behavior: 'smooth'
            });

            // Небольшое выделение непрочитанного сообщения
            targetElement.style.transition = 'background-color 0.3s';
            targetElement.style.backgroundColor = 'rgba(249, 115, 22, 0.15)';
            setTimeout(() => {
              targetElement.style.backgroundColor = '';
            }, 2500);
          } else {
            console.log('Target element not found after waiting, scrolling to bottom');
            scrollToBottom();
          }
        }
      }
    } else {
      // Если нет непрочитанных, прокручиваем вниз как обычно
      console.log('No unread messages, scrolling to bottom');
      scrollToBottom();
    }

    // Обновляем счетчики после прочтения сообщений
    await loadUnreadCount();
    await loadUnreadByUser();
  } catch (error) {
    console.error('Error loading messages:', error);
    loadingMessages.value = false;
  }
}

async function sendMessage() {
  if (!newMessage.value.trim() || sending.value || !selectedFriend.value) return;

  sending.value = true;
  try {
    const response = await axios.post('/api/messages/send', {
      receiver_id: selectedFriend.value.id,
      message: newMessage.value
    });

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

function scrollToBottom() {
  if (messagesContainer.value) {
    // Используем smooth scroll для плавной прокрутки
    messagesContainer.value.scrollTo({
      top: messagesContainer.value.scrollHeight,
      behavior: 'smooth'
    });
  }
}

function startMessagePolling() {
  stopMessagePolling();
  messagePollingInterval.value = setInterval(async () => {
    if (selectedFriend.value) {
      try {
        const response = await axios.get(`/api/messages/${selectedFriend.value.id}`);
        const oldLength = messages.value.length;
        messages.value = response.data;

        // Прокручиваем вниз если появились новые сообщения
        if (response.data.length > oldLength) {
          await nextTick();
          await new Promise(resolve => setTimeout(resolve, 50));
          scrollToBottom();
        }
      } catch (error) {
        console.error('Error polling messages:', error);
      }
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
