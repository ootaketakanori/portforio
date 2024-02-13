<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/rest', [WorkController::class, 'create'])->name('rest');




Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');

Route::post('/attendance', [WorkController::class, 'store']);


Route::get('/start-work', [WorkController::class, 'startWork'])->name('startWork')->middleware('auth');
Route::post('/end-work', [WorkController::class, 'endWork'])->name('endWork');
Route::post('/start-break', [WorkController::class, 'startBreak'])->name('startBreak');
Route::post('/end-break', [WorkController::class, 'endBreak'])->name('endBreak');
Route::get('/next-page', function () {
    return view('work_time');
})->name('work.time');


Route::get('/attendance', [WorkController::class, 'index'])->name('attendance.index');
Route::get('/previous-page', [WorkController::class, 'previousPage'])->name('previousPage');
Route::get('/next-page', [WorkController::class, 'nextPage'])->name('nextPage');

Route::get('/attendance/search', [WorkController::class, 'search']);

Route::get('/dates/search', 'WorkController@search')->name('dates.search');



Route::get('/attendance-day', [WorkController::class, 'index'])->name('attendance.index');



//ログアウト

//1/24 16:30修正(ログイン)
Route::get('/login', [AuthController::class, 'loginView']);

//1/25 16:10 打刻画面（ホーム）
//Route::get('/', [AuthController::class, 'rest']);

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'rest']);
});

//休憩開始、休憩終了2/5
Route::post('/start-break', [WorkController::class, 'startBreak'])->name('startBreak');
Route::post('/end-brek', [WorkController::class, 'endBrerk']);
