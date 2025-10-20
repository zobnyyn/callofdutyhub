<template>
  <div class="tiptap-editor border-2 border-orange-500/30 bg-black relative">
    <!-- Toolbar - панель инструментов -->
    <div
      v-if="editor"
      ref="toolbar"
      class="toolbar bg-gradient-to-r from-orange-900/95 to-red-900/95 backdrop-blur-md p-3 border-b-2 border-orange-500/30 shadow-lg"
    >
      <div class="grid grid-cols-6 md:grid-cols-12 gap-2">
        <!-- Bold, Italic, Strike -->
        <button
          type="button"
          @click="editor.chain().focus().toggleBold().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('bold') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all font-bold rounded"
          title="Bold (Ctrl+B)"
        >
          <strong>B</strong>
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleItalic().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('italic') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all italic rounded"
          title="Italic (Ctrl+I)"
        >
          <em>I</em>
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleStrike().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('strike') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Strikethrough"
        >
          <s>S</s>
        </button>

        <!-- Headings -->
        <button
          type="button"
          @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('heading', { level: 2 }) }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all font-bold rounded"
          title="Heading 2"
        >
          H2
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('heading', { level: 3 }) }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all font-bold rounded"
          title="Heading 3"
        >
          H3
        </button>

        <!-- Lists -->
        <button
          type="button"
          @click="editor.chain().focus().toggleBulletList().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('bulletList') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Bullet List"
        >
          •
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleOrderedList().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('orderedList') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Ordered List"
        >
          1.
        </button>

        <!-- Media -->
        <button
          type="button"
          @click="addImage"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Insert Image URL"
        >
          🖼️
        </button>
        <button
          type="button"
          @click="addYouTube"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Insert YouTube"
        >
          ▶️
        </button>
        <button
          type="button"
          @click="addAudio"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Insert Audio URL"
        >
          🎵
        </button>

        <!-- NEW: Insert Game Item Button -->
        <button
          type="button"
          @click="openItemPicker"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded bg-orange-600/20"
          title="Вставить предмет из игры"
        >
          🎮
        </button>

        <!-- Link -->
        <button
          type="button"
          @click="addLink"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Insert Link"
        >
          🔗
        </button>

        <!-- Alignment -->
        <button
          type="button"
          @click="editor.chain().focus().setTextAlign('left').run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive({ textAlign: 'left' }) }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Align Left"
        >
          ⬅
        </button>
        <button
          type="button"
          @click="editor.chain().focus().setTextAlign('center').run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive({ textAlign: 'center' }) }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Align Center"
        >
          ↔
        </button>
      </div>

      <!-- Second Row (expandable) -->
      <div v-if="showFullToolbar" class="grid grid-cols-6 md:grid-cols-12 gap-2 mt-2 pt-2 border-t border-orange-500/30">
        <button
          type="button"
          @click="editor.chain().focus().toggleCodeBlock().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('codeBlock') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Code Block"
        >
          &lt;/&gt;
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleBlockquote().run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive('blockquote') }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Blockquote"
        >
          "
        </button>
        <button
          type="button"
          @click="editor.chain().focus().setTextAlign('right').run()"
          :class="{ 'bg-orange-500 text-black': editor.isActive({ textAlign: 'right' }) }"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Align Right"
        >
          ➡
        </button>
        <button
          type="button"
          @click="editor.chain().focus().setHorizontalRule().run()"
          class="p-2 border border-orange-500/30 hover:bg-orange-500/30 text-white font-mono text-sm transition-all rounded"
          title="Horizontal Line"
        >
          ─
        </button>

        <!-- Upload -->
        <div class="p-2 bg-orange-600 hover:bg-orange-500 text-black font-mono text-sm transition-all rounded cursor-pointer text-center">
          <label class="w-full h-full cursor-pointer flex items-center justify-center">
            📁
            <input
              type="file"
              accept="image/*,image/gif"
              @change="handleImageUpload"
              class="hidden"
            />
          </label>
        </div>

        <!-- Audio Upload -->
        <div class="p-2 bg-orange-600 hover:bg-orange-500 text-black font-mono text-sm transition-all rounded cursor-pointer text-center">
          <label class="w-full h-full cursor-pointer flex items-center justify-center" title="Загрузить аудио">
            🎧
            <input
              ref="audioFileInput"
              type="file"
              accept="audio/*"
              @change="handleAudioUpload"
              class="hidden"
            />
          </label>
        </div>
      </div>

      <!-- Toggle Button -->
      <div class="mt-2 flex justify-center">
        <button
          type="button"
          @click="toggleFullToolbar"
          class="text-xs text-orange-300 font-mono px-3 py-1 border border-orange-500/30 rounded hover:bg-orange-500/30 transition-all"
        >
          {{ showFullToolbar ? '▲ Скрыть дополнительные' : '▼ Показать все инструменты' }}
        </button>
      </div>
    </div>

    <!-- Editor Content -->
    <div class="p-4 min-h-[500px] overflow-y-auto bg-black" ref="editorContainer">
      <editor-content :editor="editor" />

      <!-- Selection Menu (показывается при выделении текста) -->
      <div
        v-if="editor && isTextSelected"
        ref="floatingMenu"
        class="selection-menu absolute z-50 animate-fadeIn"
        :style="{
          left: selectionPosition.x + 'px',
          top: selectionPosition.y - 60 + 'px',
        }"
      >
        <div class="bg-gradient-to-r from-orange-600 to-red-600 border-2 border-orange-400 rounded-lg p-2 shadow-2xl shadow-orange-500/50">
          <!-- Первый ряд - основное форматирование -->
          <div class="flex gap-1 mb-2">
            <button
              type="button"
              @click.prevent="applyFormat('bold')"
              :class="{ 'bg-white text-orange-600': editor.isActive('bold') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all font-bold rounded"
              title="Bold"
            >
              <strong>B</strong>
            </button>
            <button
              type="button"
              @click.prevent="applyFormat('italic')"
              :class="{ 'bg-white text-orange-600': editor.isActive('italic') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all italic rounded"
              title="Italic"
            >
              <em>I</em>
            </button>
            <button
              type="button"
              @click.prevent="applyFormat('strike')"
              :class="{ 'bg-white text-orange-600': editor.isActive('strike') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Strikethrough"
            >
              <s>S</s>
            </button>
            <button
              type="button"
              @click.prevent="applyFormat('code')"
              :class="{ 'bg-white text-orange-600': editor.isActive('code') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Inline Code"
            >
              &lt;/&gt;
            </button>

            <div class="w-px bg-orange-400 mx-1"></div>

            <button
              type="button"
              @click.prevent="applyFormat('heading', { level: 2 })"
              :class="{ 'bg-white text-orange-600': editor.isActive('heading', { level: 2 }) }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all font-bold rounded"
              title="Heading 2"
            >
              H2
            </button>
            <button
              type="button"
              @click.prevent="applyFormat('heading', { level: 3 })"
              :class="{ 'bg-white text-orange-600': editor.isActive('heading', { level: 3 }) }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all font-bold rounded"
              title="Heading 3"
            >
              H3
            </button>

            <div class="w-px bg-orange-400 mx-1"></div>

            <button
              type="button"
              @click.prevent="addLinkFromSelection"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Add Link"
            >
              🔗
            </button>
            <button
              type="button"
              @click.prevent="addChapterLink"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded relative"
              title="Link to Chapter"
            >
              📑
            </button>
            <button
              type="button"
              @click.prevent="openItemPickerFromBubble"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded bg-orange-600/30"
              title="Вставить предмет из игры"
            >
              🎮
            </button>
            <button
              type="button"
              @click.prevent="triggerBubbleImageUpload"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Загрузить изображение"
            >
              🖼️
            </button>
            <button
              type="button"
              @click.prevent="triggerBubbleAudioUpload"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Загрузить аудио"
            >
              🎧
            </button>
          </div>

          <!-- Второй ряд - дополнительные опции -->
          <div class="flex gap-1 pt-2 border-t border-orange-400/50">
            <button
              type="button"
              @click.prevent="applyFormat('bulletList')"
              :class="{ 'bg-white text-orange-600': editor.isActive('bulletList') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Bullet List"
            >
              •
            </button>
            <button
              type="button"
              @click.prevent="applyFormat('orderedList')"
              :class="{ 'bg-white text-orange-600': editor.isActive('orderedList') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Ordered List"
            >
              1.
            </button>
            <button
              type="button"
              @click.prevent="applyFormat('blockquote')"
              :class="{ 'bg-white text-orange-600': editor.isActive('blockquote') }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Quote"
            >
              "
            </button>

            <div class="w-px bg-orange-400 mx-1"></div>

            <button
              type="button"
              @click.prevent="applyAlignment('left')"
              :class="{ 'bg-white text-orange-600': editor.isActive({ textAlign: 'left' }) }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Align Left"
            >
              ⬅
            </button>
            <button
              type="button"
              @click.prevent="applyAlignment('center')"
              :class="{ 'bg-white text-orange-600': editor.isActive({ textAlign: 'center' }) }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Align Center"
            >
              ↔
            </button>
            <button
              type="button"
              @click.prevent="applyAlignment('right')"
              :class="{ 'bg-white text-orange-600': editor.isActive({ textAlign: 'right' }) }"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Align Right"
            >
              ➡
            </button>

            <div class="w-px bg-orange-400 mx-1"></div>

            <button
              type="button"
              @click.prevent="clearFormatting"
              class="px-3 py-1.5 hover:bg-orange-500 text-white font-mono text-sm transition-all rounded"
              title="Clear Formatting"
            >
              ✖
            </button>
          </div>
        </div>
      </div>

      <!-- Chapter Selection Menu -->
      <div
        v-if="showChapterMenu"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[100] flex items-center justify-center"
        @click.self="showChapterMenu = false"
      >
        <div class="bg-gradient-to-br from-orange-900 to-red-900 border-2 border-orange-400 rounded-lg p-6 max-w-md w-full mx-4 shadow-2xl shadow-orange-500/50 animate-fadeIn">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-orange-300 font-mono">Выберите главу</h3>
            <button
              @click="showChapterMenu = false"
              class="text-orange-300 hover:text-white text-2xl font-bold"
            >
              ×
            </button>
          </div>

          <div class="max-h-96 overflow-y-auto space-y-2">
            <button
              v-for="chapter in chapters"
              :key="chapter.id"
              @click="selectChapter(chapter)"
              class="w-full text-left px-4 py-3 bg-black/50 hover:bg-orange-600/50 border border-orange-500/30 rounded transition-all"
              :class="{
                'pl-6': chapter.level === 2,
                'pl-8': chapter.level === 3,
              }"
            >
              <span class="text-orange-400 font-mono text-xs mr-2">
                {{ chapter.level === 2 ? 'H2' : 'H3' }}
              </span>
              <span class="text-white">{{ chapter.text }}</span>
            </button>

            <div v-if="chapters.length === 0" class="text-center py-8 text-orange-300/50">
              В документе нет заголовков
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Hidden file input for bubble menu image upload -->
    <input
      ref="bubbleImageInput"
      type="file"
      accept="image/*,image/gif"
      @change="handleBubbleImageUpload"
      class="hidden"
    />

    <!-- Hidden file input for bubble menu audio upload -->
    <input
      ref="bubbleAudioInput"
      type="file"
      accept="audio/*"
      @change="handleBubbleAudioUpload"
      class="hidden"
    />

    <!-- Item Picker Modal -->
    <ItemPickerModal
      :isOpen="showItemPicker"
      :game="currentGame"
      @close="showItemPicker = false"
      @select="insertGameItem"
    />
  </div>
