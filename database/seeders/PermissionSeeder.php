<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'Permission 1']);
        Permission::create(['name' => 'Permission 2']);
        Permission::create(['name' => 'Permission 3']);
        Permission::create(['name' => 'Permission 4']);
        Permission::create(['name' => 'Permission 5']);
        Permission::create(['name' => 'Permission 6']);
        Permission::create(['name' => 'Permission 7']);
    }
}
