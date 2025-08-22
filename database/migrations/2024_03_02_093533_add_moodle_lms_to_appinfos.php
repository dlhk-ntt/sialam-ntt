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
        Schema::table('app_infos', function (Blueprint $table) {
            $table->string('moodle_url')->nullable();
            $table->string('moodle_token')->nullable();
            $table->date('moodle_token_expired')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_infos', function (Blueprint $table) {
            $table->dropColumn('moodle_token_expired');
            $table->dropColumn('moodle_token');
            $table->dropColumn('moodle_url');
        });
    }
};