</template>

<script setup>
import { ref, watch, onBeforeUnmount, onMounted, computed } from 'vue';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Youtube from '@tiptap/extension-youtube';
import Link from '@tiptap/extension-link';
import TextAlign from '@tiptap/extension-text-align';
import Placeholder from '@tiptap/extension-placeholder';
import { Extension } from '@tiptap/core';
import { Plugin, PluginKey } from '@tiptap/pm/state';
import ItemPickerModal from './ItemPickerModal.vue';
import { Mark } from '@tiptap/core';
import { Audio } from '../tiptap-audio.js';

// Custom Game Item Mark Extension
const GameItemMark = Mark.create({
  name: 'gameItem',

  addOptions() {
    return {
      HTMLAttributes: {},
    };
  },

  addAttributes() {
    return {
      'data-item-name': {
        default: null,
      },
      'data-item-image': {
        default: null,
      },
      'data-item-description': {
        default: null,
      },
      'data-item-rarity': {
        default: null,
      },
      'data-item-rarity-color': {
        default: null,
      },
    };
  },

  parseHTML() {
    return [
      {
        tag: 'span.game-item-link',
        getAttrs: (dom) => {
          if (typeof dom === 'string') return false;
          return {
            'data-item-name': dom.getAttribute('data-item-name'),
            'data-item-image': dom.getAttribute('data-item-image'),
            'data-item-description': dom.getAttribute('data-item-description'),
            'data-item-rarity': dom.getAttribute('data-item-rarity'),
            'data-item-rarity-color': dom.getAttribute('data-item-rarity-color'),
          };
        },
      },
    ];
  },

  renderHTML({ HTMLAttributes }) {
    return ['span', { class: 'game-item-link', ...HTMLAttributes }, 0];
  },
});

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  game: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:modelValue']);

