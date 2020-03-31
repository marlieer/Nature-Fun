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
    public function index()
    {
        if (Auth::id() == 1) {
            $families = User::all();
            $children = Child::all();
            foreach($children as $child){
                $child->child_name = decrypt($child->child_name);
            }
            return view('family/index', compact('families', 'children'));
        }
        return redirect()->route('login');
    }

    public function create()
    {
        return view('family/create');
    }


}
