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
        return view('session.index', ['sessions' => Session::all()]);
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
            'end_repeat' => 'required_with:mon,tue,wed,thu,fri|date|after:session_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_attendance' => 'required|numeric',
            'max_age' => 'nullable|numeric',
            'min_age' => 'nullable|numeric',
            'title' => 'nullable|max:70',
        ]);

        Session::createSessions($attributes, $request);

        return redirect('/session');
    }


    public function show(Session $session)
    {
        $children = $session->childrenInTheSystem();
        $otherChildren = $session->childrenNotInTheSystem();

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

        $attributes = request()->validate([
            'session_date' => 'required|date',
            'end_repeat' => 'required_with:mon,tue,wed,thu,fri|date|after:session_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_attendance' => 'required|numeric',
            'max_age' => 'nullable|numeric',
            'min_age' => 'nullable|numeric',
            'title' => 'nullable|max:70'
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
