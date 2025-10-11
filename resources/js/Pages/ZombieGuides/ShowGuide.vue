<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative">
    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Achievement Notification -->
    <transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="transform translate-x-full opacity-0"
      enter-to-class="transform translate-x-0 opacity-100"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="transform translate-x-0 opacity-100"
      leave-to-class="transform translate-x-full opacity-0"
    >
      <div
        v-if="showAchievementNotification"
        class="fixed top-24 right-6 z-50 max-w-sm bg-gradient-to-br from-orange-500/20 to-red-500/20 border-2 border-orange-500 backdrop-blur-md p-6 shadow-2xl"
      >
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0">
            <svg class="w-12 h-12 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
          </div>
          <div class="flex-1">
            <div class="font-mono text-orange-500 font-bold text-sm mb-1">
              <span class="text-orange-600">&gt;</span> ACHIEVEMENT_UNLOCKED!
            </div>
            <h3 class="text-white font-black text-lg mb-2 uppercase font-mono">
              Guide Master
            </h3>
            <p class="text-gray-300 text-sm font-mono">
              Вы полностью просмотрели гайд по карте "{{ formatMapName(guide.map_slug) }}"
            </p>
          </div>
        </div>
        <div class="mt-4 h-1 bg-orange-500/20 overflow-hidden">
          <div class="h-full bg-orange-500 animate-pulse"></div>
        </div>
      </div>
    </transition>

    <!-- Guide Content -->
    <article class="pt-20 md:pt-32 pb-12 px-3 md:px-6 relative">
      <div class="container mx-auto max-w-7xl relative z-10">
        <div class="flex flex-col lg:flex-row gap-8">

          <!-- Main Content -->
          <div class="flex-1 max-w-4xl">
            <!-- Terminal Header -->
            <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
              <div class="text-orange-500 mb-2">
                <span class="text-orange-600">&gt;</span> LOADING_GUIDE...
              </div>
              <div class="text-orange-500/70 mb-2">
                <span class="text-orange-600">&gt;</span> {{ guide.game }} / {{ guide.map_name }}
              </div>
              <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-6 md:mb-8"></div>
            </div>

            <!-- Back Button -->
            <div class="mb-6 md:mb-8">
              <button
                @click="$inertia.visit(`/zombies/${guide.game}/${guide.map_slug}/guides`)"
                class="px-4 md:px-6 py-2 md:py-3 border-2 border-orange-500/30 text-orange-500 font-mono font-black hover:bg-orange-500/10 transition-all flex items-center gap-2 text-sm md:text-base"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-orange-600">&gt;</span> BACK_TO_GUIDES
              </button>
            </div>

            <!-- Guide Image -->
            <div v-if="guide.image" class="mb-6 md:mb-8 border-2 border-orange-500/30 overflow-hidden">
              <img
                :src="`/storage/${guide.image}`"
                :alt="guide.title"
                class="w-full aspect-video object-cover"
              />
            </div>

            <!-- Guide Header -->
            <header class="mb-8 md:mb-12">
              <h1 class="text-3xl md:text-4xl lg:text-6xl font-black mb-4 md:mb-6 leading-none uppercase font-mono">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  {{ guide.title }}
                </span>
              </h1>

              <!-- Meta Information -->
              <div class="flex flex-wrap items-center gap-4 md:gap-6 text-xs md:text-sm font-mono">
                <!-- Author -->
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-orange-500/20 flex items-center justify-center text-orange-500 font-bold text-sm md:text-base overflow-hidden">
                    <img
                      v-if="guide.user?.avatar"
                      :src="`/storage/${guide.user.avatar}`"
                      :alt="guide.user.name"
                      class="w-full h-full object-cover"
                    />
                    <span v-else>{{ guide.user?.name?.charAt(0)?.toUpperCase() || '?' }}</span>
                  </div>
                  <div>
                    <div class="text-orange-500/70 text-[10px] md:text-xs">AUTHOR</div>
                    <div class="text-white text-sm md:text-base">{{ guide.user?.name || 'Unknown' }}</div>
                  </div>
                </div>

                <!-- Views -->
                <div class="flex items-center gap-2 text-orange-500/70">
                  <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  <span>{{ guide.views }} views</span>
                </div>

                <!-- Date -->
                <div class="text-orange-500/70">
                  <span class="text-orange-600">&gt;</span> {{ formatDate(guide.created_at) }}
                </div>
              </div>

              <!-- Description -->
              <div v-if="guide.description" class="mt-4 md:mt-6 p-3 md:p-4 border-l-4 border-orange-500/50 bg-orange-500/5">
                <p class="text-gray-300 text-base md:text-lg">{{ guide.description }}</p>
              </div>
            </header>

            <!-- Recommended Items Section -->
            <div v-if="recommendedWeapons.length > 0 || recommendedWonderWeapons.length > 0 || recommendedSpecialWeapons.length > 0 || recommendedPerks.length > 0 || recommendedGums.length > 0 || recommendedElixirs.length > 0 || recommendedFieldUpgrades.length > 0 || recommendedTalismans.length > 0" class="mb-8 md:mb-12">
              <div class="border-2 border-orange-500/50 bg-orange-500/5 p-4 md:p-6">
                <div class="flex items-center justify-between mb-4 md:mb-6">
                  <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h2 class="text-lg md:text-xl font-black text-orange-500 font-mono uppercase">
                      <span class="text-orange-600">&gt;</span> Рекомендуемые предметы
                    </h2>
                  </div>
                  <button
                    @click="itemsExpanded = !itemsExpanded"
                    class="text-orange-500 hover:text-orange-400 transition-colors p-2"
                    :title="itemsExpanded ? 'Свернуть' : 'Развернуть'"
                  >
                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': !itemsExpanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                  </button>
                </div>

                <transition
                  enter-active-class="transition-all duration-300 ease-out"
                  enter-from-class="opacity-0 max-h-0"
                  enter-to-class="opacity-100 max-h-[2000px]"
                  leave-active-class="transition-all duration-300 ease-in"
                  leave-from-class="opacity-100 max-h-[2000px]"
                  leave-to-class="opacity-0 max-h-0"
                >
                  <div v-show="itemsExpanded" class="overflow-hidden space-y-5">
                    <!-- Weapons -->
                    <div v-if="recommendedWeapons.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Оружие:
                      </h3>
                      <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 md:gap-3">
                        <div
                          v-for="weapon in recommendedWeapons"
                          :key="weapon.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = weapon.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-[4/3] border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black">
                            <img
                              v-if="weapon.image"
                              :src="`/storage/${weapon.image}`"
                              :alt="weapon.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                          </div>
                          <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center">{{ weapon.name }}</div>
                        </div>
                      </div>
                    </div>

                    <!-- Wonder Weapons -->
                    <div v-if="recommendedWonderWeapons.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Чудо-оружие:
                      </h3>
                      <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 md:gap-3">
                        <div
                          v-for="weapon in recommendedWonderWeapons"
                          :key="weapon.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = weapon.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-[4/3] border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black">
                            <img
                              v-if="weapon.image"
                              :src="`/storage/${weapon.image}`"
                              :alt="weapon.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                          </div>
                          <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center">{{ weapon.name }}</div>
                        </div>
                      </div>
                    </div>

                    <!-- Special Weapons -->
                    <div v-if="recommendedSpecialWeapons.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Специальное оружие:
                      </h3>
                      <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 md:gap-3">
                        <div
                          v-for="weapon in recommendedSpecialWeapons"
                          :key="weapon.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = weapon.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-[4/3] border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black">
                            <img
                              v-if="weapon.image"
                              :src="`/storage/${weapon.image}`"
                              :alt="weapon.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                          </div>
                          <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center">{{ weapon.name }}</div>
                        </div>
                      </div>
                    </div>

                    <!-- Perks -->
                    <div v-if="recommendedPerks.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Перки:
                      </h3>
                      <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 md:gap-3">
                        <div
                          v-for="perk in recommendedPerks"
                          :key="perk.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = perk.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-square border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black">
                            <img
                              v-if="perk.image"
                              :src="`/storage/${perk.image}`"
                              :alt="perk.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                          </div>
                          <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center">{{ perk.name }}</div>
                        </div>
                      </div>
                    </div>

                    <!-- Gums -->
                    <div v-if="recommendedGums.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Жвачки:
                      </h3>
                      <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 md:gap-3">
                        <div
                          v-for="gum in recommendedGums"
                          :key="gum.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = gum.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-square border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black relative">
                            <img
                              v-if="gum.image"
                              :src="`/storage/${gum.image}`"
                              :alt="gum.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <!-- Rarity Badge -->
                            <div v-if="gum.rarity" class="absolute top-1 right-1">
                              <div
                                class="w-2 h-2 rounded-full border border-black/50"
                                :class="getRarityClasses(gum.rarity)"
                                :title="getRarityName(gum.rarity)"
                              ></div>
                            </div>
                          </div>
                          <div class="flex flex-col items-center gap-1">
                            <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center w-full">{{ gum.name }}</div>
                            <div v-if="gum.rarity"
                              class="text-[8px] font-mono font-bold px-1.5 py-0.5 rounded"
                              :class="getRarityClasses(gum.rarity)"
                            >
                              {{ getRarityName(gum.rarity).toUpperCase() }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Elixirs -->
                    <div v-if="recommendedElixirs.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Элексиры:
                      </h3>
                      <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 md:gap-3">
                        <div
                          v-for="elixir in recommendedElixirs"
                          :key="elixir.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = elixir.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-square border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black relative">
                            <img
                              v-if="elixir.image"
                              :src="`/storage/${elixir.image}`"
                              :alt="elixir.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div v-if="elixir.rarity" class="absolute top-1 right-1">
                              <div
                                class="w-2 h-2 rounded-full border border-black/50"
                                :class="getRarityClasses(elixir.rarity)"
                                :title="getRarityName(elixir.rarity)"
                              ></div>
                            </div>
                          </div>
                          <div class="flex flex-col items-center gap-1">
                            <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center w-full">{{ elixir.name }}</div>
                            <div v-if="elixir.rarity"
                              class="text-[8px] font-mono font-bold px-1.5 py-0.5 rounded"
                              :class="getRarityClasses(elixir.rarity)"
                            >
                              {{ getRarityName(elixir.rarity).toUpperCase() }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Field Upgrades -->
                    <div v-if="recommendedFieldUpgrades.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Полевые модификации:
                      </h3>
                      <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 md:gap-3">
                        <div
                          v-for="fieldUpgrade in recommendedFieldUpgrades"
                          :key="fieldUpgrade.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = fieldUpgrade.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-square border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black">
                            <img
                              v-if="fieldUpgrade.image"
                              :src="`/storage/${fieldUpgrade.image}`"
                              :alt="fieldUpgrade.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                          </div>
                          <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center">{{ fieldUpgrade.name }}</div>
                        </div>
                      </div>
                    </div>

                    <!-- Talismans -->
                    <div v-if="recommendedTalismans.length > 0">
                      <h3 class="text-xs md:text-sm font-mono text-orange-600 mb-3 uppercase">
                        <span class="text-orange-600">&gt;</span> Талисманы:
                      </h3>
                      <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 md:gap-3">
                        <div
                          v-for="talisman in recommendedTalismans"
                          :key="talisman.id"
                          class="border border-orange-500/30 bg-black/50 p-2 hover:bg-orange-500/10 transition-all group relative"
                          @mouseenter="showTooltip = talisman.id"
                          @mouseleave="showTooltip = null"
                        >
                          <div class="aspect-square border border-orange-500/30 mb-2 overflow-hidden flex items-center justify-center bg-black relative">
                            <img
                              v-if="talisman.image"
                              :src="`/storage/${talisman.image}`"
                              :alt="talisman.name"
                              class="w-full h-full object-contain group-hover:scale-110 transition-transform"
                            />
                            <svg v-else class="w-6 h-6 text-orange-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div v-if="talisman.rarity" class="absolute top-1 right-1">
                              <div
                                class="w-2 h-2 rounded-full border border-black/50"
                                :class="getTalismanRarityClasses(talisman.rarity)"
                                :title="getTalismanRarityName(talisman.rarity)"
                              ></div>
                            </div>
                          </div>
                          <div class="flex flex-col items-center gap-1">
                            <div class="text-[10px] md:text-xs font-mono text-orange-500 truncate text-center w-full">{{ talisman.name }}</div>
                            <div v-if="talisman.rarity"
                              class="text-[8px] font-mono font-bold px-1.5 py-0.5 rounded"
                              :class="getTalismanRarityClasses(talisman.rarity)"
                            >
                              {{ getTalismanRarityName(talisman.rarity).toUpperCase() }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </transition>
              </div>
            </div>

            <!-- Floating Tooltip -->
            <Teleport to="body">
              <div
                v-if="showTooltip && getTooltipData(showTooltip)"
                class="fixed z-[10000] pointer-events-none"
                :style="tooltipStyle"
              >
                <div class="bg-black/95 backdrop-blur-sm border-2 border-orange-500 shadow-2xl p-4 max-w-xs">
                  <div class="text-orange-500 font-bold mb-2 text-sm font-mono">{{ getTooltipData(showTooltip).name }}</div>
                  <div class="text-gray-300 text-xs leading-relaxed">{{ getTooltipData(showTooltip).description }}</div>
                </div>
              </div>
            </Teleport>

            <!-- Guide Content -->
            <div class="prose prose-invert prose-orange max-w-none">
              <div ref="contentRef" class="guide-content text-gray-300 leading-relaxed text-base md:text-lg" v-html="guide.content"></div>
            </div>

            <!-- Footer -->
            <footer class="mt-8 md:mt-12 pt-6 md:pt-8 border-t border-orange-500/20">
              <div class="font-mono text-orange-500/70 text-xs md:text-sm">
                <span class="text-orange-600">&gt;</span> END_OF_GUIDE
              </div>
            </footer>
          </div>

          <!-- Table of Contents Sidebar -->
          <aside class="lg:w-80 order-first lg:order-last">
            <div
              v-if="tableOfContents.length > 0"
              class="bg-black/50 border-2 border-orange-500/30 p-4 md:p-6 backdrop-blur-sm"
              :class="sidebarClasses"
            >
              <!-- TOC Header -->
              <div class="mb-4 font-mono">
                <div class="text-orange-600 text-xs md:text-sm mb-2">
                  <span class="text-orange-600">&gt;</span> TABLE_OF_CONTENTS
                </div>
                <div class="h-px bg-gradient-to-r from-orange-500 to-transparent mb-4"></div>
              </div>

              <!-- TOC List -->
              <nav class="space-y-1">
                <a
                  v-for="(item, index) in tableOfContents"
                  :key="index"
                  :href="`#${item.id}`"
                  @click.prevent="scrollToHeading(item.id)"
                  class="block py-2 px-3 text-xs md:text-sm font-mono transition-all border-l-2 hover:border-orange-500 hover:bg-orange-500/10"
                  :class="{
                    'text-orange-500 border-orange-500 bg-orange-500/10': activeHeading === item.id,
                    'text-gray-400 border-orange-500/20': activeHeading !== item.id,
                    'pl-3': item.level === 2,
                    'pl-6': item.level === 3,
                    'pl-9': item.level === 4
                  }"
                >
                  <span class="text-orange-600 mr-1">&gt;</span>{{ item.text }}
                </a>
              </nav>

              <!-- Scroll Progress -->
              <div class="mt-6 pt-4 border-t border-orange-500/20">
                <div class="flex items-center justify-between text-xs font-mono text-orange-500/70 mb-2">
                  <span>PROGRESS:</span>
                  <span>{{ scrollProgress }}%</span>
                </div>
                <div class="h-1 bg-orange-500/20 overflow-hidden">
                  <div
                    class="h-full bg-orange-500 transition-all duration-300"
                    :style="{ width: scrollProgress + '%' }"
                  ></div>
                </div>
              </div>
            </div>
          </aside>

        </div>
      </div>
    </article>
  </div>
</template>

<script setup>
import { defineProps, ref, onMounted, onUnmounted, nextTick } from 'vue';
import Header from '../../Components/Header.vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
  guide: Object,
  hasAchievement: Boolean,
  recommendedWeapons: {
    type: Array,
    default: () => []
  },
  recommendedWonderWeapons: {
    type: Array,
    default: () => []
  },
  recommendedSpecialWeapons: {
    type: Array,
    default: () => []
  },
  recommendedPerks: {
    type: Array,
    default: () => []
  },
  recommendedGums: {
    type: Array,
    default: () => []
  },
  recommendedElixirs: {
    type: Array,
    default: () => []
  },
  recommendedFieldUpgrades: {
    type: Array,
    default: () => []
  },
  recommendedTalismans: {
    type: Array,
    default: () => []
  }
});

