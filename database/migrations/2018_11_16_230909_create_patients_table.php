<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("lastname");
            $table->string("nickname");
            $table->integer("sex");
            $table->string("birthdate");
            $table->string("scholarship");
            $table->string("occupation");
            $table->string("religion");
            $table->string("civil_status");
            $table->string("place_of_residence");
            $table->string("place_of_birth");
            //$table->string("photo");
            $table->string("referred_by")->nullable();
            $table->string("email");
            $table->string("rfc");
            $table->string("phone");
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
        Schema::dropIfExists('patients');
    }
}
