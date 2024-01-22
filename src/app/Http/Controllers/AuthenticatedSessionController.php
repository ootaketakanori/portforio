<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

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
        $request->authenticate();

        $request - session()->regenerate();

        return redirect()->intended('rest');
    }
}
