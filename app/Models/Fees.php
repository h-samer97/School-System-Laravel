<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fees extends Model
{
    use HasTranslations;
    protected $translatable = ['title'];

    protected $guarded = [];


    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

     public function classroom() {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section() {
        return $this->belongsTo(Section::class, '');
    }



}
