@extends('layouts.main')
@section('title' , __('Students'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Students') }} </h2>
        @if(auth()->user()->role->name === 'Admin')
            <a href="{{ route('students.create' , app()->getLocale()) }}"
               class="mdc-button mdc-button--raised mb-2 "> {{ __('Add') }}
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
                                @if(auth()->user()->role->name === 'Admin')
                                    <form
                                        action="{{ route('students.destroy', ['language' => app()->getLocale(), 'student' => $record->id]) }}"
                                        method="post">

                                        <input type="hidden" name="id" value="{{ $record->id }}">
                                        <a href="{{ route('students.edit', ['language' => app()->getLocale(), 'student' => $record->id]) }}"
                                           class="mdc-button mdc-button--success text-white p-3"> {{ __('Edit') }} </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick=" event.preventDefault(); confirmDelete(
                                               '{{ __('Confirm Delete') }} ',
                                                '{{ __('Are You Sure?') }} ',
                                                '{{ __('Yes') }}' ,
                                                '{{ __('Cancel') }}' ,
                                                  this ); "
                                                class="mdc-button mdc-button--danger p-3">
                                            {{ __('Delete') }} </button>
                                    </form>
                                @endif

                                @if(auth()->user()->role->name === 'Teacher')
                                    <a href="{{ route('enrollments.index', ['language' => app()->getLocale(), 'student' => $record->id]) }}"
                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Courses') }} </a>

                                    <a href="{{ route('marks.index', ['language' => app()->getLocale(), 'student' => $record->id]) }}"
                                       class="mdc-button mdc-button--primary text-white p-3"> {{ __('Marks') }} </a>
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
