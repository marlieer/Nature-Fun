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
        {
            $children = Auth::user()->childs;
            foreach($children as $child){
                $child->name = decrypt($child->name);
            }
            $registrations = Auth::user()->registrations;

            dd($registrations);
            return view('registration/index', compact('children','registrations'));
        }
    }


    public function create($s_id)
    {
            $session = Session::findOrFail($s_id);

            if(Auth::user()->isAdmin()) {
                $children = Child::with('users')->get();
                foreach($children as $child){
                    $child->name = decrypt($child->name);
                }
                return view('registration.createAsAdmin', compact('session', 'children'));
            }

            $children = Auth::user()->childs;
            foreach($children as $child){
                $child->name = decrypt($child->name);
            }

            return view('registration.create', compact('session'), compact('children'));
    }


    public function store(Request $request)
    {
        $attributes = request()->validate([
            'session_id'=>'required|exists:session,id',
        ]);
        $children = Auth::user()->childs;

        return Registration::store($children, $request);
    }


    public function storeAsAdmin(Request $request)
    {
        $attributes = request()->validate([
            'session_id'=>'required|exists:session,id',
        ]);
        $children = Child::all();

        return Registration::store($children, $request);
    }

    public function storeManual(Request $request)
    {
        $session = Session::find($request->session_id);
        $attributes = request()->validate([
            'session_id'=>'required|exists:session,id',
            'phone'=>'required',
            'name'=>'required',
            'age'=>'required',
            'notes'=>'max:255',
            'allergy_info'=>'max:255'
        ]);

        Registration::create($attributes);
        $session->updateIsFull();

        $request->session()->flash('success', "Successfully registered $request->child_name");
        return redirect()->route('session.show',[$session->id]);
    }


    public function show(Registration $registration)
    {
            $session = $registration->session;
            $children =  Auth::user()->isAdmin() ? $registration->children() : $registration->children()->where('child.user_id', Auth::id());

            foreach($children as $child){
                $child->name = decrypt($child->name);
            }

            return view('registration.show', compact('registration', 'children', 'session'));
    }


    public function edit(Registration $registration)
    {
        if(Auth::check()){
            $session = $registration->session;
            $child = $registration->child;
            $child->name = decrypt($child->name);

            return view('registration.edit', compact('session','registration','child'));
        }
        else return redirect()->route('login');
    }


    public function destroy(Registration $registration, Request $request)
    {
        if (Auth::check()){
            $child = $registration->child();
            $child->name = decrypt($child->name);
            $session = $registration->session;
            $success = '';
            if($registration->child_id)
                $success = "Successfully cancelled registration for $child->name on $session->date at $session->start_time";
            else{
                $success = "Successfully cancelled registration for $registration->name on $session->date at $session->start_time";
            }
            $errors = ['We do not accept online cancellations within 24 hours of the session date. Please call Scout Island Nature Centre at 250-398-8532 to cancel. You will not be refunded.'];

            // if staff member is deleting, go ahead
            if(Auth::user()->isAdmin()){
             $registration->delete();
             $session->updateIsFull();
             $request->session()->flash('success', $success);
             return redirect()->route('session.show',[$registration->session_id]);
            }

            // if cancellation request is within 24 hours of the session, throw error.
            elseif ($session->date >= date('Y-m-d', time() - 60*60*24)) {

                return redirect("/registration/$registration->id/edit")->withErrors($errors);
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
