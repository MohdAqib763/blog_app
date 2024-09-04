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



Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});

Route::post('/login_user','UserController@LoginUser');
Route::get('/logout','UserController@Logout');

Route::post('/register_user','UserController@Register');


Route::group(['middleware' => 'authcheck'], function () {

    //any route here will only be accessible for logged in users

Route::post('/save_post','UserController@SavePost');
Route::post('/update_post','UserController@UpdatePost');
Route::get('/view_post/{id}','UserController@ViewPost');
Route::get('/edit_post/{id}','UserController@EditPost');
Route::get('/delete_post/{id}','UserController@DeletePost');


Route::get('/create_post','UserController@PostPage');

});

Route::get('create_post', ['middleware' => 'authcheck', function () {
    return view('create_post');
}]);
Route::get('/', ['middleware' => 'authcheck', function () {
    return view('home');
}]);

Route::post('/verify_email','UserController@EmailVerification');

//  });