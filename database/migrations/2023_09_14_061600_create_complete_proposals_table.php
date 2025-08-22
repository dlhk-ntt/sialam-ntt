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
        Schema::create('complete_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('shpfile_src');
            $table->integer('idd');
            $table->string('skemaps');
            $table->timestamp('completed');
            $table->boolean('process_to_moodle')->default(false);
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
        Schema::dropIfExists('complete_proposals');
    }
};
