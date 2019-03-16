<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @example 'App\Model' => 'App\Policies\ModelPolicy'
     * @var mixed[]
     */
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', static function ($user) {
            return $user->is_admin;
        });
    }
}
