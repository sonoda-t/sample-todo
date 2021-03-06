<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::group(['prefix' => '/'], function() {
  Route::get('/', function () {
    if (Auth::check()){
      return view('home');
    }else{
      return view('auth/login');
    };
  });

  Route::resource('files', 'FileController');
  Route::resource('todo', 'TodoController');
  Route::get('/home', 'HomeController@index');

});
