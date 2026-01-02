# Настройка Redis для Laravel (опционально)

## Проблема

Если вы видите ошибку `Class "Redis" not found`, это означает, что PHP расширение Redis не установлено.

## Важно

**Redis НЕ обязателен для работы системы live матчей!**

Система автоматически использует file cache как fallback, если Redis недоступен. Все будет работать, просто немного медленнее при высокой нагрузке.

## Установка Redis (опционально, для продакшена)

### Для macOS (Homebrew)

```bash
# Установка Redis сервера
brew install redis

# Запуск Redis
brew services start redis

# Установка PHP расширения Redis
pecl install redis

# Добавьте в php.ini
extension=redis.so
```

### Для Ubuntu/Debian

```bash
# Установка Redis сервера
sudo apt-get update
sudo apt-get install redis-server

# Запуск Redis
sudo systemctl start redis-server
sudo systemctl enable redis-server

# Установка PHP расширения Redis
sudo apt-get install php-redis

# Перезапуск PHP-FPM
sudo systemctl restart php8.2-fpm  # или ваша версия PHP
```

### Для Windows

1. Скачайте Redis для Windows: https://github.com/microsoftarchive/redis/releases
2. Установите PHP расширение через PECL или скачайте готовый DLL
3. Добавьте в `php.ini`: `extension=redis.dll`

## Настройка Laravel

### 1. Установите пакет (если еще не установлен)

```bash
composer require predis/predis
```

Или используйте встроенный phpredis (если установлено расширение).

### 2. Настройте .env

```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Или для работы без Redis:

```env
CACHE_DRIVER=file
```

### 3. Проверка работы

```bash
php artisan tinker
```

```php
Cache::put('test', 'value', 60);
Cache::get('test'); // должно вернуть 'value'
```

## Текущая реализация

Система live матчей использует `Cache` фасад Laravel, который автоматически:

1. **С Redis**: Использует Redis для быстрого кеширования
2. **Без Redis**: Автоматически переключается на file cache

Никаких изменений в коде не требуется!

## Рекомендации

- **Для разработки**: Можно работать без Redis, используя file cache
- **Для продакшена**: Рекомендуется установить Redis для лучшей производительности при высокой нагрузке (1000+ одновременных просмотров)

## Проверка установки Redis

```bash
# Проверка Redis сервера
redis-cli ping
# Должно вернуть: PONG

# Проверка PHP расширения
php -m | grep redis
# Должно показать: redis
```

## Устранение проблем

### Ошибка "Class Redis not found"

**Решение**: Система автоматически использует file cache. Redis не обязателен.

Если хотите использовать Redis:
1. Установите PHP расширение Redis (см. выше)
2. Установите Redis сервер
3. Настройте `.env` файл

### Redis не подключается

Проверьте:
1. Redis сервер запущен: `redis-cli ping`
2. Правильные настройки в `.env`
3. Порт 6379 не занят другим приложением

## Альтернатива: Использование только file cache

Если не хотите устанавливать Redis, просто используйте:

```env
CACHE_DRIVER=file
```

Все будет работать, просто кеш будет храниться в файлах вместо памяти.


