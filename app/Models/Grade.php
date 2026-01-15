<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{

    use HasTranslations;
    protected $table = 'Grades';
    public array $translatable = ['Name', 'Notes'];
    protected $fillable = ['Name', 'Notes'];
    public $timestamps = true;

    public function Sections() {
        return $this->hasMany('App\Models\Section', 'grade_id');
    }

}