<?php

use App\Http\Controllers\FauxController;
use App\Http\Controllers\MonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tableau',[MonController::class, 'montrer'])->name('tableau');

Route::get('/faux',[MonController::class, 'faux'])->name('faux');

Route::get('/details/{CT_Num}', [MonController::class, 'details']);

Route::get('/time', [FauxController::class, 'time']);


