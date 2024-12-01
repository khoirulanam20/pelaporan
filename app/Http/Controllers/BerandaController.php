<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoRM;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\Insiden;

class BerandaController extends Controller
{
    public function index()
    {
        $noRMs = NoRM::all();
        $ruangans = Ruangan::all();
        $users = User::all();
        
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        
        $penanggungBiaya = [
            'BPJS',
            'Umum/Pribadi',
            'TC/JR',
            'Asuransi Swasta',
            'Pemerintah',
            'Perusahaan',
            'Lain-lain'
        ];
        
        $jenisInsiden = [
            'Kejadian nyaris cedera',
            'Kejadian tidak diharapkan',
            'Kejadian sentinel',
            'Kejadian tidak cedera',
            'Kondisi potensi cedera serius'
        ];
        
        $insidenTerjadi = [
            'Anak (tumbuh kembang)',
            'Analisis Kesehatan',
            'Anestesi',
            'Bedah'
        ];
        
        $dampakInsiden = [
            'Kematian',
            'Cedera Irreversibel / Cedera Berat',
            'Cedera Reversibel / Cedera Sedang',
            'Cedera Ringan',
            'Tidak Ada Cedera'
        ];
        
        $pelaporPertama = [
            'Karyawan',
            'Pasien',
            'Keluarga / Pendamping Pasien',
            'Pengunjung',
            'Lain-lain'
        ];
        
        $insidenMenyangkut = [
            'Pasien Rawat Inap',
            'Pasien Rawat Jalan',
            'Pasien IGD',
            'Lainnya'
        ];
        
        $tempatInsiden = ['Unit 1', 'Unit 2'];
        
        $unitPenyebab = ['Unit 1', 'Unit 2'];
        
        $tindakLanjutOleh = [
            'Tim',
            'Dokter',
            'Perawat',
            'Petugas Lainnya'
        ];
        
        $kejadianSerupa = ['Ya', 'Tidak'];

        return view('pageweb.index', compact(
            'noRMs',
            'ruangans',
            'jenisKelamin',
            'penanggungBiaya',
            'jenisInsiden',
            'insidenTerjadi',
            'dampakInsiden',
            'pelaporPertama',
            'insidenMenyangkut',
            'tempatInsiden',
            'unitPenyebab',
            'tindakLanjutOleh',
            'kejadianSerupa'
        ));
    }
}
