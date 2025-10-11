<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">
    <!-- Terminal Background -->
    <div class="fixed inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Manage Builds Section -->
    <section class="pt-40 pb-24 px-6 relative min-h-screen">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-black to-orange-950/20"></div>

      <div class="container mx-auto relative z-10">
        <div class="max-w-7xl mx-auto">
          <!-- Terminal Header -->
          <div class="mb-8 font-mono text-sm">
            <div class="text-orange-500 mb-2">
              <span class="text-orange-600">&gt;</span> BUILD_MANAGER v2.0 INITIALIZED...
            </div>
            <div class="text-orange-500/70 mb-2">
              <span class="text-orange-600">&gt;</span> LOADING WEAPON_{{ weapon.id }}_BUILDS.cfg
            </div>
            <div class="text-orange-500 mb-4">
              <span class="text-orange-600">&gt;</span> ENHANCED UI READY
            </div>
            <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
          </div>

          <!-- Page Title -->
          <div class="mb-10 flex items-center justify-between">
            <div>
              <h1 class="text-5xl md:text-6xl font-black mb-2 leading-none uppercase font-mono">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 terminal-glow">
                  УПРАВЛЕНИЕ БИЛДАМИ
                </span>
              </h1>
              <h2 class="text-3xl md:text-4xl font-black text-white uppercase font-mono flex items-center">
                <span>{{ weapon.name }}</span>
                <span class="inline-block w-3 h-8 bg-orange-500 ml-3 cursor-blink"></span>
              </h2>
            </div>
            <Link :href="`/admin/warzone/weapons/${weapon.id}/edit`" class="hidden md:block px-6 py-3 bg-gray-800 border border-gray-600 text-gray-300 font-mono hover:bg-gray-700 transition-colors">
              <span class="text-gray-500">&gt;</span> НАЗАД
            </Link>
          </div>

          <!-- Success Message -->
          <div v-if="$page.props.flash?.success" class="mb-6 border border-green-500/30 bg-green-900/20 p-4 font-mono animate-fade-in">
            <div class="text-green-500 text-sm">
              <span class="text-green-600">&gt;</span> {{ $page.props.flash.success }}
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="border border-orange-500/30 bg-orange-500/5 p-4">
              <div class="text-orange-500 text-xs font-mono mb-1">ВСЕГО БИЛДОВ</div>
              <div class="text-3xl font-black text-white">{{ weapon.builds?.length || 0 }}</div>
            </div>
            <div class="border border-emerald-500/30 bg-emerald-500/5 p-4">
              <div class="text-emerald-500 text-xs font-mono mb-1">АКТИВНЫХ</div>
              <div class="text-3xl font-black text-white">{{ weapon.builds?.filter(b => b.is_active).length || 0 }}</div>
            </div>
            <div class="border border-blue-500/30 bg-blue-500/5 p-4">
              <div class="text-blue-500 text-xs font-mono mb-1">С ATTACHMENTS</div>
              <div class="text-3xl font-black text-white">{{ weapon.builds?.filter(b => b.attachments?.length > 0).length || 0 }}</div>
            </div>
            <div class="border border-purple-500/30 bg-purple-500/5 p-4">
              <div class="text-purple-500 text-xs font-mono mb-1">TIER OVERRIDES</div>
              <div class="text-3xl font-black text-white">{{ weapon.builds?.filter(b => b.tier_override).length || 0 }}</div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex gap-4 mb-8 flex-wrap">
            <button @click="openNewBuildModal" class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-black font-black font-mono text-lg transition-all transform hover:scale-105 shadow-lg shadow-emerald-500/30">
              <span class="text-emerald-900">&gt;</span> СОЗДАТЬ БИЛД
            </button>
            <button @click="showTemplatesModal = true" class="px-6 py-4 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-black font-black font-mono transition-all transform hover:scale-105 shadow-lg shadow-blue-500/30">
              📋 ШАБЛОНЫ
            </button>
          </div>

          <!-- Builds List -->
          <div v-if="!weapon.builds || weapon.builds.length === 0" class="border-2 border-dashed border-orange-500/30 bg-orange-500/5 p-16 text-center rounded-lg">
            <div class="text-gray-500 font-mono text-xl mb-4">
              <span class="text-orange-600">&gt;</span> НЕТ БИЛДОВ
            </div>
            <p class="text-sm text-gray-600 font-mono mb-8">Создайте первый билд для этого оружия</p>
            <button @click="openNewBuildModal" class="px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-black font-mono text-lg transition-all transform hover:scale-105 shadow-lg shadow-orange-500/30">
              <span class="text-orange-200">&gt;</span> СОЗДАТЬ ПЕРВЫЙ БИЛД
            </button>
          </div>

          <div v-else class="space-y-4">
            <div v-for="build in weapon.builds" :key="build.id" class="border-2 border-orange-500/30 bg-gradient-to-br from-orange-500/5 to-red-500/5 transition-all hover:border-orange-500/60 animate-fade-in">
              <div class="p-6 bg-gradient-to-r from-orange-500/10 to-transparent flex justify-between items-start gap-6">
                <div class="flex-1 cursor-pointer" @click="toggleBuild(build.id)">
                  <div class="flex items-center gap-4 mb-2">
                    <span class="text-orange-600 font-mono text-xl">&gt;</span>
                    <div class="flex-1">
                      <div class="font-bold font-mono text-white text-2xl mb-1">{{ build.title }}</div>
                      <div class="flex items-center gap-3 text-xs text-gray-400 font-mono">
                        <span class="flex items-center gap-1">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                          </svg>
                          {{ build.attachments?.length || 0 }} attachments
                        </span>
                        <span v-if="build.role" class="flex items-center gap-1">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                          </svg>
                          {{ build.role }}
                        </span>
                        <span :class="build.is_active ? 'text-emerald-500' : 'text-red-500'" class="flex items-center gap-1">
                          <span class="w-2 h-2 rounded-full" :class="build.is_active ? 'bg-emerald-500' : 'bg-red-500'"></span>
                          {{ build.is_active ? 'Активен' : 'Неактивен' }}
                        </span>
                      </div>
                    </div>
                    <TierBadge v-if="build.tier_override" :tier="build.tier_override" class="ml-auto" />
                  </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                  <button @click.stop="editBuild(build)" class="px-4 py-2 bg-orange-600/20 border border-orange-500/30 text-orange-500 text-sm font-mono hover:bg-orange-500/30 transition-all">
                    ✏️ EDIT
                  </button>
                  <button @click.stop="duplicateBuild(build)" class="px-4 py-2 bg-blue-600/20 border border-blue-500/30 text-blue-500 text-sm font-mono hover:bg-blue-500/30 transition-all" title="Дублировать билд">
                    📋 COPY
                  </button>
                  <button @click.stop="deleteBuild(build.id)" class="px-4 py-2 bg-red-600/20 border border-red-500/30 text-red-500 text-sm font-mono hover:bg-red-500/30 transition-all">
                    🗑️ DEL
                  </button>
                  <button @click.stop="toggleBuild(build.id)" class="p-2 bg-gray-800/50 border border-gray-600/30 text-gray-400 hover:text-orange-500 transition-all">
                    <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': expandedBuilds[build.id]}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Build Details (Expanded) -->
              <transition name="slide-down">
                <div v-show="expandedBuilds[build.id]" class="p-6 space-y-6 bg-black/40 border-t border-orange-500/20">
                  <div v-if="build.notes" class="text-sm text-gray-300 font-mono border-l-4 border-orange-500 pl-4 py-2 bg-orange-500/5">
                    <div class="text-orange-500 text-xs mb-1">NOTES:</div>
                    {{ build.notes }}
                  </div>

                  <!-- Attachments Display -->
                  <div class="border-2 border-orange-500/30">
                    <div class="bg-gradient-to-r from-orange-500/20 to-transparent p-3 text-xs font-mono text-orange-500 border-b border-orange-500/30 flex justify-between items-center">
                      <span>ATTACHMENTS LOADOUT:</span>
                      <span class="text-white">{{ build.attachments?.length || 0 }} / 5</span>
                    </div>

                    <div v-if="!build.attachments || build.attachments.length === 0" class="p-8 text-center text-gray-500 font-mono text-sm">
                      <div class="text-4xl mb-2">📦</div>
                      No attachments configured
                    </div>

                    <div v-else class="divide-y divide-orange-500/10">
                      <div v-for="att in build.attachments" :key="att.id" class="p-4 hover:bg-orange-500/5 transition-colors group">
                        <div class="flex items-start gap-4">
                          <div class="flex-shrink-0 w-24">
                            <div class="text-orange-400 uppercase text-xs font-mono font-bold mb-1">{{ att.slot }}</div>
                            <div class="h-1 bg-gradient-to-r from-orange-500 to-transparent rounded"></div>
                          </div>
                          <div class="flex-1">
                            <div class="text-white font-mono text-sm mb-1">{{ att.name }}</div>
                            <div v-if="att.stat_mods && Object.keys(att.stat_mods).length > 0" class="flex flex-wrap gap-2">
                              <span v-for="(value, key) in att.stat_mods" :key="key" class="inline-flex items-center px-2 py-1 bg-black/60 border border-orange-500/30 text-xs font-mono">
                                <span class="text-orange-500">{{ key }}:</span>
                                <span class="text-gray-300 ml-1">{{ value }}</span>
                              </span>
                            </div>
                            <div v-else class="text-gray-600 text-xs font-mono">No stat modifiers</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </transition>
            </div>
          </div>

          <!-- Add/Edit Build Modal -->
          <transition name="modal">
            <div v-if="showBuildModal" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4" @click.self="closeBuildModal">
              <div class="bg-zinc-900 border-2 border-orange-500 max-w-6xl w-full max-h-[90vh] flex flex-col shadow-2xl shadow-orange-500/20">
                <!-- Modal Header (Fixed) -->
                <div class="p-6 border-b-2 border-orange-500/30 bg-gradient-to-r from-orange-500/10 to-transparent flex justify-between items-center flex-shrink-0">
                  <h4 class="text-2xl font-black font-mono text-orange-500 flex items-center gap-3">
                    <span class="text-orange-600">&gt;</span>
                    {{ editingBuild ? '✏️ РЕДАКТИРОВАТЬ БИЛД' : '✨ СОЗДАТЬ БИЛД' }}
                  </h4>
                  <button @click="closeBuildModal" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="flex-1 overflow-y-auto">
                  <div class="grid md:grid-cols-2 gap-6 p-6">
                    <!-- Left Column: Build Info -->
                    <div class="space-y-6">
                      <div class="border-2 border-orange-500/30 bg-orange-500/5 p-6">
                        <h5 class="text-orange-500 font-mono text-sm mb-4 flex items-center gap-2">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                          </svg>
                          ОСНОВНАЯ ИНФОРМАЦИЯ
                        </h5>

                        <div class="space-y-4">
                          <div>
                            <label class="text-orange-400 font-mono text-xs mb-2 block">НАЗВАНИЕ БИЛДА *</label>
                            <input
                              v-model="buildForm.title"
                              type="text"
                              required
                              placeholder="Напр: Best Loadout for Close Range"
                              class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono text-sm focus:outline-none focus:border-orange-500 transition-colors placeholder-gray-600"
                            />
                          </div>

                          <div class="grid grid-cols-2 gap-4">
                            <div>
                              <label class="text-orange-400 font-mono text-xs mb-2 block">РОЛЬ</label>
                              <select
                                v-model="buildForm.role"
                                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono text-sm focus:outline-none focus:border-orange-500 transition-colors"
                              >
                                <option value="">Не указана</option>
                                <option value="Close Range">Close Range</option>
                                <option value="Mid Range">Mid Range</option>
                                <option value="Long Range">Long Range</option>
                                <option value="Sniper Support">Sniper Support</option>
                                <option value="Aggressive">Aggressive</option>
                                <option value="Balanced">Balanced</option>
                              </select>
                            </div>

                            <div>
                              <label class="text-orange-400 font-mono text-xs mb-2 block">TIER OVERRIDE</label>
                              <select
                                v-model="buildForm.tier_override"
                                class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono text-sm focus:outline-none focus:border-orange-500 transition-colors"
                              >
                                <option :value="null">По умолчанию</option>
                                <option v-for="tier in tiers" :key="tier.value" :value="tier.value">{{ tier.label }}</option>
                              </select>
                            </div>
                          </div>

                          <div>
                            <label class="text-orange-400 font-mono text-xs mb-2 block">ЗАМЕТКИ</label>
                            <textarea
                              v-model="buildForm.notes"
                              rows="3"
                              placeholder="Добавьте описание, рекомендации по использованию..."
                              class="w-full px-4 py-3 bg-black border-2 border-orange-500/30 text-white font-mono text-sm focus:outline-none focus:border-orange-500 transition-colors resize-none placeholder-gray-600"
                            ></textarea>
                          </div>

                          <div class="flex items-center gap-3 p-3 bg-black/60 border border-orange-500/30">
                            <input
                              type="checkbox"
                              id="is_active"
                              v-model="buildForm.is_active"
                              class="w-4 h-4 text-orange-500 bg-black border-orange-500/30 rounded focus:ring-orange-500"
                            />
                            <label for="is_active" class="text-sm font-mono text-gray-300 cursor-pointer">Активировать билд сразу</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Right Column: Attachments -->
                    <div class="space-y-4">
                      <div class="border-2 border-orange-500/30 bg-orange-500/5">
                        <div class="p-4 bg-gradient-to-r from-orange-500/20 to-transparent border-b-2 border-orange-500/30 flex justify-between items-center">
                          <h5 class="text-orange-500 font-mono text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                            </svg>
                            ATTACHMENTS ({{ buildForm.attachments.length }}/8)
                          </h5>
                          <button
                            @click="addAttachment"
                            type="button"
                            :disabled="buildForm.attachments.length >= 8"
                            class="px-3 py-1 bg-emerald-600 text-black text-xs font-mono hover:bg-emerald-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                          >
                            ➕ ADD
                          </button>
                        </div>

                        <div class="p-4">
                          <div v-if="buildForm.attachments.length === 0" class="text-center py-12 border-2 border-dashed border-orange-500/30 bg-orange-500/5">
                            <div class="text-6xl mb-3">🔧</div>
                            <span class="text-gray-500 font-mono text-sm">Нет attachments</span>
                            <div class="mt-4">
                              <button @click="addAttachment" type="button" class="px-4 py-2 bg-emerald-600 text-black text-xs font-mono hover:bg-emerald-500">
                                Добавить первый
                              </button>
                            </div>
                          </div>

                          <div v-else class="space-y-3">
                            <div
                              v-for="(att, index) in buildForm.attachments"
                              :key="index"
                              class="border-2 border-orange-500/30 bg-gradient-to-br from-black/40 to-orange-500/5 p-4 hover:border-orange-500/60 transition-all"
                              :class="{'ring-2 ring-orange-500': draggedIndex === index}"
                              draggable="true"
                              @dragstart="handleDragStart(index)"
                              @dragover.prevent="handleDragOver(index)"
                              @drop="handleDrop(index)"
                              @dragend="handleDragEnd"
                            >
                              <div class="flex items-start gap-3 mb-3">
                                <div class="text-gray-600 cursor-move hover:text-orange-500 transition-colors pt-1" title="Drag to reorder">
                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                  </svg>
                                </div>
                                <div class="flex-1 space-y-3">
                                  <div class="grid grid-cols-2 gap-3">
                                    <div>
                                      <label class="text-orange-400 font-mono text-xs mb-1 block">SLOT</label>
                                      <select
                                        v-model="att.slot"
                                        class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white font-mono text-xs focus:outline-none focus:border-orange-500"
                                      >
                                        <option value="muzzle">🔫 Muzzle</option>
                                        <option value="barrel">📏 Barrel</option>
                                        <option value="underbarrel">⬇️ Underbarrel</option>
                                        <option value="optic">👁️ Optic</option>
                                        <option value="stock">🎯 Stock</option>
                                        <option value="rear_grip">✋ Rear Grip</option>
                                        <option value="magazine">📦 Magazine</option>
                                        <option value="ammunition">💥 Ammunition</option>
                                        <option value="laser">🔴 Laser</option>
                                        <option value="bolt">🔩 Bolt</option>
                                        <option value="trigger">⚡ Trigger</option>
                                        <option value="guard">🛡️ Guard</option>
                                      </select>
                                    </div>
                                    <div>
                                      <label class="text-orange-400 font-mono text-xs mb-1 block">NAME</label>
                                      <input
                                        v-model="att.name"
                                        type="text"
                                        placeholder="Attachment name"
                                        class="w-full px-3 py-2 bg-black border border-orange-500/30 text-white font-mono text-xs focus:outline-none focus:border-orange-500 placeholder-gray-700"
                                      />
                                    </div>
                                  </div>

                                  <!-- Stat Modifiers - Simple Fields -->
                                  <div class="border-t border-orange-500/20 pt-3">
                                    <div class="flex justify-between items-center mb-2">
                                      <label class="text-orange-400 font-mono text-xs">STAT MODIFIERS</label>
                                      <button
                                        @click="addStatModifier(index)"
                                        type="button"
                                        class="text-xs text-blue-500 hover:text-blue-400 font-mono"
                                      >
                                        ➕ Добавить стат
                                      </button>
                                    </div>

                                    <div v-if="!att.stats || att.stats.length === 0" class="text-center py-2 text-gray-600 text-xs font-mono">
                                      Нет модификаторов
                                    </div>

                                    <div v-else class="space-y-2">
                                      <div v-for="(stat, statIndex) in att.stats" :key="statIndex" class="flex gap-2 items-start">
                                        <div class="flex-1">
                                          <select
                                            v-model="stat.name"
                                            class="w-full px-2 py-1 bg-black border border-orange-500/30 text-white font-mono text-xs focus:outline-none focus:border-orange-500"
                                          >
                                            <option value="">Выберите стат</option>
                                            <option value="recoil">Отдача (recoil)</option>
                                            <option value="ads">Прицеливание (ads)</option>
                                            <option value="range">Дальность (range)</option>
                                            <option value="velocity">Скорость пули (velocity)</option>
                                            <option value="mobility">Мобильность (mobility)</option>
                                            <option value="stability">Стабильность (stability)</option>
                                            <option value="reload">Перезарядка (reload)</option>
                                            <option value="sprint_speed">Скорость бега (sprint_speed)</option>
                                            <option value="capacity">Емкость (capacity)</option>
                                            <option value="damage">Урон (damage)</option>
                                            <option value="fire_rate">Скорострельность (fire_rate)</option>
                                            <option value="sprint_to_fire">Из бега в стрельбу (sprint_to_fire)</option>
                                            <option value="movement_speed">Скорость передвижения (movement_speed)</option>
                                            <option value="sound">Звук (sound)</option>
                                            <option value="zoom">Зум (zoom)</option>
                                          </select>
                                        </div>
                                        <div class="flex-1">
                                          <input
                                            v-model="stat.value"
                                            type="text"
                                            placeholder="Значение (-10%, +20ms)"
                                            class="w-full px-2 py-1 bg-black border border-orange-500/30 text-white font-mono text-xs focus:outline-none focus:border-orange-500 placeholder-gray-700"
                                          />
                                        </div>
                                        <button
                                          @click="removeStatModifier(index, statIndex)"
                                          type="button"
                                          class="px-2 py-1 bg-red-600/20 border border-red-500/30 text-red-500 text-xs hover:bg-red-500/30"
                                        >
                                          ✕
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <button
                                  @click="removeAttachment(index)"
                                  type="button"
                                  class="flex-shrink-0 w-8 h-8 bg-red-600/20 border border-red-500/30 text-red-500 hover:bg-red-500/30 transition-all flex items-center justify-center"
                                  title="Удалить"
                                >
                                  ✕
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Footer (Fixed) -->
                <div class="p-6 border-t-2 border-orange-500/30 bg-black/40 flex gap-4 justify-end flex-shrink-0">
                  <button @click="closeBuildModal" type="button" class="px-6 py-3 bg-gray-800 border border-gray-600 text-gray-300 font-mono text-sm hover:bg-gray-700 transition-colors">
                    ОТМЕНА
                  </button>
                  <button @click="saveBuild" type="button" :disabled="!buildForm.title || isSaving" class="px-8 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-black font-black font-mono text-sm hover:from-orange-500 hover:to-red-500 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ isSaving ? '⏳ СОХРАНЕНИЕ...' : '💾 СОХРАНИТЬ БИЛД' }}
                  </button>
                </div>
              </div>
            </div>
          </transition>

          <!-- Templates Modal -->
          <transition name="modal">
            <div v-if="showTemplatesModal" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4" @click.self="showTemplatesModal = false">
              <div class="bg-zinc-900 border-2 border-blue-500 max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col">
                <div class="p-6 border-b-2 border-blue-500/30 bg-gradient-to-r from-blue-500/10 to-transparent flex justify-between items-center">
                  <h4 class="text-2xl font-black font-mono text-blue-500">📋 ШАБЛОНЫ БИЛДОВ</h4>
                  <button @click="showTemplatesModal = false" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
                <div class="flex-1 overflow-y-auto p-6">
                  <div class="grid md:grid-cols-2 gap-4">
                    <button
                      v-for="template in buildTemplates"
                      :key="template.id"
                      @click="applyTemplate(template)"
                      class="border-2 border-blue-500/30 bg-blue-500/5 p-6 text-left hover:border-blue-500 hover:bg-blue-500/10 transition-all"
                    >
                      <div class="text-lg font-bold font-mono text-white mb-2">{{ template.title }}</div>
                      <div class="text-sm text-gray-400 font-mono mb-3">{{ template.role }}</div>
                      <div class="text-xs text-blue-400 font-mono">{{ template.attachments.length }} attachments</div>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </transition>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import TierBadge from '@/Components/Warzone/TierBadge.vue';

