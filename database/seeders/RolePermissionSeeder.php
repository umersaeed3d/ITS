<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_permissions = [
            ['1' , '1'],
            ['1' , '2'],
            ['1' , '3'],
            ['1' , '4'],
            ['1' , '5'],
            ['2' , '6'],
            ['3' , '7'],
            ['4' , '7'],
            ['4' , '1'],
            ['4' , '2'],
            ['4' , '3'],
            ['4' , '5'],
            ['4' , '13'],
            ['4' , '14'],
            ['4' , '15'],
            ['4' , '16'],
            ['4' , '17'],
            ['4' , '18'],
            ['4' , '19'],
            ['4' , '20'],
            ['4' , '21'],
            ['4' , '22'],
            ['4' , '23'],
            ['4' , '24'],
        ];

        foreach ($roles_permissions as $rP) {
            DB::table('role_permissions')->insert([
                'role_id' => $rP[0],
                'permission_id' => $rP[1],
            ]);
        }
    }
}
