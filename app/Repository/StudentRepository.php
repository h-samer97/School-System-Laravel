<?php

    namespace App\Repository;

    use App\Models\Classroom;
    use App\Models\Gender;
    use App\Models\Grade;
    use App\Models\Image;
    use App\Models\Nationalities;
    use App\Models\Section;
    use App\Models\SParent;
    use App\Models\Student;
    use App\Models\TypeBlood;
    use DB;
    use Dom\ParentNode;
    use Flasher\Prime\Storage\Storage;
    use Hash;
    use Request;



    class StudentRepository implements IStudent {


        public function Get_Student() {

            $students = Student::all();
            return $students;

        }

        public function Delete_Student($id) {

            Student::findOrFail($id)->delete();


            toastr()->success(trans('Students_trans.delete'));
            return redirect()->route('students.index');


        }

        public function Update_Student($request) {

            // $validate = $request->validate();

             try {
                    $Edit_Students = Student::findorfail($request->id);
                    $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
                    $Edit_Students->email = $request->email;

                    if(!empty($Edit_Students->password)) {
                        $Edit_Students->password = Hash::make($request->password);
                    }

                    $Edit_Students->gender_id = $request->gender_id;
                    $Edit_Students->nationalitie_id = $request->nationalitie_id;
                    $Edit_Students->blood_id = $request->blood_id;
                    $Edit_Students->date_Birth = $request->Date_Birth;
                    $Edit_Students->grade_id = $request->Grade_id;
                    $Edit_Students->classroom_id = $request->Classroom_id;
                    $Edit_Students->section_id = $request->section_id;
                    $Edit_Students->parent_id = $request->parent_id;
                    $Edit_Students->academic_year = $request->academic_year;
                    $Edit_Students->save();
                    toastr()->success(trans('messages.Update'));
                    return redirect()->route('students.index');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

        }

        public function Download_attachment($studentsname, $filename) {
             return response()->download(public_path('attachments/students/'.$studentsname.'/'.$filename));
        }

        public function Delete_attachment($request)
    {
        // Delete img in server disk
        \Illuminate\Support\Facades\Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        Image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Students.show',$request->student_id);
    }



        public function Upload_attachment($request) {

            foreach($request->file('photos') as $file) {

                $fileName = $file->getClientOriginalName();

                $file->storeAs('app\students_attachments' .$request->student_name, $fileName, 'students_attachments');

                $Image = new Image();
                $Image->filename = $fileName;
                $Image->imageable_id = $request->student_id;

                $Image->imageable_type = 'App\Models\Student';
                $Image->save();

            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('students.show',$request->student_id);

        }

        public function Edit_Student($id) {

            $Students = Student::findOrFail($id);
            $data = [];

            $data['Grades']     = Grade::all();
            $data['Genders']    = Gender::all();
            $data['parents']    = SParent::all();
            $data['nationals']  = Nationalities::all();
            $data['bloods']     = TypeBlood::all();

            return view('students.edit', compact('Students', 'data'));

        }

        public function Create_Student() {

            $data = [];

            $data['my_classes'] = Grade::all();
            $data['parents'] = SParent::all();
            $data['Genders'] = Gender::all();
            $data['nationals'] = Nationalities::all();
            $data['bloods'] = TypeBlood::all();

            return view('students.add', $data);


        }
        public function Get_classrooms($id) {

             $list_classes = Classroom::where("grade_id", $id)->pluck("name_class", "id");
            return response()->json($list_classes);

        }

        public function Get_Sections($id) {

            $list_sections = Section::where("class_id", $id)->pluck("name_section", "id");
            return $list_sections;

        }

        public function Store_Student($request) {
            
        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name             = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email            = $request->email;
            $students->password         = Hash::make($request->password);
            $students->gender_id        = $request->gender_id;
            $students->nationalitie_id  = $request->nationalitie_id;
            $students->blood_id         = $request->blood_id;
            $students->date_Birth       = $request->Date_Birth;
            $students->grade_id         = $request->Grade_id;
            $students->classroom_id     = $request->Classroom_id;
            $students->section_id       = $request->section_id;
            $students->parent_id        = $request->parent_id;
            $students->academic_year    = $request->academic_year;
            $students->save();

            // insert img
            

            if($request->hasfile('photos')) {

                foreach($request['photos'] as $photo) {

                    $nameFile = $photo->getClientOriginalName();

                    $photo->storeAs('attachments/students/', $nameFile, 'students_attachments');

                    $Image = new Image();
                    $Image->filename = $nameFile;
                    $Image->imageable_id= $students->id;
                    $Image->imageable_type = 'App\Model\Student';
                    $Image->save();

                } 

            }



            DB::commit(); // insert data
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');

        }

        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        }

        public function Show_Student($id) {

            $Student = Student::findOrFail($id);
            return view('students.show', compact('Student'));

        }


    }








?>