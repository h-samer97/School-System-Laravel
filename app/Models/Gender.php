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
    
}
