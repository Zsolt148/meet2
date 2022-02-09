<?php

namespace App\Providers;

use App\Role\RoleService;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(RoleService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {

    }
}
