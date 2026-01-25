<?php

namespace App\Repository;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teachers;
use App\Repository\ITeacher;
use Exception;
use Hash;
use PDOException;





class TeacherRepository implements ITeacher {

    public function getAllTeachers() {
        return Teachers::all();
    }

    public function GetGender() {
        return Gender::all();
    }

    public function Getspecialization() {
        return Specialization::all();
    }

    public function StoreTeachers($request) {
        
        try {

            $Teachers = new Teachers();
            $Teachers->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->password = Hash::make($request->Password);
            $Teachers->email = $request->Email;
            $Teachers->joining_Date = $request->Joining_Date;
            $Teachers->gender_id = $request->Gender_id;
            $Teachers->specialization_id = $request->Specialization_id;
            $Teachers->address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.index');

        } catch(PDOException $error) {
            return redirect()->back()->with(['error' => $error->getMessage()]);
        }

    } 

    public function editTeachers($id) {

        return Teachers::findOrFail($id);

    }

    public function UpdateTeachers($request) {
             try {
            $Teachers = Teachers::findOrFail($request->id);
            $Teachers->email = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function DeleteTeachers($request) {

        try {

            Teachers::findOrFail($request->id)->delete();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('teachers.index');

        } catch (Exception $error) {

            return redirect()->back()->with(['error' => $error->getMessage()]);

        }

    }

} 














