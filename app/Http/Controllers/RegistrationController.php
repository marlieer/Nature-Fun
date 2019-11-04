<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use App\Session;
use App\Family;
use App\Child;
use Illuminate\Support\Facades\Auth;

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
            $family = session('family');
            $children = Child::get()->where('f_id','=', Auth::user()->id);
            return view('registration.create', compact('session'), compact('children'));
        }
        else return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            's_id'=>'required|exists:session,s_id',
            'c_id'=>'required|exists:child,c_id',
        ]);
        $registration = Registration::create($attributes);
       
        return redirect('/session');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(Register $register)
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
    public function update(Request $request, Register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Register $register)
    {
        //
    }
}
