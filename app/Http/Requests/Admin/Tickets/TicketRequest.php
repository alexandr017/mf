<?php

namespace App\Http\Requests\Admin\Tickets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TicketRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => ['required', 'max:255'],
            'status' => ['required', 'in:open,in_progress,closed,resolved'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'created_by_user_id' => ['nullable', 'exists:users,id'],
            'assigned_to_user_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'subject' => 'Тема',
            'status' => 'Статус',
            'priority' => 'Приоритет',
            'created_by_user_id' => 'Создатель',
            'assigned_to_user_id' => 'Назначен',
        ];
    }
}



