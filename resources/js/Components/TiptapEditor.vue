<template>
  <div class="tiptap-editor border-2 border-orange-500/30 bg-black">
    <!-- Toolbar -->
    <div v-if="editor" class="border-b-2 border-orange-500/30 bg-orange-500/5 p-3 flex flex-wrap gap-2">
      <!-- Text Formatting -->
      <div class="flex gap-1 border-r border-orange-500/20 pr-2">
        <button
          type="button"
          @click="editor.chain().focus().toggleBold().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('bold') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Bold (Ctrl+B)"
        >
          <strong>B</strong>
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleItalic().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('italic') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Italic (Ctrl+I)"
        >
          <em>I</em>
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleStrike().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('strike') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Strikethrough"
        >
          <s>S</s>
        </button>
      </div>

      <!-- Headings -->
      <div class="flex gap-1 border-r border-orange-500/20 pr-2">
        <button
          type="button"
          @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
          :class="{ 'bg-orange-500/30': editor.isActive('heading', { level: 2 }) }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Heading 2"
        >
          H2
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
          :class="{ 'bg-orange-500/30': editor.isActive('heading', { level: 3 }) }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Heading 3"
        >
          H3
        </button>
      </div>

      <!-- Lists -->
      <div class="flex gap-1 border-r border-orange-500/20 pr-2">
        <button
          type="button"
          @click="editor.chain().focus().toggleBulletList().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('bulletList') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Bullet List"
        >
          • List
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleOrderedList().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('orderedList') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Ordered List"
        >
          1. List
        </button>
      </div>

      <!-- Media -->
      <div class="flex gap-1 border-r border-orange-500/20 pr-2">
        <button
          type="button"
          @click="addImage"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Insert Image/GIF URL"
        >
          🖼️ Image
        </button>
        <button
          type="button"
          @click="addGif"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Insert GIF"
        >
          🎬 GIF
        </button>
        <button
          type="button"
          @click="addYouTube"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Insert YouTube"
        >
          ▶️ Video
        </button>
        <button
          type="button"
          @click="addLink"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Insert Link"
        >
          🔗 Link
        </button>
      </div>

      <!-- Alignment -->
      <div class="flex gap-1 border-r border-orange-500/20 pr-2">
        <button
          type="button"
          @click="editor.chain().focus().setTextAlign('left').run()"
          :class="{ 'bg-orange-500/30': editor.isActive({ textAlign: 'left' }) }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Align Left"
        >
          ⬅
        </button>
        <button
          type="button"
          @click="editor.chain().focus().setTextAlign('center').run()"
          :class="{ 'bg-orange-500/30': editor.isActive({ textAlign: 'center' }) }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Align Center"
        >
          ↔
        </button>
        <button
          type="button"
          @click="editor.chain().focus().setTextAlign('right').run()"
          :class="{ 'bg-orange-500/30': editor.isActive({ textAlign: 'right' }) }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Align Right"
        >
          ➡
        </button>
      </div>

      <!-- Other -->
      <div class="flex gap-1">
        <button
          type="button"
          @click="editor.chain().focus().toggleCodeBlock().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('codeBlock') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Code Block"
        >
          &lt;/&gt; Code
        </button>
        <button
          type="button"
          @click="editor.chain().focus().toggleBlockquote().run()"
          :class="{ 'bg-orange-500/30': editor.isActive('blockquote') }"
          class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors"
          title="Blockquote"
        >
          " Quote
        </button>
      </div>

      <!-- Upload Image File -->
      <div class="flex gap-1 ml-auto">
        <label class="px-3 py-1 border border-orange-500/30 hover:bg-orange-500/20 text-white font-mono text-sm transition-colors cursor-pointer">
          📁 Upload Image/GIF
          <input
            type="file"
            accept="image/*,image/gif"
            @change="handleImageUpload"
            class="hidden"
          />
        </label>
      </div>
    </div>

    <!-- Editor Content -->
    <div class="p-4 min-h-[400px] max-h-[600px] overflow-y-auto">
      <editor-content :editor="editor" />
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted, onBeforeUnmount } from 'vue';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Youtube from '@tiptap/extension-youtube';
import Link from '@tiptap/extension-link';
import TextAlign from '@tiptap/extension-text-align';
import Placeholder from '@tiptap/extension-placeholder';

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:modelValue']);

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
        class: 'text-orange-500 underline hover:text-orange-400'
      }
    }),
    TextAlign.configure({
      types: ['heading', 'paragraph']
    }),
    Placeholder.configure({
      placeholder: 'Начните писать свой гайд здесь...\n\nВы можете вставлять изображения, видео, форматировать текст и многое другое!'
    })
  ],
  editorProps: {
    attributes: {
      class: 'prose prose-invert prose-orange max-w-none focus:outline-none text-gray-300'
    }
  },
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML());
  }
});

watch(() => props.modelValue, (value) => {
  if (editor.value) {
    const isSame = editor.value.getHTML() === value;
    if (!isSame) {
      editor.value.commands.setContent(value, false);
    }
  }
});

onBeforeUnmount(() => {
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
</script>

<style>
/* Tiptap Editor Styles */
.tiptap {
  min-height: 400px;
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
  padding-left: 1rem;
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
</style>
