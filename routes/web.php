<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');
Route::get('/logout', 'HomeController@logout')->middleware('verified');
Route::get('/training/dashboard', 'TrainingController@dashboard');
Route::get('/training/recommendation', 'TrainingController@recommendation');
Route::post('/training/recommendation/add', 'TrainingController@addRecommendation');
Route::get('/training/recommendation/details/{id}', 'TrainingController@detailRecommendation');
Route::get('/training/recommendation/edit/{id}', 'TrainingController@editRecommedation');
Route::put('/training/recommendation/editProcess', 'TrainingController@editRecommendationProcess');
Route::get('/training/master', 'TrainingController@master');
Route::get('/training/master/create', 'TrainingController@master_create');
Route::post('/training/master/competency', 'TrainingController@insert_competency');
Route::get('/training/details/{id}', 'TrainingController@getTrainingDetails')->name('getTrainingDetails');
Route::delete('/training/master/competency/{id}', 'TrainingController@delete_competency');
Route::resource('training', 'TrainingController');