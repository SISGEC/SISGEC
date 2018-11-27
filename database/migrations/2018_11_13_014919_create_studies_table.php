<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('filename');
            $table->text('original_name');
            $table->text('type');
            $table->integer('initial_clinical_history_id')->unsigned()->index()->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('studies');
    }
}
