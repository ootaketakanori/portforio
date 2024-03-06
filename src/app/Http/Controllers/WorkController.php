<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WorkController extends Controller
{

    public function date(Request $request)
    {
        //1/26simplePaginate
        $entries = Attendance::with('user')->Paginate(5);
        $date = Carbon::today();
        $today = Rest::whereDate('created_at', $date)->get();

        return view('attendance', ['entries' => $entries, 'today' => $today]);
    }

    public function index()
    {
        //1/26simplePaginate
        $entries = Attendance::with('user')->orderBy('start_time', 'desc')->Paginate(5);

        return view('attendance', ['entries' => $entries]);
    }
    public function create()
    {
        return view('rest');
    }

    public function startWork(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            Log::info("Logged in user ID: " . $userId);

            // ボタンを押したときの時間を取得
            $startWorkTime = now();
            // セッションに保存
            $this->saveTimestampToSession('startWork', $startWorkTime);

            // 現在時刻：送信するデータをセット
            $currentDate = now()->toDateString();

            // attendance テーブルにデータを挿入
            $attendance = Attendance::create([
                'user_id' => $userId, // ログインユーザーの ID を指定
                'date' => $currentDate,
                'start_time' => $startWorkTime,
            ]);

            // 全てのデータを取得
            $entries = Attendance::with('user')->Paginate(5);

            // ビューにデータを渡す
            return view('attendance', ['entries' => $entries, 'startWorkTime' => $attendance->start_time]);
        } else {
            Log::error("No authenticated user.");
            // 未認証ユーザーのための処理、例えばリダイレクト等をここに記述
        }
    }
    public function endWork(Request $request)
    {
        // ボタンを押したときの時間を取得
        $endWorkTime = now();
        //ログインユーザーのIDを取得
        $userId = auth()->id();
        //現在時刻データ送信
        $currentDate = now()->toDateString();

        //1/26simplePaginate
        //全てのデータを取得//
        //Attendanceテーブルにデータを挿入//
        $attendance = Attendance::where('user_id', $userId)
            ->where('date', $currentDate)
            ->whereNULL('end_time') //勤務終了時間が記録されてないレコードを探す
            ->first();

        // 勤務終了時刻と勤務時間を更新
        if ($attendance) {
            $attendance->end_time = $endWorkTime;

            // 勤務時間を計算（Carbonインスタンスの差分を秒数で取得し、時間:分:秒形式に変換）
            $workDurationSeconds = $attendance->start_time->diffInSeconds($endWorkTime);
            // 勤務時間を秒数として保存
            $attendance->work_duration = $workDurationSeconds;

            $attendance->save();

            // 成功時にattendance.indexにリダイレクト
            return redirect()->route('attendance.index');
        } else {

            $entries = Attendance::Paginate(5);

            //ビューにデータを渡す
            return redirect()->route('attendance.index')->with('error', '対象の勤務記録が見つかりません。');
        }
    }
    public function startBreak(Request $request)
    {
        $userId = auth()->id(); // ログインユーザーのIDを取得
        // ユーザーの最新の勤務レコードを取得
        $attendance = Attendance::where('user_id', $userId)
            ->whereNull('end_time')
            ->latest()
            ->first();

        if ($attendance) {
            // 休憩レコードを作成
            Rest::create([
                'attendance_id' => $attendance->id,
                'break_start_time' => now(),
                'date' => now()->toDateString()
            ]);

            // 処理後に特定のページにリダイレクト（メッセージなし）
            return redirect()->route('attendance.index');
        } else {
            // 勤務レコードが見つからない場合、特定のページにリダイレクト（メッセージなし）
            return redirect()->back();
        }
    }

    public function endBreak(Request $request)
    {

        $userId = auth()->id(); // ログインユーザーのIDを取得
        $breakEndTime = now(); // 現在時刻を取得

        // ユーザーの最新の勤務レコードを取得して、その中の最後の休憩レコードを見つける
        $lastBreak = Rest::whereHas('attendance', function ($query) use ($userId) {
            $query->where('user_id', $userId)->latest('date');
        })->whereNull('break_end_time')->latest()->first();

        if ($lastBreak) {
            $lastBreak->break_end_time = $breakEndTime;
            $lastBreak->save();

            //休憩時間の計算
            $breakDuration = $breakEndTime->diffInSeconds($lastBreak->break_start_time);

            //関連するAttendanceレコードの更新
            // $attendance->break_durationを数値に変換し、非数値の場合は0として扱う
            $existingDuration = floatval($lastBreak->attendance->break_duration ?? 0); // decimal型に適応
            $lastBreak->attendance->break_duration = $existingDuration + $breakDuration;
            $lastBreak->attendance->save();
            // フィードバックメッセージを表示しない場合でも、適切なページにリダイレクトする
            return redirect()->route('attendance.index');
        }

        // 休憩開始レコードが見つからない場合の処理も特にエラーメッセージを表示せずに、
        // 単にリダイレクトするだけになる
        return redirect()->back();
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

    public function showRestPag()
    {
        return view('rest');
    }
}
