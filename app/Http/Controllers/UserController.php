<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pageadmin.user.index', compact('users'));
    }

    public function create()
    {
        return view('pageadmin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:6'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pageadmin.user.index', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pageadmin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,user'
        ]);

        try {
            $user->username = $validated['username'];
            $user->nama = $validated['nama'];
            $user->email = $validated['email'];
            $user->role = $validated['role'];
            
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }

            $user->save();

            return redirect()->route('user.index')
                ->with('success', 'Data user berhasil diperbarui');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
