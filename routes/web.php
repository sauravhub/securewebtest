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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'chat',  'middleware' => ['auth']], function() {
	Route::get('/', 'ChatsController@index')->name('chatindex');
	Route::get('/messages/{reciever}', 'ChatsController@fetchMessages');
	Route::get('/currentUserId', 'ChatsController@getCurrntuserdata');
	Route::get('/users', 'ChatsController@fetchusers');
	Route::get('/chattedusers', 'ChatsController@fetchchattingusers');
	Route::post('/messages', 'ChatsController@sendMessage');
	Route::post('/attachments', 'ChatsController@messageAttachments');
});