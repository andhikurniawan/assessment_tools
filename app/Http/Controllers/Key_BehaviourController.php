<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKey_BehaviourRequest;
use App\Http\Requests\UpdateKey_BehaviourRequest;
use App\Repositories\Key_BehaviourRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Key_Behaviour;
use Flash;
use Response;
use App\Models\Competency;
use App\Models\Company;
use App\Models\Competency_Model;
use DB;
use Auth;

class Key_BehaviourController extends AppBaseController
{
    /** @var  Key_BehaviourRepository */
    private $keyBehaviourRepository;

    public function __construct(Key_BehaviourRepository $keyBehaviourRepo)
    {
        $this->keyBehaviourRepository = $keyBehaviourRepo;
    }

    /**
     * Display a listing of the Key_Behaviour.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keyBehaviours = $this->keyBehaviourRepository->all();

        return view('key__behaviours.index')
            ->with('keyBehaviours', $keyBehaviours);
    }

    /**
     * Show the form for creating a new Key_Behaviour.
     *
     * @return Response
     */
    public function create()
    {
        $levels = Key_Behaviour::$levels;
        $competencies = Competency::all()->pluck('name','id');
        return view('key__behaviours.create', compact('levels', 'competencies'));
    }

    /**
     * Store a newly created Key_Behaviour in storage.
     *
     * @param CreateKey_BehaviourRequest $request
     *
     * @return Response
     */
    public function store(CreateKey_BehaviourRequest $request)
    {
        $input = $request->all();

        $keyBehaviour = $this->keyBehaviourRepository->create($input);

        Flash::success('Key  Behaviour saved successfully.');

        return redirect(route('competencies.index'));
    }

    /**
     * Display the specified Key_Behaviour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $keyBehaviour = $this->keyBehaviourRepository->find($id);

        if (empty($keyBehaviour)) {
            Flash::error('Key  Behaviour not found');

            return redirect(route('keyBehaviours.index'));
        }

        return view('key__behaviours.show')->with('keyBehaviour', $keyBehaviour);
    }

    /**
     * Show the form for editing the specified Key_Behaviour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $keyBehaviour = $this->keyBehaviourRepository->find($id);
        $levels = Key_Behaviour::$levels;
        $competencies = Competency::all()->pluck('name','id');

        if (empty($keyBehaviour)) {
            Flash::error('Key  Behaviour not found');

            return redirect(route('keyBehaviours.index'));
        }

        return view('key__behaviours.edit', compact('keyBehaviour', 'levels', 'competencies'));
      
    }

    /**
     * Update the specified Key_Behaviour in storage.
     *
     * @param int $id
     * @param UpdateKey_BehaviourRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKey_BehaviourRequest $request)
    {
        $keyBehaviour = $this->keyBehaviourRepository->find($id);

        if (empty($keyBehaviour)) {
            Flash::error('Key  Behaviour not found');

            return redirect(route('competencies.index'));
        }

        $keyBehaviour = $this->keyBehaviourRepository->update($request->all(), $id);

        Flash::success('Key  Behaviour updated successfully.');

        return redirect(route('competencies.index'));
    }

    /**
     * Remove the specified Key_Behaviour from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $keyBehaviour = $this->keyBehaviourRepository->find($id);

        if (empty($keyBehaviour)) {
            Flash::error('Key  Behaviour not found');

            return redirect(route('competencies.index'));
        }

        $this->keyBehaviourRepository->delete($id);

        Flash::success('Key  Behaviour deleted successfully.');

        return redirect(route('competencies.index'));
        
    }
}