const props = defineProps({
  weapon: Object,
  tiers: Array
});

const expandedBuilds = reactive({});
const showBuildModal = ref(false);
const showTemplatesModal = ref(false);
const editingBuild = ref(null);
const isSaving = ref(false);
const draggedIndex = ref(null);

const buildForm = reactive({
  title: '',
  role: '',
  notes: '',
  tier_override: null,
  is_active: true,
  attachments: []
});

// Build templates
const buildTemplates = [
  {
    id: 1,
    title: 'Close Range Meta',
    role: 'Close Range',
    attachments: [
      { slot: 'muzzle', name: 'Sonic Suppressor', stats: [
        { name: 'recoil', value: '-10%' },
        { name: 'sound', value: 'suppressed' }
      ]},
      { slot: 'barrel', name: 'Short Barrel', stats: [
        { name: 'ads', value: '-25ms' },
        { name: 'mobility', value: '+15%' }
      ]},
      { slot: 'underbarrel', name: 'Merc Foregrip', stats: [
        { name: 'recoil', value: '-8%' },
        { name: 'stability', value: '+12%' }
      ]},
      { slot: 'magazine', name: '50 Round Mag', stats: [
        { name: 'capacity', value: '+20' },
        { name: 'reload', value: '+200ms' }
      ]},
      { slot: 'stock', name: 'No Stock', stats: [
        { name: 'ads', value: '-35ms' },
        { name: 'sprint_speed', value: '+10%' }
      ]}
    ]
  },
  {
    id: 2,
    title: 'Long Range Sniper Support',
    role: 'Long Range',
    attachments: [
      { slot: 'muzzle', name: 'Monolithic Suppressor', stats: [
        { name: 'range', value: '+15%' },
        { name: 'sound', value: 'suppressed' }
      ]},
      { slot: 'barrel', name: 'Long Barrel', stats: [
        { name: 'range', value: '+25%' },
        { name: 'velocity', value: '+30%' }
      ]},
      { slot: 'optic', name: '3.5x Scope', stats: [
        { name: 'zoom', value: '3.5x' },
        { name: 'ads', value: '+50ms' }
      ]},
      { slot: 'underbarrel', name: 'Bipod', stats: [
        { name: 'recoil', value: '-20%' },
        { name: 'stability', value: '+25%' }
      ]},
      { slot: 'ammunition', name: 'High Velocity', stats: [
        { name: 'velocity', value: '+15%' },
        { name: 'range', value: '+10%' }
      ]}
    ]
  },
  {
    id: 3,
    title: 'Balanced All-Rounder',
    role: 'Balanced',
    attachments: [
      { slot: 'muzzle', name: 'Compensator', stats: [
        { name: 'recoil', value: '-12%' }
      ]},
      { slot: 'barrel', name: 'Mid-Length Barrel', stats: [
        { name: 'range', value: '+10%' },
        { name: 'velocity', value: '+8%' }
      ]},
      { slot: 'optic', name: 'Red Dot', stats: [
        { name: 'zoom', value: '1.5x' },
        { name: 'ads', value: '+15ms' }
      ]},
      { slot: 'rear_grip', name: 'Tactical Grip', stats: [
        { name: 'ads', value: '-20ms' },
        { name: 'stability', value: '+5%' }
      ]},
      { slot: 'magazine', name: '40 Round Mag', stats: [
        { name: 'capacity', value: '+10' },
        { name: 'reload', value: '+100ms' }
      ]}
    ]
  },
  {
    id: 4,
    title: 'Aggressive Rusher',
    role: 'Aggressive',
    attachments: [
      { slot: 'laser', name: '5mW Laser', stats: [
        { name: 'ads', value: '-30ms' },
        { name: 'sprint_to_fire', value: '-25ms' }
      ]},
      { slot: 'stock', name: 'Collapsed Stock', stats: [
        { name: 'mobility', value: '+20%' },
        { name: 'ads', value: '-30ms' }
      ]},
      { slot: 'rear_grip', name: 'Speed Grip', stats: [
        { name: 'ads', value: '-25ms' },
        { name: 'sprint_speed', value: '+8%' }
      ]},
      { slot: 'barrel', name: 'Compact Barrel', stats: [
        { name: 'mobility', value: '+12%' },
        { name: 'ads', value: '-20ms' }
      ]},
      { slot: 'magazine', name: 'Fast Mag', stats: [
        { name: 'reload', value: '-30%' }
      ]}
    ]
  }
];

