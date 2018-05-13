<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Validator;


class AirController extends Controller
{
    public function index(Request $request)
    {
        $items = DB::table('air')->orderBy('created_at', 'desc')->limit(20)->get();
        return view('air.index', ['items' => $items]);
    }
    
    public function calculate(Request $request)
    {
        $action = '計算する';
        $session = $request->cookie('laravel_session');
        return view('air.calculate', ['action' => $action, 'session' => $session]);
    }

    public function show(Request $request) {
        $sum_record = DB::table('air')->max('id');
        
        $min_man_minute_air = round(DB::table('air')->where('gender', 0)->min('minute_air'), 1);
        $min_woman_minute_air = round(DB::table('air')->where('gender', 1)->min('minute_air'), 1);
        $avg_man_minute_air = round(DB::table('air')->where('gender', 0)->avg('minute_air'), 1);
        $avg_woman_minute_air = round(DB::table('air')->where('gender', 1)->avg('minute_air'), 1);
        $max_man_minute_air = round(DB::table('air')->where('gender', 0)->max('minute_air'), 1);
        $max_woman_minute_air = round(DB::table('air')->where('gender', 1)->max('minute_air'), 1);

        $age_avg_man_minute_air = [];
        for ($i = 10; $i <= 90; $i+=10) {
            array_push($age_avg_man_minute_air, round(DB::table('air')->where('gender', 0)->where('age', $i)->avg('minute_air'), 1));
        }

        $age_avg_woman_minute_air = [];
        for ($i = 10; $i <= 90; $i+=10) {
            array_push($age_avg_woman_minute_air, round(DB::table('air')->where('gender', 1)->where('age', $i)->avg('minute_air'), 1));
        }

        $count_tank_capacity = [
            '8' => DB::table('air')->where('tank_capacity', 8)->count(),
            '10' => DB::table('air')->where('tank_capacity', 10)->count(),
            '12' => DB::table('air')->where('tank_capacity', 12)->count(),
            '14' => DB::table('air')->where('tank_capacity', 14)->count(),
        ];

        $avg_entry_pressure = round(DB::table('air')->avg('entry_pressure'), 1);

        $count_entry_pressure = [];
        for ($i = 150; $i < 250; $i+=10) {
            array_push($count_entry_pressure, round(DB::table('air')->where('entry_pressure', $i)->count('entry_pressure')));
        }

        $count_exit_pressure = [];
        for ($i = 0; $i < 150; $i+=10) {
            array_push($count_exit_pressure, round(DB::table('air')->where('exit_pressure', $i)->count('exit_pressure')));
        }

        $min_dive_time = round(DB::table('air')->min('dive_time'), 1);
        $avg_dive_time = round(DB::table('air')->avg('dive_time'), 1);
        $max_dive_time = round(DB::table('air')->max('dive_time'), 1);

        $min_average_depth = round(DB::table('air')->min('average_depth'), 1);
        $avg_average_depth = round(DB::table('air')->avg('average_depth'), 1);
        $max_average_depth = round(DB::table('air')->max('average_depth'), 1);

        $data = [
            'min_man_minute_air' => $min_man_minute_air,
            'min_woman_minute_air' => $min_woman_minute_air,
            'avg_man_minute_air' => $avg_man_minute_air,
            'avg_woman_minute_air' => $avg_woman_minute_air,
            'max_man_minute_air' => $max_man_minute_air,
            'max_woman_minute_air' => $max_woman_minute_air,
            'age_avg_man_minute_air' => $age_avg_man_minute_air,
            'age_avg_woman_minute_air' => $age_avg_woman_minute_air,
            'count_tank_capacity' => $count_tank_capacity,
            'count_entry_pressure' => $count_entry_pressure,
            'count_exit_pressure' => $count_exit_pressure,
            'min_dive_time' => $min_dive_time,
            'avg_dive_time' => $avg_dive_time,
            'max_dive_time' => $max_dive_time,
            'min_average_depth' => $min_average_depth,
            'avg_average_depth' => $avg_average_depth,
            'max_average_depth' => $max_average_depth,
            'sum_record' => $sum_record,            
        ];

        return view('air.show', ['data' => $data]);
    }

