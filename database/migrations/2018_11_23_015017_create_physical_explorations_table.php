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
            $table->longText("general_appearance");
            $table->longText("head");
            $table->longText("neck");
            $table->longText("chest");
            $table->longText("abdomen");
            $table->longText("back");
            $table->longText("extremities");
            $table->longText("genitals");
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