const contentRef = ref(null);
const tableOfContents = ref([]);
const activeHeading = ref('');
const scrollProgress = ref(0);
const achievementUnlocked = ref(props.hasAchievement);
const showAchievementNotification = ref(false);
const itemsExpanded = ref(true);
const showTooltip = ref(null);

const sidebarClasses = ref('lg:sticky lg:top-32 lg:max-h-[calc(100vh-9rem)] lg:overflow-y-auto');

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('ru-RU', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
};

const formatMapName = (mapSlug) => {
  if (!mapSlug) return '';

  // Преобразуем slug в читаемое название (например: "der-riese" -> "Der Riese")
  return mapSlug
    .split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ');
};

// Генерация оглавления из заголовков
const generateTableOfContents = () => {
  if (!contentRef.value) return;

  const headings = contentRef.value.querySelectorAll('h2, h3, h4');
  const toc = [];

  headings.forEach((heading, index) => {
    // Создаем ID для заголовка если его нет
    if (!heading.id) {
      const id = `heading-${index}-${heading.textContent.toLowerCase().replace(/[^a-zа-я0-9]+/gi, '-')}`;
      heading.id = id;
    }

    toc.push({
      id: heading.id,
      text: heading.textContent,
      level: parseInt(heading.tagName.charAt(1))
    });
  });

  tableOfContents.value = toc;
};

