<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('hasPermission', function ($user, $permissions) {
            $role = Role::with('permissions')->where('id', $user->role)->first();
        
            // Ensure the user role and permissions exist
            if (!$role || !$role->permissions) {
                return false;
            }
        
            // Convert the $permissions argument to an array if it's not already
            $permissions = Arr::wrap($permissions);
        
            // Check if the user has all the specified permissions
            foreach ($permissions as $permission) {
                if (!$role->permissions->contains('name', $permission)) {
                    return false;
                }
            }
        
            // Check the user's active status
            return $user->is_active == 1;
        });

        //
        Gate::define('hasUpdateUserPermission',function($user,$id){
            return $user->role!=User::find($id)->role && User::find($id)->role!=1;
        });
    }
}
