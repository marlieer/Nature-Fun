<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child;

class ChildController extends Controller
{
    public function index(){

    $children = Child::all();

    return view('child', compact('children'));
}
	public function create(){
		return view('/child/create');
	}

	public function store(){

        $attributes = [request()->validate([
            'child_name'=>'required',
            'birthdate'=>['required','date'],
            'med_num'=>['max:10', 'unique:child,med_num'],
            'allergy_info'=>'max:250',
            'notes'=>'max:250'
        ]), session('id')];

        Child::create($attributes);

        return redirect('/session');

    }
}
