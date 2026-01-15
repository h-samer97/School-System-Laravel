<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index() {

        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();

        return view('sections.sections', compact('Grades','list_Grades'));

    }

    public function store(StoreSections $request) {
       try {

            $validated = $request->validated();
            $Sections = new Section();

            $Sections->name_section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->Grade_id;
            $Sections->class_id = $request->Class_id;
            $Sections->status = 1;
            $Sections->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('Sections.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function getClasses($id) {
       $Classes = Classroom::where('grade_id', $id)->pluck('name_class', 'id');
       return response()->json($Classes);
    }
}