const toolbar = ref(null);
const floatingMenu = ref(null);
const editorContainer = ref(null);
const isTextSelected = ref(false);
const selectionPosition = ref({ x: 0, y: 0 });
const showFullToolbar = ref(false);
const isToolbarFixed = ref(false);
const toolbarTop = ref(0);
const editorTop = ref(0);
const showChapterMenu = ref(false);
const chapters = ref([]);
const showItemPicker = ref(false);
const currentGame = ref(props.game);
const bubbleImageInput = ref(null);
const bubbleAudioInput = ref(null);
const audioFileInput = ref(null);

// Watch for game prop changes
watch(() => props.game, (newGame) => {
  currentGame.value = newGame;
});

// Open item picker modal
const openItemPicker = () => {
  if (!currentGame.value) {
    alert('Пожалуйста, сначала выберите игру');
    return;
  }
  showItemPicker.value = true;
};

// Open item picker from bubble menu (same functionality)
const openItemPickerFromBubble = () => {
  if (!currentGame.value) {
    alert('Пожалуйста, сначала выберите игру');
    return;
  }
  showItemPicker.value = true;
};

// Insert game item into editor
const insertGameItem = (item) => {
  if (!editor.value) return;

  const imageSrc = item.image ? `/storage/${item.image}` : '';
  const description = (item.description || 'Нет описания').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
  const rarityColor = item.rarity ? getRarityColor(item.rarity) : '#6b7280';
  const rarityLabel = item.rarity ? getRarityLabel(item.rarity) : '';
  const itemName = item.name.replace(/"/g, '&quot;').replace(/'/g, '&#39;');

  // Create HTML for the item link
  const itemHtml = `<span class="game-item-link" data-item-name="${itemName}" data-item-image="${imageSrc}" data-item-description="${description}" data-item-rarity="${rarityLabel}" data-item-rarity-color="${rarityColor}">${item.name}</span>&nbsp;`;

  // Insert as HTML content
  editor.value.chain().focus().insertContent(itemHtml).run();
};

// Get rarity color for tooltip
const getRarityColor = (rarity) => {
  const colors = {
    common: '#9ca3af',
    rare: '#3b82f6',
    epic: '#a855f7',
    legendary: '#f59e0b',
    ultra: '#dc2626',
    whimsical: '#10b981'
  };
  return colors[rarity] || '#6b7280';
};

// Get rarity label
const getRarityLabel = (rarity) => {
  const labels = {
    common: 'Обычная',
    rare: 'Редкая',
    epic: 'Эпическая',
    legendary: 'Легендарная',
    ultra: 'Ультра',
    whimsical: 'Причудливая'
  };
  return labels[rarity] || rarity;
};

// Вычисляем стиль для панели инструментов
const toolbarStyle = computed(() => {
  if (isToolbarFixed.value) {
    return {
      position: 'fixed',
      top: '110px', // Высота хэдера + отступ
      left: `${editorTop.value}px`,
      width: toolbar.value ? `${toolbar.value.offsetWidth}px` : 'auto',
      zIndex: 1000
    };
  }
  return {};
});

// Переключение полной панели инструментов
const toggleFullToolbar = () => {
  showFullToolbar.value = !showFullToolbar.value;
};

// Функция для генерации ID из текста заголовка
const generateId = (text) => {
  return text
    .toLowerCase()
    .replace(/[^a-zа-яё0-9\s]/g, '')
    .trim()
    .replace(/\s+/g, '-');
};

// Расширение для добавления ID к заголовкам
const HeadingWithId = Extension.create({
  name: 'headingWithId',

  addGlobalAttributes() {
    return [
      {
        types: ['heading'],
        attributes: {
          id: {
            default: null,
            parseHTML: element => element.getAttribute('id'),
            renderHTML: attributes => {
              if (!attributes.id) {
                return {};
              }
              return { id: attributes.id };
            },
          },
        },
      },
    ];
  },

  addProseMirrorPlugins() {
    return [
      new Plugin({
        key: new PluginKey('headingWithId'),
        appendTransaction: (transactions, oldState, newState) => {
          const tr = newState.tr;
          let modified = false;

          newState.doc.descendants((node, pos) => {
            if (node.type.name === 'heading') {
              const id = generateId(node.textContent);
              if (node.attrs.id !== id) {
                tr.setNodeMarkup(pos, undefined, {
                  ...node.attrs,
                  id,
                });
                modified = true;
              }
            }
          });

          return modified ? tr : null;
        },
      }),
    ];
  },
});

// Собираем все заголовки из документа
const updateChapters = () => {
  if (!editor.value) return;

  const headings = [];
  editor.value.state.doc.descendants((node, pos) => {
    if (node.type.name === 'heading') {
      headings.push({
        id: node.attrs.id || generateId(node.textContent),
        text: node.textContent,
        level: node.attrs.level,
      });
    }
  });

  chapters.value = headings;
};

// Добавить ссылку на главу
const addChapterLink = () => {
  updateChapters();
  if (chapters.value.length === 0) {
    alert('В документе нет заголовков для ссылки');
    return;
  }
  showChapterMenu.value = true;
};

// Выбрать главу и создать ссылку
const selectChapter = (chapter) => {
  if (!editor.value) return;

  const href = `#${chapter.id}`;
  editor.value.chain().focus().setLink({ href }).run();
  showChapterMenu.value = false;
};

// Обработчик скролла
const handleScroll = () => {
  if (!editorContainer.value || !toolbar.value) return;

  const containerRect = editorContainer.value.getBoundingClientRect();
  const toolbarHeight = toolbar.value.offsetHeight;
  const HEADER_HEIGHT = 120; // Высота хэдера страницы

  // Если верх контейнера редактора выше верха окна + хэдер, фиксируем панель
  if (containerRect.top < HEADER_HEIGHT + 20) {
    isToolbarFixed.value = true;
    editorTop.value = containerRect.left;

    // Если низ контейнера выше панели, убираем фиксацию
    if (containerRect.bottom < toolbarHeight + HEADER_HEIGHT + 40) {
      isToolbarFixed.value = false;
    }
  } else {
    isToolbarFixed.value = false;
  }
};

const editor = useEditor({
  content: props.modelValue,
  extensions: [
    StarterKit,
    Image.configure({
      inline: true,
      allowBase64: true,
      HTMLAttributes: {
        class: 'max-w-full h-auto border-2 border-orange-500/30 my-4'
      }
    }),
    Youtube.configure({
      width: 640,
      height: 360,
      HTMLAttributes: {
        class: 'my-4 mx-auto'
      }
    }),
    Audio, // Добавляем расширение для аудиофайлов
    Link.configure({
      openOnClick: false,
      HTMLAttributes: {
        class: 'text-orange-500 underline hover:text-orange-400 cursor-pointer'
      },
      validate: href => /^https?:\/\//.test(href) || /^#/.test(href),
    }),
    TextAlign.configure({
      types: ['heading', 'paragraph']
    }),
    Placeholder.configure({
      placeholder: 'Начните писать свой гайд здесь...\n\nВы можете вставлять изображения, видео, аудио, форматировать текст и многое другое!'
    }),
    HeadingWithId, // Добавляем расширение для заголовков с ID
    GameItemMark, // Добавляем расширение для игровых предметов
  ],
  editorProps: {
    attributes: {
      class: 'prose prose-invert prose-orange max-w-none focus:outline-none text-gray-300'
    },
    handleClick: (view, pos, event) => {
      const target = event.target;
      if (target.tagName === 'A') {
        const href = target.getAttribute('href');
        if (href && href.startsWith('#')) {
          event.preventDefault();
          const id = href.substring(1);
          const element = document.getElementById(id);
          if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
          return true;
        }
      }
      return false;
    },
  },
  onSelectionUpdate: ({ editor }) => {
    // Проверяем, выделен ли текст
    const { from, to, empty } = editor.state.selection;
    isTextSelected.value = !empty && from !== to;

    if (isTextSelected.value) {
      // Получаем координаты выделения
      const { view } = editor;
      const { from } = editor.state.selection;
      const start = view.coordsAtPos(from);
      const editorElement = document.querySelector('.ProseMirror');

      if (editorElement) {
        const editorPos = editorElement.getBoundingClientRect();

        // Корректируем позицию относительно контейнера редактора
        selectionPosition.value = {
          x: Math.max(0, start.left - editorPos.left),
          y: Math.max(0, start.top - editorPos.top)
        };
      }
    }
  },
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML());
  }
});

