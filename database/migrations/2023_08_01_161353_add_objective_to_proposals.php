<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->text('step3_ahpobjective')->nullable();
            $table->string('step3_ahpweightcriteriagoal')->nullable();
            $table->string('step3_ahpweightalternativecriteria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('step3_ahpobjective');
            $table->dropColumn('step3_ahpweightcriteriagoal');
            $table->dropColumn('step3_ahpweightalternativecriteria');
        });
    }
};
