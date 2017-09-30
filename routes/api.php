<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\UserController@login')->name('login');
Route::post('/register', 'Api\UserController@register')->name('register');
Route::post('/edit_account', 'Api\UserController@edit_account')->name('edit_account');
Route::post('/update_account', 'Api\UserController@update_account')->name('update_account');

Route::post('/getHomePage', 'Api\IklanController@getHomePage')->name('getHomePage');
Route::post('/getCategory', 'Api\IklanController@getCategory')->name('getCategory');
Route::post('/saveIklan', 'Api\IklanController@saveIklan')->name('saveIklan');
Route::post('/getIklan', 'Api\IklanController@getIklan')->name('getIklan');
Route::post('/saveGambarIklan', 'Api\IklanController@saveGambarIklan')->name('saveGambarIklan');
Route::post('/deleteIklan', 'Api\IklanController@deleteIklan')->name('deleteIklan');
Route::post('/detailIklan', 'Api\IklanController@detailIklan')->name('detailIklan');