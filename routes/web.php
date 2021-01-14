<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    $company = DB::table('company')->count('name');
        $employee = User::count('name');
        return view('welcome')->with([
            'company' => $company,
            'employee' => $employee
        ]);
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

/*Modul Assessment*/
Route::get('/assessment', 'Assessment_SessionController@index');
Route::get('/search', 'Assessment_SessionController@search');
Route::resource('assessmentSessions', 'Assessment_SessionController');
Route::post("assessmentSession/update", "assessmentSessionController@editAssessment")->name("assessmentSession/update")->middleware("auth");
Route::post("assessmentSession/deleteModel", "assessmentSessionController@deleteModel")->name("assessmentSession/deleteModel")->middleware("auth");
Route::post("assessmentSession/deleteParticipant", "assessmentSessionController@deleteParticipant")->name("assessmentSession/deleteParticipant")->middleware("auth");
Route::post("assessmentSession/insertModel", "assessmentSessionController@insertModel")->name("assessmentSession/insertModel")->middleware("auth");
Route::post("assessmentSession/insertParticipant", "assessmentSessionController@insertParticipant")->name("assessmentSession/insertParticipant")->middleware("auth");
Route::resource('competencyModels', 'CompetencyModelsController');
Route::resource('companies', 'CompanyController');
Route::resource("participant", 'participantController');
Route::post("participant/detail", 'participantController@detail')->name("participant.detail");
Route::get("participant/detail/cari", 'participantController@cari')->name("participant.cari")->middleware("auth");
Route::get("participant/detail/cariId", 'participantController@cariId')->name("participant.cariId")->middleware("auth");
Route::post("finalize/save", "FinalizeController@save")->name("finalize.save");
Route::get("finalize/finalize", "FinalizeController@finalize")->name("finalize.finalize");
Route::get("finalize", "FinalizeController@index")->name("finalize");
Route::get("assessmentUser", "assessmentUserController@index")->name("assessmentUser")->middleware("auth");
Route::post("session", "sessionController@index")->name("session");
Route::post("session/simpan", "sessionController@simpan")->name("session.simpan");
Route::post("assessmentUser/detail", "assessmentUserController@detail")->name("assessmentUser.detail");
Route::get("result", "resultController@index")->name("result")->middleware("auth");
Route::post("result/detail", "resultController@detail")->name("result.detail")->middleware("auth");
Route::post("result/detail/laporan", "resultController@laporan")->name("result/detail/laporan")->middleware("auth");
Route::get('/logout', 'HomeController@logout')->middleware('verified');
/*End Modul Assessment*/

Route::get('/training/dashboard', 'TrainingController@dashboard');
Route::get('/training/recommendation', 'TrainingController@recommendation');
Route::post('/training/recommendation/add', 'TrainingController@addRecommendation');
Route::get('/training/recommendation/details/{id}', 'TrainingController@detailRecommendation');
Route::get('/training/recommendation/edit/{id}', 'TrainingController@editRecommedation');
Route::put('/training/recommendation/editProcess', 'TrainingController@editRecommendationProcess');
Route::put('/training/recommendation/recommendation-verification/{id}', 'TrainingController@recommendationVerification');
Route::get('/training/master', 'TrainingController@master');
Route::get('/training/master/create', 'TrainingController@master_create');
Route::post('/training/master/competency', 'TrainingController@insert_competency');
Route::get('/training/details/{id}', 'TrainingController@getTrainingDetails')->name('getTrainingDetails');
Route::delete('/training/master/competency/{id}', 'TrainingController@delete_competency');
Route::resource('training', 'TrainingController');

Route::get('/track-record', 'TrackRecordController@index');
Route::put('/track-record/training-verification/{id}', 'TrackRecordController@trainingVerification');
Route::get('/track-record/employee/{id}', 'TrackRecordController@employeeDetail');
Route::get('/track-record/training/{id}', 'TrackRecordController@trackTrainingDetail');
Route::get('/track-record/training/edit/{id}', 'TrackRecordController@trackTrainingEdit');
Route::delete('/track-record/training/delete/{id}', 'TrackRecordController@trackTrainingDelete');
Route::put('/track-record/training/editProcess/{id}', 'TrackRecordController@trackTrainingEditProcess');
Route::get('/track-record/project/{id}', 'TrackRecordController@trackProjectDetail');
Route::get('/track-record/project/edit/{id}', 'TrackRecordController@trackProjectEdit');
Route::put('/track-record/project/editProcess/{id}', 'TrackRecordController@trackProjectEditProcess');
Route::delete('/track-record/project/delete/{id}', 'TrackRecordController@trackProjectDelete');
Route::post('/track-record/updatePeriod', 'TrackRecordController@updatePeriod');
Route::get('/track-record/insertTraining', 'TrackRecordController@insertTraining');
Route::get('/track-record/insertProject', 'TrackRecordController@insertProject');
Route::post('/track-record/insertTrainingProcess', 'TrackRecordController@insertTrainingProcess');
Route::post('/track-record/insertProjectProcess', 'TrackRecordController@insertProjectProcess');

Route::get('/employee', 'UserController@index');
//for testing
Route::get('/email', 'HomeController@email');
