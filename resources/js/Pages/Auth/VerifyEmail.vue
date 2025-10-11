<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900 flex items-center justify-center px-4">
    <div class="max-w-md w-full">
      <div class="bg-gray-800 rounded-lg shadow-2xl p-8 border border-orange-500/20">
        <!-- Header -->
        <div class="text-center mb-6">
          <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-600 to-red-700 rounded-full flex items-center justify-center">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
          </div>
          <h2 class="text-3xl font-black text-white mb-2 font-mono">
            ПОДТВЕРДИТЕ EMAIL
          </h2>
          <p class="text-gray-400 text-sm font-mono">
            Проверьте вашу почту для завершения регистрации
          </p>
        </div>

        <!-- Content -->
        <div class="space-y-6">
          <div class="bg-orange-500/10 border border-orange-500/30 rounded-lg p-4">
            <p class="text-gray-300 text-sm leading-relaxed font-mono">
              Мы отправили письмо с ссылкой для подтверждения на адрес:
            </p>
            <p class="text-orange-500 font-bold mt-2 font-mono">
              {{ $page.props.auth.user.email }}
            </p>
          </div>

          <!-- Success Message -->
          <div v-if="status === 'verification-link-sent'" class="bg-green-500/10 border border-green-500/30 rounded-lg p-4">
            <p class="text-green-400 text-sm font-mono">
              ✓ Новое письмо с подтверждением отправлено!
            </p>
          </div>

          <!-- Resend Button -->
          <form @submit.prevent="resendVerification">
            <button
              type="submit"
              :disabled="loading"
              class="w-full py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-bold rounded-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed font-mono"
            >
              <span v-if="loading">Отправка...</span>
              <span v-else>Отправить письмо повторно</span>
            </button>
          </form>

          <div class="text-center">
            <Link href="/" class="text-orange-500 hover:text-orange-400 text-sm font-mono">
              ← Вернуться на главную
            </Link>
          </div>

          <!-- Instructions -->
          <div class="bg-gray-900/50 rounded-lg p-4 border border-gray-700">
            <p class="text-gray-400 text-xs leading-relaxed font-mono">
              <strong class="text-white">Не получили письмо?</strong><br>
              • Проверьте папку "Спам"<br>
              • Убедитесь, что email указан правильно<br>
              • Нажмите кнопку выше для повторной отправки
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const loading = ref(false);
const status = ref(null);

const resendVerification = () => {
  loading.value = true;

  router.post(route('verification.send'), {}, {
    preserveScroll: true,
    onSuccess: () => {
      status.value = 'verification-link-sent';
      loading.value = false;

      setTimeout(() => {
        status.value = null;
      }, 5000);
    },
    onError: () => {
      loading.value = false;
    }
  });
};
</script>

