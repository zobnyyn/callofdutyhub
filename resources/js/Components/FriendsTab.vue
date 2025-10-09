<template>
  <div class="space-y-6">
    <!-- Кнопка добавления в друзья (если это чужой профиль) -->
    <div v-if="!isOwnProfile && currentUser" class="border border-orange-500/30 bg-orange-500/5 p-6">
      <div class="flex items-center justify-between">
        <div>
          <div class="text-orange-600 font-mono text-sm mb-2">
            <span class="text-orange-600 mr-2">&gt;</span> FRIENDSHIP_STATUS:
          </div>
          <div class="text-white font-mono text-lg">
            {{ getFriendshipStatusText() }}
          </div>
        </div>

        <!-- Кнопки действий -->
        <div class="flex gap-2">
          <!-- Отправить запрос -->
          <button
            v-if="friendshipStatus === 'none'"
            @click="sendFriendRequest"
            :disabled="isLoading"
            class="px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-mono font-bold transition-all disabled:opacity-50"
          >
            <span class="text-white">&gt;</span> ADD_FRIEND
          </button>

          <!-- Запрос отправлен -->
          <button
            v-if="friendshipStatus === 'request_sent'"
            @click="cancelFriendRequest"
            :disabled="isLoading"
            class="px-6 py-3 bg-gray-600 hover:bg-gray-500 text-white font-mono transition-all disabled:opacity-50"
          >
            <span class="text-white">&gt;</span> CANCEL_REQUEST
          </button>

          <!-- Входящий запрос -->
          <template v-if="friendshipStatus === 'request_received'">
            <button
              @click="acceptFriendRequest"
              :disabled="isLoading"
              class="px-6 py-3 bg-green-600 hover:bg-green-500 text-white font-mono font-bold transition-all disabled:opacity-50"
            >
              <span class="text-white">&gt;</span> ACCEPT
            </button>
            <button
              @click="declineFriendRequest"
              :disabled="isLoading"
              class="px-4 py-3 bg-red-600 hover:bg-red-500 text-white font-mono transition-all disabled:opacity-50"
            >
              DECLINE
            </button>
          </template>

          <!-- Уже друзья -->
          <button
            v-if="friendshipStatus === 'friends'"
            @click="removeFriend"
            :disabled="isLoading"
            class="px-6 py-3 bg-red-600/20 border border-red-500/30 text-red-500 hover:bg-red-500/30 font-mono transition-all disabled:opacity-50"
          >
            <span class="text-red-600">&gt;</span> REMOVE_FRIEND
          </button>
        </div>
      </div>
    </div>

    <!-- Секция входящих запросов (только для своего профиля) -->
    <div v-if="isOwnProfile && pendingRequests.length > 0" class="border border-orange-500/30 bg-orange-500/5 p-6">
      <div class="text-orange-600 font-mono text-sm mb-6 flex items-center justify-between">
        <span>
          <span class="text-orange-600 mr-2">&gt;</span> INCOMING_REQUESTS:
          <span class="text-orange-500 ml-2">({{ pendingRequests.length }})</span>
        </span>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div
          v-for="request in pendingRequests"
          :key="request.id"
          class="border border-orange-500/30 bg-black/30 p-4"
        >
          <div class="flex items-center gap-4">
            <a :href="`/profile/${request.id}`" class="flex-shrink-0">
              <img
                :src="getAvatarUrl(request.avatar, request.name)"
                :alt="request.name"
                class="w-12 h-12 rounded-full border-2 border-orange-500/50 object-cover hover:border-orange-500 transition-colors"
              />
            </a>

            <div class="flex-1 min-w-0">
              <a :href="`/profile/${request.id}`" class="text-white font-mono font-bold text-sm truncate hover:text-orange-400 transition-colors block">
                {{ request.name }}
              </a>
              <div class="text-gray-500 font-mono text-xs mt-1">
                {{ formatDate(request.pivot?.created_at) }}
              </div>
            </div>

            <div class="flex gap-2 flex-shrink-0">
              <button
                @click="acceptRequest(request.id)"
                class="px-3 py-2 bg-green-600 hover:bg-green-500 text-white font-mono text-xs transition-all"
                title="Accept"
              >
                ✓
              </button>
              <button
                @click="declineRequest(request.id)"
                class="px-3 py-2 bg-red-600 hover:bg-red-500 text-white font-mono text-xs transition-all"
                title="Decline"
              >
                ✗
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Список друзей -->
    <div class="border border-orange-500/30 bg-orange-500/5 p-6">
      <div class="text-orange-600 font-mono text-sm mb-6 flex items-center justify-between">
        <span>
          <span class="text-orange-600 mr-2">&gt;</span> FRIENDS_LIST:
          <span class="text-gray-500 ml-2">({{ friends.length }})</span>
        </span>
        <button
          @click="loadFriends"
          class="px-3 py-1 bg-orange-500/20 border border-orange-500/30 text-orange-500 text-xs hover:bg-orange-500/30 transition-all"
          :disabled="isLoading"
        >
          <span v-if="!isLoading">↻ REFRESH</span>
          <span v-else>LOADING...</span>
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="isLoading && friends.length === 0" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-orange-500 border-t-transparent"></div>
        <div class="text-orange-500 font-mono text-sm mt-4">
          <span class="text-orange-600">&gt;</span> LOADING_FRIENDS...
        </div>
      </div>

      <!-- Empty State -->
      <div v-else-if="friends.length === 0" class="text-center py-12">
        <svg class="w-16 h-16 mx-auto text-orange-500/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <div class="text-gray-500 font-mono text-sm">
          <span class="text-orange-600">&gt;</span> NO_FRIENDS_YET
        </div>
        <div class="text-gray-600 font-mono text-xs mt-2">
          {{ isOwnProfile ? 'Начните добавлять друзей!' : 'У этого пользователя пока нет друзей' }}
        </div>
      </div>

      <!-- Friends Grid -->
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          v-for="friend in friends"
          :key="friend.id"
          class="group border border-orange-500/30 bg-black/30 hover:bg-orange-500/10 hover:border-orange-500 transition-all p-4"
        >
          <a :href="`/profile/${friend.id}`" class="flex items-center gap-4 mb-3">
            <!-- Avatar -->
            <div class="relative flex-shrink-0">
              <img
                :src="getAvatarUrl(friend.avatar, friend.name)"
                :alt="friend.name"
                class="w-14 h-14 rounded-full border-2 border-orange-500/50 object-cover group-hover:border-orange-500 transition-colors"
              />
              <!-- Online indicator -->
              <div v-if="isOnline(friend.id)" class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-black"></div>
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
              <div class="text-orange-600 font-mono text-xs mb-1">
                <span class="text-orange-600">&gt;</span> FRIEND
              </div>
              <h3 class="text-white font-mono font-bold text-sm truncate group-hover:text-orange-400 transition-colors">
                {{ friend.name }}
              </h3>
              <div class="text-gray-500 font-mono text-xs mt-1">
                ID: #{{ friend.id }}
              </div>
            </div>
          </a>

          <!-- Chat Button -->
          <button
            v-if="isOwnProfile"
            @click="openChat(friend)"
            class="w-full px-3 py-2 bg-orange-600/20 border border-orange-500/30 text-orange-500 text-xs font-mono hover:bg-orange-500/30 transition-all flex items-center justify-center gap-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span class="text-orange-600">&gt;</span> НАПИСАТЬ
          </button>
        </div>
      </div>
    </div>

    <!-- Chat Modal -->
    <ChatModal
      v-if="selectedFriend"
      :show="showChat"
      :user="selectedFriend"
      :currentUserId="currentUser?.id || userId"
      @close="closeChat"
    />
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import ChatModal from './ChatModal.vue';

