<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use Common;

    public function index()
    {
        $records = Teacher::orderBy('created_at' , 'desc')->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('admin.teacher.index')->with(['records' => $records, 'num' => $num]);
    }

    public function create()
    {
        return view('admin.teacher.create');
    }

    public function store(TeacherRequest $request)
    {
        $data = $request->all();
        $res =  Teacher::create($data);
        $this->sendFlashMessage($res , 'Teacher' , 'Added');
        return redirect()->route('teachers.index', app()->getLocale());
    }

    public function edit(Request $request)
    {
        $id =  $request->route()->parameter('teacher');
        $record = Teacher::find($id);
        return view('admin.teacher.edit')->with(['record' => $record]);
    }


    public function update(TeacherRequest $request)
    {
        $data = $request->all();
        $record = Teacher::find($data['id']);
        $res = $record->update($data);
        $this->sendFlashMessage($res , 'Teacher' , 'Updated');
        return redirect()->route('teachers.index', app()->getLocale());
    }


    public function destroy(Request $request)
    {
        $data = $request->all();
        $record = Teacher::find($data['id']);
        $res = $record->delete($data);
        $this->sendFlashMessage($res , 'Teacher' , 'Deleted');
        return redirect()->route('teachers.index', app()->getLocale());
    }

}
