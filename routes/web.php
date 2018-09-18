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

Route::get('/', function () {
    return view('welcome');
});

Route::get('threads/{channel}','ChannelController@index')->name('channel.index');
Route::resources(['threads' => 'ThreadController']);






Route::get('threads/{channel}/{thread}','ThreadController@show')->name('threads.show');

Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store')->name('replies.store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
