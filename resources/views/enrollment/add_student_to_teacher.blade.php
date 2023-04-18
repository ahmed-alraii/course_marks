@extends('layouts.main')
@section('title' , __('Add Course'))
@section('content')

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Add Student With ') }} {{ $teacher->name }} {{ __('Teacher') }} </h2>

        <a href="{{ route('teacher_students' , [ 'language' => app()->getLocale() ,  'teacher' => request()->query('teacher'),
               'course' => request()->query('course'), 'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>


        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="/{{ app()->getLocale() }}/add_student">
                @csrf

                <input type="hidden" name="semester_id" value="{{base64_decode(request()->query('semester'))}}">
                <input type="hidden" name="course_id" value="{{base64_decode(request()->query('course'))}}">
                <input type="hidden" name="teacher_id" value="{{base64_decode(request()->query('teacher'))}}">

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">

                                <select class="mdc-text-field__input form-control " name="student_id">
                                    @foreach($students as $student)
                                        <option class="text-center" value="{{$student->id}}">{{__($student->name)}}</option>
                                    @endforeach
                                </select>
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Select Student')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('student_id')  {{$message}}   @enderror
                    </div>
                </div>



                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Add') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
