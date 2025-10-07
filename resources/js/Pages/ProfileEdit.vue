<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Profile Edit Section - Terminal Style -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen flex items-center">
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
        <div class="max-w-4xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING PROFILE_EDITOR.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> OPERATOR PROFILE CONFIGURATION
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <div class="text-orange-600 font-mono text-sm mb-4">
              <span class="text-orange-600">&gt;</span> PROFILE_MANAGEMENT_SYSTEM
            </div>

            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-none uppercase font-mono">
              <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 mb-2 terminal-glow">
                РЕДАКТИРОВАНИЕ
              </span>
              <span class="block text-white flex items-center">
                <span>ПРОФИЛЯ</span>
                <span class="inline-block w-3 h-12 md:h-16 bg-orange-500 ml-4 cursor-blink"></span>
              </span>
            </h1>
          </div>

          <!-- Profile Edit Form - Terminal Style -->
          <form @submit.prevent="updateProfile" class="space-y-8">
            <!-- Error Message -->
            <div v-if="error" class="border border-red-500/30 bg-red-900/20 p-4 font-mono">
              <div class="text-red-500 text-sm">
                <span class="text-red-600">&gt;</span> ERROR: {{ error }}
              </div>
            </div>

            <!-- Success Message -->
            <div v-if="success" class="border border-green-500/30 bg-green-900/20 p-4 font-mono">
              <div class="text-green-500 text-sm">
                <span class="text-green-600">&gt;</span> SUCCESS: {{ success }}
              </div>
            </div>

            <!-- Avatar Section -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4">
                <span class="text-orange-600">&gt;</span> OPERATOR_AVATAR:
              </div>

              <!-- Current Avatar -->
              <div class="mb-4 flex items-center space-x-6">
                <img
                  :src="previewUrl || getAvatarUrl($page.props.auth.user.avatar)"
                  alt="Avatar"
                  class="w-24 h-24 rounded-full border-2 border-orange-500 object-cover"
                />
                <div class="flex-1">
                  <div class="text-gray-400 font-mono text-sm mb-2">
                    Текущий аватар оператора
                  </div>
                  <button
                    type="button"
                    @click="$refs.fileInput.click()"
                    class="px-4 py-2 bg-orange-600/20 border border-orange-500/30 text-orange-500 font-mono text-sm hover:bg-orange-500/20 transition-colors"
                  >
                    <span class="text-orange-600">&gt;</span> CHANGE_AVATAR
                  </button>
                </div>
              </div>

              <!-- Drag and Drop Zone -->
              <div
                @drop.prevent="handleDrop"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @click="$refs.fileInput.click()"
                :class="[
                  'border-2 border-dashed rounded p-6 text-center cursor-pointer transition-all',
                  isDragging ? 'border-orange-500 bg-orange-500/10' : 'border-orange-600/30 hover:border-orange-500/50'
                ]"
              >
                <div class="text-gray-400 font-mono text-sm">
                  <svg class="w-12 h-12 mx-auto mb-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                  </svg>
                  <p v-if="form.avatarFile">{{ form.avatarFile.name }}</p>
                  <p v-else>Перетащите изображение или нажмите для выбора</p>
                  <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF, WEBP до 2MB</p>
                </div>
              </div>

              <input
                ref="fileInput"
                type="file"
                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                @change="handleFileSelect"
                class="hidden"
              />
            </div>

            <!-- Basic Info -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4">
                <span class="text-orange-600">&gt;</span> BASIC_INFORMATION:
              </div>

              <div class="space-y-4">
                <!-- Name Field -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2">
                    <span class="text-orange-600">&gt;</span> OPERATOR_NAME:
                  </div>
                  <input
                    v-model="form.name"
                    type="text"
                    required
                    class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                    placeholder="John Mason"
                  />
                </div>

                <!-- Email (readonly) -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2">
                    <span class="text-orange-600">&gt;</span> OPERATOR_EMAIL:
                  </div>
                  <input
                    :value="$page.props.auth.user.email"
                    type="email"
                    readonly
                    class="w-full px-4 py-3 bg-black/50 border-2 border-orange-500/20 text-gray-500 font-mono cursor-not-allowed"
                  />
                  <div class="text-xs text-gray-500 mt-1 font-mono">
                    <span class="text-orange-600">&gt;</span> EMAIL не может быть изменен
                  </div>
                </div>
              </div>
            </div>

            <!-- Social Networks & Gaming Platforms -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4">
                <span class="text-orange-600">&gt;</span> COMMUNICATION_CHANNELS:
              </div>

              <div class="space-y-4">
                <!-- Telegram -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0088cc]" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0.38z"/>
                    </svg>
                    <span class="text-orange-600">&gt;</span> TELEGRAM:
                  </div>
                  <input
                    v-model="form.telegram"
                    type="text"
                    class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                    placeholder="@username"
                  />
                </div>

                <!-- Discord -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#5865F2]" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                    </svg>
                    <span class="text-orange-600">&gt;</span> DISCORD:
                  </div>
                  <input
                    v-model="form.discord"
                    type="text"
                    class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                    placeholder="username#0000"
                  />
                </div>
              </div>
            </div>

            <!-- Gaming Platforms -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <div class="text-orange-600 font-mono text-sm mb-4">
                <span class="text-orange-600">&gt;</span> GAMING_PLATFORMS:
              </div>

              <div class="space-y-4">
                <!-- Xbox -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2 flex items-center">
                    <img :src="xboxIcon" alt="Xbox" class="w-5 h-5 mr-2" />
                    <span class="text-orange-600">&gt;</span> XBOX_LIVE:
                  </div>
                  <input
                    v-model="form.xbox"
                    type="text"
                    class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                    placeholder="GamerTag"
                  />
                </div>

                <!-- Steam -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#00adee]" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M11.979 0C5.678 0 .511 4.86.022 11.037l6.432 2.658c.545-.371 1.203-.59 1.912-.59.063 0 .125.004.188.006l2.861-4.142V8.91c0-2.495 2.028-4.524 4.524-4.524 2.494 0 4.524 2.031 4.524 4.527s-2.03 4.525-4.524 4.525h-.105l-4.076 2.911c0 .052.004.105.004.159 0 1.875-1.515 3.396-3.39 3.396-1.635 0-3.016-1.173-3.331-2.727L.436 15.27C1.862 20.307 6.486 24 11.979 24c6.627 0 11.999-5.373 11.999-12S18.605 0 11.979 0zM7.54 18.21l-1.473-.61c.262.543.714.999 1.314 1.25 1.297.539 2.793-.076 3.332-1.375.263-.63.264-1.319.005-1.949s-.75-1.121-1.377-1.383c-.624-.26-1.29-.249-1.878-.03l1.523.63c.956.4 1.409 1.5 1.009 2.455-.397.957-1.497 1.41-2.454 1.012H7.54zm11.415-9.303c0-1.662-1.353-3.015-3.015-3.015-1.665 0-3.015 1.353-3.015 3.015 0 1.665 1.35 3.015 3.015 3.015 1.663 0 3.015-1.35 3.015-3.015zm-5.273-.005c0-1.252 1.013-2.266 2.265-2.266 1.249 0 2.266 1.014 2.266 2.266 0 1.251-1.017 2.265-2.266 2.265-1.253 0-2.265-1.014-2.265-2.265z"/>
                    </svg>
                    <span class="text-orange-600">&gt;</span> STEAM_ID:
                  </div>
                  <input
                    v-model="form.steam"
                    type="text"
                    class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                    placeholder="Steam ID or Profile URL"
                  />
                </div>

                <!-- PlayStation Network -->
                <div class="font-mono">
                  <div class="text-orange-600 text-sm mb-2 flex items-center">
                    <img :src="playstationIcon" alt="PlayStation" class="w-5 h-5 mr-2" />
                    <span class="text-orange-600">&gt;</span> PSN_ID:
                  </div>
                  <input
                    v-model="form.psn"
                    type="text"
                    class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                    placeholder="PSN ID"
                  />
                </div>
              </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex space-x-4 pt-4">
              <button
                type="submit"
                :disabled="loading"
                class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-lg font-black font-mono tracking-wider transition-all relative overflow-hidden group disabled:opacity-50"
              >
                <span class="absolute inset-0 terminal-grid opacity-20"></span>
                <span class="relative z-10 flex items-center justify-center">
                  <span class="text-orange-600 mr-2">&gt;</span>
                  {{ loading ? 'UPDATING...' : 'SAVE_CHANGES_' }}
                  <span v-if="!loading" class="inline-block w-2 h-4 bg-black/50 ml-2 cursor-blink"></span>
                </span>
              </button>

              <button
                type="button"
                @click="$inertia.visit('/')"
                class="px-8 py-4 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all"
              >
                <span class="text-orange-600 mr-2">&gt;</span> CANCEL
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import Header from '../Components/Header.vue';
import xboxIcon from '../../images/icons/xbox-svgrepo-com.svg';
import playstationIcon from '../../images/icons/playstation-svgrepo-com.svg';

