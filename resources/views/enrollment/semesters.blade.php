@extends('layouts.main')
@section('title' , __('Semesters'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Semesters') }} </h2>

        <div class="row">
            <br>
            <div class="table-responsive bg-light ">
                <table id="table" class="table">
                    <thead>
                    <tr>
                        <th class="text-center"> {{ __('#') }} </th>
                        <th class="text-center"> {{ __('Year') }} </th>
                        <th class="text-center"> {{ __('Semester') }} </th>
                        <th class="text-center">{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td class="text-center">{{ $num++ }}</td>
                            <td class="text-center">{{ $record->year }}</td>
                            <td class="text-center"> {{ __('Semester') }}-{{ $record->semester }}</td>
                            <td class="text-center">


                                <a href=" @if(Auth::user()->role->name === 'Admin')
                                              {{ route('semester_courses', ['language' => app()->getLocale(), 'semester' => base64_encode($record->id)]) }}
                                          @endif
                                          @if(Auth::user()->role->name === 'Teacher')
                                               {{ route('teacher_courses', ['language' => app()->getLocale(), 'semester' => base64_encode($record->id)]) }}
                                           @endif"
                                   class="mdc-button mdc-button--success text-white p-3"> {{ __('Courses') }} </a>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                @if (count($records) === 0)
                    <div class="text-center">
                        <h4> {{ __('No Data') }} </h4>
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center mt-2">

            {{ $records->links() }}
        </div>
    </div>
@endsection
