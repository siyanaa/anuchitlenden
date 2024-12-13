<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            PermissionSeeder::class,
            RoleSeeder::class,
            Role_PermissionSeeder::class,
            StateSeeder::class,
            DistrictSeeder::class,
            UserSeeder::class,
            LocalGovernmentSeeder::class,
            PurposeSeeder::class,
            NatureSeeder::class,
            ProofSeeder::class,
            NoTransactionPurposeSeeder::class
            
        ]);
    }
}
