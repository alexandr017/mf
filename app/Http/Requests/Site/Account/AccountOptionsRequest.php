<?php

namespace App\Http\Requests\Site\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class AccountOptionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = auth()->user();
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255', 'unique:users,nickname,' . $user->id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'preferred_position' => ['nullable', 'string', 'in:defender,midfielder,forward'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // 5MB max
        ];

        // Валидация пароля только если он указан
        if ($this->filled('password')) {
            $rules['current_password'] = ['required', 'string'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Email должен быть корректным адресом электронной почты.',
            'email.unique' => 'Этот email уже используется.',
            'nickname.unique' => 'Этот никнейм уже занят.',
            'avatar.image' => 'Файл должен быть изображением.',
            'avatar.mimes' => 'Изображение должно быть в формате: jpeg, png, jpg, gif или webp.',
            'avatar.max' => 'Размер изображения не должен превышать 5MB.',
            'current_password.required' => 'Необходимо указать текущий пароль.',
            'password.required' => 'Поле "Новый пароль" обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать минимум 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}

