<?php

namespace App\Http\Requests\Admin\Matches;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class MatchRequest extends FormRequest
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
            'stage_id' => ['required', 'exists:tournaments_stages,id'],
            'group_id' => ['nullable', 'exists:tournaments_groups,id'],
            'team_1' => ['nullable', 'exists:teams,id'],
            'team_2' => ['nullable', 'exists:teams,id'],
            'date' => ['nullable', 'date'],
            'score_1' => ['nullable', 'integer', 'min:0', 'max:255'],
            'score_2' => ['nullable', 'integer', 'min:0', 'max:255'],
            'pen_1' => ['nullable', 'integer', 'min:0', 'max:255'],
            'pen_2' => ['nullable', 'integer', 'min:0', 'max:255'],
            'status' => ['required', 'in:scheduled,played,cancelled'],
            'stadium_id' => ['nullable', 'exists:teams,id'],
            'referee' => ['nullable', 'max:255'],
            'attendance' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'match_report' => ['nullable'],
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
            'stage_id' => 'Стадия',
            'group_id' => 'Группа',
            'team_1' => 'Команда 1',
            'team_2' => 'Команда 2',
            'date' => 'Дата и время',
            'score_1' => 'Счет команды 1',
            'score_2' => 'Счет команды 2',
            'pen_1' => 'Пенальти команды 1',
            'pen_2' => 'Пенальти команды 2',
            'status' => 'Статус',
            'stadium_id' => 'Стадион',
            'referee' => 'Судья',
            'attendance' => 'Посещаемость',
            'description' => 'Описание',
            'video_url' => 'Ссылка на видео',
            'match_report' => 'Отчет о матче',
        ];
    }
}