// Обработчик события mouseup для всего документа
const handleMouseUp = () => {
  if (editor.value) {
    const { from, to } = editor.value.state.selection;
    isTextSelected.value = from !== to;
  }
};

onMounted(() => {
  // Добавляем обработчики событий
  document.addEventListener('mouseup', handleMouseUp);
  document.addEventListener('keyup', handleMouseUp);
  window.addEventListener('scroll', handleScroll);
  window.addEventListener('resize', handleScroll);

  // Инициализируем позиции
  setTimeout(() => {
    handleScroll();
    initGameItemTooltips();
  }, 100);
});

onBeforeUnmount(() => {
  document.removeEventListener('mouseup', handleMouseUp);
  document.removeEventListener('keyup', handleMouseUp);
  window.removeEventListener('scroll', handleScroll);
  window.removeEventListener('resize', handleScroll);

  // Clean up tooltip container
  const tooltipContainer = document.getElementById('game-item-tooltip');
  if (tooltipContainer) {
    tooltipContainer.remove();
  }

  if (editor.value) {
    editor.value.destroy();
  }
});

// Initialize game item tooltips
const initGameItemTooltips = () => {
  // Create tooltip container if it doesn't exist
  let tooltipContainer = document.getElementById('game-item-tooltip');
  if (!tooltipContainer) {
    tooltipContainer = document.createElement('div');
    tooltipContainer.id = 'game-item-tooltip';
    tooltipContainer.className = 'game-item-tooltip-container';
    document.body.appendChild(tooltipContainer);
  }

  // Add event listeners to game item links using event delegation
  const editorElement = editorContainer.value;
  if (!editorElement) return;

  editorElement.addEventListener('mouseover', (e) => {
    const target = e.target;
    if (target.classList.contains('game-item-link')) {
      showGameItemTooltip(target, tooltipContainer);
    }
  });

  editorElement.addEventListener('mouseout', (e) => {
    const target = e.target;
    if (target.classList.contains('game-item-link')) {
      hideGameItemTooltip(tooltipContainer);
    }
  });
};

