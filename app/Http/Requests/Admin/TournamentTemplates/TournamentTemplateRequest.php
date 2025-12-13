<?php

namespace App\Http\Requests\Admin\TournamentTemplates;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TournamentTemplateRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:255'],
            'type' => ['required', 'in:league,cup,supercup,mixed'],
            'description' => ['nullable'],
            'structure_json' => ['required'],
            'config_json' => ['required'],
            'is_default' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // Валидация JSON перед валидацией правил
        if ($this->has('structure_json') && is_string($this->structure_json)) {
            $decoded = json_decode($this->structure_json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->merge(['structure_json' => null]);
            }
        }
        if ($this->has('config_json') && is_string($this->config_json)) {
            $decoded = json_decode($this->config_json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->merge(['config_json' => null]);
            }
        }
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'type' => 'Тип',
            'description' => 'Описание',
            'structure_json' => 'Структура (JSON)',
            'config_json' => 'Конфигурация (JSON)',
            'is_default' => 'По умолчанию',
        ];
    }
}

