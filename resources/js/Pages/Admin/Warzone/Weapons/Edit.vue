<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Edit Weapon Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-6xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> WEAPON_EDITOR INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> EDITING WEAPON_{{ weapon.id }}.cfg
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
                РЕДАКТИРОВАТЬ
              </span>
            </h1>
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
              <span>{{ weapon.name }}</span>
              <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
            </h2>
          </div>

          <!-- Success Message -->
          <div v-if="$page.props.flash?.success" class="mb-6 border border-green-500/30 bg-green-900/20 p-4 font-mono">
            <div class="text-green-500 text-sm">
              <span class="text-green-600">&gt;</span> {{ $page.props.flash.success }}
            </div>
          </div>

          <!-- Weapon Form -->
          <form @submit.prevent="submitWeapon" class="space-y-6 mb-12">
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
                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 transition-colors"
              />
            </div>

            <div class="grid md:grid-cols-2 gap-6">
              <!-- Tier -->
              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <label class="text-orange-600 font-mono text-sm mb-3 block">
                  <span class="text-orange-600">&gt;</span> TIER:
                </label>
                <div class="grid grid-cols-2 gap-2">
                  <label v-for="tier in tiers" :key="tier.value" class="cursor-pointer">
                    <input type="radio" v-model="form.tier" :value="tier.value" class="hidden" />
                    <div :class="['p-2 border-2 transition-all text-center', form.tier === tier.value ? 'border-orange-500 bg-orange-500/10' : 'border-orange-500/30 bg-black hover:border-orange-500/60']">
                      <TierBadge :tier="tier.value" :label="tier.label" />
                    </div>
                  </label>
                </div>
              </div>

              <!-- Origin -->
              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <label class="text-orange-600 font-mono text-sm mb-3 block">
                  <span class="text-orange-600">&gt;</span> ORIGIN_GAME:
                </label>
                <select v-model="form.origin_game" required class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500">
                  <option v-for="origin in origins" :key="origin.value" :value="origin.value">{{ origin.label }}</option>
                </select>
              </div>
            </div>

            <!-- Category & Description -->
            <div class="grid md:grid-cols-2 gap-6">
              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <label class="text-orange-600 font-mono text-sm mb-3 block">
                  <span class="text-orange-600">&gt;</span> CATEGORY:
                </label>
                <select v-model="form.category" required class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500">
                  <option v-for="cat in categories" :key="cat.value" :value="cat.value">{{ cat.label }}</option>
                </select>
              </div>

              <div class="border border-orange-500/30 bg-orange-500/5 p-6">
                <label class="flex items-center gap-3 cursor-pointer">
                  <input type="checkbox" v-model="form.is_active" class="w-5 h-5 bg-black border-2 border-orange-500/30 text-orange-500 focus:ring-orange-500" />
                  <span class="text-orange-600 font-mono text-sm">
                    <span class="text-orange-600">&gt;</span> IS_ACTIVE
                  </span>
                </label>
                <div class="mt-4">
                  <label class="text-orange-600 font-mono text-xs mb-2 block">SORT_ORDER:</label>
                  <input v-model.number="form.sort_order" type="number" min="0" class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white text-sm font-mono focus:outline-none focus:border-orange-500" />
                </div>
              </div>
            </div>

            <!-- Description -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> DESCRIPTION:
              </label>
              <textarea v-model="form.description" rows="3" class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono focus:outline-none focus:border-orange-500 resize-none"></textarea>
            </div>

            <!-- Image -->
            <div class="border border-orange-500/30 bg-orange-500/5 p-6">
              <label class="text-orange-600 font-mono text-sm mb-3 block">
                <span class="text-orange-600">&gt;</span> IMAGE:
              </label>
              <div v-if="weapon.image" class="mb-3">
                <div class="text-xs text-gray-500 font-mono mb-2">CURRENT:</div>
                <img :src="`/storage/${weapon.image}`" alt="Current" class="max-h-32 border border-orange-500/30" />
              </div>
              <input type="file" @change="handleImageUpload" accept="image/*" class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:font-mono file:bg-orange-600 file:text-black hover:file:bg-orange-500" />
              <div v-if="imagePreview" class="mt-3">
                <div class="text-xs text-orange-600 font-mono mb-2">NEW PREVIEW:</div>
                <img :src="imagePreview" alt="Preview" class="max-h-32 border border-orange-500/30" />
              </div>
            </div>

            <!-- Submit -->
            <div class="flex gap-4 justify-end">
              <Link href="/admin/warzone/weapons" class="px-6 py-3 bg-gray-800 border border-gray-600 text-gray-300 font-mono hover:bg-gray-700">
                <span class="text-gray-500">&gt;</span> BACK
              </Link>
              <button type="submit" :disabled="processing" class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-black font-black font-mono disabled:opacity-50">
                <span class="text-orange-600">&gt;</span> {{ processing ? 'UPDATING...' : 'UPDATE_WEAPON' }}
              </button>
            </div>
          </form>

          <!-- Builds Management Section -->
          <div class="border-t-2 border-orange-500/30 pt-12 mt-12">
            <div class="mb-6 font-mono text-sm">
              <div class="text-orange-500 mb-2">
                <span class="text-orange-600">&gt;</span> BUILD_MANAGER_LINK INITIALIZED...
              </div>
              <div class="h-px bg-gradient-to-r from-emerald-500 via-green-500 to-transparent"></div>
            </div>

            <div class="border-2 border-emerald-500/30 bg-gradient-to-br from-emerald-500/5 to-green-500/5 overflow-hidden">
              <!-- Header -->
              <div class="bg-gradient-to-r from-emerald-500/20 to-transparent p-6 border-b-2 border-emerald-500/30">
                <div class="flex items-center gap-3 mb-2">
                  <svg class="w-8 h-8 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                  </svg>
                  <h3 class="text-3xl font-black text-emerald-500 uppercase font-mono">
                    <span class="text-emerald-600">&gt;</span> УПРАВЛЕНИЕ БИЛДАМИ
                  </h3>
                </div>
                <p class="text-emerald-400 font-mono text-sm ml-11">
                  Создавайте и редактируйте билды для этого оружия
                </p>
              </div>

              <!-- Content -->
              <div class="p-8">
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                  <!-- Stat Card 1 -->
                  <div class="border border-emerald-500/30 bg-black/40 p-4">
                    <div class="flex items-center gap-3 mb-2">
                      <div class="w-10 h-10 bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                        <span class="text-2xl">📦</span>
                      </div>
                      <div>
                        <div class="text-emerald-500 text-xs font-mono">ВСЕГО БИЛДОВ</div>
                        <div class="text-3xl font-black text-white">{{ weapon.builds?.length || 0 }}</div>
                      </div>
                    </div>
                  </div>

                  <!-- Stat Card 2 -->
                  <div class="border border-emerald-500/30 bg-black/40 p-4">
                    <div class="flex items-center gap-3 mb-2">
                      <div class="w-10 h-10 bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                        <span class="text-2xl">✅</span>
                      </div>
                      <div>
                        <div class="text-emerald-500 text-xs font-mono">АКТИВНЫХ</div>
                        <div class="text-3xl font-black text-white">{{ weapon.builds?.filter(b => b.is_active).length || 0 }}</div>
                      </div>
                    </div>
                  </div>

                  <!-- Stat Card 3 -->
                  <div class="border border-emerald-500/30 bg-black/40 p-4">
                    <div class="flex items-center gap-3 mb-2">
                      <div class="w-10 h-10 bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                        <span class="text-2xl">🔧</span>
                      </div>
                      <div>
                        <div class="text-emerald-500 text-xs font-mono">С ATTACHMENTS</div>
                        <div class="text-3xl font-black text-white">{{ weapon.builds?.filter(b => b.attachments?.length > 0).length || 0 }}</div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Features List -->
                <div class="grid md:grid-cols-2 gap-4 mb-8">
                  <div class="flex items-start gap-3 text-gray-300 font-mono text-sm">
                    <span class="text-emerald-500 text-xl">✨</span>
                    <div>
                      <div class="font-bold text-emerald-400 mb-1">Drag & Drop</div>
                      <div class="text-xs text-gray-500">Перетаскивайте attachments для изменения порядка</div>
                    </div>
                  </div>
                  <div class="flex items-start gap-3 text-gray-300 font-mono text-sm">
                    <span class="text-emerald-500 text-xl">📋</span>
                    <div>
                      <div class="font-bold text-emerald-400 mb-1">Шаблоны билдов</div>
                      <div class="text-xs text-gray-500">Готовые конфигурации в один клик</div>
                    </div>
                  </div>
                  <div class="flex items-start gap-3 text-gray-300 font-mono text-sm">
                    <span class="text-emerald-500 text-xl">⚡</span>
                    <div>
                      <div class="font-bold text-emerald-400 mb-1">Быстрое редактирование</div>
                      <div class="text-xs text-gray-500">Никакого JSON - простые поля для stat modifiers</div>
                    </div>
                  </div>
                  <div class="flex items-start gap-3 text-gray-300 font-mono text-sm">
                    <span class="text-emerald-500 text-xl">🎨</span>
                    <div>
                      <div class="font-bold text-emerald-400 mb-1">Красивый интерфейс</div>
                      <div class="text-xs text-gray-500">Современный дизайн с анимациями</div>
                    </div>
                  </div>
                </div>

                <!-- Action Button -->
                <div class="text-center">
                  <Link
                    :href="`/admin/warzone/weapons/${weapon.id}/builds`"
                    class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-black font-mono text-xl shadow-2xl shadow-emerald-500/30 transition-all transform hover:scale-105"
                  >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="text-emerald-200">&gt;</span>
                    ОТКРЫТЬ МЕНЕДЖЕР БИЛДОВ
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                  </Link>
                  <div class="mt-4 text-xs text-gray-500 font-mono">
                    <span class="text-emerald-500">&gt;</span> Нажмите, чтобы перейти к управлению билдами
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  weapon: Object,
  tiers: Array,
  origins: Array,
  categories: Array,
  errors: { type: Object, default: () => ({}) }
});

const form = useForm({
  name: props.weapon.name,
  tier: props.weapon.tier,
  origin_game: props.weapon.origin_game,
  category: props.weapon.category,
  description: props.weapon.description,
  image: null,
  is_active: props.weapon.is_active,
  sort_order: props.weapon.sort_order
});

const imagePreview = ref(null);
const processing = ref(false);

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => { imagePreview.value = e.target.result; };
    reader.readAsDataURL(file);
  }
};

const submitWeapon = () => {
  processing.value = true;
  form.post(`/admin/warzone/weapons/${props.weapon.id}`, {
    onFinish: () => { processing.value = false; },
    forceFormData: true,
    preserveScroll: true
  });
};
</script>

<style scoped>
.terminal-glow { text-shadow: 0 0 10px rgba(249, 115, 22, 0.5); }
.cursor-blink { animation: blink 1s steps(1) infinite; }
@keyframes blink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }
</style>
