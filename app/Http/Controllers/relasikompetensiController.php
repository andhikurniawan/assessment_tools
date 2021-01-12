<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterelasikompetensiRequest;
use App\Http\Requests\UpdaterelasikompetensiRequest;
use App\Repositories\relasikompetensiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class relasikompetensiController extends AppBaseController
{
    /** @var  relasikompetensiRepository */
    private $relasikompetensiRepository;

    public function __construct(relasikompetensiRepository $relasikompetensiRepo)
    {
        $this->relasikompetensiRepository = $relasikompetensiRepo;
    }

    /**
     * Display a listing of the relasikompetensi.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $relasikompetensis = $this->relasikompetensiRepository->all();

        return view('relasikompetensis.index')
            ->with('relasikompetensis', $relasikompetensis);
    }

    /**
     * Show the form for creating a new relasikompetensi.
     *
     * @return Response
     */
    public function create()
    {
        return view('relasikompetensis.create');
    }

    /**
     * Store a newly created relasikompetensi in storage.
     *
     * @param CreaterelasikompetensiRequest $request
     *
     * @return Response
     */
    public function store(CreaterelasikompetensiRequest $request)
    {
        $input = $request->all();

        $relasikompetensi = $this->relasikompetensiRepository->create($input);

        Flash::success('Relasikompetensi saved successfully.');

        return redirect(route('relasikompetensis.index'));
    }

    /**
     * Display the specified relasikompetensi.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $relasikompetensi = $this->relasikompetensiRepository->find($id);

        if (empty($relasikompetensi)) {
            Flash::error('Relasikompetensi not found');

            return redirect(route('relasikompetensis.index'));
        }

        return view('relasikompetensis.show')->with('relasikompetensi', $relasikompetensi);
    }

    /**
     * Show the form for editing the specified relasikompetensi.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $relasikompetensi = $this->relasikompetensiRepository->find($id);

        if (empty($relasikompetensi)) {
            Flash::error('Relasikompetensi not found');

            return redirect(route('relasikompetensis.index'));
        }

        return view('relasikompetensis.edit')->with('relasikompetensi', $relasikompetensi);
    }

    /**
     * Update the specified relasikompetensi in storage.
     *
     * @param int $id
     * @param UpdaterelasikompetensiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterelasikompetensiRequest $request)
    {
        $relasikompetensi = $this->relasikompetensiRepository->find($id);

        if (empty($relasikompetensi)) {
            Flash::error('Relasikompetensi not found');

            return redirect(route('relasikompetensis.index'));
        }

        $relasikompetensi = $this->relasikompetensiRepository->update($request->all(), $id);

        Flash::success('Relasikompetensi updated successfully.');

        return redirect(route('relasikompetensis.index'));
    }

    /**
     * Remove the specified relasikompetensi from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $relasikompetensi = $this->relasikompetensiRepository->find($id);

        if (empty($relasikompetensi)) {
            Flash::error('Relasikompetensi not found');

            return redirect(route('relasikompetensis.index'));
        }

        $this->relasikompetensiRepository->delete($id);

        Flash::success('Relasikompetensi deleted successfully.');

        return redirect(route('relasikompetensis.index'));
    }
}
