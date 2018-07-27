<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('app');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::resource('products', 'ProductController');
});
// Angular HTML Templates
Route::group(array('prefix'=>'/htmltemplates/'),function(){
    Route::get('{htmltemplates}', array( function($htmltemplates)
    {
        $htmltemplates = str_replace(".html","",$htmltemplates);
        View::addExtension('html','php');
        return View::make('htmltemplates.'.$htmltemplates);
    }));
});