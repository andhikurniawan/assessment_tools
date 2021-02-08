<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobRequirementRequest;
use App\Http\Requests\UpdateJobRequirementRequest;
use App\Repositories\JobRequirementRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\JobTargets;
use App\Models\JobRequirement;
use App\Models\AssessmentSession;
use App\Models\CompetencyModels;

class JobRequirementController extends AppBaseController
{
    /** @var  JobRequirementRepository */
    private $jobRequirementRepository;

    public function __construct(JobRequirementRepository $jobRequirementRepo)
    {
        $this->jobRequirementRepository = $jobRequirementRepo;
    }

    /**
     * Display a listing of the JobRequirement.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $job_target_id = $request->get('job_target_id');
        if(!empty($job_target_id))
        {
            $jobTarget = JobTargets::find($job_target_id);
            $jobRequirements = JobRequirement::where('job_target_id',$job_target_id)->get();

            return view('job_requirements.index', compact('jobRequirements','jobTarget'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new JobRequirement.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $job_target_id = $request->get('job_target_id');
        $jobTarget = JobTargets::find($job_target_id);
        $session_id = $jobTarget->assessmentSession->id;
        $competencyModels = AssessmentSession::find($session_id)->competencyModels;
        $items = array();
        foreach ($competencyModels as $competencyModel) {
            $competencies = CompetencyModels::find($competencyModel->id)->competencies;
            foreach ($competencies as $competency) {
                $items[$competency->id] = $competency->code.' - '.$competency->name;
            }
        }

        return view('job_requirements.create', compact('job_target_id', 'items'));
    }

    /**
     * Store a newly created JobRequirement in storage.
     *
     * @param CreateJobRequirementRequest $request
     *
     * @return Response
     */
    public function store(CreateJobRequirementRequest $request)
    {
        $input = $request->all();

        $jobRequirement = $this->jobRequirementRepository->create($input);

        Flash::success('Job Requirement saved successfully.');

        return redirect(route('jobRequirements.index',['job_target_id'=>$jobRequirement->job_target_id]));
    }

    /**
     * Display the specified JobRequirement.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jobRequirement = $this->jobRequirementRepository->find($id);

        if (empty($jobRequirement)) {
            Flash::error('Job Requirement not found');

            return redirect(route('jobRequirements.index'));
        }

        return view('job_requirements.show')->with('jobRequirement', $jobRequirement);
    }

    /**
     * Show the form for editing the specified JobRequirement.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jobRequirement = $this->jobRequirementRepository->find($id);
        $session_id = $jobRequirement->jobTarget->assessmentSession->id;
        $competencyModels = AssessmentSession::find($session_id)->competencyModels;
        $items = array();
        foreach ($competencyModels as $competencyModel) {
            $competencies = CompetencyModels::find($competencyModel->id)->competencies;
            foreach ($competencies as $competency) {
                $items[$competency->id] = $competency->code.' - '.$competency->name;
            }
        }

        if (empty($jobRequirement)) {
            Flash::error('Job Requirement not found');

            return redirect(route('jobRequirements.index'));
        }

        return view('job_requirements.edit', compact('jobRequirement','items'));
    }

    /**
     * Update the specified JobRequirement in storage.
     *
     * @param int $id
     * @param UpdateJobRequirementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobRequirementRequest $request)
    {
        $jobRequirement = $this->jobRequirementRepository->find($id);

        if (empty($jobRequirement)) {
            Flash::error('Job Requirement not found');

            return redirect(route('jobRequirements.index'));
        }

        $jobRequirement = $this->jobRequirementRepository->update($request->all(), $id);

        Flash::success('Job Requirement updated successfully.');

        return redirect(route('jobRequirements.index',['job_target_id'=>$jobRequirement->job_target_id]));
    }

    /**
     * Remove the specified JobRequirement from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jobRequirement = $this->jobRequirementRepository->find($id);

        if (empty($jobRequirement)) {
            Flash::error('Job Requirement not found');

            return redirect(route('jobRequirements.index'));
        }

        $this->jobRequirementRepository->delete($id);

        Flash::success('Job Requirement deleted successfully.');

        return redirect(route('jobRequirements.index'));
    }
}
