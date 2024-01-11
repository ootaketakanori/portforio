<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;


class WorkController extends Controller
{
public function search(Request $request)
{
    //検索日付、取得
    $searchDate = $request->input('keyword');

    //現在の日付を除外する
if ($searchDate == now()->toDateString()) {
    return redirect()->route('attendance.index');
}

$dates = Attendance::whereDate('date', 'like', '%' . $searchDate . '%')->get();

$entries = Attendance::whereDate('startWork', $searchDate)->orWhereDate('endWork', $searchDate)->simplePaginate(5);

return view('attendance', ['entries' => $entries, 'date' => $searchDate]);
}

    public function index()
    {
        $entries = Attendance::simplePaginate(5);
        $date = '現在の日付';
        return view('attendance', ['entries' => $entries, 'date' => $date]);
    }
    public function create()
    {
        return view('rest');
    }
    public function startWork(Request $request)
    {
        $this->saveTimestampToSession('startWork');

        //現在時刻：送信するデータをセット
        $requestData = [
            'data' => now()->toDateString(),
        ];
        //現在時刻をセッションに保存
        session()->put('requestData', $requestData);
        //$dateに現在時刻を格納
        $date = $requestData['data'];

        return redirect()->route('attendance.index', compact('date'));
    }
    public function endWork(Request $request)
    {
        $this->saveTimestampToSession('endWork');
        $requestData = [
            'data' => now()->toDateString(),
        ];
        //現在時刻をセッションに保存
        session()->put('requestData', $requestData);

        return redirect()->route('attendance.index');
    }
    public function startBreak(Request $request)
    {

        $this->saveTimestampToSession('startBreak');
        $requestData = [
            'data' => now()->toDateString(),
        ];
        session()->put('rerquestData', $requestData);

        return redirect()->route('attendance.index');
    }

    public function endBreak(Request $request)
    {
        $this->saveTimestampToSession('endBreak');
        $requestData = [
            'data' => now()->toDateString(),
        ];
        session()->put('requestData', $requestData);
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
