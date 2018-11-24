<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrientationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time')->nullable();
            $table->string('space')->nullable();
            $table->string('person')->nullable();
            $table->integer("neurological_examination_id")->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('neurological_examination_id')->references('id')->on('neurological_examinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orientations');
    }
}
