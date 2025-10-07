<template>
  <div class="relative" @mouseenter="openMenu" @mouseleave="closeMenu">
    <!-- Profile Button -->
    <button class="flex items-center space-x-3 px-4 py-2 rounded border border-orange-500/30 hover:bg-orange-500/10 transition-all">
      <img
        :src="getAvatarUrl(user.avatar)"
        :alt="user.name"
        class="w-8 h-8 rounded-full border-2 border-orange-500 object-cover"
      />
      <span class="text-sm font-mono text-orange-400">{{ user.name }}</span>
      <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>

    <!-- Dropdown Menu -->
    <div v-show="showMenu" class="absolute right-0 mt-2 w-72 bg-black border border-orange-600/30 rounded-md shadow-lg z-50">
      <div class="p-4 border-b border-orange-600/30">
        <div class="flex items-center space-x-3">
          <img
            :src="getAvatarUrl(user.avatar)"
            :alt="user.name"
            class="w-12 h-12 rounded-full border-2 border-orange-500 object-cover"
          />
          <div>
            <div class="text-white font-mono font-bold">{{ user.name }}</div>
            <div class="text-xs text-gray-400 font-mono">{{ user.email }}</div>
          </div>
        </div>
      </div>

      <div class="p-2">
        <button
          @click="goToViewProfile"
          class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 rounded font-mono flex items-center"
        >
          <span class="text-orange-600 mr-2">&gt;</span>
          Мой профиль
        </button>
        <button
          @click="goToEditProfile"
          class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 rounded font-mono flex items-center"
        >
          <span class="text-orange-600 mr-2">&gt;</span>
          Редактировать профиль
        </button>
        <button
          @click="handleLogout"
          class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-orange-500/10 hover:text-orange-400 rounded font-mono flex items-center"
        >
          <span class="text-orange-600 mr-2">&gt;</span>
          Выйти
        </button>
      </div>
    </div>
  </div>

  <!-- Edit Profile Modal -->
  <Teleport to="body">
    <div v-if="showEditModal" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4" @click.self="closeEditModal">
      <div class="bg-gray-900 border border-orange-600/30 rounded-lg max-w-md w-full p-6">
        <h2 class="text-2xl font-black font-mono text-orange-500 mb-6">
          <span class="text-orange-600">&gt;</span> РЕДАКТИРОВАТЬ_ПРОФИЛЬ
        </h2>

        <form @submit.prevent="updateProfile">
          <div class="mb-4">
            <label class="block text-sm font-mono text-gray-400 mb-2">Имя:</label>
            <input
              v-model="editForm.name"
              type="text"
              required
              class="w-full px-4 py-2 bg-black border border-orange-600/30 rounded text-white font-mono focus:border-orange-500 focus:outline-none"
            />
          </div>

          <div class="mb-4">
            <label class="block text-sm font-mono text-gray-400 mb-2">Аватар:</label>

            <!-- Drag and Drop Zone -->
            <div
              @drop.prevent="handleDrop"
              @dragover.prevent="isDragging = true"
              @dragleave.prevent="isDragging = false"
              @click="$refs.fileInput.click()"
              :class="[
                'border-2 border-dashed rounded-lg p-6 text-center cursor-pointer transition-all',
                isDragging ? 'border-orange-500 bg-orange-500/10' : 'border-orange-600/30 hover:border-orange-500/50'
              ]"
            >
              <div v-if="previewUrl || user.avatar" class="mb-4">
                <img
                  :src="previewUrl || getAvatarUrl(user.avatar)"
                  alt="Preview"
                  class="w-24 h-24 rounded-full mx-auto border-2 border-orange-500 object-cover"
                />
              </div>

              <div class="text-gray-400 font-mono text-sm">
                <svg class="w-12 h-12 mx-auto mb-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p v-if="editForm.avatarFile">{{ editForm.avatarFile.name }}</p>
                <p v-else>Перетащите изображение сюда или нажмите для выбора</p>
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

            <button
              v-if="editForm.avatarFile || user.avatar"
              type="button"
              @click.stop="clearAvatar"
              class="mt-2 text-xs text-red-400 hover:text-red-300 font-mono"
            >
              Удалить аватар
            </button>
          </div>

          <div v-if="error" class="mb-4 p-3 bg-red-900/20 border border-red-500/30 rounded text-red-400 text-sm font-mono">
            {{ error }}
          </div>

          <div class="flex space-x-3">
            <button
              type="submit"
              :disabled="loading"
              class="flex-1 px-6 py-2.5 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-sm font-black font-mono transition-all disabled:opacity-50"
            >
              {{ loading ? 'СОХРАНЕНИЕ...' : 'СОХРАНИТЬ' }}
            </button>
            <button
              type="button"
              @click="closeEditModal"
              class="flex-1 px-6 py-2.5 border border-orange-500/30 text-orange-500 text-sm font-bold font-mono hover:bg-orange-500/10 transition-all"
            >
              ОТМЕНА
            </button>
          </div>
        </form>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
  user: {
    type: Object,
    required: true
  }
});

