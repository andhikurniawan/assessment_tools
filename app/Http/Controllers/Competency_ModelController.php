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
        $competencyModels = $this->competencyModelRepository->all();

        return view('competency__models.index')
            ->with('competencyModels', $competencyModels);
    }


    /**
     * Show the form for creating a new Competency_Model.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all()->pluck('name','id');
        $competencies = Competency::all()->pluck('name','id');
        return view('competency__models.create', compact('companies', 'competencies'));
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
        $companies = Company::all()->pluck('name','id');
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
