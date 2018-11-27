<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonPathologicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_pathologicals', function (Blueprint $table) {
            $table->increments('id');
            $table->longText("living_place")->nullable();
            $table->longText("personal_hygiene")->nullable();
            $table->longText("sport_activities")->nullable();
            $table->longText("hobbies")->nullable();
            $table->longText("immunizations")->nullable();
            $table->longText("smoking")->nullable();
            $table->longText("alcoholism")->nullable();
            $table->longText("drug")->nullable();
            $table->longText("work_activities")->nullable();
            $table->longText("feeding")->nullable();

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
        Schema::dropIfExists('non_pathologicals');
    }
}
