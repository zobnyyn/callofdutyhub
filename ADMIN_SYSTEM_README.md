# Система прав администратора

## 📋 Что было реализовано

Теперь доступ к админ-панели `/admin/*` ограничен только для пользователей с правами администратора.

## 🔐 Как это работает

1. **Поле `is_admin`** добавлено в таблицу `users` (по умолчанию `false`)
2. **Middleware `IsAdmin`** проверяет права доступа перед входом в админ-панель
3. Все маршруты `/admin/*` защищены двумя middleware:
   - `auth` - проверка авторизации
   - `admin` - проверка прав администратора

## 🚀 Как назначить права администратора

### Способ 1: Через Artisan команду (рекомендуется)

```bash
# Назначить пользователя администратором по email
docker-compose exec app php artisan user:make-admin email@example.com

# Снять права администратора
docker-compose exec app php artisan user:remove-admin email@example.com

# Посмотреть список всех администраторов
docker-compose exec app php artisan user:list-admins
```

### Способ 2: Через Tinker

```bash
docker-compose exec app php artisan tinker

# В Tinker выполните:
$user = User::where('email', 'email@example.com')->first();
$user->is_admin = true;
$user->save();
```

### Способ 3: Напрямую в базе данных

```bash
docker-compose exec db mysql -u callofduty -psecret callofduty

# В MySQL выполните:
UPDATE users SET is_admin = 1 WHERE email = 'email@example.com';
```

## 📝 Примеры использования

### Назначить себя администратором

Если вы зарегистрированы с email `your@email.com`:

```bash
docker-compose exec app php artisan user:make-admin your@email.com
```

Вывод:
```
Пользователь YourName (your@email.com) теперь администратор!
```

### Посмотреть всех администраторов

```bash
docker-compose exec app php artisan user:list-admins
```

Вывод:
```
Список администраторов:

+----+-----------+------------------+---------------------+
| ID | Имя       | Email            | Дата регистрации    |
+----+-----------+------------------+---------------------+
| 1  | Admin     | admin@admin.com  | 07.10.2025 12:00    |
| 5  | Moderator | mod@site.com     | 07.10.2025 13:30    |
+----+-----------+------------------+---------------------+
```

## 🛡️ Что защищено

Все админ-маршруты теперь защищены:
- `/admin/guides` - список гайдов
- `/admin/guides/create` - создание гайда
- `/admin/guides/{id}/edit` - редактирование гайда
- Любые другие будущие админ-маршруты

## ⚠️ Важно

1. **Обычные пользователи** больше не могут попасть в админ-панель
2. При попытке доступа получат ошибку **403 Forbidden**
3. Если пользователь не авторизован, его перенаправит на страницу входа
4. Права администратора можно снять командой `user:remove-admin`

## 🔧 Технические детали

### Файлы, которые были изменены/созданы:

1. **Миграция**: `database/migrations/2025_10_07_010058_add_is_admin_to_users_table.php`
2. **Модель User**: добавлено поле `is_admin` и метод `isAdmin()`
3. **Middleware**: `app/Http/Middleware/IsAdmin.php`
4. **Маршруты**: обновлен `routes/web.php`
5. **Команды**:
   - `app/Console/Commands/MakeUserAdmin.php`
   - `app/Console/Commands/RemoveUserAdmin.php`
   - `app/Console/Commands/ListAdmins.php`

### Проверка в коде

```php
// Проверить, является ли текущий пользователь администратором
if (auth()->user()->isAdmin()) {
    // Код для администратора
}
```

## 🎯 Быстрый старт

1. Убедитесь, что миграция применена:
   ```bash
   docker-compose exec app php artisan migrate
   ```

2. Назначьте себя администратором:
   ```bash
   docker-compose exec app php artisan user:make-admin your@email.com
   ```

3. Войдите в систему и попробуйте зайти в админ-панель
   - Обычные пользователи получат ошибку 403
   - Администраторы получат доступ ко всем функциям

Готово! 🚀