// Плавная прокрутка к заголовку
const scrollToHeading = (id) => {
  const element = document.getElementById(id);
  if (element) {
    const offset = 100; // Отступ от верха
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - offset;

    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    });
  }
};

// Разблокировать достижение
const unlockAchievement = async () => {
  if (achievementUnlocked.value) {
    return; // Уже разблокировано
  }

  try {
    const response = await axios.post(`/zombies/${props.guide.game}/${props.guide.map_slug}/guides/${props.guide.id}/complete`);

    if (response.data.success) {
      achievementUnlocked.value = true;
      showAchievementNotification.value = true;

      // Скрываем уведомление через 5 секунд
      setTimeout(() => {
        showAchievementNotification.value = false;
      }, 5000);
    }
  } catch (error) {
    console.log('Achievement error:', error);
  }
};

// Отслеживание активного заголовка при прокрутке
const updateActiveHeading = () => {
  if (!contentRef.value) return;

  const headings = contentRef.value.querySelectorAll('h2, h3, h4');
  const scrollPosition = window.scrollY + 150;

  let currentHeading = '';

  headings.forEach((heading) => {
    if (heading.offsetTop <= scrollPosition) {
      currentHeading = heading.id;
    }
  });

  activeHeading.value = currentHeading;

  // Вычисляем прогресс прокрутки
  const windowHeight = window.innerHeight;
  const documentHeight = document.documentElement.scrollHeight;
  const scrollTop = window.pageYOffset;
  const trackLength = documentHeight - windowHeight;
  const progress = Math.floor((scrollTop / trackLength) * 100);

  scrollProgress.value = Math.min(100, Math.max(0, progress));

  // Проверяем, достигли ли 100% и разблокируем достижение
  if (scrollProgress.value >= 100 && !achievementUnlocked.value) {
    unlockAchievement();
  }
};

