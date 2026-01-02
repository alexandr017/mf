# Система уведомлений

## Общая информация

Универсальная система уведомлений для отправки пользователям различных типов сообщений через сайт и Telegram (планируется).

---

## Структура базы данных

### Таблица `notifications`
Хранит массовые уведомления, созданные администраторами.

- `id` - ID уведомления
- `type` - Тип уведомления (mass, rating_increased, etc.)
- `title` - Заголовок
- `message` - Текст уведомления
- `data` - Дополнительные данные (JSON)
- `created_by_user_id` - Кто создал (для массовых)
- `is_mass` - Флаг массового уведомления
- `scheduled_at` - Запланированная отправка
- `created_at`, `updated_at`

### Таблица `user_notifications`
Хранит все уведомления пользователей (индивидуальные и из массовых).

- `id` - ID записи
- `user_id` - ID пользователя
- `notification_id` - ID массового уведомления (если есть)
- `type` - Тип уведомления
- `title` - Заголовок
- `message` - Текст
- `data` - Дополнительные данные (JSON)
- `is_read` - Прочитано ли
- `read_at` - Когда прочитано
- `sent_to_telegram` - Отправлено в Telegram
- `telegram_sent_at` - Когда отправлено в Telegram
- `created_at`, `updated_at`

### Поля в таблице `users`
- `telegram_chat_id` - ID чата в Telegram (nullable)
- `telegram_notifications_enabled` - Включены ли уведомления в Telegram (default: false)

---

## Типы уведомлений

Все типы определены в `NotificationService::TYPE_*`:

1. **`mass`** - Массовое уведомление от администратора
2. **`rating_increased`** - Повышение рейтинга
3. **`referral_success`** - Успешное привлечение реферала
4. **`game_reminder_24h`** - Напоминание о матче за 24 часа
5. **`game_reminder_1h`** - Напоминание о матче за 1 час
6. **`game_completed`** - Матч завершен
7. **`match_starting_soon`** - Матч скоро начнется
8. **`team_joined`** - Пользователь присоединился к команде
9. **`team_left`** - Пользователь покинул команду
10. **`achievement_earned`** - Получено достижение

---

## Триггеры отправки уведомлений

### 1. Массовое уведомление (`mass`)

**Триггер:** Администратор создает массовое уведомление в админ-панели

**Метод:** `NotificationService::sendMassNotification()`

**Описание:** Отправляется всем пользователям системы. Может быть запланировано на определенное время.

**Где используется:**
- Админ-панель: CRUD для массовых уведомлений

---

### 2. Повышение рейтинга (`rating_increased`)

**Триггер:** Рейтинг пользователя увеличивается

**Метод:** `NotificationService::notifyRatingIncreased()`

**Описание:** Отправляется пользователю при увеличении рейтинга. Указывается старое и новое значение рейтинга, а также причина повышения.

**Где используется:**
- При игре в мини-игры (тренировка пенальти, чеканка, прогноз матчей)
- При получении награды или достижения
- При обновлении статистики после матча

**Интеграция:**
```php
// Пример использования в контроллере игры
$oldRating = $user->rating;
$user->increment('rating', 0.001);
$newRating = $user->fresh()->rating;

if ($newRating > $oldRating) {
    app(NotificationService::class)->notifyRatingIncreased(
        $user,
        $oldRating,
        $newRating,
        'Тренировка пенальти'
    );
}
```

---

### 3. Успешное привлечение реферала (`referral_success`)

**Триггер:** Пользователь регистрируется по реферальной ссылке

**Метод:** `NotificationService::notifyReferralSuccess()`

**Описание:** Отправляется пользователю, который пригласил нового реферала.

**Где используется:**
- При регистрации нового пользователя через реферальную ссылку

**Интеграция:**
```php
// В контроллере регистрации
if ($referredBy) {
    $referredBy->increment('referrals_count');
    
    app(NotificationService::class)->notifyReferralSuccess(
        $referredBy,
        $user
    );
}
```

---

### 4. Напоминание о матче за 24 часа (`game_reminder_24h`)

**Триггер:** До начала матча остается 24 часа

**Метод:** `NotificationService::notifyGameReminder24h()`

