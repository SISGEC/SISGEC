<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrientationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time');
            $table->string('space');
            $table->string('person');
            $table->integer("physical_exploration_id")->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('physical_exploration_id')->references('id')->on('physical_explorations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orientations');
    }
}
