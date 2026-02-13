<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasTranslations;
    use SoftDeletes;
    protected $translatable = ['name'];
    protected $guarded = [];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'id');
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
