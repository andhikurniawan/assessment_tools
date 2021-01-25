<?php

namespace App\Http\Controllers;

use App\Models\Competency_Model;
use App\Models\Competency;

use Illuminate\Http\Request;

class CompetencyRelationController extends Controller
{
    
    

    public function addCompetency(Request $request,$competencyModel_id){
        $competencyModel = Competency_Model::findOrFail($competencyModel_id);
    
        if($competencyModel->competencies()->where("competency_models_id",$competencyModel_id)->where("competency_id",$request["competency"])->get()->isEmpty()){
            $competencyModel->competencies()->attach($request["competency"]);
        }else{
            Flash::error('Competency already exist');
    //            Flash::alert()
        }
        return redirect(route("competencyModels.show",$competencyModel_id));
    }

    public function destroy(Competency_Model $competencyModel, Competency $competency)
    {
    	$competencyModel->competencies()->detach($competency->id);

    	return back();
    }
}
