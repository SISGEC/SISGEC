<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperiorCognitiveFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superior_cognitive_functions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('abstract');
            $table->tinyInteger('concrete');
            $table->tinyInteger('literal');
            $table->tinyInteger('magical');
            $table->string('arithmetic_calculation');
            $table->string('ability_to_draw');
            $table->integer("neurological_examination_id")->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('neurological_examination_id')->references('id')->on('neurological_examinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superior_cognitive_functions');
    }
}
