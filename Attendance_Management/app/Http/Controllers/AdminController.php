<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Latetime;
use App\Models\Attendance;


class AdminController extends Controller
{

 
    public function index()
    {
        //Dashboard statistics 
        $totalStu =  count(Student::all());
        $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
        $ontimeStu = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
        $latetimeStu = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());
            
        if($AllAttendance > 0){
                $percentageOntime = str_split(($ontimeStu/ $AllAttendance)*100, 4)[0];
            }else {
                $percentageOntime = 0 ;
            }
        
        $data = [$totalStu, $ontimeStu, $latetimeStu, $percentageOntime];
        
        return view('admin.index')->with(['data' => $data]);
    }

}
