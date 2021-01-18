<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompetency_GroupRequest;
use App\Http\Requests\UpdateCompetency_GroupRequest;
use App\Repositories\Competency_GroupRepository;
use App\Models\Competency_Group;
use App\Models\Company;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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
        $competencyGroups = $this->competencyGroupRepository->all();

        return view('competency__groups.index')
            ->with('competencyGroups', $competencyGroups);
    }

    /**
     * Show the form for creating a new Competency_Group.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all()->pluck('name','id');
        return view('competency__groups.create', compact('companies'));
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

        if (empty($competencyGroup)) {
            Flash::error('Competency  Group not found');

            return redirect(route('competencyGroups.index'));
        }

        return view('competency__groups.show')->with('competencyGroup', $competencyGroup);
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
        $companies = Company::all()->pluck('name','id');
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
