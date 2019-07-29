<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuicidalRiskColumnOnPathologicalPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pathological_personals', function (Blueprint $table) {
            $table->string('suicidal_risk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pathological_personals', function (Blueprint $table) {
            $table->dropColumn('suicidal_risk');
        });
    }
}
