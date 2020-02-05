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

Route::middleware(['web', 'auth'])->group(function () {
    Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function () {
        Route::resource('articles', 'ArticleController')->except([
            'create', 'edit'
        ]);
        Route::resource('users', 'UserController')->except([
            'create', 'edit'
        ]);
    });
});
