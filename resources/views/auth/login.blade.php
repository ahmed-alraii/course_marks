@extends('layouts.login')
@section('title' , __('Login') )
@section('content')
    <div class="body-wrapper">
        <div class="main-wrapper">
            <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">

                <main class="auth-page">
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            <div
                                class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
                            <div
                                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">



                                <div class="mdc-card ">

                                    <h2 class="text-center mb-3 text-purple font-weight-medium">{{__('Login')}}</h2>

                                    <div class="row">
                                        @error('email')
                                        <span class="text-danger text-center" role="alert"><strong>
                                                 @foreach(explode(' ' ,$message) as $validationText)
                                                    {{ __(ucwords($validationText)) }}
                                                @endforeach
                                            </strong></span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        @error('password')
                                        <span class="text-danger text-center" role="alert"><strong>
                                                  @foreach(explode(' ' ,$message) as $validationText)
                                                    {{ __(ucwords($validationText)) }}
                                                @endforeach
                                            </strong></span>
                                        @enderror
                                    </div>

                                    <form @if(app()->getLocale() === 'ar') dir="rtl" @endif method="POST"
                                          action="{{ route('login' , ['language' => app()->getLocale()]) }}">
                                        @csrf
                                        <div class="mdc-layout-grid ">
                                            <div class="mdc-layout-grid__inner">
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                    <div class="mdc-text-field w-100">
                                                        <input class="mdc-text-field__input" name="email"
                                                               id="text-field-hero-input">
                                                        <div class="mdc-line-ripple"></div>
                                                        <label for="text-field-hero-input"
                                                               class="mdc-floating-label">{{__('User Mail')}}</label>
                                                    </div>
                                                </div>

                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                    <div class="mdc-text-field w-100">
                                                        <input class="mdc-text-field__input" type="password" name="password"
                                                               id="text-field-hero-input">
                                                        <div class="mdc-line-ripple"></div>
                                                        <label for="text-field-hero-input" class="mdc-floating-label">{{__('Password')}}</label>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                    <button type="submit" class="mdc-button mdc-button--raised w-100">
                                                        {{__('Login')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
