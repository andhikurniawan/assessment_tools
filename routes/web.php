<?php

use App\Mail\TrainingRecommendationMail;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

Route::resource('jobTargets', 'JobTargetsController');

Route::resource('roles', 'rolesController');

Route::resource('users', 'UserController');



/*Modul Assessment*/
Route::get('/assessment', 'Assessment_SessionController@index');
Route::get('/search', 'Assessment_SessionController@search');
Route::resource('assessmentSessions', 'Assessment_SessionController');
Route::get('assessmentSessions/company/{id}', 'Assessment_SessionController@asCompany');
Route::post("sesi/update", "Assessment_SessionController@editAssessment")->name("updatesesi")->middleware("auth");
Route::post("sesi/deleteModel", "Assessment_SessionController@deleteModel")->name("updatedeleteModel")->middleware("auth");
Route::post("sesi/deleteParticipant", "Assessment_SessionController@deleteParticipant")->name("updatedeleteParticipant")->middleware("auth");
Route::post("sesi/insertModel", "Assessment_SessionController@insertModel")->name("updateinsertModel")->middleware("auth");
Route::post("sesi/insertParticipant", "Assessment_SessionController@insertParticipant")->name("updateinsertParticipant")->middleware("auth");
Route::resource('competencyModel', 'CompetencyModelsController');
Route::resource('companies', 'CompanyController');
Route::resource("participant", 'participantController');
Route::post("participant/detail", 'participantController@detail')->name("participant.detail");
Route::get("participant/detail/cari", 'participantController@cari')->name("participant.cari")->middleware("auth");
Route::get("participant/detail/cariId", 'participantController@cariId')->name("participant.cariId")->middleware("auth");
Route::post("finalize/save", "FinalizeController@save")->name("finalize.save");
Route::post("finalize/finalize", "FinalizeController@finalize")->name("finalize.finalize");
Route::get("finalize", "FinalizeController@index")->name("finalize");
Route::get("assessmentUser", "assessmentUserController@index")->name("assessmentUser")->middleware("auth");
Route::post("session", "sessionController@index")->name("session");
Route::post("session/simpan", "sessionController@simpan")->name("session.simpan");
Route::post("assessmentUser/detail", "assessmentUserController@detail")->name("assessmentUser.detail");
Route::get("result", "resultController@index")->name("result")->middleware("auth");
Route::get('result/company/{id}', 'resultController@empCompany');
Route::post("result/detail", "resultController@detail")->name("result.detail")->middleware("auth");
Route::post("result/detail/laporan", "resultController@laporan")->name("result/detail/laporan")->middleware("auth");
Route::get('/logout', 'HomeController@logout')->middleware('verified');
Route::get('assessmentSessions/calculate/{id_session}/{id_assessee}', 'Assessment_SessionController@calculateAssessment')->name('assessmentSessions.calculate');
Route::get('assessmentSessions/calculateSession/{id_session}', 'Assessment_SessionController@calculateAssessmentSession')->name('assessmentSessions.calculate');
Route::get('/assessmentSessions/{id}/doAssignment', 'Assessment_SessionController@doAssignment')->name('assessmentSession.doAssignment');
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
Route::get('/track-record/company/{id}', 'TrackRecordController@getPeriodCompany')->name('getPeriodCompany');


Route::get('employee/company/{id}', 'UserController@empCompany');
Route::get('employee/create-admin', 'UserController@createAdmin');
Route::resource('employee', 'UserController');
//for testing
Route::get('/email', 'HomeController@email');


Route::resource('jobRequirements', 'JobRequirementController');

Route::resource('teams', 'TeamController');
// Route::get('/email', function() {
//     Mail::to('email@email.com')->send(new TrainingRecommendationMail());
//     return new TrainingRecommendationMail();
// });
Route::resource('company', 'CompanyController');
Route::resource('role', 'RoleController');


// Modul Profile Matching
Route::resource('competencyGroups', 'Competency_GroupController');
Route::resource('competencies', 'CompetencyController');
Route::resource('keyBehaviours', 'Key_BehaviourController');
Route::resource('competencyModels', 'Competency_ModelController');
Route::resource('gapAnalyses', 'Gap_AnalysisController');
Route::resource('company', 'CompanyController');
Route::resource('role', 'RoleController');

Route::resource('assignmentResults', 'AssignmentResultController');

Route::resource('assignmentHeaders', 'AssignmentHeaderController');
Route::get('competencyGroups/company/{id}', 'Competency_GroupController@empCompany');
Route::get('competency/company/{id}', 'CompetencyController@empCompany');
Route::get('competencyModels/company/{id}', 'Competency_ModelController@empCompany');
Route::resource('dashboardPms', 'dashboard_pmController');
Route::get('gap/company/{id}', 'Gap_AnalysisController@empCompany');
Route::post('gap/partisipan', 'Gap_AnalysisController@show')->name('gap.show')->middleware('auth');
Route::post("gap/partisipan/detail", "Gap_AnalysisController@gap")->name("gap/partisipan/detail")->middleware("auth");
Route::delete('/competencyModels/{competencyModel}/competencies/{competency}', 'CompetencyRelationController@destroy');
Route::post("/competencyModels/{Competency_id}/competency", "CompetencyRelationController@addCompetency")->name("addCompetency");

Route::get('/teams/duplicate/{id}', 'TeamController@duplicate')->name('teams.duplicate');
