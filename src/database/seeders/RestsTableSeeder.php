<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // RestsTableSeeder.php
        $param = [
            'date' => '2021-03-01', // 有効な日付を指定
            'break_start_time' => '2021-03-01 07:30:00', // 正しい datetime フォーマット
            'break_end_time' => '2021-03-01 08:30:00', // 正しい datetime フォーマット
            'attendance_id' => 1, // 適切な attendance_id を指定
        ];
        DB::table('rests')->insert($param);
    }
}
