<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Редирект на провайдера для авторизации
     */
    public function redirect(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Обработка callback от провайдера
     */
    public function callback(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Ошибка авторизации через ' . $this->getProviderName($provider));
        }

        $user = $this->findOrCreateUser($provider, $socialUser);

        Auth::login($user, true);

        // Проверяем, является ли пользователь админом
        $adminIds = config('admins', []);
        $userId = $user->id;

        if (in_array($userId, $adminIds)) {
            return redirect()->intended(route('admin.index', absolute: false));
        }

        return redirect()->intended(route('account', absolute: false));
    }

    /**
     * Найти или создать пользователя
     */
    protected function findOrCreateUser(string $provider, $socialUser): User
    {
        // Ищем существующий аккаунт соцсети
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($socialAccount) {
            return $socialAccount->user;
        }

        // Если пользователь авторизован, привязываем аккаунт
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            // Ищем пользователя по email
            $user = User::where('email', $socialUser->getEmail())->first();

            // Если пользователя нет, создаем нового
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?: $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(32)), // Случайный пароль
                    'email_verified_at' => now(), // Email уже подтвержден через соцсеть
                ]);
            }
        }

        // Создаем запись о соцсети
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'email' => $socialUser->getEmail(),
            'name' => $socialUser->getName(),
            'avatar' => $socialUser->getAvatar(),
            'token' => $socialUser->token,
            'refresh_token' => $socialUser->refreshToken,
            'expires_at' => $socialUser->expiresIn ? now()->addSeconds($socialUser->expiresIn) : null,
        ]);

        return $user;
    }

    /**
     * Валидация провайдера
     */
    protected function validateProvider(string $provider): void
    {
        $allowedProviders = ['google', 'facebook', 'vk', 'yandex', 'odnoklassniki'];

        if (!in_array($provider, $allowedProviders)) {
            abort(404);
        }
    }

    /**
     * Получить название провайдера
     */
    protected function getProviderName(string $provider): string
    {
        $names = [
            'google' => 'Google',
            'facebook' => 'Facebook',
            'vk' => 'VK',
            'yandex' => 'Yandex',
            'odnoklassniki' => 'Odnoklassniki',
        ];

        return $names[$provider] ?? $provider;
    }
}

