<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'schedule_students', 'schedule_id', 'stu_id');
    }
}
