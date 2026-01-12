<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;
    protected $translatable = ['name_class'];

    protected $table = 'classrooms';
    public $timestamps = true;

    protected $fillable = ['name_class', 'grade_id'];

    public function Grades() {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

}
