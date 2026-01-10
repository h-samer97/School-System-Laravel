<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('classrooms', function (Blueprint $table) {
        $table->increments('id'); // المفتاح الأساسي للصف
        $table->unsignedInteger('grade_id'); // المفتاح الأجنبي
        $table->string('name_class');
        $table->timestamps();

        $table->foreign('grade_id')
              ->references('id')
              ->on('grades')
              ->onDelete('cascade')
              ->onUpdate('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
