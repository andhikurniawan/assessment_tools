<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebehaviorRequest;
use App\Http\Requests\UpdatebehaviorRequest;
use App\Repositories\behaviorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class behaviorController extends AppBaseController
{
    /** @var  behaviorRepository */
    private $behaviorRepository;

    public function __construct(behaviorRepository $behaviorRepo)
    {
        $this->behaviorRepository = $behaviorRepo;
    }

    /**
     * Display a listing of the behavior.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $behaviors = $this->behaviorRepository->all();

        return view('behaviors.index')
            ->with('behaviors', $behaviors);
    }

    /**
     * Show the form for creating a new behavior.
     *
     * @return Response
     */
    public function create()
    {
        return view('behaviors.create');
    }

    /**
     * Store a newly created behavior in storage.
     *
     * @param CreatebehaviorRequest $request
     *
     * @return Response
     */
    public function store(CreatebehaviorRequest $request)
    {
        $input = $request->all();

        $behavior = $this->behaviorRepository->create($input);

        Flash::success('Behavior saved successfully.');

        return redirect(route('behaviors.index'));
    }

    /**
     * Display the specified behavior.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $behavior = $this->behaviorRepository->find($id);

        if (empty($behavior)) {
            Flash::error('Behavior not found');

            return redirect(route('behaviors.index'));
        }

        return view('behaviors.show')->with('behavior', $behavior);
    }

    /**
     * Show the form for editing the specified behavior.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $behavior = $this->behaviorRepository->find($id);

        if (empty($behavior)) {
            Flash::error('Behavior not found');

            return redirect(route('behaviors.index'));
        }

        return view('behaviors.edit')->with('behavior', $behavior);
    }

    /**
     * Update the specified behavior in storage.
     *
     * @param int $id
     * @param UpdatebehaviorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebehaviorRequest $request)
    {
        $behavior = $this->behaviorRepository->find($id);

        if (empty($behavior)) {
            Flash::error('Behavior not found');

            return redirect(route('behaviors.index'));
        }

        $behavior = $this->behaviorRepository->update($request->all(), $id);

        Flash::success('Behavior updated successfully.');

        return redirect(route('behaviors.index'));
    }

    /**
     * Remove the specified behavior from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $behavior = $this->behaviorRepository->find($id);

        if (empty($behavior)) {
            Flash::error('Behavior not found');

            return redirect(route('behaviors.index'));
        }

        $this->behaviorRepository->delete($id);

        Flash::success('Behavior deleted successfully.');

        return redirect(route('behaviors.index'));
    }
}
