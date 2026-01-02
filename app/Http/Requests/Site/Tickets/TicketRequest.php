<?php

namespace App\Http\Requests\Site\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'Пожалуйста, укажите тему тикета.',
            'subject.max' => 'Тема тикета не должна превышать 255 символов.',
            'priority.required' => 'Пожалуйста, выберите приоритет.',
            'priority.in' => 'Выбран неверный приоритет.',
            'message.required' => 'Пожалуйста, опишите вашу проблему или вопрос.',
            'message.min' => 'Сообщение должно содержать минимум 10 символов.',
            'message.max' => 'Сообщение не должно превышать 5000 символов.',
        ];
    }

    public function attributes(): array
    {
        return [
            'subject' => 'Тема',
            'priority' => 'Приоритет',
            'message' => 'Сообщение',
        ];
    }
}

