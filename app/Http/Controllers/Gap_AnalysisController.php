<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGap_AnalysisRequest;
use App\Http\Requests\UpdateGap_AnalysisRequest;
use App\Repositories\Gap_AnalysisRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Auth;
use stdClass;
use App\Models\Company;

class Gap_AnalysisController extends AppBaseController
{
    /** @var  Gap_AnalysisRepository */
    private $gapAnalysisRepository;

    public function __construct(Gap_AnalysisRepository $gapAnalysisRepo)
    {
        $this->gapAnalysisRepository = $gapAnalysisRepo;
    }

    /**
     * Display a listing of the Gap_Analysis.
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
        
            $assessments = DB::table("assessment_session")->get();  

            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $company = Company::all();
                $assessments = DB::table("assessment_session")
                ->join('company', 'assessment_session.company_id', '=', 'company.id')
                ->select('assessment_session.name', 'assessment_session.category', 
                'assessment_session.status','assessment_session.expired','assessment_session.start_date',
                'assessment_session.end_date','company.name as company_name', 
                'assessment_session.id as id')
                ->where('status', 'finished')
                ->get(); 
                $selected = "";
            } else {
                $company = Company::where('id', $company_id)->get()->first();
                $assessments = DB::table("assessment_session")
                ->join('company', 'assessment_session.company_id', '=', 'company.id')->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')
                ->where("company_id",$company_id)
                ->where('status', 'finished')
                ->get(); 
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


            return view('gap__analyses.index', compact("assessments","company","selected"));
        }
      
    

    public function empCompany($id)
    {
        $assessments = DB::table("assessment_session")
        ->join('company', 'assessment_session.company_id', '=', 'company.id')
        ->select('assessment_session.name', 'assessment_session.category', 'assessment_session.status','assessment_session.expired','assessment_session.start_date','assessment_session.end_date','company.name as company_name', 'assessment_session.id as id')
        ->where("company_id",$id)
        ->where('status', 'finished')
        ->get(); 

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


            return view('gap__analyses.index', compact("assessments","company","selected"));
    }


    /**
     * Show the form for creating a new Gap_Analysis.
     *
     * @return Response
     */
    public function create()
    {
        return view('gap__analyses.create');
    }

    /**
     * Store a newly created Gap_Analysis in storage.
     *
     * @param CreateGap_AnalysisRequest $request
     *
     * @return Response
     */
    public function store(CreateGap_AnalysisRequest $request)
    {
        $input = $request->all();

        $gapAnalysis = $this->gapAnalysisRepository->create($input);

        Flash::success('Gap  Analysis saved successfully.');

        return redirect(route('gapAnalyses.index'));
    }

