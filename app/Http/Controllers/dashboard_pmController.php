<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createdashboard_pmRequest;
use App\Http\Requests\Updatedashboard_pmRequest;
use App\Repositories\dashboard_pmRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Competency;
use App\Models\Competency_Model;
use App\Models\Competency_Group;
use Illuminate\Http\Request;
use Flash;
use Response;

class dashboard_pmController extends AppBaseController
{
    /** @var  dashboard_pmRepository */
    private $dashboardPmRepository;

    public function __construct(dashboard_pmRepository $dashboardPmRepo)
    {
        $this->dashboardPmRepository = $dashboardPmRepo;
    }

    /**
     * Display a listing of the dashboard_pm.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $competencies = Competency::join('competency_group', 'competency.competency_group_id', '=', 'competency_group.id')
        ->join('company', 'company.id', '=', 'company.id')
        ->select('competency.id','competency.name', 'competency.code', 'competency.status', 'competency.type', 
        'competency.question', 'company.name as company_name', 'competency_group.name as group_name')
        ->where('status', 'public')
        ->orWhere('status', '')
        ->orWhere('status', null)
        ->get();

        $grupkompetensi = Competency_Group::count('name');
        $kompetensi = Competency::count('name');
        $modelkompetensi = Competency_Model::count('name');
        $kamus = Competency::where('status', 'public')
        ->orWhere('status', '')
        ->orWhere('status', null)
        ->count('name');

            return view('dashboard_pms.index')->with([
                'competencies' => $competencies,
                'grupkompetensi' => $grupkompetensi,
                'kompetensi' => $kompetensi,
                'modelkompetensi' => $modelkompetensi,
                'kamus' => $kamus
            ]);

           
    }

    /**
     * Show the form for creating a new dashboard_pm.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard_pms.create');
    }

    /**
     * Store a newly created dashboard_pm in storage.
     *
     * @param Createdashboard_pmRequest $request
     *
     * @return Response
     */
    public function store(Createdashboard_pmRequest $request)
    {
        $input = $request->all();

        $dashboardPm = $this->dashboardPmRepository->create($input);

        Flash::success('Dashboard Pm saved successfully.');

        return redirect(route('dashboardPms.index'));
    }

    /**
     * Display the specified dashboard_pm.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dashboardPm = $this->dashboardPmRepository->find($id);

        if (empty($dashboardPm)) {
            Flash::error('Dashboard Pm not found');

            return redirect(route('dashboardPms.index'));
        }

        return view('dashboard_pms.show')->with('dashboardPm', $dashboardPm);
    }

    /**
     * Show the form for editing the specified dashboard_pm.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dashboardPm = $this->dashboardPmRepository->find($id);

        if (empty($dashboardPm)) {
            Flash::error('Dashboard Pm not found');

            return redirect(route('dashboardPms.index'));
        }

        return view('dashboard_pms.edit')->with('dashboardPm', $dashboardPm);
    }

    /**
     * Update the specified dashboard_pm in storage.
     *
     * @param int $id
     * @param Updatedashboard_pmRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedashboard_pmRequest $request)
    {
        $dashboardPm = $this->dashboardPmRepository->find($id);

        if (empty($dashboardPm)) {
            Flash::error('Dashboard Pm not found');

            return redirect(route('dashboardPms.index'));
        }

        $dashboardPm = $this->dashboardPmRepository->update($request->all(), $id);

        Flash::success('Dashboard Pm updated successfully.');

        return redirect(route('dashboardPms.index'));
    }

    /**
     * Remove the specified dashboard_pm from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dashboardPm = $this->dashboardPmRepository->find($id);

        if (empty($dashboardPm)) {
            Flash::error('Dashboard Pm not found');

            return redirect(route('dashboardPms.index'));
        }

        $this->dashboardPmRepository->delete($id);

        Flash::success('Dashboard Pm deleted successfully.');

        return redirect(route('dashboardPms.index'));
    }
}
