<?php

namespace App\Http\Requests\Admin\FriendlyMatches;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class FriendlyMatchRequest extends FormRequest
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
            'team_1' => ['required', 'integer', 'exists:teams,id'],
            'team_2' => ['required', 'integer', 'exists:teams,id', 'different:team_1'],
            'date' => ['required', 'date'],
            'score_1' => ['nullable', 'integer', 'min:0', 'max:255'],
            'score_2' => ['nullable', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'in:scheduled,played,cancelled'],
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
            'team_1' => 'Команда 1',
            'team_2' => 'Команда 2',
            'date' => 'Дата',
            'score_1' => 'Счет команды 1',
            'score_2' => 'Счет команды 2',
            'status' => 'Статус',
        ];
    }
}

