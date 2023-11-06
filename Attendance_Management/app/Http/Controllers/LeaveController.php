<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Student;
use App\Models\Overtime;
use App\Models\FingerDevices;
use App\Helpers\FingerHelper;
use App\Models\Leave;
use App\Http\Requests\AttendanceStu;
use Illuminate\Support\Facades\Hash;

class LeaveController extends Controller
{
    public function index()
    {
        return view('admin.leave')->with(['leaves' => Leave::all()]);
    }

    public function indexOvertime()
    {
        return view('admin.overtime')->with(['overtimes' => Overtime::all()]);
    }

    public static function overTimeDevice($att_dateTime, Student $student)
    {
        
            $attendance_time =new DateTime($att_dateTime);
            $checkout = new DateTime($student->schedules->first()->time_out);
            $difference = $checkout->diff($attendance_time)->format('%H:%I:%S');

            $overtime = new Overtime();
            $overtime->stu_id = $student->id;
            $overtime->duration = $difference;
            $overtime->overtime_date = date('Y-m-d', strtotime($att_dateTime));
            $overtime->save();
        
    }
}
