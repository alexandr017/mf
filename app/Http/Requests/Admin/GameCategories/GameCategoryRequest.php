<?php

namespace App\Http\Requests\Admin\GameCategories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class GameCategoryRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('game-category') ?? $this->route('game_categories');
        
        return [
            'name' => ['required', 'max:255'],
            'alias' => ['required', 'max:255', 'unique:game_categories,alias,' . $categoryId],
            'description' => ['nullable'],
            'order' => ['nullable', 'integer'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'alias' => 'Алиас',
            'description' => 'Описание',
            'order' => 'Порядок',
            'status' => 'Статус',
        ];
    }
}

