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
        Route::get("products", "ProductController@index")->name("product.list");
        Route::get("products/new", "ProductController@newPage")->name("product.new");
        Route::post("products/new", "ProductController@save")->name("product.new");
        Route::get("products/{id}/remove", "ProductController@remove")->name("product.remove");
        Route::get("products/{id}/edit", "ProductController@edit")->name("product.edit.page");
        Route::post("products/{id}/edit", "ProductController@update")->name("product.edit");


        Route::get("categories", "CategoryController@index")->name("category.list");
        Route::get("categories/new", "CategoryController@newPage")->name("category.new");
        Route::post("categories/new", "CategoryController@save")->name("category.new");
        Route::get("categories/{id}/edit", "CategoryController@edit")->name("category.edit.page");
        Route::post("categories/{id}/edit", "CategoryController@update")->name("category.edit");
        Route::get("categories/{id}/remove", "CategoryController@remove")->name("category.remove");

        Route::get("users", "UserController@index")->name("user.list");
        Route::post("users/new", "UserController@save")->name("user.new");
        Route::get("users/{id}/edit", "UserController@edit")->name("user.edit.page");
        Route::post("users/{id}/edit", "UserController@update")->name("user.edit");
        Route::get("users/new", "UserController@newPage")->name("user.new");
        Route::get("users/{id}/remove", "UserController@remove")->name("user.remove");
        Route::get('home', 'HomeController@index')->name('home');
    });