// Show game item tooltip
const showGameItemTooltip = (element, container) => {
  const name = element.getAttribute('data-item-name');
  const image = element.getAttribute('data-item-image');
  const description = element.getAttribute('data-item-description');
  const rarity = element.getAttribute('data-item-rarity');
  const rarityColor = element.getAttribute('data-item-rarity-color');

  // Create tooltip HTML
  let tooltipHTML = '<div class="game-item-tooltip-box">';

  if (image && image !== '' && image !== '/storage/') {
    tooltipHTML += `<img src="${image}" alt="${name}" class="game-item-tooltip-image" onerror="this.style.display='none'">`;
  }

  tooltipHTML += '<div class="game-item-tooltip-content">';
  tooltipHTML += `<span class="game-item-tooltip-name">${name}</span>`;

  if (description && description !== 'Нет описания') {
    tooltipHTML += `<span class="game-item-tooltip-description">${description}</span>`;
  }

  if (rarity) {
    tooltipHTML += `<span class="game-item-tooltip-rarity" style="background-color: ${rarityColor}">${rarity}</span>`;
  }

  tooltipHTML += '</div></div>';

  container.innerHTML = tooltipHTML;
  container.classList.add('active');

  // Position tooltip
  const rect = element.getBoundingClientRect();
  const tooltipBox = container.querySelector('.game-item-tooltip-box');

  // Wait for next frame to get correct dimensions
  requestAnimationFrame(() => {
    const tooltipRect = tooltipBox.getBoundingClientRect();

    // Position above the element, centered
    let left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
    let top = rect.top - tooltipRect.height - 10;

    // Adjust if tooltip goes off screen
    if (left < 10) left = 10;
    if (left + tooltipRect.width > window.innerWidth - 10) {
      left = window.innerWidth - tooltipRect.width - 10;
    }

    // If tooltip goes above viewport, show below element
    if (top < 10) {
      top = rect.bottom + 10;
    }

    container.style.left = left + 'px';
    container.style.top = top + 'px';
  });
};

