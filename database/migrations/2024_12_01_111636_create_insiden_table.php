<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('insiden', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->foreignId('no_rm')->constrained('no_r_m_s');
            $table->foreignId('ruangan')->constrained('ruangans');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('penanggung_biaya');
            $table->date('tanggal_masuk_rs');
            $table->string('waktu_insiden');
            $table->string('insiden');
            $table->text('kronologi_kejadian');
            $table->string('jenis_insiden');
            $table->string('insiden_terjadi_pada');
            $table->string('dampak_insiden');
            $table->string('pelapor_pertama');
            $table->string('insiden_menyangkut_pasien');
            $table->string('tempat_insiden');
            $table->string('unit_penyebab_insiden');
            $table->text('tindak_lanjut_kejadian');
            $table->string('tindak_lanjut_oleh');
            $table->enum('kejadian_serupa_unit_lain', ['Ya', 'Tidak']);
            $table->string('nama_pembuat_laporan');
            $table->timestamps();
        });

        Schema::table('insiden', function (Blueprint $table) {
            $table->enum('grading', ['Biru', 'Hijau', 'Kuning', 'Merah'])->nullable()->after('nama_pembuat_laporan');
            $table->text('penyebab_masalah')->nullable()->after('grading');
            $table->string('rekomendasi')->nullable()->after('penyebab_masalah');
            $table->string('penanggungjawab_rekomendasi')->nullable()->after('rekomendasi');
            $table->date('tanggal_rekomendasi')->nullable()->after('penanggungjawab_rekomendasi');
            $table->text('tindakan_dilakukan')->nullable()->after('tanggal_rekomendasi');
            $table->string('penanggungjawab_tindakan')->nullable()->after('tindakan_dilakukan');
            $table->date('tanggal_tindakan')->nullable()->after('penanggungjawab_tindakan');
            $table->date('tanggal_mulai')->nullable()->after('tanggal_tindakan');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
            $table->string('manajemen_risiko')->nullable()->after('tanggal_selesai');
            $table->string('investigasi_lengkap')->nullable()->after('manajemen_risiko');
            $table->enum('investigasi_lanjut', ['Investigasi 1', 'Investigasi 2'])->nullable()->after('investigasi_lengkap');
            $table->string('investigasi_setelah_grading')->nullable()->after('investigasi_lanjut');
            $table->date('tanggal_investigasi_lengkap')->nullable()->after('investigasi_setelah_grading');
        });
    }

    public function down()
    {
        Schema::dropIfExists('insiden');

        Schema::table('insiden', function (Blueprint $table) {
            $table->dropColumn([
                'grading',
                'penyebab_masalah',
                'rekomendasi',
                'penanggungjawab_rekomendasi',
                'tanggal_rekomendasi',
                'tindakan_dilakukan',
                'penanggungjawab_tindakan',
                'tanggal_tindakan',
                'tanggal_mulai',
                'tanggal_selesai',
                'manajemen_risiko',
                'investigasi_lengkap',
                'investigasi_lanjut',
                'investigasi_setelah_grading',
                'tanggal_investigasi_lengkap'
            ]);
        });
    }
};