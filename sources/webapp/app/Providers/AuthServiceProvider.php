<?php

namespace App\Providers;

use App\Policies\EntryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \Statamic\Contracts\Entries\Entry::class => EntryPolicy::class,
        \Statamic\Entries\Entry::class => EntryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->registerPolicies();
        });
    }
}
