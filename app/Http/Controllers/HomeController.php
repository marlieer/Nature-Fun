<?php

namespace App\Http\Controllers;

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
        foreach($children as $child){
            $child->child_name = decrypt($child->child_name);
        }
        $registrations = DB::table('child')
            ->join('registration','registration.c_id','child.c_id')
            ->join('users','users.id','child.f_id')
            ->join('session','session.s_id','registration.s_id')
            ->where('session.date','>=', date('Y-m-d'))
            ->where('users.id',Auth::user()->id)
            ->select('child.*','session.*','registration.*')
            ->get();
        return view('home', compact('children','registrations'));
    }
}
