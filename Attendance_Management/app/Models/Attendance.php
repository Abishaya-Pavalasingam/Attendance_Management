<?php

namespace App\Models;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model

{

    protected $table = 'attendances';
    
    
    public function student()
    {
        return $this->belongsTo(Student::class,'stu_id');
    }
}
