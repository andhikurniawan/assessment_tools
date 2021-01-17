<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemodelkompetensiRequest;
use App\Http\Requests\UpdatemodelkompetensiRequest;
use App\Repositories\modelkompetensiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class modelkompetensiController extends AppBaseController
{
    /** @var  modelkompetensiRepository */
    private $modelkompetensiRepository;

    public function __construct(modelkompetensiRepository $modelkompetensiRepo)
    {
        $this->modelkompetensiRepository = $modelkompetensiRepo;
    }

    /**
     * Display a listing of the modelkompetensi.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $modelkompetensis = $this->modelkompetensiRepository->all();

        return view('modelkompetensis.index')
            ->with('modelkompetensis', $modelkompetensis);
    }

    /**
     * Show the form for creating a new modelkompetensi.
     *
     * @return Response
     */
    public function create()
    {
        return view('modelkompetensis.create');
    }

    /**
     * Store a newly created modelkompetensi in storage.
     *
     * @param CreatemodelkompetensiRequest $request
     *
     * @return Response
     */
    public function store(CreatemodelkompetensiRequest $request)
    {
        $input = $request->all();

        $modelkompetensi = $this->modelkompetensiRepository->create($input);

        Flash::success('Modelkompetensi saved successfully.');

        return redirect(route('modelkompetensis.index'));
    }

    /**
     * Display the specified modelkompetensi.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modelkompetensi = $this->modelkompetensiRepository->find($id);

        if (empty($modelkompetensi)) {
            Flash::error('Modelkompetensi not found');

            return redirect(route('modelkompetensis.index'));
        }

        return view('modelkompetensis.show')->with('modelkompetensi', $modelkompetensi);
    }

    /**
     * Show the form for editing the specified modelkompetensi.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modelkompetensi = $this->modelkompetensiRepository->find($id);

        if (empty($modelkompetensi)) {
            Flash::error('Modelkompetensi not found');

            return redirect(route('modelkompetensis.index'));
        }

        return view('modelkompetensis.edit')->with('modelkompetensi', $modelkompetensi);
    }

    /**
     * Update the specified modelkompetensi in storage.
     *
     * @param int $id
     * @param UpdatemodelkompetensiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemodelkompetensiRequest $request)
    {
        $modelkompetensi = $this->modelkompetensiRepository->find($id);

        if (empty($modelkompetensi)) {
            Flash::error('Modelkompetensi not found');

            return redirect(route('modelkompetensis.index'));
        }

        $modelkompetensi = $this->modelkompetensiRepository->update($request->all(), $id);

        Flash::success('Modelkompetensi updated successfully.');

        return redirect(route('modelkompetensis.index'));
    }

    /**
     * Remove the specified modelkompetensi from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modelkompetensi = $this->modelkompetensiRepository->find($id);

        if (empty($modelkompetensi)) {
            Flash::error('Modelkompetensi not found');

            return redirect(route('modelkompetensis.index'));
        }

        $this->modelkompetensiRepository->delete($id);

        Flash::success('Modelkompetensi deleted successfully.');

        return redirect(route('modelkompetensis.index'));
    }
}
