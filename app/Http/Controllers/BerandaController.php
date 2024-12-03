<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoRM;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\Insiden;

class BerandaController extends Controller
{
    public function guestIndex()
    {
        $noRMs = NoRM::all();
        $ruangans = Ruangan::all();
        $users = User::all();
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        $penanggungBiaya = ['BPJS', 'Umum/Pribadi', 'TC/JR', 'Asuransi Swasta', 'Pemerintah', 'Perusahaan', 'Lain-lain'];
        $jenisInsiden = ['Kejadian nyaris cedera', 'Kejadian tidak diharapkan', 'Kejadian sentinel', 'Kejadian tidak cedera', 'Kondisi potensi cedera serius'];
        $insidenTerjadi = ['Anak (tumbuh kembang)', 'Analisis Kesehatan', 'Anestesi', 'Bedah'];
        $dampakInsiden = ['Kematian', 'Cedera Irreversibel / Cedera Berat', 'Cedera Reversibel / Cedera Sedang', 'Cedera Ringan', 'Tidak Ada Cedera'];
        $pelaporPertama = ['Karyawan', 'Pasien', 'Keluarga / Pendamping Pasien', 'Pengunjung', 'Lain-lain'];
        $insidenMenyangkut = ['Pasien Rawat Inap', 'Pasien Rawat Jalan', 'Pasien IGD', 'Lainnya'];
        $tempatInsiden = Ruangan::all();
        $unitPenyebab = Ruangan::all();
        $tindakLanjutOleh = ['Tim', 'Dokter', 'Perawat', 'Petugas Lainnya'];
        $kejadianSerupa = ['Ya', 'Tidak'];

        return view('pageweb.index', compact('noRMs', 'ruangans', 'users', 'jenisKelamin', 'penanggungBiaya', 'jenisInsiden', 'insidenTerjadi', 'dampakInsiden', 'pelaporPertama', 'insidenMenyangkut', 'tempatInsiden', 'unitPenyebab', 'tindakLanjutOleh', 'kejadianSerupa'));
    }

    public function guestStore(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required',
            'no_rm' => 'required',
            'ruangan' => 'required',
            'jenis_kelamin' => 'required',
            'penanggung_biaya' => 'required',
            'tanggal_masuk_rs' => 'required|date',
            'waktu_insiden' => 'required',
            'insiden' => 'required',
            'kronologi_kejadian' => 'required',
            'jenis_insiden' => 'required',
            'insiden_terjadi_pada' => 'required',
            'dampak_insiden' => 'required',
            'pelapor_pertama' => 'required',
            'insiden_menyangkut_pasien' => 'required',
            'tempat_insiden' => 'required',
            'unit_penyebab_insiden' => 'required',
            'tindak_lanjut_kejadian' => 'required',
            'tindak_lanjut_oleh' => 'required',
            'kejadian_serupa_unit_lain' => 'required',
            'nama_pembuat_laporan' => 'required',
            'grading' => 'nullable|in:Biru,Hijau,Kuning,Merah',
            'penyebab_masalah' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
            'penanggungjawab_rekomendasi' => 'nullable|string',
            'tanggal_rekomendasi' => 'nullable|date',
            'tindakan_dilakukan' => 'nullable|string',
            'penanggungjawab_tindakan' => 'nullable|string',
            'tanggal_tindakan' => 'nullable|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'manajemen_risiko' => 'nullable|string',
            'investigasi_lengkap' => 'nullable|string',
            'investigasi_lanjut' => 'nullable|in:Investigasi 1,Investigasi 2',
            'investigasi_setelah_grading' => 'nullable|string',
            'tanggal_investigasi_lengkap' => 'nullable|date'
        ]);

        // Cari atau buat no_rm
        $noRm = NoRM::firstOrCreate(
            ['no_rm' => $request->no_rm],
            ['keterangan' => 'Auto generated from web form']
        );

        // Ganti nilai no_rm dengan id dari NoRM
        $validated['no_rm'] = $noRm->id;

        // Buat insiden baru
        Insiden::create($validated);

        return redirect()->route('guest.index')
            ->with('success', 'Data insiden berhasil ditambahkan');
    }
}
