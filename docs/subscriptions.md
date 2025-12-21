# Структура премиум подписок

## Обзор

Система премиум подписок позволяет пользователям ускорить прокачку рейтинга в мини-играх. Подписки имеют разные уровни с различными множителями прокачки.

## Таблицы базы данных

### `subscription_plans`

Таблица планов подписки.

**Поля:**
- `id` - ID плана
- `name` - Название плана (Базовый, Продвинутый)
- `slug` - Уникальный идентификатор (basic, advanced)
- `description` - Описание плана
- `price` - Цена в долларах (decimal 8,2)
- `currency` - Валюта (по умолчанию USD)
- `rating_multiplier` - Множитель прокачки рейтинга (1.5, 2.0)
- `duration_days` - Длительность подписки в днях (по умолчанию 30)
- `is_active` - Активен ли план
- `sort_order` - Порядок сортировки
- `created_at`, `updated_at` - Временные метки

### `user_subscriptions`

Таблица подписок пользователей.

**Поля:**
- `id` - ID подписки
- `user_id` - ID пользователя (FK на users)
- `subscription_plan_id` - ID плана подписки (FK на subscription_plans)
- `starts_at` - Дата начала подписки
- `ends_at` - Дата окончания подписки
- `cancelled_at` - Дата отмены подписки (nullable)
- `status` - Статус подписки (active, expired, cancelled)
- `payment_method` - Метод оплаты (stripe, paypal и т.д.)
- `payment_transaction_id` - ID транзакции оплаты
- `auto_renew` - Автоматическое продление (boolean)
- `created_at`, `updated_at` - Временные метки

**Индексы:**
- `user_id`, `status`
- `ends_at`

## Модели

### `App\Models\Subscriptions\SubscriptionPlan`

Модель плана подписки.

**Методы:**
- `userSubscriptions()` - Все подписки на этот план
- `activeSubscriptions()` - Активные подписки на этот план

### `App\Models\Subscriptions\UserSubscription`

Модель подписки пользователя.

**Методы:**
- `user()` - Пользователь
- `plan()` - План подписки
- `isActive()` - Проверка, активна ли подписка
- `isExpired()` - Проверка, истекла ли подписка
- `cancel()` - Отмена подписки

### `App\Models\User`

Добавлены методы для работы с подписками:

**Методы:**
- `subscriptions()` - Все подписки пользователя
- `activeSubscription()` - Активная подписка пользователя
- `hasActiveSubscription()` - Проверка наличия активной подписки
- `getRatingMultiplier()` - Получить множитель прокачки рейтинга

## Хелпер

### `App\Helpers\SubscriptionHelper`

Класс-хелпер для работы с подписками.

**Методы:**
- `createSubscription(User $user, SubscriptionPlan $plan, array $paymentData)` - Создать подписку
- `renewSubscription(UserSubscription $subscription)` - Продлить подписку
- `cancelSubscription(UserSubscription $subscription)` - Отменить подписку
- `updateExpiredSubscriptions()` - Обновить статусы истекших подписок
- `getRatingMultiplier(User $user)` - Получить множитель рейтинга
- `applyRatingMultiplier(User $user, float $basePoints)` - Применить множитель к очкам

## Сидер

### `Database\Seeders\SubscriptionPlansSeeder`

Создает два плана подписки:
1. **Базовый** - $2.5/мес, множитель 1.5x
2. **Продвинутый** - $4/мес, множитель 2.0x

## Использование

### Создание подписки

```php
use App\Helpers\SubscriptionHelper;
use App\Models\Subscriptions\SubscriptionPlan;

$user = auth()->user();
$plan = SubscriptionPlan::where('slug', 'basic')->first();

$subscription = SubscriptionHelper::createSubscription($user, $plan, [
    'payment_method' => 'stripe',
    'transaction_id' => 'txn_123456',
    'auto_renew' => true,
]);
```

### Проверка активной подписки

```php
$user = auth()->user();

if ($user->hasActiveSubscription()) {
    $subscription = $user->activeSubscription;
    $multiplier = $user->getRatingMultiplier();
    // Использовать множитель для прокачки рейтинга
}
```

### Применение множителя к очкам рейтинга

```php
use App\Helpers\SubscriptionHelper;

$user = auth()->user();
$basePoints = 10.0; // Базовые очки за мини-игру

$finalPoints = SubscriptionHelper::applyRatingMultiplier($user, $basePoints);
// Если у пользователя активная подписка с множителем 1.5, получим 15.0
```

### Отмена подписки

```php
$subscription = $user->activeSubscription;
SubscriptionHelper::cancelSubscription($subscription);
```

## Автоматическое обновление статусов

Рекомендуется создать задачу (cron job) для автоматического обновления статусов истекших подписок:

```php
// В App\Console\Kernel.php или через планировщик задач
SubscriptionHelper::updateExpiredSubscriptions();
```

## Интеграция с платежными системами

Для интеграции с платежными системами (Stripe, PayPal и т.д.) необходимо:

1. Обработать webhook от платежной системы
2. Создать подписку через `SubscriptionHelper::createSubscription()`
3. Сохранить `payment_transaction_id` и `payment_method`
4. Настроить автоматическое продление (если поддерживается)

## Примеры запросов

### Получить все активные подписки

```php
$activeSubscriptions = UserSubscription::where('status', 'active')
    ->where('ends_at', '>', now())
    ->whereNull('cancelled_at')
    ->with(['user', 'plan'])
    ->get();
```

### Получить статистику по подпискам

```php
$totalSubscriptions = UserSubscription::count();
$activeSubscriptions = UserSubscription::where('status', 'active')
    ->where('ends_at', '>', now())
    ->count();
$expiredSubscriptions = UserSubscription::where('status', 'expired')->count();
```

