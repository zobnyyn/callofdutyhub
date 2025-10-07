<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Login Section - Terminal Style -->
    <section class="pt-24 md:pt-40 pb-12 md:pb-24 px-3 md:px-6 relative min-h-screen flex items-center">
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
        <div class="max-w-2xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING AUTH_MODULE.exe
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> AUTHENTICATION REQUIRED
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Login Title -->
          <div class="mb-8 md:mb-10">
            <div class="text-orange-600 font-mono text-xs md:text-sm mb-3 md:mb-4">
              <span class="text-orange-600">&gt;</span> ACCESS_CONTROL_SYSTEM
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-black mb-4 md:mb-6 leading-none uppercase font-mono">
              <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 mb-2 terminal-glow">
                ВХОД В
              </span>
              <span class="block text-white flex items-center">
                <span>СИСТЕМУ</span>
                <span class="inline-block w-2 md:w-3 h-10 md:h-12 lg:h-16 bg-orange-500 ml-2 md:ml-4 cursor-blink"></span>
              </span>
            </h1>
          </div>

          <!-- Login Form - Terminal Style -->
          <form @submit.prevent="login" class="space-y-4 md:space-y-6">
            <!-- Error Message -->
            <div v-if="errors.general" class="border border-red-500/30 bg-red-900/20 p-4 font-mono">
              <div class="text-red-500 text-sm">
                <span class="text-red-600">&gt;</span> ERROR: {{ errors.general }}
              </div>
            </div>

            <!-- Email Field -->
            <div class="font-mono">
              <div class="text-orange-600 text-sm mb-2">
                <span class="text-orange-600">&gt;</span> OPERATOR_EMAIL:
              </div>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                :class="{ 'border-red-500': errors.email }"
                placeholder="operator@blackops.mil"
              />
              <div v-if="errors.email" class="text-red-500 text-sm mt-2">
                <span class="text-red-600">&gt;</span> {{ errors.email[0] }}
              </div>
            </div>

            <!-- Password Field -->
            <div class="font-mono">
              <div class="text-orange-600 text-sm mb-2">
                <span class="text-orange-600">&gt;</span> ACCESS_CODE:
              </div>
              <input
                id="password"
                v-model="form.password"
                type="password"
                required
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
                :class="{ 'border-red-500': errors.password }"
                placeholder="••••••••"
              />
              <div v-if="errors.password" class="text-red-500 text-sm mt-2">
                <span class="text-red-600">&gt;</span> {{ errors.password[0] }}
              </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
              <button
                type="submit"
                :disabled="loading"
                class="w-full px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black text-lg font-black font-mono tracking-wider transition-all relative overflow-hidden group disabled:opacity-50"
              >
                <span class="absolute inset-0 terminal-grid opacity-20"></span>
                <span class="relative z-10 flex items-center justify-center">
                  <span class="text-orange-600 mr-2">&gt;</span>
                  {{ loading ? 'AUTHENTICATING...' : 'ВОЙТИ_' }}
                  <span v-if="!loading" class="inline-block w-2 h-4 bg-black/50 ml-2 cursor-blink"></span>
                </span>
              </button>
            </div>

            <!-- Register Link -->
            <div class="text-center font-mono text-sm pt-4">
              <div class="text-gray-500 mb-2">
                <span class="text-orange-600">&gt;</span> НЕТ_АККАУНТА?
              </div>
              <a href="/register" class="text-orange-500 hover:text-orange-400 transition-colors">
                &gt; ЗАРЕГИСТРИРОВАТЬСЯ
              </a>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import Header from '../Components/Header.vue';

const form = ref({
  email: '',
  password: '',
});

const errors = ref({});
const loading = ref(false);

const login = async () => {
  loading.value = true;
  errors.value = {};

  try {
    await axios.get('/sanctum/csrf-cookie');

    const response = await axios.post('/login', form.value);

    if (response.data.message) {
      router.visit('/');
    }
  } catch (error) {
    if (error.response?.data?.errors) {
      errors.value = error.response.data.errors;
    } else {
      errors.value.general = 'Произошла ошибка при входе';
    }
  } finally {
    loading.value = false;
  }
};
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