onMounted(() => {
  nextTick(() => {
    generateTableOfContents();
    window.addEventListener('scroll', updateActiveHeading);
    window.addEventListener('mousemove', updateTooltipPosition);
    updateActiveHeading();

    // Добавляем обработчик кликов на якорные ссылки в контенте
    if (contentRef.value) {
      contentRef.value.addEventListener('click', handleContentClick);
    }
  });
});

onUnmounted(() => {
  window.removeEventListener('scroll', updateActiveHeading);
  window.removeEventListener('mousemove', updateTooltipPosition);

  // Удаляем обработчик кликов
  if (contentRef.value) {
    contentRef.value.removeEventListener('click', handleContentClick);
  }
});

// Обработчик кликов на ссылки в контенте
const handleContentClick = (event) => {
  const target = event.target;

  // Проверяем, является ли клик на ссылке
  if (target.tagName === 'A') {
    const href = target.getAttribute('href');

    // Если это якорная ссылка (начинается с #)
    if (href && href.startsWith('#')) {
      event.preventDefault();
      const id = href.substring(1);
      scrollToHeading(id);
    }
  }
};

// Получить данные для tooltip'а
const getTooltipData = (id) => {
  // Проверяем все категории предметов
  const allItems = [
    ...props.recommendedWeapons,
    ...props.recommendedWonderWeapons,
    ...props.recommendedSpecialWeapons,
    ...props.recommendedPerks,
    ...props.recommendedGums,
    ...props.recommendedElixirs,
    ...props.recommendedFieldUpgrades,
    ...props.recommendedTalismans
  ];

  const item = allItems.find(i => i.id === id);
  if (item && item.description) {
    return {
      name: item.name,
      description: item.description
    };
  }

  return null;
};

