<?php

namespace App\Http\Requests\Admin\TournamentSeasons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TournamentSeasonRequest extends FormRequest
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
            'tournament_id' => ['required', 'exists:tournaments,id'],
            'year_start' => ['required', 'integer', 'min:2000', 'max:2100'],
            'year_finish' => ['required', 'integer', 'min:2000', 'max:2100', 'gte:year_start'],
            'status' => ['nullable', 'boolean'],
            'rules_json' => ['nullable', 'json'],
            'generate_matches' => ['nullable', 'boolean'],
            'teams' => ['nullable', 'array'],
            'teams.*' => ['exists:teams,id'],
            'start_date' => ['nullable', 'date'],
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
            'tournament_id' => 'Турнир',
            'year_start' => 'Год начала',
            'year_finish' => 'Год окончания',
            'status' => 'Статус',
            'rules_json' => 'Правила (JSON)',
            'generate_matches' => 'Генерировать матчи',
            'teams' => 'Команды',
            'start_date' => 'Дата начала',
        ];
    }
}



