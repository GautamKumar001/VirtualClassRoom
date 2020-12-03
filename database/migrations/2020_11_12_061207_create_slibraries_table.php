<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slibraries', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('Bimage')->nullable();
            $table->string('Bpdf')->nullable();
            $table->string('Bname')->nullable();
            $table->string('Nimage')->nullable();
            $table->string('Npdf')->nullable();
            $table->string('Nname')->nullable();
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
        Schema::dropIfExists('slibraries');
    }
}
