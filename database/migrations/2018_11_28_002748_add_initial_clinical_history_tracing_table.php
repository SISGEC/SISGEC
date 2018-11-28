<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInitialClinicalHistoryTracingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_clinical_history_tracing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tracing_id')->unsigned()->index()->nullable();
            $table->integer('initial_clinical_history_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('initial_clinical_history_tracing');
    }
}
