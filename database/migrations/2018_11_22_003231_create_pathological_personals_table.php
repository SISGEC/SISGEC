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
            $table->string('childhood_diseases')->nullable();
            $table->string('surgical_operations')->nullable();
            $table->string('accidents')->nullable();
            $table->string('traumatic_brain_injury')->nullable();
            $table->string('allergies')->nullable();
            $table->string('disabilities')->nullable();
            $table->string('blood_transfusions')->nullable();

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
