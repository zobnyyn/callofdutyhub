<template>
  <Head>
    <title>{{ fullTitle }}</title>
    <meta name="description" :content="description" />
    <meta name="keywords" :content="keywords" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:title" :content="fullTitle" />
    <meta property="og:description" :content="description" />
    <meta property="og:image" :content="computedImage" v-if="computedImage" />
    <meta property="og:url" :content="computedUrl" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="fullTitle" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:image" :content="computedImage" v-if="computedImage" />

    <!-- Additional Meta -->
    <meta name="robots" :content="robots" />
    <meta name="author" content="COD Terminal" />
    <link rel="canonical" :href="computedUrl" />
  </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  keywords: {
    type: String,
    default: 'Call of Duty, COD, зомби, гайды, Wiki, мультиплеер, Warzone, Black Ops, Modern Warfare'
  },
  image: {
    type: String,
    default: null
  },
  url: {
    type: String,
    default: () => {
      try {
        // Принудительно использовать production домен для канонического URL
        const forcedOrigin = 'https://codterminal.ru';
        const path = window && window.location ? window.location.pathname + window.location.search : '/';
        return `${forcedOrigin}${path}`;
      } catch (e) {
        return 'https://codterminal.ru';
      }
    }
  },
  robots: {
    type: String,
    default: 'index, follow'
  }
});

const fullTitle = computed(() => `${props.title} | COD Terminal`);

const computedImage = computed(() => {
  if (props.image) {
    // если передали относительный путь — приводим к абсолютному
    return props.image.startsWith('http') ? props.image : props.image.startsWith('/') ? props.image : `/${props.image}`;
  }
  return '/images/og-default.webp';
});

const computedUrl = computed(() => {
  if (props.url) return props.url;
  try {
    const forcedOrigin = 'https://codterminal.ru';
    const path = window && window.location ? window.location.pathname + window.location.search : '/';
    return `${forcedOrigin}${path}`;
  } catch (e) {
    return 'https://codterminal.ru';
  }
});
</script>
