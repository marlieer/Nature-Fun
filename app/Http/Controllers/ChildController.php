<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChildController extends Controller
{
    public function index()
    {
        if (Auth::id() == 1){
            $children = Child::join('family','child.f_id','=','family.f_id')
                    ->select('family.*','child.*')
                    ->get();
            return view('child/index', compact('children'));
        }
        return redirect()->route('login');
    }
	
    public function create()
    {
		return view('/child/create');
	}

	public function store(Request $request)
    {
        if ($request->session()->has('family')){
            $family = $request->session()->pull('family');
            $family->save();
            $user = User::create([
                'name'=>$family->first_name,
                'email'=>$family->email,
                'password'=>Hash::make($family->password),
                'id'=>$family->f_id,
            ]);

            // clean out session data
            $request->session()->flush();

            // login new user and redirect to sign up child
            Auth::login($user);
        }

        $attributes = request()->validate([
            'child_name'=>'required',
            'birthdate'=>['required','date'],
            'med_num'=>'max:10',
            'allergy_info'=>'max:250',
            'notes'=>'max:250'
        ]);

        $f_id = Auth::user()->id;
        $attributes['f_id'] = $f_id;
        $attributes['med_num'] = encrypt($attributes['med_num']);
        $child = Child::create($attributes);
        
        return redirect('/session');

    }
}
