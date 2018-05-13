<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirTableSeeder extends Seeder
{
    /**
     * データベース初期値設定の実行
     *
     * @return void
     */
    public function run()
    {
        echo get_class($this) . "\n"; // 自分のクラス名をecho

        DB::table('air')->insert([
            'gender' => 1,
            'age' => 20,
            'dive_time' => 30,
            'entry_pressure' => 200,
            'exit_pressure' => 120,
            'average_depth' => 10.3,
            'tank_capacity' => 10,
            'minute_air' => 13.3,
        ]);
        DB::table('air')->insert([
            'gender' => 1,
            'age' => 20,
            'dive_time' => 30,
            'entry_pressure' => 200,
            'exit_pressure' => 120,
            'average_depth' => 10.3,
            'tank_capacity' => 10,
            'minute_air' => 16.3,
        ]);
        DB::table('air')->insert([
            'gender' => 1,
            'age' => 20,
            'dive_time' => 30,
            'entry_pressure' => 200,
            'exit_pressure' => 120,
            'average_depth' => 10.3,
            'tank_capacity' => 10,
            'minute_air' => 19.3,
        ]);
    }
}