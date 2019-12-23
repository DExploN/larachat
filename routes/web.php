<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/chat/{room}', 'ChatController@index')->name('chat.index')->middleware('auth');
Route::get('/chat/{room}/message', 'ChatController@messages')->name('chat.messages')->middleware('auth');
Route::post('/chat/{room}', 'ChatController@store')->name('chat.store')->middleware('auth');

Route::get('/rooms', 'RoomController@index')->name('rooms.index');
Route::post('/rooms', 'RoomController@store')->name('rooms.store');


Route::post('/rooms/{room}/invite', 'RoomController@storeInvite')->name('invites.store');
Route::get('/invites', 'RoomController@invites')->name('invites.index');
Route::delete('/rooms/{room}/invite', 'RoomController@deleteInvite')->name('invites.delete');
