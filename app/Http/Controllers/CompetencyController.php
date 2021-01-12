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
use Flash;
use Response;

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
        $competencies = $this->competencyRepository->all();

        return view('competencies.index')
            ->with('competencies', $competencies);
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
        $behaviour = Key_Behaviour::all()->find($id);
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
}
