<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NoRM;
use App\Models\Ruangan;

class MasterDataController extends Controller
{
    public function index()
    {
        $users = User::all();
        $noRMs = NoRM::all();
        $ruangans = Ruangan::all();
        return view('pageadmin.master-data.index', compact('users', 'noRMs', 'ruangans'));
    }

    public function create()
    {
        return view('pageadmin.master-data.create');
    }

    public function store(Request $request)
    {
        User::create($request->only(['nama', 'role']));
        NoRM::create($request->only(['no_rm', 'keterangan']));
        Ruangan::create($request->only(['nama_ruangan', 'keterangan']));
        return redirect()->route('master-data.index');
    }

    public function show($id)
    {
        // Implementasi spesifik jika diperlukan
    }

    public function edit($id)
    {
        // Implementasi spesifik jika diperlukan
    }

    public function update(Request $request, $id)
    {
        // Implementasi spesifik jika diperlukan
    }

    public function destroy($id)
    {
        // Implementasi spesifik jika diperlukan
    }
}
