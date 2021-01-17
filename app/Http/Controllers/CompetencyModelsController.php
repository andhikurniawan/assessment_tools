<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompetencyModelsRequest;
use App\Http\Requests\UpdateCompetencyModelsRequest;
use App\Repositories\CompetencyModelsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\CompetencyModels;
use Session;
use Auth;

class CompetencyModelsController extends AppBaseController
{
    /** @var  CompetencyModelsRepository */
    private $competencyModelsRepository;

    public function __construct(CompetencyModelsRepository $competencyModelsRepo)
    {
        $this->competencyModelsRepository = $competencyModelsRepo;
    }

    /**
     * Display a listing of the CompetencyModels.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $competencyModels = $this->competencyModelsRepository->all();

        return view('competency_models.index')
            ->with('competencyModels', $competencyModels);
    }

    /**
     * Show the form for creating a new CompetencyModels.
     *
     * @return Response
     */
    public function create()
    {
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $models = CompetencyModels::All();
        } else {
            $models = CompetencyModels::where('company_id', $user_company)->get();
        }
       
        return view('competency_models.create', compact("models"));
    }

    /**
     * Store a newly created CompetencyModels in storage.
     *
     * @param CreateCompetencyModelsRequest $request
     *
     * @return Response
     */
    public function store(CreateCompetencyModelsRequest $request)
    {
        // $input = $request->all();

        // $competencyModels = $this->competencyModelsRepository->create($input);

        // Flash::success('Competency Models saved successfully.');

        session(["competency" => $request->model[0]]);

        return redirect(route('participant.index'));
    }

    /**
     * Display the specified CompetencyModels.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $competencyModels = $this->competencyModelsRepository->find($id);

        if (empty($competencyModels)) {
            Flash::error('Competency Models not found');

            return redirect(route('competencyModel.index'));
        }
        $competencies = DB::table('competency')
        ->select(array('id','code','name'))
        ->get();
            $items = array();

        foreach ($competencies as $competency) {
        $items[$competency->id] = $competency->code.' - '.$competency->name;
        }


        return view('competency_models.show')->with('competencyModels', $competencyModels);
    }

    /**
     * Show the form for editing the specified CompetencyModels.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $competencyModels = $this->competencyModelsRepository->find($id);

        if (empty($competencyModels)) {
            Flash::error('Competency Models not found');

            return redirect(route('competencyModel.index'));
        }

        return view('competency_models.edit')->with('competencyModels', $competencyModels);
    }

    /**
     * Update the specified CompetencyModels in storage.
     *
     * @param int $id
     * @param UpdateCompetencyModelsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompetencyModelsRequest $request)
    {
        $competencyModels = $this->competencyModelsRepository->find($id);

        if (empty($competencyModels)) {
            Flash::error('Competency Models not found');

            return redirect(route('competencyModel.index'));
        }

        $competencyModels = $this->competencyModelsRepository->update($request->all(), $id);

        Flash::success('Competency Models updated successfully.');

        return redirect(route('competencyModel.index'));
    }

    /**
     * Remove the specified CompetencyModels from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $competencyModels = $this->competencyModelsRepository->find($id);

        if (empty($competencyModels)) {
            Flash::error('Competency Models not found');

            return redirect(route('competencyModel.index'));
        }

        $this->competencyModelsRepository->delete($id);

        Flash::success('Competency Models deleted successfully.');

        return redirect(route('competencyModel.index'));
    }
}
