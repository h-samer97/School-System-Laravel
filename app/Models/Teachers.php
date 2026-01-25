<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Teachers extends Model
{
    use HasTranslations;

    protected $translatable = ['name'];
    protected $guarded = [];

    public function specializations() {
        return $this->belongsTo('App\Models\Specialization', 'specialization_id');
    }

    public function genders() {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function Sections() {
        return $this->belongsToMany(Section::class, 'teacher__sections');
    }
}
