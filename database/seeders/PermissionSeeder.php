<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create_users',
            'view_users',
            'update_users',
            'delete_users',

            'create_roles', 
            'view_roles',
            'update_roles',
            'delete_roles',

            'create_permissions',
            'view_permissions',
            'update_permissions',
            'delete_permissions',

            'create_registration', 
            'view_registration',
            'update_registration',
            'delete_registration',

            'create_discussion', 
            'view_discussion',
            'update_discussion',
            'delete_discussion',

            'create_release', 
            'view_release',
            'update_release',
            'delete_release',

            'create_general_reports', 
            'view_general_reports',
            'update_general_reports',
            'delete_general_reports',

            'create_intrigated_reports', 
            'view_intrigated_reports',
            'update_intrigated_reports',
            'delete_intrigated_reports',

            'create_history', 
            'view_history',
            'update_history',
            'delete_history',

            'create_admin',
            'view_admin',
            'update_admin',
            'delete_admin',
            
        ];
        
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
