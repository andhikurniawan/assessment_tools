<?php

namespace App\Http\Controllers;

use App\Models\Competency_Relation;
use App\Models\Competency;
use App\Models\Company;
use App\Models\Competency_Model;

use Illuminate\Http\Request;

class CompetencyRelationController extends Controller
{
    
    public function store(CompetencyModel $competencyModel, Request $request)
    {
    	$competencyModel->competencies()->attach(request('competency_id'));

    	return back();
    }

    public function destroy(CompetencyModel $competencyModel, competency $competency)
    {
    	$competencyModel->competencies()->detach($competency->id);

    	return back();
    }
}
