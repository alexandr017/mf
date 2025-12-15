<?php

namespace App\Helpers;

use App\Models\ActivityLogs\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogHelper
{
    /**
     * Логирование действия
     *
     * @param string $action Действие (create, update, delete, view, etc.)
     * @param Model|null $model Модель, с которой связано действие
     * @param string|null $description Описание действия
     * @param array|null $changes Изменения (для update)
     * @param int|null $userId ID пользователя (если null, берется из Auth)
     * @return ActivityLog
     */
    public static function log(
        string $action,
        ?Model $model = null,
        ?string $description = null,
        ?array $changes = null,
        ?int $userId = null
    ): ActivityLog {
        $userId = $userId ?? Auth::id();
        
        $modelType = $model ? get_class($model) : null;
        $modelId = $model ? $model->id : null;
        
        // Если описание не указано, генерируем автоматически
        if (!$description && $model) {
            $modelName = class_basename($model);
            $descriptions = [
                'create' => "Создан {$modelName} #{$modelId}",
                'update' => "Обновлен {$modelName} #{$modelId}",
                'delete' => "Удален {$modelName} #{$modelId}",
                'view' => "Просмотрен {$modelName} #{$modelId}",
            ];
            $description = $descriptions[$action] ?? "Действие {$action} с {$modelName} #{$modelId}";
        }
        
        return ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'changes' => $changes,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'description' => $description,
        ]);
    }

    /**
     * Логирование создания
     */
    public static function logCreate(Model $model, ?string $description = null, ?int $userId = null): ActivityLog
    {
        return self::log('create', $model, $description, null, $userId);
    }

    /**
     * Логирование обновления
     */
    public static function logUpdate(Model $model, array $changes, ?string $description = null, ?int $userId = null): ActivityLog
    {
        return self::log('update', $model, $description, $changes, $userId);
    }

    /**
     * Логирование удаления
     */
    public static function logDelete(Model $model, ?string $description = null, ?int $userId = null): ActivityLog
    {
        return self::log('delete', $model, $description, null, $userId);
    }

    /**
     * Логирование просмотра
     */
    public static function logView(Model $model, ?string $description = null, ?int $userId = null): ActivityLog
    {
        return self::log('view', $model, $description, null, $userId);
    }

    /**
     * Логирование кастомного действия
     */
    public static function logCustom(string $action, ?string $description = null, ?int $userId = null): ActivityLog
    {
        return self::log($action, null, $description, null, $userId);
    }
}

