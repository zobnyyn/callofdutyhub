<template>
  <div class="relative" ref="notificationContainer">
    <!-- Notification Bell Button -->
    <button
      @click="toggleNotifications"
      class="relative p-2 text-orange-500 hover:bg-orange-500/10 transition-all border border-orange-500/30 hover:border-orange-500"
      :class="{ 'bg-orange-500/10': showNotifications }"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
      </svg>

      <!-- Unread Badge -->
      <span
        v-if="unreadCount > 0"
        class="absolute -top-1 -right-1 px-1.5 py-0.5 bg-red-600 text-white text-[10px] font-bold font-mono rounded-full min-w-[18px] text-center animate-pulse"
      >
        {{ unreadCount > 99 ? '99+' : unreadCount }}
      </span>
    </button>

    <!-- Notifications Dropdown -->
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-if="showNotifications"
        class="absolute right-0 mt-2 w-96 max-h-[600px] overflow-hidden bg-black border-2 border-orange-500/50 shadow-2xl z-50"
      >
        <!-- Header -->
        <div class="p-4 border-b border-orange-500/30 bg-orange-500/5">
          <div class="flex items-center justify-between mb-2">
            <div class="text-orange-600 font-mono text-sm font-bold">
              <span class="text-orange-600">&gt;</span> NOTIFICATIONS
            </div>
            <div class="flex gap-2">
              <button
                v-if="notifications.length > 0"
                @click="markAllAsRead"
                class="px-2 py-1 text-xs font-mono text-orange-500 hover:bg-orange-500/10 border border-orange-500/30 transition-all"
                title="Mark all as read"
              >
                ✓ ALL
              </button>
              <button
                v-if="notifications.some(n => n.read)"
                @click="clearReadNotifications"
                class="px-2 py-1 text-xs font-mono text-gray-500 hover:bg-gray-500/10 border border-gray-500/30 transition-all"
                title="Clear read"
              >
                CLEAR
              </button>
            </div>
          </div>
          <div class="text-gray-500 font-mono text-xs">
            {{ unreadCount }} непрочитанных
          </div>
        </div>

        <!-- Notifications List -->
        <div class="overflow-y-auto max-h-[500px]">
          <!-- Loading State -->
          <div v-if="isLoading" class="p-8 text-center">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-orange-500 border-t-transparent"></div>
            <div class="text-orange-500 font-mono text-sm mt-2">LOADING...</div>
          </div>

          <!-- Empty State -->
          <div v-else-if="notifications.length === 0" class="p-8 text-center">
            <svg class="w-12 h-12 mx-auto text-orange-500/30 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <div class="text-gray-500 font-mono text-sm">
              <span class="text-orange-600">&gt;</span> NO_NOTIFICATIONS
            </div>
          </div>

          <!-- Notification Items -->
          <div v-else>
            <div
              v-for="notification in notifications"
              :key="notification.id"
              class="p-4 border-b border-orange-500/10 hover:bg-orange-500/5 transition-all"
              :class="{ 'bg-orange-500/10': !notification.read }"
            >
              <div class="flex items-start gap-3">
                <!-- Avatar -->
                <a
                  v-if="notification.from_user"
                  :href="`/profile/${notification.from_user.id}`"
                  class="flex-shrink-0"
                >
                  <img
                    :src="getAvatarUrl(notification.from_user.avatar, notification.from_user.name)"
                    :alt="notification.from_user.name"
                    class="w-10 h-10 rounded-full border-2 border-orange-500/50 object-cover hover:border-orange-500 transition-colors"
                  />
                </a>

                <!-- Icon for system notifications -->
                <div v-else class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                  </svg>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                  <p class="text-white font-mono text-sm mb-1" :class="{ 'font-bold': !notification.read }">
                    {{ notification.message }}
                  </p>
                  <div class="text-gray-500 font-mono text-xs mb-2">
                    {{ formatDate(notification.created_at) }}
                  </div>

                  <!-- Action Buttons for friend requests -->
                  <div v-if="notification.type === 'friend_request' && !isRequestProcessed(notification)" class="flex gap-2 mt-2">
                    <button
                      @click.stop="acceptFriendRequest(notification)"
                      class="px-3 py-1 bg-green-600 hover:bg-green-500 text-white font-mono text-xs transition-all flex items-center gap-1"
                    >
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      ACCEPT
                    </button>
                    <button
                      @click.stop="declineFriendRequest(notification)"
                      class="px-3 py-1 bg-red-600 hover:bg-red-500 text-white font-mono text-xs transition-all flex items-center gap-1"
                    >
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                      DECLINE
                    </button>
                  </div>

                  <!-- Message for processed requests -->
                  <div v-else-if="notification.type === 'friend_request' && isRequestProcessed(notification)" class="mt-2">
                    <div class="text-gray-500 font-mono text-xs italic">
                      <span class="text-orange-600">&gt;</span> Запрос уже обработан
                    </div>
                  </div>

                  <!-- Link to profile for accepted requests -->
                  <div v-else-if="notification.type === 'friend_accepted'" class="mt-2">
                    <a
                      :href="`/profile/${notification.from_user?.id}`"
                      class="inline-block px-3 py-1 bg-orange-600/20 border border-orange-500/30 text-orange-500 hover:bg-orange-500/30 font-mono text-xs transition-all"
                    >
                      <span class="text-orange-600">&gt;</span> VIEW_PROFILE
                    </a>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col items-center gap-1 flex-shrink-0">
                  <!-- Mark as read/unread -->
                  <button
                    v-if="!notification.read"
                    @click.stop="markAsRead(notification.id)"
                    class="p-1 text-green-500 hover:bg-green-500/10 transition-all"
                    title="Mark as read"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>

                  <!-- Delete -->
                  <button
                    @click.stop="deleteNotification(notification.id)"
                    class="p-1 text-red-500 hover:bg-red-500/10 transition-all"
                    title="Delete"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import axios from 'axios';

