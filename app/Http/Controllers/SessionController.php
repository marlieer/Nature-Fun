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
        $sessions = Session::all()->sortBy('date');
        foreach ($sessions as $s){
            $spotsAvailable[$s->s_id] = ($s->max_attendance - count(Registration::where('s_id',$s->s_id)->get()));
        }

        $id=-1;
        if (Auth::check())
            $id = Auth::id();
        return view('session.index', compact('sessions','spotsAvailable', 'id'));
    }

   
    public function create()
    {
        return view('/session/create');

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

        $start_date = request('session_date');
        $this->createSession($attributes, $start_date);

        if (request('end_repeat')){
            $end_repeat = new DateTime(request('end_repeat'));
            
            
            if (request('mon')=='mon'){
                $date = new DateTime($start_date);
                $date ->modify('next Monday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $this->createSession($attributes, $date);
                    $date ->modify('next Monday')->format('Y-m-d');
                }

            }

            if(request('tue')=='tue'){
                $date = new DateTime($start_date);
                $date ->modify('next Tuesday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $this->createSession($attributes, $date);
                    $date ->modify('next Tuesday')->format('Y-m-d');
                }

            }

            if(request('wed')=='wed'){
                $date = new DateTime($start_date);
                $date ->modify('next Wednesday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $this->createSession($attributes, $date);
                    $date ->modify('next Wednesday')->format('Y-m-d');
                }

            }

            if(request('thu')=='thu'){;
                $date = new DateTime($start_date);
                $date ->modify('next Thursday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $this->createSession($attributes, $date);
                    $date ->modify('next Thursday')->format('Y-m-d');
                }

            }

            if(request('fri')=='fri'){
                $date = new DateTime($start_date);
                $date ->modify('next Friday')->format('Y-m-d');
                while($date <= $end_repeat){
                    $this->createSession($attributes, $date);
                    $date ->modify('next Friday')->format('Y-m-d');
                }
            }

        }

        return redirect('/session');
    }

    public function createSession($attributes, $date){

        $attributes['date']=$date;
        $session = Session::create($attributes);
    }


    public function show(Session $session)
    {
        $children = DB::table('child')
            ->join('registration','child.c_id','=','registration.c_id')
            ->join('family','child.f_id','=','family.f_id')
            ->where('registration.s_id',$session->s_id)
            ->select('child.*','registration.*','family.phone')
            ->get();
        //$today = new DateTime();
        foreach ($children as $child){
            $child->age=(new DateTime($child->birthdate))->diff(new DateTime())->y;
        }
       
        return view('session.show', compact('session','children'));
    }


    public function edit(Session $session)
    {
        return view('session.edit', compact('session'));
    }

    
    public function update(Session $session)
    {

        $attributes = request()->validate(['session_date'=>['required','date'],
            'end_repeat'=>'date',
            'start_time'=>'date_format:H:i:s',
            'end_time'=>'date_format:H:i:s|after:start_time',
            'max_attendance'=>'numeric',
            'max_age'=>'numeric',
            'min_age'=>'numeric',
            'title'=>'max:70'
        ]);        

       $session->update($attributes);

        return redirect('/session');

    }

   
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect('/session');
    }


    public function calendar(){
        $sessions = Session::all();
        return view('calendar', compact('sessions'));
    }
}
