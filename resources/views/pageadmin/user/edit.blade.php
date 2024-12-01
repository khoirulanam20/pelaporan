@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <h2>Edit User</h2>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection