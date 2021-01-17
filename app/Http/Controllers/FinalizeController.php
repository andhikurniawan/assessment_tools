<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompetencyModels;
use Session;
use DB;
use Auth;

class FinalizeController extends Controller
{
    function save(Request $request)
    {
        $data = $request->data;

        session(["participant" => $data]);

        return response()->json("0");
    }

    function index()
    {
        $assessmentSession = Session::get("assesment");
        $competencyModel = Session::get("competency");
        $participant = Session::get("participant");

        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $id = DB::table('user')->select("employee_id")->get();
        } else {
            $id = DB::table('user')->select("employee_id")->where('company_id', $user_company)->get();
        }

        $competency = explode(",", $competencyModel);
        $models = CompetencyModels::All();
        
        $model = [];

        //dd($participant);

        for($i = 0; $i < count($competency); $i++)
        {
            array_push($model, DB::table("competency_models")->select("name", "id")->where('id', $competency[$i])->first());
        }

        //  dd($participant);

        return view('finalize.index', ["id"=> $id, "session" => $assessmentSession, "competency" => $model, "participants" => $participant, "models" => $models]);
    }

    function finalize(Request $request)
    {   
        $session = $request->session;
        $model = $request->model;
        $participant = $request->participant;

        $id = DB::table("assessment_session")->insertGetId(["name" => $session["name"], "category" => $session["category"], "status" => $session["status"], "expired" => $session["expired"], "start_date" => $session["start_date"], "end_date" => $session["end_date"], "company_id" => $session["company_id"]]);

        for($i = 0; $i < count($model); $i++)
        {
            DB::table("assessment_relation")->insert(["assessment_session_id" => $id, "competency_models_id" => $model[$i]["id"]]);
        }

        for($i = 0; $i < count($participant); $i++)
        {   
            $id_assesse = DB::table('user')->select("id")->where("name", $participant[$i]["assesse"]["name"])->first();

            for($j = 0; $j < count($participant[$i]["assessor"]); $j++)
            {
                $id_assessor = DB::table("user")->select("id")->where("name", $participant[$i]["assessor"][$j]["name"])->first();

                DB::table("assessor_map")->insert(["userid_assessor" => $id_assessor->id, "userid_assessee" => $id_assesse->id, "session_id" => $id, "company_id" => $session["company_id"], "status" => $participant[$i]["assessor"][$j]["status"], "relation" => $participant[$i]["assessor"][$j]["relation"]]);
            }
        }   
        
        return response()->json("0");
    }
    
}