// Стиль для tooltip'а
const tooltipStyle = ref({
  top: '0px',
  left: '0px',
  transform: 'translate(-50%, calc(-100% - 10px))'
});

// Обновить позицию tooltip'а
const updateTooltipPosition = (event) => {
  const { clientX, clientY } = event;
  tooltipStyle.value = {
    top: `${clientY}px`,
    left: `${clientX}px`,
    transform: 'translate(-50%, calc(-100% - 10px))'
  };
};

// Получить название редкости
const getRarityName = (rarity) => {
  const rarityNames = {
    rare: 'Редкая',
    epic: 'Эпическая',
    legendary: 'Легендарная',
    ultra: 'Ультра',
    whimsical: 'Причудливая'
  };
  return rarityNames[rarity] || rarity;
};

// Получить CSS-классы для редкости
const getRarityClasses = (rarity) => {
  const rarityClasses = {
    rare: 'bg-blue-500 text-white',
    epic: 'bg-purple-500 text-white',
    legendary: 'bg-amber-500 text-black',
    ultra: 'bg-red-600 text-white',
    whimsical: 'bg-gradient-to-r from-green-500 via-purple-500 to-orange-500 text-white'
  };
  return rarityClasses[rarity] || 'bg-gray-500 text-white';
};

// Получить название редкости талисмана
const getTalismanRarityName = (rarity) => {
  const rarityNames = {
    common: 'Обычный',
    rare: 'Редкий',
    epic: 'Эпический',
    legendary: 'Легендарный'
  };
  return rarityNames[rarity] || rarity;
};

