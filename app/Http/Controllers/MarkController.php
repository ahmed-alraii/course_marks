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

class MarkController extends Controller
{

    use Common;
    public function index(Request $request)
    {
        $enrollmentId = base64_decode($request->query('enrollment'));
        $records = Mark::orderBy('created_at' , 'desc')
            ->where('enrollment_id' , $enrollmentId)
            ->paginate(5);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('mark.index')->with(['records' => $records, 'num' => $num ]);
    }

    public function getStudentMarks()
    {
        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $semesterId = base64_decode(request()->query('semester'));
        $semester = Semester::findOrFail($semesterId);
        $teacherId = base64_decode(request()->query('teacher'));
        $teacher = Teacher::findOrFail($teacherId);
        $studentId = base64_decode(request()->query('student'));
        $student = Student::findOrFail($studentId);

        $records = Exam::orderBy('created_at' , 'desc')
            ->where('course_id' , $courseId)
            ->where('teacher_id' , $teacherId)
            ->where('semester_id' , $semesterId)
            ->paginate(5);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('mark.index')->with([
            'records' => $records,
            'num' => $num  ,
            'course' => $course ,
            'teacher' => $teacher,
            'student' => $student,
            'semester' => $semester
        ]);
    }


    public function create()
    {
        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        return view('mark.create')->with(['course' => $course]);
    }

    public function edit()
    {
        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $markId =  request()->route()->parameter('student_mark');
        $record = Mark::findOrFail($markId);
        return view('mark.edit')->with(['record' => $record , 'course' => $course]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $res =  Mark::create($data);
        $this->sendFlashMessage($res , 'Mark' , 'Added');
        return redirect()->route('student_mark',
            [
                'language' => app()->getLocale() ,
                'student' => base64_encode($data['student_id']),
                'teacher' => base64_encode($data['teacher_id']),
                'semester' => base64_encode($data['semester_id']),
                'course' => base64_encode($data['course_id'])
            ]
        );
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $markId =  request()->route()->parameter('student_mark');
        $record = Mark::findOrFail($markId);
        $res =  $record->update($data);
        $this->sendFlashMessage($res , 'Mark' , 'Added');
        return redirect()->route('student_mark',
            [
                'language' => app()->getLocale() ,
                'student' => base64_encode($data['student_id']),
                'teacher' => base64_encode($data['teacher_id']),
                'semester' => base64_encode($data['semester_id']),
                'course' => base64_encode($data['course_id'])
            ]
        );
    }


    public function destroy(Request $request)
    {
        $data = $request->all();
        $record = Mark::find($data['id']);
        $res = $record->delete();
        $this->sendFlashMessage($res , 'Mark' , 'Deleted');
        return redirect()->route('student_mark',
            [
                'language' => app()->getLocale() ,
                'student' => base64_encode($data['student_id']),
                'teacher' => base64_encode($data['teacher_id']),
                'semester' => base64_encode($data['semester_id']),
                'course' => base64_encode($data['course_id'])
            ]
        );
    }
}
