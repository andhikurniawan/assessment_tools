<?php

namespace App\Http\Controllers;

use App\Company;
use App\Jobs\TrackRecordInputPeriodMailJob;
use App\Track_project_emp;
use App\Track_training_emp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class TrackRecordController extends Controller
{
    public function index()
    {
        if (Auth::check() == null) {
            return redirect('home')->with('alert', 'Anda harus login terlebih dahulu!');
        }
        $id = Auth::id();
        $company_id = Auth::user()->company_id;
        $period = DB::table('track_input_period')->where('company_id', $company_id)->get()->first();
        if ($period == null) {
            $period = (object) [
                'start_date' => 'Belum ditentukan',
                'end_date' => 'Belum ditentukan',

            ];
        }

        if (session('permission') == "user") {
            $employee = User::where('id', $id)->get()->first();
            $track_training = Track_training_emp::where('user_id', $id)->get();
            $track_project = Track_project_emp::where('user_id', $id)->get();
            $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.start_date as start_date', 'assessment_session.end_date as end_date', 'assessment_session.id as session_id')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session', 'assessment_competency_result.session_id', '=', 'assessment_session.id')->where('user.id', $id)->distinct('assessment_name')->get();
            return view('track-record.detail', compact('employee'))->with('track_training', $track_training)->with('track_project', $track_project)->with('assessment_result', $assessment_result)->with('period', $period);
        } else if (session('permission') == "superadmin") {
            $employee = User::join('user_role', 'user_role.user_id', '=', 'user.id', 'inner')->where('user_role.role_id', '=', 'user')->get();
            $company = Company::all();
            return view('track-record.index', compact('employee'))->with('period', $period)->with('company', $company);
        } else {
            $employee = User::join('user_role', 'user_role.user_id', '=', 'user.id', 'inner')->where('user_role.role_id', '=', 'user')->where('user.company_id',$company_id)->get();
            $company = Company::where('id', $company_id)->get();
            return view('track-record.index', compact('employee'))->with('period', $period)->with('company', $company);
        }
    }

    public function updatePeriod(Request $request)
    {
        $period = DB::table('track_input_period')->where('company_id',$request->company_modal)->get()->first();
        if ($period == null) {
            DB::table('track_input_period')->insert([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'company_id' => $request->company_modal
            ]);
        } else {
            DB::table('track_input_period')->where('company_id', $request->company_modal)
                ->update([
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ]);
        }
        $user = User::join('user_role','user_role.user_id','=','user.id')->where('user.company_id', $request->company_modal)->where('role_id','user')->get();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $url = url('/training/recommendation');

        // send email
        foreach ($user as $item) {
            $email = $item->email;
            $data_tr = array(
                'email' => $email,
                'name' => $item->name,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'url' => $url
            );
            TrackRecordInputPeriodMailJob::dispatch($data_tr);
        }
        if (Mail::failures()) {
            return redirect('track-record')->with('status', 'Waktu Periode Input Track Record berhasil diubah tetapi gagal dalam mengirim email');
        } else {
            return redirect('track-record')->with('status', 'Waktu Periode Input Track Record berhasil diubah dan sudah kirim e-mail ke Pegawai!');
        }
    }

    public function employeeDetail($id)
    {
        $employee = User::where('id', $id)->get()->first();
        $track_training = Track_training_emp::where('user_id', $id)->get();
        $track_project = Track_project_emp::where('user_id', $id)->get();
        $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.start_date as start_date', 'assessment_session.end_date as end_date', 'assessment_session.id as session_id')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session', 'assessment_competency_result.session_id', '=', 'assessment_session.id')->where('user.id', $id)->distinct('assessment_name')->get();
        $period = DB::table('track_input_period')->get()->first();
        if ($period == null) {
            $period = (object) [
                'start_date' => 'Belum ditentukan',
                'end_date' => 'Belum ditentukan',

            ];
        }
        return view('track-record.detail', compact('employee'))->with([
            'track_training' => $track_training,
            'track_project' => $track_project,
            'assessment_result' => $assessment_result,
            'period' => $period
        ]);
    }

    public function trackTrainingDetail($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        return view('track-record.training-detail', compact('track_training'));
    }

    public function trainingVerification($id, Request $request)
    {
        $status = "";
        $reason_rejected = "";
        if ($request->verification == "Verifikasi") {
            $status = "Terverifikasi";
            $reason_rejected = "";
        } else if ($request->verification == "Tolak") {
            $status = "Ditolak";
            $reason_rejected = $request->reason_rejected;

        }

        Track_training_emp::where('id', $id)->update([
            'status' => $status,
            'reason_rejected' => $reason_rejected
        ]);

        return redirect('track-record/employee/' . $request->user_id)->with('status', 'Status Riwayat Pelatihan/Sertifikasi Karyawan Berhasil Diubah!');
    }

    public function trackProjectDetail($id)
    {
        $track_project = Track_project_emp::where('id', $id)->get()->first();
        return view('track-record.project-detail', compact('track_project'));
    }

    public function insertTraining()
    {
        return view('user.track-record.insert-training');
    }

    public function insertTrainingProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'host' => 'required|min:3',
            'duration' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required|min:3',
            'certificate' => 'required|file|image|mimes:jpeg,png,jpg|max:5120',
            'reason_associated_work' => 'required|min:3',

        ], [
            'name.required' => 'Nama pelatihan tidak boleh kosong',
            'host.required' => 'Nama pelaksana pelatihan tidak boleh kosong',
            'duration.required' => 'Durasi pelatihan tidak boleh kosong',
            'start_date.required' => 'Tanggal mulai pelatihan tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai pelatihan tidak boleh kosong',
            'description.required' => 'Deskripsi pelatihan tidak boleh kosong',
            'certificate.required' => 'File harus JPG/PNG dengan ukuran file maksimal 5MB dan tidak boleh kosong',
            'reason_associated_work.required' => 'Alasan keterkaitan dengan pekerjaan tidak boleh kosong',
        ]);
        $link = "";
        if ($request->link == null) {
            $link = "Tidak ada";
        } else {
            $link = $request->link;
        }

        $image = $request->file('certificate');
        $fileName = Auth::id() . "_" . time() . "." . $image->getClientOriginalExtension();
        $fileFolder = 'uploaded_file';
        $image->move($fileFolder, $fileName);
        Track_training_emp::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'host' => $request->host,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'reason_associated_work' => $request->reason_associated_work,
            'certificate' => $fileName,
            'link' => $link,
            'status' => 'Menunggu',
            'reason_rejected' => ""
        ]);

        return redirect('track-record')->with('status', 'Data pelatihan/sertifikasi berhasil ditambah!');
    }

    public function trackTrainingEdit($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        // dd($track_training->status);
        if ($track_training->status == "Menunggu" || $track_training->status == "Ditolak") {
            return view('user.track-record.edit-training', compact('track_training'));
        } else {
            return redirect('track-record')->with('status', 'Maaf data pelatihan tersebut tidak bisa di edit, karena status sudah berubah');
        }
    }

    public function trackTrainingEditProcess($id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'host' => 'required|min:3',
            'duration' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required|min:3',
            'reason_associated_work' => 'required|min:3',

        ], [
            'name.required' => 'Nama pelatihan tidak boleh kosong',
            'host.required' => 'Nama pelaksana pelatihan tidak boleh kosong',
            'duration.required' => 'Durasi pelatihan tidak boleh kosong',
            'start_date.required' => 'Tanggal mulai pelatihan tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai pelatihan tidak boleh kosong',
            'description.required' => 'Deskripsi pelatihan tidak boleh kosong',
            'reason_associated_work.required' => 'Alasan keterkaitan dengan pekerjaan tidak boleh kosong',
        ]);
        $link = "";
        if ($request->link == null) {
            $link = "Tidak ada";
        } else {
            $link = $request->link;
        }
        if ($request->certificate == null) {
            Track_training_emp::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'host' => $request->host,
                    'duration' => $request->duration,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'description' => $request->description,
                    'reason_associated_work' => $request->reason_associated_work,
                    'link' => $link,
                    'status' => "Menunggu"
                ]);
        } else {
            $image = $request->file('certificate');
            $fileName = Auth::id() . "_" . time() . "." . $image->getClientOriginalExtension();
            $fileFolder = 'uploaded_file';
            $image->move($fileFolder, $fileName);
            Track_training_emp::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'host' => $request->host,
                    'duration' => $request->duration,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'description' => $request->description,
                    'reason_associated_work' => $request->reason_associated_work,
                    'certificate' => $fileName,
                    'link' => $link,
                    'status' => "Menunggu"
                ]);
        }
        return redirect('track-record')->with('status', 'Data pelatihan/sertifikasi berhasil diubah!');
    }

    public function trackTrainingDelete($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        // dd($track_training->status);
        if ($track_training->status == "Menunggu"  || $track_training->status == "Ditolak") {
            Track_training_emp::where('id', $id)->delete();
            return redirect('track-record')->with('status', 'Data pelatihan/sertifikasi berhasil di hapus!');
        } else {
            return redirect('track-record')->with('status', 'Maaf data pelatihan tersebut tidak bisa di hapus, karena status sudah berubah');
        }
    }

    public function insertProject()
    {
        return view('user.track-record.insert-project');
    }

    public function insertProjectProcess(Request $request)
    {
        $end_date = null;
        $time_perf = "";
        $cost_perf = "";
        $quality_perf = "";
        $reason_failed = "";

        $request->validate([
            'project_name' => 'required|min:3',
            'platform' => 'required|min:3',
            'position' => 'required|min:3',
            'start_date' => 'required',
            'description' => 'required|min:3'

        ], [
            'project_name.required' => 'Nama project tidak boleh kosong dan minimal 3 huruf',
            'platform.required' => 'Nama platform output project tidak boleh kosong dan minimal 3 huruf',
            'position.required' => 'Posisi dalam project tidak boleh kosong dan minimal 3 huruf',
            'start_date.required' => 'Tanggal mulai project tidak boleh kosong',
            'description.required' => 'Deskripsi project tidak boleh kosong dan minimal 3 huruf',
        ]);
        if($request->status == "Selesai"){
            $request->validate([
                'end_date' => 'required'
            ],[
                'end_date.required' => 'Tnaggal selesai project tidak boleh kosong'
            ]);
            $end_date = $request->end_date;
            $time_perf = $request->time_performance;
            $cost_perf = $request->cost_performance;
            $quality_perf = $request->quality_performance;
        }
        if($request->status == "Gagal"){
            $request->validate([
                'reason_failed' => 'required|min:3',
                'end_date' => 'required'
            ], [
                'end_date.required' => 'Tnaggal selesai project tidak boleh kosong',
                'reason_failed.required' => 'Alasan gagal tidak boleh kosong dan minimal 3 huruf'
            ]);
            $end_date = $request->end_date;
            $reason_failed = $request->reason_failed;
        }

        Track_project_emp::create([
            'user_id' => Auth::id(),
            'name' => $request->project_name,
            'platform' => $request->platform,
            'position' => $request->position,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $end_date,
            'description' => $request->description,
            'time_performance' => $time_perf,
            'cost_performance' => $cost_perf,
            'quality_performance' => $quality_perf,
            'reason_failed' => $reason_failed
        ]);

        return redirect('track-record')->with('status', 'Data project berhasil ditambah!');
    }

    public function trackProjectEdit($id)
    {
        $track_project = Track_project_emp::where('id', $id)->get()->first();
        return view('user.track-record.edit-project', compact('track_project'));
    }

    public function trackProjectEditProcess($id, Request $request)
    {
        $end_date = null;
        $time_perf = "";
        $cost_perf = "";
        $quality_perf = "";
        $reason_failed = "";

        $request->validate([
            'project_name' => 'required|min:3',
            'platform' => 'required|min:3',
            'position' => 'required|min:3',
            'start_date' => 'required',
            'description' => 'required|min:3'

        ], [
            'project_name.required' => 'Nama project tidak boleh kosong dan minimal 3 huruf',
            'platform.required' => 'Nama platform output project tidak boleh kosong dan minimal 3 huruf',
            'position.required' => 'Posisi dalam project tidak boleh kosong dan minimal 3 huruf',
            'start_date.required' => 'Tanggal mulai project tidak boleh kosong',
            'description.required' => 'Deskripsi project tidak boleh kosong dan minimal 3 huruf',
        ]);
        if($request->status == "Selesai"){
            $request->validate([
                'end_date' => 'required'
            ],[
                'end_date.required' => 'Tnaggal selesai project tidak boleh kosong'
            ]);
            $end_date = $request->end_date;
            $time_perf = $request->time_performance;
            $cost_perf = $request->cost_performance;
            $quality_perf = $request->quality_performance;
        }
        if($request->status == "Gagal"){
            $request->validate([
                'reason_failed' => 'required|min:3',
                'end_date' => 'required'
            ], [
                'end_date.required' => 'Tnaggal selesai project tidak boleh kosong',
                'reason_failed.required' => 'Alasan gagal tidak boleh kosong dan minimal 3 huruf'
            ]);
            $end_date = $request->end_date;
            $reason_failed = $request->reason_failed;
        }

        Track_project_emp::where('id', $id)
        ->update([
            'name' => $request->project_name,
            'platform' => $request->platform,
            'position' => $request->position,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $end_date,
            'description' => $request->description,
            'time_performance' => $time_perf,
            'cost_performance' => $cost_perf,
            'quality_performance' => $quality_perf,
            'reason_failed' => $reason_failed
        ]);

        return redirect('track-record')->with('status', 'Data project berhasil di ubah!');
    }

    public function trackProjectDelete($id)
    {
        $track_project = Track_project_emp::where('id', $id)->get()->first();
        // dd($track_training->status);
        if ($track_project->status == "Sedang Berlangsung") {
            $track_project->delete();
            return redirect('track-record')->with('status', 'Data project berhasil di hapus!');
        } else {
            return redirect('track-record')->with('status', 'Maaf data project tersebut tidak bisa di hapus, karena status sudah berubah');
        }
    }

    public function getPeriodCompany($id)
    {
        $data = DB::table('track_input_period')->where('company_id', $id)->get()->first();
        return response()->json(['success' => true, 'data' =>$data]);
    }
}
