<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Passport::tokensExpireIn(Carbon::now()->addMinutes(env('TOKEN_EXPIRE_MINUTES', 720)));
        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(env('REFRESH_TOKEN_EXPIRE_MINUTES', 1440)));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMinutes(env('PERSONAL_TOKEN_EXPIRE_MINUTES', 720)));
    }
}