const showNotifications = ref(false);
const notifications = ref([]);
const isLoading = ref(false);
const notificationContainer = ref(null);
const friendshipStatuses = ref({}); // Хранит статусы дружбы для каждого пользователя

const unreadCount = computed(() => {
  return notifications.value.filter(n => !n.read).length;
});

// Проверяем, был ли запрос уже обработан
const isRequestProcessed = (notification) => {
  if (notification.type !== 'friend_request' || !notification.from_user) {
    return false;
  }

  const status = friendshipStatuses.value[notification.from_user.id];
  // Если статус 'friends' или 'none' - значит запрос уже обработан
  // Если статус 'request_sent' - пользователь отправил встречный запрос
  return status && status !== 'request_received';
};

// Загружаем статусы дружбы для всех уведомлений о запросах в друзья
const loadFriendshipStatuses = async () => {
  const friendRequests = notifications.value.filter(n =>
    n.type === 'friend_request' && n.from_user
  );

  for (const notification of friendRequests) {
    try {
      const response = await axios.get(`/api/friends/status/${notification.from_user.id}`);
      friendshipStatuses.value[notification.from_user.id] = response.data.status;
    } catch (error) {
      console.error('Error loading friendship status:', error);
    }
  }
};

const loadNotifications = async () => {
  isLoading.value = true;
  try {
    const response = await axios.get('/api/notifications/');
    notifications.value = response.data.notifications || [];

    // Загружаем статусы дружбы после загрузки уведомлений
    await loadFriendshipStatuses();
  } catch (error) {
    console.error('Error loading notifications:', error);
  } finally {
    isLoading.value = false;
  }
};

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value;
  if (showNotifications.value && notifications.value.length === 0) {
    loadNotifications();
  }
};

const markAsRead = async (id) => {
  try {
    await axios.post(`/api/notifications/${id}/read`);
    const notification = notifications.value.find(n => n.id === id);
    if (notification) {
      notification.read = true;
    }
  } catch (error) {
    console.error('Error marking notification as read:', error);
  }
};

const markAllAsRead = async () => {
  try {
    await axios.post('/api/notifications/read-all');
    notifications.value.forEach(n => n.read = true);
  } catch (error) {
    console.error('Error marking all as read:', error);
  }
};

