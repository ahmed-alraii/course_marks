@extends('layouts.main')
@section('title' , __('My Courses'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('My Courses') }} </h2>

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
                            <a href="{{ route('my_students', ['language' => app()->getLocale(),
                           'course' => base64_encode($record->course_id) , 'teacher' =>  base64_encode($record->teacher_id)]) }}"
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
