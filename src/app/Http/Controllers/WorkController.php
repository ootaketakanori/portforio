<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;


class WorkController extends Controller
{
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
        $this->saveTimestampToSession('startWork');
        return redirect()->route('attendance.index');
    }
    public function endWork(Request $request)
    {
        $this->saveTimestampToSession('endWork');
        return redirect()->route('rest');
    }
    public function startBreak(Request $request)
    {
        $this->saveTimestampToSession('startBreak');
        return redirect()->route('rest');
    }
    public function endBreak(Request $request)
    {
        $this->saveTimestampToSession('endBreak');
        return redirect()->route('rest');
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
