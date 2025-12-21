<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class UserRequest extends FormRequest
{
    use AdminRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user') ?? $this->route('id') ?? null;

        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . ($userId ?? 'NULL')],
            'preferred_position' => ['nullable', 'string', 'in:defender,midfielder,forward'],
            'goals' => ['nullable', 'integer', 'min:0'],
            'assists' => ['nullable', 'integer', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'referral_code' => ['nullable', 'max:255', 'unique:users,referral_code,' . ($userId ?? 'NULL')],
            'referred_by_id' => ['nullable', 'exists:users,id'],
            'referrals_count' => ['nullable', 'integer', 'min:0'],
        ];

        if ($userId) {
            // При редактировании пароль опционален
            $rules['password'] = ['nullable', 'min:8'];
            if ($this->filled('password')) {
                $rules['password_confirmation'] = ['required', 'same:password'];
            }
        } else {
            // При создании пароль обязателен
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'preferred_position' => 'Предпочитаемая позиция',
            'goals' => 'Голы',
            'assists' => 'Голевые передачи',
            'rating' => 'Рейтинг',
            'referral_code' => 'Реферальный код',
            'referred_by_id' => 'Приглашен пользователем',
            'referrals_count' => 'Количество рефералов',
        ];
    }
}

