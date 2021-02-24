<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use stdClass;
use App\Models\Company;
class resultController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();
        
        if($role->role_id == "superadmin" || $role->role_id == "admin" || $role->role_id == "admin_ap")
        {
            $assessments = DB::table("assessment_session")->get();  

            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $company = Company::all();
                $assessments = DB::table("assessment_session")
                ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')->get(); 
                $selected = "";
            } else {
                $company = Company::where('id', $company_id)->get()->first();
                $assessments = DB::table("assessment_session")
                ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')
                ->where("company_id",$company_id)->get(); 
                $selected = $company->id;
            }
            
        
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

                $participant_detail = [];

                $total = 0;
                $assessor = [];

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


            return view('result.index_admin', compact("assessments","company","selected"));
        }
        else if($role->role_id == "user")
        {   
            $assessments = DB::table("assessor_map")
                    ->join("assessment_session", "assessment_session.id", "=", "assessor_map.session_id")
                    ->where("assessor_map.userid_assessee", Auth::user()->id)   
                    ->select("assessment_session.id")        
                    ->get();  

            $id = [];

            for($i = 0; $i < count($assessments); $i++)
            {
                array_push($id, $assessments[$i]->id);
            }
            
            $id = array_unique($id);
            $id = array_values($id);

            $assessments = [];

            for($i = 0; $i < count($id); $i++)
            {
                $assessment = DB::table("assessment_session")
                            ->where("id", $id[$i])
                            ->select("id", "start_date", "end_date", "name")
                            ->first();
                
                array_push($assessments, $assessment);
            }
        
            return view('result.index_user', compact("assessments"));
        }
    }

    public function empCompany($id)
    {
        $assessments = DB::table("assessment_session")
        ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')
        ->where("company_id",$id)->get(); 

        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
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

                $participant_detail = [];

                $total = 0;
                $assessor = [];

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


            return view('result.index_admin', compact("assessments","company","selected"));
    }

    public function detail(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "superadmin" || $role->role_id == "admin" || $role->role_id == "admin_ap")
        {
            $session_id = $request->id;

            $assessments = DB::table("assessment_session")
                        ->join("assessor_map", "assessor_map.session_id", "=", "assessment_session.id")
                        ->join("user", "user.id", "=", "assessor_map.userid_assessee")
                        ->select("assessment_session.*", "assessor_map.*", "user.name as userName")
                        ->where("assessor_map.session_id", $session_id)
                        ->get();
            
            $assessment = new stdClass();
            $assessment->name = $assessments[0]->name;
            $assessment->category = $assessments[0]->category;
            $assessment->status = $assessments[0]->status;
            $assessment->start_date = $assessments[0]->start_date;
            $assessment->end_date = $assessments[0]->end_date;
            $assessment->expired = $assessments[0]->expired;

            $assesse = [];

            for($i = 0; $i < count($assessments); $i++)
            {
                array_push($assesse, $assessments[$i]->userid_assessee);
            }

            $assesse = array_unique($assesse);
            $assesse = array_values($assesse);

            $assessees = [];

            for($i = 0; $i < count($assesse); $i++)
            {
                $assessee = DB::table("user")
                            ->where("id", $assesse[$i])
                            ->first();
                
                $detail = new stdClass();
                $detail->id = $assesse[$i];
                $detail->name = $assessee->name;
                $detail->email = $assessee->email;

                array_push($assessees, $detail);
            }
          

            return view('result.detail_admin', compact("assessment", "assessees", "session_id"));
        }
    }

    public function laporan(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "superadmin" || $role->role_id == "admin" || $role->role_id == "admin_ap" || $role->role_id == "admin_tnd")
        {
            $id = request("id");
            $id = explode("-", $id);
            $assesse_id = $id[0];
            $session_id = $id[1];

            $result = DB::table("assessment_competency_result")
                        ->join("competency", "competency.id", "=", "assessment_competency_result.competency_id")
                        ->join("competency_group", "competency_group.id", "=", "competency_group_id")
                        ->where("session_id", $session_id)
                        ->where("userid_assessee", $assesse_id)
                        ->select("competency.name as competency_name", "modus_level", "competency_id", "competency_group.name as group")
                        ->get();

            $session = DB::table("assessment_session")
                        ->where("id", $session_id)
                        ->select("name", "start_date")
                        ->first();
            
            $assessee = DB::table("user")
                        ->where("id", $assesse_id)
                        ->select("name")
                        ->first();   
                        
            $group = [];

            for($i = 0; $i < count($result); $i++)
            {
                array_push($group, $result[$i]->group);
            }

            $group = array_unique($group);
            $group = array_values($group);

            $job = DB::table("job_target")
                    ->where("assessment_session_id", $session_id)
                    ->select("id", "job_name")
                    ->get();

            $jobs = [];
            
            for($i = 0; $i < count($job); $i++)
            {
                $detail = new stdClass();
                $detail->job_name = $job[$i]->job_name;
                
                $req = DB::table("job_requirement")
                        ->join("competency", "competency.id", "=", "job_requirement.competency_id")
                        ->join("job_target", "job_target.id", "=", "job_requirement.job_target_id")
                        ->where("job_requirement.job_target_id", $job[$i]->id)
                        ->select("competency_id", "name", "skill_level as level", "job_name")
                        ->get();
                
                $detail->req = $req;
                $detail->result = [];

                array_push($jobs, $detail);
            }

            
            for($i = 0; $i < count($jobs); $i++)
            {
                for($j = 0; $j < count($jobs[$i]->req); $j++)
                {
                    for($k = 0; $k < count($result); $k++)
                    {
                        if($jobs[$i]->req[$j]->competency_id == $result[$k]->competency_id)
                        {
                            array_push($jobs[$i]->result, $result[$k]);
                        }
                    }
                }
            }

            return view('result.laporan_admin', compact("result", "assessee", "session", "group", "jobs"));
        }
        else if($role->role_id == "user")
        {
            if ($request->track_user != null) {
            $session_id = explode('-', $request->id);
            $session_id = $session_id[1];
            } else {
            $session_id = request("id");
            }

            $result = DB::table("assessment_competency_result")
                        ->join("competency", "competency.id", "=", "assessment_competency_result.competency_id")
                        ->join("competency_group", "competency_group.id", "=", "competency_group_id")
                        ->where("session_id", $session_id)
                        ->where("userid_assessee", Auth::user()->id)
                        ->select("competency.name as competency_name", "modus_level", "competency_id", "competency_group.name as group")
                        ->get();    
           
            $session = DB::table("assessment_session")
                        ->where("id", $session_id)
                        ->select("name", "start_date")
                        ->first();
            
            $assessee = DB::table("user")
                        ->where("id", Auth::user()->id)
                        ->select("name")
                        ->first();

            $group = [];

            for($i = 0; $i < count($result); $i++)
            {
                array_push($group, $result[$i]->group);
            }

            $group = array_unique($group);
            $group = array_values($group);

            $job = DB::table("job_target")
                    ->where("assessment_session_id", $session_id)
                    ->select("id", "job_name")
                    ->get();

            $jobs = [];
            
            for($i = 0; $i < count($job); $i++)
            {
                $detail = new stdClass();
                $detail->job_name = $job[$i]->job_name;
                
                $req = DB::table("job_requirement")
                        ->join("competency", "competency.id", "=", "job_requirement.competency_id")
                        ->where("job_requirement.job_target_id", $job[$i]->id)
                        ->select("competency_id", "name", "skill_level as level")
                        ->get();
                
                $detail->req = $req;
                $detail->result = [];

                array_push($jobs, $detail);
            }

            
            for($i = 0; $i < count($jobs); $i++)
            {
                for($j = 0; $j < count($jobs[$i]->req); $j++)
                {
                    for($k = 0; $k < count($result); $k++)
                    {
                        if($jobs[$i]->req[$j]->competency_id == $result[$k]->competency_id)
                        {
                            array_push($jobs[$i]->result, $result[$k]);
                        }
                    }
                }
            }

            //dd($jobs);

            return view('result.laporan_user', compact("result", "assessee", "session", "group", "jobs"));
        }
    }
}
