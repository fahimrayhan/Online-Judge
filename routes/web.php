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

Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/login', 'Auth\RegisterController@index')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/', 'Profile\ProfileController@home')->name('home');
Route::get('/contests', 'Problem\ProblemListController@show')->name('contests');
Route::get('/problems', 'Problem\ProblemListController@show')->name('problems');
Route::get('/submissions', 'Problem\ProblemListController@show')->name('submissions');
Route::get('/ranklist', 'Problem\ProblemListController@show')->name('ranklist');
Route::get('/profile', 'Profile\ProfileController@show')->name('profile');
Route::get('/profile/info', 'Profile\ProfileController@info')->name('profile.info');

Route::get('/modal', function () {
    return view('includes.modal');
});

Route::get('/footer', function () {
    return view('includes.footer');
});

Route::get('/loginn', function () {
    return view('pages.auth.login');
})->middleware('CheckLayoutKey')->name('loginn');

Route::resource('problems','Problem\ProblemController');
