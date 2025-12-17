<?php

namespace App\Http\Requests\Admin\TeamPlayers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class TeamPlayerRequest extends FormRequest
{
    use AdminRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teamPlayerId = $this->route('team-player') ?? $this->route('team_players');
        
        return [
            'team_id' => ['required', 'exists:teams,id'],
            'user_id' => ['required', 'exists:users,id'],
            'season_id' => ['required', 'exists:tournaments_seasons,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'team_id' => 'Команда',
            'user_id' => 'Игрок',
            'season_id' => 'Сезон',
        ];
    }
}


