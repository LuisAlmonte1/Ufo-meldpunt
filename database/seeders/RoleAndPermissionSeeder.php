<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear existing cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions (only if they don't exist)
        $permissions = [
            'view ufo reports',
            'create ufo reports',
            'edit ufo reports',
            'delete ufo reports',
            'manage users',
            'view admin dashboard'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles (only if they don't exist)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'melder']);

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions);
        $userRole->syncPermissions([
            'view ufo reports',
            'create ufo reports'
        ]);

        // Create admin user (only if doesn't exist)
        $admin = User::firstOrCreate(
            ['email' => 'admin@ufo-meldpunt.nl'],
            [
                'name' => 'Admin UFO',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');

        // Create test user (only if doesn't exist)
        $user = User::firstOrCreate(
            ['email' => 'test@ufo-meldpunt.nl'],
            [
                'name' => 'Test Melder',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole('melder');

        echo "✅ Roles and permissions seeded successfully!\n";
        echo "👤 Admin: admin@ufo-meldpunt.nl / password\n";
        echo "👤 User: test@ufo-meldpunt.nl / password\n";
    }
}