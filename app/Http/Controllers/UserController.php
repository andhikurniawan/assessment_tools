<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Company;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->join('role', 'user_role.role_id', '=', 'role.id')->join('company', 'user.company_id', '=', 'company.id')->select('user.name as name', 'user.employee_id', 'role.name as role_name', 'company.name as company_name', 'user.id as id')->get();
        $company_id = Auth::user()->company_id;
        
        if ($company_id == null) {
            $company = Company::all();
        $employee = User::join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->join('role', 'user_role.role_id', '=', 'role.id')->join('company', 'user.company_id', '=', 'company.id')->select('user.name as name', 'user.employee_id', 'role.name as role_name', 'company.name as company_name', 'user.id as id')->get();
        $selected = "";
        } else {
            $company = Company::where('id', $company_id)->get()->first();
        $employee = User::join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->join('role', 'user_role.role_id', '=', 'role.id')->join('company', 'user.company_id', '=', 'company.id')->select('user.name as name', 'user.employee_id', 'role.name as role_name', 'company.name as company_name', 'user.id as id')->where('company.id',$company_id)->get();
        $selected = $company->id;
        }
       
        return view('employee.index', compact('employee', 'company', 'selected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_id = Auth::user()->company_id;
        if ($company_id == null) {
            $company = Company::all();
        } else {
            $company = Company::where('id', $company_id)->get();
        }
        
        $role = DB::table('role')->where('id', 'user')->get();
        return view('employee.create', compact('company', 'role'));
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
            'employee_id' => 'required',
            'email' => 'required',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ], [
            'employee_id.required' => 'Employee ID tidak boleh kosong',
            'email.required' => 'Email Pegawai tidak boleh kosong',
            'name.required' => 'Nama Pegawai tidak boleh kosong',
            'username.required' => 'Username Pegawai tidak boleh kosong',
            'password.required' => 'Password Pegawai tidak boleh kosong',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'gender' => $request->gender,
            'employee_id' => $request->employee_id,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id
        ]);

        $id = DB::getPdo()->lastInsertId();

        DB::table('user_role')->insert([
            'user_id' => $id,
            'company_id' => $request->company_id,
            'role_id' => $request->role
        ]);

        if ($request->role == "user") {
            return redirect('employee')->with('status', 'Data Pegawai berhasil ditambah!');
        } else {
            return redirect('employee')->with('status', 'Data Admin berhasil ditambah!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get()->first();
        $company = Company::all();
        $role = DB::table('role')->where('id', 'user')->get()->first();
        return view('employee.show', compact('user', 'company', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->get()->first();
        $company_id = Auth::user()->company_id;
        if ($company_id == null) {
            $company = Company::all();
        } else {
            $company = Company::where('id', $company_id)->get();
        }
        $user_role = DB::table('user_role')->where('user_id', $id)->get()->first();
        if($user_role->role_id == "user"){
            $role = DB::table('role')->where('id', 'user')->get();
        } else {
            $role = DB::table('role')->where('id', '!=', 'user')->where('id', '!=', 'superadmin')->get();
        }
        return view('employee.edit', compact('user', 'company', 'role', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->get()->first();
        $request->validate([
            'employee_id' => 'required',
            'email' => 'required',
            'name' => 'required',
            'username' => 'required',
        ], [
            'employee_id.required' => 'Employee ID tidak boleh kosong',
            'email.required' => 'Email Pegawai tidak boleh kosong',
            'name.required' => 'Nama Pegawai tidak boleh kosong',
            'username.required' => 'Username Pegawai tidak boleh kosong',
        ]);

        if ($request->password == null) {
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'gender' => $request->gender,
                'employee_id' => $request->employee_id,
                'company_id' => $request->company_id
            ]);
        } else {
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'gender' => $request->gender,
                'employee_id' => $request->employee_id,
                'password' => Hash::make($request->password),
                'company_id' => $request->company_id
            ]);
        }

        DB::table('user_role')->where('user_id', $id)->update([
            'company_id' => $request->company_id,
            'role_id' => $request->role
        ]);
        if ($request->role == "user") {
            return redirect('employee')->with('status', 'Data Pegawai berhasil di ubah!');
        } else {
            return redirect('employee')->with('status', 'Data Admin berhasil di ubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('user_role')->where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return redirect('employee')->with('status', 'Data Pegawai berhasil di hapus!');
    }

    public function empCompany($id)
    {
        $employee = User::join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->join('role', 'user_role.role_id', '=', 'role.id')->join('company', 'user.company_id', '=', 'company.id')->select('user.name as name', 'user.employee_id', 'role.name as role_name', 'company.name as company_name', 'company.id', 'user.id as id')->where('company.id', $id)->get();
        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
        return view('employee.index', compact('employee', 'company', 'selected'));
    }

    public function createAdmin()
    {
        $company_id = Auth::user()->company_id;
        if ($company_id == null) {
            $company = Company::all();
        } else {
            $company = Company::where('id', $company_id)->get();
        }
        $role = DB::table('role')->where('id', '!=', 'user')->where('id', '!=', 'superadmin')->get();
        return view('employee.create-admin', compact('company', 'role'));
    }
}
