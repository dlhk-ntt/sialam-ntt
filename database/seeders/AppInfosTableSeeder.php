<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppInfosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('app_infos')->delete();
        
        DB::table('app_infos')->insert(array (
            0 => 
            array (
                'code' => 'SeLa',
                'name' => 'Sistem Informasi Akses Lahan',
                'description' => 'Sistem Informasi Akses Lahan',
                'logo' => '',
                'phone' => '',
                'whatsapp' => NULL,
                'email' => NULL,
                'instagram' => NULL,
                'facebook' => NULL,
                'twitter' => NULL,
                'youtube' => NULL,
                'tiktok' => NULL,
                'guide_mp4' => '',
                'guide_pdf' => '',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
        ));
        
        
    }
}