    public function calculateResult(Request $request)
    {
        $action = '再計算する';
        $session = $request->cookie('laravel_session');
        $data = [
            'tank_capacity' => $request->tank_capacity,
            'entry_pressure' => $request->entry_pressure,
            'exit_pressure' => $request->exit_pressure,
            'average_depth' => $request->average_depth,
            'dive_time' => $request->dive_time,
            'gender' => $request->gender,
            'age' => $request->age,
            'minute_air' => round((($request->entry_pressure-$request->exit_pressure)*$request->tank_capacity/($request->average_depth/10+1)/$request->dive_time), 1),
            'session_id' => $request->cookie('laravel_session')
        ];
        DB::table('air')->insert($data);

        $msg = '';
        if (isset($data)) {
            if ($data['minute_air'] > 50) { // エア消費量が多すぎ
                $msg = '流石にエア消費量が毎分50.0L/min以上は多すぎる気が。入力間違えていませんか？'; 
            }
            else if ($data['minute_air'] > 3) { // エア消費量が3以上
                if (isset($data['gender'])) {
                    if ($data['gender'] == 0) { // 男性の場合
                        if ($data['minute_air'] < 13) {
                            $msg = '男性の平均は毎分13L〜15Lと言われています。そのため、あなたはエア持ちが非常に良いです。ただし、極端に少ない場合は呼吸が浅く酸欠になる可能性もあるので体調には十分注意してください。';
                        } else if ($data['minute_air'] < 15) {
                            $msg = '男性の平均は毎分13L〜15Lと言われています。そのため、あなたは平均的です。その調子でダイビングを楽しんでください。';
                        } else if ($data['minute_air'] < 20) {
                            $msg = '男性の平均は毎分13L〜15Lと言われています。そのため、あなたのエア消費量はやや多めです。少しだけエアの節約を心がけると良いかもしれません。';
                        } else {
                            $msg = '男性の平均は毎分13L〜15Lと言われています。そのため、あなたのエア消費量は多いです。過度な緊張や過度に動き過ぎていませんか？一度、インストラクターさんに相談して見ると良いかもしれません';
                        }
                    }
                    if ($data['gender'] == 1) { // 女性の場合
                        if ($data['minute_air'] < 10) {
                            $msg = '女性の平均は毎分13L〜15Lと言われています。そのため、あなたはエア持ちが非常に良いです。ただし、極端に少ない場合は呼吸が浅く酸欠になる可能性もあるので体調には十分注意してください。';
                        } else if ($data['minute_air'] < 12) {
                            $msg = '女性の平均は毎分13L〜15Lと言われています。そのため、あなたは平均的です。その調子でダイビングを楽しんでください。';
                        } else if ($data['minute_air'] < 15) {
                            $msg = '女性の平均は毎分13L〜15Lと言われています。そのため、あなたのエア消費量はやや多めです。少しだけエアの節約を心がけると良いかもしれません。';
                        } else {
                            $msg = '女性の平均は毎分13L〜15Lと言われています。そのため、あなたのエア消費量は多いです。過度な緊張や過度に動き過ぎていませんか？一度、インストラクターさんに相談して見ると良いかもしれません';
                        }
                    }
                } 
            } else if ($data['minute_air'] > 0) { // エア消費量が少なすぎ
                $msg = '流石にエア消費量が毎分3.0L/min以下は少なすぎる気が。入力間違えていませんか？'; 
            } else if ($data['minute_air'] == 0) { // エア消費量が0
                $msg = 'あれ、エア消費量がゼロです。エントリー残圧とエキジット残圧を同じにしていませんか？'; 
            } else { // エア消費量がマイナス
                $msg = 'あれ、エア消費量がマイナスです。エントリー残圧とエキジット残圧を逆にしていませんか？';
            }
        }
        $validate_rule = [
            'tank_capacity' => 'numeric|between:0,20',
            'entry_pressure' => 'numeric|between:0,240',
            'exit_pressure' => 'numeric|between:0,240',
            'average_depth' => 'numeric|between:0,100',
            'dive_time' => 'numeric|between:0,300',
        ];
        $this->validate($request, $validate_rule);
        return view('air.calculate', ['action' => $action, 'data' => $data, 'msg' => $msg, 'session' => $session]);
    }
}
