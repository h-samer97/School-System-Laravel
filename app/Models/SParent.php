<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;


class SParent extends Model
{
    use HasTranslations, Notifiable;

    public $translatable = ['name_Father', 'job_father', 'name_mother', 'job_mother'];
    
    protected $table = 's_parent';
    
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}