<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ChatsController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'user'], function(){
    Route::get('/ticket', [TicketsController::class,'index'])->name('ticket.index');
    Route::get('/ticket/detail/{id}', [TicketsController::class,'detail'])->name('ticket.detail');
    Route::get('/ticket/add', [TicketsController::class,'add'])->name('ticket.add');
    Route::post('/ticket/create', [TicketsController::class,'create'])->name('ticket.create');
    Route::get('/ticket/close/{id}', [TicketsController::class,'destroy'])->name('ticket.destroy');
    Route::post('/ticket/chat/{id}', [ChatsController::class,'create'])->name('ticket.chat.create');
});