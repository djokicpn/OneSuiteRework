<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*');

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

});

Route::post('/product/store', 'Api\\PostController@store');

// Route::get('/api/get-categories',   'CategoryController@listAll');

// Route::get('/api/get-products',   'ProductController@listAll');

//Route::get('posts', 'Api\\PostController@index');
