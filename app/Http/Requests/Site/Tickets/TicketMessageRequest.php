<?php

namespace App\Http\Requests\Site\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class TicketMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'min:5', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Пожалуйста, введите сообщение.',
            'message.min' => 'Сообщение должно содержать минимум 5 символов.',
            'message.max' => 'Сообщение не должно превышать 5000 символов.',
        ];
    }

    public function attributes(): array
    {
        return [
            'message' => 'Сообщение',
        ];
    }
}

