@extends('layout')
@section('title', 'Child Sign Up')
@section('h1','Add Child to Your Account')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <form method="POST" action="{{ route('child.store') }}">
                        <div class="container">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Child\'s Name') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthdate"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="birthdate"
                                           type="date"
                                           class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}"
                                           name="birthdate"
                                           value="{{ old('birthdate') }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('birthdate'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="can_take_photos"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Can we take photos of your child?') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="can_take_photos"
                                           type="radio"
                                           class="form-control{{ $errors->has('can_take_photos') ? ' is-invalid' : '' }}"
                                           name="can_take_photos"
                                           value="1"
                                           {{ old('can_take_photos') == 1 ? 'checked' : ''}}
                                           required
                                           autofocus/>Yes
                                    <input id="can_take_photos"
                                           type="radio"
                                           class="form-control{{ $errors->has('can_take_photos') ? ' is-invalid' : '' }}"
                                           name="can_take_photos"
                                           value="0"
                                           {{ old('can_take_photos') == 0 ? 'checked' : ''}}
                                           required
                                           autofocus/>No
                                </div>

                                    @if ($errors->has('can_take_photos'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('can_take_photos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="allergy_info"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Allergy Information') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="allergy_info"
                                           type="text"
                                           class="form-control{{ $errors->has('allergy_info') ? ' is-invalid' : '' }}"
                                           name="allergy_info"
                                           value="{{ old('allergy_info') }}"
                                           autofocus>

                                    @if ($errors->has('allergy_info'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('allergy_info') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="notes"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Other Relevant Information') }}
                                </label>
                                <div class="col-md-6">
                                    <textarea id="notes"
                                              class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}"
                                              name="notes"
                                              autofocus
                                              placeholder="Ex. any kind of mental or physical disability"
                                    >{{ old('notes') }}</textarea>

                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
