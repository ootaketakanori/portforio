<?php

namespace App\Http\Controllers;

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
        // バリデーション済みのデータを取得
        $validatedData = $request->validated();

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];

        if (auth()->attempt($credentials)) {
            // 認証成功した場合の処理
            return redirect()->route('rest');
        }

        // 認証失敗した場合の処理
        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }
}
