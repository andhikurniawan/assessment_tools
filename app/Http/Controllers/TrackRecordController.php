<?php

namespace App\Http\Controllers;

use App\Track_project_emp;
use App\Track_training_emp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackRecordController extends Controller
{
    public function index()
    {
        $employee = User::join('user_role', 'user_role.user_id', '=', 'user.id', 'inner')->where('user_role.role_id', '=', 'user')->get();
        $period = DB::table('track_input_period')->get()->first();
        if($period == null){
            $period = (object) [
                'start_date' => 'Belum ditentukan',
                'end_date' => 'Belum ditentukan',
                
            ];
        } 
        
        return view('track-record.index', compact('employee'))->with('period', $period);
    }

    public function updatePeriod(Request $request)
    {
        $period = DB::table('track_input_period')->get()->first();
        if($period == null){
            DB::table('track_input_period')->insert([
                'id' => 1,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        } else {
            DB::table('track_input_period')->where('id', 1)
            ->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        }
        return redirect('track-record')->with('status', 'Waktu Periode Input Track Record berhasil diubah!');

    }

    public function employeeDetail($id)
    {
        $employee = User::where('id', $id)->get()->first();
        $track_training = Track_training_emp::where('user_id', $id)->get();
        $track_project = Track_project_emp::where('user_id', $id)->get();
        $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.start_date as start_date', 'assessment_session.end_date as end_date')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session','assessment_competency_result.session_id', '=', 'assessment_session.id')->where('user.id', $id)->distinct('assessment_name')->get();

        return view('track-record.detail', compact('employee'))->with('track_training', $track_training)->with('track_project', $track_project)->with('assessment_result', $assessment_result);
    }

    public function trackTrainingDetail($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        return view('track-record.training-detail', compact('track_training'));
    }

    public function trainingVerification($id,Request $request)
    {
        $status = "";
        if ($request->option == "Verifikasi"){
            $status = "Terverifikasi";
        } else if ($request->option == "Tolak"){
            $status = "Ditolak";
        }

        Track_training_emp::where('id', $id)->update([
            'status' => $status
        ]);

        return redirect('track-record/employee/'.$request->user_id)->with('status', 'Status Riwayat Pelatihan/Sertifikasi Karyawan Berhasil Diubah!');
    }

    public function trackProjectDetail($id)
    {
        $track_project = Track_project_emp::where('id', $id)->get()->first();
        return view('track-record.project-detail', compact('track_project'));
    }
}
