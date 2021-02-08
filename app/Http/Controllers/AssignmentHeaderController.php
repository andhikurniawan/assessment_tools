<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssignmentHeaderRequest;
use App\Http\Requests\UpdateAssignmentHeaderRequest;
use App\Repositories\AssignmentHeaderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AssignmentHeaderController extends AppBaseController
{
    /** @var  AssignmentHeaderRepository */
    private $assignmentHeaderRepository;

    public function __construct(AssignmentHeaderRepository $assignmentHeaderRepo)
    {
        $this->assignmentHeaderRepository = $assignmentHeaderRepo;
    }

    /**
     * Display a listing of the AssignmentHeader.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $assignmentHeaders = $this->assignmentHeaderRepository->all();

        return view('assignment_headers.index')
            ->with('assignmentHeaders', $assignmentHeaders);
    }

    /**
     * Show the form for creating a new AssignmentHeader.
     *
     * @return Response
     */
    public function create()
    {
        return view('assignment_headers.create');
    }

    /**
     * Store a newly created AssignmentHeader in storage.
     *
     * @param CreateAssignmentHeaderRequest $request
     *
     * @return Response
     */
    public function store(CreateAssignmentHeaderRequest $request)
    {
        $input = $request->all();

        $assignmentHeader = $this->assignmentHeaderRepository->create($input);

        Flash::success('Assignment Header saved successfully.');

        return redirect(route('assignmentHeaders.index'));
    }

    /**
     * Display the specified AssignmentHeader.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assignmentHeader = $this->assignmentHeaderRepository->find($id);

        if (empty($assignmentHeader)) {
            Flash::error('Assignment Header not found');

            return redirect(route('assignmentHeaders.index'));
        }

        return view('assignment_headers.show')->with('assignmentHeader', $assignmentHeader)
                ->with('assignmentResults',$assignmentHeader->details);
    }

    /**
     * Show the form for editing the specified AssignmentHeader.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assignmentHeader = $this->assignmentHeaderRepository->find($id);

        if (empty($assignmentHeader)) {
            Flash::error('Assignment Header not found');

            return redirect(route('assignmentHeaders.index'));
        }

        return view('assignment_headers.edit')->with('assignmentHeader', $assignmentHeader);
    }

    /**
     * Update the specified AssignmentHeader in storage.
     *
     * @param int $id
     * @param UpdateAssignmentHeaderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssignmentHeaderRequest $request)
    {
        $assignmentHeader = $this->assignmentHeaderRepository->find($id);

        if (empty($assignmentHeader)) {
            Flash::error('Assignment Header not found');

            return redirect(route('assignmentHeaders.index'));
        }

        $assignmentHeader = $this->assignmentHeaderRepository->update($request->all(), $id);

        Flash::success('Assignment Header updated successfully.');

        return redirect(route('assignmentHeaders.index'));
    }

    /**
     * Remove the specified AssignmentHeader from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assignmentHeader = $this->assignmentHeaderRepository->find($id);

        if (empty($assignmentHeader)) {
            Flash::error('Assignment Header not found');

            return redirect(route('assignmentHeaders.index'));
        }

        $this->assignmentHeaderRepository->delete($id);

        Flash::success('Assignment Header deleted successfully.');

        return redirect(route('assignmentHeaders.index'));
    }
}
