<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFees extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
