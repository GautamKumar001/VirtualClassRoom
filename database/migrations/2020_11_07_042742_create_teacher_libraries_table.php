<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('book_pdf');
            $table->string('book_image');
            $table->string('notes_name');
            $table->string('notes_pdf');
            $table->string('notes_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_libraries');
    }
}
