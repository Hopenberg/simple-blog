<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => User::ROLE_ADMIN]);
        $roleEditor = Role::create(['name' => User::ROLE_EDITOR]);
        Role::create(['name' => User::ROLE_USER]);

        Permission::create(['name' => User::PERMISSION_PANEL_ACCESS]);
        Permission::create(['name' => User::PERMISSION_POST_LISTING]);
        Permission::create(['name' => User::PERMISSION_POST_ADD]);
        Permission::create(['name' => User::PERMISSION_POST_EDIT]);
        Permission::create(['name' => User::PERMISSION_POST_DELETE]);
        Permission::create(['name' => User::PERMISSION_USER_LISTING]);
        Permission::create(['name' => User::PERMISSION_USER_ADD]);
        Permission::create(['name' => User::PERMISSION_USER_EDIT]);
        Permission::create(['name' => User::PERMISSION_USER_DELETE]);
        Permission::create(['name' => User::PERMISSION_USER_GRANT_PERMISSION]);

        $roleEditor->givePermissionTo([
            User::PERMISSION_PANEL_ACCESS,
            User::PERMISSION_POST_LISTING,
            User::PERMISSION_POST_ADD,
            User::PERMISSION_POST_EDIT,
            User::PERMISSION_POST_DELETE
        ]);

        $roleAdmin->givePermissionTo([
            User::PERMISSION_PANEL_ACCESS,
            User::PERMISSION_POST_LISTING,
            User::PERMISSION_POST_ADD,
            User::PERMISSION_POST_EDIT,
            User::PERMISSION_POST_DELETE,
            User::PERMISSION_USER_LISTING,
            User::PERMISSION_USER_ADD,
            User::PERMISSION_USER_EDIT,
            User::PERMISSION_USER_DELETE,
            User::PERMISSION_USER_GRANT_PERMISSION
        ]);

        $admin = User::create(['name' => 'admin', 'email' => 'admin@simpleblog.com', 'password' => 'admin123']);
        $admin->assignRole(User::ROLE_ADMIN);
    }
}
