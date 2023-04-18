<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Http\Requests\EnrollCourseRequest;
use App\Http\Requests\EnrollStudentRequest;
use App\Http\Requests\EnrollTeacherRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{

    use Common;


    public function index()
    {
        $records = Semester::orderBy('created_at' , 'desc')->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.semesters')->with(['records' => $records, 'num' => $num]);
    }
    public function getSemestersForCurrentYear()
    {
        $records = Semester::orderBy('created_at' , 'desc')->where('year' , date('Y'))->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.semesters')->with(['records' => $records, 'num' => $num]);
    }

    public function showAddCourseToSemester()
    {
        $coursesTaken = Course::orderBy('created_at' , 'desc')->whereHas('semesters' , function ($query){
            $semesterId = base64_decode(request()->query('semester'));
            $query->where('semester_id' , $semesterId);
        })->pluck('id');
        $courses = Course::whereNotIn( 'id' , $coursesTaken)->get();
        return view('enrollment.add_course_to_semester' )->with(['courses' => $courses]);
    }

    public function showAddTeacherToCourse()
    {
        $courseId = base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $teachersTaken = Teacher::orderBy('created_at' , 'desc')->whereHas('courses' , function ($query) use($courseId) {
            $semesterId = base64_decode(request()->query('semester'));
            $query->where('course_id' , $courseId )->where('course_teacher.semester_id' , $semesterId);
        })->pluck('id');
        $teachers= Teacher::whereNotIn( 'id' , $teachersTaken)->get();
        return view('enrollment.add_teacher_to_course')->with(['teachers' => $teachers , 'course' => $course]);
    }

    public function showAddStudentToTeacher()
    {
        $teacherId = base64_decode(request()->query('teacher'));
        $teacher = Teacher::findOrFail($teacherId);
        $studentsTaken = Student::orderBy('created_at' , 'desc')->whereHas('courses' , function ($query) use($teacherId) {
            $semesterId = base64_decode(request()->query('semester'));
            $courseId = base64_decode(request()->query('course'));
            $query->where('course_id' , $courseId )
                ->where('course_student.semester_id' , $semesterId)
                ->where('course_student.teacher_id' , $teacherId);
        })->pluck('id');
        $students= Student::whereNotIn( 'id' , $studentsTaken)->get();
        return view('enrollment.add_student_to_teacher')->with(['students' => $students , 'teacher' => $teacher]);
    }

    public function getTeachersByCourseIdAndSemesterId()
    {

        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $semesterId = base64_decode(request()->query('semester'));
        $records = Teacher::orderBy('created_at' , 'desc')->whereHas('courses'  ,  function ($query) use($semesterId,$courseId) {
            $query->where('course_id' , $courseId)->where('course_teacher.semester_id' , $semesterId);
        })->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.teachers')->with(['records' => $records , 'course' => $course , 'num' => $num]);
    }

    public function getStudentsByCourseIdAndTeacherIdAndSemesterId()
    {

        $courseId =  base64_decode(request()->query('course'));
        $course = Course::findOrFail($courseId);
        $semesterId = base64_decode(request()->query('semester'));
        $teacherId = base64_decode(request()->query('teacher'));
        $teacher = Teacher::findOrFail($teacherId);
        $records = Student::orderBy('created_at' , 'desc')->whereHas('courses'  ,  function ($query) use($semesterId,$courseId , $teacherId) {
            $query->where('course_id' , $courseId)->where('course_student.semester_id' , $semesterId)->where('course_student.teacher_id' , $teacherId);
        })->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.students')->with(['records' => $records , 'course' => $course ,  'teacher' => $teacher , 'num' => $num]);
    }

    public function addCourseToSemester(EnrollCourseRequest $request)
    {
        $data = $request->only(['course_id' , 'semester_id']);
        $course = Course::findOrFail($data['course_id']);
        $semester= Semester::findOrFail(base64_decode($data['semester_id']));
        $course->semesters()->attach($semester);
        return redirect()->route('semester_courses' ,[ 'language' => app()->getLocale() , 'semester' => base64_encode($semester->id)]);

    }

    public function addTeacherToCourse(EnrollTeacherRequest $request)
    {
        $data = $request->only(['course_id' , 'teacher_id' , 'semester_id']);
        $teacher = Teacher::findOrFail($data['teacher_id']);
        $course = Course::findOrFail($data['course_id']);
        $course->teachers()->attach($teacher , ['semester_id' => $data['semester_id']]);
        return redirect()->route('course_teachers' ,[
            'language' => app()->getLocale() ,
            'semester' => base64_encode($data['semester_id']),
            'course' => base64_encode($data['course_id'])
        ]);

    }

    public function addStudentToTeacher(EnrollStudentRequest $request)
    {
        $data = $request->only(['student_id' , 'course_id' , 'teacher_id' , 'semester_id']);
        $student = Student::findOrFail($data['student_id']);
        $course = Course::findOrFail($data['course_id']);
        $course->students()->attach($student , [ 'teacher_id' => $data['teacher_id'] ,'semester_id' => $data['semester_id']]);
        return redirect()->route('teacher_students' ,[
            'language' => app()->getLocale() ,
            'teacher' => base64_encode($data['teacher_id']),
            'semester' => base64_encode($data['semester_id']),
            'course' => base64_encode($data['course_id'])
        ]);

    }

    public function getCoursesBySemesterId(Request $request)
    {
        $semesterId = base64_decode($request->query('semester'));
        $semester = Semester::where( 'id' ,  $semesterId)->first();
        $records = Course::orderBy('created_at' , 'desc')->whereHas('semesters' ,function ($query) use($semesterId){
            $query->where('semester' , $semesterId);
        })->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.courses')->with(['records' => $records, 'num' => $num , 'semester' => $semester]);
    }


    public function getCoursesByYearSemesterId(Request $request)
    {
        $email = $request->query('email');
        $email = base64_decode($email);
        $teacher = Teacher::where('email' , $email)->first();

        $semesterId = base64_decode($request->query('semester'));
        $semester = Semester::where( 'id' ,  $semesterId)->first();
        $records = Course::orderBy('created_at' , 'desc')->whereHas('semesters' ,function ($query) use($semesterId){
            $query->where('semester' , $semesterId);
        })->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.courses')->with(['records' => $records, 'num' => $num , 'semester' => $semester]);
    }

    public function getCoursesByTeacherIdAndSemesterId(Request $request)
    {
        $semesterId = base64_decode($request->query('semester'));
        $semester = Semester::where( 'id' ,  $semesterId)->first();
        $teacher = Teacher::where('email' , Auth::user()->email)->first() ;

        $records = Course::orderBy('created_at' , 'desc')->whereHas('teachers' ,function ($query) use($semesterId , $teacher){
            $query->where('teacher_id' , $teacher->id)->where('course_teacher.semester_id' , $semesterId);
        })->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('enrollment.courses')->with(['records' => $records, 'num' => $num , 'semester' => $semester , 'teacher' =>  $teacher]);
    }

}
