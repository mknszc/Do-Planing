<?php

use App\Http\Controllers\AssignController;
use Illuminate\Support\Facades\Route;

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

Route::get('/assignTask', [AssignController::class, 'assignTask'])->name('assignTask');
Route::get('/index', [AssignController::class, 'index'])->name('index');


Route::get('/', function () {
    return view('welcome');
});
