<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompetency_ModelRequest;
use App\Http\Requests\UpdateCompetency_ModelRequest;
use App\Repositories\Competency_ModelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Competency_Relation;
use App\Models\Competency;
use App\Models\Company;
use App\Models\Competency_Model;
use DB;
use Auth;

class Competency_ModelController extends AppBaseController
{
    /** @var  Competency_ModelRepository */
    private $competencyModelRepository;

    public function __construct(Competency_ModelRepository $competencyModelRepo)
    {
        $this->competencyModelRepository = $competencyModelRepo;
    }

    /**
     * Display a listing of the Competency_Model.
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
     

        if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
            $competencyModels = $this->competencyModelRepository->all();

            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $company = Company::all();
                $selected = "";
            } else {
                $company = Company::where('id', $company_id)->get()->first();
                $selected = $company->id;
            }
            return view('competency__models.index', compact("competencyModels","company","selected"));
      
        }
        else if($role->role_id == "admin_pm")
        {   
            $competencyModels = Competency_Model::where('company_id', Auth::user()->company_id)
            ->get();

            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $company = Company::all();
                $selected = "";
            } else {
                $company = Company::where('id', $company_id)->get()->first();
                $selected = $company->id;
            }
            return view('competency__models.index', compact("competencyModels","company","selected"));
      
        }
      
      

      
       
    }

    public function empCompany($id)
    {
        $competencyModels = Competency_Model::where('company_id', $id)->get();
        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
        return view('competency__models.index', compact('competencyModels', 'company', 'selected'));
    }


    /**
     * Show the form for creating a new Competency_Model.
     *
     * @return Response
     */
    public function create()
    {

        $id = Auth::user()->id;
        $role = DB::table("user_role")
        ->where("user_id", $id)
        ->select("role_id")
        ->first();
     
        if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
            $companies = Company::all()->pluck('name','id');
            $competencies = Competency::all()->pluck('name','id');
            return view('competency__models.create', compact('companies', 'competencies'));
        }
        else if($role->role_id == "admin_pm")
        {   
            $companies = Company::where('id', Auth::user()->company_id)
            ->pluck('name','id');
            $competencies = Competency::all()->pluck('name','id');
            return view('competency__models.create', compact('companies', 'competencies'));
        }

       
    }

    /**
     * Store a newly created Competency_Model in storage.
     *
     * @param CreateCompetency_ModelRequest $request
     *
     * @return Response
     */
    public function store(CreateCompetency_ModelRequest $request)
    {
        $input = $request->all();

        $competencyModel = $this->competencyModelRepository->create($input);

        Flash::success('Competency  Model saved successfully.');

        return redirect(route('competencyModels.index'));
    }

    /**
     * Display the specified Competency_Model.
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        $competencyModel = $this->competencyModelRepository->find($id);
        $competencyRelation = Competency_Relation::all()->where('competency_models_id', $id);

        if (empty($competencyModel)) {
            Flash::error('Competency Model not found');

            return redirect(route('competencyModels.index'));
        }

        return view('competency__models.show', compact('competencyModel','competencyRelation'));

    }


    /**
     * Show the form for editing the specified Competency_Model.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $companies = Company::all()->pluck('name','id');
        } else {
            $companies = Company::where('id', $user_company)->pluck('name','id');
        }
       
    
        $competencies = Competency::all()->pluck('name','id');
        $competencyModel = $this->competencyModelRepository->find($id);

        if (empty($competencyModel)) {
            Flash::error('Competency  Model not found');

            return redirect(route('competencyModels.index'));
        }
        return view('competency__models.edit', compact('competencyModel', 'companies', 'competencies'));
        
    }

    /**
     * Update the specified Competency_Model in storage.
     *
     * @param int $id
     * @param UpdateCompetency_ModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompetency_ModelRequest $request)
    {
        $competencyModel = $this->competencyModelRepository->find($id);

        if (empty($competencyModel)) {
            Flash::error('Competency  Model not found');

            return redirect(route('competencyModels.index'));
        }

        $competencyModel = $this->competencyModelRepository->update($request->all(), $id);

        Flash::success('Competency  Model updated successfully.');

        return redirect(route('competencyModels.index'));
    }

    /**
     * Remove the specified Competency_Model from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $competencyModel = $this->competencyModelRepository->find($id);

        if (empty($competencyModel)) {
            Flash::error('Competency  Model not found');

            return redirect(route('competencyModels.index'));
        }

        $this->competencyModelRepository->delete($id);

        Flash::success('Competency  Model deleted successfully.');

        return redirect(route('competencyModels.index'));
    }
}
