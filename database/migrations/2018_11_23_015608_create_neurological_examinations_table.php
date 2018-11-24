<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeurologicalExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neurological_examinations', function (Blueprint $table) {
            $table->increments('id');
            $table->longText("mental_examination")->nullable();
            $table->integer("orientation_id")->unsigned()->index()->nullable();
            $table->longText("language")->nullable();
            $table->longText("memory")->nullable();
            $table->integer("superior_cognitive_functions_id")->unsigned()->index()->nullable();
            $table->longText("hallucinations")->nullable();
            $table->longText("delusions")->nullable();
            $table->longText("esape")->nullable();
            $table->longText("cranial_nerves")->nullable();
            $table->longText("actor_system")->nullable();
            $table->longText("sensitive_system")->nullable();
            $table->longText("vestibular_system")->nullable();
            $table->longText("meninges")->nullable();
            $table->integer("physical_exploration_id")->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('orientation_id')->references('id')->on('orientations');
            $table->foreign('superior_cognitive_functions_id')->references('id')->on('superior_cognitive_functions');
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
        Schema::dropIfExists('neurological_examinations');
    }
}
