<?php

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
//
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/current', 'UserController@currentUser');

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
    //Posts
    Route::resource('/posts', "PostController");
    Route::get('/my-posts', "PostController@getUserPosts");

    //Users
    Route::resource('/users', "UserController");


    //Categories
    Route::get('categories', 'CategoryController@index');
    //Comments
});

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
