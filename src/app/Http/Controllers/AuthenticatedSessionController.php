<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function index()
    {
        return view('rest');
    }
    public function create()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        //ログインの際に使用するフィールド
        $credentials = $request->only('email', 'password');
        //ログインを試みる
        if (Auth::attempt($credentials)) {
            //認証成功
            $request - session()->regenerate();

            return redirect()->intended('rest');
        }
        //認証失敗時の処理
        return back()->withErrors([
            'email' => '認証失敗しました。'
        ]);
    }
}
