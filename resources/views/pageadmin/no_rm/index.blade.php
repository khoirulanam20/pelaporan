@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data No RM</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item">No RM</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('no_rm.create') }}" class="btn btn-sm btn-primary">Tambah No RM</a>
                </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>No RM</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noRMs as $noRM)
                    <tr>
                        <td>{{ $noRM->id }}</td>
                        <td>{{ $noRM->no_rm }}</td>
                        <td>{{ $noRM->keterangan }}</td>
                        <td>
                            <a href="{{ route('no_rm.edit', $noRM->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('no_rm.destroy', $noRM->id) }}" method="POST" style="display: inline-block;">
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