    /**
     * Display the specified Gap_Analysis.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "superadmin" || $role->role_id == "admin")
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

            return view('gap__analyses.show', compact("assessment", "assessees", "session_id"));
        }
    }
    /**
     * Show the form for editing the specified Gap_Analysis.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        return view('gap__analyses.edit')->with('gapAnalysis', $gapAnalysis);
    }

    /**
     * Update the specified Gap_Analysis in storage.
     *
     * @param int $id
     * @param UpdateGap_AnalysisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGap_AnalysisRequest $request)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        $gapAnalysis = $this->gapAnalysisRepository->update($request->all(), $id);

        Flash::success('Gap  Analysis updated successfully.');

        return redirect(route('gapAnalyses.index'));
    }

    /**
     * Remove the specified Gap_Analysis from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        $this->gapAnalysisRepository->delete($id);

        Flash::success('Gap  Analysis deleted successfully.');

        return redirect(route('gapAnalyses.index'));
    }


    public function gap(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

      
            $id = request("id");
            $id = explode("-", $id);

            $assesse_id = $id[0];
            $session_id = $id[1];
            $job_target = [];
            $pm = 2;

            $result = DB::table("assessment_competency_result")
            ->join("competency", "competency.id", "=", "assessment_competency_result.competency_id")
            ->join("job_target", "job_target.assessment_session_id", "=",
            "assessment_competency_result.session_id")
            ->join("job_requirement", "job_requirement.job_target_id", "=", "job_target.id")
            ->where("session_id", $session_id)
            ->where("userid_assessee", $assesse_id)
            ->where("job_target.job_name", "Project Manager")
            ->select("competency.name as competency_name", "competency.id as competency_id",
             "modus_level as hasil", "median_level",
            "third_quartile", "job_target.job_name as job_name", "job_target.id as job_id", "max_level",
            "job_requirement.skill_level as req")
            ->distinct("competency.id")
            ->get();
           
           
            $job_name = 'Project Manager';
            $jenis = 'core';
            $coba = DB::select('SELECT DISTINCT c.name as 
            `kompetensi`, c.jenis as `jenis`, b.skill_level as `req`, 
            a.modus_level as `hasil` FROM assessment_competency_result a, 
            job_requirement b, competency c, job_target d WHERE 
            a.competency_id = b.competency_id AND userid_assessee = '.$assesse_id.' 
            AND c.id = a.competency_id AND c.jenis = "'.$jenis.'" 
            AND c.id = a.competency_id AND a.session_id = '.$session_id.' AND 
            d.job_name = "'.$job_name.'" AND b.job_target_id = d.id');

            $job_name = 'Project Manager';
            $jenis2 = 'secondary';
            $cobaa = DB::select('SELECT DISTINCT c.name as 
            `kompetensi`, c.jenis as `jenis`, b.skill_level as `req`, 
            a.modus_level as `hasil` FROM assessment_competency_result a, 
            job_requirement b, competency c, job_target d WHERE 
            a.competency_id = b.competency_id AND userid_assessee = '.$assesse_id.' 
            AND c.id = a.competency_id AND c.jenis = "'.$jenis2.'" 
            AND c.id = a.competency_id AND a.session_id = '.$session_id.' AND 
            d.job_name = "'.$job_name.'" AND b.job_target_id = d.id');

            $job_name2 = 'Programmer';
            $jenis = 'core';
            $coba2 = DB::select('SELECT DISTINCT c.name as 
            `kompetensi`, c.jenis as `jenis`, b.skill_level as `req`, 
            a.modus_level as `hasil` FROM assessment_competency_result a, 
            job_requirement b, competency c, job_target d WHERE 
            a.competency_id = b.competency_id AND userid_assessee = '.$assesse_id.' 
            AND c.id = a.competency_id AND c.jenis = "'.$jenis.'" 
            AND c.id = a.competency_id AND a.session_id = '.$session_id.' AND 
            d.job_name = "'.$job_name2.'" AND b.job_target_id = d.id');

            $job_name2 = 'Programmer';
            $jenis2 = 'secondary';
            $cobaa2 = DB::select('SELECT DISTINCT c.name as 
            `kompetensi`, c.jenis as `jenis`, b.skill_level as `req`, 
            a.modus_level as `hasil` FROM assessment_competency_result a, 
            job_requirement b, competency c, job_target d WHERE 
            a.competency_id = b.competency_id AND userid_assessee = '.$assesse_id.' 
            AND c.id = a.competency_id AND c.jenis = "'.$jenis2.'" 
            AND c.id = a.competency_id AND a.session_id = '.$session_id.' AND 
            d.job_name = "'.$job_name2.'" AND b.job_target_id = d.id');

            $job_name3 = 'Analis';
            $jenis = 'core';
            $coba3 = DB::select('SELECT DISTINCT c.name as 
            `kompetensi`, c.jenis as `jenis`, b.skill_level as `req`, 
            a.modus_level as `hasil` FROM assessment_competency_result a, 
            job_requirement b, competency c, job_target d WHERE 
            a.competency_id = b.competency_id AND userid_assessee = '.$assesse_id.'
            AND c.id = a.competency_id AND c.jenis = "'.$jenis.'"  
            AND c.id = a.competency_id AND a.session_id = '.$session_id.' AND 
            d.job_name = "'.$job_name3.'" AND b.job_target_id = d.id');

            $job_name3 = 'Analis';
            $jenis2 = 'secondary';
            $cobaa3 = DB::select('SELECT DISTINCT c.name as 
            `kompetensi`, c.jenis as `jenis`, b.skill_level as `req`, 
            a.modus_level as `hasil` FROM assessment_competency_result a, 
            job_requirement b, competency c, job_target d WHERE 
            a.competency_id = b.competency_id AND userid_assessee = '.$assesse_id.'
            AND c.id = a.competency_id AND c.jenis = "'.$jenis2.'"  
            AND c.id = a.competency_id AND a.session_id = '.$session_id.' AND 
            d.job_name = "'.$job_name3.'" AND b.job_target_id = d.id');
          
            $session = DB::table("assessment_session")
                        ->where("id", $session_id)
                        ->select("name", "start_date")
                        ->first();
            
            $assessee = DB::table("user")
                        ->where("id", $assesse_id)
                        ->select("name", "employee_id")
                        ->first();   
                        
          

            $job = DB::table("job_target")
                    ->where("assessment_session_id", $session_id)
                    ->select("id", "job_name")
                    ->distinct('job_name')
                    ->get();

            $jobs = [];
            
            for($i = 0; $i < count($job); $i++)
            {
                $detail = new stdClass();
                $detail->job_name = $job[$i]->job_name;
                
                $req = DB::table("job_requirement")
                        ->join("competency", "competency.id", "=", "job_requirement.competency_id")
                        ->join("job_target", "job_target.id", "=", "job_requirement.job_target_id")
                        ->where("job_target.job_name", "project manager")
                        ->select("competency_id", "name", "skill_level as level", "job_target.job_name as job")
                        ->distinct('job_target.job_name')
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

            return view('gap__analyses.gap', compact("result", "coba", "coba2",
            "coba3", "assessee", "session", "jobs", "job", "req", "cobaa3", "cobaa2", "cobaa"));
        }
        
    }

