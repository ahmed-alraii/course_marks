@extends('layouts.main')
@section('title' , __('Student Marks'))
@section('content')
    @php use App\Enums\ExamType  @endphp

    <div class="container mt-0">

        <h2 class="text-center">{{ __('Student Marks') }} </h2>
        <h3>{{__('Student : ')}} {{$student->name}}</h3>
        <h3>{{__('Course : ')}} {{$course->title}}</h3>
        <h3>{{__('Teacher : ')}} {{$teacher->name}}</h3>
        <h3 class="mb-5">{{__('Semester : ')}} {{$semester->year}} - {{$semester->semester}}</h3>

        <a href="{{ route('teacher_students' , [ 'language' => app()->getLocale() ,  'teacher' => request()->query('teacher'),
               'course' => request()->query('course'), 'semester' => request()->query('semester') ]) }}"
           class="mdc-button mdc-button--info text-white btn-sm mb-2">
            {{ __('Back') }}
        </a>

{{--        @if(auth()->user()->role->name === 'Teacher' )--}}
{{--            <a href="{{ route('student_marks.create' , [ 'language' => app()->getLocale() ,--}}
{{--                'student' => request()->query('student'), 'teacher' => request()->query('teacher'),--}}
{{--               'course' => request()->query('course'), 'semester' => request()->query('semester') ]) }}"--}}
{{--               class="mdc-button mdc-button--raised mb-2 "> {{ __('Add Mark') }}--}}
{{--            </a>--}}
{{--        @endif--}}

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
                        <th class="text-center"> {{ __('Student Mark') }} </th>
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
                                @if( \App\Models\Mark::where('student_id' , $student->id)->where('exam_id' , $record->id)->first() !== null)
                                    {{ \App\Models\Mark::where('student_id' , $student->id)->where('exam_id' , $record->id)->first()->student_mark }}
                                @else
                                        {{ __('No Mark') }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if(auth()->user()->role->name === 'Teacher' )

                                    @if( \App\Models\Mark::where('student_id' , $student->id)->where('exam_id' , $record->id)->first() !== null)

                                        <form
                                            action="{{ route('student_marks.destroy', ['language' => app()->getLocale(), 'student_mark' => $record->id]) }}"
                                            method="post">

                                            {{--                                        <a href="{{ route('student_marks.edit',--}}
                                            {{--                               [ 'language' => app()->getLocale() ,  'teacher' => request()->query('teacher'),--}}
                                            {{--                              'course' => request()->query('course'),  'student' => request()->query('student') , 'semester' => request()->query('semester') ,--}}
                                            {{--                              'student_mark' => $record->id ]) }}"--}}
                                            {{--                                           class="mdc-button mdc-button--success text-white p-3"> {{ __('Edit') }} </a>--}}

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
                                                {{ __('Delete Student Mark') }} </button>
                                        </form>
                                    @else

                                        <form
                                            action="{{ route('student_marks.store', ['language' => app()->getLocale()]) }}"
                                            method="post">

                                            <input type="hidden" name="exam_id" value="{{$record->id}}">
                                            <input type="hidden" name="student_id"
                                                   value="{{base64_decode(request()->query('student'))}}">
                                            <input type="hidden" name="semester_id"
                                                   value="{{base64_decode(request()->query('semester'))}}">
                                            <input type="hidden" name="course_id"
                                                   value="{{base64_decode(request()->query('course'))}}">
                                            <input type="hidden" name="teacher_id"
                                                   value="{{base64_decode(request()->query('teacher'))}}">
                                            @csrf

                                            <div class="row justify-content-center">

                                                    <input class="form-control  w-25 mr-2 text-center " type="number" name="student_mark"
                                                         required  placeholder="{{__('Student Mark')}}">

                                                <button type="submit" class=" col-sm-4 mdc-button mdc-button--success text-white p-3 mt-1">
                                                    {{ __('Add Mark') }} </button>
                                                </div>

                                        </form>

                                    @endif
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
