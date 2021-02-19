<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use stdClass;
use Auth;

class sessionController extends Controller
{
    public function index(Request $request)
    {
        $id = Auth::user()->id;

        $role = DB::table("user_role")
                ->where("user_id", $id)
                ->select("role_id")
                ->first();

        if($role->role_id == "user")
        {
            $model = $request->models;
            $assesse = $request->assesse;
            $session = $request->session;
            $relation = $request->relation;

            $questionss = [];
            $models = [];   
            
            $assesse_id = DB::table("user")
                        ->where("id", $assesse)
                        ->select("name")
                        ->first(); 
                                               
            $session_id = DB::table("assessment_session")
            ->where("id",  $session)
            ->select("name", "start_date", "end_date")
            ->first();
        
            for($i = 0; $i < count($model); $i++)
            {
                $question = DB::table("competency_relation")
                        ->join("competency", "competency.id", "=", "competency_relation.competency_id")
                        ->where("competency_relation.competency_models_id", $model[$i])
                        ->select("competency_relation.competency_id")
                        ->get();

                array_push($questionss, $question);
            }

            $temp_question = [];

            for($i = 0; $i < count($questionss); $i++)
            {
                for($j = 0; $j < count($questionss[$i]); $j++)
                {
                    array_push($temp_question, $questionss[$i][$j]->competency_id);
                }
            }

            $questionss = $temp_question;

            $comp_id = [];

            $questionss = array_unique($questionss);
            $questionss = array_values($questionss);

            for($i = 0; $i < count($questionss); $i++)
            {
                $temp = $questionss[$i];

                unset($questionss[$i]);

                $competency = new stdClass();
                $competency->id = $temp;
                $competency->question = "";
                $competency->key_behaviour = [];

                $questionss[$i] = $competency;
            }

            for($i = 0; $i < count($questionss); $i++)
            {
                $key_behaviours = DB::table("key_behaviour")
                                    ->where("competency_id", $questionss[$i]->id)
                                    ->get();

                for($j = 0; $j < count($key_behaviours); $j++)
                {   
                    $key_behaviour = new stdClass();
                    $key_behaviour->key_behaviour = $key_behaviours[$j]->description;
                    $key_behaviour->level = $key_behaviours[$j]->level;

                    array_push($questionss[$i]->key_behaviour, $key_behaviour);
                }
            }

            for($i = 0; $i < count($questionss); $i++)
            {   
                $question = DB::table("competency")
                            ->where("id", $questionss[$i]->id)
                            ->select("question")
                            ->first();
                            
                $questionss[$i]->question = $question->question;
            }

            return view("session.index", compact("questionss", "assesse", "session", "relation", "assesse_id", "session_id"));
        }
        else if($role->role_id == "superadmin" || $role->role_id == "admin")
        {
            return redirect("home");
        }

        
    }

