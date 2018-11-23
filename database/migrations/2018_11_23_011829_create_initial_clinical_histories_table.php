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
            $table->longText('current_condition');
            $table->integer('physical_exploration_id')->unsigned()->index()->nullable();
            $table->longText('diagnostical_impression');
            $table->longText('treatment_plan');
            $table->longText('interconsultation');
            $table->longText('treatment');
            $table->timestamps();

            $table->foreign('anamnesis_id')->references('id')->on('anamnesis');
            $table->foreign('physical_exploration_id')->references('id')->on('physical_explorations');
            $table->foreign('patient_id')->references('id')->on('patient');
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
