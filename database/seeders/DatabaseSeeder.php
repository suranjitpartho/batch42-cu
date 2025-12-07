<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(ContentPageSeeder::class);

        // Create the main admin user from .env, or use a default
        $adminEmail = config('auth.admin_email');
        $adminName = config('auth.admin_name');
        $adminPassword = config('auth.admin_password');

        $adminUser = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );

        // Assign the 'admin' role
        $adminRole = Role::findByName('admin');
        if ($adminRole) {
            $adminUser->assignRole($adminRole);
        }

        User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}