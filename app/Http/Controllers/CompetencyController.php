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
        $companies = company::all();
        $competencyGroups = competency_group::all();
        $competencies = Competency::all();

     
        $selected_company = '0';
        $selected_competency_group = '0';

        return view('competencies.index',compact('companies','competencyGroups','skills','selected_company','selected_competency_group'))
            ->with('competencies', $competencies);
      
    }

    public function empCompany($id)
    {
   
        $competencies = DB::table('competency')
        ->join('competency_group', 'competency.competency_group_id', '=', 'competency_group.id')
        ->join('company', 'company.id', '=', 'company.id')
        ->select('competency.id','competency.name', 'competency.code', 'competency.status', 'competency.type', 
        'competency.question', 'company.name as company_name', 'competency_group.name as group_name')
        ->where('company_id', $id)->get();
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
      
        $competencyGroup = Competency_Group::all()->pluck('name','id');
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

        if (empty($competency)) {
            Flash::error('Competency not found');

            return redirect(route('competencies.index'));
        }

        return view('competencies.show', compact('competency','behaviour','job'));


      
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
