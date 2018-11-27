<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialClinicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_clinical_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anamnesis_id')->unsigned()->index()->nullable();
            $table->integer('patient_id')->unsigned()->index()->nullable();
            $table->longText('current_condition')->nullable();
            $table->integer('physical_exploration_id')->unsigned()->index()->nullable();
            $table->longText('diagnostical_impression')->nullable();
            $table->longText('treatment_plan')->nullable();
            $table->longText('interconsultation')->nullable();
            $table->longText('treatment')->nullable();
            $table->integer('tracing_id')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('anamnesis_id')->references('id')->on('anamnesis');
            $table->foreign('physical_exploration_id')->references('id')->on('physical_explorations');
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('tracing_id')->references('id')->on('tracings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('initial_clinical_history');
    }
}
