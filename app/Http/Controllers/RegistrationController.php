<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use App\Session;
use App\Child;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public function index()
    {
        if(Auth::check())
        {
            $children = Auth::user()->child();
            foreach($children as $child){
                $child->child_name = decrypt($child->child_name);
            }
            $registrations = Auth::user()->registrations();
            return view('registration/index', compact('children','registrations'));
        }
        return redirect()->route('login');
    }


    public function create($s_id)
    {
        if (Auth::check()){
            $session = Session::findOrFail($s_id);

            if(Auth::user()->id == 1){
                $children = Child::join('users','child.f_id','=','users.id')
                    ->select('c_id','child_name','last_name')
                    ->get();
                foreach($children as $child){
                    $child->child_name = decrypt($child->child_name);
                }
                return view('registration.createAsAdmin', compact('session', 'children'));
            }

            $children = Auth::user()->child();

            return view('registration.create', compact('session'), compact('children'));
        }
        else return redirect()->route('login');
    }


    public function store(Request $request)
    {
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
        ]);
        $children = Auth::user()->child();

        return Registration::store($children, $request);
    }


    public function storeAsAdmin(Request $request)
    {
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
        ]);

        $children = Child::all();
        foreach($children as $child){
            $child->child_name = decrypt($child->child_name);
        }
        return Registration::store($children, $request);
    }

    public function storeManual(Request $request)
    {
        $session = Session::find($request->s_id);
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
            'phone'=>'required',
            'child_name'=>'required',
            'age'=>'required',
            'notes'=>'max:255',
            'allergy_info'=>'max:255'
        ]);

        $success = "Successfully registered $request->child_name";
        Registration::create($attributes);
        $session->updateIsFull();

        $request->session()->flash('success', $success);
        return redirect()->route('session.show',[$session->s_id]);
    }


    public function show(Registration $registration)
    {
        if (Auth::check()){
            $id = Auth::user()->id;
            $session = $registration->session();
            $children =  $registration->children();

            if ($id != 1)
                $children = $children->where('child.f_id', $id);

            foreach($children as $child){
                $child->child_name = decrypt($child->child_name);
            }

            return view('registration.show', compact('registration', 'children', 'session', 'id'));
        }
        else return redirect()->route('login');
    }


    public function edit(Registration $registration)
    {
        if(Auth::check()){
            $session = $registration->session();
            $child = $registration->child();
            $child->child_name = decrypt($child->child_name);

            return view('registration.edit', compact('session','registration','child'));
        }
        else return redirect()->route('login');
    }


    public function destroy(Registration $registration, Request $request)
    {
        if (Auth::check()){
            $child = $registration->child();
            $child->child_name = decrypt($child->child_name);
            $session = $registration->session();
            $success = '';
            if($registration->c_id)
                $success = "Successfully cancelled registration for $child->child_name on $session->date at $session->start_time";
            else{
                $success = "Successfully cancelled registration for $registration->child_name on $session->date at $session->start_time";
            }
            $errors = ['We do not accept online cancellations within 24 hours of the session date. Please call Scout Island Nature Centre at 250-398-8532 to cancel. You will not be refunded.'];

            // if staff member is deleting, go ahead
            if(Auth::user()->id == 1){
             $registration->delete();
             $session->updateIsFull();
             $request->session()->flash('success', $success);
             return redirect()->route('session.show',[$registration->s_id]);
            }

            // if cancellation request is within 24 hours of the session, throw error.
            elseif ($session->date >= date('Y-m-d', time() - 60*60*24)) {

                return redirect("/registration/$registration->r_id/edit")->withErrors($errors);
            }

            // otherwise, delete from session and update is_full
            else {
                $registration->delete();
                $session->updateIsFull();
                $request->session()->flash('success', $success);
                return redirect('/registration');
            }
        }
        else return redirect()->route('login');
     }
}
