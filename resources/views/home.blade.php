@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-header">
                        My Upcoming Registered Sessions
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($registrations->slice(0,5) as $reg)
                                <li>{{ date('M j', strtotime($reg->date)) }}
                                    , {{ date('g:i a', strtotime($reg->start_time)) }}
                                    - {{ date('g:i a', strtotime($reg->end_time)) }}: {{ $reg->child_name }}</li>
                            @endforeach
                            <li><a href="/registration">View All My Registrations</a></li>
                        </ul>
                    </div>
                    <div class="card-header">
                        Children
                    </div>
                    <div class="card-body">
                        <ul>
                            @if($children)
                                @foreach ($children as $child)
                                    <li>{{ $child->name }}</li>
                                @endforeach
                            @endif
                            <li><a href="/child/create">Add Child</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
