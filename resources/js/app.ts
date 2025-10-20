import './bootstrap';
import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import '../css/app.css';

createInertiaApp({
  resolve: (name): DefineComponent | Promise<DefineComponent> => {
    const pages = import.meta.glob<{ default: DefineComponent }>('./Pages/**/*.vue', { eager: true });

    // Пытаемся найти страницу в новой структуре с подпапками
    let page = pages[`./Pages/${name}.vue`];

    // Если не нашли, пробуем поискать в подпапках
    if (!page) {
      // Список возможных подпапок
      const folders = ['Wiki', 'Zombies', 'Auth', 'Profile', 'Chat', 'General', 'Admin', 'Articles', 'Warzone', 'ZombieGuides'];

      for (const folder of folders) {
        const possiblePath = `./Pages/${folder}/${name}.vue`;
        if (pages[possiblePath]) {
          page = pages[possiblePath];
          break;
        }
      }
    }

    if (!page) {
      throw new Error(`Page not found: ${name}`);
    }

    return page.default;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
});
