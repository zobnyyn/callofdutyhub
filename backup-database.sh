#!/bin/bash

# Скрипт для создания бэкапа базы данных MySQL

# Настройки
BACKUP_DIR="./backups"
DB_CONTAINER="mysql_db"
DB_NAME="callofduty"
DB_USER="callofduty"
DB_PASSWORD="secret"
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_FILE="${BACKUP_DIR}/${DB_NAME}_backup_${DATE}.sql"

# Создаем директорию для бэкапов, если её нет
mkdir -p ${BACKUP_DIR}

# Создаем бэкап
echo "Создание бэкапа базы данных ${DB_NAME}..."
docker exec ${DB_CONTAINER} mysqldump -u${DB_USER} -p${DB_PASSWORD} --no-tablespaces ${DB_NAME} > ${BACKUP_FILE}

if [ $? -eq 0 ]; then
    echo "Бэкап успешно создан: ${BACKUP_FILE}"
    # Показываем размер файла
    ls -lh ${BACKUP_FILE}

    # Опционально: удаляем бэкапы старше 30 дней
    echo "Удаление старых бэкапов (старше 30 дней)..."
    find ${BACKUP_DIR} -name "${DB_NAME}_backup_*.sql" -type f -mtime +30 -delete

    echo "Готово!"
else
    echo "Ошибка при создании бэкапа!"
    exit 1
fi

