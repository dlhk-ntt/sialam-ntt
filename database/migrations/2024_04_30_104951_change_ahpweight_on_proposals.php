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
            $table->text('step3_ahpcriteria')->change();
            $table->longText('step3_ahpcomparison')->change();
            $table->longText('step3_ahpweight')->change();
            $table->longText('step3_ahpweightalternativecriteria')->change();
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
            $table->string('step3_ahpcriteria')->change();
            $table->string('step3_ahpcomparison')->change();
            $table->string('step3_ahpweight')->change();
            $table->string('step3_ahpweightalternativecriteria')->change();
        });
    }
};
