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

Route::prefix("admin")
    ->group(function() {
        Route::get("users", "UserController@index")->name("user.list");
        Route::post("users/new", "UserController@save")->name("user.new.post");
        Route::get("users/new", "UserController@newPage")->name("user.new");
        Route::get("users/{id}/remove", "UserController@remove")->name("user.remove");
        Route::get('home', 'HomeController@index')->name('home');
    });

