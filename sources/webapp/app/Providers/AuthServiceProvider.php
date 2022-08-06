<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Global authorization gate that grants full access to administrators 
         * and specific abilities to users directly assigned a specific permission.
         * 
         */
        Gate::before(function ($user, $permission) {
            return $user->hasRole('admin') || $user->hasDirectPermission($permission) ? true : null;
        });
    }
}
