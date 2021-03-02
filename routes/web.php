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
Route::get('api/categories', 'CategoryController@index');
Route::get('/api/popular-posts', 'PostController@getPopularPosts');
Route::get('/api/recent-posts', 'PostController@getRecentPosts');
Route::get('/api/featured-posts', 'PostController@getFeaturedPosts');

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
    //Posts
    Route::resource('/posts', "PostController");
    Route::get('/my-posts', "PostController@getUserPosts");

    //Users
    Route::resource('/users', "UserController");
    Route::get('/related-posts/{post}', "PostController@getRelatedPosts");


    //Categories
    //Comments
//    Route::post('/posts/add-comment/{post}', 'PostController@addComment');
    Route::get('/comments', 'CommentController@index');
    Route::post('/comments', 'CommentController@store');
});

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
