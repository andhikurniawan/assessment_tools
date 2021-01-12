<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $employee = User::join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->join('role', 'user_role.role_id' , '=', 'role.id')->join('company', 'user.company_id' , '=', 'company.id')->select('user.name as name', 'user.employee_id', 'role.name as role_name', 'company.name as company_name', 'user.id as id')->get();
        $company = Company::all();
        $selected = "";
        return view('employee.index', compact('employee', 'company', 'selected'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function empCompany($id)
    {
        $employee = User::join('user_role', 'user.id', '=', 'user_role.user_id', 'inner')->join('role', 'user_role.role_id' , '=', 'role.id')->join('company', 'user.company_id' , '=', 'company.id')->select('user.name as name', 'user.employee_id', 'role.name as role_name', 'company.name as company_name', 'company.id', 'user.id as id')->where('company.id', $id)->get();
        $company = Company::all();
        $selected = Company::where('id', $id)->get()->first();
        $selected = $selected->id;
        return view('employee.index', compact('employee', 'company', 'selected'));
    }
}
