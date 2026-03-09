<?php


namespace App\Repository;

use App\Models\Fees;
use App\Models\Grade;
use App\Models\Student;


class StudentGraduatedRepository implements IStudentGraduated
{



    public function SoftDelete($request) {
        $Students = Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->classroom_id)->where('section_id', $request->section_id);
        
         if($Students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        $Students->delete();

        toastr()->success(trans('messages.success'));
        return redirect()->route('studentGraduated.index');

    }

    public function index() {

        # Return Students => deleteed_at !== NULL
        $students = Student::onlyTrashed()->get();
        return view('studentGraduated.index', compact('students'));

    }

    public function create() {

        $Grades = Grade::all();
        return view('studentGraduated.create', compact('Grades'));

    }

    public function ReturnData($request) {

        Student::onlyTrashed()->where('id', $request->id)->first()->restore();
         toastr()->success(trans('messages.success'));
        return redirect()->back();

    }

    public function destroy($request)
    {
        Fees::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }



}