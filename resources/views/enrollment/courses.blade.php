@extends('layouts.main')
@section('title' , __('Enrollments'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Semester')  }} {{$semester->semester}} - {{$semester->year}}
            - {{__('Courses')}} </h2>

        <a href="{{ route('year_semesters' , app()->getLocale()) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

        @if(Auth::user()->role->name === 'Admin')
            <a href="{{ route('create_course' ,  [ 'language' => app()->getLocale() , 'semester' => request()->query('semester') ])  }}"
               class="mdc-button mdc-button--raised mb-2 "> {{ __('Add Course') }}
            </a>
        @endif



        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="table" class="table">
                    <thead>
                    <tr>
                        <th class="text-center"> {{ __('#') }} </th>
                        <th class="text-center"> {{ __('Title') }} </th>
                        <th class="text-center"> {{ __('Description') }} </th>
                        <th class="text-center">{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($records as $record)

                        <tr>
                            <td class="text-center">{{ $num++ }}</td>
                            <td class="text-center">{{ $record->title }}</td>
                            <td class="text-center">{{ $record->description }}</td>
                            <td class="text-center">

                                @if(Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('course_teachers', ['language' => app()->getLocale(),
                                        'course' =>  base64_encode($record->id) , 'semester' => request()->query('semester')]) }}"
                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Teachers') }}
                                    </a>
                                @endif


                                @if(Auth::user()->role->name === 'Teacher')

                                    <a href="{{ route('exams.index', ['language' => app()->getLocale(),
                                     'teacher' => base64_encode($teacher->id) , 'course' =>  base64_encode($record->id) , 'semester' => request()->query('semester')]) }}"
                                       class="mdc-button mdc-button--outlined  p-3"> {{ __('Exams') }}
                                    </a>

                                    <a href="{{ route('teacher_students', ['language' => app()->getLocale(),
                                     'teacher' => base64_encode($teacher->id) , 'course' =>  base64_encode($record->id) , 'semester' => request()->query('semester')]) }}"
                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Students') }}
                                    </a>

                                @endif
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
