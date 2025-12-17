<?php

namespace App\Http\Requests\Admin\MatchEvents;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class MatchEventRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'match_id' => ['required', 'exists:tournaments_matches,id'],
            'user_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'in:goal,assist'],
            'minute' => ['required', 'integer', 'min:1', 'max:120'],
            'description' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'match_id' => 'Матч',
            'user_id' => 'Игрок',
            'type' => 'Тип события',
            'minute' => 'Минута',
            'description' => 'Описание',
        ];
    }
}


