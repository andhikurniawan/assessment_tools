<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobTargetsRequest;
use App\Http\Requests\UpdateJobTargetsRequest;
use App\Repositories\JobTargetsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class JobTargetsController extends AppBaseController
{
    /** @var  JobTargetsRepository */
    private $jobTargetsRepository;

    public function __construct(JobTargetsRepository $jobTargetsRepo)
    {
        $this->jobTargetsRepository = $jobTargetsRepo;
    }

    /**
     * Display a listing of the JobTargets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $jobTargets = $this->jobTargetsRepository->all();

        return view('job_targets.index')
            ->with('jobTargets', $jobTargets);
    }

    /**
     * Show the form for creating a new JobTargets.
     *
     * @return Response
     */
    public function create()
    {
        return view('job_targets.create');
    }

    /**
     * Store a newly created JobTargets in storage.
     *
     * @param CreateJobTargetsRequest $request
     *
     * @return Response
     */
    public function store(CreateJobTargetsRequest $request)
    {
        $input = $request->all();

        $jobTargets = $this->jobTargetsRepository->create($input);

        Flash::success('Job Targets saved successfully.');

        return redirect(route('jobTargets.index'));
    }

    /**
     * Display the specified JobTargets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jobTargets = $this->jobTargetsRepository->find($id);

        if (empty($jobTargets)) {
            Flash::error('Job Targets not found');

            return redirect(route('jobTargets.index'));
        }

        return view('job_targets.show')->with('jobTargets', $jobTargets);
    }

    /**
     * Show the form for editing the specified JobTargets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jobTargets = $this->jobTargetsRepository->find($id);

        if (empty($jobTargets)) {
            Flash::error('Job Targets not found');

            return redirect(route('jobTargets.index'));
        }

        return view('job_targets.edit')->with('jobTargets', $jobTargets);
    }

    /**
     * Update the specified JobTargets in storage.
     *
     * @param int $id
     * @param UpdateJobTargetsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobTargetsRequest $request)
    {
        $jobTargets = $this->jobTargetsRepository->find($id);

        if (empty($jobTargets)) {
            Flash::error('Job Targets not found');

            return redirect(route('jobTargets.index'));
        }

        $jobTargets = $this->jobTargetsRepository->update($request->all(), $id);

        Flash::success('Job Targets updated successfully.');

        return redirect(route('jobTargets.index'));
    }

    /**
     * Remove the specified JobTargets from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jobTargets = $this->jobTargetsRepository->find($id);

        if (empty($jobTargets)) {
            Flash::error('Job Targets not found');

            return redirect(route('jobTargets.index'));
        }

        $this->jobTargetsRepository->delete($id);

        Flash::success('Job Targets deleted successfully.');

        return redirect(route('jobTargets.index'));
    }
}
