<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE users DROP CONSTRAINT users_role_check");
        $types = ['superadmin','admin','moodle_user','editor','visitor'];
        $result = join( ', ', array_map(function( $value ){ return sprintf("'%s'::character varying", $value); }, $types) );
        DB::statement("ALTER TABLE users add CONSTRAINT users_role_check CHECK (role::text = ANY (ARRAY[$result]::text[]))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE users DROP CONSTRAINT users_role_check");
        $types = ['admin','moodle_user','editor','visitor'];
        $result = join( ', ', array_map(function( $value ){ return sprintf("'%s'::character varying", $value); }, $types) );
        DB::statement("ALTER TABLE users add CONSTRAINT users_role_check CHECK (role::text = ANY (ARRAY[$result]::text[]))");
    }
};