const page = usePage();
const loading = ref(false);
const error = ref('');
const success = ref('');
const isDragging = ref(false);
const previewUrl = ref('');
const fileInput = ref(null);

const form = reactive({
  name: page.props.auth.user.name || '',
  telegram: page.props.auth.user.telegram || '',
  discord: page.props.auth.user.discord || '',
  xbox: page.props.auth.user.xbox || '',
  steam: page.props.auth.user.steam || '',
  psn: page.props.auth.user.psn || '',
  avatarFile: null
});

function getAvatarUrl(avatar) {
  if (!avatar || avatar === 'null' || avatar === '0' || avatar === 0) {
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(page.props.auth.user.name) + '&background=ea580c&color=fff';
  }
  if (avatar.startsWith('http')) {
    return avatar;
  }
  return '/storage/' + avatar;
}

function handleDrop(e) {
  isDragging.value = false;
  const files = e.dataTransfer.files;
  if (files.length > 0) {
    handleFile(files[0]);
  }
}

function handleFileSelect(e) {
  const files = e.target.files;
  if (files.length > 0) {
    handleFile(files[0]);
  }
}

function handleFile(file) {
  const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
  if (!allowedTypes.includes(file.type)) {
    error.value = 'Пожалуйста, выберите изображение (JPEG, PNG, GIF или WEBP)';
    return;
  }

  if (file.size > 2 * 1024 * 1024) {
    error.value = 'Размер файла не должен превышать 2MB';
    return;
  }

  error.value = '';
  form.avatarFile = file;

  const reader = new FileReader();
  reader.onload = (e) => {
    previewUrl.value = e.target.result;
  };
  reader.readAsDataURL(file);
}

async function updateProfile() {
  loading.value = true;
  error.value = '';
  success.value = '';

  try {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('telegram', form.telegram || '');
    formData.append('discord', form.discord || '');
    formData.append('xbox', form.xbox || '');
    formData.append('steam', form.steam || '');
    formData.append('psn', form.psn || '');

    if (form.avatarFile) {
      formData.append('avatar', form.avatarFile);
    }

    const response = await axios.post('/profile', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    success.value = 'Профиль успешно обновлен!';

    setTimeout(() => {
      window.location.reload();
    }, 1500);
  } catch (err) {
    error.value = err.response?.data?.message || err.response?.data?.errors?.avatar?.[0] || 'Ошибка при обновлении профиля';
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
/* Terminal Grid */
.terminal-grid {
  background-image:
    repeating-linear-gradient(0deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px),
    repeating-linear-gradient(90deg, rgba(0,255,128,0.07) 0px, transparent 1px, transparent 2px);
  background-size: 4px 4px;
}

/* Cursor Blink */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}
</style>
