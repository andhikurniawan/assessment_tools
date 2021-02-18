<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompetencyRequest;
use App\Http\Requests\UpdateCompetencyRequest;
use App\Repositories\CompetencyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Competency;
use App\Models\Competency_Group;
use App\Models\Key_Behaviour;
use App\Models\Job_Target;
use App\Models\Company;
use Flash;
use Response;
use DB;
use Auth;


class CompetencyController extends AppBaseController
{
    /** @var  CompetencyRepository */
    private $competencyRepository;

    public function __construct(CompetencyRepository $competencyRepo)
    {
        $this->competencyRepository = $competencyRepo;
    }

    /**
     * Display a listing of the Competency.
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
         
    
            if($role->role_id == "superadmin" )
            {
                $competencies = Competency::all();
    
                $company_id = Auth::user()->company_id;
                if ($company_id == null) {
                    $company = Company::all();
                    $selected = "";
                } else {
                    $company = Company::where('id', $company_id)->get()->first();
                    $selected = $company->id;
                }
                return view('competencies.index', compact("competencies","company","selected"));
        
            }
            else if($role->role_id == "admin_pm" || $role->role_id == "admin")
            {   
             
                $competencies = Competency::join('competency_group', 'competency.competency_group_id', 
                '=', 'competency_group.id')
                ->where('competency_group.company_id', Auth::user()->company_id)
                ->select('competency.*')
                ->get();
    
                $company_id = Auth::user()->company_id;
                if ($company_id == null) {
                    $company = Company::all();
                    $selected = "";
                } else {
                    $company = Company::where('id', $company_id)->get()->first();
                    $selected = $company->id;
                }
                return view('competencies.index', compact("competencies","company","selected"));
        
            }
          
        
            
      
    }

    public function empCompany($id)
    {
   
        $competencies = Competency::join('competency_group', 'competency.competency_group_id', 
        '=', 'competency_group.id')
        ->where('competency_group.company_id', $id)
        ->select('competency.*')->get();
        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
        return view('competencies.index', compact('competencies', 'company', 'selected'));
    }

       

    /**
     * Show the form for creating a new Competency.
     *
     * @return Response
     */
    public function create()
    {
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $competencyGroup = Competency_Group::all()->pluck('name','id');

        } else {
            $competencyGroup = Competency_Group::join('company', 'competency_group.company_id', 
            '=', 'company.id')
            ->where('company.id', $user_company)
            ->select('competency_group.*')->pluck('name','id');
       
        }
        return view('competencies.create', compact('competencyGroup'));

    }

    /**
     * Store a newly created Competency in storage.
     *
     * @param CreateCompetencyRequest $request
     *
     * @return Response
     */
    public function store(CreateCompetencyRequest $request)
    {
        $input = $request->all();

        $competency = $this->competencyRepository->create($input);

        Flash::success('Competency saved successfully.');

        return redirect(route('competencies.index'));
    }

    /**
     * Display the specified Competency.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $competency = $this->competencyRepository->find($id);
        $behaviour = Key_Behaviour::all()->where('competency_id', $id);
        $job = Job_Target::all()->find($id);
        
        $req = DB::table("job_requirement")
        ->join('job_target', 'job_requirement.job_target_id', '=', 'job_target.id')
        ->select('job_target.job_name as job')
        ->where('competency_id', $id)
        ->distinct('job_target.job_name')
        ->get();

        if (empty($competency)) {
            Flash::error('Competency not found');

            return redirect(route('competencies.index'));
        }

        return view('competencies.show', compact('competency','behaviour','job', 'req'));


      
    }

    /**
     * Show the form for editing the specified Competency.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $competencyGroup = Competency_Group::all()->pluck('name','id');
        $competency = $this->competencyRepository->find($id);

        if (empty($competency)) {
            Flash::error('Competency not found');

            return redirect(route('competencies.index'));
        }

        return view('competencies.edit', compact('competencyGroup','competency'));
    }

   


    /**
     * Update the specified Competency in storage.
     *
     * @param int $id
     * @param UpdateCompetencyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompetencyRequest $request)
    {
        $competency = $this->competencyRepository->find($id);

        if (empty($competency)) {
            Flash::error('Competency not found');

            return redirect(route('competencies.index'));
        }

        $competency = $this->competencyRepository->update($request->all(), $id);

        Flash::success('Competency updated successfully.');

        return redirect(route('competencies.index'));
    }

    /**
     * Remove the specified Competency from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $competency = $this->competencyRepository->find($id);

        if (empty($competency)) {
            Flash::error('Competency not found');

            return redirect(route('competencies.index'));
        }

        $this->competencyRepository->delete($id);

        Flash::success('Competency deleted successfully.');

        return redirect(route('competencies.index'));
    }

    public function filterCompetencyGroup($company_id){
        $companies = company::all();
        $competencies = $this->competencyRepository->all();
        $selected_company = $company_id;
        $selected_competency_group = "0";
        $competencyGroups = competency_group::where("company_id",$company_id)->get();

        return view('competencies.index', compact("companies",'competencies',"selected_company","selected_competency_group","competencyGroups"));
    }

    public function filtering($company_id,$competency_group_id){
        $companies = company::all();
        $selected_company = $company_id;

        $competencyGroups = competency_group::where("company_id",$company_id)->get();
        $selected_competency_group = $competency_group_id;
        $competencies = competency::where("competency_group_id", $competency_group_id)->get();

        return view('competencies.index',compact('companies','selected_company','competencyGroups','selected_competency_group','competencies'));
    }
}
