<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measures', function (Blueprint $table) {
            $table->increments('id');
            $table->string("weight");
            $table->string("height");
            $table->string("temperature");
            $table->string("heart_rate");
            $table->string("blood_pressure");
            $table->string("breathing_frequency");
            $table->integer("patient_id")->unsigned()->index()->nullable();
            $table->integer("tracing_id")->unsigned()->index()->nullable();

            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('tracing_id')->references('id')->on('tracings');
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
        Schema::dropIfExists('measures');
    }
}
