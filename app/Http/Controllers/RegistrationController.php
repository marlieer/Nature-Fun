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
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

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

        $children = Child::where('f_id',request()->f_id)->get();
        
        return $this->checkAgeConstraints($children, $request);


       
    }


    public function storeAsAdmin(Request $request)
    {
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
        ]);

        $children = Child::all();
        return $this->checkAgeConstraints($children, $request);
    }

    

    public function checkAgeConstraints($children, Request $request){
        
        $r_id = -1;
        $session = Session::where('s_id',request('s_id'))->first();
        $classList = Registration::where('s_id', request('s_id'))
            ->select('c_id')
            ->get();

        $list=[];
        $success = 'Successfully registered';

        foreach($classList as $c_id){
            array_push($list,$c_id['c_id']);
        }

        $errors = Validator::make($session->toArray(),
                    ['min_age' => 'required']          
                ); 
       
        foreach($children as $child){

            // get the c_id passed through the request. Store as id
            $id = request($child->c_id);

            // if the request c_id has a value (ie checked) check age constraints
            if(request($id) == $id) {
                $child->age=(new DateTime($child->birthdate))->diff(new DateTime())->y;
                $child->age = (int)$child->age;

                // check that child is within the age constraints and there is space in the session
                $validator = Validator::make($child->toArray(),
                    ['age' => "numeric|min:$session->min_age|max:$session->max_age"],
                    ['is_full' => 'boolean:false'],
                             
                ); 

                if(in_array($child->c_id, $list)){
                    $validator->errors()->add('dum','dum');
                    $errors->errors()->add('Already Registered',"$child->child_name is already registered in this session");
                }
                elseif ($validator->fails()){
                    if($validator->messages()->get('age'))
                        $errors->errors()->add('Age',"$child->child_name could not be registered because (s)he is not within the age limits for this session ($session->min_age to $session->max_age)");
                    if($validator->messages()->get('is_full'))
                        $errors->errors()->add('Full',"This session is now full. $child->child_name could not be registered");                       
                }           
                        
                else {
                    $registration = Registration::create([
                        's_id'=>request('s_id'),
                        'c_id'=>$child->c_id,
                     ]);

                    $success = $success . ", $child->child_name";

                    $r_id = $registration->r_id;
                    // update isFull status for session
                    if (count(Registration::where('s_id',$session->s_id)->get()) >= $session->max_attendance)
                        $session->update(['is_full'=>'t']);
                
                }
            }
        }
        
        if ($r_id == -1)
            return back()->withErrors($errors);
        $request->session()->flash('success', $success);
        return redirect()->route('registration.show',[$r_id])->withErrors($errors);

    }


    public function show(Registration $registration)
    {
        $id = Auth::user()->id;
        $children;
        if ($id == 1){
            $children = DB::table('child')

                ->join('registration','child.c_id','=','registration.c_id')
                ->where('registration.s_id','=',$registration->s_id)
                ->select('child.child_name','registration.r_id')
                ->get();
        }
        else{
            $children = DB::table('child')
                
                ->join('registration','child.c_id','=','registration.c_id')
                ->where('registration.s_id','=',$registration->s_id)
                ->where('child.f_id','=', $id)
                ->select('child.child_name','registration.r_id')
                ->get();
        }
        $session = Session::find($registration->s_id);

        return view('registration.show', compact('registration', 'children', 'session', 'id'));
    }

    
    public function edit(Registration $registration)
    {
        //
    }

    
    public function update(Request $request, Registration $registration)
    {
        //
    }

    
    public function destroy(Registration $registration)
    {
       $registration->delete();
       $session=Session::where('s_id', $registration->s_id)
            ->update(['is_full'=>'f']);
        return redirect()->route('session.show',[$registration->s_id]);
    }
}
