<?php

namespace App\Http\Requests\Admin\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class NewsRequest extends FormRequest
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
        $newsId = $this->route('news') ?? $this->route('id') ?? null;
        
        return [
            'title' => ['required', 'max:255'],
            'alias' => ['required', 'max:255', 'unique:news,alias,' . ($newsId ?? 'NULL')],
            'h1' => ['nullable', 'max:255'],
            'meta_description' => ['nullable', 'max:255'],
            'preview' => ['nullable', 'max:255'],
            'short_content' => ['nullable'],
            'content' => ['nullable'],
            'status' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
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
            'alias' => 'Алиас',
            'h1' => 'h1',
            'meta_description' => 'Мета описание',
            'preview' => 'Превью',
            'short_content' => 'Краткое описание',
            'content' => 'Содержание',
            'status' => 'Статус',
            'published_at' => 'Дата публикации',
        ];
    }
}

