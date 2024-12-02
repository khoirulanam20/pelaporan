<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\NoRM;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class InsidenController extends Controller
{
    public function index()
    {
        $insiden = Insiden::with(['noRm', 'ruanganRelasi', 'ruanganTempat', 'ruanganUnit'])->get();
        return view('pageadmin.insiden.index', compact('insiden'));
    }

    public function create()
    {
        $noRMs = NoRM::all();
        $ruangans = Ruangan::all();
        $grading = ['Biru', 'Hijau', 'Kuning', 'Merah'];
        $investigasiLanjut = ['Ya', 'Tidak'];
        
        return view('pageadmin.insiden.create', compact('noRMs', 'ruangans', 'grading', 'investigasiLanjut'));
    }

    public function store(Request $request)
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
            'investigasi_lanjut' => 'nullable|in:Ya,Tidak',
            'investigasi_setelah_grading' => 'nullable|string',
            'tanggal_investigasi_lengkap' => 'nullable|date'
        ]);

        Insiden::create($validated);

        return redirect()->route('insiden.index')
            ->with('success', 'Data insiden berhasil ditambahkan');
    }

    public function show(Insiden $insiden)
    {
        return view('pageadmin.insiden.show', compact('insiden'));
    }

    public function edit(Insiden $insiden)
    {
        $noRMs = NoRM::all();
        $ruangans = Ruangan::all();
        $grading = ['Biru', 'Hijau', 'Kuning', 'Merah'];
        $investigasiLanjut = ['Ya', 'Tidak'];
        
        return view('pageadmin.insiden.edit', compact('insiden', 'noRMs', 'ruangans', 'grading', 'investigasiLanjut'));
    }

    public function update(Request $request, Insiden $insiden)
    {
        $validated = $request->validate([
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
            'investigasi_lanjut' => 'nullable|in:Ya,Tidak',
            'investigasi_setelah_grading' => 'nullable|string',
            'tanggal_investigasi_lengkap' => 'nullable|date'
        ]);

        try {
            $insiden->update($validated);
            return redirect()->route('insiden.index')
                ->with('success', 'Data insiden berhasil diperbarui');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating insiden: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy(Insiden $insiden)
    {
        $insiden->delete();

        return redirect()->route('insiden.index')
            ->with('success', 'Data insiden berhasil dihapus');
    }
}
