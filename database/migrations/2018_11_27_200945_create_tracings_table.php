<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracings', function (Blueprint $table) {
            $table->increments('id');
            $table->longText("medication")->nullable();
            $table->longText("treatment_response")->nullable();
            $table->longText("physical_exploration")->nullable();
            $table->longText("diagnostic")->nullable();
            $table->longText("treatment_plan_sub")->nullable();
            $table->string("next_appointment_date")->nullable();

            $table->integer("measure_id")->unsigned()->index()->nullable();
            $table->foreign('measure_id')->references('id')->on('measures');
            $table->integer("initial_clinical_history_id")->unsigned()->index()->nullable();
            $table->foreign('initial_clinical_history_id')->references('id')->on('initial_clinical_history');
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
        Schema::dropIfExists('tracings');
    }
}
