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

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title ') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title" value="{{ old('title') }}"  autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="session_date" class="col-md-4 col-form-label text-md-right">{{ __('Date ') }}<span class="required">*</span></label>

                <div class="col-md-6">
                    <input id="session_date" type="date"
                           class="form-control{{ $errors->has('session_date') ? ' is-invalid' : '' }}"
                           name="session_date" value="{{ old('session_date') }}" required autofocus>

                    @if ($errors->has('session_date'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('session_date') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time ') }}<span class="required">*</span></label>

                <div class="col-md-6">
                    <input id="start_time" type="time"
                           class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time"
                           value="{{ old('start_time') }}" required autofocus>

                    @if ($errors->has('start_time'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time ') }}<span class="required">*</span></label>

                <div class="col-md-6">
                    <input id="end_time" type="time"
                           class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time"
                           value="{{ old('end_time') }}" required autofocus>

                    @if ($errors->has('end_time'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="repeat" class="col-md-4 col-form-label text-md-right">{{ __('Repeat ') }}</label>


                <div class="col-md-6">
                    <div class="col-md-2 form-check form-check-inline ">
                        <label for="mon" class="form-check-label text-md-right">{{ __('Mon ') }}</label>
                        <input id="mon" type="checkbox"
                               class="form-check-input{{ $errors->has('mon') ? ' is-invalid' : '' }}" name="mon"
                               autofocus>

                        @if ($errors->has('mon'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mon') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="form-check form-check-inline col-md-2">
                        <label for="tue" class="form-check-label text-md-right">{{ __('Tue ') }}</label>
                        <input id="tue" type="checkbox"
                               class="form-check-input{{ $errors->has('tue') ? ' is-invalid' : '' }}" name="tue"
                               autofocus>

                        @if ($errors->has('tue'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tue') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="form-check form-check-inline col-md-2">
                        <label for="wed" class="form-check-label text-md-right">{{ __('Wed ') }}</label>
                        <input id="wed" type="checkbox"
                               class="form-check-input{{ $errors->has('wed') ? ' is-invalid' : '' }}" name="wed"
                               autofocus>

                        @if ($errors->has('wed'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('wed') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="form-check form-check-inline col-md-2">
                        <label for="thu" class="form-check-label text-md-right">{{ __('Thu ') }}</label>
                        <input id="thu" type="checkbox"
                               class="form-check-input{{ $errors->has('thu') ? ' is-invalid' : '' }}" name="thu"
                               autofocus>

                        @if ($errors->has('thu'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('thu') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="form-check form-check-inline col-md-2">
                        <label for="fri" class="form-check-label text-md-right">{{ __('Fri ') }}</label>
                        <input id="fri" type="checkbox"
                               class="form-check-input{{ $errors->has('fri') ? ' is-invalid' : '' }}" name="fri"
                               autofocus>

                        @if ($errors->has('fri'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fri') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="end_repeat" class="col-md-4 col-form-label text-md-right">{{ __('End Repeat ') }}<span class="required">*</span></label>

                <div class="col-md-6">
                    <input id="end_repeat" type="date"
                           class="form-control{{ $errors->has('end_repeat') ? ' is-invalid' : '' }}" name="end_repeat"
                           value="{{ old('end_repeat') }}" required autofocus>

                    @if ($errors->has('end_repeat'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_repeat') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="min_age" class="col-md-4 col-form-label text-md-right">{{ __('Minimum Age') }}</label>

                <div class="col-md-2">
                    <input id="min_age" type="number"
                           class="form-control{{ $errors->has('min_age') ? ' is-invalid' : '' }}" name="min_age"
                           value="{{ old('min_age') }}" autofocus>

                    @if ($errors->has('min_age'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('min_age') }}</strong>
                                    </span>
                    @endif
                </div>


                <label for="max_age" class="col-md-2 col-form-label text-md-right">{{ __('Maximum Age') }}</label>

                <div class="col-md-2">
                    <input id="max_age" type="number"
                           class="form-control{{ $errors->has('max_age') ? ' is-invalid' : '' }}" name="max_age"
                           value="{{ old('max_age') }}" autofocus>

                    @if ($errors->has('max_age'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('max_age') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="max_attendance"
                       class="col-md-4 col-form-label text-md-right">{{ __('Class Size Limit ') }}<span class="required">*</span></label>

                <div class="col-md-6">
                    <input id="max_attendance" type="number"
                           class="form-control{{ $errors->has('max_attendance') ? ' is-invalid' : '' }}"
                           name="max_attendance" value="{{ old('max_attendance') }}" required autofocus>

                    @if ($errors->has('max_attendance'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('max_attendance') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group row mb-4">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </div>
        <div class="form-group row mb-4">
            <div class="col-md-6 offset-md-3">
                <a href="{{ route('session.index') }}" class="btn delbtn">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
    </form>
@endsection
