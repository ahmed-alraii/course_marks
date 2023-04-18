@extends('layouts.main')
@section('title' , __('Teachers'))
@section('content')

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Teachers') }} </h2>

            <a href="{{ route('teachers.create' , app()->getLocale()) }}" class="mdc-button mdc-button--raised mb-2 "> {{ __('Add') }}
            </a>

        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="table" class="table">
                    <thead>
                        <tr class="text-center" >
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

                                <tr >
                                    <td class="text-center">{{ $num++ }}</td>
                                    <td class="text-center">{{ $record->name }}</td>
                                    <td class="text-center">{{ $record->phone }}</td>
                                    <td class="text-center">{{ $record->email }}</td>
                                    <td class="text-center">{{ $record->specialization }}</td>
                                    <td class="text-center">
                                        <form
                                            action="{{ route('teachers.destroy', ['language' => app()->getLocale(), 'teacher' => $record->id]) }}"
                                            method="post">

                                            <input type="hidden" name="id" value="{{ $record->id }}">
                                        <a href="{{ route('teachers.edit', ['language' => app()->getLocale(), 'teacher' => $record->id]) }}"
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
