<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	public function up()
{
    Schema::create('grades', function(Blueprint $table) {
        $table->id();
        $table->string('Name');
        $table->longText('Notes')->nullable();
        $table->timestamps();
    });
}

	public function down()
	{
		Schema::drop('Grades');
	}
}