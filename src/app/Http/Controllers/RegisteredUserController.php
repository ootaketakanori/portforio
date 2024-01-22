<?php

namespace App\Http\Controllers;

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
    public function store(Request $request) // 1/21修正
    {
        return view('auth.rest');
    }
}
