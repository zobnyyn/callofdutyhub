<template>
  <Teleport to="body">
    <div v-if="show" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4" @click.self="$emit('close')">
      <div class="bg-gray-900 border border-orange-600/30 rounded-lg w-full max-w-4xl h-[600px] flex flex-col" role="dialog" aria-modal="true" :aria-label="`Chat with ${user.name}`">
        <!-- Header -->
        <div class="p-4 border-b border-orange-600/30 flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <img
              :src="getAvatarUrl(user.avatar)"
              :alt="user.name"
              class="w-10 h-10 rounded-full border-2 border-orange-500 object-cover"
            />
            <div>
              <div class="flex items-center gap-2 flex-wrap">
                <span v-if="user.admin_prefix" class="text-orange-500 text-sm font-bold font-mono">{{ user.admin_prefix }}</span>
                <h2 class="text-xl font-black font-mono text-orange-500" id="chat-title">
                  <span class="text-orange-600">&gt;</span> {{ user.name }}
                </h2>
                <span v-if="user.is_vip" class="text-yellow-400 text-sm" title="VIP пользователь">⭐</span>
              </div>
              <div class="flex items-center gap-2 mt-1">
                <span v-if="user.is_admin" class="px-1.5 py-0.5 bg-red-500/20 text-red-400 text-[10px] font-bold border border-red-500/30 font-mono">ADMIN</span>
                <span v-if="user.is_vip" class="px-1.5 py-0.5 bg-yellow-500/20 text-yellow-400 text-[10px] font-bold border border-yellow-500/30 font-mono">VIP</span>
                <div class="text-xs text-gray-400 font-mono">SECURE_CHAT</div>
              </div>
            </div>
          </div>
          <button
            @click="$emit('close')"
            class="text-gray-400 hover:text-orange-500 transition-colors"
            aria-label="Close chat"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Messages Area -->
        <div ref="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-black/30">
          <div v-if="loading" class="text-center py-12">
            <div class="text-orange-500 font-mono">ЗАГРУЗКА...</div>
          </div>
          <div v-else-if="messages.length === 0" class="text-center py-12">
            <p class="text-gray-400 font-mono">Нет сообщений. Начните переписку!</p>
          </div>
          <div v-else v-for="message in messages" :key="message.id">
            <!-- My Message -->
            <div v-if="message.sender_id === currentUserId" class="flex justify-end">
              <div class="max-w-[70%]">
                <div class="flex items-start space-x-2 mb-1 justify-end">
                  <div class="text-right">
                    <div class="flex items-center gap-1.5 flex-wrap justify-end mb-0.5">
                      <span v-if="message.sender?.admin_prefix" class="text-orange-500 text-[10px] font-bold font-mono">{{ message.sender.admin_prefix }}</span>
                      <p class="text-orange-500 text-xs font-mono font-bold">
                        {{ message.sender?.name || 'Вы' }}
                      </p>
                      <span v-if="message.sender?.is_vip" class="text-yellow-400 text-xs" title="VIP пользователь">⭐</span>
                    </div>
                    <div class="flex items-center gap-1.5 justify-end">
                      <span v-if="message.sender?.is_admin" class="px-1 py-0.5 bg-red-500/20 text-red-400 text-[8px] font-bold border border-red-500/30 font-mono">ADMIN</span>
                      <span v-if="message.sender?.is_vip" class="px-1 py-0.5 bg-yellow-500/20 text-yellow-400 text-[8px] font-bold border border-yellow-500/30 font-mono">VIP</span>
                    </div>
                  </div>
                  <div class="w-8 h-8 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img v-if="message.sender?.avatar" :src="getAvatarUrl(message.sender.avatar)" :alt="message.sender?.name" class="w-full h-full object-cover">
                    <span v-else class="text-orange-500 text-xs font-bold font-mono">
                      {{ message.sender?.name?.charAt(0).toUpperCase() || '?' }}
                    </span>
                  </div>
                </div>
                <div class="bg-gradient-to-r from-orange-600 to-red-600 text-white p-3 rounded-lg font-mono text-sm break-words">
                  {{ message.message }}
                </div>
                <div class="text-xs text-gray-500 font-mono mt-1 text-right">
                  {{ formatTime(message.created_at) }}
                </div>
              </div>
            </div>
            <!-- Their Message -->
            <div v-else class="flex justify-start">
              <div class="max-w-[70%]">
                <div class="flex items-start space-x-2 mb-1">
                  <div class="w-8 h-8 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img v-if="message.sender?.avatar" :src="getAvatarUrl(message.sender.avatar)" :alt="message.sender?.name" class="w-full h-full object-cover">
                    <span v-else class="text-orange-500 text-xs font-bold font-mono">
                      {{ message.sender?.name?.charAt(0).toUpperCase() || '?' }}
                    </span>
                  </div>
                  <div>
                    <div class="flex items-center gap-1.5 flex-wrap mb-0.5">
                      <span v-if="message.sender?.admin_prefix" class="text-orange-500 text-[10px] font-bold font-mono">{{ message.sender.admin_prefix }}</span>
                      <p class="text-orange-500 text-xs font-mono font-bold">
                        {{ message.sender?.name || 'Пользователь' }}
                      </p>
                      <span v-if="message.sender?.is_vip" class="text-yellow-400 text-xs" title="VIP пользователь">⭐</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span v-if="message.sender?.is_admin" class="px-1 py-0.5 bg-red-500/20 text-red-400 text-[8px] font-bold border border-red-500/30 font-mono">ADMIN</span>
                      <span v-if="message.sender?.is_vip" class="px-1 py-0.5 bg-yellow-500/20 text-yellow-400 text-[8px] font-bold border border-yellow-500/30 font-mono">VIP</span>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-800 text-white p-3 rounded-lg font-mono text-sm border border-orange-500/30 break-words">
                  {{ message.message }}
                </div>
                <div class="text-xs text-gray-500 font-mono mt-1">
                  {{ formatTime(message.created_at) }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-orange-600/30 bg-gray-900">
          <form @submit.prevent="sendMessage" class="flex space-x-3">
            <input
              ref="inputEl"
              v-model="newMessage"
              type="text"
              placeholder="Введите сообщение..."
              maxlength="1000"
              class="flex-1 px-4 py-2 bg-black border border-orange-600/30 rounded text-white font-mono focus:border-orange-500 focus:outline-none"
              :aria-label="`Message to ${user.name}`"
            />
            <button
              type="submit"
              :disabled="!newMessage.trim() || sending"
              class="px-6 py-2 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono transition-all disabled:opacity-50 disabled:cursor-not-allowed"
              aria-label="Send message"
            >
              {{ sending ? 'ОТПРАВКА...' : 'ОТПРАВИТЬ' }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, watch, nextTick, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  show: Boolean,
  user: {
    type: Object,
    required: true
  },
  currentUserId: {
    type: Number,
    required: true
  }
});

