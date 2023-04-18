@extends('layouts.main')
@section('title' , __('Edit User')  )
@section('content')

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Edit') }} {{ __('Course') }} </h2>


        <a href="{{ route('_courses.index' , app()->getLocale()) }}" class="mdc-button mdc-button--success text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>


        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="{{ route('_courses.update' , [ 'language' => app()->getLocale() ,  '_course' => $record->id]) }}">
                @csrf
               @method('PUT')

                <input type="hidden" name="id" value="{{$record->id}}">

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input class="mdc-text-field__input" id="text-field-hero-input" name="title" value="{{$record->title}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Title')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('title')  {{$message}}   @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-text-field h-75">
                        <textarea class=" mdc-text-field__input " id="text-field-hero-input" rows="5"
                                  cols="" name="description">{{$record->description}}</textarea>
                            <div class="mdc-line-ripple"></div>
                            <label for="text-field-hero-input" class="mdc-floating-label">{{__('Description')}}</label>
                        </div>
                        <div class="text-danger text-center">
                            @error('description')  {{$message}}   @enderror
                        </div>
                    </div>
                </div>



                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Edit') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