const toggleBuild = (id) => {
  expandedBuilds[id] = !expandedBuilds[id];
};

const openNewBuildModal = () => {
  resetBuildForm();
  showBuildModal.value = true;
};

const editBuild = (build) => {
  editingBuild.value = build;
  buildForm.title = build.title;
  buildForm.role = build.role || '';
  buildForm.notes = build.notes || '';
  buildForm.tier_override = build.tier_override;
  buildForm.is_active = build.is_active ?? true;
  buildForm.attachments = (build.attachments || []).map(att => ({
    slot: att.slot,
    name: att.name,
    stats: att.stat_mods ? Object.entries(att.stat_mods).map(([name, value]) => ({ name, value })) : []
  }));
  showBuildModal.value = true;
};

const duplicateBuild = (build) => {
  buildForm.title = build.title + ' (Copy)';
  buildForm.role = build.role || '';
  buildForm.notes = build.notes || '';
  buildForm.tier_override = build.tier_override;
  buildForm.is_active = false;
  buildForm.attachments = (build.attachments || []).map(att => ({
    slot: att.slot,
    name: att.name,
    stats: att.stat_mods ? Object.entries(att.stat_mods).map(([name, value]) => ({ name, value })) : []
  }));
  editingBuild.value = null;
  showBuildModal.value = true;
};

