<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Notifications\Notifiable;

class Teachers extends Model
{
    use HasTranslations, Notifiable;

    protected $table = 'teachers';
    protected $translatable = ['name'];
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function specializations() {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function genders() {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function Sections() {
        return $this->belongsToMany(Section::class, 'teacher__sections', 'teacher_id', 'section_id');
    }
}