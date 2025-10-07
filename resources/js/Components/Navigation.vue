<template>
  <nav class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <a href="/" class="text-white font-bold text-xl">Call of Duty</a>
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Главная
            </a>
            <a href="/zombies" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Zombies
            </a>
          </div>
        </div>

        <div class="flex items-center space-x-4">
          <template v-if="user">
            <span class="text-gray-300 text-sm">{{ user.name }}</span>
            <button
              @click="logout"
              class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-medium"
            >
              Выход
            </button>
          </template>
          <template v-else>
            <a
              href="/login"
              class="text-gray-300 hover:text-white px-4 py-2 rounded-md text-sm font-medium"
            >
              Вход
            </a>
            <a
              href="/register"
              class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-medium"
            >
              Регистрация
            </a>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import axios from 'axios';

const page = usePage();
const user = computed(() => page.props.auth?.user);

const logout = async () => {
  try {
    await axios.post('/logout');
    router.visit('/');
  } catch (error) {
    console.error('Ошибка при выходе:', error);
  }
};
</script>

