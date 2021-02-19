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


 
Route::get('/login', function () {
    //Session::flash('message', 'This is a message!'); 
    //Session::flash('alert-class', 'alert-danger'); 
    return view('pages.auth.login');
})->middleware('CheckLayoutKey')->name('login');

Route::post('/login', function () {
    echo "ok";
})->name('login');