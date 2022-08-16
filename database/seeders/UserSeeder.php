<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $rolesIDs = DB::table('roles')->pluck('id');
        $password = '12345678';
        foreach(range(0,10) as $index){
            DB::table('users')->insert([
                'full_name' => $faker->name(),
                'user_name' => $faker->userName(),
                'email' => $faker->email(),
                'password' => Hash::make($password),
                'role_id' => $faker->randomElement($rolesIDs),
            ]);
        }

    }
}
