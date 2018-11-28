<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("date");
            $table->longText("prescription");
            $table->integer('initial_clinical_history_id')->unsigned()->index()->nullable();
            $table->integer('measure_id')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('initial_clinical_history_id')->references('id')->on('initial_clinical_history');
            $table->foreign('measure_id')->references('id')->on('measures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
