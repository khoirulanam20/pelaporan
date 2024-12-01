<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('pageadmin.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('pageadmin.ruangan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ruangan' => 'required|max:255',
            'keterangan' => 'required'
        ]);

        Ruangan::create($validatedData);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('pageadmin.ruangan.index', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        return view('pageadmin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'keterangan' => 'required|string'
        ]);

        try {
            $ruangan->update($validated);
            return redirect()->route('ruangan.index')
                ->with('success', 'Data ruangan berhasil diperbarui');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating ruangan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy(string $id)
    {
        Ruangan::destroy($id);
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
