<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassrooms;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index() {
       
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view("classroom.my_classroom", compact("My_Classes", "Grades"));

    }
    
    public function store(Request $request) {
        
       $data = $request->List_Classes;

       foreach($data as $row) {

            $ClassRoom = new Classroom();
            $ClassRoom->name_class = ['en' => $row['Name_en'], 'ar' => $row['Name_ar']];
            $ClassRoom->grade_id = $row['Grade_id'];
            $ClassRoom->save();

       }
       toastr()->success(trans('messages.success'));
       return redirect()->route('Classroom.index');

        
    }

    public function update(Request $request) {

        $Classrooms = Classroom::findOrFail($request->id);

        $Classrooms->update([
            $Classrooms->name_class = ['ar' => $request->Name, 'en' => $request->Name_en];
            $Classrooms->Grade_id = $request->Grade_id;
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('Classroom.index');

    }

    public function destroy(Request $request) {
        $Classroom = Classroom::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Classroom.index');
    }
}
