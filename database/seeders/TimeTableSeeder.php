<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('time_tables')->insert([
            'day' => 'monday',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);

        DB::table('time_tables')->insert([
            'day' => 'tuesday',
            'start_time' => '09:00:00',
            'end_time' => '16:00:00',
        ]);

        DB::table('time_tables')->insert([
            'day' => 'wednesday',
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
        ]);

        DB::table('time_tables')->insert([
            'day' => 'thursday',
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
        ]);

        DB::table('time_tables')->insert([
            'day' => 'friday',
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
        ]);

        DB::table('time_tables')->insert([
            'day' => 'saturday',
            'start_time' => '09:00:00',
            'end_time' => '15:00:00',
        ]);

        DB::table('time_tables')->insert([
            'day' => 'sunday',
        ]);
    }
}
