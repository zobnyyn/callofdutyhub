<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Profile View Section - Terminal Style -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <!-- Terminal Grid Pattern -->
      <div class="absolute inset-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image:
          linear-gradient(rgba(249, 115, 22, 0.3) 1px, transparent 1px),
          linear-gradient(90deg, rgba(249, 115, 22, 0.3) 1px, transparent 1px);
          background-size: 20px 20px;"></div>
      </div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-5xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> ACCESSING OPERATOR DATABASE...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING OPERATOR_PROFILE.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> STATUS: AUTHENTICATED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Profile Header Card -->
          <div class="border border-orange-500/30 bg-orange-500/5 p-8 mb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-8">
              <!-- Avatar -->
              <div class="relative">
                <img
                  :src="getAvatarUrl(profileUser.avatar)"
                  :alt="profileUser.name"
                  class="w-32 h-32 rounded-full border-4 border-orange-500 object-cover"
                />
                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-black animate-pulse"></div>
              </div>

              <!-- User Info -->
              <div class="flex-1">
                <div class="text-orange-600 font-mono text-xs mb-2">
                  <span class="text-orange-600">&gt;</span> OPERATOR_PROFILE
                </div>
                <h1 class="text-4xl md:text-5xl font-black mb-3 uppercase font-mono text-white terminal-glow">
                  {{ profileUser.name }}
                </h1>
                <div class="flex items-center gap-4 text-sm font-mono text-gray-400">
                  <div class="flex items-center gap-2">
                    <span class="text-orange-500">◉</span>
                    <span>ACTIVE</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <span class="text-orange-500">●</span>
                    <span>ID: #{{ profileUser.id }}</span>
                  </div>
                </div>
              </div>

              <!-- Edit Button (только для владельца профиля) -->
              <div v-if="$page.props.auth.user && $page.props.auth.user.id === profileUser.id">
                <Link
                  href="/profile/edit"
                  class="px-6 py-3 bg-orange-600/20 border border-orange-500/30 text-orange-500 font-mono text-sm hover:bg-orange-500/20 transition-colors flex items-center gap-2"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                  <span class="text-orange-600">&gt;</span> EDIT_PROFILE
                </Link>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Communication Channels -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-6 flex items-center">
                <span class="text-orange-600 mr-2">&gt;</span> COMMUNICATION_CHANNELS:
                <span class="ml-auto text-xs text-gray-500">{{ getActiveChannelsCount() }}/3 ACTIVE</span>
              </div>

              <div class="space-y-4">
                <!-- Telegram -->
                <div class="font-mono">
                  <div class="text-gray-400 text-xs mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#0088cc]" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0.38z"/>
                    </svg>
                    TELEGRAM:
                  </div>
                  <div v-if="profileUser.telegram" class="px-3 py-2 bg-black/50 border border-orange-500/20 text-white text-sm">
                    {{ profileUser.telegram }}
                  </div>
                  <div v-else class="px-3 py-2 bg-black/30 border border-orange-500/10 text-gray-600 text-sm">
                    <span class="text-orange-600">&gt;</span> NOT_SPECIFIED
                  </div>
                </div>

                <!-- Discord -->
                <div class="font-mono">
                  <div class="text-gray-400 text-xs mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#5865F2]" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                    </svg>
                    DISCORD:
                  </div>
                  <div v-if="profileUser.discord" class="px-3 py-2 bg-black/50 border border-orange-500/20 text-white text-sm">
                    {{ profileUser.discord }}
                  </div>
                  <div v-else class="px-3 py-2 bg-black/30 border border-orange-500/10 text-gray-600 text-sm">
                    <span class="text-orange-600">&gt;</span> NOT_SPECIFIED
                  </div>
                </div>
              </div>
            </div>

            <!-- Gaming Platforms -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-6 flex items-center">
                <span class="text-orange-600 mr-2">&gt;</span> GAMING_PLATFORMS:
                <span class="ml-auto text-xs text-gray-500">{{ getActivePlatformsCount() }}/3 LINKED</span>
              </div>

              <div class="space-y-4">
                <!-- Xbox -->
                <div class="font-mono">
                  <div class="text-gray-400 text-xs mb-2 flex items-center">
                    <img :src="xboxIcon" alt="Xbox" class="w-4 h-4 mr-2" />
                    XBOX_LIVE:
                  </div>
                  <div v-if="profileUser.xbox" class="px-3 py-2 bg-black/50 border border-orange-500/20 text-white text-sm">
                    {{ profileUser.xbox }}
                  </div>
                  <div v-else class="px-3 py-2 bg-black/30 border border-orange-500/10 text-gray-600 text-sm">
                    <span class="text-orange-600">&gt;</span> NOT_LINKED
                  </div>
                </div>

                <!-- Steam -->
                <div class="font-mono">
                  <div class="text-gray-400 text-xs mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#00adee]" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M11.979 0C5.678 0 .511 4.86.022 11.037l6.432 2.658c.545-.371 1.203-.59 1.912-.59.063 0 .125.004.188.006l2.861-4.142V8.91c0-2.495 2.028-4.524 4.524-4.524 2.494 0 4.524 2.031 4.524 4.527s-2.03 4.525-4.524 4.525h-.105l-4.076 2.911c0 .052.004.105.004.159 0 1.875-1.515 3.396-3.39 3.396-1.635 0-3.016-1.173-3.331-2.727L.436 15.27C1.862 20.307 6.486 24 11.979 24c6.627 0 11.999-5.373 11.999-12S18.605 0 11.979 0zM7.54 18.21l-1.473-.61c.262.543.714.999 1.314 1.25 1.297.539 2.793-.076 3.332-1.375.263-.63.264-1.319.005-1.949s-.75-1.121-1.377-1.383c-.624-.26-1.29-.249-1.878-.03l1.523.63c.956.4 1.409 1.5 1.009 2.455-.397.957-1.497 1.41-2.454 1.012H7.54zm11.415-9.303c0-1.662-1.353-3.015-3.015-3.015-1.665 0-3.015 1.353-3.015 3.015 0 1.665 1.35 3.015 3.015 3.015 1.663 0 3.015-1.35 3.015-3.015zm-5.273-.005c0-1.252 1.013-2.266 2.265-2.266 1.249 0 2.266 1.014 2.266 2.266 0 1.251-1.017 2.265-2.266 2.265-1.253 0-2.265-1.014-2.265-2.265z"/>
                    </svg>
                    STEAM:
                  </div>
                  <div v-if="profileUser.steam" class="px-3 py-2 bg-black/50 border border-orange-500/20 text-white text-sm">
                    {{ profileUser.steam }}
                  </div>
                  <div v-else class="px-3 py-2 bg-black/30 border border-orange-500/10 text-gray-600 text-sm">
                    <span class="text-orange-600">&gt;</span> NOT_LINKED
                  </div>
                </div>

                <!-- PlayStation Network -->
                <div class="font-mono">
                  <div class="text-gray-400 text-xs mb-2 flex items-center">
                    <img :src="playstationIcon" alt="PlayStation" class="w-4 h-4 mr-2" />
                    PSN:
                  </div>
                  <div v-if="profileUser.psn" class="px-3 py-2 bg-black/50 border border-orange-500/20 text-white text-sm">
                    {{ profileUser.psn }}
                  </div>
                  <div v-else class="px-3 py-2 bg-black/30 border border-orange-500/10 text-gray-600 text-sm">
                    <span class="text-orange-600">&gt;</span> NOT_LINKED
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Stats Section -->
          <div class="mt-8 border border-orange-500/30 bg-orange-500/5 p-6">
            <div class="text-orange-600 font-mono text-sm mb-6">
              <span class="text-orange-600 mr-2">&gt;</span> OPERATOR_STATISTICS:
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <div class="text-center p-4 bg-black/30 border border-orange-500/20">
                <div class="text-3xl font-black text-orange-500 mb-1 font-mono">{{ getActivePlatformsCount() }}</div>
                <div class="text-xs text-gray-500 font-mono">PLATFORMS</div>
              </div>
              <div class="text-center p-4 bg-black/30 border border-orange-500/20">
                <div class="text-3xl font-black text-orange-500 mb-1 font-mono">{{ getActiveChannelsCount() }}</div>
                <div class="text-xs text-gray-500 font-mono">CHANNELS</div>
              </div>
              <div class="text-center p-4 bg-black/30 border border-orange-500/20">
                <div class="text-3xl font-black text-green-500 mb-1 font-mono">100%</div>
                <div class="text-xs text-gray-500 font-mono">ONLINE</div>
              </div>
              <div class="text-center p-4 bg-black/30 border border-orange-500/20">
                <div class="text-3xl font-black text-blue-500 mb-1 font-mono">#{{ profileUser.id }}</div>
                <div class="text-xs text-gray-500 font-mono">OPERATOR_ID</div>
              </div>
            </div>
          </div>

          <!-- Back Button -->
          <div class="mt-8">
            <button
              @click="$inertia.visit('/')"
              class="px-6 py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
              <span class="text-orange-600">&gt;</span> BACK_TO_BASE
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '../Components/Header.vue';
import xboxIcon from '../../images/icons/xbox-svgrepo-com.svg';
import playstationIcon from '../../images/icons/playstation-svgrepo-com.svg';

const props = defineProps({
  profileUser: {
    type: Object,
    required: true
  }
});

function getAvatarUrl(avatar) {
  if (!avatar || avatar === 'null' || avatar === '0' || avatar === 0) {
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(props.profileUser.name) + '&background=ea580c&color=fff';
  }
  if (avatar.startsWith('http')) {
    return avatar;
  }
  return '/storage/' + avatar;
}

function getActiveChannelsCount() {
  let count = 0;
  if (props.profileUser.telegram) count++;
  if (props.profileUser.discord) count++;
  return count;
}

function getActivePlatformsCount() {
  let count = 0;
  if (props.profileUser.xbox) count++;
  if (props.profileUser.steam) count++;
  if (props.profileUser.psn) count++;
  return count;
}
</script>

<style scoped>
/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}
</style>
