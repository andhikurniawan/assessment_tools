<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssignmentResultRequest;
use App\Http\Requests\UpdateAssignmentResultRequest;
use App\Repositories\AssignmentResultRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AssignmentResultController extends AppBaseController
{
    /** @var  AssignmentResultRepository */
    private $assignmentResultRepository;

    public function __construct(AssignmentResultRepository $assignmentResultRepo)
    {
        $this->assignmentResultRepository = $assignmentResultRepo;
    }

    /**
     * Display a listing of the AssignmentResult.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $assignmentResults = $this->assignmentResultRepository->all();

        return view('assignment_results.index')
            ->with('assignmentResults', $assignmentResults);
    }

    /**
     * Show the form for creating a new AssignmentResult.
     *
     * @return Response
     */
    public function create()
    {
        return view('assignment_results.create');
    }

    /**
     * Store a newly created AssignmentResult in storage.
     *
     * @param CreateAssignmentResultRequest $request
     *
     * @return Response
     */
    public function store(CreateAssignmentResultRequest $request)
    {
        $input = $request->all();

        $assignmentResult = $this->assignmentResultRepository->create($input);

        Flash::success('Assignment Result saved successfully.');

        return redirect(route('assignmentResults.index'));
    }

    /**
     * Display the specified AssignmentResult.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assignmentResult = $this->assignmentResultRepository->find($id);

        if (empty($assignmentResult)) {
            Flash::error('Assignment Result not found');

            return redirect(route('assignmentResults.index'));
        }

        return view('assignment_results.show')->with('assignmentResult', $assignmentResult);
    }

    /**
     * Show the form for editing the specified AssignmentResult.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assignmentResult = $this->assignmentResultRepository->find($id);

        if (empty($assignmentResult)) {
            Flash::error('Assignment Result not found');

            return redirect(route('assignmentResults.index'));
        }

        return view('assignment_results.edit')->with('assignmentResult', $assignmentResult);
    }

    /**
     * Update the specified AssignmentResult in storage.
     *
     * @param int $id
     * @param UpdateAssignmentResultRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssignmentResultRequest $request)
    {
        $assignmentResult = $this->assignmentResultRepository->find($id);

        if (empty($assignmentResult)) {
            Flash::error('Assignment Result not found');

            return redirect(route('assignmentResults.index'));
        }

        $assignmentResult = $this->assignmentResultRepository->update($request->all(), $id);

        Flash::success('Assignment Result updated successfully.');

        return redirect(route('assignmentResults.index'));
    }

    /**
     * Remove the specified AssignmentResult from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assignmentResult = $this->assignmentResultRepository->find($id);

        if (empty($assignmentResult)) {
            Flash::error('Assignment Result not found');

            return redirect(route('assignmentResults.index'));
        }

        $this->assignmentResultRepository->delete($id);

        Flash::success('Assignment Result deleted successfully.');

        return redirect(route('assignmentResults.index'));
    }
}
