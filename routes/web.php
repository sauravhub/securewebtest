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
Route::get('/home', 'ProductController@store');
  Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


     Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
     Route::get('/register', 'Auth\RegistersController@create')->name('admin.register');
     Route::post('/register', 'Auth\RegistersController@create')->name('admin.register');
     Route::get('/', 'AdminController@index')->name('admin.dashboard');

     Route::post('/store', 'AdminController@store')->name('admin.store');
    // RRoute::get('/view-hr-requests', 'HrRequestController@index');


  });