<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name_section'];
    protected $fillable=['name_section','grade_id','class_id', 'status'];

    protected $table = 'sections';
    public $timestamps = true;


    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

    public function My_classs()
    {
        return $this->belongsTo(Classroom::class, 'id');
    }

    public function teachers()
{
    return $this->belongsToMany(
        Teachers::class,      // الموديل المرتبط
        'teacher__sections', // اسم الجدول الوسيط
        'section_id',        // المفتاح الأجنبي للموديل الحالي
        'teacher_id'         // المفتاح الأجنبي للموديل المرتبط (هذا هو سبب الخطأ)
    );
}

}
