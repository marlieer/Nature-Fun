<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $children = Auth::user()->childs;

        if($children)
        {
            foreach($children as $child){
                $child->name = decrypt($child->name);
            }
        }

        $registrations = DB::table('child')
            ->join('registration','registration.child_id','child.id')
            ->join('users','users.id','child.user_id')
            ->join('session','session.id','registration.session_id')
            ->where('session.date','>=', date('Y-m-d'))
            ->where('users.id',Auth::user()->id)
            ->select('child.*','session.*','registration.*')
            ->get();
        return view('home', compact('children','registrations'));
    }
}
