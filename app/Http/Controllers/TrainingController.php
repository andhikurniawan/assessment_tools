<?php

namespace App\Http\Controllers;

use App\Company;
use App\Competency;
use App\Jobs\TrainingRecommendationMailJob;
use App\Mail\TrainingRecommendationMail;
use App\Track_project_emp;
use App\Track_training_emp;
use App\Training;
use App\Training_competencies;
use App\Training_emp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.id as session_id')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session', 'assessment_competency_result.session_id', '=', 'assessment_session.id')->distinct()->get();
        $employee = DB::table('user')->join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->where('user_role.role_id', '=', 'user')->get();
            $training = Training::all();
        } else {
            $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.id as session_id')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session', 'assessment_competency_result.session_id', '=', 'assessment_session.id')->where('user.company_id',$user_company)->distinct()->get();
        $employee = DB::table('user')->join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->where('user_role.role_id', '=', 'user')->where('user.company_id',$user_company)->get();
            $training = Training::where('company_id',$user_company)->get();
        }
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
            'link' => $link,
            'company_id' => $request->company_id
        ]);

        $id = DB::getPdo()->lastInsertId();
        if ($request->competency != null) {
            $size = count(collect($request)->get('competency'));
            for ($i = 0; $i < $size; $i++) {
                DB::table('training_competencies')->insert(
                    ['id_training' => $id, 'id_competency' => $request->get('competency')[$i]]
                );
            }
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
        $training_competency = DB::table('training_competencies')->select('training_competencies.id', 'id_competency', 'competency.name')->join('training', 'training.id', '=', 'training_competencies.id_training', 'inner')->join('competency', 'competency.id', '=', 'training_competencies.id_competency', 'inner')->where('training.id', '=', $training->id)->get();
        $company = Company::where('id', $training->company_id)->get()->first();

        return view('training/show')->with('training', $training)->with('training_competency', $training_competency)->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        $training_competency = DB::table('training_competencies')->select('training_competencies.id', 'id_competency', 'competency.name')->join('training', 'training.id', '=', 'training_competencies.id_training', 'inner')->join('competency', 'competency.id', '=', 'training_competencies.id_competency', 'inner')->where('training.id', '=', $training->id)->get();
        // dd($training_competency);
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $company = Company::all();
            $competency = Competency::all();
        } else {
            $company = Company::where('id', $user_company)->get();
            $competency = Competency::join('competency_group', 'competency.competency_group_id', '=', 'competency_group.id')->where('competency_group.company_id', $user_company)->select('competency.*')->get();
        }
        return view('training/edit')->with('training', $training)->with('training_competency', $training_competency)->with('competency', $competency)->with('company', $company);
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
                'link' => $link,
                'company_id' => $request->company_id
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
        $company_id = Auth::user()->company_id;
        if($company_id == null){
            $assessment_session_count = DB::table('assessment_session')->select('status')->where('status','finished')->count();
            $training_recommnedation_count = Training_emp::join('user', 'user.id', '=', 'training_emps.user_id')->count();
            $track_record_count = Track_training_emp::where('status', '=', 'Menunggu')->count();
            $success_count = Track_project_emp::where('status', '=', 'Selesai')->count();
            $failed_count = Track_project_emp::where('status', '=', 'Gagal')->count();
        } else {
            $assessment_session_count = DB::table('assessment_session')->select('status')->where('status','finished')->where('company_id',$company_id)->count();
            $training_recommnedation_count = Training_emp::join('user', 'user.id', '=', 'training_emps.user_id')->where('user.company_id', $company_id)->count();
            $track_record_count = Track_training_emp::join('user', 'user.id', '=', 'track_training_emps.user_id')->where('status', '=', 'Menunggu')->where('user.company_id','=',$company_id)->count();
            $success_count = Track_project_emp::join('user', 'user.id', '=', 'track_project_emps.user_id')->where('status', '=', 'Selesai')->where('user.company_id','=',$company_id)->count();
            $failed_count = Track_project_emp::join('user', 'user.id', '=', 'track_project_emps.user_id')->where('status', '=', 'Gagal')->where('user.company_id','=',$company_id)->count();
        }

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
        if (Auth::check() == null) {
            return redirect('home')->with('alert', 'Anda harus login terlebih dahulu!');
        }
        if (session('permission') == "admin" || session('permission') == "admin_tnd" || session('permission') == "superadmin") {
            $company_id = Auth::user()->company_id;
            if ($company_id == null) {
                $training_emp = Training_emp::join('user', 'user.id', '=', 'training_emps.user_id')->join('training', 'training.id', '=', 'training_emps.id_training')->select('training_emps.status as status', 'user.name as user_name', 'training.*', 'training_emps.id as training_rec_id')->get();
            } else {
            $training_emp = Training_emp::join('user', 'user.id', '=', 'training_emps.user_id')->join('training', 'training.id', '=', 'training_emps.id_training')->where('user.company_id', $company_id)->select('training_emps.status as status', 'user.name as user_name', 'training.*', 'training_emps.id as training_rec_id')->get();
            }
        // dd($training_emp);

            return view('training.recommendation')->with('training_emp', $training_emp);
        } else {
            $training_emp = Training_emp::join('user', 'user.id', '=', 'training_emps.user_id')->join('training', 'training.id', '=', 'training_emps.id_training')->select('training_emps.status as status', 'user.name as user_name', 'training.*', 'training_emps.id as training_rec_id')->where('training_emps.user_id', Auth::user()->id)->get();
            // dd($training_emp);
            return view('user.training-recommendation.index')->with('training_emp', $training_emp);
        }
    }

    public function master()
    {
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $training = Training::all();
        } else {
         $training = Training::where('company_id',$user_company)->get();
        }
        return view('training.master', compact('training'));
    }

    public function master_create()
    {
        $user_company = Auth::user()->company_id;
        if ($user_company == null) {
            $company = Company::all();
            $competency = Competency::all();
        } else {
            $company = Company::where('id', $user_company)->get();
            $competency = DB::table('assessment_relation')->join('assessment_session', 'assessment_relation.assessment_session_id', '=', 'assessment_session.id')
            ->join('competency_relation', 'assessment_relation.competency_models_id', '=', 'competency_relation.competency_models_id')
            ->rightJoin('competency', 'competency.id', '=', 'competency_relation.competency_id')
            ->rightJoin('competency_group', 'competency.competency_group_id', '=', 'competency_group.id')
            ->where('competency_group.company_id', '=', $user_company)->orWhere('assessment_session.company_id', '=', $user_company)
            ->select('competency.id', 'competency.name')->distinct()->get();
        }
        return view('training.create_master', compact('competency', 'company'));
    }

    public function delete_competency($id, Request $request)
    {
        $id_training = $request->id_training;
        DB::table('training_competencies')->where('id', $id)->delete();
        return redirect('training/' . $id_training . '/edit')->with('status', 'Kompetensi berhasil dihapus!');
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
        return redirect('training/' . $id . '/edit')->with('status', 'Kompetensi berhasil ditambahkan!');
    }

    public function getTrainingDetails($id)
    {
        $data = Training::find($id);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function addRecommendation(Request $request)
    {
        $reason = "";
        if ($request->reason == null) {
            $reason = "Tidak ada";
        } else {
            $reason = $request->reason;
        }

        $status = "";
        $trainingStatus = "";
        if ($request->trainingType == "Opsional") {
            $status = "Menunggu Respon";
            $trainingStatus = "Opsional";
        } else {
            $status = "Wajib";
            $trainingStatus = "Wajib";
        }

        Training_emp::create([
            'user_id' => $request->userId,
            'id_training' => $request->trainingDropdown,
            'status' => $status,
            'type' => $request->trainingType,
            'recommended_by' => $request->recommendedBy,
            'reason' => $reason,
            'reason_rejected' => ""
        ]);

        //  email data
        $user = User::where('id', $request->userId)->get()->first();
        $training = Training::where('id', $request->trainingDropdown)->get()->first();
        $url = url('/training/recommendation');
        $email = $user->email;
        $data = array(
            'email' => $email,
            'name' => $user->name,
            'training_name' => $training->name,
            'training_host' => $training->host,
            'start_date' => $training->start_date,
            'end_date' => $training->end_date,
            'status' => $trainingStatus,
            'url' => $url
        );

        // send email
        TrainingRecommendationMailJob::dispatch($data);


        // check if email fail
        if (Mail::failures()) {
            return redirect('training/recommendation')->with('status', 'Rekomendasi Pelatihan Berhasil di Tambahkan tetapi Gagal untuk dikirim via Email');
        } else {
            return redirect('training/recommendation')->with('status', 'Rekomendasi Pelatihan Berhasil di Tambahkan dan Dikirim ke E-Mail Karyawan!');
        }


    }

    public function detailRecommendation($id)
    {
        $training_emp = Training_emp::join('user', 'user.id', '=', 'training_emps.user_id')->join('training', 'training.id', '=', 'training_emps.id_training')->where('training_emps.id', $id)->select('training_emps.status as status', 'user.name as user_name', 'training.*', 'training_emps.id as training_rec_id', 'training_emps.*', 'training.id as id_training')->get();
        foreach ($training_emp as $b){
            $training_id = $b->id_training;
        }
        // dd($training_id);
        $training_competency = Training_competencies::where('id_training','=', $training_id)->get();
        // dd($training_competency);
        return view('training.details_recommendation')->with(['training_emp' => $training_emp, 'training_competency' => $training_competency]);
    }

    public function editRecommedation($id)
    {
        $training_emp = Training_emp::where('id', $id)->get();
        // dd($training_emp);
        return view('training.edit_recommendation')->with('training_emp', $training_emp);
    }

    public function editRecommendationProcess(Request $request)
    {
        $status = "";
        if ($request->trainingType == "Wajib") {
            $status = "Wajib";
        } else if ($request->trainingType == "Opsional") {
            $status = "Menunggu Respon";
        }
        if ($request->cancelTraining == "Ya") {
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
        $reason_rejected ="";
        if ($request->verification == "Terima") {
            $status = "Disetujui";
        } else if ($request->verification == "Tolak") {
            $status = "Ditolak";
            $reason_rejected = $request->reason_rejected;

        }

        Training_emp::where('id', $request->id_training_emp)->update([
            'status' => $status,
            'reason_rejected' => $reason_rejected
        ]);
        return redirect('training/recommendation')->with('status', 'Rekomendasi Pelatihan Berhasil ' . $status);
    }
}
