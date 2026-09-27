<?php

namespace App\Providers;

use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\EnsureRole::class);
        
        \Illuminate\Support\Facades\Gate::policy(Order::class, OrderPolicy::class);
    }
}