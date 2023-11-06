<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Student;
use App\Models\Latetime;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AttendanceEmp;

class AttendanceController extends Controller
{   
    //show attendance 
    public function index()
    {  
        return view('admin.attendance')->with(['attendances' => Attendance::all()]);
    }

    //show late times
    public function indexLatetime()
    {
        return view('admin.latetime')->with(['latetimes' => Latetime::all()]);
    }

    public static function lateTimeDevice($att_dateTime, Student $student)
    {
        $attendance_time = new DateTime($att_dateTime);
        $checkin = new DateTime($student->schedules->first()->time_in);
        $difference = $checkin->diff($attendance_time)->format('%H:%I:%S');

        $latetime = new Latetime();
        $latetime->emp_id = $student->id;
        $latetime->duration = $difference;
        $latetime->latetime_date = date('Y-m-d', strtotime($att_dateTime));
        $latetime->save();
    }
  
}
