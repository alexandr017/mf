# Настройка авторизации через соцсети

## Установленные пакеты

- ✅ Laravel Breeze (для авторизации по почте)
- ✅ Laravel Socialite (базовый пакет для OAuth)
- ⚠️ Требуется установка: `socialiteproviders/vk`, `socialiteproviders/yandex`, `socialiteproviders/odnoklassniki`

## Команды для установки дополнительных пакетов

```bash
composer require socialiteproviders/vk
composer require socialiteproviders/yandex
composer require socialiteproviders/odnoklassniki
```

После установки выполните:
```bash
php artisan vendor:publish --provider="SocialiteProviders\Manager\ServiceProvider"
```

## Настройка .env файла

Добавьте следующие переменные в ваш `.env` файл:

```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback

# VK OAuth
VK_CLIENT_ID=your_vk_app_id
VK_CLIENT_SECRET=your_vk_secure_key
VK_REDIRECT_URI=http://localhost:8000/auth/vk/callback

# Yandex OAuth
YANDEX_CLIENT_ID=your_yandex_client_id
YANDEX_CLIENT_SECRET=your_yandex_client_secret
YANDEX_REDIRECT_URI=http://localhost:8000/auth/yandex/callback

# Odnoklassniki OAuth
ODNOKLASSNIKI_CLIENT_ID=your_ok_app_id
ODNOKLASSNIKI_CLIENT_SECRET=your_ok_secret_key
ODNOKLASSNIKI_PUBLIC_KEY=your_ok_public_key
ODNOKLASSNIKI_REDIRECT_URI=http://localhost:8000/auth/odnoklassniki/callback
```

## Запуск миграций

```bash
php artisan migrate
```

Это создаст таблицу `social_accounts` для хранения связей пользователей с соцсетями.

## Настройка приложений в соцсетях

### Google
1. Перейдите на https://console.cloud.google.com/
2. Создайте новый проект или выберите существующий
3. Включите Google+ API
4. Создайте OAuth 2.0 Client ID
5. Добавьте авторизованные URI перенаправления: `http://localhost:8000/auth/google/callback` (для продакшена замените на ваш домен)

### Facebook
1. Перейдите на https://developers.facebook.com/
2. Создайте новое приложение
3. Добавьте продукт "Facebook Login"
4. В настройках добавьте Valid OAuth Redirect URIs: `http://localhost:8000/auth/facebook/callback`

### VK
1. Перейдите на https://vk.com/apps?act=manage
2. Создайте новое приложение (тип: Веб-сайт)
3. В настройках добавьте адрес сайта и адрес для callback: `http://localhost:8000/auth/vk/callback`

### Yandex
1. Перейдите на https://oauth.yandex.ru/
2. Создайте новое приложение
3. Добавьте Callback URI: `http://localhost:8000/auth/yandex/callback`

### Odnoklassniki
1. Перейдите на https://ok.ru/devaccess
2. Создайте новое приложение
3. В настройках добавьте Redirect URI: `http://localhost:8000/auth/odnoklassniki/callback`

## Маршруты

Авторизация через соцсети доступна по следующим маршрутам:
- `/auth/google` - редирект на Google
- `/auth/facebook` - редирект на Facebook
- `/auth/vk` - редирект на VK
- `/auth/yandex` - редирект на Yandex
- `/auth/odnoklassniki` - редирект на Odnoklassniki

Callback маршруты:
- `/auth/google/callback`
- `/auth/facebook/callback`
- `/auth/vk/callback`
- `/auth/yandex/callback`
- `/auth/odnoklassniki/callback`

## Что было создано

1. ✅ Миграция `create_social_accounts_table` - таблица для хранения связей с соцсетями
2. ✅ Модель `SocialAccount` - модель для работы с аккаунтами соцсетей
3. ✅ Контроллер `SocialAuthController` - обработка OAuth авторизации
4. ✅ Маршруты в `routes/auth.php` - маршруты для OAuth
5. ✅ Обновлены формы авторизации - добавлены кнопки соцсетей
6. ✅ Настроен `config/services.php` - конфигурация провайдеров
7. ✅ Добавлена связь `socialAccounts()` в модель `User`

## Примечания

- При первом входе через соцсеть создается новый пользователь, если его нет в системе
- Если пользователь уже авторизован, аккаунт соцсети привязывается к текущему аккаунту
- Email автоматически подтверждается при входе через соцсеть
- Пароль генерируется случайным образом для пользователей, зарегистрированных через соцсети

