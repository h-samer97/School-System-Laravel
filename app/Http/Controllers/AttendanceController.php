<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\IAttendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    protected IAttendance $Attendance;

    public function __construct(IAttendance $Attendance)
    {
        $this->Attendance = $Attendance;
    }


    public function index()
    {
        return $this->Attendance->index();
    }



    public function store(Request $request)
    {
        return $this->Attendance->store($request);
    }


    public function show($id)
    {
        return $this->Attendance->show($id);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}