const props = defineProps({
  userId: {
    type: Number,
    required: true
  },
  isOwnProfile: {
    type: Boolean,
    default: false
  },
  currentUser: {
    type: Object,
    default: null
  }
});

const friends = ref([]);
const pendingRequests = ref([]);
const friendshipStatus = ref('none');
const isLoading = ref(false);
const onlineUsers = ref([]);
const showChat = ref(false);
const selectedFriend = ref(null);

const loadFriends = async () => {
  isLoading.value = true;
  try {
    const response = await axios.get('/api/friends/');
    friends.value = response.data.friends || [];
  } catch (error) {
    console.error('Error loading friends:', error);
  } finally {
    isLoading.value = false;
  }
};

const loadPendingRequests = async () => {
  if (!props.isOwnProfile) return;

  try {
    const response = await axios.get('/api/friends/requests');
    pendingRequests.value = response.data.requests || [];
  } catch (error) {
    console.error('Error loading pending requests:', error);
  }
};

const loadFriendshipStatus = async () => {
  if (props.isOwnProfile || !props.currentUser) return;

  try {
    const response = await axios.get(`/api/friends/status/${props.userId}`);
    friendshipStatus.value = response.data.status;
  } catch (error) {
    console.error('Error loading friendship status:', error);
  }
};

