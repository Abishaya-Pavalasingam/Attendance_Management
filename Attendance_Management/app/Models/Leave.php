<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class, 'stu_id');
    }
}
