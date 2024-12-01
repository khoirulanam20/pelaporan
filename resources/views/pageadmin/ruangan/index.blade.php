@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Ruangan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item">Ruangan</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('ruangan.create') }}" class="btn btn-sm btn-primary">Tambah Ruangan</a>
                </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Ruangan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangans as $ruangan)
                        <tr>
                            <td>{{ $ruangan->id }}</td>
                            <td>{{ $ruangan->nama_ruangan }}</td>
                            <td>{{ $ruangan->keterangan }}</td>
                            <td>
                                <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
