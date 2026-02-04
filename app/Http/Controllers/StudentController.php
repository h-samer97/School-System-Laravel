<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudent;
use App\Repository\IStudent;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class StudentController extends Controller
{


    protected IStudent $student;

    public function __construct(IStudent $student) {
        $this->student = $student;
    }

    public function index() {
        $students = $this->student->Get_Student();
        return view('students.index', compact('students'));
    }
    // Page Edit Student :)

    public function edit($id) {
        return $this->student->Edit_Student($id);
    }
    // Update Form
    public function update(StoreStudent $request) {

        $this->student->Update_Student($request);

    }

    public function destroy($id) {
        $this->student->Delete_Student($id);
    }

    public function create() {
        return $this->student->Create_Student();
    }
    public function store (StoreStudent $request) {
        return $this->student->Store_Student($request);
    }
    public function show($id) {
        return $this->student->Show_Student($id);
    }

    public function Get_classrooms($id) {

        return $this->student->Get_classrooms($id);

    }
    public function Get_Sections($id) {
        return $this->student->Get_Sections($id);
    }
    public function Upload_attachment(Request $request) {
        return $this->student->Upload_attachment($request);
    }
    public function Download_attachment($studentsname,$filename)
    {
        return $this->student->Download_attachment($studentsname,$filename);
    }

    
    
}
