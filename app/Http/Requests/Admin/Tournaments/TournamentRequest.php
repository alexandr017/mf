<?php

namespace App\Http\Requests\Admin\Tournaments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TournamentRequest extends FormRequest
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
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'title' => ['nullable', 'max:255'],
            'h1' => ['nullable', 'max:255'],
            'alias' => ['nullable', 'max:255'],
            'meta_description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'max:255'],
            'type' => ['required', 'in:league,cup,supercup,mixed'],
            'tournament_template_id' => ['nullable', 'exists:tournament_templates,id'],
            'color' => ['nullable', 'string', 'max:7', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'participants_count' => ['nullable', 'integer', 'min:0'],
            'content' => ['nullable'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Преобразуем пустую строку country_id в null
        if ($this->has('country_id') && $this->country_id === '') {
            $this->merge(['country_id' => null]);
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
            'country_id' => 'Страна',
            'title' => 'Title',
            'h1' => 'h1',
            'alias' => 'Алиас',
            'meta_description' => 'Мета описание',
            'image' => 'Изображение',
            'type' => 'Тип',
            'tournament_template_id' => 'Шаблон турнира',
            'color' => 'Цвет',
            'participants_count' => 'Количество участников',
            'content' => 'Контент',
            'status' => 'Статус',
        ];
    }
}

