<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use Common;

    public function index()
    {
        $records = Student::orderBy('created_at' , 'desc')->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('admin.student.index')->with(['records' => $records, 'num' => $num]);
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(StudentRequest $request)
    {
        $data = $request->all();
        $res =  Student::create($data);
        $this->sendFlashMessage($res , 'Student' , 'Added');
        return redirect()->route('students.index', app()->getLocale());
    }

    public function edit(Request $request)
    {
        $id =  $request->route()->parameter('student');
        $record = Student::find($id);
        return view('admin.student.edit')->with(['record' => $record]);
    }


    public function update(StudentRequest $request)
    {
        $data = $request->all();
        $record = Student::find($data['id']);
        $res = $record->update($data);
        $this->sendFlashMessage($res , 'Student' , 'Updated');
        return redirect()->route('students.index', app()->getLocale());
    }


    public function destroy(Request $request)
    {
        $data = $request->all();
        $record = Student::find($data['id']);
        $res = $record->delete($data);
        $this->sendFlashMessage($res , 'Student' , 'Deleted');
        return redirect()->route('students.index', app()->getLocale());
    }

}