// Hide game item tooltip
const hideGameItemTooltip = (container) => {
  container.classList.remove('active');
  setTimeout(() => {
    container.innerHTML = '';
  }, 300);
};

// Add image by URL
function addImage() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL изображения (или загрузите файл через кнопку Upload):');
  if (url) {
    editor.value.chain().focus().setImage({ src: url }).run();
  }
}

// Add YouTube video
function addYouTube() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL YouTube видео:');
  if (url) {
    editor.value.chain().focus().setYoutubeVideo({ src: url }).run();
  }
}

// Add Audio
function addAudio() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL аудио:');
  if (url) {
    const title = window.prompt('Введите название аудиофайла (необязательно):');
    editor.value.chain().focus().setAudio({ src: url, title: title || 'Аудиофайл' }).run();
  }
}

// Add Link
function addLink() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL ссылки:');
  if (url) {
    editor.value.chain().focus().setLink({ href: url }).run();
  }
}

// Handle image file upload
function handleImageUpload(event) {
  if (!editor.value) return;

  const file = event.target.files[0];
  if (!file) return;

  if (!file.type.startsWith('image/')) {
    alert('Пожалуйста, выберите изображение');
    return;
  }

  if (file.size > 5 * 1024 * 1024) {
    alert('Размер файла не должен превышать 5MB');
    return;
  }

  const reader = new FileReader();
  reader.onload = (e) => {
    const base64 = e.target.result;
    editor.value.chain().focus().setImage({ src: base64 }).run();
  };
  reader.readAsDataURL(file);
}

// Handle audio file upload
function handleAudioUpload(event) {
  if (!editor.value) return;

  const file = event.target.files[0];
  if (!file) return;

  if (!file.type.startsWith('audio/')) {
    alert('Пожалуйста, выберите аудиофайл');
    return;
  }

  if (file.size > 20 * 1024 * 1024) {
    alert('Размер файла не должен превышать 20MB');
    return;
  }

  // Показываем индикатор загрузки как оверлей (не в контенте редактора)
  const loadingNode = document.createElement('div');
  loadingNode.className = 'audio-upload-loading';
  loadingNode.innerHTML = '<div class="loading-spinner"></div><span>Загрузка аудио...</span>';
  loadingNode.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; display: flex; align-items: center; gap: 10px; padding: 20px; background: rgba(0, 0, 0, 0.9); border: 2px solid rgba(249, 115, 22, 0.5); border-radius: 8px; color: #fb923c; font-family: monospace; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);';

  // Добавляем оверлей к body, а не к редактору
  document.body.appendChild(loadingNode);

  // Создаем FormData для загрузки
  const formData = new FormData();
  formData.append('audio', file);

  // Загружаем файл на сервер
  fetch('/api/upload/audio', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    }
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Удаляем индикатор загрузки
        if (loadingNode.parentNode) {
          loadingNode.remove();
        }

        // Вставляем аудио с URL вместо base64
        const title = data.filename || file.name;

        // Вставляем аудио и перемещаем курсор после него
        editor.value
          .chain()
          .focus()
          .setAudio({ src: data.url, title: title })
          .enter() // Добавляем новую строку после аудио
          .run();
      } else {
        throw new Error('Ошибка загрузки');
      }
    })
    .catch(error => {
      // Удаляем индикатор загрузки
      if (loadingNode.parentNode) {
        loadingNode.remove();
      }

      console.error('Ошибка загрузки аудио:', error);
      alert('Ошибка при загрузке аудиофайла. Попробуйте еще раз.');
    })
    .finally(() => {
      // Очищаем input
      event.target.value = '';
    });
}

// Apply format to the selected text
function applyFormat(format, options) {
  if (!editor.value) return;

  switch (format) {
    case 'bold':
      editor.value.chain().focus().toggleBold().run();
      break;
    case 'italic':
      editor.value.chain().focus().toggleItalic().run();
      break;
    case 'strike':
      editor.value.chain().focus().toggleStrike().run();
      break;
    case 'code':
      editor.value.chain().focus().toggleCode().run();
      break;
    case 'heading':
      editor.value.chain().focus().toggleHeading(options).run();
      break;
    case 'bulletList':
      editor.value.chain().focus().toggleBulletList().run();
      break;
    case 'orderedList':
      editor.value.chain().focus().toggleOrderedList().run();
      break;
    case 'blockquote':
      editor.value.chain().focus().toggleBlockquote().run();
      break;
    default:
      break;
  }
}

