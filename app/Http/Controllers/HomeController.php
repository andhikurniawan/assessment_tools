<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $role = DB::table('user_role')->where('user_id', $id)->select('role_id')->first();
        switch ($role->role_id) {
            case 'superadmin':
                session(['permission' => 'superadmin']);
                return view('home');
                break;
            
            case 'admin':
                session(['permission' => 'admin']);
                return redirect('employee');
                break;
            
            case 'admin_pm':
                session(['permission' => 'admin_pm']);
                return view('home');
                break;
            
            case 'admin_ap':
                session(['permission' => 'admin_ap']);
                return redirect('/assessment');
                break;
            
            case 'admin_ot':
                session(['permission' => 'admin_ot']);
                return view('home');
                break;
            
            case 'admin_tnd':
                session(['permission' => 'admin_tnd']);
                return redirect('training/dashboard');

                break;
            
            case 'user':
                session(['permission' => 'user']);
                return view('user.index');
                break;
            
            default:
            session(['permission' => 'guest']);
                return view('welcome');
                break;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function email()
    {
        return view('layouts.email');
    }
}
