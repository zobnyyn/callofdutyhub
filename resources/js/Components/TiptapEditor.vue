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

const props = defineProps({
  modelValue: {
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
      placeholder: 'Начните писать свой гайд здесь...\n\nВы можете вставлять изображения, видео, форматировать текст и многое другое!'
    }),
    HeadingWithId, // Добавляем расширение для заголовков с ID
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
  }, 100);
});

onBeforeUnmount(() => {
  document.removeEventListener('mouseup', handleMouseUp);
  document.removeEventListener('keyup', handleMouseUp);
  window.removeEventListener('scroll', handleScroll);
  window.removeEventListener('resize', handleScroll);
  if (editor.value) {
    editor.value.destroy();
  }
});

// Add image by URL
function addImage() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL изображения (или загрузите файл через кнопку Upload):');
  if (url) {
    editor.value.chain().focus().setImage({ src: url }).run();
  }
}

// Add GIF by URL
function addGif() {
  if (!editor.value) return;

  const url = window.prompt('Введите URL GIF изображения:');
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
</style>
