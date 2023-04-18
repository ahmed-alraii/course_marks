@extends('layouts.main')
@section('title' , __('Dashboard'))
@section('content')

    <div class="container p-5 bg-mdi-gray">
        <div class="row">

            <h2 class="text-center">{{ __('Dashboard') }} </h2>

            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--success">
                            <div class="card-inner">
                                <h5 class="card-title">{{ __('All') }}</h5>
                                <h5  class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Bookings')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">attach_money</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--danger">
                            <div class="card-inner">
                                <h5 class="card-title">{{__('Booked')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Bookings')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">book</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--primary">
                            <div class="card-inner">
                                <h5 class="card-title">{{__('Finished')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Bookings')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">trending_up</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--info">
                            <div class="card-inner">
                                <h5 class="card-title">{{__('Canceled')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Bookings')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">credit_card</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--success">
                            <div class="card-inner">
                                <h5 class="card-title">{{__('All')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Rents')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">attach_money</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--danger">
                            <div class="card-inner">
                                <h5 class="card-title">{{__('Rented')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Rents')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">book</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--primary">
                            <div class="card-inner">
                                <h5 class="card-title">{{__('Returned')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class="mt-3 text-muted text-center">{{__('Rents')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">trending_up</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                        <div class="mdc-card info-card info-card--info">
                            <div class="card-inner">
                                <h5 class="card-title">{{ __('Not') . ' ' .__('Returned')}}</h5>
                                <h5 class="font-weight-light pb-2 mb-1 border-bottom counts">{{5}}</h5>
                                <h5 class=" text-muted mt-3 text-center">{{__('Rents')}}</h5>
                                <div class="card-icon-wrapper">
                                    <i class="material-icons">credit_card</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

