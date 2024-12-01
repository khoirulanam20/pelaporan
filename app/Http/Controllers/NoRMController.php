<?php

namespace App\Http\Controllers;

use App\Models\NoRM;
use Illuminate\Http\Request;

class NoRMController extends Controller
{
    public function index()
    {
        $noRMs = NoRM::all();   
        return view('pageadmin.no_rm.index', compact('noRMs'));
    }

    public function create()
    {
        return view('pageadmin.no_rm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_rm' => 'required|max:255',
            'keterangan' => 'required'
        ]);

        NoRM::create($validatedData);
        return redirect()->route('no_rm.index')->with('success', 'No RM berhasil ditambahkan.');
    }

    public function show($id)
    {
        $noRM = NoRM::findOrFail($id);
        return view('pageadmin.no_rm.show', compact('noRM'));
    }

    public function edit(NoRM $noRm)
    {
        return view('pageadmin.no_rm.edit', compact('noRm'));
    }

    public function update(Request $request, NoRM $noRm)
    {
        $validated = $request->validate([
            'no_rm' => 'required|string|max:255|unique:no_r_m_s,no_rm,' . $noRm->id,
            'keterangan' => 'required|string'
        ]);

        try {
            $noRm->update($validated);
            return redirect()->route('no_rm.index')
                ->with('success', 'Data No RM berhasil diperbarui');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating No RM: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy($id)
    {
        NoRM::destroy($id);
        return redirect()->route('no_rm.index')->with('success', 'No RM berhasil dihapus.');
    }
}