const loadOnlineUsers = async () => {
  try {
    const response = await axios.get('/api/online-users');
    onlineUsers.value = response.data.users || [];
  } catch (error) {
    console.error('Error loading online users:', error);
  }
};

const sendFriendRequest = async () => {
  isLoading.value = true;
  try {
    const response = await axios.post('/api/friends/send', {
      friend_id: props.userId
    });

    if (response.data.success) {
      friendshipStatus.value = response.data.status;
      alert(response.data.message);
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка при отправке запроса');
  } finally {
    isLoading.value = false;
  }
};

const acceptFriendRequest = async () => {
  isLoading.value = true;
  try {
    const response = await axios.post('/api/friends/accept', {
      user_id: props.userId
    });

    if (response.data.success) {
      friendshipStatus.value = response.data.status;
      alert(response.data.message);
      await loadFriends();
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка при принятии запроса');
  } finally {
    isLoading.value = false;
  }
};

const declineFriendRequest = async () => {
  isLoading.value = true;
  try {
    const response = await axios.post('/api/friends/decline', {
      user_id: props.userId
    });

    if (response.data.success) {
      friendshipStatus.value = 'none';
      alert(response.data.message);
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка при отклонении запроса');
  } finally {
    isLoading.value = false;
  }
};

const cancelFriendRequest = async () => {
  if (!confirm('Отменить запрос в друзья?')) return;

  isLoading.value = true;
  try {
    const response = await axios.delete('/api/friends/remove', {
      data: { friend_id: props.userId }
    });

    if (response.data.success) {
      friendshipStatus.value = 'none';
      alert(response.data.message);
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка при отмене запроса');
  } finally {
    isLoading.value = false;
  }
};

const removeFriend = async () => {
  if (!confirm('Удалить из друзей?')) return;

  isLoading.value = true;
  try {
    const response = await axios.delete('/api/friends/remove', {
      data: { friend_id: props.userId }
    });

    if (response.data.success) {
      friendshipStatus.value = 'none';
      alert(response.data.message);
      await loadFriends();
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка при удалении из друзей');
  } finally {
    isLoading.value = false;
  }
};

const acceptRequest = async (userId) => {
  try {
    const response = await axios.post('/api/friends/accept', {
      user_id: userId
    });

    if (response.data.success) {
      await loadPendingRequests();
      await loadFriends();
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка');
  }
};

const declineRequest = async (userId) => {
  try {
    const response = await axios.post('/api/friends/decline', {
      user_id: userId
    });

    if (response.data.success) {
      await loadPendingRequests();
    }
  } catch (error) {
    alert(error.response?.data?.message || 'Ошибка');
  }
};

const getFriendshipStatusText = () => {
  const statusMap = {
    'none': 'Не в друзьях',
    'request_sent': 'Запрос отправлен',
    'request_received': 'Входящий запрос',
    'friends': 'В друзьях',
    'blocked': 'Заблокирован'
  };
  return statusMap[friendshipStatus.value] || 'Неизвестно';
};

const getAvatarUrl = (avatar, name) => {
  if (!avatar || avatar === 'null' || avatar === '0' || avatar === 0) {
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name) + '&background=ea580c&color=fff';
  }
  if (avatar.startsWith('http')) {
    return avatar;
  }
  return '/storage/' + avatar;
};

const isOnline = (userId) => {
  return onlineUsers.value.some(user => user.id === userId);
};

const formatDate = (dateString) => {
  if (!dateString) return '';
  const date = new Date(dateString);
  const now = new Date();
  const diffMs = now - date;
  const diffMins = Math.floor(diffMs / 60000);

  if (diffMins < 1) return 'Только что';
  if (diffMins < 60) return `${diffMins} мин. назад`;
  if (diffMins < 1440) return `${Math.floor(diffMins / 60)} ч. назад`;
  return `${Math.floor(diffMins / 1440)} дн. назад`;
};

const openChat = (friend) => {
  selectedFriend.value = friend;
  showChat.value = true;
};

const closeChat = () => {
  showChat.value = false;
  selectedFriend.value = null;
};

onMounted(async () => {
  await Promise.all([
    loadFriends(),
    loadPendingRequests(),
    loadFriendshipStatus(),
    loadOnlineUsers()
  ]);

  // Обновляем онлайн статус каждые 30 секунд
  setInterval(loadOnlineUsers, 30000);
});
</script>

<style scoped>
@keyframes spin {
  to { transform: rotate(360deg); }
}

.animate-spin {
  animation: spin 1s linear infinite;
}
</style>
