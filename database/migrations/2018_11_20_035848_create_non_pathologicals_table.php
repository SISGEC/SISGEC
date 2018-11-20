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
            $table->longText("living_place");
            $table->longText("personal_hygiene");
            $table->longText("sport_activities");
            $table->longText("hobbies");
            $table->longText("immunizations");
            $table->longText("smoking");
            $table->longText("alcoholism");
            $table->longText("drug");
            $table->longText("work_activities");
            $table->longText("feeding");

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
