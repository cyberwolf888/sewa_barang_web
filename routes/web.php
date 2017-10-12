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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin-access'], 'as'=>'admin'], function() {

    //Dashboard
    Route::get('/', 'Admin\DashboardController@index')->name('.dashboard');

    //Category
    Route::group(['prefix' => 'category', 'middleware' => ['auth','role:admin-access'], 'as'=>'.category'], function() {
        Route::get('/', 'Admin\CategoryController@index')->name('.manage');
        Route::get('/create', 'Admin\CategoryController@create')->name('.create');
        Route::post('/store', 'Admin\CategoryController@store')->name('.store');
        Route::get('/edit/{id}', 'Admin\CategoryController@edit')->name('.edit');
        Route::post('/update/{id}', 'Admin\CategoryController@update')->name('.update');
    });

    //Iklan
    Route::group(['prefix' => 'iklan', 'middleware' => ['auth','role:admin-access'], 'as'=>'.iklan'], function() {
        Route::get('/', 'Admin\IklanController@index')->name('.manage');
        Route::get('/detail/{id}', 'Admin\IklanController@show')->name('.detail');
        Route::get('/enable/{id}', 'Admin\IklanController@enable')->name('.enable');
        Route::get('/disable/{id}', 'Admin\IklanController@disable')->name('.disable');
    });

    //User
    Route::group(['prefix' => 'user', 'middleware' => ['auth','role:admin-access'], 'as'=>'.user'], function() {

        //Admin
        Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin-access'], 'as'=>'.admin'], function() {
            Route::get('/', 'Admin\UserController@admin')->name('.manage');
            Route::get('/create', 'Admin\UserController@create_admin')->name('.create');
            Route::post('/store', 'Admin\UserController@store_admin')->name('.store');
            Route::get('/edit/{id}', 'Admin\UserController@edit_admin')->name('.edit');
            Route::post('/update/{id}', 'Admin\UserController@update_admin')->name('.update');
            Route::get('/detail/{id}', 'Admin\UserController@show_admin')->name('.detail');
        });

        //Member
        Route::group(['prefix' => 'member', 'middleware' => ['auth','role:admin-access'], 'as'=>'.member'], function() {
            Route::get('/', 'Admin\UserController@member')->name('.manage');
            Route::get('/create', 'Admin\UserController@create_member')->name('.create');
            Route::post('/store', 'Admin\UserController@store_member')->name('.store');
            Route::get('/edit/{id}', 'Admin\UserController@edit_member')->name('.edit');
            Route::post('/update/{id}', 'Admin\UserController@update_member')->name('.update');
            Route::get('/detail/{id}', 'Admin\UserController@show_member')->name('.detail');
        });
    });

});
