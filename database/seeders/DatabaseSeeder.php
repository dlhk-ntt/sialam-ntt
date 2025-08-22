<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AppInfo;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // AppInfo::create([
        //     'code' => 'SeLa',
        //     'name' => 'Sistem Informasi Akses Lahan',
        //     'description' => 'Sistem Informasi Akses Lahan',
        //     'logo' => '',
        //     'phone' => '',
        //     'whatsapp' => '',
        //     'email' => '',
        //     'instagram' => '',
        //     'facebook' => '',
        //     'twitter' => '',
        //     'youtube' => '',
        //     'tiktok' => '',
        //     'guide_mp4' => '',
        //     'guide_pdf' => '',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);

        // Question::create([
        //     'code' => 'A',
        //     'content' => 'Apakah anda berniat mengusulkan atas nama lembaga desa/kelurahan?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'B',
        //     'content' => 'Apakah areal anda berada di dalam satu kesatuan lansekap/bentang alam/bentang lahan?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => true,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'C',
        //     'content' => 'Apakah areal yang anda usulkan berada di dalam wilayah desa anda atau areal hasil kesepakatan batas pengelolaan antara desa yang berdampingan dengan desa anda?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'D',
        //     'content' => 'Apakah areal yang anda usulkan berupa areal Gambut?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => true,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'E',
        //     'content' => 'Apakah areal yang anda usulkan dapat dikatakan sebagai areal yang tidak produktif dengan tutupan lahan rendah sampai sedang?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => true,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'F',
        //     'content' => 'Apakah areal yang anda usulkan memiliki potensi menjadi sumber penghidupan masyarakat setempat atau areal konflik atau berpotensi konflik?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'G',
        //     'content' => 'Apakah areal yang anda usulkan sudah dimanfaatkan oleh warga setempat?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'H',
        //     'content' => 'Apakah calon areal yang akan anda usulkan berada di dalam wilayah persetujuan penggunaan kawasan hutan?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'I',
        //     'content' => 'Apakah calon areal yang ditanami sawit tersebut sudah dilekola oleh pengelola yang telah tinggal di dalam dan/atau sekitar kawasan tersebut selama minimal 5 tahun secara terus menerus?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'J',
        //     'content' => 'Apakah di areal yang anda usulkan terdapat tegakan berupa sawit?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'K',
        //     'content' => 'Apakah MHA tersebut tinggal di dalam kawasan hutan atau areal yang akan diusulkan, serta telah lama memanfaatkannya?',
        //     'is_HA' => true,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'L',
        //     'content' => 'Apakah pembentukan lembaga desa/kelurahan tersebut melalui Peraturan Desa atau Peraturan Bupati/Walikota?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'M',
        //     'content' => 'Apakah sudah ada MHA (Masayarakat Hukum Adat) yang ditetapkan dengan Perda (jika MHA berada di dalam kawasan hutan negara) atau Perda atau Keputusan Gub.dan/atau Bupati/wali kota (jika MHA di luar kawasan hutan)?',
        //     'is_HA' => true,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'N',
        //     'content' => 'Apakah areal yang anda usulkan berada di dalam kawasan konservasi (misal: taman nasional)?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => true,
        //     'is_KK' => true,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'O',
        //     'content' => 'Apakah areal yang anda usulkan berada di dalam kawasan perusahan kehutanan (HTI/Hutan Tanaman Industri)?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => true,
        //     'is_KK' => true,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);

        // QuestionAnswer::create([
        //     'question_id' => 1,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 2,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 2,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 3,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 4,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 5,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 6,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 7,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 7,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 8,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 9,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 9,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 9,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 10,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 10,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 10,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 11,
        //     'skema_ps' => 'HA',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 12,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 13,
        //     'skema_ps' => 'HA',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 14,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 14,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 14,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 14,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 15,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 15,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 15,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 15,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);

        /***** UPDATE 090823 *****/
        // DB::table('questions')->where('status', 'active')->update(['status' => 'inactive', 'modified_by' => 'system']);

        // Question::create([
        //     'code' => 'A',
        //     'content' => 'Apakah areal yang Anda usulkan berada di dalam wilayah desa Anda?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{}',
        //     'category' => 'Status Kawasan',
        //     'order' => 1,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'B',
        //     'content' => 'Apakah areal yang Anda usulkan merupakan areal hasil kesepakatan batas pengelolaan antara desa yang berdampingan dengan desa Anda?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{"A":"Tidak"}',
        //     'category' => 'Status Kawasan',
        //     'order' => 2,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'C',
        //     'content' => 'Apakah Anda berniat mengusulkan atas nama lembaga desa/kelurahan?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{"A":"Ya","B":"Ya"}',
        //     'category' => 'Kelembagaan',
        //     'order' => 3,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'D',
        //     'content' => 'Apakah pembentukan lembaga desa/kelurahan tersebut melalui Peraturan Desa atau Peraturan Bupati/Walikota?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{"A":"Ya","B":"Ya"}',
        //     'category' => 'Kelembagaan',
        //     'order' => 4,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'E',
        //     'content' => 'Apakah areal yang Anda usulkan berupa areal Gambut?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => true,
        //     'is_KK' => false,
        //     'prerequisite' => '{}',
        //     'category' => 'Biofisik',
        //     'order' => 5,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'F',
        //     'content' => 'Apakah areal yang Anda usulkan dapat dikatakan sebagai areal yang tidak produktif dengan tutupan lahan rendah sampai sedang?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => true,
        //     'is_KK' => false,
        //     'prerequisite' => '{"E":"Tidak"}',
        //     'category' => 'Biofisik',
        //     'order' => 6,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'G',
        //     'content' => 'Apakah areal yang Anda usulkan berada di dalam kawasan perusahan kehutanan (HTI/Hutan Tanaman Industri)?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => true,
        //     'is_KK' => true,
        //     'prerequisite' => '{}',
        //     'category' => 'Status Kawasan',
        //     'order' => 7,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'H',
        //     'content' => 'Apakah calon areal yang akan Anda usulkan berada di dalam wilayah persetujuan penggunaan kawasan hutan?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'prerequisite' => '{"G":"Tidak"}',
        //     'category' => 'Status Kawasan',
        //     'order' => 8,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'I',
        //     'content' => 'Apakah areal yang Anda usulkan memiliki potensi menjadi sumber penghidupan masyarakat setempat?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'prerequisite' => '{"H":"Ya"}',
        //     'category' => 'Pemanfaatan',
        //     'order' => 9,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'J',
        //     'content' => 'Apakah areal yang Anda usulkan merupakan areal konflik atau berpotensi konflik?',
        //     'is_HA' => false,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'prerequisite' => '{"H":"Ya"}',
        //     'category' => 'Potensi Masalah Sosial',
        //     'order' => 10,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'K',
        //     'content' => 'Apakah sudah ada MHA (Masayarakat Hukum Adat) yang ditetapkan dengan Perda (jika MHA berada di dalam kawasan hutan negara), atau Perda atau Keputusan Gubernur dan/atau Bupati/Walikota (jika MHA di luar kawasan hutan)?',
        //     'is_HA' => true,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{}',
        //     'category' => 'Kelembagaan',
        //     'order' => 11,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'L',
        //     'content' => 'Apakah MHA tersebut tinggal di dalam kawasan hutan atau areal yang akan diusulkan, serta telah lama memanfaatkannya?',
        //     'is_HA' => true,
        //     'is_HD' => false,
        //     'is_HKm' => false,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{"K":"Ya"}',
        //     'category' => 'Kelembagaan',
        //     'order' => 12,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'M',
        //     'content' => 'Apakah areal Anda usulkan berada di dalam satu kesatuan lansekap/bentang alam/bentang lahan?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => false,
        //     'is_HTR' => true,
        //     'is_KK' => false,
        //     'prerequisite' => '{}',
        //     'category' => 'Status Kawasan',
        //     'order' => 13,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'N',
        //     'content' => 'Apakah areal yang Anda usulkan sudah dimanfaatkan oleh warga setempat?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => false,
        //     'is_KK' => false,
        //     'prerequisite' => '{}',
        //     'category' => 'Pemanfaatan',
        //     'order' => 14,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'O',
        //     'content' => 'Apakah di areal yang Anda usulkan terdapat tegakan berupa sawit?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'prerequisite' => '{}',
        //     'category' => 'Pemanfaatan',
        //     'order' => 15,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // Question::create([
        //     'code' => 'P',
        //     'content' => 'Apakah calon areal yang ditanami sawit tersebut sudah dilekola oleh pengelola yang telah tinggal di dalam dan/atau sekitar kawasan tersebut selama minimal 5 tahun secara terus menerus?',
        //     'is_HA' => false,
        //     'is_HD' => true,
        //     'is_HKm' => true,
        //     'is_HTR' => false,
        //     'is_KK' => true,
        //     'prerequisite' => '{"O":"Ya"}',
        //     'category' => 'Pemanfaatan',
        //     'order' => 16,
        //     'status' => 'active',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);

        // QuestionAnswer::create([
        //     'question_id' => 16,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 17,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 18,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 19,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 20,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 21,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 22,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 22,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 22,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Tidak',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 22,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 23,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 24,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 25,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 26,
        //     'skema_ps' => 'HA',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 27,
        //     'skema_ps' => 'HA',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 28,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 28,
        //     'skema_ps' => 'HTR',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 29,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 29,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 30,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 30,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 30,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 31,
        //     'skema_ps' => 'HD',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 31,
        //     'skema_ps' => 'HKm',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        // QuestionAnswer::create([
        //     'question_id' => 31,
        //     'skema_ps' => 'KK',
        //     'exp_answer' => 'Ya',
        //     'created_by' => 'system',
        //     'modified_by' => 'system',
        // ]);
        /***** END UPDATE 090823 *****/

        /***** UPDATE 110823 *****/
        // DB::table('questions')->where(['code' => 'B', 'prerequisite' => '{"A":"Tidak"}'])->update(['prerequisite' => '{"A":"Ya"}', 'modified_by' => 'system']);

        // DB::table('questions')->where(['code' => 'C', 'prerequisite' => '{"A":"Ya","B":"Ya"}'])->update(['prerequisite' => '{"A":"Tidak","B":"Tidak"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'D', 'prerequisite' => '{"A":"Ya","B":"Ya"}'])->update(['prerequisite' => '{"A":"Tidak","B":"Tidak"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'F', 'prerequisite' => '{"E":"Tidak"}'])->update(['prerequisite' => '{"E":"Ya"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'H', 'prerequisite' => '{"G":"Tidak"}'])->update(['prerequisite' => '{"G":"Ya"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'I', 'prerequisite' => '{"H":"Ya"}'])->update(['prerequisite' => '{"H":"Tidak"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'J', 'prerequisite' => '{"H":"Ya"}'])->update(['prerequisite' => '{"H":"Tidak"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'L', 'prerequisite' => '{"K":"Ya"}'])->update(['prerequisite' => '{"K":"Tidak"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'P', 'prerequisite' => '{"O":"Ya"}'])->update(['prerequisite' => '{"O":"Tidak"}', 'modified_by' => 'system']);
        /***** END UPDATE 110823 *****/
        
        /***** UPDATE 220823 *****/
        // DB::table('questions')->where(['code' => 'A', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'B', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'C', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 12) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'D', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 12) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'E', 'category' => 'Biofisik'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 174) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'F', 'category' => 'Biofisik'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 34) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'G', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 22, 44, & 45) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'H', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 22, 44 & 45) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'I', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 45) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'J', 'category' => 'Potensi Masalah Sosial'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 45) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'K', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 63)', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'L', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 62 & 63)', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'M', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11 & 34) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'N', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11 & 22) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'O', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11, 22, & 45) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'P', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11, 22, & 45) dan Buku Fasilitasi Pengajuan Persetujuan PS', 'modified_by' => 'system']);
        /***** END UPDATE 220823 *****/

        /***** UPDATE 300823 *****/
        // DB::table('questions')->where(['code' => 'A', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'B', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'C', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 12) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'D', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 12) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'E', 'category' => 'Biofisik'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 174) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'F', 'category' => 'Biofisik'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 34) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'G', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 22, 44, & 45) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'H', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 22, 44 & 45) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'I', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 45) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'J', 'category' => 'Potensi Masalah Sosial'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 45) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'K', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 63)', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'L', 'category' => 'Kelembagaan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 62 & 63)', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'M', 'category' => 'Status Kawasan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11 & 34) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'N', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11 & 22) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'O', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11, 22, & 45) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'P', 'category' => 'Pemanfaatan'])->update(['legal_reference' => 'Permen LHK No.9/2021 (Pasal 11, 22, & 45) dan Buku Saku Fasilitasi Permohonan Perhutanan Sosial', 'modified_by' => 'system']);
        /***** END UPDATE 300823 *****/

        /***** UPDATE 120923 *****/
        // DB::table('questions')->where(['code' => 'D', 'category' => 'Kelembagaan'])->update(['prerequisite' => '{"C":"Tidak"}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'F', 'category' => 'Biofisik'])->update(['prerequisite' => '{}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'I', 'category' => 'Pemanfaatan'])->update(['prerequisite' => '{}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'J', 'category' => 'Potensi Masalah Sosial'])->update(['content' => 'Apakah areal yang Anda usulkan merupakan areal konflik atau berpotensi konflik? (Persoalan masalah pemanfaatan, baik tumpang tindih lahan atau perbedaan hak akses pemanfaatan)', 'prerequisite' => '{}', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'K', 'category' => 'Kelembagaan'])->update(['content' => 'Apakah sudah ada MHA (Masyarakat Hukum Adat) yang ditetapkan dengan Perda (jika MHA berada di dalam kawasan hutan negara), atau Perda atau Keputusan Gubernur dan/atau Bupati/Walikota (jika MHA di luar kawasan hutan)?', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'M', 'category' => 'Status Kawasan'])->update(['content' => 'Apakah areal yang Anda usulkan berada di dalam satu kesatuan lansekap/bentang alam/bentang lahan?', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'O', 'category' => 'Pemanfaatan'])->update(['content' => 'Apakah di areal yang Anda usulkan terdapat tegakan berupa sawit, dan sudah dikelola oleh masyarakat (perseorangan) yang telah tinggal di dalam dan/atau sekitar kawasan tersebut selama minimal 5 tahun secara terus menerus?', 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'P', 'category' => 'Pemanfaatan'])->update(['status' => 'inactive', 'modified_by' => 'system']);

        // QuestionAnswer::create(['question_id' => 16, 'skema_ps' => 'HTR', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 16, 'skema_ps' => 'HKm', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 16, 'skema_ps' => 'KK', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 17, 'skema_ps' => 'HTR', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 17, 'skema_ps' => 'HKm', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 17, 'skema_ps' => 'KK', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 20, 'skema_ps' => 'HD', 'exp_answer' => 'Ya', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 20, 'skema_ps' => 'HKm', 'exp_answer' => 'Ya', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 20, 'skema_ps' => 'KK', 'exp_answer' => 'Ya', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 23, 'skema_ps' => 'HD', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 23, 'skema_ps' => 'HKm', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 23, 'skema_ps' => 'HTR', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 28, 'skema_ps' => 'HKm', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 28, 'skema_ps' => 'KK', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 29, 'skema_ps' => 'HTR', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 29, 'skema_ps' => 'KK', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 30, 'skema_ps' => 'HTR', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        /***** END UPDATE 120923 *****/

        /***** UPDATE 140923 *****/
        // QuestionAnswer::create(['question_id' => 30, 'skema_ps' => 'HD', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 30, 'skema_ps' => 'HKm', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 30, 'skema_ps' => 'KK', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 28, 'skema_ps' => 'HKm', 'exp_answer' => 'Ya', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 28, 'skema_ps' => 'KK', 'exp_answer' => 'Ya', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // DB::table('questions')->where(['code' => 'E', 'category' => 'Biofisik'])->update(['is_HD' => true, 'is_KK' => true, 'is_HKm' => true, 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'H', 'category' => 'Status Kawasan'])->update(['is_HD' => true, 'is_HTR' => true, 'is_HKm' => true, 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'M', 'category' => 'Status Kawasan'])->update(['is_HKm' => true, 'is_KK' => true, 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'N', 'category' => 'Pemanfaatan'])->update(['is_HTR' => true, 'is_KK' => true, 'modified_by' => 'system']);
        // DB::table('questions')->where(['code' => 'O', 'category' => 'Pemanfaatan'])->update(['is_HTR' => true, 'modified_by' => 'system']);
        /***** END UPDATE 140923 *****/

        /***** UPDATE 210923 *****/
        // QuestionAnswer::create(['question_id' => 20, 'skema_ps' => 'HD', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 20, 'skema_ps' => 'HKm', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 20, 'skema_ps' => 'KK', 'exp_answer' => 'Tidak', 'created_by' => 'system', 'modified_by' => 'system', ]);
        // QuestionAnswer::create(['question_id' => 29, 'skema_ps' => 'KK', 'exp_answer' => 'Ya', 'created_by' => 'system', 'modified_by' => 'system', ]);
        /***** END UPDATE 210923 *****/
        
        /***** UPDATE 091023 *****/
        $this->call(AppInfosTableSeeder::class);
        $this->call(QuestionAnswersTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        /***** END UPDATE 091023 *****/
    }
}