const closeBuildModal = () => {
  showBuildModal.value = false;
  setTimeout(() => {
    editingBuild.value = null;
    resetBuildForm();
  }, 300);
};

const resetBuildForm = () => {
  buildForm.title = '';
  buildForm.role = '';
  buildForm.notes = '';
  buildForm.tier_override = null;
  buildForm.is_active = true;
  buildForm.attachments = [];
};

const saveBuild = () => {
  if (!buildForm.title) return;

  isSaving.value = true;

  const payload = {
    title: buildForm.title,
    role: buildForm.role,
    notes: buildForm.notes,
    tier_override: buildForm.tier_override,
    is_active: buildForm.is_active,
    attachments: buildForm.attachments.map((att, index) => {
      // Конвертируем stats array в stat_mods object
      let statMods = null;
      if (att.stats && att.stats.length > 0) {
        statMods = {};
        att.stats.forEach(stat => {
          if (stat.name && stat.value) {
            statMods[stat.name] = stat.value;
          }
        });
      }
      return {
        slot: att.slot,
        name: att.name,
        stat_mods: statMods,
        sort_order: index
      };
    })
  };

  if (editingBuild.value) {
    router.put(`/admin/warzone/builds/${editingBuild.value.id}`, payload, {
      preserveScroll: true,
      onSuccess: () => {
        isSaving.value = false;
        closeBuildModal();
        router.reload({ only: ['weapon'] });
      },
      onError: () => {
        isSaving.value = false;
      }
    });
  } else {
    router.post(`/admin/warzone/weapons/${props.weapon.id}/builds`, payload, {
      preserveScroll: true,
      onSuccess: () => {
        isSaving.value = false;
        closeBuildModal();
        router.reload({ only: ['weapon'] });
      },
      onError: () => {
        isSaving.value = false;
      }
    });
  }
};

