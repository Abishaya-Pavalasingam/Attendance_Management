<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id');
    }
}
