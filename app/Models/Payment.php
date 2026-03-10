<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    protected $table   = 'payment_students'; 

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
