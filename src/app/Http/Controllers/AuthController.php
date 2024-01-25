<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
