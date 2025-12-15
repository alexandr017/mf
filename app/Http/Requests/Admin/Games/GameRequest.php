<?php

namespace App\Http\Requests\Admin\Games;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class GameRequest extends FormRequest
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
            'description' => ['nullable'],
            'preview' => ['nullable', 'max:255'],
            'rules' => ['nullable'],
            'rating_points' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
            'category_id' => ['nullable', 'exists:game_categories,id'],
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
            'description' => 'Описание',
            'preview' => 'Превью',
            'rules' => 'Правила',
            'rating_points' => 'Баллы рейтинга',
            'status' => 'Статус',
            'order' => 'Порядок',
        ];
    }
}

