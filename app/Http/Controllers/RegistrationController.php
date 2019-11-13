<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Session;
use App\Family;
use App\Child;
use Illuminate\Support\Facades\Auth;
use DateTime;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registration/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($s_id)
    {
        if (Auth::check()){
            $session = Session::findOrFail($s_id);
            $children = Child::join('family','child.f_id','=','family.f_id')
                ->get();
            if(Auth::user()->id == 1)
                return view('registration.createAsAdmin', compact('session', 'children'));

            $family = session('family');
            $children = Child::get()->where('f_id','=', Auth::user()->id);

            return view('registration.create', compact('session'), compact('children'));
        }
        else return redirect()->route('login');
    }

   
    public function store(Request $request)
    {
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
            'f_id'=>'required|exists:family,f_id',
        ]);

        $session = Session::where('s_id',$attributes['s_id'])->first();
        $children = Child::where('f_id',request()->f_id)->get();
        
        foreach($children as $child){

            // get the c_id passed through the request. Store as id
            $id = request($child->c_id);

            // if the request c_id has a value (ie checked) check age constraints
            if(request($id) == $id) {
                $child->age=(new DateTime($child->birthdate))->diff(new DateTime())->y;
                $r_id = $this->checkAgeConstraints($child, $session, $request);
            }
        }
        
        if ($r_id == -1)
            return back()->withInput();
        return redirect()->route('registration.show',[$r_id]);
       
    }


    public function storeAsAdmin(Request $request)
    {
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
        ]);

        $children = Child::all();
        $session = Session::where('s_id',$attributes['s_id'])->first();
        $r_id;

        foreach($children as $child){
            $child->age=(new DateTime($child->birthdate))->diff(new DateTime())->y;
            $r_id = $this->checkAgeConstraints($child, $session, $request);
        }
        
        if ($r_id == -1)
            return back()->withInput();
        return redirect()->route('registration.show',[$r_id]);
    }

    

    public function checkAgeConstraints($child, $session, Request $request){
        
        $r_id = -1;

        // check that child is within the age constraints
        if (($child->age <= $session->max_age) && ($child->age >=$session->min_age)){

            // if the request c_id has a value (ie checked) AND session is not full, register child
            if(!$session->is_full){
                $registration = Registration::create([
                    's_id'=>request('s_id'),
                    'c_id'=>$child->c_id,
                ]);

                // update isFull status for session
                if (count(Registration::where('s_id',$session->s_id)->get()) >= $session->max_attendance)
                    $session->update(['is_full'=>'t']);

                $r_id = $registration->r_id;            
            }

            else {
            // throw error that there are not enough spots available
            // ** TODO **
            dd("No room " );
            }
            
        }

        else {
        // throw error that child does not meet age constraints
        // ** TODO **
        }
        dd("Wrong age");

        return $r_id;

    }

    public function show(Registration $registration)
    {
        $children = DB::table('child')
            
            ->join('registration','child.c_id','=','registration.c_id')
            ->where('registration.s_id','=',$registration->s_id)
            ->where('child.f_id','=', Auth::user()->id)
            ->select('child.child_name','registration.r_id')
            ->get();

        $session = Session::find($registration->s_id);

        return view('registration.show', compact('registration', 'children', 'session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
       $registration->delete();
       $session=Session::where('s_id', $registration->s_id)
            ->update(['is_full'=>'f']);
        return redirect()->route('session.show',[$registration->s_id]);
    }
}
