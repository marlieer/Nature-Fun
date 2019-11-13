<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Family;
use App\Child;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class FamilyController extends Controller
{
    public function create(){
        return view('family/create');
    }

    public function create2(){
        return view('family/create2');
    }

    public function store(Request $request){

        $attributes = request()->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>['required'],
            'email'=>['required','unique:family,email','unique:users,email','email:rfc,dns'],
            'password'=>['required','min:8','confirmed'],
        ]);
        
        // save new family (but do not persist to database) Instead,
        // store family info in session attribute
    	$family = Family::firstOrNew(
            ['email'=>$attributes['email']], 
            $attributes,
        );
        $request->session()->put('family',$family);


    	return redirect('/family/create2');
    
    }

    public function store2(Request $request){
        
        $attributes = request()->validate([
            'emerg_contact'=>['max:70','required'],
            'emerg_phone'=>'max:15',
            'child_pickup'=>'max:250',
            'doctor'=>'max:70',
            'doc_phone'=>'max:15',
            'can_call_emerg'=>'boolean',
            'can_take_photos'=>'boolean',
            'iscustody'=>'boolean',
            'custody_notes'=>'max:300',
            ]);

        // pull previously saved family info and create new family
        // with new attributes added. persist to database.
        $family = $request->session()->pull('family');
        $family->save();
        $family->update($attributes);

        // create new user for easy login based on family name, email, pass
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
        return redirect('/child/create');
    }

    public function show(family $family)
    {
        return view('family.show', compact('family'));
    }


    public function edit(Family $family)
    {
        return view('family.edit', compact('family'));
    }

    
    public function update(Family $family)
    {
       $family->update($attributes);

        return redirect('/session');

    }

   
    public function destroy(Family $family)
    {
        $family->delete();
        return redirect('/');
    }

}
