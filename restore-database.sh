#!/bin/bash

# Скрипт для восстановления базы данных MySQL из бэкапа

# Настройки
BACKUP_DIR="./backups"
DB_CONTAINER="mysql_db"
DB_NAME="callofduty"
DB_USER="callofduty"
DB_PASSWORD="secret"

# Проверяем, передан ли файл бэкапа
if [ -z "$1" ]; then
    echo "Использование: $0 <файл_бэкапа>"
    echo ""
    echo "Доступные бэкапы:"
    ls -lh ${BACKUP_DIR}/*.sql 2>/dev/null
    exit 1
fi

BACKUP_FILE=$1

# Проверяем, существует ли файл
if [ ! -f "${BACKUP_FILE}" ]; then
    echo "Ошибка: файл ${BACKUP_FILE} не найден!"
    exit 1
fi

# Запрашиваем подтверждение
echo "ВНИМАНИЕ! Это действие перезапишет текущую базу данных ${DB_NAME}!"
echo "Файл бэкапа: ${BACKUP_FILE}"
read -p "Вы уверены? (yes/no): " CONFIRM

if [ "$CONFIRM" != "yes" ]; then
    echo "Отменено."
    exit 0
fi

# Восстанавливаем базу данных
echo "Восстановление базы данных ${DB_NAME} из ${BACKUP_FILE}..."
docker exec -i ${DB_CONTAINER} mysql -u${DB_USER} -p${DB_PASSWORD} ${DB_NAME} < ${BACKUP_FILE}

if [ $? -eq 0 ]; then
    echo "База данных успешно восстановлена!"
else
    echo "Ошибка при восстановлении базы данных!"
    exit 1
fi

