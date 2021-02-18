<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use stdClass;

class assessmentUserController extends Controller
{
    public function index()
    {   
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "user")
        {
            $assessments = DB::table("assessor_map")
                    ->join("assessment_session", "assessment_session.id", "=", "assessor_map.session_id")
                    ->where("assessor_map.userid_assessor", $id)
                    ->orWhere(function($query){
                            $query->where("assessor_map.userid_assessee", Auth::user()->id) 
                                  ->where("assessor_map.userid_assessor", Auth::user()->id);               
                    })
                    ->distinct()        
                    ->select("assessment_session.*", "assessor_map.session_id")                        
                    ->get();    
        
            for($i = 0; $i < count($assessments); $i++)
            {
                $participants = DB::table("assessor_map")
                                ->where("session_id", $assessments[$i]->id)
                                ->get();
                $assesse = [];

                for($j = 0; $j < count($participants); $j++)
                {
                    array_push($assesse, $participants[$j]->userid_assessee);
                }

                $assesse = array_unique($assesse);
                $assesse = array_values($assesse);

                //dd($assesse);

                $participant_detail = [];

                $total = 0;
                $assessor = [];

                //dd($assessments[$i]->id);

                for($j = 0; $j < count($assesse); $j++)
                {   
                    for($k = 0; $k < count($participants); $k++)
                    {
                        if($assesse[$j] == $participants[$k]->userid_assessee)
                        {
                            array_push($assessor, $participants[$k]->userid_assessor);
                        }
                    }
                }

                $total += count($assessor);
                $total += count($assesse);

                $assessments[$i]->counts = $total; 
            }

            //dd($assessor);

            //dd($assessments);
                                                                
            return view("assessment_user.index", compact("assessments"));   
        }          
        else if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
            return redirect("home");
        }                                          
    }

    public function detail(Request $request)
    {   
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();
        
        if($role->role_id == "user")
        {

            $assessment = DB::table("assessment_session")
                            ->where("id", $request->id)
                            ->first();

            $participants = DB::table("assessor_map")
                            ->join("user", "user.id", "=", "assessor_map.userid_assessee")
                            ->where("assessor_map.session_id", $request->id)
                            ->get();

            $models = DB::table("assessment_relation")
                        ->join("competency_models", "competency_models.id", "=", "assessment_relation.competency_models_id")
                        ->where("assessment_relation.assessment_session_id", $request->id)
                        ->select("competency_models.id", "competency_models.name")
                        ->get();

            $id = Auth::user()->id;

            $assessee = [];
                   
            for($i = 0; $i < count($participants); $i++)
            {
                array_push($assessee, $participants[$i]->userid_assessee);
            }

            $assessee = array_unique($assessee);
            $assessee = array_values($assessee);

            $session = $participants[0]->session_id;

            //dd($participants);
            //dd($assessee);

            $assessees = [];

            for($i = 0; $i < count($assessee); $i++)
            {
                $detail = new stdClass();
                $detail->assessee = $assessee[$i];
                $detail->assessors = [];
                $found = "false";
                $index = 0;
                
                for($j = 0; $j < count($participants); $j++)
                {
                    if($assessee[$i] == $participants[$j]->userid_assessee)
                    {
                        $detail->name = $participants[$j]->name;
                        $detail->relation = $participants[$j]->relation;
                        $detail->email = $participants[$j]->email;

                        $index = $j;

                        array_push($detail->assessors, $participants[$j]->userid_assessor);
                    }

                    if($assessee[$i] == $participants[$j]->userid_assessee && Auth::user()->id == $participants[$j]->userid_assessor)
                    {
                        $detail->status = $participants[$j]->status; 
                        $found = "true";
                    }
                }

                if($found == "false")
                {
                    $detail->status = $participants[$index]->status;
                }

                array_push($assessees, $detail);
            }

            //dd($assessees);

            return view("assessment_user.detail", compact("assessment", "assessees", "models", "id", "session"));
        }
        else if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
            
            return redirect("home");
        }
    }
}