const deleteBuild = (id) => {
  if (confirm('🗑️ Вы уверены, что хотите удалить этот билд?')) {
    router.delete(`/admin/warzone/builds/${id}`, {
      preserveScroll: true,
      onSuccess: () => {
        router.reload({ only: ['weapon'] });
      }
    });
  }
};

const addAttachment = () => {
  if (buildForm.attachments.length >= 8) return;
  buildForm.attachments.push({
    slot: 'muzzle',
    name: '',
    stats: []
  });
};

const removeAttachment = (index) => {
  buildForm.attachments.splice(index, 1);
};

const addStatModifier = (attachmentIndex) => {
  if (!buildForm.attachments[attachmentIndex].stats) {
    buildForm.attachments[attachmentIndex].stats = [];
  }
  buildForm.attachments[attachmentIndex].stats.push({ name: '', value: '' });
};

const removeStatModifier = (attachmentIndex, statIndex) => {
  buildForm.attachments[attachmentIndex].stats.splice(statIndex, 1);
};

const applyTemplate = (template) => {
  buildForm.title = template.title;
  buildForm.role = template.role;
  buildForm.notes = `Шаблон: ${template.title}`;
  buildForm.attachments = template.attachments.map(att => ({
    slot: att.slot,
    name: att.name,
    stats: att.stats ? [...att.stats] : []
  }));
  showTemplatesModal.value = false;
  showBuildModal.value = true;
};

// Drag and drop handlers
const handleDragStart = (index) => {
  draggedIndex.value = index;
};

const handleDragOver = (index) => {
  if (draggedIndex.value === null || draggedIndex.value === index) return;

  const draggedItem = buildForm.attachments[draggedIndex.value];
  buildForm.attachments.splice(draggedIndex.value, 1);
  buildForm.attachments.splice(index, 0, draggedItem);
  draggedIndex.value = index;
};

const handleDrop = (index) => {
  draggedIndex.value = null;
};

const handleDragEnd = () => {
  draggedIndex.value = null;
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

.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease-in-out;
  max-height: 1000px;
  overflow: hidden;
}

.slide-down-enter-from,
.slide-down-leave-to {
  max-height: 0;
  opacity: 0;
}

.modal-enter-active,
.modal-leave-active {
  transition: all 0.3s ease-in-out;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
  transform: scale(0.95);
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.3);
}

::-webkit-scrollbar-thumb {
  background: rgba(249, 115, 22, 0.3);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(249, 115, 22, 0.5);
}
</style>
