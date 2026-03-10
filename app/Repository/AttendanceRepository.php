<?php



namespace App\Repository;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teachers;

class AttendanceRepository implements IAttendance {
    public function index()
    {
        $Grades         = Grade::with(['Sections'])->get();
        $list_Grades    = Grade::all();
        $teachers       = Teachers::all();
        $students       = Student::all();
        // return dd()
        return view('Attendance.Sections',compact('Grades','list_Grades','teachers', 'students'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return view('Attendance.index',compact('students'));
    }

    public function store($request)
    {
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if( $attendence == 'presence' ) {
                    $attendence_status = true;
                } else if( $attendence == 'absent' ){
                    $attendence_status = false;
                }

                Attendance::create([
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> Teachers::first()->id ?? 2, # تجريبي
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status
                ]);

            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

       public function update($request)
        {
            try {
                if (!isset($request->attendences) || !is_array($request->attendences)) {
                    toastr()->error('لا توجد بيانات لتحديثها');
                    return redirect()->back();
                }

                foreach ($request->attendences as $studentid => $attendence) {

                    $status = ($attendence == 'presence');

                    Attendance::updateOrCreate(
                        [
                            'student_id'      => $studentid,
                            'attendence_date' => date('Y-m-d'),
                        ],
                        [
                            'grade_id'         => $request->grade_id,
                            'classroom_id'     => $request->classroom_id,
                            'section_id'       => $request->section_id,
                            'teacher_id'       => Teachers::first()->id ?? 2, # تجريبي
                            'attendence_status'=> $status,
                        ]
                    );
                }

                toastr()->success(trans('messages.Update'));
                return redirect()->back();

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }


    public function destroy($request)
    {
        try {
            Attendance::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}