const emit = defineEmits(['close']);

const messages = ref([]);
const newMessage = ref('');
const loading = ref(false);
const sending = ref(false);
const messagesContainer = ref(null);
const inputEl = ref(null);
let pollingInterval = null;

// Загружаем сообщения при монтировании, если чат уже открыт
onMounted(() => {
  console.log('ChatModal opened with user data:', props.user);
  console.log('User admin_prefix:', props.user.admin_prefix);
  console.log('User is_admin:', props.user.is_admin);
  console.log('User is_vip:', props.user.is_vip);

  if (props.show) {
    loadMessages();
    startPolling();
  }
});

watch(() => props.show, (newVal) => {
  if (newVal) {
    console.log('ChatModal show changed, user data:', props.user);
    loadMessages();
    startPolling();
    // Фокусируем поле ввода, когда модал открыт
    setTimeout(() => {
      inputEl.value?.focus();
    }, 50);
  } else {
    stopPolling();
  }
});

function getAvatarUrl(avatar) {
  if (!avatar || avatar === 'null' || avatar === '0' || avatar === 0) {
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(props.user.name) + '&background=ea580c&color=fff';
  }
  if (avatar.startsWith('http')) {
    return avatar;
  }
  return '/storage/' + avatar;
}

async function loadMessages() {
  loading.value = true;
  try {
    const response = await axios.get(`/api/messages/${props.user.id}`);
    messages.value = response.data;

    // Детальное логирование для отладки
    console.log('Loaded messages:', response.data);
    if (response.data.length > 0) {
      console.log('First message sender:', response.data[0].sender);
      console.log('First message sender admin_prefix:', response.data[0].sender?.admin_prefix);
      console.log('First message sender is_admin:', response.data[0].sender?.is_admin);
      console.log('First message sender is_vip:', response.data[0].sender?.is_vip);
    }

    await nextTick();
    scrollToBottom();
  } catch (error) {
    console.error('Error loading messages:', error);
    if (error.response?.status === 403) {
      alert('Ошибка: ' + (error.response.data?.error || 'Вы можете писать только друзьям'));
    }
  } finally {
    loading.value = false;
  }
}

async function sendMessage() {
  if (!newMessage.value.trim() || sending.value) return;

  sending.value = true;
  try {
    const response = await axios.post('/api/messages/send', {
      receiver_id: props.user.id,
      message: newMessage.value
    });

    messages.value.push(response.data);
    newMessage.value = '';
    await nextTick();
    scrollToBottom();
  } catch (error) {
    console.error('Error sending message:', error);
    alert(error.response?.data?.error || error.response?.data?.message || 'Ошибка при отправке сообщения');
  } finally {
    sending.value = false;
  }
}

function scrollToBottom() {
  if (messagesContainer.value) {
    messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
  }
}

function formatTime(dateString) {
  const date = new Date(dateString);
  const now = new Date();
  const diffInSeconds = Math.floor((now - date) / 1000);

  if (diffInSeconds < 60) {
    return 'только что';
  } else if (diffInSeconds < 3600) {
    const minutes = Math.floor(diffInSeconds / 60);
    return `${minutes} мин назад`;
  } else if (diffInSeconds < 86400) {
    const hours = Math.floor(diffInSeconds / 3600);
    return `${hours} ч назад`;
  } else {
    return date.toLocaleDateString('ru-RU', {
      day: 'numeric',
      month: 'short',
      hour: '2-digit',
      minute: '2-digit'
    });
  }
}

function startPolling() {
  pollingInterval = setInterval(async () => {
    if (props.show) {
      try {
        const response = await axios.get(`/api/messages/${props.user.id}`);
        const oldLength = messages.value.length;
        messages.value = response.data;

        if (response.data.length > oldLength) {
          await nextTick();
          scrollToBottom();
        }
      } catch (error) {
        console.error('Error polling messages:', error);
      }
    }
  }, 3000);
}

function stopPolling() {
  if (pollingInterval) {
    clearInterval(pollingInterval);
    pollingInterval = null;
  }
}
</script>
