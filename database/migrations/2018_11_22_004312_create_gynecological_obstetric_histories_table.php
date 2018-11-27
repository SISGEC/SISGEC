<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGynecologicalObstetricHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gynecological_obstetric_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ivsa')->nullable();
            $table->string('menarca')->nullable();
            $table->string('fur')->nullable();
            $table->string('came')->nullable();
            $table->string('pregnancies_number')->nullable();
            $table->string('births_number')->nullable();
            $table->string('abortions_number')->nullable();
            $table->string('ets')->nullable();
            $table->string('cesareans_number')->nullable();
            $table->string('uma')->nullable();
            $table->string('other_gyneco_info')->nullable();
            $table->string('last_papanicolaou_date')->nullable();
            $table->string('last_mammogram_date')->nullable();

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
        Schema::dropIfExists('gynecological_obstetric_histories');
    }
}