// Apply alignment to the selected text
function applyAlignment(alignment) {
  if (!editor.value) return;
  editor.value.chain().focus().setTextAlign(alignment).run();
}

// Clear all formatting from selected text
function clearFormatting() {
  if (!editor.value) return;
  editor.value.chain().focus().clearNodes().unsetAllMarks().run();
}

// Add link from the selected text
function addLinkFromSelection() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL ссылки для выделенного текста:');
  if (url) {
    editor.value.chain().focus().setLink({ href: url }).run();
  }
}

// Add image from bubble menu
function addImageFromBubble() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL изображения для вставки:');
  if (url) {
    editor.value.chain().focus().setImage({ src: url }).run();
  }
}

// Trigger file input for bubble image upload
function triggerBubbleImageUpload() {
  if (bubbleImageInput.value) {
    bubbleImageInput.value.click();
  }
}

// Handle image upload from bubble menu
function handleBubbleImageUpload(event) {
  if (!editor.value) return;

  const file = event.target.files[0];
  if (!file) return;

  if (!file.type.startsWith('image/')) {
    alert('Пожалуйста, выберите изображение');
    return;
  }

  if (file.size > 5 * 1024 * 1024) {
    alert('Размер файла не должен превышать 5MB');
    return;
  }

  const reader = new FileReader();
  reader.onload = (e) => {
    const base64 = e.target.result;
    editor.value.chain().focus().setImage({ src: base64 }).run();
  };
  reader.readAsDataURL(file);
}

// Trigger file input for bubble audio upload
function triggerBubbleAudioUpload() {
  if (bubbleAudioInput.value) {
    bubbleAudioInput.value.click();
  }
}

// Handle audio upload from bubble menu
function handleBubbleAudioUpload(event) {
  if (!editor.value) return;

  const file = event.target.files[0];
  if (!file) return;

  if (!file.type.startsWith('audio/')) {
    alert('Пожалуйста, выберите аудиофайл');
    return;
  }

  if (file.size > 20 * 1024 * 1024) {
    alert('Размер файла не должен превышать 20MB');
    return;
  }

  // Показываем индикатор загрузки как оверлей (не в контенте редактора)
  const loadingNode = document.createElement('div');
  loadingNode.className = 'audio-upload-loading';
  loadingNode.innerHTML = '<div class="loading-spinner"></div><span>Загрузка аудио...</span>';
  loadingNode.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; display: flex; align-items: center; gap: 10px; padding: 20px; background: rgba(0, 0, 0, 0.9); border: 2px solid rgba(249, 115, 22, 0.5); border-radius: 8px; color: #fb923c; font-family: monospace; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);';

  // Добавляем оверлей к body, а не к редактору
  document.body.appendChild(loadingNode);

  // Создаем FormData для загрузки
  const formData = new FormData();
  formData.append('audio', file);

  // Загружаем файл на сервер
  fetch('/api/upload/audio', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    }
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Удаляем индикатор загрузки
        if (loadingNode.parentNode) {
          loadingNode.remove();
        }

        // Вставляем аудио с URL вместо base64
        const title = data.filename || file.name;

        // Вставляем аудио и перемещаем курсор после него
        editor.value
          .chain()
          .focus()
          .setAudio({ src: data.url, title: title })
          .enter() // Добавляем новую строку после аудио
          .run();
      } else {
        throw new Error('Ошибка загрузки');
      }
    })
    .catch(error => {
      // Удаляем индикатор загрузки
      if (loadingNode.parentNode) {
        loadingNode.remove();
      }

      console.error('Ошибка загрузки аудио:', error);
      alert('Ошибка при загрузке аудиофайла. Попробуйте еще раз.');
    })
    .finally(() => {
      // Очищаем input
      event.target.value = '';
    });
}

watch(() => props.modelValue, (value) => {
  if (!editor.value) return;
  const isSame = editor.value.getHTML() === value;
  if (isSame) return;
  editor.value.commands.setContent(value, false);
});
</script>

<style>
/* Tiptap Editor Styles */
.tiptap {
  min-height: 400px;
}

/* Floating Toolbar */
.toolbar-floating {
  position: relative;
  width: 100%;
  transition: all 0.3s ease;
}

.toolbar-fixed {
  position: fixed !important;
  animation: slideDown 0.3s ease;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Sticky Toolbar */
.toolbar-sticky {
  position: sticky;
  top: 0;
  z-index: 100;
  width: 100%;
}

.tiptap p.is-editor-empty:first-child::before {
  content: attr(data-placeholder);
  float: left;
  color: rgba(156, 163, 175, 0.5);
  pointer-events: none;
  height: 0;
}

.tiptap h2 {
  font-size: 2rem;
  font-weight: 900;
  color: #f97316;
  margin-top: 2rem;
  margin-bottom: 1rem;
  text-transform: uppercase;
  font-family: monospace;
}

.tiptap h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #fb923c;
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
  font-family: monospace;
}

