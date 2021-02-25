<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Repositories\TeamRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use App\Models\AssessmentSession;
use App\Models\Team;
use App\Models\JobTargets;
use App\Models\JobRequirement;

class TeamController extends AppBaseController
{
    /** @var  TeamRepository */
    private $teamRepository;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;
    }

    /**
     * Display a listing of the Team.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $teams = $this->teamRepository->all();

        return view('teams.index')
            ->with('teams', $teams);
    }

    /**
     * Show the form for creating a new Team.
     *
     * @return Response
     */
    public function create()
    {
        $sessions = AssessmentSession::pluck('name','id');
        return view('teams.create',compact('sessions'));
    }

    /**
     * Store a newly created Team in storage.
     *
     * @param CreateTeamRequest $request
     *
     * @return Response
     */
    public function store(CreateTeamRequest $request)
    {
        $input = $request->all();

        $team = $this->teamRepository->create($input);

        Flash::success('Team saved successfully.');

        return redirect(route('teams.index'));
    }

    /**
     * Display the specified Team.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect(route('teams.index'));
        }

        return view('teams.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified Team.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect(route('teams.index'));
        }
        $sessions = AssessmentSession::pluck('name','id');

        return view('teams.edit', compact('team','sessions'));
    }

    /**
     * Update the specified Team in storage.
     *
     * @param int $id
     * @param UpdateTeamRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeamRequest $request)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect(route('teams.index'));
        }

        $team = $this->teamRepository->update($request->all(), $id);

        Flash::success('Team updated successfully.');

        return redirect(route('teams.index'));
    }

    /**
     * Remove the specified Team from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect(route('teams.index'));
        }

        $this->teamRepository->delete($id);

        Flash::success('Team deleted successfully.');

        return redirect(route('teams.index'));
    }

    public function duplicate($id)
    {
        $team = $this->teamRepository->find($id);

        $jobTargets = $team->jobTargets;

        if (empty($team)) {
            Flash::error('Team not found');

            return redirect(route('teams.index'));
        }

        DB::beginTransaction();
        try
        {
            $insertTeam = [
                    'name' => $team->name."(copy)",
                    'assessment_session_id' => $team->assessment_session_id
            ];
            $resultTeam = Team::create($insertTeam);
            foreach ($jobTargets as $jobTarget) {
                //getAll Requirement
                $jobRequirements = $jobTarget->jobTargets;

                $insertJT = [
                    'assessment_session_id' => $resultTeam->assessment_session_id,
                    'number_position' => $jobTarget->number_position,
                    'job_name' => $jobTarget->job_name."_copy",
                    'job_code' => $jobTarget->job_code,
                    'team_id' => $resultTeam->id
                ];
                $resultJT = JobTargets::create($insertJT);

                // $insertJobReqs = array();
                foreach ($jobRequirements as $jobRequirement) {
                    $insertJobReq = [
                        'job_target_id' => $resultJT->id,
                        'competency_id' => $jobRequirement->competency_id,
                        'skill_level' => $jobRequirement->skill_level,
                    ];
                    JobRequirement::create($insertJobReq);
                }

            }

            DB::commit();
            Flash::success('Team, Job Target, and Job Requirement duplicate successfully.');
        } catch (\Exception $e){
            DB::rollback();
            Flash::error('Team, Job Target, and Job Requirement duplicate fail.'.$e);
        }

        return redirect(route('jobTargets.index'));
    }
}
