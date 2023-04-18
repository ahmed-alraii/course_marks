@extends('layouts.main')
@section('title' , __('Enrollments'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">  {{$course->title}} - {{$teacher->name}} - {{ __('Students') }} </h2>

        @if(Auth::user()->role->name === 'Admin')
            <a href="{{ route('course_teachers' , [ 'language' => app()->getLocale() ,
               'course' => request()->query('course') ,  'semester' => request()->query('semester') ]) }}"
               class="mdc-button mdc-button--info text-white btn-sm mb-2">
                {{ __('Back') }}
            </a>
        @endif

        @if(Auth::user()->role->name === 'Teacher')
            <a href="{{ route('teacher_courses' , [ 'language' => app()->getLocale() ,
               'teacher' => request()->query('teacher') ,  'course' => request()->query('course') ,  'semester' => request()->query('semester') ]) }}"
               class="mdc-button mdc-button--info text-white btn-sm mb-2">
                {{ __('Back') }}
            </a>
        @endif

        @if(Auth::user()->role->name === 'Admin')
            <a href="{{ route('create_student' , [ 'language' => app()->getLocale() ,
          'course' => request()->query('course') ,
          'teacher' => request()->query('teacher') ,
          'semester' => request()->query('semester') ]) }}"
               class="mdc-button mdc-button--raised mb-2 "> {{ __('Add Student') }}
            </a>
        @endif

        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="table" class="table">
                    <thead>
                    <tr class="text-center">
                        <th class="text-center"> {{ __('#') }} </th>
                        <th class="text-center"> {{ __('Name') }} </th>
                        <th class="text-center"> {{ __('Parent Phone') }} </th>
                        <th class="text-center"> {{ __('Parent Email') }} </th>
                        <th class="text-center"> {{ __('Gender') }} </th>
                        <th class="text-center"> {{ __('Date Of Birth') }} </th>
                        <th class="text-center">{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($records as $record)

                        <tr>
                            <td class="text-center">{{ $num++ }}</td>
                            <td class="text-center">{{ $record->name }}</td>
                            <td class="text-center">{{ $record->parent_phone }}</td>
                            <td class="text-center">{{ $record->parent_email }}</td>
                            <td class="text-center">{{ $record->gender }}</td>
                            <td class="text-center">{{ $record->date_of_birth }}</td>
                            <td class="text-center">


                                    <a href="{{ route('student_mark', ['language' => app()->getLocale(),
                                                'student' => base64_encode($record->id),
                                                 'teacher' => request()->query('teacher'),
                                                 'course' => request()->query('course'),
                                                 'semester' => request()->query('semester')
                                       ]) }}"
                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Marks') }} </a>


{{--                                @if(Auth::user()->role->name === 'Teacher')--}}
{{--                                    <a href="{{ route('course_exams', ['language' => app()->getLocale(),--}}
{{--                                                'student' => base64_encode($record->id),--}}
{{--                                                 'teacher' => request()->query('teacher'),--}}
{{--                                                 'course' => request()->query('course'),--}}
{{--                                                 'semester' => request()->query('semester')--}}
{{--                                       ]) }}"--}}
{{--                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Exams') }} </a>--}}
{{--                                @endif--}}
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
