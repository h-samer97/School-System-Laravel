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

        // return dd($request->all());

        DB::beginTransaction();

        try {
            // 1. البحث عن الطلاب بناءً على المعايير المختارة
            $students = Student::where('grade_id', $request->Grade_id)
                ->where('classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', 'لا توجد بيانات طلاب مطابقة لهذه الاختيارات');
            }

            // 2. تحديث الطلاب وإنشاء سجل الترقية
            foreach ($students as $student) {
                
                // تحديث بيانات الطالب في جدول الطلاب
                Student::where('id', $student->id)->update([
                    'grade_id'      => $request->Grade_id_new,
                    'classroom_id'  => $request->Classroom_id_new,
                    'section_id'    => $request->section_id_new,
                    'academic_year' => $request->academic_year_new,
                ]);

                // إدخال أو تحديث سجل الترقية (الأرشيف)
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

            // التراجع عن الكل
            if($request->page_id ==1){

             $Promotions = Promotions::all();
             foreach ($Promotions as $Promotion){

                 //التحديث في جدول الطلاب
                 $ids = explode(',',$Promotion->student_id);
                 Student::whereIn('id', $ids)
                 ->update([
                 'Grade_id'=>$Promotion->from_grade,
                 'Classroom_id'=>$Promotion->from_Classroom,
                 'section_id'=> $Promotion->from_section,
                 'academic_year'=>$Promotion->academic_year,
               ]);

                 //حذف جدول الترقيات
                 Promotions::truncate();

             }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

            else{

                $Promotion = Promotions::findorfail($request->id);
                Student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'Classroom_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year,
                    ]);


                Promotions::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    }
