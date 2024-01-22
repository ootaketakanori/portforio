<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;

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
    public function store(Request $request) // 1/22修正
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];

        //バリデーション実行
        $request->validate($rules);

        //バリデーションを通過したらユーザーを作成
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('rest');
    }
}
