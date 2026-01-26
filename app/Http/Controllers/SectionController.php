<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teachers;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index() {

        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();

        $teachers = Teachers::all();

        return view('sections.sections', compact('Grades','list_Grades', 'teachers'));

    }

    public function store(StoreSections $request) {
       try {

            $validated = $request->validated();
            $Sections = new Section();

            $Sections->name_section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->Grade_id;
            $Sections->class_id = $request->Class_id;
            $Sections->status = 1;
            $Sections->teachers()->attach($request->teacher_id);
            $Sections->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('sections.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request) {

        try {
                $validated = $request->validated();
                $Sections = Section::findOrFail($request->id);

                $Sections->name_section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
                $Sections->grade_id = $request->Grade_id;
                $Sections->class_id = $request->Class_id;

                if(isset($request->status)) {
                    $Sections->status = 1;
                } else {
                    $Sections->status = 2;
                }


                // update pivot tABLE
                    if (isset($request->teacher_id)) {
                        $Sections->teachers()->sync($request->teacher_id);
                    } else {
                        $Sections->teachers()->sync(array());
                    }


                $Sections->save();
                toastr()->success(trans('messages.Update'));

                return redirect()->route('sections.index');
            }
            catch
            (Exception $error) {
                return redirect()->back()->withErrors(['error' => $error->getMessage()]);
            }

    }

    public function getClasses($id) {
       $Classes = Classroom::where('grade_id', $id)->pluck('name_class', 'id');
       return response()->json($Classes);
    }
}