// Получить CSS-классы для редкости талисмана
const getTalismanRarityClasses = (rarity) => {
  const rarityClasses = {
    common: 'bg-gray-400 text-black',
    rare: 'bg-blue-500 text-white',
    epic: 'bg-purple-500 text-white',
    legendary: 'bg-amber-500 text-black'
  };
  return rarityClasses[rarity] || 'bg-gray-500 text-white';
};
</script>

<style scoped>
/* Terminal Glow */
.terminal-glow {
  text-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
}

/* Guide Content Styles */
:deep(.guide-content) {
  font-size: 1.125rem;
  line-height: 1.75;
}

:deep(.guide-content h2) {
  font-size: 1.75rem;
  font-weight: 900;
  color: #f97316;
  margin-top: 2rem;
  margin-bottom: 1rem;
  text-transform: uppercase;
  font-family: monospace;
  scroll-margin-top: 100px;
}

:deep(.guide-content h3) {
  font-size: 1.35rem;
  font-weight: 700;
  color: #fb923c;
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
  font-family: monospace;
  scroll-margin-top: 100px;
}

:deep(.guide-content h4) {
  font-size: 1.15rem;
  font-weight: 600;
  color: #fdba74;
  margin-top: 1.25rem;
  margin-bottom: 0.5rem;
  font-family: monospace;
  scroll-margin-top: 100px;
}

:deep(.guide-content p) {
  margin-bottom: 1rem;
}

:deep(.guide-content ul),
:deep(.guide-content ol) {
  margin-left: 1.5rem;
  margin-bottom: 1rem;
}

:deep(.guide-content li) {
  margin-bottom: 0.5rem;
}

:deep(.guide-content a) {
  color: #f97316;
  text-decoration: underline;
}

:deep(.guide-content a:hover) {
  color: #fb923c;
}

:deep(.guide-content code) {
  background-color: rgba(249, 115, 22, 0.1);
  padding: 0.25rem 0.5rem;
  border-radius: 0.25rem;
  font-family: monospace;
  color: #fb923c;
}

:deep(.guide-content pre) {
  background-color: rgba(249, 115, 22, 0.05);
  border: 1px solid rgba(249, 115, 22, 0.3);
  padding: 1rem;
  border-radius: 0.25rem;
  overflow-x: auto;
  margin-bottom: 1rem;
}

:deep(.guide-content img) {
  max-width: 100%;
  height: auto;
  border: 2px solid rgba(249, 115, 22, 0.3);
  margin: 1.5rem 0;
}

:deep(.guide-content blockquote) {
  border-left: 4px solid #f97316;
  padding-left: 1rem;
  margin-left: 0;
  margin-bottom: 1rem;
  color: #d1d5db;
  font-style: italic;
  background-color: rgba(249, 115, 22, 0.05);
  padding: 1rem;
}

@media (max-width: 1024px) {
  :deep(.guide-content h2) {
    font-size: 1.5rem;
  }

  :deep(.guide-content h3) {
    font-size: 1.25rem;
  }

  :deep(.guide-content h4) {
    font-size: 1.1rem;
  }
}
</style>
