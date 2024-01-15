<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'coachtech',
            'email' => 'rrr@gmail.com',
            'password' => 'dddddddddd'
        ];
        DB::table('users')->insert($param);
    }
}
