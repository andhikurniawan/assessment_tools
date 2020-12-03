<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use App\Imports\ParticipantImport;

class participantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = DB::table('user')->select("employee_id")->get();

        return view("participant.index", compact("id"));
    }

    public function detail(Request $request)
    {

        $method = $request->method;

        if($method == "Manual")
        {
            $idassesse = $request->assesse;
            $idassessor = $request->assessor;

            $id = DB::table('user')->select("employee_id")->get();

            $assesse = DB::table('user')->select('name', 'email')->where('employee_id', $idassesse)->first();
            $assessor = DB::table('user')->select('name', 'email')->where('employee_id', $idassessor)->first();

            $relation = $request->relation;
            $status = $request->status;
            $participants = "";

            return view("participant.detail", compact("assesse", "participants", "assessor", "relation", "status", "id", "method"));
        }
        else if($method == "Upload")
        {
            $file = $request->file;

            $data = Excel::toArray(new ParticipantImport(), $file);

            $participant = [];
            $participants = [];
            $group = [];

            $relation = "";
            $status = "";

            $assesse = "";
            $assessor = "";

            $id = DB::table('user')->select("employee_id")->get();

            for($i = 1; $i < count($data[0]); $i++)
            {
                if($data[0][$i][5] != null)
                {
                    array_push($group, $data[0][$i][5]);
                }
                else 
                {
                    array_splice($data[0], $i , 1);
                }
            }

            $group = array_values(array_unique($group));

            for($i = 0; $i < count($group); $i++)
            {
                $participant[$i] = [];

                for($j = 1; $j < count($data[0]); $j++)
                {
                    if($data[0][$j][5] == $group[$i])
                    {   
                        array_push($participant[$i], $data[0][$j]);

                        $data[0][$i] = null;
                    }
                }
            }

            $assesse = [];
            
            for($i = 0; $i < count($participant); $i++)
            {   
                $assessor = [];
                $assesse[$i] = (object) array("name" => $participant[0][0][0], "email" => $participant[0][0][0], "assessor" => $assessor);

                for($j = 0; $j < count($participant[$i]); $j++)
                {
                    $assessorDetail = (object) array("name" => $participant[$i][$j][2], "email" => $participant[$i][$j][3], "relation" => $participant[$i][$j][4], "status" => "Yet to started");

                    array_push($assessor, $assessorDetail);
                }

                $assesse[$i]->assessor = $assessor;

                array_push($participants, $assesse[$i]);
            }

            //dd($participants);

            return view("participant.detail", compact("participants", "id", "method", "assesse", "assessor", "relation", "status"));
        }
    }

    public function cari(Request $request)
    {
        $idassesse = $request->assesse;
        $idassessor = $request->assessor;

        $assesse = DB::table('user')->select('name', 'email')->where('employee_id', $idassesse)->first();
        $assessor = DB::table('user')->select('name', 'email')->where('employee_id', $idassessor)->first();

        return response()->json(compact("assesse", "assessor"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
