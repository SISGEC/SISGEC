<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationFromPrescriptionsToIch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('initial_clinical_history', function (Blueprint $table) {
            $table->integer('prescription_id')->unsigned()->index()->nullable();
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initial_clinical_history', function (Blueprint $table) {
            $table->dropColumn('prescription_id');
        });
    }
}
