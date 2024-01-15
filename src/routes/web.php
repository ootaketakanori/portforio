<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\WorkController;

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

Route::get('/register', [RegisteredUserController::class, 'create']);

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/authenticated', [AuthenticatedSessionController::class, 'create'])->middleware('auth');

Route::post('/authenticated', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::get('/authenticated', [AuthenticatedSessionController::class, 'store'])->middleware('auth');

Route::get('/', [WorkController::class, 'create'])->name('rest');

Route::post('/attendance', [WorkController::class, 'store']);



Route::get('/start-work', [WorkController::class, 'startWork'])->name('startWork');
Route::get('/end-work', [WorkController::class, 'endWork'])->name('endWork');;
Route::get('/start-break', [WorkController::class, 'startBreak'])->name('startBreak');
Route::get('/end-break', [WorkController::class, 'endBreak'])->name('endBreak');
Route::get('/next-page', function () {
    return view('work_time');
})->name('work.time');



Route::get('/attendance', [WorkController::class, 'index'])->name('attendance.index');
Route::get('/previous-page', [WorkController::class, 'previousPage'])->name('previousPage');
Route::get('/next-page', [WorkController::class, 'nextPage'])->name('nextPage');

Route::get('/attendance/search', [WorkController::class, 'search']);

//Route::get('dates/search', 'WorkController@search');

Route::get('/dates/search', 'WorkController@search')->name('dates.search');

// routes/web.php

Route::group(['middleware' => 'auth'], function () {
});


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
