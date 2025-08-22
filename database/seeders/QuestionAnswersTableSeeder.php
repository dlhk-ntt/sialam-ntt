<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionAnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('question_answers')->delete();
        
        DB::table('question_answers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question_id' => 1,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            1 => 
            array (
                'id' => 2,
                'question_id' => 2,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            2 => 
            array (
                'id' => 3,
                'question_id' => 2,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            3 => 
            array (
                'id' => 4,
                'question_id' => 3,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            4 => 
            array (
                'id' => 5,
                'question_id' => 4,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            5 => 
            array (
                'id' => 6,
                'question_id' => 5,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            6 => 
            array (
                'id' => 7,
                'question_id' => 6,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            7 => 
            array (
                'id' => 8,
                'question_id' => 7,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            8 => 
            array (
                'id' => 9,
                'question_id' => 7,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            9 => 
            array (
                'id' => 10,
                'question_id' => 8,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            10 => 
            array (
                'id' => 11,
                'question_id' => 9,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            11 => 
            array (
                'id' => 12,
                'question_id' => 9,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            12 => 
            array (
                'id' => 13,
                'question_id' => 9,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            13 => 
            array (
                'id' => 14,
                'question_id' => 10,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            14 => 
            array (
                'id' => 15,
                'question_id' => 10,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            15 => 
            array (
                'id' => 16,
                'question_id' => 10,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            16 => 
            array (
                'id' => 17,
                'question_id' => 11,
                'skema_ps' => 'HA',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            17 => 
            array (
                'id' => 18,
                'question_id' => 12,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            18 => 
            array (
                'id' => 19,
                'question_id' => 13,
                'skema_ps' => 'HA',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            19 => 
            array (
                'id' => 20,
                'question_id' => 14,
                'skema_ps' => 'HD',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            20 => 
            array (
                'id' => 21,
                'question_id' => 14,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            21 => 
            array (
                'id' => 22,
                'question_id' => 14,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            22 => 
            array (
                'id' => 23,
                'question_id' => 14,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            23 => 
            array (
                'id' => 24,
                'question_id' => 15,
                'skema_ps' => 'HD',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            24 => 
            array (
                'id' => 25,
                'question_id' => 15,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            25 => 
            array (
                'id' => 26,
                'question_id' => 15,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            26 => 
            array (
                'id' => 27,
                'question_id' => 15,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            27 => 
            array (
                'id' => 28,
                'question_id' => 16,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            28 => 
            array (
                'id' => 29,
                'question_id' => 17,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            29 => 
            array (
                'id' => 30,
                'question_id' => 18,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            30 => 
            array (
                'id' => 31,
                'question_id' => 19,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            31 => 
            array (
                'id' => 32,
                'question_id' => 20,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            32 => 
            array (
                'id' => 33,
                'question_id' => 21,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            33 => 
            array (
                'id' => 34,
                'question_id' => 22,
                'skema_ps' => 'HD',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            34 => 
            array (
                'id' => 35,
                'question_id' => 22,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            35 => 
            array (
                'id' => 36,
                'question_id' => 22,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            36 => 
            array (
                'id' => 37,
                'question_id' => 22,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            37 => 
            array (
                'id' => 38,
                'question_id' => 23,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            38 => 
            array (
                'id' => 39,
                'question_id' => 24,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            39 => 
            array (
                'id' => 40,
                'question_id' => 25,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            40 => 
            array (
                'id' => 41,
                'question_id' => 26,
                'skema_ps' => 'HA',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            41 => 
            array (
                'id' => 42,
                'question_id' => 27,
                'skema_ps' => 'HA',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            42 => 
            array (
                'id' => 43,
                'question_id' => 28,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            43 => 
            array (
                'id' => 44,
                'question_id' => 28,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            44 => 
            array (
                'id' => 45,
                'question_id' => 29,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            45 => 
            array (
                'id' => 46,
                'question_id' => 29,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            46 => 
            array (
                'id' => 47,
                'question_id' => 30,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            47 => 
            array (
                'id' => 48,
                'question_id' => 30,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            48 => 
            array (
                'id' => 49,
                'question_id' => 30,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            49 => 
            array (
                'id' => 50,
                'question_id' => 31,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            50 => 
            array (
                'id' => 51,
                'question_id' => 31,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            51 => 
            array (
                'id' => 52,
                'question_id' => 31,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            52 => 
            array (
                'id' => 53,
                'question_id' => 16,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            53 => 
            array (
                'id' => 54,
                'question_id' => 16,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            54 => 
            array (
                'id' => 55,
                'question_id' => 16,
                'skema_ps' => 'KK',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            55 => 
            array (
                'id' => 56,
                'question_id' => 17,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            56 => 
            array (
                'id' => 57,
                'question_id' => 17,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            57 => 
            array (
                'id' => 58,
                'question_id' => 17,
                'skema_ps' => 'KK',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            58 => 
            array (
                'id' => 59,
                'question_id' => 20,
                'skema_ps' => 'HD',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            59 => 
            array (
                'id' => 60,
                'question_id' => 20,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            60 => 
            array (
                'id' => 61,
                'question_id' => 20,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            61 => 
            array (
                'id' => 62,
                'question_id' => 23,
                'skema_ps' => 'HD',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            62 => 
            array (
                'id' => 63,
                'question_id' => 23,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            63 => 
            array (
                'id' => 64,
                'question_id' => 23,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            64 => 
            array (
                'id' => 65,
                'question_id' => 28,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            65 => 
            array (
                'id' => 66,
                'question_id' => 28,
                'skema_ps' => 'KK',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            66 => 
            array (
                'id' => 67,
                'question_id' => 29,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            67 => 
            array (
                'id' => 68,
                'question_id' => 29,
                'skema_ps' => 'KK',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            68 => 
            array (
                'id' => 69,
                'question_id' => 30,
                'skema_ps' => 'HTR',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            69 => 
            array (
                'id' => 71,
                'question_id' => 30,
                'skema_ps' => 'HD',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            70 => 
            array (
                'id' => 72,
                'question_id' => 30,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            71 => 
            array (
                'id' => 73,
                'question_id' => 30,
                'skema_ps' => 'KK',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            72 => 
            array (
                'id' => 74,
                'question_id' => 28,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            73 => 
            array (
                'id' => 75,
                'question_id' => 28,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            74 => 
            array (
                'id' => 77,
                'question_id' => 20,
                'skema_ps' => 'HD',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            75 => 
            array (
                'id' => 78,
                'question_id' => 20,
                'skema_ps' => 'HKm',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            76 => 
            array (
                'id' => 79,
                'question_id' => 20,
                'skema_ps' => 'KK',
                'exp_answer' => 'Tidak',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            77 => 
            array (
                'id' => 80,
                'question_id' => 29,
                'skema_ps' => 'KK',
                'exp_answer' => 'Ya',
                'created_by' => 'system',
                'modified_by' => 'system',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
        ));
        
        
    }
}