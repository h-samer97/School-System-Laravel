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
        Schema::create('parent_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->unique();
            $table->bigInteger('parent_id')->unsigned();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('s_parent')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_attachments');
    }
};
