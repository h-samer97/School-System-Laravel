<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{

    use HasTranslations;
    protected $table = 'Grades';
    public array $translatable = ['Name', 'Notes'];
    protected $fillable = ['Name', 'Notes'];
    public $timestamps = true;

}