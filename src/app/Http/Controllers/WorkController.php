<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{

    public function date(Request $request)
    {
        //1/26simplePaginate
        $entries = Attendance::Paginate(5);
        $date = Carbon::today();
        $today = Rest::whereDate('created_at', $date)->get();

        return view('attendance', ['entries' => $entries, 'today' => $today]);
    }

    public function index()
    {
        //1/26simplePaginate
        $entries = Attendance::Paginate(5);

        return view('attendance', ['entries' => $entries]);
    }
    public function create()
    {
        return view('rest');
    }
    public function startWork(Request $request)
    {

        $this->saveTimestampToSession('startWork');

        //現在時刻：送信するデータをセット
        $currentDate = now()->toDateString();
        //全てのデータを取得//
        $attendances = DB::table('attendances')->get();
        $entries = Attendance::simplePaginate(5);
        return view('attendance', ['entries' => $entries]);
        //attendanceテーブルにデータを挿入
        Attendance::create([
            'action' => 'startWork',
            'date' => $currentDate,
            'start_time' => Carbon::now(),
        ]);
    }



    public function endWork(Request $request)
    {
        $this->saveTimestampToSession('endWork');
        $currentDate = now()->toDateString();
        //1/26simplePaginate
        //全てのデータを取得//
        $entries = Attendance::Paginate(5);
        return view('attendance', ['entries' => $entries]);

        //Attendanceテーブルにデータを挿入//
        Attendance::create([
            'action' => 'endWork',
            'date' => $currentDate,
            'end_time' => Carbon::now(),
        ]);
    }
    public function startBreak(Request $request)
    {

        $currentDate = now()->toDateString();
        //1/26ログインユーザーのIdを取得
        $userId = auth()->id();
        //全てのデータを取得//
        //1/26simplePaginate
        $entries = Attendance::Paginate(5);
        //Attendance::create([
        //'action' => //'start_Break',
        //'date' => $currentDate,
        //'start_break' => Carbon::now(),
        //]);
        //ログインユーザーがいる場合のみレコードを取得
        if ($userId) {
            Attendance::create([
                'user_id' => $userId,
                'action' => 'start_Break',
                'date' => $currentDate,
                'start_break' => now(),
            ]);
        }
        return view('attendance', ['entries' => $entries]);
    }

    public function endBreak(Request $request)
    {
        $this->saveTimestampToSession('endBreak');
        $currentDate = now()->toDateString();
        $entries = Attendance::Paginate(5);

        //1/26ログインユーザーのIDを取得
        $userId = auth()->id();
        //全てのデータを取得//
        $attendances = DB::table('attendances')->get();
        if ($userId) {
            Attendance::create([
                'user_id' => $userId,
                'action' => 'end_Break',
                'date' => $currentDate,
                'end_break' => now(),
            ]);
            return view('attendance', ['entries' => $entries]);
        }

        //Attendance::create([
        //'action' => //'endBreak',
        //'date' => $currentDate,
        //'end_break' => Carbon::now(),
        //]);

        //return redirect()->route('attendance.index');

    }
    public function saveTimestampToSession($key)
    {
        //現在時刻を取得//
        $timestamp = Carbon::now();
        //キーに対応するセッションに時刻を保存//
        session()->put($key, $timestamp);
    }
    //前の日付に戻る//
    public function previousPage(Request $rerquest)
    {
        //前のページのデータ取得、処理
        return redirect()->route('attendance.index');
    }
    //後の日付に進む//
    public function nextPage(Request $request)
    {
        //後のページのデータ取得、処理//
        return redirect()->route('attendance.index');
    }
    //public function indexrest()
    //{
    //return view('rest');
    //}
    public function showRestPage()
    {
        return view('rest');
    }
    //public function storeAttendanceStart(Request $request)
    //{
    //ユーザーID取得
    //$userId = Auth::id();
    //出勤情報を挿入
    //Attendance::create([
    //'user_id' => $userId,
    // 'date' => now()//->toDateString(),
    // 'start_time' => now(),
    //]);
    //出勤情報を再取得1/26simplePaginate
    //$entries = //Attendance::where('user_id', $userId)->Paginate(5);
    //リダイレクト
    //return view('attendance', ['entries' => $entries])->with('success', '勤務を開始しました');
    //}
}
