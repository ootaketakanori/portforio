<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{

    public function date(Request $request)
    {

        $entries = Attendance::simplePaginate(5);
        $date = Carbon::today();
        $today = Rest::whereDate('created_at', $date)->get();

        return view('attendance', ['entries' => $entries, 'today' => $today]);
    }

    public function index()
    {

        $entries = Attendance::simplePaginate(5);


        return view('attendance', ['entries' => $entries]);
    }
    public function create()
    {
        return view('rest');
    }
    public function startWork(Request $request)
    {

        $this->saveTimestampToSession('startBreak');

        //現在の日付を取得
        $currentDate = now()->toDateString();

        //Attendance テーブルにデータ挿入
        Attendance::create([
            'action' => 'atartWork',
            'date' => $currentDate,
            'start_time' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index');
    }
    public function endWork(Request $request)
    {
        $this->saveTimestampToSession('endWork');
        $currentDate = now()->toDateString();


        Attendance::create([
            'action' => 'endWork',
            'date' => $currentDate,
            'end_time' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index');
    }
    public function startBreak(Request $request)
    {

        $this->saveTimestampToSession('startBreak');



        $currentDate = now()->toDateString();

        Attendance::create([
            'action' => 'startBreak',
            'date' => $currentDate,
            'start_break' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function endBreak(Request $request)
    {
        $this->saveTimestampToSession('endBreak');
        $currentDate = now()->toDateString();

        Attendance::create([
            'action' => 'endBreak',
            'date' => $currentDate,
            'end_break' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index');
    }

    private function saveTimestampToSession($key)
    {
        //現在時刻を取得
        $timestamp = Carbon::now();
        //キーに対応するセッションに時刻を保存
        session()->put($key, $timestamp);
    }
    //前の日付に戻る
    public function previousPage(Request $rerquest)
    {
        //前のページのデータ取得、処理
        return redirect()->route('attendance.index');
    }
    //後の日付に進む
    public function nextPage(Request $request)
    {
        //後のページのデータ取得、処理
        return redirect()->route('attendance.index');
    }
}
