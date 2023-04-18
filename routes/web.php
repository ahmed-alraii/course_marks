<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SemesterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::redirect('/', app()->getLocale());

Route::group(['prefix' => '{language}'], function () {
    Auth::routes(['confirm' => false , 'reset' => false , 'register' => false , 'email' => false ]);
    Route::get('/dashboard' , [DashboardController::class , 'index'])->middleware('auth')->name('dashboard.index');
    Route::resource('/users', UserController::class)->middleware(['auth' , 'admin']);
    Route::resource('/_courses', CourseController::class)->middleware(['auth' , 'admin']);
    Route::resource('/teachers', TeacherController::class)->middleware(['auth' , 'admin']);
    Route::resource('/semesters', SemesterController::class)->middleware(['auth' , 'admin']);
    Route::resource('/students', StudentController::class)->middleware(['auth']);
    Route::resource('/exams', ExamController::class);

    Route::resource('/enrollments', EnrollmentController::class)->middleware(['auth' , 'admin']);

    Route::get('/all_courses', [EnrollmentController::class , 'getCoursesByYearSemesterId'])->name('all_courses')->middleware(['auth' , 'admin']);
    Route::get('/all_students', [EnrollmentController::class , 'getStudentsByTeacherIdAndCourseId'])->name('all_students')->middleware(['auth' , 'admin']);
    Route::get('/my_students', [EnrollmentController::class , 'getStudentsByTeacherIdAndCourseId'])->name('my_students')->middleware(['auth' , 'teacher']);

    Route::get('/year_semesters', [EnrollmentController::class , 'getSemestersForCurrentYear'])->name('year_semesters')->middleware(['auth']);
    Route::get('/semester_courses', [EnrollmentController::class , 'getCoursesBySemesterId'])->name('semester_courses')->middleware(['auth']);
    Route::get('/teacher_courses', [EnrollmentController::class , 'getCoursesByTeacherIdAndSemesterId'])->name('teacher_courses')->middleware(['auth' , 'teacher']);
    Route::get('/course_teachers', [EnrollmentController::class , 'getTeachersByCourseIdAndSemesterId'])->name('course_teachers')->middleware(['auth' , 'admin']);
    Route::get('/teacher_students', [EnrollmentController::class , 'getStudentsByCourseIdAndTeacherIdAndSemesterId'])->name('teacher_students')->middleware(['auth']);
    Route::get('/course_exams', [ExamController::class , 'getCourseExams'])->name('course_exams')->middleware(['auth']);
    Route::get('/student_mark', [MarkController::class , 'getStudentMarks'])->name('student_mark')->middleware(['auth']);


    Route::get('/create_course', [EnrollmentController::class ,  'showAddCourseToSemester'])->name('create_course')->middleware(['auth' , 'admin']);
    Route::get('/create_teacher', [EnrollmentController::class , 'showAddTeacherToCourse'])->name('create_teacher')->middleware(['auth' , 'admin']);
    Route::get('/create_student', [EnrollmentController::class , 'showAddStudentToTeacher'])->name('create_student')->middleware(['auth' , 'admin']);
   // Route::get('/create_exam', [ExamController::class , 'create'])->name('create_exam')->middleware(['auth' , 'teacher']);

    Route::post('/add_course', [EnrollmentController::class , 'addCourseToSemester'])->name('add_course')->middleware(['auth' , 'admin']);
    Route::post('/add_teacher', [EnrollmentController::class , 'addTeacherToCourse'])->name('add_teacher')->middleware(['auth' , 'admin']);
    Route::post('/add_student', [EnrollmentController::class , 'addStudentToTeacher'])->name('add_student')->middleware(['auth' , 'admin']);
   // Route::post('/add_exam', [ExamController::class , 'store'])->name('add_exam')->middleware(['auth' , 'teacher']);
    //Route::delete('/destroy_exam/{exam}', [ExamController::class , 'destroy'])->name('destroy_exam')->middleware(['auth' , 'teacher']);

    Route::resource('/student_marks', MarkController::class)->middleware(['auth']);

});
