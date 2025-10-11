#!/bin/bash

# Создание директории для сертификатов
mkdir -p ./nginx/ssl

# Генерация самоподписанного SSL сертификата
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout ./nginx/ssl/nginx-selfsigned.key \
  -out ./nginx/ssl/nginx-selfsigned.crt \
  -subj "/C=RU/ST=Moscow/L=Moscow/O=CODTerminal/OU=Development/CN=localhost"

echo "SSL сертификат создан!"
echo "Ключ: ./nginx/ssl/nginx-selfsigned.key"
echo "Сертификат: ./nginx/ssl/nginx-selfsigned.crt"

