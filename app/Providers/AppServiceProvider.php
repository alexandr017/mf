<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Регистрация событий для Socialite Providers (VK, Yandex, Odnoklassniki)
        $socialite = $this->app->make(Factory::class);
        
        // VK
        $socialite->extend(
            'vk',
            function ($app) use ($socialite) {
                $config = $app['config']['services.vk'];
                return $socialite->buildProvider(
                    \SocialiteProviders\VKontakte\Provider::class,
                    $config
                );
            }
        );

        // Yandex
        $socialite->extend(
            'yandex',
            function ($app) use ($socialite) {
                $config = $app['config']['services.yandex'];
                return $socialite->buildProvider(
                    \SocialiteProviders\Yandex\Provider::class,
                    $config
                );
            }
        );

        // Odnoklassniki
        $socialite->extend(
            'odnoklassniki',
            function ($app) use ($socialite) {
                $config = $app['config']['services.odnoklassniki'];
                return $socialite->buildProvider(
                    \SocialiteProviders\Odnoklassniki\Provider::class,
                    $config
                );
            }
        );
    }
}
