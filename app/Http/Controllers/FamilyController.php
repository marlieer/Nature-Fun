<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Family;
use App\Child;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class FamilyController extends Controller
{
    public function create(){
        return view('family/create');
    }

    public function create2(){
        return view('family/create2');
    }

    public function store(){

        $attributes = request()->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'phone'=>['required'],
            'email'=>['required','unique:family,email','email:rfc,dns'],
            'password'=>['required','min:8','confirmed']
        ]);
        
    	$family = Family::firstOrCreate(
            ['email'=>$attributes['email']], $attributes);

    	return redirect('/family/create2');
    
    }

    public function store2(){
        //dd(request()->all());
        $attributes = request()->validate([
            'emerg_contact'=>['max:70','required'],
            'emerg_phone'=>'max:15',
            'child_pickup'=>'max:250',
            'doctor'=>'max:70',
            'doc_phone'=>'max:15',
            'can_call_emerg'=>'boolean',
            'can_take_photos'=>'boolean',
            'iscustody'=>'boolean',
            'custody_notes'=>'max:300'
            ]);

        $family = Family::find(session('id'));
        $family->update($attributes);

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
