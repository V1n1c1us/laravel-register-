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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/getUser', 'HomeController@getUser');
Route::get('/dash', 'HomeController@dash');
Route::get('/main', 'HomeController@main');


Route::get('/user', ['as' => 'user.user','uses' => 'UserController@index']);
Route::get('/user/edit/{id}',['as' => 'user.edit','uses' => 'UserController@edit']);
Route::post('/user/update/{id}', 'UserController@update');
