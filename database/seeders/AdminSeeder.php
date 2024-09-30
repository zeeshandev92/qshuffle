<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrNew(['email' =>  'admin@admin.com']);
        $user->name = 'Super Admin';
        $user->password = 'password';
        $user->type = 'admin';
        $user->save();

        $role = Role::createOrFirst(['name' => 'Super Admin'], ['guard_name' => 'web']);

        $permissions = Permission::where('guard_name', 'web')->get();
        $role->syncPermissions($permissions);
        $user->assignRole($role);
    }
}
