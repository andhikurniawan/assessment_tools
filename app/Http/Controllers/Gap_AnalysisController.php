<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGap_AnalysisRequest;
use App\Http\Requests\UpdateGap_AnalysisRequest;
use App\Repositories\Gap_AnalysisRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Gap_AnalysisController extends AppBaseController
{
    /** @var  Gap_AnalysisRepository */
    private $gapAnalysisRepository;

    public function __construct(Gap_AnalysisRepository $gapAnalysisRepo)
    {
        $this->gapAnalysisRepository = $gapAnalysisRepo;
    }

    /**
     * Display a listing of the Gap_Analysis.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $gapAnalyses = $this->gapAnalysisRepository->all();

        return view('gap__analyses.index')
            ->with('gapAnalyses', $gapAnalyses);
    }

    /**
     * Show the form for creating a new Gap_Analysis.
     *
     * @return Response
     */
    public function create()
    {
        return view('gap__analyses.create');
    }

    /**
     * Store a newly created Gap_Analysis in storage.
     *
     * @param CreateGap_AnalysisRequest $request
     *
     * @return Response
     */
    public function store(CreateGap_AnalysisRequest $request)
    {
        $input = $request->all();

        $gapAnalysis = $this->gapAnalysisRepository->create($input);

        Flash::success('Gap  Analysis saved successfully.');

        return redirect(route('gapAnalyses.index'));
    }

    /**
     * Display the specified Gap_Analysis.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        return view('gap__analyses.show')->with('gapAnalysis', $gapAnalysis);
    }

    /**
     * Show the form for editing the specified Gap_Analysis.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        return view('gap__analyses.edit')->with('gapAnalysis', $gapAnalysis);
    }

    /**
     * Update the specified Gap_Analysis in storage.
     *
     * @param int $id
     * @param UpdateGap_AnalysisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGap_AnalysisRequest $request)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        $gapAnalysis = $this->gapAnalysisRepository->update($request->all(), $id);

        Flash::success('Gap  Analysis updated successfully.');

        return redirect(route('gapAnalyses.index'));
    }

    /**
     * Remove the specified Gap_Analysis from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gapAnalysis = $this->gapAnalysisRepository->find($id);

        if (empty($gapAnalysis)) {
            Flash::error('Gap  Analysis not found');

            return redirect(route('gapAnalyses.index'));
        }

        $this->gapAnalysisRepository->delete($id);

        Flash::success('Gap  Analysis deleted successfully.');

        return redirect(route('gapAnalyses.index'));
    }
}
