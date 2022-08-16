<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['1' , 'inventory_add'],
            ['1' , 'inventory_edit'],
            ['1' , 'inventory_delete'],
            ['1' , 'inventory_view_all'],
            ['1' , 'inventory_transfer'],
            ['2' , 'inventory_view_specific'],
            ['3' , 'inventory_view_all'],
            ['4' , 'inventory_view_all'],
            ['4' , 'inventory_add'],
            ['4' , 'inventory_edit'],
            ['4' , 'inventory_delete'],
            ['4' , 'inventory_transfer'],
            ['4' , 'category_add'],
            ['4' , 'category_update'],
            ['4' , 'category_view'],
            ['4' , 'category_delete'],
            ['4' , 'user_add'],
            ['4' , 'user_update'],
            ['4' , 'user_view'],
            ['4' , 'user_delete'],
            ['4' , 'lab_add'],
            ['4' , 'lab_update'],
            ['4' , 'lab_view'],
            ['4' , 'lab_delete'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'role_id' => $permission[0],
                'name' => $permission[1],
            ]);
        }
    }
}
