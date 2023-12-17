<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => 'admin']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role1);
        $role1->givePermissionTo(Permission::all());
    }
}
