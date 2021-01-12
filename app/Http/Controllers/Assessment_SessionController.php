<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssessment_SessionRequest;
use App\Http\Requests\UpdateAssessment_SessionRequest;
use App\Repositories\Assessment_SessionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\CompetencyModels;
use Flash;
use Response;
use DB;
use Session;
use App\Models\Company;
use App\Models\Assessment_Session;
use Auth;

class Assessment_SessionController extends AppBaseController
{
    /** @var  Assessment_SessionRepository */
    private $assessmentSessionRepository;

    public function __construct(Assessment_SessionRepository $assessmentSessionRepo)
    {
        $this->assessmentSessionRepository = $assessmentSessionRepo;
    }

    /**
     * Display a listing of the Assessment_Session.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
        $assessmentSessions = $this->assessmentSessionRepository->all();

        return view('assessment__sessions.index')
            ->with('assessmentSessions', $assessmentSessions);
        }
        else if($role->role_id == "user")
        {
            return redirect("assessmentUser");
        }
    }

    public function search(Request $request){
        $search=$request->get('search');
        $assessmentSessions = DB::table("assessment_session")->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('assessment__sessions.index')
        ->with('assessmentSessions', $assessmentSessions);
    }

    /**
     * Show the form for creating a new Assessment_Session.
     *
     * @return Response
     */
    public function create()
    {
        $company = Company::pluck('name','id');
        return view('assessment__sessions.create', compact("company"));
    }

    /**
     * Store a newly created Assessment_Session in storage.
     *
     * @param CreateAssessment_SessionRequest $request
     *
     * @return Response
     */
    public function store(CreateAssessment_SessionRequest $request)
    {
        $input = $request->all();

        // $assessmentSession = $this->assessmentSessionRepository->create($input);

        // Flash::success('Assessment  Session saved successfully.');

        $assesment = new Assessment_Session([
            "name" => $request->name,
            "category" => $request->category,
            "status" => $request->status,
            "expired" => $request->expired,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "company_id" => $request->company_id
        ]);

        session(["assesment" => $assesment]);

        return redirect(route('competencyModels.create'));

        // return redirect(route('assessmentSessions.addCompetencyModel'));
    }

    /**
     * Display the specified Assessment_Session.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assessmentSession = $this->assessmentSessionRepository->find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment  Session not found');

            return redirect(route('assessmentSessions.index'));
        }
        $items = CompetencyModel::pluck('name','id');
        $assignmentHeaders = $assessmentSession->assignmentHeaders;
        return view('assessment__sessions.show', compact('assessmentSession', 'items', 'assignmentHeaders'));
    }

    /**
     * Show the form for editing the specified Assessment_Session.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assessmentSession = $this->assessmentSessionRepository->find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment  Session not found');

            return redirect(route('assessmentSessions.index'));
        }

        return view('assessment__sessions.edit')->with('assessmentSession', $assessmentSession);
    }

    /**
     * Update the specified Assessment_Session in storage.
     *
     * @param int $id
     * @param UpdateAssessment_SessionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssessment_SessionRequest $request)
    {
        $assessmentSession = $this->assessmentSessionRepository->find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment  Session not found');

            return redirect(route('assessmentSessions.index'));
        }

        $assessmentSession = $this->assessmentSessionRepository->update($request->all(), $id);

        Flash::success('Assessment  Session updated successfully.');

        return redirect(route('assessmentSessions.index'));
    }

    /**
     * Remove the specified Assessment_Session from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assessmentSession = $this->assessmentSessionRepository->find($id);

        if (empty($assessmentSession)) {
            Flash::error('Assessment  Session not found');

            return redirect(route('assessmentSessions.index'));
        }

        $this->assessmentSessionRepository->delete($id);

        Flash::success('Assessment  Session deleted successfully.');

        return redirect(route('assessmentSessions.index'));
    }

    public function addCompetencyModel(){
        return view('assessment__sessions.addcompetencymodel');
    }
}
