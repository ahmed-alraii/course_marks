<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    use Common;

    public function index()
    {
        $records = Semester::orderBy('created_at' , 'desc')->paginate(4);
        $num = ($records->currentPage() - 1) * $records->perPage() + 1;
        return view('admin.semester.index')->with(['records' => $records, 'num' => $num]);
    }

    public function create()
    {
        return view('admin.semester.create');
    }

    public function store(SemesterRequest $request)
    {
        $data = $request->only('year');
        for($i = 1; $i <= 3; $i++){
            $res =  Semester::create([ 'year' => $data['year'] , 'semester' => $i]);
        }
        $this->sendFlashMessage($res , 'Semester' , 'Added');
        return redirect()->route('semesters.index', app()->getLocale());
    }

    public function edit(Request $request)
    {
        $id =  $request->route()->parameter('semester');
        $record = Semester::find($id);
        return view('admin.semester.edit')->with(['record' => $record]);
    }


    public function update(SemesterRequest $request)
    {
        $data = $request->only([ 'id' , 'year' ]);
        $record = Semester::find($data['id']);
        for($i = 1; $i <= 3; $i++){
            $res =  Semester::where('semester' , $i)->where('year' , $record->year)->first()->update($data);
        }
        $this->sendFlashMessage($res , 'Semester' , 'Updated');
        return redirect()->route('semesters.index', app()->getLocale());
    }


    public function destroy(Request $request)
    {
        $data = $request->only('id');
        $record = Semester::find($data['id']);
        for($i = 1; $i <= 3; $i++){
            $res =  Semester::where('semester' , $i)->where('year' , $record->year)->first()->delete();
        }
        $this->sendFlashMessage($res , 'Semester' , 'Deleted');
        return redirect()->route('semesters.index', app()->getLocale());
    }

}
