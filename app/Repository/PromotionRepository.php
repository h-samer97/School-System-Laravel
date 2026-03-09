<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotions;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Exception;

class PromotionRepository implements IPromotion {

    public function index() {
        $Grades = Grade::all();
        return view('promotions.index', compact('Grades'));
    }

    public function create() {
        $promotions = Promotions::all();
        return view('promotions.managment',compact('promotions'));
    }


public function store($request) {

    DB::beginTransaction();
    try {
        $students = Student::where('grade_id', $request->Grade_id)
            ->where('classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->where('academic_year', $request->academic_year)->get();

        if ($students->count() < 1) {
            return redirect()->back()->with(['errors', 'لا توجد بيانات طلاب مطابقة']);
        }

        foreach ($students as $student) {

            $student->update([
                'grade_id'      => $request->Grade_id_new,
                'classroom_id'  => $request->Classroom_id_new,
                'section_id'    => $request->section_id_new,
                'academic_year' => $request->academic_year_new,
            ]);

            Promotions::updateOrCreate([
                'student_id'        => $student->id,
                'from_grade'        => $request->Grade_id,
                'from_Classroom'    => $request->Classroom_id,
                'from_section'      => $request->section_id,
                'to_grade'          => $request->Grade_id_new,
                'to_Classroom'      => $request->Classroom_id_new,
                'to_section'        => $request->section_id_new,
                'academic_year'     => $request->academic_year,
                'academic_year_new' => $request->academic_year_new,
            ]);
        }

        DB::commit();
        toastr()->success(trans('messages.success'));
        return redirect()->back();

    } catch (Exception $error) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $error->getMessage()]);
    }
}

public function destroy($request) {
    DB::beginTransaction();
    try {
        if($request->page_id == 1) {
            $Promotions = Promotions::all();
            foreach ($Promotions as $Promotion) {
                // التحديث في جدول الطلاب للعودة للحالة السابقة
                Student::where('id', $Promotion->student_id)->update([
                    'grade_id'      => $Promotion->from_grade,
                    'classroom_id'  => $Promotion->from_Classroom,
                    'section_id'    => $Promotion->from_section,
                    'academic_year' => $Promotion->academic_year,
                ]);
            }
            // حذف كل البيانات من جدول الترقيات بعد انتهاء التحديث
            DB::table('promotions')->delete(); 
            
            DB::commit();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } else {
            // تراجع عن طالب واحد
            $Promotion = Promotions::findOrFail($request->id);
            Student::where('id', $Promotion->student_id)->update([
                'grade_id'      => $Promotion->from_grade,
                'classroom_id'  => $Promotion->from_Classroom,
                'section_id'    => $Promotion->from_section,
                'academic_year' => $Promotion->academic_year,
            ]);

            Promotions::destroy($request->id);
            DB::commit();
            return redirect()->back();
        }
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
}
