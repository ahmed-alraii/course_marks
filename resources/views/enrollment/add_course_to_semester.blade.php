@extends('layouts.main')
@section('title' , __('Add Course'))
@section('content')

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Add Course To Semester') }}  </h2>

        <a href="{{ route('semester_courses' , [ 'language' => app()->getLocale() , 'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="/{{ app()->getLocale() }}/add_course">
                @csrf

                <input type="hidden" name="semester_id" value="{{request()->query('semester')}}">
                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">

                                <select class="mdc-text-field__input form-control " name="course_id">
                                    @foreach($courses as $course)
                                        <option class="text-center" value="{{$course->id}}">{{__($course->title)}}</option>
                                    @endforeach
                                </select>
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Select Course')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('course_id')  {{$message}}   @enderror
                    </div>
                </div>



                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Add') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
