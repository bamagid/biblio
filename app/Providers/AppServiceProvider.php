<?php

namespace App\Providers;

use App\Models\Emprunt;
use App\Models\Livre;
use App\Policies\EmpruntPolicy;
use App\Policies\LivrePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Livre::class, LivrePolicy::class);
        Gate::policy(Emprunt::class, EmpruntPolicy::class);
    }
}
