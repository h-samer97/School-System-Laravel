<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index() {
       
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view("classroom.my_classroom", compact("My_Classes", "Grades"));

    }
}
