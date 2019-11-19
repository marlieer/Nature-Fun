<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $children = Child::get()->where('f_id','=', Auth::user()->id);
        $registrations = DB::table('child')
            ->join('registration','registration.c_id','child.c_id')
            ->join('family','family.f_id','child.f_id')
            ->join('session','session.s_id','registration.s_id')
             ->where('session.date','>=', date('Y-m-d'))
            ->select('child.*','session.*','registration.*')
            ->get();
        return view('home', compact('children','registrations'));
    }
}
