<template>
  <div class="min-h-screen bg-black text-gray-100 font-[system-ui] relative overflow-hidden">

    <!-- SEO Meta Tags -->
    <Seo
      :title="seoTitle"
      :description="seoDescription"
      :keywords="seoKeywords"
      :image="seoImage"
    />

    <!-- Background Image -->
    <div class="fixed inset-0 z-0">
      <img :src="communityBackground" alt="Community Background" class="w-full h-full object-cover opacity-35" />
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/70"></div>
    </div>

    <!-- Terminal Background -->
    <div class="fixed inset-0 z-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(0deg, #f97316 0px, transparent 1px, transparent 2px);"></div>

    <!-- Header Component -->
    <Header />

    <!-- Hero Section -->
    <section class="pt-20 md:pt-32 pb-8 md:pb-12 px-3 md:px-6 relative">
      <div class="absolute inset-0 bg-gradient-to-br from-zinc-950/40 via-black/50 to-orange-950/20 backdrop-blur-sm"></div>

      <div class="container mx-auto relative z-10">
        <!-- Terminal Header -->
        <div class="mb-6 md:mb-8 font-mono text-xs md:text-sm">
          <div class="text-orange-500 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> SYSTEM INITIALIZED...
          </div>
          <div class="text-orange-500/70 mb-2 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> LOADING COMMUNITY_DATABASE.exe
          </div>
          <div class="text-orange-500 mb-4 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> ACCESS GRANTED
          </div>
          <div class="h-px bg-gradient-to-r from-orange-500 via-red-500 to-transparent mb-8"></div>
        </div>

        <!-- Main Title -->
        <div class="mb-8 md:mb-12">
          <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-black mb-4 leading-none uppercase font-mono">
            <span class="block text-orange-600 mb-2 terminal-glow drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              СООБЩЕСТВО
            </span>
            <span class="flex items-center text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
              <span>COD TERMINAL</span>
              <span class="inline-block w-3 h-8 sm:h-10 md:h-12 lg:h-20 bg-orange-500 ml-2 md:ml-4 cursor-blink"></span>
            </span>
          </h1>

          <div class="text-orange-600 font-mono text-xs md:text-sm mb-3 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            <span class="text-orange-600">&gt;</span> DESCRIPTION:
          </div>
          <p class="text-base md:text-xl text-gray-300 leading-relaxed font-mono max-w-3xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
            Найди игроков, изучай гайды по картам зомби и общайся с сообществом.
          </p>
        </div>
      </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-8 md:py-12 px-3 md:px-6 relative">
      <div class="container mx-auto relative z-10">

        <!-- Tabs -->
        <div class="mb-8 flex flex-wrap gap-2 md:gap-4 font-mono">
          <button
            @click="activeTab = 'articles'"
            :class="[
              'px-4 md:px-6 py-2 md:py-3 text-sm md:text-base font-bold transition-all',
              activeTab === 'articles'
                ? 'bg-orange-500 text-black border-2 border-orange-500'
                : 'bg-black/50 text-orange-500 border-2 border-orange-500/30 hover:border-orange-500'
            ]"
          >
            <span class="text-orange-600" v-if="activeTab !== 'articles'">&gt;</span> СТАТЬИ
          </button>
          <button
            @click="activeTab = 'guides'"
            :class="[
              'px-4 md:px-6 py-2 md:py-3 text-sm md:text-base font-bold transition-all',
              activeTab === 'guides'
                ? 'bg-orange-500 text-black border-2 border-orange-500'
                : 'bg-black/50 text-orange-500 border-2 border-orange-500/30 hover:border-orange-500'
            ]"
          >
            <span class="text-orange-600" v-if="activeTab !== 'guides'">&gt;</span> ЗОМБИ ГАЙДЫ
          </button>
          <button
            @click="activeTab = 'users'"
            :class="[
              'px-4 md:px-6 py-2 md:py-3 text-sm md:text-base font-bold transition-all',
              activeTab === 'users'
                ? 'bg-orange-500 text-black border-2 border-orange-500'
                : 'bg-black/50 text-orange-500 border-2 border-orange-500/30 hover:border-orange-500'
            ]"
          >
            <span class="text-orange-600" v-if="activeTab !== 'users'">&gt;</span> ИГРОКИ
          </button>
          <button
            @click="activeTab = 'groups'"
            :class="[
              'px-4 md:px-6 py-2 md:py-3 text-sm md:text-base font-bold transition-all',
              activeTab === 'groups'
                ? 'bg-orange-500 text-black border-2 border-orange-500'
                : 'bg-black/50 text-orange-500 border-2 border-orange-500/30 hover:border-orange-500'
            ]"
          >
            <span class="text-orange-600" v-if="activeTab !== 'groups'">&gt;</span> ГРУППЫ
          </button>
          <button
            @click="activeTab = 'chats'"
            :class="[
              'px-4 md:px-6 py-2 md:py-3 text-sm md:text-base font-bold transition-all',
              activeTab === 'chats'
                ? 'bg-orange-500 text-black border-2 border-orange-500'
                : 'bg-black/50 text-orange-500 border-2 border-orange-500/30 hover:border-orange-500'
            ]"
          >
            <span class="text-orange-600" v-if="activeTab !== 'chats'">&gt;</span> ЧАТЫ
            <span v-if="unreadMessagesCount > 0" class="ml-2 bg-red-500 text-white px-2 py-0.5 text-xs rounded-full">
              {{ unreadMessagesCount }}
            </span>
          </button>
        </div>

        <!-- Articles Tab -->
        <div v-if="activeTab === 'articles'" class="space-y-6">
          <!-- Search and Filters -->
          <div class="bg-black/50 border border-orange-500/30 p-4 md:p-6 space-y-4">
            <div class="font-mono text-sm text-orange-600 mb-3">
              <span class="text-orange-600">&gt;</span> ПОИСК СТАТЬЕЙ:
            </div>

            <!-- Search Input -->
            <div class="relative">
              <input
                v-model="articleSearchQuery"
                @input="searchArticles"
                type="text"
                placeholder="Введите название статьи..."
                class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-3 font-mono text-sm outline-none transition-all"
              >
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">ИГРА:</label>
                <select
                  v-model="selectedArticleGame"
                  @change="searchArticles"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все игры</option>
                  <optgroup label="Black Ops Series">
                    <option value="World at War">World at War</option>
                    <option value="Black Ops">Black Ops</option>
                    <option value="Black Ops 2">Black Ops 2</option>
                    <option value="Black Ops 3">Black Ops 3</option>
                    <option value="Black Ops 4">Black Ops 4</option>
                    <option value="Cold War">Cold War</option>
                    <option value="Black Ops 6">Black Ops 6</option>
                    <option value="Black Ops 7">Black Ops 7</option>
                  </optgroup>
                  <optgroup label="Modern Warfare Series">
                    <option value="COD 4: Modern Warfare">COD 4: Modern Warfare (2007)</option>
                    <option value="Modern Warfare 2">Modern Warfare 2 (2009)</option>
                    <option value="Modern Warfare 3">Modern Warfare 3 (2011)</option>
                    <option value="Modern Warfare">Modern Warfare (2019)</option>
                    <option value="Modern Warfare II">Modern Warfare II (2022)</option>
                    <option value="Modern Warfare III">Modern Warfare III (2023)</option>
                  </optgroup>
                </select>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">КАТЕГОРИЯ:</label>
                <select
                  v-model="selectedArticleCategory"
                  @change="searchArticles"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все категории</option>
                  <option value="Новости">Новости</option>
                  <option value="Обзоры">Обзоры</option>
                  <option value="Гайды">Гайды</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Articles Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a
              v-for="article in filteredArticles"
              :key="article.id"
              :href="`/articles/${article.slug}`"
              class="bg-black/50 border-2 border-orange-500/30 hover:border-orange-500 transition-all p-4 group block"
            >
              <!-- Article Image -->
              <div v-if="article.image" class="w-full h-40 bg-orange-900/30 border border-orange-500/30 mb-4 overflow-hidden">
                <img :src="`/storage/${article.image}`" :alt="article.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
              </div>

              <!-- Article Info -->
              <h3 class="text-white font-mono font-bold text-lg mb-2 group-hover:text-orange-500 transition-colors">
                {{ article.title }}
              </h3>

              <p class="text-gray-400 text-sm font-mono mb-3 line-clamp-2">
                {{ article.excerpt }}
              </p>

              <div class="flex items-center justify-between text-xs font-mono">
                <span class="text-orange-500">
                  <span class="text-orange-600">›</span> {{ article.game }}
                </span>
                <span class="text-gray-500">
                  {{ article.views_count || 0 }} просмотров
                </span>
              </div>

              <!-- Author -->
              <div v-if="article.user" class="mt-3 pt-3 border-t border-orange-500/20 flex items-center space-x-2">
                <div class="w-6 h-6 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center overflow-hidden">
                  <img v-if="article.user.avatar" :src="`/storage/${article.user.avatar}`" :alt="article.user.name" class="w-full h-full object-cover">
                  <span v-else class="text-orange-500 text-xs font-bold">
                    {{ article.user.name.charAt(0).toUpperCase() }}
                  </span>
                </div>
                <span class="text-gray-400 text-xs font-mono">{{ article.user.name }}</span>
              </div>
            </a>
          </div>

          <!-- No Results -->
          <div v-if="filteredArticles.length === 0" class="text-center py-12">
            <div class="font-mono text-orange-500/50">
              <span class="text-orange-600">&gt;</span> СТАТЬИ НЕ НАЙДЕНЫ
            </div>
          </div>
        </div>

        <!-- Guides Tab -->
        <div v-if="activeTab === 'guides'" class="space-y-6">
          <!-- Search and Filters -->
          <div class="bg-black/50 border border-orange-500/30 p-4 md:p-6 space-y-4">
            <div class="font-mono text-sm text-orange-600 mb-3">
              <span class="text-orange-600">&gt;</span> ПОИСК ГАЙДОВ:
            </div>

            <!-- Search Input -->
            <div class="relative">
              <input
                v-model="guideSearchQuery"
                @input="searchGuides"
                type="text"
                placeholder="Введите название гайда..."
                class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-3 font-mono text-sm outline-none transition-all"
              >
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">ИГРА:</label>
                <select
                  v-model="selectedGame"
                  @change="searchGuides"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все игры</option>
                    <option value="World at War">World at War</option>
                    <option value="Black Ops">Black Ops</option>
                    <option value="Black Ops 2">Black Ops 2</option>
                    <option value="Black Ops 3">Black Ops 3</option>
                    <option value="Black Ops 4">Black Ops 4</option>
                    <option value="Cold War">Cold War</option>
                    <option value="Black Ops 6">Black Ops 6</option>
                    <option value="Black Ops 7">Black Ops 7</option>
                </select>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">КАРТА:</label>
                <select
                  v-model="selectedMapSlug"
                  @change="searchGuides"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все карты</option>
                  <option
                    v-for="map in availableMaps"
                    :key="map.map_slug"
                    :value="map.map_slug"
                  >
                    {{ map.title }}
                  </option>
                </select>
              </div>
            </div>
          </div>

          <!-- Guides Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a
              v-for="guide in filteredGuides"
              :key="guide.id"
              :href="`/zombies/${guide.game}/${guide.map_slug}/guides/${guide.id}`"
              class="bg-black/50 border-2 border-orange-500/30 hover:border-orange-500 transition-all p-4 group block"
            >
              <!-- Guide Image -->
              <div v-if="guide.image" class="w-full h-40 bg-orange-900/30 border border-orange-500/30 mb-4 overflow-hidden">
                <img :src="`/storage/${guide.image}`" :alt="guide.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
              </div>

              <!-- Guide Info -->
              <h3 class="text-white font-mono font-bold text-lg mb-2 group-hover:text-orange-500 transition-colors">
                {{ guide.title }}
              </h3>

              <p class="text-gray-400 text-sm font-mono mb-3 line-clamp-2">
                {{ guide.description }}
              </p>

              <div class="flex items-center justify-between text-xs font-mono">
                <span class="text-orange-500">
                  <span class="text-orange-600">›</span> {{ guide.game }}
                </span>
                <span class="text-gray-500">
                  {{ guide.views }} просмотров
                </span>
              </div>

              <!-- Author -->
              <div v-if="guide.user" class="mt-3 pt-3 border-t border-orange-500/20 flex items-center space-x-2">
                <div class="w-6 h-6 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center overflow-hidden">
                  <img v-if="guide.user.avatar" :src="`/storage/${guide.user.avatar}`" :alt="guide.user.name" class="w-full h-full object-cover">
                  <span v-else class="text-orange-500 text-xs font-bold">
                    {{ guide.user.name.charAt(0).toUpperCase() }}
                  </span>
                </div>
                <span class="text-gray-400 text-xs font-mono">{{ guide.user.name }}</span>
              </div>
            </a>
          </div>

          <!-- No Results -->
          <div v-if="filteredGuides.length === 0" class="text-center py-12">
            <div class="font-mono text-orange-500/50">
              <span class="text-orange-600">&gt;</span> ГАЙДЫ НЕ НАЙДЕНЫ
            </div>
          </div>
        </div>

        <!-- Users Tab -->
        <div v-if="activeTab === 'users'" class="space-y-6">
          <!-- Search Bar -->
          <div class="bg-black/50 border border-orange-500/30 p-4 md:p-6">
            <div class="font-mono text-sm text-orange-600 mb-3">
              <span class="text-orange-600">&gt;</span> ПОИСК ИГРОКОВ:
            </div>
            <div class="relative">
              <input
                v-model="userSearchQuery"
                @input="searchUsers"
                type="text"
                placeholder="Введите имя игрока для поиска..."
                class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-3 font-mono text-sm outline-none transition-all"
              >
              <div class="absolute right-4 top-1/2 -translate-y-1/2 text-orange-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
            </div>
            <p class="text-gray-500 text-xs font-mono mt-2">
              Максимум {{ maxUsersDisplay }} результатов
            </p>
          </div>

          <!-- Users Grid -->
          <div v-if="filteredUsers.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            <div
              v-for="user in filteredUsers"
              :key="user.id"
              class="bg-black/50 border-2 border-orange-500/30 hover:border-orange-500 transition-all p-4 group"
            >
              <div class="flex items-start space-x-4">
                <!-- Avatar -->
                <div class="w-16 h-16 bg-orange-900/30 border-2 border-orange-500/50 flex items-center justify-center flex-shrink-0 overflow-hidden">
                  <img v-if="user.avatar" :src="`/storage/${user.avatar}`" :alt="user.name" class="w-full h-full object-cover">
                  <span v-else class="text-orange-500 text-2xl font-bold font-mono">
                    {{ user.name.charAt(0).toUpperCase() }}
                  </span>
                </div>

                <!-- User Info -->
                <div class="flex-1 min-w-0">
                  <h3 class="text-white font-mono font-bold text-lg mb-1 truncate group-hover:text-orange-500 transition-colors">
                    {{ user.name }}
                  </h3>
                  <p class="text-gray-500 text-xs font-mono mb-3">
                    На сайте с {{ formatDate(user.created_at) }}
                  </p>

                  <!-- Social Links -->
                  <div class="flex flex-wrap gap-2 mb-3">
                    <span v-if="user.steam" class="text-xs font-mono text-gray-400">
                      <span class="text-orange-600">›</span> Steam
                    </span>
                    <span v-if="user.discord" class="text-xs font-mono text-gray-400">
                      <span class="text-orange-600">›</span> Discord
                    </span>
                    <span v-if="user.xbox" class="text-xs font-mono text-gray-400">
                      <span class="text-orange-600">›</span> Xbox
                    </span>
                    <span v-if="user.psn" class="text-xs font-mono text-gray-400">
                      <span class="text-orange-600">›</span> PSN
                    </span>
                  </div>

                  <!-- Actions -->
                  <div class="flex gap-2">
                    <button
                      @click="viewProfile(user.id)"
                      class="flex-1 bg-orange-500/20 hover:bg-orange-500 text-orange-500 hover:text-black border border-orange-500 px-3 py-1 text-xs font-mono font-bold transition-all"
                    >
                      ПРОФИЛЬ
                    </button>
                    <button
                      @click="openChat(user.id)"
                      class="flex-1 bg-orange-500 hover:bg-orange-600 text-black px-3 py-1 text-xs font-mono font-bold transition-all"
                    >
                      НАПИСАТЬ
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Initial State -->
          <div v-else-if="!userSearchQuery" class="text-center py-12">
            <div class="font-mono text-orange-500/50 mb-2">
              <span class="text-orange-600">&gt;</span> НАЧНИТЕ ПОИСК
            </div>
            <p class="text-gray-500 text-sm font-mono">
              Введите имя игрока в поле поиска
            </p>
          </div>

          <!-- No Results -->
          <div v-else class="text-center py-12">
            <div class="font-mono text-orange-500/50">
              <span class="text-orange-600">&gt;</span> ИГРОКИ НЕ НАЙДЕНЫ
            </div>
          </div>
        </div>

        <!-- Groups Tab -->
        <div v-if="activeTab === 'groups'" class="space-y-6">
          <!-- Create Group Section -->
          <div class="bg-black/50 border border-orange-500/30 p-4 md:p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="font-mono text-sm text-orange-600">
                <span class="text-orange-600">&gt;</span> СОЗДАТЬ ГРУППУ ДЛЯ ПОИСКА ТИММЕЙТОВ
              </div>
              <button
                @click="showCreateGroupForm = !showCreateGroupForm"
                class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-black font-mono font-bold text-sm transition-all"
              >
                {{ showCreateGroupForm ? 'ОТМЕНИТЬ' : '+ СОЗДАТЬ' }}
              </button>
            </div>

            <!-- Create Group Form -->
            <div v-if="showCreateGroupForm" class="mt-4 space-y-4 border-t border-orange-500/20 pt-4">
              <div class="font-mono text-xs text-gray-400 mb-3">
                <span class="text-orange-600">*</span> Список игр содержит только актуальные игры. Со временем список пополнится.
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-orange-500 font-mono text-xs mb-2">НАЗВАНИЕ ГРУППЫ:</label>
                  <input
                    v-model="newGroup.name"
                    type="text"
                    placeholder="Например: Ищу отряд для Warzone"
                    class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                  >
                </div>

                <div>
                  <label class="block text-orange-500 font-mono text-xs mb-2">ИГРА:</label>
                  <select
                    v-model="newGroup.game"
                    class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                  >
                    <option value="">Выберите игру</option>
                    <option value="Warzone">Warzone</option>
                    <option value="Black Ops 7">Black Ops 7</option>
                    <option value="Black Ops 6">Black Ops 6</option>
                    <option value="Modern Warfare III">Modern Warfare III (2023)</option>
                    <option value="Modern Warfare II">Modern Warfare II (2022)</option>
                    <option value="Cold War">Cold War</option>
                    <option value="Black Ops 4">Black Ops 4</option>
                    <option value="Black Ops 3">Black Ops 3</option>
                  </select>
                </div>

                <div>
                  <label class="block text-orange-500 font-mono text-xs mb-2">РЕЖИМ ИГРЫ:</label>
                  <select
                    v-model="newGroup.game_mode"
                    class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                  >
                    <option value="">Любой режим</option>
                    <option value="Warzone">Warzone</option>
                    <option value="Multiplayer">Multiplayer</option>
                    <option value="Zombies">Zombies</option>
                    <option value="DMZ">DMZ</option>
                    <option value="Ranked">Ranked</option>
                  </select>
                </div>

                <div>
                  <label class="block text-orange-500 font-mono text-xs mb-2">ПЛАТФОРМА:</label>
                  <select
                    v-model="newGroup.platform"
                    class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                  >
                    <option value="">Любая платформа</option>
                    <option value="Cross-platform">Cross-platform</option>
                    <option value="PC">PC</option>
                    <option value="PlayStation">PlayStation</option>
                    <option value="Xbox">Xbox</option>
                  </select>
                </div>

                <div>
                  <label class="block text-orange-500 font-mono text-xs mb-2">УРОВЕНЬ СКИЛЛА:</label>
                  <select
                    v-model="newGroup.skill_level"
                    class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                  >
                    <option value="">Любой уровень</option>
                    <option value="Новичок">Новичок</option>
                    <option value="Средний">Средний</option>
                    <option value="Продвинутый">Продвинутый</option>
                    <option value="Про">Про</option>
                  </select>
                </div>

                <div>
                  <label class="block text-orange-500 font-mono text-xs mb-2">МАКС. УЧАСТНИКОВ:</label>
                  <input
                    v-model.number="newGroup.max_members"
                    type="number"
                    min="2"
                    max="50"
                    placeholder="4"
                    class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                  >
                </div>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">ОПИСАНИЕ:</label>
                <textarea
                  v-model="newGroup.description"
                  rows="3"
                  placeholder="Опишите что ищете, цели игры, требования..."
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all resize-none"
                ></textarea>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">ССЫЛКА ДЛЯ СВЯЗИ:</label>
                <input
                  v-model="newGroup.contact_link"
                  type="text"
                  placeholder="@username, discord.gg/..., t.me/... и т.д."
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                <p class="text-gray-500 text-xs font-mono mt-1">
                  Укажите @username Telegram/Discord, ссылку на сервер или другой способ связи
                </p>
              </div>

              <div class="flex justify-end">
                <button
                  @click="createGroup"
                  :disabled="!newGroup.name || !newGroup.game || creatingGroup"
                  class="px-6 py-3 bg-orange-500 hover:bg-orange-600 disabled:bg-gray-600 disabled:cursor-not-allowed text-black font-mono font-bold transition-all"
                >
                  {{ creatingGroup ? 'СОЗДАНИЕ...' : 'СОЗДАТЬ ГРУППУ' }}
                </button>
              </div>
            </div>
          </div>

          <!-- Filters -->
          <div class="bg-black/50 border border-orange-500/30 p-4 md:p-6 space-y-4">
            <div class="font-mono text-sm text-orange-600 mb-3">
              <span class="text-orange-600">&gt;</span> ФИЛЬТРЫ:
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">ИГРА:</label>
                <select
                  v-model="groupFilters.game"
                  @change="searchGroups"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все игры</option>
                  <option value="Warzone">Warzone</option>
                  <option value="Black Ops 7">Black Ops 7</option>
                  <option value="Black Ops 6">Black Ops 6</option>
                  <option value="Modern Warfare III">Modern Warfare III (2023)</option>
                  <option value="Modern Warfare II">Modern Warfare II (2022)</option>
                  <option value="Cold War">Cold War</option>
                  <option value="Black Ops 4">Black Ops 4</option>
                  <option value="Black Ops 3">Black Ops 3</option>
                </select>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">РЕЖИМ:</label>
                <select
                  v-model="groupFilters.game_mode"
                  @change="searchGroups"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все режимы</option>
                  <option value="Warzone">Warzone</option>
                  <option value="Multiplayer">Multiplayer</option>
                  <option value="Zombies">Zombies</option>
                  <option value="DMZ">DMZ</option>
                  <option value="Ranked">Ranked</option>
                </select>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">ПЛАТФОРМА:</label>
                <select
                  v-model="groupFilters.platform"
                  @change="searchGroups"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Все платформы</option>
                  <option value="Cross-platform">Cross-platform</option>
                  <option value="PC">PC</option>
                  <option value="PlayStation">PlayStation</option>
                  <option value="Xbox">Xbox</option>
                </select>
              </div>

              <div>
                <label class="block text-orange-500 font-mono text-xs mb-2">УРОВЕНЬ:</label>
                <select
                  v-model="groupFilters.skill_level"
                  @change="searchGroups"
                  class="w-full bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
                >
                  <option value="">Любой</option>
                  <option value="Новичок">Новичок</option>
                  <option value="Средний">Средний</option>
                  <option value="Продвинутый">Продвинутый</option>
                  <option value="Про">Про</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Groups Grid -->
          <div v-if="filteredGroups.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
              v-for="group in filteredGroups"
              :key="group.id"
              class="bg-black/50 border-2 border-orange-500/30 hover:border-orange-500 transition-all p-4 group"
            >
              <!-- Group Header -->
              <div class="flex items-start justify-between mb-3">
                <h3 class="text-white font-mono font-bold text-lg group-hover:text-orange-500 transition-colors flex-1">
                  {{ group.name }}
                </h3>
                <span
                  :class="[
                    'text-xs font-mono px-2 py-1 border',
                    group.has_slots
                      ? 'text-green-500 border-green-500/50 bg-green-500/10'
                      : 'text-red-500 border-red-500/50 bg-red-500/10'
                  ]"
                >
                  {{ group.current_members }}/{{ group.max_members }}
                </span>
              </div>

              <!-- Group Info -->
              <p v-if="group.description" class="text-gray-400 text-sm font-mono mb-3 line-clamp-2">
                {{ group.description }}
              </p>

              <!-- Group Details -->
              <div class="space-y-1 mb-4 text-xs font-mono">
                <div class="flex items-center text-orange-500">
                  <span class="text-orange-600">›</span>
                  <span class="ml-1">{{ group.game }}</span>
                </div>
                <div v-if="group.game_mode" class="flex items-center text-gray-400">
                  <span class="text-orange-600">›</span>
                  <span class="ml-1">{{ group.game_mode }}</span>
                </div>
                <div v-if="group.platform" class="flex items-center text-gray-400">
                  <span class="text-orange-600">›</span>
                  <span class="ml-1">{{ group.platform }}</span>
                </div>
                <div v-if="group.skill_level" class="flex items-center text-gray-400">
                  <span class="text-orange-600">›</span>
                  <span class="ml-1">Уровень: {{ group.skill_level }}</span>
                </div>
                <div v-if="group.contact_link && (isGroupMember(group.id) || isGroupCreator(group.id))" class="flex items-center text-green-500">
                  <span class="text-orange-600">›</span>
                  <span class="ml-1">Связь: </span>
                  <a
                    v-if="group.contact_link.startsWith('http')"
                    :href="group.contact_link"
                    target="_blank"
                    class="ml-1 hover:underline truncate"
                  >
                    {{ group.contact_link }}
                  </a>
                  <span v-else class="ml-1 truncate select-all">{{ group.contact_link }}</span>
                </div>
              </div>

              <!-- Creator -->
              <div class="mb-3 pb-3 border-b border-orange-500/20 flex items-center space-x-2">
                <div class="w-6 h-6 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center overflow-hidden">
                  <img v-if="group.creator?.avatar" :src="`/storage/${group.creator.avatar}`" :alt="group.creator?.name" class="w-full h-full object-cover">
                  <span v-else class="text-orange-500 text-xs font-bold">
                    {{ group.creator?.name?.charAt(0).toUpperCase() || '?' }}
                  </span>
                </div>
                <div class="flex-1 min-w-0">
                  <span class="text-gray-400 text-xs font-mono block truncate">{{ group.creator?.name }}</span>
                  <span class="text-gray-600 text-[10px] font-mono">Создатель</span>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex gap-2">
                <button
                  v-if="group.has_slots && !isGroupMember(group.id) && !isGroupCreator(group.id)"
                  @click="joinGroup(group.id)"
                  class="flex-1 bg-orange-500 hover:bg-orange-600 text-black px-3 py-2 text-xs font-mono font-bold transition-all"
                >
                  ПРИСОЕДИНИТЬСЯ
                </button>
                <button
                  v-else-if="isGroupMember(group.id) && !isGroupCreator(group.id)"
                  @click="leaveGroup(group.id)"
                  class="flex-1 bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-black border border-red-500 px-3 py-2 text-xs font-mono font-bold transition-all"
                >
                  ПОКИНУТЬ
                </button>
                <button
                  v-else-if="isGroupCreator(group.id)"
                  @click="deleteGroup(group.id)"
                  class="flex-1 bg-red-500/20 hover:bg-red-500 text-red-500 hover:text-black border border-red-500 px-3 py-2 text-xs font-mono font-bold transition-all"
                >
                  УДАЛИТЬ
                </button>
                <button
                  v-else
                  disabled
                  class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 text-xs font-mono font-bold cursor-not-allowed"
                >
                  НЕТ МЕСТ
                </button>
                <button
                  @click="viewGroupMembers(group)"
                  class="bg-orange-500/20 hover:bg-orange-500 text-orange-500 hover:text-black border border-orange-500 px-3 py-2 text-xs font-mono font-bold transition-all"
                >
                  УЧАСТНИКИ
                </button>
                <!-- Кнопка группового чата -->
                <button
                  v-if="isGroupMember(group.id) || isGroupCreator(group.id)"
                  @click="openGroupChat(group)"
                  class="bg-green-500/20 hover:bg-green-500 text-green-500 hover:text-black border border-green-500 px-3 py-2 text-xs font-mono font-bold transition-all"
                >
                  ЧАТ
                </button>
              </div>
            </div>
          </div>

          <!-- No Groups -->
          <div v-else class="text-center py-12">
            <div class="font-mono text-orange-500/50 mb-2">
              <span class="text-orange-600">&gt;</span> ГРУППЫ НЕ НАЙДЕНЫ
            </div>
            <p class="text-gray-500 text-sm font-mono">
              Создайте свою группу для поиска тиммейтов
            </p>
          </div>
        </div>

        <!-- Chats Tab -->
        <div v-if="activeTab === 'chats'" class="space-y-6">
          <div class="bg-black/50 border border-orange-500/30 p-4 md:p-6">
            <div class="font-mono text-sm text-orange-600 mb-4">
              <span class="text-orange-600">&gt;</span> ВАШИ ДИАЛОГИ:
            </div>

            <!-- Conversations List -->
            <div v-if="conversations.length > 0" class="space-y-3">
              <!-- Personal Chat -->
              <div
                v-for="conversation in conversations"
                :key="conversation.type === 'personal' ? 'user-' + conversation.user?.id : 'group-' + conversation.group?.id"
                @click="conversation.type === 'personal' ? openChat(conversation.user?.id) : openGroupChat(conversation.group)"
                class="bg-black/50 border-2 border-orange-500/30 hover:border-orange-500 transition-all p-4 cursor-pointer group"
              >
                <div class="flex items-center space-x-4">
                  <!-- Avatar -->
                  <div class="w-12 h-12 bg-orange-900/30 border-2 border-orange-500/50 flex items-center justify-center flex-shrink-0 overflow-hidden">
                    <!-- Personal chat avatar -->
                    <template v-if="conversation.type === 'personal'">
                      <img v-if="conversation.user?.avatar" :src="`/storage/${conversation.user.avatar}`" :alt="conversation.user?.name" class="w-full h-full object-cover">
                      <span v-else class="text-orange-500 text-xl font-bold font-mono">
                        {{ conversation.user?.name?.charAt(0).toUpperCase() || '?' }}
                      </span>
                    </template>
                    <!-- Group chat icon -->
                    <template v-else>
                      <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                    </template>
                  </div>

                  <!-- Conversation Info -->
                  <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                      <div>
                        <h3 class="text-white font-mono font-bold group-hover:text-orange-500 transition-colors">
                          {{ conversation.type === 'personal' ? (conversation.user?.name || 'Неизвестный пользователь') : conversation.group?.name }}
                        </h3>
                        <span v-if="conversation.type === 'group'" class="text-orange-500/70 text-xs font-mono">
                          Групповой чат
                        </span>
                      </div>
                      <span v-if="conversation.unread_count > 0" class="bg-red-500 text-white px-2 py-0.5 text-xs font-mono rounded-full">
                        {{ conversation.unread_count }}
                      </span>
                    </div>
                    <p class="text-gray-400 text-sm font-mono truncate">
                      {{ conversation.last_message || 'Нет сообщений' }}
                    </p>
                    <p class="text-gray-600 text-xs font-mono mt-1">
                      {{ formatDate(conversation.last_message_at) }}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- No Conversations -->
            <div v-else class="text-center py-8">
              <div class="font-mono text-orange-500/50">
                <span class="text-orange-600">&gt;</span> У ВАС ЕЩЁ НЕТ ДИАЛОГОВ
              </div>
              <p class="text-gray-500 text-sm font-mono mt-2">
                Найдите игрока во вкладке "ИГРОКИ" или присоединитесь к группе
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Group Chat Modal -->
    <div v-if="showGroupChat" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
      <div class="bg-black border-2 border-orange-500 w-full max-w-4xl max-h-[80vh] flex flex-col">
        <!-- Chat Header -->
        <div class="bg-orange-500/10 border-b border-orange-500 p-4 flex items-center justify-between">
          <div>
            <h2 class="text-white font-mono font-bold text-lg">{{ currentGroupChat?.name }}</h2>
            <p class="text-orange-500 text-xs font-mono">Групповой чат</p>
          </div>
          <button
            @click="closeGroupChat"
            class="text-orange-500 hover:text-orange-400 transition-colors"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Messages Area -->
        <div ref="groupChatMessagesContainer" class="flex-1 overflow-y-auto p-4 space-y-3 bg-black/50">
          <div v-if="loadingGroupMessages" class="text-center py-8">
            <div class="font-mono text-orange-500">
              <span class="text-orange-600">&gt;</span> ЗАГРУЗКА СООБЩЕНИЙ...
            </div>
          </div>

          <div v-else-if="groupChatMessages.length === 0" class="text-center py-8">
            <div class="font-mono text-orange-500/50">
              <span class="text-orange-600">&gt;</span> НЕТ СООБЩЕНИЙ
            </div>
            <p class="text-gray-500 text-sm font-mono mt-2">
              Будьте первым, кто напишет в этом чате
            </p>
          </div>

          <div
            v-else
            v-for="message in groupChatMessages"
            :key="message.id"
            class="flex items-start space-x-3"
          >
            <!-- Avatar -->
            <div class="w-8 h-8 bg-orange-900/30 border border-orange-500/50 flex items-center justify-center flex-shrink-0 overflow-hidden">
              <img v-if="message.user?.avatar" :src="`/storage/${message.user.avatar}`" :alt="message.user?.name" class="w-full h-full object-cover">
              <span v-else class="text-orange-500 text-xs font-bold">
                {{ message.user?.name?.charAt(0).toUpperCase() || '?' }}
              </span>
            </div>

            <!-- Message Content -->
            <div class="flex-1 min-w-0">
              <div class="flex items-center space-x-2 mb-1">
                <span class="text-orange-500 font-mono text-sm font-bold">{{ message.user?.name }}</span>
                <span class="text-gray-600 text-xs font-mono">{{ formatMessageTime(message.created_at) }}</span>
              </div>
              <div class="bg-orange-500/10 border border-orange-500/30 px-3 py-2 rounded-sm">
                <p class="text-white font-mono text-sm break-words">{{ message.message }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Message Input -->
        <div class="border-t border-orange-500 p-4 bg-black">
          <form @submit.prevent="sendGroupMessage" class="flex gap-2">
            <input
              v-model="newGroupMessage"
              type="text"
              placeholder="Введите сообщение..."
              class="flex-1 bg-black border-2 border-orange-500/30 focus:border-orange-500 text-white px-4 py-2 font-mono text-sm outline-none transition-all"
              maxlength="1000"
            >
            <button
              type="submit"
              :disabled="!newGroupMessage.trim() || sendingGroupMessage"
              class="bg-orange-500 hover:bg-orange-600 disabled:bg-gray-600 disabled:cursor-not-allowed text-black px-6 py-2 font-mono font-bold text-sm transition-all"
            >
              {{ sendingGroupMessage ? 'ОТПРАВКА...' : 'ОТПРАВИТЬ' }}
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import Seo from '../../Components/SEO.vue';
import axios from 'axios';
import communityBackground from '@/../images/communitybackground.jpg';

const props = defineProps({
  maps: Array,
  articles: Array,
});

// Users search
const activeTab = ref('articles'); // Changed default tab to 'articles'
const userSearchQuery = ref('');
const filteredUsers = ref([]);
const maxUsersDisplay = 10;

// Guides search
const guideSearchQuery = ref('');
const selectedGame = ref('');
const selectedMapSlug = ref('');
const filteredGuides = ref([]);
const availableMaps = computed(() => {
  if (!selectedGame.value) return props.maps || [];
  return (props.maps || []).filter(map => map.game === selectedGame.value);
});

// Articles search
const articleSearchQuery = ref('');
const selectedArticleGame = ref('');
const selectedArticleCategory = ref('');
const filteredArticles = ref([]);

// Chats
const conversations = ref([]);
const unreadMessagesCount = ref(0);

// Groups
const showCreateGroupForm = ref(false);
const creatingGroup = ref(false);
const filteredGroups = ref([]);
const userGroupIds = ref([]); // ID групп, в которых состоит пользователь
const userCreatorGroupIds = ref([]); // ID групп, созданных пользователем

const newGroup = ref({
  name: '',
  description: '',
  contact_link: '',
  game: '',
  game_mode: '',
  platform: '',
  max_members: 4,
  skill_level: '',
  language: 'Русский'
});

const groupFilters = ref({
  game: '',
  game_mode: '',
  platform: '',
  skill_level: ''
});

// SEO defaults
const seoTitle = 'Сообщество | COD Terminal';
const seoDescription = 'Присоединяйся к сообществу Call of Duty! Найди игроков, изучай гайды по картам зомби, читай статьи и общайся с другими фанатами COD.';
const seoKeywords = 'Call of Duty сообщество, COD игроки, зомби гайды, статьи COD, чат игроков, Black Ops, Modern Warfare';
const seoImage = '/images/og-default.webp';

// Search users
const searchUsers = async () => {
  try {
    const response = await axios.get('/api/community/users/search', {
      params: { query: userSearchQuery.value }
    });
    filteredUsers.value = response.data;
  } catch (error) {
    console.error('Error searching users:', error);
  }
};

// Search guides
const searchGuides = async () => {
  try {
    const response = await axios.get('/api/community/guides/search', {
      params: {
        query: guideSearchQuery.value,
        game: selectedGame.value,
        map_slug: selectedMapSlug.value
      }
    });
    filteredGuides.value = response.data;
  } catch (error) {
    console.error('Error searching guides:', error);
  }
};

// Search articles
const searchArticles = async () => {
  try {
    const response = await axios.get('/api/community/articles/search', {
      params: {
        query: articleSearchQuery.value,
        game: selectedArticleGame.value,
        category: selectedArticleCategory.value
      }
    });
    filteredArticles.value = response.data;
  } catch (error) {
    console.error('Error searching articles:', error);
  }
};

// Load conversations
const loadConversations = async () => {
  try {
    const response = await axios.get('/api/messages/conversations');
    // Теперь получаем как личные, так и групповые чаты
    conversations.value = response.data || [];
  } catch (error) {
    console.error('Error loading conversations:', error);
    conversations.value = [];
  }
};

// Load unread messages count
const loadUnreadCount = async () => {
  try {
    const response = await axios.get('/api/messages/unread-count');
    unreadMessagesCount.value = response.data.count;
  } catch (error) {
    console.error('Error loading unread count:', error);
  }
};

// View profile
const viewProfile = (userId) => {
  window.location.href = `/profile/${userId}`;
};

// Open chat
const openChat = (userId) => {
  // Redirect to chat page
  window.location.href = `/chat/${userId}`;
};

// Format date
const formatDate = (date) => {
  if (!date) return '';
  const d = new Date(date);
  return d.toLocaleDateString('ru-RU', { year: 'numeric', month: 'short', day: 'numeric' });
};

// ===== GROUPS FUNCTIONS =====

// Search groups
const searchGroups = async () => {
  try {
    const response = await axios.get('/api/community/groups', {
      params: {
        game: groupFilters.value.game,
        game_mode: groupFilters.value.game_mode,
        platform: groupFilters.value.platform,
        skill_level: groupFilters.value.skill_level
      }
    });
    filteredGroups.value = response.data;
  } catch (error) {
    console.error('Error searching groups:', error);
    filteredGroups.value = [];
  }
};

// Create group
const createGroup = async () => {
  if (!newGroup.value.name || !newGroup.value.game) {
    alert('Заполните название и выберите игру');
    return;
  }

  creatingGroup.value = true;
  try {
    const response = await axios.post('/api/community/groups', newGroup.value);

    if (response.data.success) {
      alert('Группа успешно создана!');
      // Сбросить форму
      newGroup.value = {
        name: '',
        description: '',
        contact_link: '',
        game: '',
        game_mode: '',
        platform: '',
        max_members: 4,
        skill_level: '',
        language: 'Русский'
      };
      showCreateGroupForm.value = false;
      // Обновить список групп
      await searchGroups();
    }
  } catch (error) {
    console.error('Error creating group:', error);
    alert(error.response?.data?.message || 'Ошибка при создании группы');
  } finally {
    creatingGroup.value = false;
  }
};

// Join group
const joinGroup = async (groupId) => {
  try {
    const response = await axios.post(`/api/community/groups/${groupId}/join`);

    if (response.data.success) {
      alert('Вы успешно присоединились к группе!');
      userGroupIds.value.push(groupId);
      // Обновить список групп
      await searchGroups();
    }
  } catch (error) {
    console.error('Error joining group:', error);
    alert(error.response?.data?.message || 'Ошибка при присоединении к группе');
  }
};

// Leave group
const leaveGroup = async (groupId) => {
  if (!confirm('Вы уверены, что хотите покинуть группу?')) {
    return;
  }

  try {
    const response = await axios.post(`/api/community/groups/${groupId}/leave`);

    if (response.data.success) {
      alert('Вы покинули группу');
      userGroupIds.value = userGroupIds.value.filter(id => id !== groupId);
      // Обновить список групп
      await searchGroups();
    }
  } catch (error) {
    console.error('Error leaving group:', error);
    alert(error.response?.data?.message || 'Ошибка при выходе из группы');
  }
};

// Delete group
const deleteGroup = async (groupId) => {
  if (!confirm('Вы уверены, что хотите удалить группу? Это действие нельзя отменить.')) {
    return;
  }

  try {
    const response = await axios.delete(`/api/community/groups/${groupId}`);

    if (response.data.success) {
      alert('Группа успешно удалена');
      userCreatorGroupIds.value = userCreatorGroupIds.value.filter(id => id !== groupId);
      // Обновить список групп
      await searchGroups();
    }
  } catch (error) {
    console.error('Error deleting group:', error);
    alert(error.response?.data?.message || 'Ошибка при удалении группы');
  }
};

// View group members
const viewGroupMembers = async (group) => {
  try {
    const response = await axios.get(`/api/community/groups/${group.id}/members`);
    const { creator, members } = response.data;

    let membersList = `УЧАСТНИКИ ГРУППЫ "${group.name}":\n\n`;
    membersList += `👑 Создатель: ${creator.name}\n\n`;

    if (members.length > 1) {
      membersList += `Участники (${members.length - 1}):\n`;
      members.forEach(member => {
        if (member.id !== creator.id) {
          membersList += `• ${member.name}\n`;
        }
      });
    } else {
      membersList += 'Пока нет других участников';
    }

    alert(membersList);
  } catch (error) {
    console.error('Error loading group members:', error);
    alert('Ошибка при загрузке участников группы');
  }
};

// Check if user is a member of group
const isGroupMember = (groupId) => {
  const group = filteredGroups.value.find(g => g.id === groupId);
  return group ? group.is_member : false;
};

// Check if user is creator of group
const isGroupCreator = (groupId) => {
  const group = filteredGroups.value.find(g => g.id === groupId);
  return group ? group.is_creator : false;
};

// ===== GROUP CHAT FUNCTIONS =====

// Group chat state
const showGroupChat = ref(false);
const currentGroupChat = ref(null);
const groupChatMessages = ref([]);
const newGroupMessage = ref('');
const loadingGroupMessages = ref(false);
const sendingGroupMessage = ref(false);
const groupChatMessagesContainer = ref(null);
let groupChatInterval = null;

// Open group chat
const openGroupChat = async (group) => {
  // Redirect to group chat page
  window.location.href = `/group-chat/${group.id}`;
};

// Close group chat
const closeGroupChat = () => {
  showGroupChat.value = false;
  currentGroupChat.value = null;
  groupChatMessages.value = [];
  newGroupMessage.value = '';

  // Очистить интервал обновления
  if (groupChatInterval) {
    clearInterval(groupChatInterval);
    groupChatInterval = null;
  }
};

// Load group chat messages
const loadGroupChatMessages = async () => {
  if (!currentGroupChat.value) return;

  loadingGroupMessages.value = true;
  try {
    const response = await axios.get(`/api/community/groups/${currentGroupChat.value.id}/messages`);
    groupChatMessages.value = response.data;
  } catch (error) {
    console.error('Error loading group messages:', error);
  } finally {
    loadingGroupMessages.value = false;
  }
};

// Send group message
const sendGroupMessage = async () => {
  if (!newGroupMessage.value.trim() || !currentGroupChat.value) return;

  sendingGroupMessage.value = true;
  try {
    const response = await axios.post(
      `/api/community/groups/${currentGroupChat.value.id}/messages`,
      { message: newGroupMessage.value }
    );

    // Добавить новое сообщение в список
    groupChatMessages.value.push(response.data);
    newGroupMessage.value = '';

    // Прокрутить вниз
    setTimeout(() => {
      scrollToBottomGroupChat();
    }, 100);
  } catch (error) {
    console.error('Error sending group message:', error);
    alert(error.response?.data?.error || 'Ошибка при отправке сообщения');
  } finally {
    sendingGroupMessage.value = false;
  }
};

// Scroll to bottom of group chat
const scrollToBottomGroupChat = () => {
  if (groupChatMessagesContainer.value) {
    groupChatMessagesContainer.value.scrollTop = groupChatMessagesContainer.value.scrollHeight;
  }
};

// Format message time
const formatMessageTime = (date) => {
  if (!date) return '';
  const d = new Date(date);
  const now = new Date();
  const diff = now - d;

  // Если сообщение сегодня, показываем только время
  if (d.toDateString() === now.toDateString()) {
    return d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
  }

  // Если вчера
  const yesterday = new Date(now);
  yesterday.setDate(yesterday.getDate() - 1);
  if (d.toDateString() === yesterday.toDateString()) {
    return 'Вчера ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
  }

  // Иначе показываем дату и время
  return d.toLocaleDateString('ru-RU', { day: 'numeric', month: 'short' }) + ' ' +
         d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
};

onMounted(() => {
  // Load initial data
  searchGuides(); // Загружаем все гайды при старте
  filteredArticles.value = props.articles || []; // Загружаем статьи из props
  searchGroups(); // Загружаем группы
  // НЕ загружаем пользователей автоматически - только по запросу
  loadConversations();
  loadUnreadCount();

  // Refresh unread count periodically
  setInterval(() => {
    loadUnreadCount();
  }, 30000); // every 30 seconds

  // Проверяем, нужно ли автоматически открыть групповой чат
  const openGroupChatId = localStorage.getItem('openGroupChatId');
  if (openGroupChatId) {
    // Переключаемся на вкладку "ГРУППЫ"
    activeTab.value = 'groups';

    // Удаляем из localStorage
    localStorage.removeItem('openGroupChatId');

    // Ждём загрузки групп и открываем чат
    setTimeout(async () => {
      const group = filteredGroups.value.find(g => g.id === parseInt(openGroupChatId));
      if (group) {
        await openGroupChat(group);
      }
    }, 1000);
  }
});
</script>

<style scoped>
/* Терминальное свечение */
.terminal-glow {
  text-shadow:
    0 0 10px rgba(249, 115, 22, 0.6),
    0 0 20px rgba(249, 115, 22, 0.4),
    0 0 30px rgba(249, 115, 22, 0.3),
    0 0 40px rgba(249, 115, 22, 0.2);
}

/* Мигающий курсор */
.cursor-blink {
  animation: blink 1s steps(1) infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Line clamp */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
