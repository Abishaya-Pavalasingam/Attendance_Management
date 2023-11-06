<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
