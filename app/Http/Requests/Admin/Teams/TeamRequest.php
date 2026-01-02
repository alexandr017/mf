<?php

namespace App\Http\Requests\Admin\Teams;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TeamRequest extends FormRequest
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
            'alias' => ['nullable', 'max:255'],
            'stadium' => ['nullable', 'max:255'],
            'stadium_info' => ['nullable', 'max:5000'],
            'description' => ['nullable'],
            'logo' => ['nullable', 'max:255'],
            'title' => ['nullable', 'max:255'],
            'h1' => ['nullable', 'max:255'],
            'meta_description' => ['nullable', 'max:255'],
            'country_id' => ['nullable', 'integer'],
            'city_id' => ['nullable', 'integer'],
            'date_created' => ['nullable', 'integer'],
            'stadium_small_preview' => ['nullable', 'max:255'],
            'stadium_big_preview' => ['nullable', 'max:255'],
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
            'alias' => 'Алиас',
            'stadium' => 'Стадион',
            'stadium_info' => 'Информация о стадионе',
            'description' => 'Описание',
            'logo' => 'Логотип',
            'title' => 'Title',
            'h1' => 'h1',
            'meta_description' => 'Мета описание',
            'country_id' => 'ID страны',
            'city_id' => 'ID города',
            'date_created' => 'Дата создания',
            'stadium_small_preview' => 'Маленькое превью стадиона',
            'stadium_big_preview' => 'Большое превью стадиона',
            'status' => 'Статус',
        ];
    }
}