const showMenu = ref(false);
const showEditModal = ref(false);
const loading = ref(false);
const error = ref('');
const isDragging = ref(false);
const previewUrl = ref('');
const fileInput = ref(null);
let menuTimeout = null;

const editForm = reactive({
  name: props.user.name,
  avatarFile: null
});

function getAvatarUrl(avatar) {
  // Проверяем на null, пустую строку, '0', 'null' и другие некорректные значения
  if (!avatar || avatar === 'null' || avatar === '0' || avatar === 0) {
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(props.user.name) + '&background=ea580c&color=fff';
  }
  // Если аватар начинается с http, это старый URL
  if (avatar.startsWith('http')) {
    return avatar;
  }
  // Иначе это путь к файлу в storage
  return '/storage/' + avatar;
}

function openMenu() {
  if (menuTimeout) clearTimeout(menuTimeout);
  showMenu.value = true;
}

function closeMenu() {
  menuTimeout = setTimeout(() => {
    showMenu.value = false;
  }, 150);
}

function openEditModal() {
  showEditModal.value = true;
  showMenu.value = false;
  editForm.name = props.user.name;
  editForm.avatarFile = null;
  previewUrl.value = '';
}

function closeEditModal() {
  showEditModal.value = false;
  error.value = '';
  previewUrl.value = '';
  isDragging.value = false;
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
  // Проверка типа файла
  const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
  if (!allowedTypes.includes(file.type)) {
    error.value = 'Пожалуйста, выберите изображение (JPEG, PNG, GIF или WEBP)';
    return;
  }

  // Проверка размера файла (2MB)
  if (file.size > 2 * 1024 * 1024) {
    error.value = 'Размер файла не должен превышать 2MB';
    return;
  }

  error.value = '';
  editForm.avatarFile = file;

  // Создание превью
  const reader = new FileReader();
  reader.onload = (e) => {
    previewUrl.value = e.target.result;
  };
  reader.readAsDataURL(file);
}

function clearAvatar() {
  editForm.avatarFile = null;
  previewUrl.value = '';
  if (fileInput.value) {
    fileInput.value.value = '';
  }
}

async function updateProfile() {
  loading.value = true;
  error.value = '';

  try {
    const formData = new FormData();
    formData.append('name', editForm.name);

    if (editForm.avatarFile) {
      formData.append('avatar', editForm.avatarFile);
      console.log('Uploading avatar:', editForm.avatarFile.name, editForm.avatarFile.size);
    }

    console.log('Sending request to /profile...');

    const response = await axios.post('/profile', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    console.log('Response:', response.data);

    // Перезагружаем всю страницу для обновления данных
    window.location.reload();
  } catch (err) {
    console.error('Update error:', err);
    error.value = err.response?.data?.message || err.response?.data?.errors?.avatar?.[0] || 'Ошибка при обновлении профиля';
  } finally {
    loading.value = false;
  }
}

async function handleLogout() {
  try {
    await axios.post('/logout');
    window.location.href = '/';
  } catch (err) {
    console.error('Logout error:', err);
  }
}

function goToEditProfile() {
  router.visit('/profile/edit');
}

function goToViewProfile() {
  router.visit(`/profile/${props.user.id}`);
}
</script>
