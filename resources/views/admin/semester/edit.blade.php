@extends('layouts.main')
@section('title' , __('Edit Semester')  )
@section('content')

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Edit') }} {{ __('Semester') }} </h2>


        <a href="{{ route('semesters.index' , app()->getLocale()) }}" class="mdc-button mdc-button--success text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>


        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="{{ route('semesters.update' , [ 'language' => app()->getLocale() ,  'semester' => $record->id]) }}">
                @csrf
               @method('PUT')

                <input type="hidden" name="id" value="{{$record->id}}">

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input class="mdc-text-field__input" id="text-field-hero-input" name="year"
                                       type="number" max="2099" min="{{date('Y')}}"  value="{{$record->year}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Year')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('year')  {{$message}}   @enderror
                    </div>
                </div>



                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Edit') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
