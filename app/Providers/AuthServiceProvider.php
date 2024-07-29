<?php

namespace App\Providers;

use App\Models\CD;
use App\Policies\CDPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        CD::class => CDPolicy::class,
    ];
}