.tiptap p {
  margin-bottom: 1rem;
  line-height: 1.75;
}

.tiptap ul,
.tiptap ol {
  margin-left: 1.5rem;
  margin-bottom: 1rem;
}

.tiptap li {
  margin-bottom: 0.5rem;
}

.tiptap a {
  color: #f97316;
  text-decoration: underline;
}

.tiptap a:hover {
  color: #fb923c;
}

.tiptap code {
  background-color: rgba(249, 115, 22, 0.1);
  padding: 0.25rem 0.5rem;
  border-radius: 0.25rem;
  font-family: monospace;
  color: #fb923c;
}

.tiptap pre {
  background-color: rgba(249, 115, 22, 0.05);
  border: 1px solid rgba(249, 115, 22, 0.3);
  padding: 1rem;
  border-radius: 0.25rem;
  overflow-x: auto;
  margin-bottom: 1rem;
}

.tiptap pre code {
  background: none;
  padding: 0;
  color: #d1d5db;
}

.tiptap img {
  max-width: 100%;
  height: auto;
  border: 2px solid rgba(249, 115, 22, 0.3);
  margin: 1.5rem 0;
  display: block;
}

.tiptap blockquote {
  border-left: 4px solid #f97316;
  margin-left: 0;
  margin-bottom: 1rem;
  color: #d1d5db;
  font-style: italic;
  background-color: rgba(249, 115, 22, 0.05);
  padding: 1rem;
}

.tiptap iframe {
  margin: 1.5rem auto;
  display: block;
  border: 2px solid rgba(249, 115, 22, 0.3);
}

/* Text Alignment */
.tiptap [style*="text-align: left"] {
  text-align: left;
}

.tiptap [style*="text-align: center"] {
  text-align: center;
}

.tiptap [style*="text-align: right"] {
  text-align: right;
}

/* Scrollbar */
.tiptap-editor::-webkit-scrollbar {
  width: 8px;
}

.tiptap-editor::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.3);
}

.tiptap-editor::-webkit-scrollbar-thumb {
  background: rgba(249, 115, 22, 0.5);
  border-radius: 4px;
}

.tiptap-editor::-webkit-scrollbar-thumb:hover {
  background: rgba(249, 115, 22, 0.7);
}

/* Animation for the selection menu */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
  animation: fadeIn 0.2s ease-out forwards;
}

/* Floating Menu */
.fixed {
  position: fixed;
  transition: transform 0.2s ease;
}

/* Game Item Link Styles */
.tiptap .game-item-link {
  position: relative;
  color: #f59e0b;
  font-weight: 600;
  cursor: help;
  text-decoration: underline;
  text-decoration-style: dotted;
  text-decoration-color: #f59e0b;
  text-underline-offset: 3px;
  transition: all 0.2s ease;
  display: inline-block;
  padding: 0 2px;
}

.tiptap .game-item-link:hover {
  color: #fbbf24;
  text-decoration-color: #fbbf24;
  background-color: rgba(245, 158, 11, 0.1);
}

/* Custom Tooltip using JavaScript */
.game-item-tooltip-container {
  position: fixed;
  z-index: 10000;
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.game-item-tooltip-container.active {
  opacity: 1;
}

.game-item-tooltip-box {
  background: linear-gradient(135deg, rgba(17, 24, 39, 0.98) 0%, rgba(31, 41, 55, 0.98) 100%);
  border: 2px solid rgba(249, 115, 22, 0.6);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(249, 115, 22, 0.3);
  backdrop-filter: blur(10px);
  min-width: 300px;
  max-width: 360px;
  animation: tooltipSlideIn 0.3s ease;
}

@keyframes tooltipSlideIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.game-item-tooltip-image {
  width: 100%;
  height: 160px;
  object-fit: cover;
  border-bottom: 2px solid rgba(249, 115, 22, 0.3);
  background: linear-gradient(135deg, rgba(249, 115, 22, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
}

.game-item-tooltip-content {
  padding: 16px;
}

.game-item-tooltip-name {
  font-size: 18px;
  font-weight: 700;
  color: #fbbf24;
  margin-bottom: 8px;
  display: block;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.game-item-tooltip-description {
  font-size: 14px;
  color: #d1d5db;
  line-height: 1.6;
  display: block;
  margin-bottom: 8px;
}

.game-item-tooltip-rarity {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-top: 8px;
  color: white;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

/* Audio Upload Loading Indicator */
.audio-upload-loading {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  background: rgba(249, 115, 22, 0.1);
  border: 2px solid rgba(249, 115, 22, 0.3);
  border-radius: 8px;
  margin: 10px 0;
  color: #fb923c;
  font-family: monospace;
  font-size: 14px;
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.loading-spinner {
  width: 20px;
  height: 20px;
  border: 3px solid rgba(249, 115, 22, 0.3);
  border-top-color: #f97316;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.7; }
}
</style>
