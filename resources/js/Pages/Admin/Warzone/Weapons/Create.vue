<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Create Weapon Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <!-- Background -->
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-5xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> WEAPON_EDITOR INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> CREATING NEW_WEAPON.cfg
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> EDITOR READY
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10">
            <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                СОЗДАТЬ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>ОРУЖИЕ</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Form -->
          <form @submit.prevent="submit" class="space-y-6">
            <!-- Error Messages -->
            <div v-if="Object.keys(errors).length > 0" class="border border-red-500/30 bg-red-900/20 p-4 font-mono">
              <div class="text-red-500 text-sm mb-2">
                <span class="text-red-600">&gt;</span> ERRORS DETECTED:
              </div>
              <ul class="list-disc list-inside text-red-400 text-xs space-y-1">
                <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
              </ul>
            </div>

            <!-- Name -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> WEAPON_NAME:
              </label>
              <input
                v-model="form.name"
                type="text"
                required
                placeholder="Например: MCW"
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              />
            </div>

            <!-- Tier -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> TIER:
              </label>
              <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <label
                  v-for="tier in tiers"
                  :key="tier.value"
                  class="cursor-pointer"
                >
                  <input
                    type="radio"
                    v-model="form.tier"
                    :value="tier.value"
                    class="hidden"
                  />
                  <div
                    :class="[
                      'p-3 border-2 transition-all text-center',
                      form.tier === tier.value
                        ? 'border-orange-500 bg-orange-500/10'
                        : 'border-orange-500/30 bg-black hover:border-orange-500/60'
                    ]"
                  >
                    <TierBadge :tier="tier.value" :label="tier.label" />
                  </div>
                </label>
              </div>
            </div>

            <!-- Origin Game -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> ORIGIN_GAME:
              </label>
              <select
                v-model="form.origin_game"
                required
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              >
                <option value="">Выберите игру</option>
                <option v-for="origin in origins" :key="origin.value" :value="origin.value">
                  {{ origin.label }}
                </option>
              </select>
            </div>

            <!-- Category -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> CATEGORY:
              </label>
              <select
                v-model="form.category"
                required
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              >
                <option value="">Выберите категорию</option>
                <option v-for="cat in categories" :key="cat.value" :value="cat.value">
                  {{ cat.label }}
                </option>
              </select>
            </div>

            <!-- Description -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> DESCRIPTION:
              </label>
              <textarea
                v-model="form.description"
                rows="4"
                placeholder="Краткое описание оружия (опционально)"
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors resize-none"
              ></textarea>
            </div>

            <!-- Image Upload -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> IMAGE:
              </label>
              <div class="space-y-3">
                <input
                  type="file"
                  @change="handleImageUpload"
                  accept="image/*"
                  class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-mono file:bg-orange-600 file:text-black hover:file:bg-orange-500"
                />
                <div v-if="imagePreview" class="border border-orange-500/30 p-4 bg-black">
                  <div class="text-orange-600 font-mono text-xs mb-2">PREVIEW:</div>
                  <img :src="imagePreview" alt="Preview" class="max-w-xs max-h-64 object-contain border border-orange-500/30" />
                </div>
              </div>
            </div>

            <!-- Is Active -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="flex items-center gap-3 cursor-pointer">
                <input
                  type="checkbox"
                  v-model="form.is_active"
                  class="w-5 h-5 bg-black border-2 border-orange-500/30 text-orange-500 focus:ring-orange-500"
                />
                <span class="text-orange-600 font-mono text-sm">
                  <span class="text-orange-600">&gt;</span> IS_ACTIVE (показывать публично)
                </span>
              </label>
            </div>

            <!-- Sort Order -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> SORT_ORDER:
              </label>
              <input
                v-model.number="form.sort_order"
                type="number"
                min="0"
                placeholder="0"
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              />
              <div class="text-gray-500 text-xs font-mono mt-2">
                * Меньше число = выше в списке
              </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 justify-end">
              <Link
                href="/admin/warzone/weapons"
                class="px-6 py-3 bg-gray-800 border border-gray-600 text-gray-300 font-mono hover:bg-gray-700 transition-all"
              >
                <span class="text-gray-500">&gt;</span> CANCEL
              </Link>
              <button
                type="submit"
                :disabled="processing"
                class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black font-black font-mono tracking-wider transition-all disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span class="text-orange-600">&gt;</span> {{ processing ? 'CREATING...' : 'CREATE_WEAPON' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import TierBadge from '@/Components/Warzone/TierBadge.vue';

const props = defineProps({
  tiers: Array,
  origins: Array,
  categories: Array,
  errors: {
    type: Object,
    default: () => ({})
  }
});

const form = useForm({
  name: '',
  tier: 'meta',
  origin_game: '',
  category: '',
  description: '',
  image: null,
  is_active: true,
  sort_order: 0
});

const imagePreview = ref(null);
const processing = ref(false);

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;

    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const submit = () => {
  processing.value = true;

  form.post('/admin/warzone/weapons', {
    onFinish: () => {
      processing.value = false;
    },
    onError: () => {
      processing.value = false;
    }
  });
};
</script>

<style scoped>
.terminal-glow {
  text-shadow: 0 0 10px rgba(249, 115, 22, 0.5);
}

.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>
