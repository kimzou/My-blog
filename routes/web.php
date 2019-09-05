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

Auth::routes([
    'register' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('inscription', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('guest');
Route::post('inscription', 'Auth\RegisterController@register')->name('register')->middleware('guest');

Route::name('user.')->middleware('auth')->group(function() {
    Route::get('user/{id}/edit', 'UserController@edit')->name('edit');
    Route::put('user/{id}/edit', 'UserController@update')->name('update');
    Route::delete('user/{id}', 'UserController@destroy')->name('destroy');
});

Route::get('billet', 'PostController@index')->name('post.index');
Route::get('billet/{id}', 'PostController@show')->where(['id' => '[0-9]+'])->name('post.show');

Route::get('search/{keyword}', 'SearchController@results')->name('search.results');
Route::post('search', 'SearchController@searchPost')->name('search.posts');
Route::get('billet/{id}/search/{keyword}', 'SearchController@highlight')->name('highlight');

Route::name('post.')->middleware(['auth', 'blogger'])->group(function() {
    Route::get('billet/new', 'PostController@create')->name('create');
    Route::post('billet/new', 'PostController@store')->name('store');
    Route::get('billet/{id}/edit', 'PostController@edit')->name('edit');
    Route::put('billet/{id}/edit', 'PostController@update')->name('update');
    Route::get('billet/my-posts', 'PostController@editMyPosts')->name('editMyPosts');
    Route::delete('billet/{id}/delete', 'PostController@destroy')->name('delete');
});

Route::post('billet/{id}', 'CommentController@store')->middleware('auth')->name('comment.store');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('', 'AdminController@home')->name('admin.home');
    Route::get('users', 'AdminController@users')->name('admin.users');
    Route::get('posts', 'AdminController@posts')->name('admin.posts');
    Route::get('comments', 'AdminController@comments')->name('admin.comments');
    Route::get('user/{id}', 'AdminController@showUser')->name('admin.showUser');
    Route::delete('delete/{id}', 'AdminController@softDelete')->name('admin.softDelete');
});

Route::get('contact', 'ContactController@contact')->middleware('auth')->name('contact');
Route::post('contact', 'ContactController@mail')->middleware('auth')->name('contact.mail');

