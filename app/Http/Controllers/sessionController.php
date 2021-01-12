<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use stdClass;
use Auth;

class sessionController extends Controller
{
    public function index(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "user")
        {
            $model = $request->models;
            $assesse = $request->assesse;
            $session = $request->session;
            $relation = $request->relation;

            $questionss = [];
            $models = [];        
        
            for($i = 0; $i < count($model); $i++)
            {
                $question = DB::table("competency_relation")
                        ->join("competency", "competency.id", "=", "competency_relation.competency_id")
                        ->where("competency_relation.competency_models_id", $model[$i])
                        ->get();

                array_push($questionss, $question);
            }

            //dd($questionss);

            for($i = 0; $i < count($model); $i++)
            {
                $get_model = DB::table("competency_models")
                            ->where("id", $model[$i])
                            ->select("name", "id")
                            ->first();

                array_push($models, $get_model);
            }
            
            for($i = 0; $i < count($questionss); $i++)
            {   
                for($j = 0; $j < count($questionss[$i]); $j++)
                {
                    $key_behaviour = DB::table("key_behaviour")
                                        ->where("competency_id", $questionss[$i][$j]->competency_id)
                                        ->get();
                    
                    $questionss[$i][$j]->key_behaviour = $key_behaviour;
                }
            }

            //dd($questionss);

            return view("session.index", compact("models", "questionss", "assesse", "session", "relation"));
        }
        else if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
            return redirect("home");
        }
     
    }

    public function simpan(Request $request)
    {   
        
        $models = $request->models;
        $assesse = $request->assesse;
        $session = $request->session;
        $relation = $request->relation;

        $map = DB::table("assessor_map")
                    ->where("userid_assessor", Auth::user()->id)
                    ->where("userid_assessee", $assesse)
                    ->where("session_id", $session)
                    ->where("relation", $relation)
                    ->select("id")
                    ->first();

        $details = [];
    
        for($i = 0; $i < count($models); $i++)
        {
            $competency = DB::table("competency_relation")
                            ->where("competency_models_id", $models[$i])
                            ->select("competency_id")
                            ->get();

            $detail = new stdClass();
            $detail->question_count = count($competency);
            $detail->model_id = $models[$i];

            array_push($details, $detail);
        }

        for($i = 0; $i < count($details); $i++)
        {
            for($j = 0; $j < $details[$i]->question_count; $j++)
            {
                $answer = request($details[$i]->model_id . "-" . $j);

                $answer = explode("-", $answer);

                $id = DB::table("assessor_answer")->insert(["map_id" => $map->id, "competency_id" => $answer[0], "behaviour_level" => $answer[1], "userid_assessee" => $assesse, "userid_assessor" => Auth::user()->id]);
            }
        }
        
        DB::table("assessor_map")
            ->where("id", $map->id)
            ->limit(1)
            ->update(["status" => "done"]);

        $maps = DB::table("assessor_map")
                    ->where("session_id", $session)
                    ->get();

        $not_finished = 0;

        for($i = 0; $i < count($maps); $i++)
        {
            if($maps[$i]->status != "done")
            {
                $not_finished += 1;
            }
        }

        //dd($not_finished);

        if($not_finished == 0)
        {
            DB::table("assessment_session")
                    ->where("id", $session)
                    ->limit(1)
                    ->update(["status" => "finished"]);
        }

        return redirect("/assessmentUser");
    }
}
