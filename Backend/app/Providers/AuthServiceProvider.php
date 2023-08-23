<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\User;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //define gate
        if (\Illuminate\Support\Facades\Schema::hasTable('permissions')) {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function (User $user) use ($permission) {
                    return (bool) $permission->roles()->where('id', $user->role)->count();
                });
            });
        }

        Gate::define('pmss--permission-index', function (User $user){
            return $user->role === User::ROLE_ADMIN;
        });
        Gate::define('pmss--permission-edit', function (User $user){
            return $user->role === User::ROLE_ADMIN;
        });
        Gate::define('pmss--permission-update', function (User $user){
            return $user->role === User::ROLE_ADMIN;
        });
    }
}
