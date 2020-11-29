<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::join('users', 'child.user_id', '=', 'users.id')
            ->select('users.*', 'child.*')
            ->get();
        foreach ($children as $child) {
            $child->name = decrypt($child->name);
        }
        return view('child/index', compact('children'));

    }

    public function create()
    {
        return view('/child/create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'birthdate' => ['required', 'date'],
            'allergy_info' => 'max:250',
            'can_take_photos' => ['required', 'boolean'],
            'notes' => 'max:250'
        ]);

        $attributes['user_id'] = Auth::id();
        $attributes['name'] = encrypt($attributes['name']);
        Child::create($attributes);

        return redirect()->route('dashboard')->with('success', "Successfully added $request->name as your child");

    }
}
