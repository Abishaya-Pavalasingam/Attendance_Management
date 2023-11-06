<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Check;
use App\Models\Leave;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AttendanceStu;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    
    public function check(AttendanceStu $request)
    {
        $request->validated();

        if ($student = Student::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $student->pin_code)) {




                if(null == Check::whereStu_id($student->id)->latest()->first()){
                    ApiController::newAttandance($student);
                }else{
                    
                    if(Check::whereStu_id($student->id)->latest()->first()->leave_time !== null){
                        ApiController::newAttandance($student);
                    } else {
                        $check = Check::whereStu_id($student->id)->latest()->first();
                        $check->leave_time = date("Y-m-d H:i:s");
                        $check->save();
                        return response()->json(['success' => 'Successful in assign the leave'], 200);
                    }

                }

            } else {
                return response()->json(['error' => 'Failed to assign the attendance'], 404);
            }
        }
        return response()->json(['success' => 'Successful in assign the attendance'], 200);
    }


    public function newAttandance($student){
        $check = new Check;
        $check->Stu_id = $student->id;
        $check->attendance_time = date("Y-m-d H:i:s");
        $check->leave_time = null;
        $check->save();
    }



    public function attendance(AttendanceStu $request)
    {
         $request->validated();

        if ($student = Student::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $student->pin_code)) {
                if (!Attendance::whereAttendance_date(date("Y-m-d"))->whereStu_id($student->id)->first()) {
                    $attendance = new Attendance;
                    $attendance->Stu_id = $student->id;
                    $attendance->attendance_time = date("H:i:s");
                    $attendance->attendance_date = date("Y-m-d");

                    if (!($student->schedules->first()->time_in >= $attendance->attendance_time)) {
                        $attendance->status = 0;
                        AttendanceController::lateTime($student);
                    };

                    $attendance->save();
                 } else {
                    return response()->json(['error' => 'you assigned your attendance before'], 404);
                }
            } else {
                return response()->json(['error' => 'Failed to assign the attendance'], 404);
            }
        }
        return response()->json(['success' => 'Successful in assign the attendance'], 200);

    }



    public function leave(AttendanceStu $request)
    {
        $request->validated();

        if ($student = Student::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $student->pin_code)) {
                if (!Leave::whereLeave_date(date("Y-m-d"))->whereStu_id($student->id)->first()) {
                    $leave = new Leave;
                    $leave->stu_id = $student->id;
                    $leave->leave_time = date("H:i:s");
                    $leave->leave_date = date("Y-m-d");
                    // ontime + overtime if true , else "early go" ....
                    if ($leave->leave_time >= $student->schedules->first()->time_out) {
                        leaveController::overTime($student);
                    } else {
                        $leave->status = 0;
                    }

                    $leave->save();
                } else {
                    return response()->json(['error' => 'you assigned your leave before'], 404);
                }
            } else {
                return response()->json(['error' => 'Failed to assign the leave'], 404);
            }
        }

        return response()->json(['success' => 'Successful in assign the leave'], 200);
    }

}