**Описание:** Отправляется пользователям, состоящим в командах, которые участвуют в матче.

**Где используется:**
- Cron-задача `notifications:send-game-reminders` (запускается каждый час)

**Интеграция:**
```php
// В команде SendGameReminders
$matches24h = FriendlyMatch::whereBetween('date', [
    now()->addHours(24)->startOfHour(),
    now()->addHours(24)->endOfHour()
])->get();

foreach ($matches24h as $match) {
    // Получаем пользователей обеих команд
    $team1Users = UserTeam::where('team_id', $match->team_1)
        ->where('season', now()->year)
        ->with('user')
        ->get()
        ->pluck('user');
    
    $team2Users = UserTeam::where('team_id', $match->team_2)
        ->where('season', now()->year)
        ->with('user')
        ->get()
        ->pluck('user');
    
    $allUsers = $team1Users->merge($team2Users)->unique('id');
    
    foreach ($allUsers as $user) {
        app(NotificationService::class)->notifyGameReminder24h($user, $match, 'friendly');
    }
}
```

---

### 5. Напоминание о матче за 1 час (`game_reminder_1h`)

**Триггер:** До начала матча остается 1 час

**Метод:** `NotificationService::notifyGameReminder1h()`

**Описание:** Отправляется пользователям, состоящим в командах, которые участвуют в матче.

**Где используется:**
- Cron-задача `notifications:send-game-reminders` (запускается каждые 15 минут)

**Интеграция:**
```php
// В команде SendGameReminders
$matches1h = FriendlyMatch::whereBetween('date', [
    now()->addHour()->startOfMinute(),
    now()->addHour()->endOfMinute()
])->get();

// Аналогично предыдущему примеру
```

---

### 6. Матч завершен (`game_completed`)

**Триггер:** Матч обработан и имеет статус `played`

**Метод:** `NotificationService::notifyGameCompleted()`

**Описание:** Отправляется пользователям, состоящим в командах, которые участвовали в матче. Содержит результат матча.

**Где используется:**
- В команде `ProcessFriendlyMatches` после обработки матча
- При обновлении результата матча администратором

**Интеграция:**
```php
// В ProcessFriendlyMatches после обработки матча
$match->update(['status' => 'played']);

// Получаем пользователей обеих команд
$team1Users = UserTeam::where('team_id', $match->team_1)
    ->where('season', now()->year)
    ->with('user')
    ->get()
    ->pluck('user');

$team2Users = UserTeam::where('team_id', $match->team_2)
    ->where('season', now()->year)
    ->with('user')
    ->get()
    ->pluck('user');

$allUsers = $team1Users->merge($team2Users)->unique('id');

foreach ($allUsers as $user) {
    app(NotificationService::class)->notifyGameCompleted($user, $match, 'friendly');
}
```

---

### 7. Присоединение к команде (`team_joined`)

**Триггер:** Пользователь успешно присоединился к команде

**Метод:** `NotificationService::sendNotification()` с типом `TYPE_TEAM_JOINED`

**Описание:** Отправляется пользователю при успешном присоединении к команде.

**Где используется:**
- В `TeamTransferService::joinTeam()`

**Интеграция:**
```php
// В TeamTransferService::joinTeam() после успешного присоединения
app(NotificationService::class)->sendNotification(
    $user,
    NotificationService::TYPE_TEAM_JOINED,
    'Присоединение к команде',
    "Вы успешно присоединились к команде {$team->name}",
    ['team_id' => $team->id, 'team_name' => $team->name]
);
```

---

### 8. Покидание команды (`team_left`)

**Триггер:** Пользователь успешно покинул команду

**Метод:** `NotificationService::sendNotification()` с типом `TYPE_TEAM_LEFT`

**Описание:** Отправляется пользователю при успешном выходе из команды.

**Где используется:**
- В `TeamTransferService::leaveTeam()`

---

### 9. Получено достижение (`achievement_earned`)

**Триггер:** Пользователь получает новое достижение

**Метод:** `NotificationService::sendNotification()` с типом `TYPE_ACHIEVEMENT_EARNED`

**Описание:** Отправляется пользователю при получении достижения.

