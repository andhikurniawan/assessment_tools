<?php

namespace App\Http\Controllers;

use App\Models\Competency_Model;
use App\Models\Competency;

use Illuminate\Http\Request;

class CompetencyRelationController extends Controller
{
    
    public function store(Competency_Model $competencyModel, Request $request)
    {
    	$competencyModel->competencies()->attach(request('competency_id'));

    	return back();
    }

    public function destroy(Competency_Model $competencyModel, Competency $competency)
    {
    	$competencyModel->competencies()->detach($competency->id);

    	return back();
    }
}
