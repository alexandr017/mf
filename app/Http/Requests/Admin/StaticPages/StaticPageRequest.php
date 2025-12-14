<?php

namespace App\Http\Requests\Admin\StaticPages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class StaticPageRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'meta_description' => ['required', 'max:255'],
            'h1' => ['required', 'max:255'],
            'content' => ['required'],
            'menu_content' => ['required'],
            'average_rating' => ['nullable', 'numeric'],
            'number_of_votes' => ['nullable', 'numeric'],
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
            'title' => 'Заголовок',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'content' => 'Контент',
            'menu_content' => 'Меню',
            'average_rating' => 'Значение рейтинга',
            'number_of_votes' => 'Количество голосов',
        ];
    }
}
