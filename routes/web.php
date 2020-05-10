<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input as input;

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


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/p/create', 'LabsController@create');

Route::post('/p', 'LabsController@store');

Route::get('/','LabsController@index');

Route::resource('/d', 'LabsController');

Route::resource('labs', 'LabsController');

Route::get('/map', 'MapController@index');

Route::post('/search','SearchController@Search');

Route::get('/searchResults','LabsController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
