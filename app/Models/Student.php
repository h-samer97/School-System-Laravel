<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'students';
    protected $translatable = ['name'];
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function nationality() {
        return $this->belongsTo(Nationalities::class, 'nationalitie_id');
    }
    
    public function myparent() {
        return $this->belongsTo(SParent::class, 'parent_id');
    }

    public function images () {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function student_account()
    {
        return $this->hasMany(StudentsAccounts::class, 'student_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}