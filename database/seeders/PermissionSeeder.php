<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'roles-list',
            'roles-create',
            'roles-edit',
            'roles-delete',

            'users-list',
            'users-create',
            'users-edit',
            'users-delete',

            'relations-list',
            'relations-create',
            'relations-edit',
            'relations-delete',

            'questions-list',
            'questions-create',
            'questions-edit',
            'questions-delete',

            'plans-list',
            'plans-create',
            'plans-edit',
            'plans-delete',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
