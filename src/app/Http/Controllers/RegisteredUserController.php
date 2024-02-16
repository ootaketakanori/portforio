<?php

namespace App\Http\Controllers;

use App\Models\User;


use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function create()
    {
        return view('auth.register');
    }
    //public function store(Request $request)
    //{
    //$user = User::create([
    //'name' => $request->name,
    //'email' => $request->email,
    // 'password' => bcrypt($request->password),
    //]);
    //ユーザーログイン
    //auth()->login($user);
    //return view('rest');
    //}
    // App\Http\Controllers\RegisteredUserController

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        // デバッグ





        //バリデーション済みのデータを取得
        $validatedData = $request->validated();


        //Userモデルを使用してユーザーをデータベースに保存
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);
        //ユーザーログイン
        auth()->login($user);
        //日別勤怠ページにリダイレクト
        return redirect()->route('attendance.index');
    }
}
