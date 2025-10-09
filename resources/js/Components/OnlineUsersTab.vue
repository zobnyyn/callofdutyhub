<template>
  <div class="space-y-6">
    <!-- Terminal Header -->
    <div class="border border-orange-500/30 bg-orange-500/5 p-6">
      <div class="text-orange-600 font-mono text-sm mb-4 flex items-center justify-between">
        <span>
          <span class="text-orange-600 mr-2">&gt;</span> ONLINE_OPERATORS_STATUS:
        </span>
        <button
          @click="refreshOnlineUsers"
          class="px-3 py-1 bg-orange-500/20 border border-orange-500/30 text-orange-500 text-xs hover:bg-orange-500/30 transition-all"
          :disabled="isLoading"
        >
          <span v-if="!isLoading">↻ REFRESH</span>
          <span v-else>LOADING...</span>
        </button>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-3 gap-4">
        <div class="text-center p-4 bg-black/30 border border-orange-500/20">
          <div class="text-3xl font-black text-green-500 mb-1 font-mono">{{ onlineData.total }}</div>
          <div class="text-xs text-gray-500 font-mono">TOTAL_ONLINE</div>
        </div>
        <div class="text-center p-4 bg-black/30 border border-orange-500/20">
          <div class="text-3xl font-black text-orange-500 mb-1 font-mono">{{ onlineData.users.length }}</div>
          <div class="text-xs text-gray-500 font-mono">OPERATORS</div>
        </div>
        <div class="text-center p-4 bg-black/30 border border-orange-500/20">
          <div class="text-3xl font-black text-blue-500 mb-1 font-mono">{{ onlineData.guests }}</div>
          <div class="text-xs text-gray-500 font-mono">GUESTS</div>
        </div>
      </div>
    </div>

    <!-- Online Users List -->
    <div class="border border-orange-500/30 bg-orange-500/5 p-6">
      <div class="text-orange-600 font-mono text-sm mb-6">
        <span class="text-orange-600 mr-2">&gt;</span> ACTIVE_OPERATORS:
        <span class="text-gray-500 ml-2">({{ onlineData.users.length }})</span>
      </div>

      <!-- Loading State -->
      <div v-if="isLoading" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-orange-500 border-t-transparent"></div>
        <div class="text-orange-500 font-mono text-sm mt-4">
          <span class="text-orange-600">&gt;</span> SCANNING_NETWORK...
        </div>
      </div>

      <!-- Empty State -->
      <div v-else-if="onlineData.users.length === 0" class="text-center py-12">
        <svg class="w-16 h-16 mx-auto text-orange-500/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <div class="text-gray-500 font-mono text-sm">
          <span class="text-orange-600">&gt;</span> NO_OPERATORS_ONLINE
        </div>
        <div class="text-gray-600 font-mono text-xs mt-2">
          System is monitoring for incoming connections...
        </div>
      </div>

      <!-- Users Grid -->
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a
          v-for="user in onlineData.users"
          :key="user.id"
          :href="`/profile/${user.id}`"
          class="group border border-orange-500/30 bg-black/30 hover:bg-orange-500/10 hover:border-orange-500 transition-all p-4"
        >
          <div class="flex items-center gap-4">
            <!-- Avatar with online indicator -->
            <div class="relative flex-shrink-0">
              <img
                :src="getAvatarUrl(user.avatar, user.name)"
                :alt="user.name"
                class="w-14 h-14 rounded-full border-2 border-orange-500/50 object-cover group-hover:border-orange-500 transition-colors"
              />
              <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-black animate-pulse"></div>
            </div>

            <!-- User Info -->
            <div class="flex-1 min-w-0">
              <div class="text-orange-600 font-mono text-xs mb-1">
                <span class="text-orange-600">&gt;</span> OPERATOR
              </div>
              <h3 class="text-white font-mono font-bold text-sm truncate group-hover:text-orange-400 transition-colors">
                {{ user.name }}
              </h3>
              <div class="text-gray-500 font-mono text-xs mt-1">
                ID: #{{ user.id }}
              </div>
            </div>

            <!-- Status Icon -->
            <div class="flex-shrink-0">
              <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center">
                <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>

    <!-- Guests Counter -->
    <div v-if="onlineData.guests > 0" class="border border-orange-500/30 bg-orange-500/5 p-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <div>
            <div class="text-orange-600 font-mono text-xs mb-1">
              <span class="text-orange-600">&gt;</span> UNIDENTIFIED_CONNECTIONS
            </div>
            <div class="text-white font-mono text-lg font-bold">
              {{ onlineData.guests }} Guest{{ onlineData.guests !== 1 ? 's' : '' }} Online
            </div>
          </div>
        </div>
        <div class="text-blue-500 font-mono text-sm">
          <div class="px-4 py-2 bg-blue-500/10 border border-blue-500/30">
            MONITORING...
          </div>
        </div>
      </div>
    </div>

    <!-- Last Update -->
    <div class="text-center text-gray-600 font-mono text-xs">
      <span class="text-orange-600">&gt;</span> LAST_SCAN: {{ lastUpdate }}
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const onlineData = ref({
  users: [],
  guests: 0,
  total: 0
});

const isLoading = ref(true);
const lastUpdate = ref('--:--:--');
let refreshInterval = null;

const fetchOnlineUsers = async () => {
  try {
    const response = await axios.get('/api/online-users');
    onlineData.value = response.data;
    updateLastUpdateTime();
    isLoading.value = false;
  } catch (error) {
    console.error('Error fetching online users:', error);
    isLoading.value = false;
  }
};

const refreshOnlineUsers = () => {
  isLoading.value = true;
  fetchOnlineUsers();
};

const updateLastUpdateTime = () => {
  const now = new Date();
  lastUpdate.value = now.toLocaleTimeString('ru-RU');
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

onMounted(() => {
  fetchOnlineUsers();

  // Обновляем каждые 30 секунд
  refreshInterval = setInterval(() => {
    fetchOnlineUsers();
  }, 30000);
});

onUnmounted(() => {
  if (refreshInterval) {
    clearInterval(refreshInterval);
  }
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
</style>

