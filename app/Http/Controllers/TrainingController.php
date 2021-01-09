<?php

namespace App\Http\Controllers;

use App\Track_project_emp;
use App\Track_training_emp;
use App\Training;
use App\Training_emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('training.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session','assessment_competency_result.session_id', '=', 'assessment_session.id')->distinct()->get();
        $employee = DB::table('user')->get();
        $training = Training::all();
        return view('training.create')->with('assessment_result', $assessment_result)->with('employee', $employee)->with('training', $training);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'host' => 'required|min:3',
            'duration' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required|min:3',

        ], [
            'name.required' => 'Nama pelatihan tidak boleh kosong',
            'host.required' => 'Nama pelaksana pelatihan tidak boleh kosong',
            'duration.required' => 'Durasi pelatihan tidak boleh kosong',
            'start_date.required' => 'Tanggal mulai pelatihan tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai pelatihan tidak boleh kosong',
            'description.required' => 'Deskripsi pelatihan tidak boleh kosong'
        ]);
        $link = "";
        if ($request->link == null) {
            $link = "Tidak ada";
        } else {
            $link = $request->link;
        }
        Training::create([
            'name' => $request->name,
            'host' => $request->host,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'link' => $link
        ]);

        $id = DB::getPdo()->lastInsertId();
        $size = count(collect($request)->get('competency'));
        for ($i = 0; $i < $size; $i++) {
            DB::table('training_competencies')->insert(
                ['id_training' => $id, 'id_competency' => $request->get('competency')[$i]]
            );
        }

        return redirect('training/master')->with('status', 'Data pelatihan berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        $training_competency = DB::table('training_competencies')->select('training_competencies.id','id_competency', 'competency.name')->join('training', 'training.id', '=', 'training_competencies.id_training', 'inner')->join('competency', 'competency.id', '=', 'training_competencies.id_competency', 'inner')->where('training.id', '=', $training->id)->get();
        return view('training/show')->with('training', $training)->with('training_competency', $training_competency);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        $training_competency = DB::table('training_competencies')->select('training_competencies.id','id_competency', 'competency.name')->join('training', 'training.id', '=', 'training_competencies.id_training', 'inner')->join('competency', 'competency.id', '=', 'training_competencies.id_competency', 'inner')->where('training.id', '=', $training->id)->get();
        // dd($training_competency);
        $competency = DB::table('competency')->get();
        return view('training/edit')->with('training', $training)->with('training_competency', $training_competency)->with('competency', $competency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        $request->validate([
            'name' => 'required|min:3',
            'host' => 'required|min:3',
            'duration' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required|min:3',

        ], [
            'name.required' => 'Nama pelatihan tidak boleh kosong',
            'host.required' => 'Nama pelaksana pelatihan tidak boleh kosong',
            'duration.required' => 'Durasi pelatihan tidak boleh kosong',
            'start_date.required' => 'Tanggal mulai pelatihan tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai pelatihan tidak boleh kosong',
            'description.required' => 'Deskripsi pelatihan tidak boleh kosong'
        ]);
        $link = "";
        if ($request->link == null) {
            $link = "Tidak ada";
        } else {
            $link = $request->link;
        }
        Training::where('id', $training->id)
            ->update([
                'name' => $request->name,
                'host' => $request->host,
                'duration' => $request->duration,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'link' => $link
            ]);

        return redirect('training/master')->with('status', 'Data pelatihan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        $training->delete();

        return redirect('training/master')->with('status', 'Data pelatihan berhasil dihapus!');
    }

    public function dashboard()
    {
        $assessment_session_count = DB::table('assessment_session')->select('status')->where('status', '=', 'finished')->count();
        $training_recommnedation_count = Training_emp::all()->count();
        $track_record_count = Track_training_emp::where('status', '=', 'Menunggu')->count();
        $success_count = Track_project_emp::where('status', '=', 'Selesai')->count();
        $failed_count = Track_project_emp::where('status', '=', 'Gagal')->count();

        return view('training.index')->with([
            'assessment_count' => $assessment_session_count,
            'training_count' => $training_recommnedation_count,
        'track_count' => $track_record_count,
        'success_count' => $success_count,
        'failed_count' => $failed_count,
        ]);
    }
    public function recommendation()
    {
        if(session('permission') == "admin"){
            $training_emp = Training_emp::all();
        return view('training.recommendation')->with('training_emp',$training_emp);
        } else {
            $training_emp = Training_emp::all()->where('user_id', Auth::id());
        return view('user.training-recommendation.index')->with('training_emp',$training_emp);

        }
        // dd($training_emp);
    }

    public function master()
    {
        $training = Training::all();
        return view('training.master', compact('training'));
    }

    public function master_create()
    {
        $competency = DB::table('competency')->get();
        // dd($competency);
        return view('training.create_master')->with('competency', $competency);
    }

    public function delete_competency($id, Request $request)
    {
        $id_training = $request->id_training;
        DB::table('training_competencies')->where('id', $id)->delete();
        return redirect('training/'.$id_training.'/edit')->with('status', 'Kompetensi berhasil dihapus!');
    }

    public function insert_competency(Request $request)
    {
                
        $id = $request->id_training;
        $size = count(collect($request)->get('competency'));
        for ($i = 0; $i < $size; $i++) {
            DB::table('training_competencies')->insert(
                ['id_training' => $id, 'id_competency' => $request->get('competency')[$i]]
            );
        }
        return redirect('training/'.$id.'/edit')->with('status', 'Kompetensi berhasil ditambahkan!');

    }

    public function getTrainingDetails($id)
    {
        $data = Training::find($id);
        return response()->json(['success'=>true,'data' => $data]);
    }

    public function addRecommendation(Request $request)
    {
        $reason = "";
        if ($request->reason == null){
            $reason = "Tidak ada";
        } else {
            $reason = $request->reason;
        }
        $status = "";
        if ($request->trainingType == "Opsional"){
            $status = "Menunggu Respon";
        } else {
            $status = "Wajib";
        }

        Training_emp::create([
            'user_id' => $request->userId,
            'id_training' => $request->trainingDropdown,
            'status' => $status,
            'type' => $request->trainingType,
            'recommended_by' => $request->recommendedBy,
            'reason' => $reason
        ]);
        
        return redirect('training/recommendation')->with('status', 'Rekomendasi Pelatihan Berhasil di Tambahkan!');
    }

    public function detailRecommendation($id)
    {
        $training_emp = Training_emp::all()->where('id', $id);
        // dd($training_emp);
        return view('training.details_recommendation')->with('training_emp', $training_emp);
    }

    public function editRecommedation($id)
    {
        $training_emp = Training_emp::all()->where('id', $id);
        // dd($training_emp);
        return view('training.edit_recommendation')->with('training_emp', $training_emp);
    }

    public function editRecommendationProcess(Request $request)
    {
        $status = "";
        if ($request->trainingType == "Wajib"){
            $status = "Wajib";
        } else if ($request->trainingType == "Opsional"){
            $status = "Menunggu Respon";
        }
         if ($request->cancelTraining == "Ya"){
            $status = "Dibatalkan";
        }
        Training_emp::where('id', $request->id_training_emp)->update([
            'status' => $status,
            'type' => $request->trainingType,
            'reason' => $request->reason
        ]);

        return redirect('training/recommendation')->with('status', 'Rekomendasi Pelatihan Berhasil di Ubah!');

    }

    public function recommendationVerification($id, Request $request)
    {
        $status = "";
        if ($request->option == "Terima"){
            $status = "Disetujui";
        } else if ($request->option == "Tolak"){
            $status = "Ditolak";
        }

        Training_emp::where('id', $request->id_training_emp)->update([
            'status' => $status
        ]);
        return redirect('training/recommendation')->with('status', 'Rekomendasi Pelatihan Berhasil '.$status);
    }
}
