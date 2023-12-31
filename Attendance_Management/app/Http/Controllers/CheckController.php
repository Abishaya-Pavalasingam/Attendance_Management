<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Leave;

class CheckController extends Controller
{
    public function index()
    {
        return view('admin.check')->with(['Students' => Student::all()]);
    }

    public function CheckStore(Request $request)
    {
        if (isset($request->attd)) {
            foreach ($request->attd as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($student = Student::whereId(request('emp_id'))->first()) {
                        if (
                            !Attendance::whereAttendance_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(0)
                                ->first()
                        ) {
                            $data = new Attendance();
                            
                            $data->emp_id = $key;
                            $stu_req = Student::whereId($data->emp_id)->first();
                            $data->attendance_time = date('H:i:s', strtotime($stu_req->schedules->first()->time_in));
                            $data->attendance_date = $keys;
                            
                            $data->save();
                        }
                    }
                }
            }
        }
        if (isset($request->leave)) {
            foreach ($request->leave as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($student = Student::whereId(request('emp_id'))->first()) {
                        if (
                            !Leave::whereLeave_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(1)
                                ->first()
                        ) {
                            $data = new Leave();
                            $data->emp_id = $key;
                            $stu_req = Student::whereId($data->emp_id)->first();
                            $data->leave_time = $stu_req->schedules->first()->time_out;
                            $data->leave_date = $keys;
                            // if ($student->schedules->first()->time_out <= $data->leave_time) {
                            //     $data->status = 1;
                                
                            // }
                            // 
                            $data->save();
                        }
                    }
                }
            }
        }
        flash()->success('Success', 'You have successfully submited the attendance !');
        return back();
    }
    public function sheetReport()
    {

    return view('admin.sheet-report')->with(['Students' => Student::all()]);
    }
}
