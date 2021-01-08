<?php

namespace App\Http\Controllers;

use App\Track_project_emp;
use App\Track_training_emp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackRecordController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $period = DB::table('track_input_period')->get()->first();
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
            $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.start_date as start_date', 'assessment_session.end_date as end_date')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session', 'assessment_competency_result.session_id', '=', 'assessment_session.id')->where('user.id', $id)->distinct('assessment_name')->get();
            return view('track-record.detail', compact('employee'))->with('track_training', $track_training)->with('track_project', $track_project)->with('assessment_result', $assessment_result)->with('period', $period);
        } else {
            $employee = User::join('user_role', 'user_role.user_id', '=', 'user.id', 'inner')->where('user_role.role_id', '=', 'user')->get();
            return view('track-record.index', compact('employee'))->with('period', $period);
        }
    }

    public function updatePeriod(Request $request)
    {
        $period = DB::table('track_input_period')->get()->first();
        if ($period == null) {
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
        $assessment_result = DB::table('assessment_competency_result')->select('user.name as user_name', 'assessment_session.name as assessment_name', 'user.id', 'assessment_session.start_date as start_date', 'assessment_session.end_date as end_date')->join('user', 'assessment_competency_result.userid_assessee', '=', 'user.id', 'inner')->join('assessment_session', 'assessment_competency_result.session_id', '=', 'assessment_session.id')->where('user.id', $id)->distinct('assessment_name')->get();

        return view('track-record.detail', compact('employee'))->with('track_training', $track_training)->with('track_project', $track_project)->with('assessment_result', $assessment_result);
    }

    public function trackTrainingDetail($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        return view('track-record.training-detail', compact('track_training'));
    }

    public function trainingVerification($id, Request $request)
    {
        $status = "";
        if ($request->option == "Verifikasi") {
            $status = "Terverifikasi";
        } else if ($request->option == "Tolak") {
            $status = "Ditolak";
        }

        Track_training_emp::where('id', $id)->update([
            'status' => $status
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
            'certificate' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'reason_associated_work' => 'required|min:3',

        ], [
            'name.required' => 'Nama pelatihan tidak boleh kosong',
            'host.required' => 'Nama pelaksana pelatihan tidak boleh kosong',
            'duration.required' => 'Durasi pelatihan tidak boleh kosong',
            'start_date.required' => 'Tanggal mulai pelatihan tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai pelatihan tidak boleh kosong',
            'description.required' => 'Deskripsi pelatihan tidak boleh kosong',
            'certificate.required' => 'File harus JPG/PNG dengan ukuran file maksimal 2MB',
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
            'status' => 'Menunggu'
        ]);

        return redirect('track-record')->with('status', 'Data pelatihan/sertifikasi berhasil ditambah!');
    }

    public function trackTrainingEdit($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        // dd($track_training->status);
        if ($track_training->status == "Menunggu") {
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
                    'link' => $link
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
                    'link' => $link
                ]);
        }
        return redirect('track-record')->with('status', 'Data pelatihan/sertifikasi berhasil diubah!');
    }

    public function trackTrainingDelete($id)
    {
        $track_training = Track_training_emp::where('id', $id)->get()->first();
        // dd($track_training->status);
        if ($track_training->status == "Menunggu") {
            Track_training_emp::where('id', $id)->delete();
            return redirect('track-record')->with('status', 'Data pelatihan/sertifikasi berhasil di hapus!');
        } else {
            return redirect('track-record')->with('status', 'Maaf data pelatihan tersebut tidak bisa di hapus, karena status sudah berubah');
        }
    }
}
