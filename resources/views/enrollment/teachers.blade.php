@extends('layouts.main')
@section('title' , __('Enrollments'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Course')  }} {{$course->title}} {{ __('Teachers')  }}  </h2>


        <a href="{{ route('semester_courses' , [ 'language' => app()->getLocale() ,  'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

        <a href="{{ route('create_teacher' , [ 'language' => app()->getLocale() ,
          'course' => request()->query('course') ,
         'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--raised mb-2 "> {{ __('Add Teacher') }}
        </a>

        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="table" class="table">
                    <thead>
                    <tr class="text-center">
                        <th class="text-center"> {{ __('#') }} </th>
                        <th class="text-center"> {{ __('Name') }} </th>
                        <th class="text-center"> {{ __('Phone') }} </th>
                        <th class="text-center"> {{ __('Email') }} </th>
                        <th class="text-center"> {{ __('Specialization') }} </th>
                        <th class="text-center">{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($records as $record)

                        <tr>
                            <td class="text-center">{{ $num++ }}</td>
                            <td class="text-center">{{ $record->name }}</td>
                            <td class="text-center">{{ $record->phone }}</td>
                            <td class="text-center">{{ $record->email }}</td>
                            <td class="text-center">{{ $record->specialization }}</td>
                            <td class="text-center">
                                <a href="{{ route('teacher_students', ['language' => app()->getLocale(),
                                                'teacher' => base64_encode($record->id),
                                                'course' => request()->query('course'),
                                                'semester' => request()->query('semester')
                                       ]) }}"
                                   class="mdc-button mdc-button--success text-white p-3"> {{ __('Students') }} </a>
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
