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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::get('/assessment', 'Assessment_SessionController@index');

Route::get('/search', 'Assessment_SessionController@search');

Route::resource('assessmentSessions', 'Assessment_SessionController');

Route::resource('competencyModels', 'CompetencyModelsController');

Route::resource('companies', 'CompanyController');

Route::resource("participant", 'participantController');

Route::post("participant/detail", 'participantController@detail')->name("participant.detail");

Route::get("participant/detail/cari", 'participantController@cari')->name("participant.cari");

Route::post("finalize/save", "FinalizeController@save")->name("finalize.save");

Route::get("finalize/finalize", "FinalizeController@finalize")->name("finalize.finalize");

Route::get("finalize", "FinalizeController@index")->name("finalize");