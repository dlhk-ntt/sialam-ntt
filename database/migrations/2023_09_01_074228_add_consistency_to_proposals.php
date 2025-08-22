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
            $table->string('step3_ahpCRcriteria')->nullable();
            $table->string('step3_ahpCRalternative')->nullable();
            $table->boolean('step3_ahpisconsistent')->default(false);
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
            $table->dropColumn('step3_ahpCRcriteria');
            $table->dropColumn('step3_ahpCRalternative');
            $table->dropColumn('step3_ahpisconsistent');
        });
    }
};
