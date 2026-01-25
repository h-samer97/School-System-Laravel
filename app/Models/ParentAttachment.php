<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ParentAttachment extends Model
{
    // use HasTranslations;
    // protected $translatable = ['file_name', 'parent_id'];

    protected $table = 'parent_attachments';
    protected $guarded = [];

}
