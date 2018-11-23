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
            $table->longText("mental_examination");
            $table->integer("orientation_id")->unsigned()->index()->nullable();
            $table->longText("language");
            $table->longText("memory");
            $table->integer("superior_cognitive_functions_id")->unsigned()->index()->nullable();
            $table->longText("hallucinations");
            $table->longText("delusions");
            $table->longText("esape");
            $table->longText("cranial_nerves");
            $table->longText("actor_system");
            $table->longText("sensitive_system");
            $table->longText("vestibular_system");
            $table->longText("meninges");
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
