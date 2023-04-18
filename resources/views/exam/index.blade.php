@extends('layouts.main')
@section('title' , __('Student Exams'))
@section('content')
    @php use App\Enums\ExamType  @endphp

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Student Exams') }} </h2>
        <h3>{{__('Course : ')}} {{$course->title}}</h3>
        <h3>{{__('Teacher : ')}} {{$teacher->name}}</h3>
        <h3 class="mb-5">{{__('Semester : ')}} {{$semester->year}} - {{$semester->semester}}</h3>

        <a href="{{ route('teacher_courses' , [ 'language' => app()->getLocale() ,  'teacher' => request()->query('teacher'),
               'course' => request()->query('course'), 'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

        @if(auth()->user()->role->name === 'Teacher' )
            <a href="{{ route('exams.create' , [
                   'language' => app()->getLocale() ,
                   'student' => request()->query('student'),
                   'teacher' => request()->query('teacher'),
                   'course' => request()->query('course'),
                   'semester' => request()->query('semester')
                ]) }}"
               class="mdc-button mdc-button--raised mb-2 "> {{ __('Add Exam') }}
            </a>
        @endif

        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="table" class="table">
                    <thead>
                    <tr>
                        <th class="text-center"> {{ __('#') }} </th>
                        <th class="text-center"> {{ __('Exam Type') }} </th>
                        <th class="text-center"> {{ __('Exam Number') }} </th>
                        <th class="text-center"> {{ __('Full Mark') }} </th>
                        <th class="text-center">{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($records as $record)

                        <tr>
                            <td class="text-center">{{ $num++ }}</td>
                            <td class="text-center">

                                @foreach(ExamType::cases() as $type)
                                    @if($type->value  === $record->type->value)
                                        {{ $type->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">{{ $record->number }}</td>
                            <td class="text-center">{{ $record->full_mark }}</td>
                            <td class="text-center">
                                <form
                                    action="{{ route('exams.destroy', ['language' => app()->getLocale(), 'exam' => $record->id]) }}"
                                    method="post">

                                    <a href="{{ route('exams.edit',
                               [ 'language' => app()->getLocale() ,  'teacher' => request()->query('teacher'),
                              'course' => request()->query('course'),  'student' => request()->query('student') , 'semester' => request()->query('semester') ,
                              'exam' => $record->id ]) }}"
                                       class="mdc-button mdc-button--success text-white p-3"> {{ __('Edit') }} </a>

                                    <input type="hidden" name="id" value="{{ $record->id }}">
                                    <input type="hidden" name="semester_id"
                                           value="{{base64_decode(request()->query('semester'))}}">
                                    <input type="hidden" name="course_id"
                                           value="{{base64_decode(request()->query('course'))}}">
                                    <input type="hidden" name="teacher_id"
                                           value="{{base64_decode(request()->query('teacher'))}}">
                                    <input type="hidden" name="student_id"
                                           value="{{base64_decode(request()->query('student'))}}">

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
