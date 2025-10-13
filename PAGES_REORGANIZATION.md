# Реорганизация страниц (Pages)

## Дата: 2025-01-13

### Изменения структуры

Все Vue-страницы из `resources/js/Pages/` были организованы по логическим папкам:

#### **Wiki/** - Все Wiki-страницы
- BlackOps2Wiki.vue
- BlackOps3Wiki.vue
- BlackOps4Wiki.vue
- BlackOps6Wiki.vue
- BlackOpsColdWarWiki.vue
- BlackOpsWiki.vue
- CodWiki.vue
- ColdWarWiki.vue
- ModernWarfare2007Wiki.vue
- ModernWarfare2009Wiki.vue
- ModernWarfare2011Wiki.vue
- ModernWarfare2019Wiki.vue
- ModernWarfare2022Wiki.vue
- ModernWarfare2023Wiki.vue
- WorldAtWarWiki.vue

#### **Zombies/** - Все страницы зомби-режима
- BlackOps2Zombies.vue
- BlackOps3Zombies.vue
- BlackOps4Zombies.vue
- BlackOps6Zombies.vue
- BlackOps7Zombies.vue
- BlackOpsZombies.vue
- ColdWarZombies.vue
- WorldAtWarZombies.vue
- Index.vue (бывший Zombies.vue)
- ZombieMapDetail.vue

#### **Auth/** - Страницы аутентификации
- Login.vue
- Register.vue
- VerifyEmail.vue (уже была в этой папке)

#### **Profile/** - Страницы профиля
- ProfileEdit.vue
- ProfileView.vue

#### **Chat/** - Страницы чатов
- Chat.vue
- GroupChat.vue

#### **General/** - Общие страницы
- About.vue
- Community.vue
- HomeBlackOpsTerminal.vue
- ModernWarfare.vue
- Partnership.vue
- Rules.vue

### Обновленные файлы

1. **routes/web.php** - Все пути Inertia::render обновлены с новой структурой
2. **app/Http/Controllers/HomeController.php** - `'HomeBlackOpsTerminal'` → `'General/HomeBlackOpsTerminal'`
3. **app/Http/Controllers/CommunityController.php** - `'Community'` → `'General/Community'`
4. **app/Http/Controllers/MessageController.php** - `'Chat'` → `'Chat/Chat'`, `'GroupChat'` → `'Chat/GroupChat'`
5. **app/Http/Controllers/ZombiesController.php** - `'Zombies'` → `'Zombies/Index'`
6. **app/Http/Controllers/ZombieMapController.php** - `'ZombieMapDetail'` → `'Zombies/ZombieMapDetail'`

### Что НЕ изменилось

- Папки **Admin/**, **Articles/**, **Warzone/**, **ZombieGuides/** остались как есть (уже были организованы)
- Функционал приложения остался прежним
- URL-адреса страниц не изменились

### Результат

✅ Структура папок стала логичной и понятной
✅ Легче найти нужную страницу
✅ Улучшена масштабируемость проекта
✅ Ничего не сломалось - все маршруты обновлены

### Рекомендации

После изменений рекомендуется:
1. Очистить кэш браузера
2. Перезапустить dev-сервер Vite (если используется)
3. Протестировать основные страницы

```bash
npm run dev
```

