<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'karat-list',
            'karat-create',
            'karat-edit',
            'karat-delete',
            'size-list',
            'size-create',
            'size-edit',
            'size-delete',
            'size-list',
            'size-create',
            'size-edit',
            'size-delete',
            'products-list',
            'products-create',
            'products-edit',
            'products-delete',
            'holiday-list',
            'holiday-create',
            'holiday-edit',
            'holiday-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'datawise-list',
            'datawise-create',
            'datawise-edit',
            'datawise-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'customerlogin-list',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
