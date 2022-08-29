<?php

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

Route::get('/', 'LoginController@index')->name('login');
Route::post('/dologin', 'LoginController@dologin')->name('dologin');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

Route::get('/my-ticket', 'MyTicketController@index')->name('my-ticket.index');
Route::get('/my-ticket/detail/{id}', 'DetailTicketController@index')->name('my-ticket.detail');
Route::get('/my-ticket/close/{id}', 'FormTicketController@destroy')->name('my-ticket.destroy');

Route::get('/form-ticket/{type}', 'FormTicketController@index')->name('form-ticket.index');
Route::post('/form-ticket/create', 'FormTicketController@create')->name('form-ticket.create');

Route::post('/pic-member/{id}', 'PicMemberController@create')->name('pic-member.create');
Route::post('/chat/{id}', 'ChatsController@create')->name('chat.create');
Route::post('/progress/{id}', 'ProgressController@create')->name('progress.create');

// Route::get('/tickets', [TicketsController::class,'index'])->name('ticket.index');
// Route::get('/tickets/detail/{id}', [TicketsController::class,'detail'])->name('ticket.detail');
// Route::get('/tickets/add', [TicketsController::class,'add'])->name('ticket.add');