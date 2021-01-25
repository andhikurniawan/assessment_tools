<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompetency_GroupRequest;
use App\Http\Requests\UpdateCompetency_GroupRequest;
use App\Repositories\Competency_GroupRepository;
use App\Models\Competency_Relation;
use App\Models\Competency_Group;
use App\Models\Company;
use App\Models\Competency;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Auth;

class Competency_GroupController extends AppBaseController
{
    /** @var  Competency_GroupRepository */
    private $competencyGroupRepository;

    public function __construct(Competency_GroupRepository $competencyGroupRepo)
    {
        $this->competencyGroupRepository = $competencyGroupRepo;
    }

    /**
     * Display a listing of the Competency_Group.
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
     

        if($role->role_id == "superadmin")
        {
            $competencyGroups = $this->competencyGroupRepository->all();
           

            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $company = Company::all();
                $selected = "";
            } else {
                $company = Company::where('id', $company_id)->get()->first();
                $selected = $company->id;
            }
            return view('competency__groups.index', compact("competencyGroups","company","selected"));
    
        }
        else if($role->role_id == "admin_pm" || $role->role_id == "admin")
        {   
            $competencyGroups = Competency_Group::where('company_id', Auth::user()->company_id)
            ->get();

            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $company = Company::all();
                $selected = "";
            } else {
                $company = Company::where('id', $company_id)->get()->first();
                $selected = $company->id;
            }
            return view('competency__groups.index', compact("competencyGroups","company","selected"));
    
        }
      
    
        
         
    }

    public function empCompany($id)
    {
        $competencyGroups = Competency_Group::where('company_id', $id)->get();
        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
        return view('competency__groups.index', compact('competencyGroups', 'company', 'selected'));
    }

    /**
     * Show the form for creating a new Competency_Group.
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
     
        if($role->role_id == "superadmin" )
        {
            $companies = Company::all()->pluck('name','id');
            return view('competency__groups.create', compact('companies'));
        }
        else if($role->role_id == "admin_pm" || $role->role_id == "admin")
        {   
            $companies = Company::where('id', Auth::user()->company_id)
            ->pluck('name','id');
            return view('competency__groups.create', compact('companies'));
        }

     
    }

    /**
     * Store a newly created Competency_Group in storage.
     *
     * @param CreateCompetency_GroupRequest $request
     *
     * @return Response
     */
    public function store(CreateCompetency_GroupRequest $request)
    {
        $input = $request->all();

        $competencyGroup = $this->competencyGroupRepository->create($input);

        Flash::success('Competency  Group saved successfully.');

        return redirect(route('competencyGroups.index'));
    }

    /**
     * Display the specified Competency_Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $competencyGroup = $this->competencyGroupRepository->find($id);
        $competencies = Competency::all()->where('competency_group_id', $id);

        if (empty($competencyGroup)) {
            Flash::error('Competency  Group not found');

            return redirect(route('competencyGroups.index'));
        }

        return view('competency__groups.show', compact('competencyGroup','competencies'));
    }

    /**
     * Show the form for editing the specified Competency_Group.
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
       
        $competencyGroup = $this->competencyGroupRepository->find($id);

        if (empty($competencyGroup)) {
            Flash::error('Competency  Group not found');

            return redirect(route('competencyGroups.index'));
        }

        return view('competency__groups.edit', compact('competencyGroup','companies'));
        
    }

    /**
     * Update the specified Competency_Group in storage.
     *
     * @param int $id
     * @param UpdateCompetency_GroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompetency_GroupRequest $request)
    {
        $competencyGroup = $this->competencyGroupRepository->find($id);

        if (empty($competencyGroup)) {
            Flash::error('Competency  Group not found');

            return redirect(route('competencyGroups.index'));
        }

        $competencyGroup = $this->competencyGroupRepository->update($request->all(), $id);

        Flash::success('Competency  Group updated successfully.');

        return redirect(route('competencyGroups.index'));
    }

    /**
     * Remove the specified Competency_Group from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $competencyGroup = $this->competencyGroupRepository->find($id);

        if (empty($competencyGroup)) {
            Flash::error('Competency  Group not found');

            return redirect(route('competencyGroups.index'));
        }

        $this->competencyGroupRepository->delete($id);

        Flash::success('Competency  Group deleted successfully.');

        return redirect(route('competencyGroups.index'));
    }
}
