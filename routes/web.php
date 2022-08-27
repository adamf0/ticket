<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TicketsController;
// use App\Http\Controllers\ChatsController;
// use App\Http\Controllers\ProgressController;
// use App\Http\Controllers\PicMemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyTicketController;
use App\Http\Controllers\FormTicketController;
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

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');

Route::get('/my-ticket', [MyTicketController::class,'index'])->name('my-ticket.index');
Route::get('/my-ticket/detail/{id}', function($id){
    echo $id;
})->name('my-ticket.detail');
Route::get('/my-ticket/close/{id}', [FormTicketController::class,'destroy'])->name('my-ticket.destroy');

Route::get('/form-ticket/{type}', [FormTicketController::class,'index'])->name('form-ticket.index');
Route::post('/form-ticket/create', [FormTicketController::class,'create'])->name('form-ticket.create');

// Route::get('/tickets', [TicketsController::class,'index'])->name('ticket.index');
// Route::get('/tickets/detail/{id}', [TicketsController::class,'detail'])->name('ticket.detail');
// Route::get('/tickets/add', [TicketsController::class,'add'])->name('ticket.add');

// Route::post('/tickets/chat/{id}', [ChatsController::class,'create'])->name('ticket.chat.create');
// Route::post('/tickets/progress/{id}', [ProgressController::class,'create'])->name('ticket.progress.create');
// Route::post('/tickets/pic_member/{id}', [PicMemberController::class,'create'])->name('ticket.pic_member.create');