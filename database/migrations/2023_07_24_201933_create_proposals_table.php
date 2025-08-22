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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('shpfile_src');
            $table->integer('idd');
            // step 1: choose region from land access map
            $table->string('step1_skemaps');
            $table->timestamp('step1_completed');
            // step 2: fill in the questionnaire
            $table->string('step2_answers')->nullable();
            $table->string('step2_skemaps')->nullable();
            $table->timestamp('step2_completed')->nullable();
            // step 3: fill in the AHP, via FGD process
            $table->string('step3_ahpcriteria')->nullable();
            $table->string('step3_ahpcomparison')->nullable();
            $table->string('step3_ahpweight')->nullable();
            $table->string('step3_skemaps')->nullable();
            $table->timestamp('step3_completed')->nullable();
            // the result
            $table->string('result_skemaps')->nullable();
            $table->timestamp('result_completed')->nullable();
            $table->enum('status', ['completed','onprocess','cancelled']);
            $table->string('created_by');
            $table->string('modified_by');
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
        Schema::dropIfExists('proposals');
    }
};
