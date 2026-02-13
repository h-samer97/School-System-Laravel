<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\ExamRepositoryInterface;
use App\Repository\IExam;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    protected IExam $Exam;

    public function __construct(IExam $Exam)
    {
        $this->Exam =$Exam;
    }

    public function index()
    {
        return $this->Exam->index();
    }

    public function create()
    {
        return $this->Exam->create();
    }


    public function store(Request $request)
    {
        return $this->Exam->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->Exam->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Exam->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Exam->destroy($request);
    }
}