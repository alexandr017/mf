<?php

namespace App\Http\Requests\Admin\Tickets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TicketMessageRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'exists:tickets,id'],
            'user_id' => ['nullable', 'exists:users,id'], // Устанавливается автоматически в контроллере
            'message' => ['required'],
            'is_admin' => ['nullable', 'boolean'], // Устанавливается автоматически в контроллере
        ];
    }

    public function attributes(): array
    {
        return [
            'ticket_id' => 'Тикет',
            'user_id' => 'Пользователь',
            'message' => 'Сообщение',
            'is_admin' => 'От администратора',
        ];
    }
}

