<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeachers;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Teachers;
use App\Repository\ITeacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepository;
use Livewire\Attributes\Validate;

class TeachersController extends Controller
{

    protected ITeacher $Teacher;

    public function __construct(ITeacher $teacher) {

        $this->Teacher = $teacher;

    }
   
    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('teacher.index',compact('Teachers'));
    }

   
    public function create()
    {
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();
        $Teachers = $this->Teacher->getAllTeachers();
        return view('teacher.create', compact('specializations','genders', 'Teachers'));
    }

   
    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }

   
    public function show(Teachers $teachers)
    {
        //
    }

    
    public function edit($id)
    {
        $Teachers =  $this->Teacher->editTeachers($id);
        $specializations = Specialization::all();
        $genders = Gender::all();
        $sections = Section::all();
        return view('teacher.edit', compact('Teachers', 'specializations', 'genders', 'sections'));
    }

    
    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

   
    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }
}
