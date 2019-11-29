<?php

namespace App\Http\Controllers;

use App\Session;
use App\Registration;
use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
   
    public function index()
    {
        $spotsAvailable;
        $sessions = Session::get();
        foreach ($sessions as $s){
            $spotsAvailable[$s->s_id] = $s->spotsAvailable();
        }

        $id=-1;
        if (Auth::check())
            $id = Auth::id();
        return view('session.index', compact('sessions','spotsAvailable', 'id'));
    }

   
    public function create()
    {
        if (Auth::id()==1)
            return view('/session/create');
        return redirect()->route('login');
    }

   
    public function store(Request $request)
    {
    
        // if repeat boxes checked, create session for each repeat
        $attributes = request()->validate(['session_date'=>['required','date'],
            'end_repeat'=>'date|after:session_date',
            'start_time'=>'date_format:H:i',
            'end_time'=>'date_format:H:i|after:start_time',
            'max_attendance'=>'numeric',
            'max_age'=>'numeric',
            'min_age'=>'numeric'
        ]);

        Session::createSessions($attributes, $request);

        return redirect('/session');
    }


    public function show(Session $session)
    {
        if (Auth::id()==1)
        {
            $children = $session->childrenInTheSystem();
            $otherChildren = $session->childrenNotInTheSystem();
            
            foreach ($children as $child){
                $child->age=(new DateTime($child->birthdate))->diff(new DateTime())->y;
            }
           
            return view('session.show', compact('session','children','otherChildren'));
        }
        return redirect()->route('login');
    }


    public function showbydate(String $date)
    {
        if (Auth::id()==1)
        {            
            $sessions = Session::where('date',$date)->get();
            $childrens = [];
            $otherChildrens = [];

            foreach($sessions as $session)
            {
                $children = $session->childrenInTheSystem();
                $otherChildren = $session->childrenNotInTheSystem();

                foreach($children as $child)
                    $child->age=(new DateTime($child->birthdate))->diff(new DateTime())->y;
                
                array_push($childrens, $children);
                array_push($otherChildrens, $otherChildren);
            }
           
            return view('session.showbydate', compact('sessions','childrens','otherChildrens'));
        }
        return redirect()->route('login');
    }


    public function edit(Session $session)
    {
        if(Auth::id()==1)
            return view('session.edit', compact('session'));
        return redirect()->route('login');
    }

    
    public function update(Session $session, Request $request)
    {

        $attributes = request()->validate(['session_date'=>['required','date'],
            'end_repeat'=>'date',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'max_attendance'=>'numeric',
            'max_age'=>'numeric',
            'min_age'=>'numeric',
            'title'=>'max:70'
        ]);        

       $session->update($attributes);
       $request->session()->flash('success', "Successfully updated!");
        return redirect("/session/{$session->s_id}");

    }

   
    public function destroy(Session $session, Request $request)
    {
        $session->delete();
        $request->session()->flash('success', "Successfully deleted session!");
        return redirect('/session');
    }

}
