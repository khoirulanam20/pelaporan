@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Insiden</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item">Insiden</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('insiden.create') }}" class="btn btn-primary mb-3">Tambah Insiden</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>No RM</th>
                                <th>Waktu Insiden</th>
                                <th>Insiden</th>
                                <th>Tempat Insiden</th>
                                <th>Unit Terkait</th>
                                <th>Jenis Insiden</th>
                                <th>Kronologi</th>
                                <th>Grading</th>
                                <th>Pelapor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insiden as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nama_pasien }}</td>
                                <td>{{ $item->noRm->no_rm }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->waktu_insiden)->format('d/m/Y H:i') }}</td>
                                <td>{{ $item->insiden }}</td>
                                <td>{{ $item->ruanganTempat ? $item->ruanganTempat->nama_ruangan : $item->tempat_insiden }}</td>
                                <td>{{ $item->ruanganUnit ? $item->ruanganUnit->nama_ruangan : $item->unit_penyebab_insiden }}</td>
                                <td>{{ $item->jenis_insiden }}</td>
                                <td>{{ $item->kronologi_kejadian }}</td>
                                <td>
                                    <span class="badge {{ $item->grading == 'Biru' ? 'bg-primary' : 
                                        ($item->grading == 'Hijau' ? 'bg-success' : 
                                        ($item->grading == 'Kuning' ? 'bg-warning' : 
                                        ($item->grading == 'Merah' ? 'bg-danger' : 'bg-secondary'))) }}">
                                        {{ $item->grading }}
                                    </span>
                                </td>
                                <td>{{ $item->nama_pembuat_laporan }}</td>
                                <td>
                                    <a href="{{ route('insiden.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('insiden.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('insiden.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
</div>
@endsection
