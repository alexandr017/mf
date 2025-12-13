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
            'country_id' => ['nullable', 'integer'],
            'title' => ['nullable', 'max:255'],
            'h1' => ['nullable', 'max:255'],
            'alias' => ['nullable', 'max:255'],
            'meta_description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'max:255'],
            'type' => ['required', 'in:league,cup,supercup,mixed'],
            'tournament_template_id' => ['nullable', 'exists:tournament_templates,id'],
            'content' => ['nullable'],
            'status' => ['nullable', 'boolean'],
        ];
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
            'country_id' => 'ID страны',
            'title' => 'Title',
            'h1' => 'h1',
            'alias' => 'Алиас',
            'meta_description' => 'Мета описание',
            'image' => 'Изображение',
            'type' => 'Тип',
            'tournament_template_id' => 'Шаблон турнира',
            'content' => 'Контент',
            'status' => 'Статус',
        ];
    }
}

