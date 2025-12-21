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
            ->with(['team', 'season'])
            ->orderBy('season_id', 'desc')
            ->first();
        
        // Получаем все сезоны пользователя с командами
        $userSeasons = \App\Models\UserTeams\UserTeam::where('user_id', $user->id)
            ->with(['team', 'season'])
            ->orderBy('season_id', 'desc')
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
                'season' => $userTeam->season,
                'team' => $userTeam->team,
                'goals' => 0, // TODO: получить из таблицы статистики матчей
                'assists' => 0, // TODO: получить из таблицы статистики матчей
                'matches' => 0, // TODO: получить из таблицы статистики матчей
                'is_current' => $currentUserTeam && $currentUserTeam->id === $userTeam->id,
            ];
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
}
