@extends('layouts.main')
@section('title' , __('Add Course'))
@section('content')

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Add Teacher To ') }} {{$course->title}}  {{ __('Course') }} </h2>

        <a href="{{ route('course_teachers' , [ 'language' => app()->getLocale() ,  'course' => request()->query('course') ,  'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="/{{ app()->getLocale() }}/add_teacher">
                @csrf

                <input type="hidden" name="semester_id" value="{{base64_decode(request()->query('semester'))}}">
                <input type="hidden" name="course_id" value="{{base64_decode(request()->query('course'))}}">

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">

                                <select class="mdc-text-field__input form-control " name="teacher_id">
                                    @foreach($teachers as $teacher)
                                        <option class="text-center" value="{{$teacher->id}}">{{__($teacher->name)}}</option>
                                    @endforeach
                                </select>
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Select Teacher')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('teacher_id')  {{$message}}   @enderror
                    </div>
                </div>



                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Add') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
