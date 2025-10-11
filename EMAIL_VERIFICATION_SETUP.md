# Настройка Email-верификации для Call of Duty Terminal

## ✅ Что уже сделано:

1. **Модель User** - добавлен интерфейс `MustVerifyEmail`
2. **AuthController** - обновлен метод `register()` для отправки письма с верификацией
3. **Маршруты** - добавлены роуты для верификации email:
   - `/email/verify` - страница с уведомлением
   - `/email/verify/{id}/{hash}` - ссылка для подтверждения из письма
   - `/email/verification-notification` - повторная отправка письма
4. **Vue-компонент** - создан `Auth/VerifyEmail.vue` для страницы подтверждения

## 📧 Настройка почтового сервера

Сейчас письма записываются только в лог (`storage/logs/laravel.log`). Для реальной отправки нужно настроить SMTP.

### Вариант 1: Gmail SMTP (бесплатно)

1. Включите "2-Step Verification" в настройках Google аккаунта
2. Создайте "App Password" (пароль приложения)
3. Обновите `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="COD Terminal"
```

### Вариант 2: Яндекс.Почта (бесплатно)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.yandex.ru
MAIL_PORT=465
MAIL_USERNAME=your-email@yandex.ru
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=your-email@yandex.ru
MAIL_FROM_NAME="COD Terminal"
```

### Вариант 3: Mail.ru (бесплатно)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.ru
MAIL_PORT=465
MAIL_USERNAME=your-email@mail.ru
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=your-email@mail.ru
MAIL_FROM_NAME="COD Terminal"
```

### Вариант 4: Mailtrap (для тестирования)

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@codterminal.local
MAIL_FROM_NAME="COD Terminal"
```

## 🚀 Как это работает:

1. **Пользователь регистрируется** → получает письмо с ссылкой подтверждения
2. **Переходит по ссылке** → email подтверждается
3. **До подтверждения email** → пользователь может войти, но некоторые функции могут быть ограничены

## 🔒 Защита роутов (опционально)

Чтобы требовать подтвержденный email для доступа к определенным страницам, добавьте middleware `verified`:

```php
Route::get('/community', [CommunityController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('community');
```

## 🛠 После настройки почты:

1. Обновите `.env` с данными вашего SMTP
2. Перезапустите контейнеры:
   ```bash
   docker-compose restart app
   ```
3. Очистите кеш:
   ```bash
   docker-compose exec app php artisan config:clear
   docker-compose exec app php artisan cache:clear
   ```
4. Попробуйте зарегистрировать тестового пользователя

## 📝 Тестирование в логах (текущая настройка)

Сейчас письма записываются в `storage/logs/laravel.log`. Вы можете проверить содержимое письма там:

```bash
docker-compose exec app tail -f storage/logs/laravel.log
```

После регистрации пользователя там появится HTML письма с ссылкой для подтверждения.

## 💡 Рекомендация:

Для локальной разработки используйте **Mailtrap.io** (бесплатно) - это специальный сервис для тестирования email без реальной отправки. Зарегистрируйтесь на https://mailtrap.io и получите SMTP credentials.

