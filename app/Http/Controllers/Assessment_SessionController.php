<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssessment_SessionRequest;
use App\Http\Requests\UpdateAssessment_SessionRequest;
use App\Repositories\Assessment_SessionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\CompetencyModels;
use Flash;
use Response;
use DB;
use Session;
use App\Models\Company;
use App\Models\Assessment_Session;
use App\Models\AssessmentSession;
use Auth;
use stdClass;
use App\User;

class Assessment_SessionController extends AppBaseController
{
    /** @var  Assessment_SessionRepository */
    private $assessmentSessionRepository;

    public function __construct(Assessment_SessionRepository $assessmentSessionRepo)
    {
        $this->assessmentSessionRepository = $assessmentSessionRepo;
    }

    /**
     * Display a listing of the Assessment_Session.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "superadmin" || $role->role_id == "admin" || $role->role_id == "admin_ap")
        {
            $assessmentSessions = DB::table("assessment_session")
            ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')->get(); 

        $company_id = Auth::user()->company_id;
        if ($company_id == null) {
            $company = Company::all();
            $assessmentSessions = DB::table("assessment_session")
            ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')->get(); 
            $assessment_finished = DB::table('assessment_session')->select('status')->where('status','finished')->count();
            $assessment_notStarted = DB::table('assessment_session')->select('status')->where('status','not_started')->count();
            $assessment_open = DB::table('assessment_session')->select('status')->where('status','open')->count();
            $assessment_all = DB::table('assessment_session')->count();
            $selected = "";
        } else {
            $company = Company::where('id', $company_id)->get()->first();
            $assessmentSessions = DB::table("assessment_session")
            ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')
            ->where("company_id",$company_id)->get(); 
            $assessment_finished = DB::table('assessment_session')->select('status')->where('status','finished')->where('company_id',$company_id)->count();
            $assessment_notStarted = DB::table('assessment_session')->select('status')->where('status','not_started')->where('company_id',$company_id)->count();
            $assessment_open = DB::table('assessment_session')->select('status')->where('status','open')->where('company_id',$company_id)->count();
            $assessment_all = DB::table('assessment_session')->where('company_id',$company_id)->count();
            $selected = $company->id;
        }
        
        return view('assessment__sessions.index', compact("company","selected","assessment_finished","assessment_notStarted","assessment_open","assessment_all"))
            ->with('assessmentSessions', $assessmentSessions);
        }
        else if($role->role_id == "user")
        {
            return redirect("assessmentUser");
        }
    }


    public function search(Request $request){
        $search=$request->get('search');
        $assessmentSessions = DB::table("assessment_session")->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('assessment__sessions.index')
        ->with('assessmentSessions', $assessmentSessions);
    }

    /**
     * Show the form for creating a new Assessment_Session.
     *
     * @return Response
     */
    public function create()
    {
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $company = Company::all();
        } else {
            $company = Company::where('id', $user_company)->get();
        }
        // $company = Company::pluck('name','id');
        return view('assessment__sessions.create', compact("company"));
    }

    /**
     * Store a newly created Assessment_Session in storage.
     *
     * @param CreateAssessment_SessionRequest $request
     *
     * @return Response
     */
    public function store(CreateAssessment_SessionRequest $request)
    {
        $input = $request->all();

        // $assessmentSession = $this->assessmentSessionRepository->create($input);

        // Flash::success('Assessment  Session saved successfully.');

        $assesment = new Assessment_Session([
            "name" => $request->name,
            "category" => $request->category,
            "status" => $request->status,
            "expired" => $request->expired,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "company_id" => $request->company_id
        ]);

        session(["assesment" => $assesment]);

        return redirect(route('competencyModel.create'));

        // return redirect(route('assessmentSessions.addCompetencyModel'));
    }

    /**
     * Display the specified Assessment_Session.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $session = $this->assessmentSessionRepository->find($id);

        $models = DB::table("assessment_relation")
                    ->join("competency_models", "competency_models.id", "=", "assessment_relation.competency_models_id")
                    ->where("assessment_relation.assessment_session_id", $id)
                    ->get();
        
        $participant = DB::table("assessor_map")
                        ->where("session_id", $id)
                        ->get();
        
        $assignment = DB::table("assignment_headers")
                        ->where("assessment_session_id", $id)
                        ->get();

        $assesse = [];

        for($i = 0; $i < count($participant); $i++)
        {
            array_push($assesse, $participant[$i]->userid_assessee);
        }

        $assesse = array_unique($assesse);
        $assesse = array_values($assesse);

        $participants = [];

        for($i = 0; $i < count($assesse); $i++)
        {   
            $detail = new stdClass();
            $detail->id = $assesse[$i];

            $assese = DB::table("user")->where("id", $assesse[$i])->first();

            $detail->name = $assese->name;
            $detail->email = $assese->email;

            $detail->assessor = [];
            
            for($j = 0; $j < count($participant); $j++)
            {
                if($participant[$j]->userid_assessee == $assesse[$i])
                {   
                    $assessor = new stdClass();
                    $assessor->id = $participant[$j]->userid_assessor;
                    
                    $assesor = DB::table("user")->where("id", $participant[$j]->userid_assessor)->first();

                    $assessor->name = $assesor->name;
                    $assessor->email = $assesor->email;
                    $assessor->status = $participant[$j]->status;
                    $assessor->relation = $participant[$j]->relation;

                    array_push($detail->assessor, $assessor);
                }
            }

            array_push($participants, $detail);
        }



        if (empty($session)) {
            Flash::error('Assessment Session not found');

            return redirect(route('assessmentSessions.index'));
        }

        

        return view('assessment__sessions.show', compact("session", "models", "participants", "assignment"));
    }

    /**
     * Show the form for editing the specified Assessment_Session.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
       $assessmentSession = DB::table("assessment_session")
                            ->where("id", $id)
                            ->first();

        $assessmentId = $id;

        $models = DB::table("assessment_relation")
                    ->join("competency_models", "competency_models.id", "=", "assessment_relation.competency_models_id")
                    ->where("assessment_session_id", $id)
                    ->get();

        $participant = DB::table("assessor_map")
                    ->where("session_id", $id)
                    ->get();
    
        $assesse = [];

        for($i = 0; $i < count($participant); $i++)
        {
            array_push($assesse, $participant[$i]->userid_assessee);
        }

        $assesse = array_unique($assesse);

        $assesse = array_values($assesse);

        $participants = [];

        for($i = 0; $i < count($assesse); $i++)
        {   
            $detail = new stdClass();
            $detail->id = $assesse[$i];

            $assese = DB::table("user")->where("id", $assesse[$i])->first();
            $detail->name = $assese->name;
            $detail->email = $assese->email;

            $detail->assessor = [];
            
            for($j = 0; $j < count($participant); $j++)
            {
                if($participant[$j]->userid_assessee == $assesse[$i])
                {   
                    $assessor = new stdClass();
                    $assessor->id = $participant[$j]->userid_assessor;
                    
                    $assesor = DB::table("user")->where("id", $participant[$j]->userid_assessor)->first();

                    $assessor->name = $assesor->name;
                    $assessor->email = $assesor->email;
                    $assessor->status = $participant[$j]->status;
                    $assessor->relation = $participant[$j]->relation;
                    $assessor->assessor_map = $participant[$j]->id;

                    array_push($detail->assessor, $assessor);
                }
            }

            array_push($participants, $detail);
        }
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $modelss = CompetencyModels::All();
            $id = DB::table('user')->select("employee_id")->get();
        } else {
            $modelss = CompetencyModels::where('company_id', $user_company)->get();
            $id = DB::table('user')->select("employee_id")->where('company_id', $user_company)->get();
        }

      

        return view('assessment__sessions.edit', compact("assessmentSession", "models", "participants", "modelss", "id", "assessmentId"));
    }

    
    public function editAssessment(Request $request)
    { 
        $id = $request->id;
        $assessment = $request->assessment;

        $update = DB::table("assessment_session")
            ->where("id", $id)
            ->update(["name" => $assessment["name"], "category" => $assessment["category"], 
                        "status" => $assessment["status"], "expired" => $assessment["expired"], 
                        "start_date" => date("Y-m-d", strtotime($assessment["start_date"])), 
                        "end_date" => date("Y-m-d", strtotime($assessment["end_date"]))]);
            
        return response()->json("0");
    }

    public function deleteModel(Request $request)
    {
        $deleted_models = $request->deleted_models;
        $id = $request->id;
        
        for($i = 0; $i < count($deleted_models); $i++)
        {
            DB::table("assessment_relation")
                ->where("assessment_session_id", $id)
                ->where("competency_models_id", $deleted_models[$i])
                ->delete();
        }

        return response()->json("0");
    }

    public function insertModel(Request $request)
    {
        $add_models = $request->add_models;
        $id = $request->id;
        
        for($i = 0; $i < count($add_models); $i++)
        {
            DB::table("assessment_relation")->insert(["assessment_session_id"=>$id, "competency_models_id" => $add_models[$i]]);
        }

        return response()->json("0");
    }

    public function deleteParticipant(Request $request)
    {
        $deleted_participants = $request->deleted_participants;
        $id = $request->id;
        
        for($i = 0; $i < count($deleted_participants); $i++)
        {
            DB::table("assessor_map")
                ->where("id", $deleted_participants[$i])
                ->delete();
        }

        return response()->json("0");
    }

    public function insertParticipant(Request $request)
    {
        $add_participants = $request->add_participants;
        $id = $request->id;
        $ids = $request->ids;
        $idss = $request->idss;
        $company_id = $request->company_id;

        $insert = DB::table("assessor_map")->insert(["session_id" => $id, "userid_assessor" => $ids, "userid_assessee" => $idss, "status" => $add_participants["status"], "company_id" => $company_id, "relation" => $add_participants["relation"]]);

        return response()->json("0");
    }

    function standardDeviasi($arr) 
    { 
        $num_of_elements = count($arr); 
          
        $variance = 0.0; 
          
                // calculating mean using array_sum() method 
        $average = array_sum($arr)/$num_of_elements; 
          
        foreach($arr as $i) 
        { 
            // sum of squares of differences between  
                        // all numbers and means. 
            $variance += pow(($i - $average), 2); 
        } 
          
        return (float)sqrt($variance/$num_of_elements); 
    }

    function median($arr,$count,$index){
        if($count>0){
            if($count & 1){
                $median = $arr[$index];
            }else{
                $median = (($arr[$index-1]+$arr[$index])/2);
            }
        }else{
            $median = 0;
        }

        return $median;
    }


    public function calculateAssessment($id_session,$id_assessee)
    {
        //getAmount of Users Assessee
        $getAssessees = DB::table('assessor_map')->select('userid_assessee')->where('session_id','=',$id_session)
        ->where('userid_assessee','=', $id_assessee)
        ->distinct()->get();
        foreach ($getAssessees as $assessee) {
            //getAnswer all competency
            $getAnswers = DB::table('assessor_map')
                            ->join('assessor_answer','assessor_map.id','=','assessor_answer.map_id')
                            ->select('assessor_answer.behaviour_level','assessor_answer.competency_id')
                            ->where('assessor_answer.userid_assessee','=',$assessee->userid_assessee)
                            ->orderBy('behaviour_level','asc')
                            ->get();
            //getCompetencies
            $getCompetencies = DB::table('assessor_map')
                            ->join('assessor_answer','assessor_map.id','=','assessor_answer.map_id')
                            ->select('assessor_answer.competency_id')
                            ->where('assessor_answer.userid_assessee','=',$assessee->userid_assessee)
                            ->distinct()->get();

            foreach ($getCompetencies as $competency) {
                //filterAnswer by competency_id
                $filterAnswers = $getAnswers->where('competency_id','=',$competency->competency_id)->pluck('behaviour_level')->all();
                $count = count($filterAnswers);
                $index = floor($count/2);

                //getModus
                $values = array_count_values($filterAnswers); 
                $modus = array_search(max($values), $values);

                //getAverage
                $average = array_sum($filterAnswers)/$count;

                //get Min & Max
                $min = $filterAnswers[0];
                $max = $filterAnswers[($count-1)];

                //getMedian
                $median = $this->median($filterAnswers,$count,$index);

                //standart Deviasi
                $std = $this->standardDeviasi($filterAnswers);

                //get Q1 & Q3
                if($count > 1){
                    $q1Array = array_slice($filterAnswers, 0, $index);
                    $q3Array = array_slice($filterAnswers, $index+1, $count-1);
                    $q1 = $this->median($q1Array,count($q1Array),floor(count($q1Array)/2));
                    $q3 = $this->median($q3Array,count($q3Array),floor(count($q3Array)/2));
                }else if($count == 1){
                    $q1 = $filterAnswers[$count-1];
                    $q3 = $filterAnswers[$count-1];
                }else{
                    $q1 = null;
                    $q3 = null;
                }
                
                //insert competency result
                DB::table('assessment_competency_result')->insert([
                        'session_id' => $id_session,
                        'userid_assessee' => $assessee->userid_assessee,
                        'competency_id' => $competency->competency_id,
                        'min_level' => $min,
                        'max_level' => $max,
                        'median_level' => $median,
                        'average_level' => $average,
                        'modus_level' => $modus,
                        'std_dev' => $std,
                        'third_quartile' => $q3,
                        'first_quartile' => $q1
                    ]);
            }

        }
        Flash::success('Calculate Assessment successfully.');
        return redirect(route('assessmentSessions.index'));
    }
    
    public function calculateAssessmentSession($id_session)
    {
        //getAmount of Users Assessee
        $getAssessees = DB::table('assessor_map')->select('userid_assessee')->where('session_id','=',$id_session)->distinct()->get();
        foreach ($getAssessees as $assessee) {
            //getAnswer all competency
            $getAnswers = DB::table('assessor_map')
                            ->join('assessor_answer','assessor_map.id','=','assessor_answer.map_id')
                            ->select('assessor_answer.behaviour_level','assessor_answer.competency_id')
                            ->where('assessor_answer.userid_assessee','=',$assessee->userid_assessee)
                            ->orderBy('behaviour_level','asc')
                            ->get();
            //getCompetencies
            $getCompetencies = DB::table('assessor_map')
                            ->join('assessor_answer','assessor_map.id','=','assessor_answer.map_id')
                            ->select('assessor_answer.competency_id')
                            ->where('assessor_answer.userid_assessee','=',$assessee->userid_assessee)
                            ->distinct()->get();

            foreach ($getCompetencies as $competency) {
                //filterAnswer by competency_id
                $filterAnswers = $getAnswers->where('competency_id','=',$competency->competency_id)->pluck('behaviour_level')->all();
                $count = count($filterAnswers);
                $index = floor($count/2);

                //getModus
                $values = array_count_values($filterAnswers); 
                $modus = array_search(max($values), $values);

                //getAverage
                $average = array_sum($filterAnswers)/$count;

                //get Min & Max
                $min = $filterAnswers[0];
                $max = $filterAnswers[($count-1)];

                //getMedian
                $median = $this->median($filterAnswers,$count,$index);

                //standart Deviasi
                $std = $this->standardDeviasi($filterAnswers);

                //get Q1 & Q3
                if($count > 1){
                    $q1Array = array_slice($filterAnswers, 0, $index);
                    $q3Array = array_slice($filterAnswers, $index+1, $count-1);
                    $q1 = $this->median($q1Array,count($q1Array),floor(count($q1Array)/2));
                    $q3 = $this->median($q3Array,count($q3Array),floor(count($q3Array)/2));
                }else if($count == 1){
                    $q1 = $filterAnswers[$count-1];
                    $q3 = $filterAnswers[$count-1];
                }else{
                    $q1 = null;
                    $q3 = null;
                }
                
                //insert competency result
                DB::table('assessment_competency_result')->insert([
                        'session_id' => $id_session,
                        'userid_assessee' => $assessee->userid_assessee,
                        'competency_id' => $competency->competency_id,
                        'min_level' => $min,
                        'max_level' => $max,
                        'median_level' => $median,
                        'average_level' => $average,
                        'modus_level' => $modus,
                        'std_dev' => $std,
                        'third_quartile' => $q3,
                        'first_quartile' => $q1
                    ]);
            }

        }
        Flash::success('Calculate Assessment successfully.');
        return redirect(route('assessmentSessions.index'));
    }

    /**
     * Update the specified Assessment_Session in storage.
     *
     * @param int $id
     * @param UpdateAssessment_SessionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssessment_SessionRequest $request)
    {
        $assessmentSession = $this->assessmentSessionRepository->find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment  Session not found');

            return redirect(route('assessmentSessions.index'));
        }

        $assessmentSession = $this->assessmentSessionRepository->update($request->all(), $id);

        Flash::success('Assessment  Session updated successfully.');

        return redirect(route('assessmentSessions.index'));
    }

    /**
     * Remove the specified Assessment_Session from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assessmentSession = $this->assessmentSessionRepository->find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment Session not found');

            return redirect(route('assessmentSessions.index'));
        }

        DB::table("assessment_relation")->where("assessment_session_id", $id)->delete();
        DB::table("assessor_map")->where("session_id", $id)->delete();

        $this->assessmentSessionRepository->delete($id);

        Flash::success('Assessment Session deleted successfully.');

        DB::table("assessment_session")->where("id", $id)->delete();

        return redirect(route('assessmentSessions.index'));
    }

    public function asCompany($id)
    {
        $assessmentSessions = DB::table("assessment_session")
            ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')
            ->where("company_id",$id)->get(); 

        $assessment_finished = DB::table('assessment_session')->select('status')->where('status','finished')->where('company_id',$id)->count();
        $assessment_notStarted = DB::table('assessment_session')->select('status')->where('status','not_started')->where('company_id',$id)->count();
        $assessment_open = DB::table('assessment_session')->select('status')->where('status','open')->where('company_id',$id)->count();
        $assessment_all = DB::table('assessment_session')->where('company_id',$id)->count();
        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
        return view('assessment__sessions.index', compact('assessmentSessions', 'company', 'selected', 'assessment_finished','assessment_notStarted','assessment_open','assessment_all'));
    }

    public function doAssignment($id)
    {
        // $assessmentSession = $this->assessmentSessionRepository->find($id);
        $assessmentSession = AssessmentSession::find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment Session not found');

            return redirect(route('assessmentSessions.index'));
        }
        $headerId = $assessmentSession->doAssignment();
        if ($headerId>0)
            return redirect('/assignmentHeaders/'.$headerId);
        
    }
}
