<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use Common;

    public function __construct()
    {
        $this->middleware('teacher')->except(['index']);
    }

    public function index()
    {
        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $semesterId = base64_decode(request()->query('semester'));
        $semester = Semester::findOrFail($semesterId);
        $teacherId = base64_decode(request()->query('teacher'));
        $teacher = Teacher::findOrFail($teacherId);


        $records = Exam::orderBy('created_at' , 'desc')
            ->where('course_id' , $courseId)
            ->where('teacher_id' , $teacherId)
            ->where('semester_id' , $semesterId)
            ->paginate(5);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('exam.index')->with([
            'records' => $records,
            'num' => $num  ,
            'course' => $course ,
            'teacher' => $teacher,
            'semester' => $semester
        ]);
    }


    public function create()
    {
        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        return view('exam.create')->with(['course' => $course]);
    }

    public function edit()
    {

        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $examId =  request()->route()->parameter('exam');
        $record = Exam::findOrFail($examId);
        return view('exam.edit')->with(['record' => $record , 'course' => $course]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $res =  Exam::create($data);
        $this->sendFlashMessage($res , 'Exam' , 'Added');
        return redirect()->route('course_exams',
            [
                'language' => app()->getLocale() ,
                'teacher' => base64_encode($data['teacher_id']),
                'semester' => base64_encode($data['semester_id']),
                'course' => base64_encode($data['course_id'])
            ]
        );
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $markId =  request()->route()->parameter('exam');
        $record = Exam::findOrFail($markId);
        $res =  $record->update($data);
        $this->sendFlashMessage($res , 'Mark' , 'Added');
        return redirect()->route('exams.index',
            [
                'language' => app()->getLocale() ,
                'teacher' => base64_encode($data['teacher_id']),
                'semester' => base64_encode($data['semester_id']),
                'course' => base64_encode($data['course_id'])
            ]
        );
    }


    public function destroy(Request $request)
    {
        $data = $request->all();
        $record = Exam::find($data['id']);
        $res = $record->delete();
        $this->sendFlashMessage($res , 'Exam' , 'Deleted');
        return redirect()->route('course_exams',
            [
                'language' => app()->getLocale() ,
                'teacher' => base64_encode($data['teacher_id']),
                'semester' => base64_encode($data['semester_id']),
                'course' => base64_encode($data['course_id'])
            ]
        );
    }
}