    public function simpan(Request $request)
    {   
        $assesse = $request->assesse;
        $session = $request->session;
        $relation = $request->relation;
        $count = $request->count;

        $map = DB::table("assessor_map")
                ->where("userid_assessor", Auth::user()->id)
                ->where("userid_assessee", $assesse)
                ->where("session_id", $session)
                ->select("id")
                ->first();

        $answers = [];

        for($i = 0; $i < $count; $i++)
        {   
            $curr_answer = request($i);

            $curr_answer = explode("-", $curr_answer);

            $answer = new stdClass();
            $answer->id = $curr_answer[0];
            $answer->answer = $curr_answer[1];

            array_push($answers, $answer);
        }

        $id = "";

        for($i = 0; $i < count($answers); $i++)
        {
            $id = DB::table("assessor_answer")->insert(["map_id" => $map->id, "competency_id" => $answers[$i]->id, "behaviour_level" => $answers[$i]->answer, "userid_assessee" => $assesse, "userid_assessor" => Auth::user()->id]);
        }
    
        DB::table("assessor_map")
            ->where("id", $map->id)
            ->limit(1)
            ->update(["status" => "done"]);

        $maps = DB::table("assessor_map")
                    ->where("session_id", $session)
                    ->get();

        $not_finished = 0;

        for($i = 0; $i < count($maps); $i++)
        {
            if($maps[$i]->status != "done")
            {
                $not_finished += 1;
            }
        }

        if($not_finished == 0)
        {
            DB::table("assessment_session")
                    ->where("id", $session)
                    ->limit(1)
                    ->update(["status" => "finished"]);

            $assesse = [];

            $participants = DB::table("assessor_map")
                            ->where("session_id", $session)
                            ->get();

            for($i = 0; $i < count($participants); $i++)
            {
                array_push($assesse, $participants[$i]->userid_assessee);
            }

            $assesse = array_unique($assesse);
            $assesse = array_values($assesse);

            $temp_participants = $participants;

            $participants = [];

            for($i = 0; $i < count($assesse); $i++)
            {
                $participant = new stdClass();
                $participant->assesse = $assesse[$i];
                $participant->assessor = [];

                for($j = 0; $j < count($temp_participants); $j++)
                {   
                    if($assesse[$i] == $temp_participants[$j]->userid_assessee)
                    {
                        $assessor = new stdClass();
                        $assessor->id = $temp_participants[$j]->id;
                        $assessor->bobot = $temp_participants[$j]->bobot;
                        $assessor->assessor = $temp_participants[$j]->userid_assessor;

                        array_push($participant->assessor, $assessor);
                    }
                }

                array_push($participants, $participant);
            }

            //dd($participants);

            $answers_final = [];
            $test = "";

            // dd($participants);

            //dd(count($participants[0]->assessor));


            for($i = 0; $i < count($participants); $i++)
            {
            
                $levels = new stdClass();
                $levels->assessor = [];

                for($y = 0; $y < count($participants[$i]->assessor); $y++)
                {
                    $level = DB::table("assessor_answer")
                            ->join("assessor_map", "assessor_map.id", "=", "assessor_answer.map_id")
                            ->where("assessor_map.id", $participants[$i]->assessor[$y]->id)
                            ->select("competency_id", "behaviour_level", "bobot")
                            ->get();

                    array_push($levels->assessor, $level);
                                                                   
                }

                //$count = count($levels->assessor[0]);

                // dd($participants);     

                for($j = 0; $j < count($levels->assessor); $j++)
                {   
                    //dd($levels->assessor);

                    for($k = 0; $k < count($levels->assessor[$j]); $k++)
                    {    
                        $answers = [];
                        $answers_bobot = [];
                        $id = "";
                        
                        for($l = 0; $l < count($levels->assessor); $l++)
                        {   
                            $id = $levels->assessor[$l][$k]->competency_id;
                            array_push($answers, $levels->assessor[$l][$k]->behaviour_level);
                            array_push($answers_bobot, $levels->assessor[$l][$k]->behaviour_level);
                        }
                        
                        $mean = array_sum($answers_bobot) / count($answers_bobot);
                        $max = max($answers);
                        $min = min($answers);
                        $median = 0;
                        $modus = 0;
                        $firstq = 0;
                        $thirdq = 0;

                        if(count($answers_bobot) % 2 == 0)
                        {
                            $median = ($answers_bobot[(count($answers_bobot) / 2) - 1] + $answers_bobot[(count($answers_bobot) / 2)]) / 2; 
                        }
                        else if(count($answers_bobot) != 0)
                        {
                            $median = $answers[intval(floor(count($answers_bobot) / 2))];
                        }

                        $multiDArr = [];

                        for ($x = 0; $x < count($answers_bobot); $x++) 
                        {
                            $key = $answers_bobot[$x];

                            if (isset($multiDArr[$key])) 
                            {
                                $multiDArr[$key] = $multiDArr[$key] + 1;
                            } else
                            {
                                $multiDArr[$key] = 1;
                            }
                        }

                        $highestOccuring = 0;
                        $highestOccuringKey = null;

                        foreach ($multiDArr as $key => $value) {

                            if ($value > $highestOccuring) {
                                $highestOccuring = $value;
                                $highestOccuringKey = $key;
                            }

                        }

                        

                        $modus = $highestOccuringKey;

                        $variance = 0.0;

                        for($x = 0; $x < count($answers); $x++)
                        {
                            $variance += pow(($answers[$x] - $mean), 2);
                        }

                        $stdev = (float)sqrt($variance / count($answers));

                        //dd(count($participants));

                        // if(count($participants) > 2)
                        // {
                        //     $firstq = $this->Quartile_75($answers);
                        //     $thirdq = $this->Quartile_25($answers);
                        // }   

                        $assessee = $participants[$i]->assesse;

                        $answer = new stdClass();
                        $answer->mean = $mean;
                        $answer->max = $max;
                        $answer->min = $min;
                        $answer->stdev = $stdev;
                        $answer->median = $median;
                        $answer->modus = $modus;
                        $answer->firstq = $firstq;
                        $answer->thirdq = $thirdq;
                        $answer->assesse = $assessee;
                        $answer->session = $session;
                        $answer->competency = $id;

                        $test .= "-" . $assessee;

                        array_push($answers_final, $answer);
                    }
                }

                for($q = 0; $q < $count; $q++)
                {
                    DB::table("assessment_competency_result")
                        ->insert(["session_id" => $answers_final[$q]->session, 
                                "userid_assessee" => $answers_final[$q]->assesse, 
                                "competency_id" => $answers_final[$q]->competency, 
                                "average_level" => $answers_final[$q]->mean, 
                                "min_level" => $answers_final[$q]->min, 
                                "max_level" => $answers_final[$q]->max, 
                                "std_dev" => $answers_final[$q]->stdev, 
                                "third_quartile" => $answers_final[$q]->thirdq,
                                "first_quartile" => $answers_final[$q]->firstq, 
                                "modus_level" => $answers_final[$q]->modus, 
                                "median_level" => $answers_final[$q]->median]);        
                }

                $answers_final = [];
            }
        }

        return redirect("/assessmentUser");
    }

    // public function Quartile($Array, $Quartile) {
    
    //     // quartile position is number in array + 1 multiplied by the quartile i.e. 0.25, 0.5, 0.75
    //     $pos = (count($Array) + 1) * $Quartile;

    //     // if the position is a whole number
    //     // return that number as the quarile placing

    //     if ( fmod($pos, 1) == 0)
    //     {   
    //         return $Array[$pos - 1];
    //     }
    //     else
    //     {
    //         // get the decimal i.e. 5.25 = .25
    //         $fraction = $pos - floor($pos);
    
    //         // get the values in the array before and after position
    //         $lower_num = $Array[intval(floor($pos)-1)];
    //         $upper_num = $Array[ceil($pos)-2];
    
    //         // get the difference between the two
    //         $difference = $upper_num - $lower_num;
        
    //         // the quartile value is then the difference multipled by the decimal
    //         // add to the lower number
    //         return $lower_num + ($difference * $fraction);
    //     }
    // }

    // public function Quartile_25($Array) {
    //     return $this->Quartile($Array, 0.25);
    // }
    
    // public function Quartile_50($Array) {
    //     return $this->Quartile($Array, 0.5);
    // }
    
    // public function Quartile_75($Array) {
    //     return $this->Quartile($Array, 0.75);
    // }
}