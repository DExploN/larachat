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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


Route::prefix("/rooms")->name("rooms.")->middleware('auth')->group(function () {
    Route::get('/', 'RoomController@index')->name('index');
    Route::post('/', 'RoomController@store')->name('store');
    Route::get('/{room}', 'RoomController@show')->name('show');
    Route::delete('/{room}', 'RoomController@logout')->name('logout');

    Route::post('/{room}', 'RoomController@storeMessage')->name('messages.store');
    Route::get('/{room}/message', 'RoomController@messages')->name('messages.index');

    Route::post('/{room}/invite', 'RoomController@storeInvite')->name('invites.store');
    Route::get('/invites', 'RoomController@invites')->name('invites.index');
    Route::delete('/{room}/invite', 'RoomController@deleteInvite')->name('invites.delete');
});

