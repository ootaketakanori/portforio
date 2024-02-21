<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\AuthenticatedRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('rest');
    }
    //1/24 20:30 修正
    public function loginView()
    {
        return view('auth.login');
    }
    public function rest()
    {
        return view('rest');
    }
    public function store(AuthenticatedRequest $request)
    {
        //バリデーションを通過したデータを取得
        $validatedData = $request->validated();

        // エラーがある場合、ログに記録
        if ($errors = $request->session()->get('errors')) {
            Log::error('バリデーションエラー:', $errors->all());
        }


        //ユーザーをDBに保存
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),

        ]);

        //ログイン処理
        //auth()->login($user);

        //リダレイクト
        return redirect()->route('rest');
    }
}
