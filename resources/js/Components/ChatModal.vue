<template>
  <Teleport to="body">
    <div v-if="show" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4" @click.self="$emit('close')">
      <div class="bg-gray-900 border border-orange-600/30 rounded-lg w-full max-w-4xl h-[600px] flex flex-col">
        <!-- Header -->
        <div class="p-4 border-b border-orange-600/30 flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <img
              :src="getAvatarUrl(user.avatar)"
              :alt="user.name"
              class="w-10 h-10 rounded-full border-2 border-orange-500 object-cover"
            />
            <div>
              <h2 class="text-xl font-black font-mono text-orange-500">
                <span class="text-orange-600">&gt;</span> {{ user.name }}
              </h2>
              <div class="text-xs text-gray-400 font-mono">SECURE_CHAT</div>
            </div>
          </div>
          <button
            @click="$emit('close')"
            class="text-gray-400 hover:text-orange-500 transition-colors"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="bg-gradient-to-r from-orange-600 to-red-600 text-white p-3 rounded-lg font-mono text-sm">
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
                <div class="bg-gray-800 text-white p-3 rounded-lg font-mono text-sm border border-orange-500/30">
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
              v-model="newMessage"
              type="text"
              placeholder="Введите сообщение..."
              maxlength="1000"
              class="flex-1 px-4 py-2 bg-black border border-orange-600/30 rounded text-white font-mono focus:border-orange-500 focus:outline-none"
            />
            <button
              type="submit"
              :disabled="!newMessage.trim() || sending"
              class="px-6 py-2 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono transition-all disabled:opacity-50 disabled:cursor-not-allowed"
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
let pollingInterval = null;

// Загружаем сообщения при монтировании, если чат уже открыт
onMounted(() => {
  if (props.show) {
    console.log('ChatModal mounted with show=true, loading messages...');
    loadMessages();
    startPolling();
  }
});

watch(() => props.show, (newVal) => {
  console.log('Show changed to:', newVal);
  if (newVal) {
    console.log('Chat opened, loading messages...');
    loadMessages();
    startPolling();
  } else {
    console.log('Chat closed, stopping polling...');
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
    console.log('Loading messages for user:', props.user.id);
    const response = await axios.get(`/api/messages/${props.user.id}`);
    console.log('Messages loaded:', response.data);
    messages.value = response.data;
    await nextTick();
    scrollToBottom();
  } catch (error) {
    console.error('Error loading messages:', error);
    console.error('Error response:', error.response?.data);
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
    console.log('Sending message to user:', props.user.id, 'message:', newMessage.value);
    const response = await axios.post('/api/messages/send', {
      receiver_id: props.user.id,
      message: newMessage.value
    });

    console.log('Message sent successfully:', response.data);
    messages.value.push(response.data);
    newMessage.value = '';
    await nextTick();
    scrollToBottom();
  } catch (error) {
    console.error('Error sending message:', error);
    console.error('Error response:', error.response?.data);
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
  // Обновляем сообщения каждые 3 секунды
  pollingInterval = setInterval(async () => {
    if (props.show) {
      try {
        const response = await axios.get(`/api/messages/${props.user.id}`);
        const oldLength = messages.value.length;
        messages.value = response.data;

        // Прокручиваем вниз если появились новые сообщения
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
