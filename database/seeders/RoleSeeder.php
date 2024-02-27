<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 

    public function run(): void
    {

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Stock Manager']);
        Role::create(['name' => 'Commercial Manager']);
        Role::create(['name' => 'Order Manager']);




        // $createPostPermission = Permission::updateOrCreate(['name' => 'create-post']);
        // $createUserPermission = Permission::updateOrCreate(['name' => 'create-user']);

        // $adminRole = Role::updateOrCreate(['name' => 'admin']);
        // $userRole = Role::updateOrCreate(['name' => 'user']);

        // $admin = User::updateOrCreate([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('admin'),
        // ]);
        // $admin->roles()->sync([$adminRole->id]);
        // $admin->permissions()->sync([$createPostPermission->id]);

        // $user = User::updateOrCreate([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => bcrypt('user'),
        // ]);
        // $user->roles()->sync([$userRole->id]);
        // $user->permissions()->sync([$createUserPermission->id]);
    }
}
