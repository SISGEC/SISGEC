<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalExplorationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_explorations', function (Blueprint $table) {
            $table->increments('id');
            $table->longText("general_appearance")->nullable();
            $table->longText("head")->nullable();
            $table->longText("neck")->nullable();
            $table->longText("chest")->nullable();
            $table->longText("abdomen")->nullable();
            $table->longText("back")->nullable();
            $table->longText("extremities")->nullable();
            $table->longText("genitals")->nullable();
            $table->integer("neurological_examination_id")->unsigned()->index()->nullable();
            $table->integer('initial_clinical_history_id')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('neurological_examination_id')->references('id')->on('neurological_examinations');
            $table->foreign('initial_clinical_history_id')->references('id')->on('initial_clinical_history');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physical_explorations');
    }
}
