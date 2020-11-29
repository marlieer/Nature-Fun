@extends('layout')
@section('title', 'Create Sessions')
@section('content')
    <h1 class="centre">Create Nature Fun Sessions</h1>

    <form method="POST" action="{{ route('session.store') }}">
        @csrf
        <div class="container">
            <p>Note: if a Nature Fun session is created during a holiday (Ex. August Long Weekend) with this form, be
                sure to delete it manually.
            </p>
            <hr>

            <div>
                <label>Date:
                    <input type="date" name="session_date" value="{{ old('session_date') }}"/>
                </label>
            </div>
            <div>
                <label>Start time:
                    <input type="time" name="start_time" value="{{old('start_time')}}"/>
                </label>
            </div>
            <div>

                <label>End Time:
                    <input type="time" name="end_time" value="{{old('end_time')}}"/>
                </label>
            </div>

            <div>
                Repeat:
                <label>
                    <input type="checkbox" value="mon" name="mon">
                    Monday
                </label>
                <label>
                    <input type="checkbox" value="tue" name="tue">
                    Tuesday
                </label>
                <label>
                    <input type="checkbox" value="wed" name="wed"/>
                    Wednesday
                </label>
                <label>
                    <input type="checkbox" value="thu" name="thu"/>
                    Thursday
                </label>
                <label>
                    <input type="checkbox" value="fri" name="fri"/>
                    Friday
                </label><br>
            </div>
            <br>
            <div>
                End Repeat:
                <input type="date" name="end_repeat" value="{{old('end_repeat')}}"/>
            </div>

            <div>
                <div>
                    <label>Age Range (in years):
                        <input type="number" name="min_age" style="width:10%; " required/>
                    </label>
                </div>
                <div>
                    <label>to:
                        <input name="max_age" style="width:10%" required/>
                    </label>
                </div>
            </div>
            <div>
                <label>Max Attendance:
                    <input type="number" name="max_attendance" style="width:15%" required/>
                </label>
            </div>
        </div>

        <hr>


        <button style="width:30%" type="submit" class="btn btn-success">Finish</button>
        <br>
        <a href="{{ route('session.index') }}" style="width:30%; background-color:grey" type="cancel"
           class="btn btn-secondary">Cancel</a>

    </form>
@endsection
