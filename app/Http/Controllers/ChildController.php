<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function index()
    {
        if (Auth::id() == 1){
            $children = Child::join('users','child.f_id','=','users.id')
                    ->select('users.*','child.*')
                    ->get();
            foreach($children as $child){
                $child->child_name = decrypt($child->child_name);
            }
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
        $attributes = request()->validate([
            'child_name'=>'required',
            'birthdate'=>['required','date'],
            'allergy_info'=>'max:250',
            'can_take_photos'=>['required','boolean'],
            'notes'=>'max:250'
        ]);

        $attributes['f_id'] = Auth::id();
        $attributes['child_name'] = encrypt($attributes['child_name']);
        Child::create($attributes);

        return redirect('/session');

    }
}
