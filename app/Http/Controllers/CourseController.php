<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    use Common;

    public function index()
    {
        $records = Course::orderBy('created_at' , 'desc')->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('admin.course.index')->with(['records' => $records, 'num' => $num]);
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function store(CourseRequest $request)
    {
        $data = $request->all();
        $res =  Course::create($data);
        $this->sendFlashMessage($res , 'Course' , 'Added');
        return redirect()->route('_courses.index', app()->getLocale());
    }

    public function edit(Request $request)
    {
        $id =  $request->route()->parameter('_course');
        $record = Course::find($id);
        return view('admin.course.edit')->with(['record' => $record]);
    }


    public function update(CourseRequest $request)
    {
        $data = $request->all();
        $record = Course::find($data['id']);
        $res = $record->update($data);
        $this->sendFlashMessage($res , 'Course' , 'Updated');
        return redirect()->route('_courses.index', app()->getLocale());
    }


    public function destroy(Request $request)
    {
        $data = $request->all();
        $record = Course::find($data['id']);
        $res = $record->delete($data);
        $this->sendFlashMessage($res , 'Course' , 'Deleted');
        return redirect()->route('_courses.index', app()->getLocale());
    }
}
