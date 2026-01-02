<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Requests\Site\Account\AccountOptionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountController
{
    public function index()
    {
        $user = auth()->user();
        
        // Получаем текущую команду пользователя (последняя по сезону)
        $currentUserTeam = \App\Models\UserTeams\UserTeam::where('user_id', $user->id)
            ->with('team')
            ->orderBy('season', 'desc')
            ->first();
        
        // Получаем все сезоны пользователя с командами
        $userSeasons = \App\Models\UserTeams\UserTeam::where('user_id', $user->id)
            ->with('team')
            ->orderBy('season', 'desc')
            ->get();
        
        // Получаем достижения пользователя
        $achievements = $user->achievements()
            ->orderBy('user_achievements.earned_at', 'desc')
            ->get();
        
        // Подсчитываем матчи команд (пока заглушка, если нет таблицы)
        // TODO: получить из таблицы статистики матчей команд
        $matchesCount = 0; // Заглушка - нужно получить из таблицы матчей команд
        
        // Статистика по сезонам (пока заглушки)
        $seasonStats = [];
        foreach ($userSeasons as $userTeam) {
            $seasonStats[] = [
                'season' => $userTeam->season, // Теперь это просто год (integer)
                'team' => $userTeam->team,
                'goals' => 0, // TODO: получить из таблицы статистики матчей
                'assists' => 0, // TODO: получить из таблицы статистики матчей
                'matches' => 0, // TODO: получить из таблицы статистики матчей
                'is_current' => $currentUserTeam && $currentUserTeam->id === $userTeam->id,
            ];
        }
        
        // Статистика по годам из товарищеских матчей
        $yearlyStats = [];
        $friendlyMatches = \App\Models\FriendlyMatches\FriendlyMatch::where('status', 'played')
            ->get()
            ->filter(function($match) use ($user) {
                // Проверяем участие в матче через scorers, assists или squad
                $hasInScorers = false;
                $hasInAssists = false;
                $hasInSquad = false;
                
                if ($match->scorers) {
                    foreach ($match->scorers as $scorer) {
                        if (isset($scorer['user_id']) && $scorer['user_id'] == $user->id) {
                            $hasInScorers = true;
                            break;
                        }
                    }
                }
                
                if ($match->assists) {
                    foreach ($match->assists as $assist) {
                        if (isset($assist['user_id']) && $assist['user_id'] == $user->id) {
                            $hasInAssists = true;
                            break;
                        }
                    }
                }
                
                if ($match->squad) {
                    $team1Squad = $match->squad['team_1'] ?? [];
                    $team2Squad = $match->squad['team_2'] ?? [];
                    $allSquad = array_merge($team1Squad, $team2Squad);
                    foreach ($allSquad as $squadItem) {
                        if (isset($squadItem['user_id']) && $squadItem['user_id'] == $user->id) {
                            $hasInSquad = true;
                            break;
                        }
                    }
                }
                
                return $hasInScorers || $hasInAssists || $hasInSquad;
            });
        
        foreach ($friendlyMatches as $match) {
            $year = $match->date ? $match->date->format('Y') : date('Y');
            if (!isset($yearlyStats[$year])) {
                $yearlyStats[$year] = ['goals' => 0, 'assists' => 0, 'matches' => 0];
            }
            
            // Подсчитываем голы
            if ($match->scorers) {
                foreach ($match->scorers as $scorer) {
                    if (isset($scorer['user_id']) && $scorer['user_id'] == $user->id) {
                        $goals = is_array($scorer['goals']) ? count($scorer['goals']) : ($scorer['goals'] ?? 0);
                        $yearlyStats[$year]['goals'] += $goals;
                    }
                }
            }
            
            // Подсчитываем ассисты
            if ($match->assists) {
                foreach ($match->assists as $assist) {
                    if (isset($assist['user_id']) && $assist['user_id'] == $user->id) {
                        $assists = is_array($assist['assists']) ? count($assist['assists']) : ($assist['assists'] ?? 0);
                        $yearlyStats[$year]['assists'] += $assists;
                    }
                }
            }
            
            // Проверяем участие в матче (если есть в заявке)
            if ($match->squad) {
                $team1Squad = $match->squad['team_1'] ?? [];
                $team2Squad = $match->squad['team_2'] ?? [];
                $allSquad = array_merge($team1Squad, $team2Squad);
                foreach ($allSquad as $squadItem) {
                    if (isset($squadItem['user_id']) && $squadItem['user_id'] == $user->id) {
                        $yearlyStats[$year]['matches']++;
                        break;
                    }
                }
            }
        }
        
        // Титулы по годам (пока заглушки)
        $titlesByYear = [];
        
        // Получаем планы подписки
        $subscriptionPlans = \App\Models\Subscriptions\SubscriptionPlan::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        
        // Получаем активную подписку пользователя
        $activeSubscription = $user->activeSubscription;
        
        return view('site.v1.templates.account.index', compact(
            'user',
            'currentUserTeam',
            'userSeasons',
            'achievements',
            'matchesCount',
            'seasonStats',
            'titlesByYear',
            'yearlyStats',
            'subscriptionPlans',
            'activeSubscription'
        ));
    }

    public function referrals()
    {
        return view('site.v1.templates.account.referrals');
    }
    
    public function games()
    {
        return view('site.v1.templates.account.games');
    }
    
    public function game($alias)
    {
        return view('site.v1.templates.account.game',compact('alias'));
    }
    
    public function options()
    {
        return view('site.v1.templates.account.options');
    }
    
    public function saveOptions(AccountOptionsRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        // Обновление основных полей
        $user->name = $data['name'];
        $user->email = $data['email'];
        
        if (isset($data['nickname'])) {
            $user->nickname = $data['nickname'] ?: null;
        }

        if (isset($data['preferred_position'])) {
            $user->preferred_position = $data['preferred_position'] ?: null;
        }

        if (isset($data['hometown_city_id'])) {
            $user->hometown_city_id = $data['hometown_city_id'] ?: null;
        }

        if (isset($data['show_hometown'])) {
            $user->show_hometown = (bool) $data['show_hometown'];
        } else {
            $user->show_hometown = false;
        }

        // Обработка загрузки аватара
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            
            // Дополнительная проверка безопасности
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            if (!in_array($avatar->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['avatar' => 'Недопустимый тип файла.'])->withInput();
            }
            
            // Проверка размера (5MB)
            if ($avatar->getSize() > 5 * 1024 * 1024) {
                return back()->withErrors(['avatar' => 'Размер файла не должен превышать 5MB.'])->withInput();
            }
            
            // Удаляем старое изображение, если оно есть
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Генерируем безопасное имя файла и сохраняем
            $extension = $avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('avatars', Str::uuid() . '.' . $extension, 'public');
            $user->avatar = $path;
        }

        // Обновление пароля (если указан)
        if (!empty($data['password'])) {
            // Проверяем текущий пароль
            if (!Hash::check($data['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Неверный текущий пароль.'])->withInput();
            }
            
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('account.options')->with('success', 'Настройки успешно сохранены.');
    }

    public function matches()
    {
        $user = auth()->user();
        
        // Получаем текущую команду пользователя
        $currentSeason = \Carbon\Carbon::now()->year;
        $currentUserTeam = \App\Models\UserTeams\UserTeam::where('user_id', $user->id)
            ->where('season', $currentSeason)
            ->with('team')
            ->first();
        
        $userTeamId = $currentUserTeam ? $currentUserTeam->team_id : null;
        
        // Получаем товарищеские матчи (все, где участвует команда пользователя)
        $friendlyMatches = \App\Models\FriendlyMatches\FriendlyMatch::with(['homeTeam', 'awayTeam'])
            ->where(function($query) use ($userTeamId) {
                if ($userTeamId) {
                    $query->where('team_1', $userTeamId)
                          ->orWhere('team_2', $userTeamId);
                } else {
                    // Если у пользователя нет команды, возвращаем пустую коллекцию
                    $query->whereRaw('1 = 0');
                }
            })
            ->orderBy('date', 'desc')
            ->get();
        
        // Получаем турнирные матчи (все, где участвует команда пользователя)
        $tournamentMatches = \App\Models\Tournaments\TournamentMatch::with(['homeTeam', 'awayTeam', 'stage.tournamentSeason.tournament'])
            ->where(function($query) use ($userTeamId) {
                if ($userTeamId) {
                    $query->where('team_1', $userTeamId)
                          ->orWhere('team_2', $userTeamId);
                } else {
                    // Если у пользователя нет команды, возвращаем пустую коллекцию
                    $query->whereRaw('1 = 0');
                }
            })
            ->orderBy('date', 'desc')
            ->get();
        
        // Объединяем матчи в единый массив с меткой типа
        $allMatches = collect();
        
        foreach ($friendlyMatches as $match) {
            $allMatches->push([
                'id' => $match->id,
                'type' => 'friendly',
                'date' => $match->date,
                'homeTeam' => $match->homeTeam,
                'awayTeam' => $match->awayTeam,
                'score_1' => $match->score_1,
                'score_2' => $match->score_2,
                'status' => $match->status,
                'match' => $match, // Полный объект для match-card
            ]);
        }
        
        foreach ($tournamentMatches as $match) {
            $allMatches->push([
                'id' => $match->id,
                'type' => 'tournament',
                'date' => $match->date,
                'homeTeam' => $match->homeTeam,
                'awayTeam' => $match->awayTeam,
                'score_1' => $match->score_1,
                'score_2' => $match->score_2,
                'status' => $match->status,
                'tournament' => $match->stage->tournamentSeason->tournament ?? null,
                'match' => $match, // Полный объект для match-card
            ]);
        }
        
        // Сортируем по дате
        $allMatches = $allMatches->sortByDesc(function($match) {
            return $match['date'] ? $match['date']->timestamp : 0;
        });
        
        // Разбиваем по периодам
        $now = \Carbon\Carbon::now();
        $yesterday = $now->copy()->subDay()->startOfDay();
        $tomorrow = $now->copy()->addDay()->endOfDay();
        $dayAfterTomorrow = $now->copy()->addDays(2)->startOfDay();
        
        $oldMatches = $allMatches->filter(function($match) use ($yesterday) {
            return $match['date'] && $match['date'] < $yesterday;
        });
        
        $recentMatches = $allMatches->filter(function($match) use ($yesterday, $tomorrow) {
            return $match['date'] && $match['date'] >= $yesterday && $match['date'] <= $tomorrow;
        });
        
        $futureMatches = $allMatches->filter(function($match) use ($dayAfterTomorrow) {
            return $match['date'] && $match['date'] >= $dayAfterTomorrow;
        });
        
        // Группируем по датам
        $oldMatchesByDate = $oldMatches->groupBy(function($match) {
            return $match['date'] ? $match['date']->format('Y-m-d') : 'no-date';
        })->sortKeys();
        
        $recentMatchesByDate = $recentMatches->groupBy(function($match) {
            return $match['date'] ? $match['date']->format('Y-m-d') : 'no-date';
        })->sortKeys();
        
        $futureMatchesByDate = $futureMatches->groupBy(function($match) {
            return $match['date'] ? $match['date']->format('Y-m-d') : 'no-date';
        })->sortKeysDesc();
        
        return view('site.v1.templates.account.matches', compact(
            'oldMatchesByDate',
            'recentMatchesByDate',
            'futureMatchesByDate',
            'userTeamId'
        ));
    }
}
