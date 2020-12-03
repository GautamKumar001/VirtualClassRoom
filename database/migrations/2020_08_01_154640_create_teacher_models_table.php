<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->integer('age');
            $table->string('institute');
            $table->string('Identity');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_models');
    }
}
