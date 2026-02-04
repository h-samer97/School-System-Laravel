<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use DB;

class Gender extends Model
{
    use HasTranslations;

    protected $translatable = ['name'];
    protected $fillable = ['name'];

    public function gender() {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function classrooms() {
        return $this->belongsTo(Classroom::class, 'gender_id');
    }
    
}
