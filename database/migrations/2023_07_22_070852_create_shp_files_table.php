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
        Schema::create('shp_files', function (Blueprint $table) {
            $table->id();
            $table->string('shp_filename');
            $table->string('table_name');
            $table->text('available_fields');
            $table->text('selected_fields')->nullable();
            $table->enum('source', ['upload','merge']);
            $table->enum('is_shown', ['yes', 'no']);
            $table->enum('is_regional', ['yes', 'no']);
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
        Schema::dropIfExists('shp_files');
    }
};
