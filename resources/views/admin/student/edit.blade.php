@extends('layouts.main')
@section('title' , __('Edit Teacher')  )
@section('content')

    <div class="container">

        <h2 class="text-center mt-3">{{ __('Edit') }} {{ __('Student') }} </h2>


        <a href="{{ route('students.index' , app()->getLocale()) }}"
           class="mdc-button mdc-button--success text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>


        <div class="row justify-content-center">
            <div class="row">

            </div>
            <form method="POST" action="{{ route('students.update' , [ 'language' => app()->getLocale() ,  'student' => $record->id]) }}">
                @csrf
               @method('PUT')

                <input type="hidden" name="id" value="{{$record->id}}">

                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input class="mdc-text-field__input" id="text-field-hero-input" name="name"
                                       value="{{$record->name}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Name')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('name')  {{$message}}   @enderror
                    </div>
                </div>


                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input class="mdc-text-field__input" id="text-field-hero-input" name="parent_email"
                                       value="{{$record->parent_email}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Parent Email')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('parent_email')  {{$message}}   @enderror
                    </div>
                </div>


                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input class="mdc-text-field__input" id="text-field-hero-input" name="parent_phone"
                                       value="{{$record->parent_phone}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Parent Phone')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('parent_phone')  {{$message}}   @enderror
                    </div>
                </div>


                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <select class="mdc-text-field__input form-control " name="gender">
                                    <option  @if($record->gender === 'Male') selected  @endif class="text-center" value="Male">{{__('Male')}}</option>
                                    <option  @if($record->gender === 'Female') selected  @endif class="text-center" value="Female">{{__('Female')}}</option>
                                </select>
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Select Gender')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('gender')  {{$message}}   @enderror
                    </div>
                </div>


                <div class="form-group row justify-content-center mb-3">
                    <div class="col-md-6">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-text-field">
                                <input class="mdc-text-field__input" id="text-field-hero-input" name="date_of_birth"
                                       type="date" value="{{$record->date_of_birth}}">
                                <div class="mdc-line-ripple"></div>
                                <label for="text-field-hero-input" class="mdc-floating-label">{{__('Date Of Birth')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger text-center">
                        @error('date_of_birth')  {{$message}}   @enderror
                    </div>
                </div>


                <div class="form-group text-center mt-3">
                    <input type="submit" value="{{ __('Edit') }} " class="mdc-button mdc-button--raised ">
                </div>
            </form>

        </div>
    </div>

@endsection