**Где используется:**
- При присвоении достижения пользователю

---

## Фоновые задачи (Cron)

Все фоновые задачи находятся в `routes/console.php`:

### 1. `notifications:send-game-reminders`

**Расписание:** Каждые 15 минут

**Описание:** Проверяет предстоящие матчи и отправляет напоминания за 24 часа и за 1 час до начала.

**Команда:** `app/Console/Commands/SendGameReminders.php`

---

### 2. `notifications:process-scheduled`

**Расписание:** Каждые 5 минут

**Описание:** Обрабатывает запланированные массовые уведомления.

**Команда:** `app/Console/Commands/ProcessScheduledNotifications.php`

---

### 3. `friendly-matches:process`

**Расписание:** Ежедневно в 00:00

**Описание:** Обрабатывает товарищеские матчи на текущий день. После обработки отправляет уведомления о завершении матчей.

**Команда:** `app/Console/Commands/ProcessFriendlyMatches.php`

---

## Интеграция Telegram (планируется)

Интеграция с Telegram будет реализована позже. Структура готова:

- Поле `telegram_chat_id` в таблице `users`
- Поле `telegram_notifications_enabled` в таблице `users`
- Поля `sent_to_telegram` и `telegram_sent_at` в таблице `user_notifications`
- Метод `NotificationService::sendToTelegram()` (заглушка)

При реализации необходимо:
1. Создать Telegram бота
2. Реализовать метод `sendToTelegram()` в `NotificationService`
3. Добавить настройку Telegram в профиль пользователя
4. Реализовать команду для привязки Telegram аккаунта

---

## API для клиента

### Получение списка уведомлений

**GET** `/account/notifications`

Возвращает список уведомлений пользователя с пагинацией.

### Получение количества непрочитанных

**GET** `/account/notifications/unread-count`

Возвращает количество непрочитанных уведомлений.

### Отметить как прочитанное

**POST** `/account/notifications/{id}/read`

Отмечает уведомление как прочитанное.

### Отметить все как прочитанные

**POST** `/account/notifications/mark-all-read`

Отмечает все уведомления пользователя как прочитанные.

---

## Админ-панель

### CRUD для массовых уведомлений

- **Список:** `/admin/notifications`
- **Создание:** `/admin/notifications/create`
- **Редактирование:** `/admin/notifications/{id}/edit`
- **Просмотр:** `/admin/notifications/{id}`
- **Удаление:** через форму на странице редактирования

---

## Использование NotificationService

### Базовое использование

```php
use App\Services\NotificationService;

$notificationService = app(NotificationService::class);

// Отправить простое уведомление
$notificationService->sendNotification(
    $user,
    NotificationService::TYPE_RATING_INCREASED,
    'Повышение рейтинга',
    'Ваш рейтинг увеличился на 0.5',
    ['old_rating' => 10.0, 'new_rating' => 10.5]
);
```

### Использование готовых методов

```php
// Повышение рейтинга
$notificationService->notifyRatingIncreased($user, 10.0, 10.5, 'Тренировка пенальти');

// Реферал
$notificationService->notifyReferralSuccess($user, $referral);

// Напоминание о матче
$notificationService->notifyGameReminder24h($user, $match, 'friendly');
$notificationService->notifyGameReminder1h($user, $match, 'friendly');
$notificationService->notifyGameCompleted($user, $match, 'friendly');
```

### Массовое уведомление

```php
$notificationService->sendMassNotification(
    'Важное объявление',
    'Текст объявления для всех пользователей',
    ['link' => '/some-page'],
    auth()->user(), // Кто создал
    now()->addHours(2) // Запланировать на 2 часа вперед (опционально)
);
```

---

## Визуальное отображение

### Выпадающее меню в шапке

В шапке сайта (header) добавлено выпадающее меню уведомлений:
- Иконка колокольчика с счетчиком непрочитанных
- Список последних уведомлений
- Кнопка "Показать все"
- Автообновление через AJAX каждые 30 секунд

---

## Производительность

Для оптимизации производительности:
- Используется batch processing для массовых уведомлений
- Непрочитанные уведомления кешируются
- Индексы на важных полях (`user_id`, `is_read`, `type`, `created_at`)

