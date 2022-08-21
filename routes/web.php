<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\PicMemberController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/dologin', [LoginController::class,'dologin'])->name('dologin');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

Route::get('/tickets', [TicketsController::class,'index'])->name('ticket.index');
Route::get('/tickets/detail/{id}', [TicketsController::class,'detail'])->name('ticket.detail');
Route::get('/tickets/add', [TicketsController::class,'add'])->name('ticket.add');
Route::post('/tickets/create', [TicketsController::class,'create'])->name('ticket.create');
Route::get('/tickets/close/{id}', [TicketsController::class,'destroy'])->name('ticket.destroy');
Route::post('/tickets/chat/{id}', [ChatsController::class,'create'])->name('ticket.chat.create');
Route::post('/tickets/progress/{id}', [ProgressController::class,'create'])->name('ticket.progress.create');
Route::post('/tickets/pic_member/{id}', [PicMemberController::class,'create'])->name('ticket.pic_member.create');

// Route::group(['prefix'=>'admin'], function(){
//     Route::get('/ticket', [TicketUsersController::class,'index'])->name('ticket_user.index');
//     Route::get('/ticket/detail/{id}', [TicketUsersController::class,'detail'])->name('ticket_user.detail');
// });