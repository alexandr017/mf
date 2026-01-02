<?php

namespace App\Http\Requests\Admin\Games;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class MatchPredictionRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $matchId = $this->route('match_prediction') ?? $this->route('id') ?? null;
        
        return [
            'team_1_name' => ['required', 'string', 'max:255'],
            'team_2_name' => ['required', 'string', 'max:255'],
            'team_1_logo' => ['nullable', 'string', 'max:255'],
            'team_2_logo' => ['nullable', 'string', 'max:255'],
            'match_date' => ['required', 'date'],
            'score_1' => ['nullable', 'integer', 'min:0', 'max:255'],
            'score_2' => ['nullable', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'in:scheduled,finished,cancelled'],
            'prediction_deadline' => ['required', 'date', 'before_or_equal:match_date'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'team_1_name' => 'Команда 1',
            'team_2_name' => 'Команда 2',
            'team_1_logo' => 'Логотип команды 1',
            'team_2_logo' => 'Логотип команды 2',
            'match_date' => 'Дата и время матча',
            'score_1' => 'Счет команды 1',
            'score_2' => 'Счет команды 2',
            'status' => 'Статус',
            'prediction_deadline' => 'Дедлайн для прогнозов',
            'description' => 'Описание',
        ];
    }
}

