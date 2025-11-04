<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define permission structure
        $permissionsByFeature = [
            'admin_panel' => ['view'],
            'user' => ['view', 'create', 'edit', 'delete'],
            'role' => ['view', 'create', 'edit', 'delete'],
            'hero_banner' => ['view', 'create', 'edit', 'delete'],
            'event' => ['view', 'create', 'edit', 'delete'],
            'membership' => ['view', 'edit'],
        ];

        // Create permissions
        foreach ($permissionsByFeature as $feature => $actions) {
            foreach ($actions as $action) {
                // Use updateOrCreate to avoid errors on re-seeding
                Permission::updateOrCreate(['name' => "{$feature}-{$action}"]);
            }
        }

        // Create admin role and assign all permissions
        // IMPORTANT: After adding new permissions to $permissionsByFeature, run 'php artisan db:seed --class=RolesAndPermissionsSeeder'
        // to ensure they are created in the database and assigned to the 'admin' role.
        $adminRole = Role::updateOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}