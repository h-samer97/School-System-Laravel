<?php

namespace App\Http\Controllers;


use App\Repository\IStudentGraduated;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{


    protected IStudentGraduated $student;

    public function __construct(IStudentGraduated $student) {
        $this->student = $student;
    }
    
    public function index()
    {
       return $this->student->index();
    }

   
    public function create()
    {
       return $this->student->create();
    }

    
    public function store(Request $request)
    {
        $this->student->softDelete($request);
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
