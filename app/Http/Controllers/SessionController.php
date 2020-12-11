<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    public function index()
    {
        $spotsAvailable = array();
        $sessions = Session::all();
        foreach ($sessions as $s) {
            $spotsAvailable[$s->id] = $s->spotsAvailable();
        }

        $isAdmin = Auth::user()->isAdmin();
        return view('session.index', compact('sessions', 'spotsAvailable', 'isAdmin'));
    }


    public function create()
    {
        return view('/session/create');
    }


    public function store(Request $request)
    {
        // if repeat boxes checked, create session for each repeat
        $attributes = request()->validate([
            'session_date' => 'required|date',
            'end_repeat' => 'date|after:session_date',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:start_time',
            'max_attendance' => 'numeric',
            'max_age' => 'numeric',
            'min_age' => 'numeric'
        ]);

        Session::createSessions($attributes, $request);

        return redirect('/session');
    }


    public function show(Session $session)
    {
        $children = $session->childrenInTheSystem();
        $otherChildren = $session->childrenNotInTheSystem();

        foreach ($children as $child) {
            $child->age = (new DateTime($child->birthdate))->diff(new DateTime())->y;
            $child->name = decrypt($child->name);
        }

        return view('session.show', compact('session', 'children', 'otherChildren'));
    }


    public function showbydate(String $date)
    {
        $sessions = Session::where('date', $date)->get();
        $childrens = [];
        $otherChildrens = [];

        foreach ($sessions as $session) {
            $children = $session->childrenInTheSystem();
            $otherChildren = $session->childrenNotInTheSystem();

            foreach ($children as $child)
                $child->age = (new DateTime($child->birthdate))->diff(new DateTime())->y;

            array_push($childrens, $children);
            array_push($otherChildrens, $otherChildren);
        }

        return view('session.showbydate', compact('sessions', 'childrens', 'otherChildrens'));

    }


    public function edit(Session $session)
    {
        return view('session.edit', compact('session'));
    }


    public function update(Session $session, Request $request)
    {

        $attributes = request()->validate(['session_date' => ['required', 'date'],
            'end_repeat' => 'date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'max_attendance' => 'numeric',
            'max_age' => 'numeric',
            'min_age' => 'numeric',
            'title' => 'max:70'
        ]);

        $session->update($attributes);
        $request->session()->flash('success', "Successfully updated!");
        return redirect("/session/{$session->id}");

    }


    public function destroy(Session $session)
    {
        Session::destroy($session->id);
        return redirect('/session')->with('success', "Successfully deleted session!");
    }

}
