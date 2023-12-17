<?php

declare(strict_types=1);

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'         => 1,
                'name'       => 'section_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 2,
                'name'       => 'section_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 3,
                'name'       => 'section_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 4,
                'name'       => 'section_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 5,
                'name'       => 'section_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 6,
                'name'       => 'role_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 7,
                'name'       => 'role_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 8,
                'name'       => 'role_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 9,
                'name'       => 'role_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 10,
                'name'       => 'role_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 11,
                'name'       => 'permission_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 12,
                'name'       => 'permission_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 13,
                'name'       => 'permission_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 14,
                'name'       => 'permission_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 15,
                'name'       => 'permission_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 16,
                'name'       => 'user_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 17,
                'name'       => 'user_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 18,
                'name'       => 'user_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 19,
                'name'       => 'user_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 20,
                'name'       => 'user_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 21,
                'name'       => 'product_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 22,
                'name'       => 'product_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 23,
                'name'       => 'product_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 24,
                'name'       => 'product_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 25,
                'name'       => 'product_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 26,
                'name'       => 'blog_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 27,
                'name'       => 'blog_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 28,
                'name'       => 'blog_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 29,
                'name'       => 'blog_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 30,
                'name'       => 'blog_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 31,
                'name'       => 'order_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 32,
                'name'       => 'order_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 33,
                'name'       => 'order_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 34,
                'name'       => 'order_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 35,
                'name'       => 'order_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 41,
                'name'       => 'setting_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 42,
                'name'       => 'dashboard_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 43,
                'name'       => 'page_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 44,
                'name'       => 'page_settings',
                'guard_name' => 'web',
            ],

            [
                'id'         => 50,
                'name'       => 'brand_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 51,
                'name'       => 'brand_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 52,
                'name'       => 'brand_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 53,
                'name'       => 'brand_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 54,
                'name'       => 'brand_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 55,
                'name'       => 'slider_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 56,
                'name'       => 'slider_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 57,
                'name'       => 'slider_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 58,
                'name'       => 'slider_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 59,
                'name'       => 'slider_show',
                'guard_name' => 'web',
            ],

            [
                'id'         => 70,
                'name'       => 'blogcategory_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 71,
                'name'       => 'blogcategory_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 72,
                'name'       => 'blogcategory_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 73,
                'name'       => 'blogcategory_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 74,
                'name'       => 'blogcategory_show',
                'guard_name' => 'web',
            ],
            [
                'id'         => 80,
                'name'       => 'email_access',
                'guard_name' => 'web',
            ],
            [
                'id'         => 81,
                'name'       => 'email_create',
                'guard_name' => 'web',
            ],
            [
                'id'         => 82,
                'name'       => 'email_update',
                'guard_name' => 'web',
            ],
            [
                'id'         => 83,
                'name'       => 'email_delete',
                'guard_name' => 'web',
            ],
            [
                'id'         => 84,
                'name'       => 'email_show',
                'guard_name' => 'web',
            ],
        ];

        Permission::insert($permissions);
    }
}
