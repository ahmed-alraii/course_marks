@extends('layouts.main')
@section('title' , __('Students'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Students') }} </h2>

        <a href="{{ route('my_courses' ,[ 'language' => app()->getLocale() , 'email' => base64_encode(auth()->user()->email) ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

{{--        <a href="{{ route('_courses.create' , app()->getLocale()) }}" --}}
{{--           class="mdc-button mdc-button--raised mb-2 "> {{ __('Add') }}--}}
{{--        </a>--}}

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

                           <a href="{{ route('student_marks.index', ['language' => app()->getLocale(),
                          'enrollment' => base64_encode($record->id) , 'course' => request()->query('course'), 'teacher' => request()->query('teacher')]) }}"
                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Marks') }} </a>

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
