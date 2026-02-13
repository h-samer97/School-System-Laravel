<?php

namespace App\Repository;

use App\Models\Exam;
use Exception;

class ExamRepository implements IExam {


        public function index() {
            $exams = Exam::all();
            return view('Exams.index', compact('exams'));
        }

        public function create() {
            return view('Exams.create');
        }

        public function store($request)
        {
            try {

                $exams = new Exam();
                $exams->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                $exams->term = $request->term;
                $exams->academic_year = $request->academic_year;
                $exams->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Exams.create');

            } catch (Exception $error) {
                
                return redirect()->back()->with(['error' => $error->getMessage()]);

            }
        }

        public function edit($id) {

            $exam = Exam::findOrFail($id)->get();
            return view('Exams.edit', compact('exam'));

        }

        public function update($request) {

            try {

                $exam = Exam::findorFail($request->id);
                $exam->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                $exam->term = $request->term;
                $exam->academic_year = $request->academic_year;
                $exam->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->route('Exams.index');

            } catch (Exception $error) {

                return redirect()->back()->with(['error' => $error->getMessage()]);

            }

        }

        public function destroy($request)
        {
            try {

                Exam::destroy($request->id);
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            } catch (Exception $error) {

                return redirect()->back()->withErrors(['error' => $error->getMessage()]);

            }
        }



}