const deleteNotification = async (id) => {
  try {
    await axios.delete(`/api/notifications/${id}`);
    notifications.value = notifications.value.filter(n => n.id !== id);
  } catch (error) {
    console.error('Error deleting notification:', error);
  }
};

const clearReadNotifications = async () => {
  try {
    await axios.delete('/api/notifications/clear/read');
    notifications.value = notifications.value.filter(n => !n.read);
  } catch (error) {
    console.error('Error clearing read notifications:', error);
  }
};

const handleNotificationClick = (notification) => {
  // Mark as read
  if (!notification.read) {
    markAsRead(notification.id);
  }

  // Navigate based on notification type
  if (notification.type === 'friend_request' || notification.type === 'friend_accepted') {
    if (notification.from_user) {
      window.location.href = `/profile/${notification.from_user.id}`;
    }
  }
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

// Accept friend request directly from notification
const acceptFriendRequest = async (notification) => {
  if (!notification.from_user) return;

  try {
    const response = await axios.post('/api/friends/accept', {
      user_id: notification.from_user.id
    });

    if (response.data.success) {
      // Mark notification as read instead of deleting
      await markAsRead(notification.id);

      // Обновляем статус дружбы
      friendshipStatuses.value[notification.from_user.id] = 'friends';

      // Show success message
      alert('Запрос в друзья принят! ✓');

      // Reload notifications to get updated list
      await loadNotifications();
    }
  } catch (error) {
    console.error('Error accepting friend request:', error);

    // Если запрос не найден (уже принят/отклонен), просто помечаем уведомление как прочитанное
    if (error.response?.status === 404 || error.response?.data?.message?.includes('не найден')) {
      await markAsRead(notification.id);

      // Обновляем статус - запрос уже обработан
      friendshipStatuses.value[notification.from_user.id] = 'none';

      alert('Запрос уже был обработан ранее');
      await loadNotifications();
    } else {
      alert(error.response?.data?.message || 'Ошибка при принятии запроса');
    }
  }
};

// Decline friend request directly from notification
const declineFriendRequest = async (notification) => {
  if (!notification.from_user) return;

  if (!confirm('Отклонить запрос в друзья?')) return;

  try {
    const response = await axios.post('/api/friends/decline', {
      user_id: notification.from_user.id
    });

    if (response.data.success) {
      // Mark notification as read вместо удаления
      await markAsRead(notification.id);

      // Обновляем статус дружбы
      friendshipStatuses.value[notification.from_user.id] = 'none';

      // Show success message
      alert('Запрос отклонен');

      // Reload notifications
      await loadNotifications();
    }
  } catch (error) {
    console.error('Error declining friend request:', error);

    // Если запрос не найден (уже принят/отклонен), просто помечаем уведомление как прочитанное
    if (error.response?.status === 404 || error.response?.data?.message?.includes('не найден')) {
      await markAsRead(notification.id);

      // Обновляем статус - запрос уже обработан
      friendshipStatuses.value[notification.from_user.id] = 'none';

      alert('Запрос уже был обработан ранее');
      await loadNotifications();
    } else {
      alert(error.response?.data?.message || 'Ошибка при отклонении запроса');
    }
  }
};

// Close dropdown when clicking outside
const handleClickOutside = (event) => {
  if (notificationContainer.value && !notificationContainer.value.contains(event.target)) {
    showNotifications.value = false;
  }
};

onMounted(() => {
  // Load initial count
  loadNotifications();

  // Refresh notifications every 30 seconds
  const interval = setInterval(loadNotifications, 30000);

  // Click outside listener
  document.addEventListener('click', handleClickOutside);

  onUnmounted(() => {
    clearInterval(interval);
    document.removeEventListener('click', handleClickOutside);
  });
});
</script>

<style scoped>
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.animate-spin {
  animation: spin 1s linear infinite;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.3);
}

::-webkit-scrollbar-thumb {
  background: rgba(249, 115, 22, 0.5);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(249, 115, 22, 0.7);
}
</style>
