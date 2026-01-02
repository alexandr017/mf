<?php

namespace App\Http\Requests\Admin\Notifications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class NotificationRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'scheduled_at' => ['nullable', 'date', 'after_or_equal:now'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Заголовок',
            'message' => 'Сообщение',
            'scheduled_at' => 'Запланированная отправка',
        ];
    }
}

