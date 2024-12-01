<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    use HasFactory;

    protected $table = 'insiden';
    
    protected $fillable = [
        'nama_pasien',
        'no_rm',
        'ruangan',
        'jenis_kelamin',
        'penanggung_biaya',
        'tanggal_masuk_rs',
        'waktu_insiden',
        'insiden',
        'kronologi_kejadian',
        'jenis_insiden',
        'insiden_terjadi_pada',
        'dampak_insiden',
        'pelapor_pertama',
        'insiden_menyangkut_pasien',
        'tempat_insiden',
        'unit_penyebab_insiden',
        'tindak_lanjut_kejadian',
        'tindak_lanjut_oleh',
        'kejadian_serupa_unit_lain',
        'nama_pembuat_laporan',
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
    ];

    // Relasi dengan model NoRM
    public function noRm()
    {
        return $this->belongsTo(NoRM::class, 'no_rm', 'id');
    }

    // Relasi dengan model Ruangan 
    public function ruanganRelasi()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan', 'id');
    }
}
