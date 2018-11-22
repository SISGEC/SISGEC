<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePathologicalPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathological_personals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('childhood_diseases');
            $table->string('surgical_operations');
            $table->string('accidents');
            $table->string('traumatic_brain_injury');
            $table->string('allergies');
            $table->string('disabilities');
            $table->string('blood_transfusions');

            $table->integer('anamnesis_id')->unsigned()->index()->nullable();
            $table->foreign('anamnesis_id')->references('id')->on('anamnesis');
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
        Schema::dropIfExists('pathological_personals');
    }
}
