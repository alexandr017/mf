<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        // Проверяем реферальный код из URL
        $refCode = $request->get('ref');
        
        // Если есть реферальный код, сохраняем его в сессии
        if ($refCode) {
            // Проверяем, что код существует в базе
            $referrer = User::where('referral_code', $refCode)->first();
            if ($referrer) {
                session(['referral_code' => $refCode]);
            }
        }
        
        return view('site.v1.templates.auth.register', [
            'referralCode' => session('referral_code'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,nickname'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'string', 'exists:users,referral_code'],
        ]);

        // Получаем реферальный код из запроса или сессии
        $referralCode = $request->input('referral_code');
        if (empty($referralCode)) {
            $referralCode = session('referral_code');
        }
        
        $referredById = null;
        
        if ($referralCode) {
            $referrer = User::where('referral_code', $referralCode)->first();
            if ($referrer && $referrer->id) {
                // Проверяем, что пользователь не пытается использовать свой собственный код
                // (хотя это маловероятно при регистрации, но на всякий случай)
                if ($referrer->email !== $request->email) {
                    $referredById = $referrer->id;
                }
            }
        }

        // Генерируем реферальный код для нового пользователя
        $newReferralCode = strtoupper(\Illuminate\Support\Str::random(8));
        while (User::where('referral_code', $newReferralCode)->exists()) {
            $newReferralCode = strtoupper(\Illuminate\Support\Str::random(8));
        }

        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->username ?: null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $newReferralCode,
            'referred_by_id' => $referredById,
            'referrals_count' => 0,
        ]);

        // Обновляем счетчик рефералов у пригласившего пользователя
        if ($referredById) {
            $referrer->increment('referrals_count');
        }

        // Очищаем реферальный код из сессии
        session()->forget('referral_code');

        event(new Registered($user));

        Auth::login($user);

        // Проверяем, является ли пользователь админом
        $adminIds = config('admins', []);
        $userId = $user->id;

        if (in_array($userId, $adminIds)) {
            return redirect(route('admin.index', absolute: false));
        }

        return redirect(route('account', absolute: false));
    }
}
