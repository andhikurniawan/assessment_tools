<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return view('company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
        
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
            'address' => 'required|min:3',
            'telp' => 'required|min:3',
            'email' => 'required|min:3',
            'description' => 'required|min:3',
            'contact_person' => 'required|min:3',
        ], [
            'name.required' => 'Nama Perusahaan tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'telp.required' => 'Nomer telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'contact_person.required' => 'Contact Person tidak boleh kosong',
        ]);

        Company::create($request->all());
        return redirect('company')->with('status', 'Perusahaan berhasil ditambah!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'required|min:3',
            'telp' => 'required|min:3',
            'email' => 'required|min:3',
            'description' => 'required|min:3',
            'contact_person' => 'required|min:3',
        ], [
            'name.required' => 'Nama Perusahaan tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'telp.required' => 'Nomer telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'contact_person.required' => 'Contact Person tidak boleh kosong',
        ]);

        Company::where('id', $company->id)
        ->update([
            'name' => $request->name,
            'address' => $request->address,
            'telp' => $request->telp,
            'fax' => $request->fax,
            'email' => $request->email,
            'description' => $request->description,
            'contact_person' => $request->contact_person
        ]);

        return redirect('company')->with('status', 'Perusahaan berhasil di update!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('company')->with('status', 'Perusahaan berhasil di hapus!');
        
    }
}
