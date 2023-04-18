@extends('layouts.main')
@section('title' , __('Add Mark'))
@section('content')
@php use App\Enums\ExamType;  @endphp

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Add Exam To') }} {{$course->title}} {{ __('Course') }} </h2>

        <a href=" {{ route('course_exams' , [ 'language' => app()->getLocale() ,
                'student' => request()->query('student'), 'teacher' => request()->query('teacher'),
               'course' => request()->query('course'), 'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--success text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="/{{ app()->getLocale() }}/add_exam">
                @csrf


                <input type="hidden" name="semester_id" value="{{base64_decode(request()->query('semester'))}}">
                <input type="hidden" name="course_id" value="{{base64_decode(request()->query('course'))}}">
                <input type="hidden" name="teacher_id" value="{{base64_decode(request()->query('teacher'))}}">

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <select class="mdc-text-field__input form-control " name="type">

                                    @foreach(ExamType::cases() as $type)
                                        <option class="text-center"
                                                value="{{$type->value}}">{{__($type->name)}}</option>
                                    @endforeach
                                </select>

                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input"
                                       class="mdc-floating-label">{{__('Select Exam Type')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('exam_type')  {{$message}}   @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input type="number" min="1" max="5" class="mdc-text-field__input"
                                       id="text-field-hero-input" name="number"
                                       value="{{old('exam_number')}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input"
                                       class="mdc-floating-label">{{__('Exam Number')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('exam_number')  {{$message}}   @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input type="number" min="1" max="100" class="mdc-text-field__input"
                                       step="0.01"    id="text-field-hero-input" name="full_mark"
                                       value="{{old('full_mark')}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input"
                                       class="mdc-floating-label">{{__('Full Mark')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('full_mark')  {{$message}}   @enderror
                    </div>
                </div>

                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Add') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
