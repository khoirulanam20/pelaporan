@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail Insiden</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item">Insiden</li>
                <li class="breadcrumb-item">Detail</li>
            </ol>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Data Pasien</h5>
                            <table class="table">
                                <tr>
                                    <th width="200">Nama Pasien</th>
                                    <td>{{ $insiden->nama_pasien }}</td>
                                </tr>
                                <tr>
                                    <th>No RM</th>
                                    <td>{{ $insiden->noRm->no_rm }}</td>
                                </tr>
                                <tr>
                                    <th>Ruangan</th>
                                    <td>{{ $insiden->ruanganRelasi->nama_ruangan }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $insiden->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Penanggung Biaya</th>
                                    <td>{{ $insiden->penanggung_biaya }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Masuk RS</th>
                                    <td>{{ \Carbon\Carbon::parse($insiden->tanggal_masuk_rs)->format('d/m/Y') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Data Insiden</h5>
                            <table class="table">
                                <tr>
                                    <th width="200">Waktu Insiden</th>
                                    <td>{{ \Carbon\Carbon::parse($insiden->waktu_insiden)->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Insiden</th>
                                    <td>{{ $insiden->insiden }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Insiden</th>
                                    <td>{{ $insiden->jenis_insiden }}</td>
                                </tr>
                                <tr>
                                    <th>Dampak Insiden</th>
                                    <td>{{ $insiden->dampak_insiden }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h5>Kronologi Kejadian</h5>
                            <p>{{ $insiden->kronologi_kejadian }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Informasi Tambahan</h5>
                            <table class="table">
                                <tr>
                                    <th width="200">Insiden Terjadi Pada</th>
                                    <td>{{ $insiden->insiden_terjadi_pada }}</td>
                                </tr>
                                <tr>
                                    <th>Pelapor Pertama</th>
                                    <td>{{ $insiden->pelapor_pertama }}</td>
                                </tr>
                                <tr>
                                    <th>Insiden Menyangkut Pasien</th>
                                    <td>{{ $insiden->insiden_menyangkut_pasien }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Insiden</th>
                                    <td>{{ $insiden->tempat_insiden }}</td>
                                </tr>
                                <tr>
                                    <th>Unit Penyebab Insiden</th>
                                    <td>{{ $insiden->unit_penyebab_insiden }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Tindak Lanjut</h5>
                            <table class="table">
                                <tr>
                                    <th width="200">Tindak Lanjut Kejadian</th>
                                    <td>{{ $insiden->tindak_lanjut_kejadian }}</td>
                                </tr>
                                <tr>
                                    <th>Tindak Lanjut Oleh</th>
                                    <td>{{ $insiden->tindak_lanjut_oleh }}</td>
                                </tr>
                                <tr>
                                    <th>Kejadian Serupa</th>
                                    <td>{{ $insiden->kejadian_serupa_unit_lain }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pembuat Laporan</th>
                                    <td>{{ $insiden->nama_pembuat_laporan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Lanjutan</h5>
                            <table class="table">
                                <tr>
                                    <th width="200">Grading</th>
                                    <td>{{ $insiden->grading }}</td>
                                </tr>
                                <tr>
                                    <th>Penyebab Masalah</th>
                                    <td>{{ $insiden->penyebab_masalah }}</td>
                                </tr>
                                <tr>
                                    <th>Rekomendasi</th>
                                    <td>{{ $insiden->rekomendasi }}</td>
                                </tr>
                                <tr>
                                    <th>Penanggung Jawab Rekomendasi</th>
                                    <td>{{ $insiden->penanggungjawab_rekomendasi }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Rekomendasi</th>
                                    <td>{{ $insiden->tanggal_rekomendasi }}</td>
                                </tr>
                                <tr>
                                    <th>Tindakan Dilakukan</th>
                                    <td>{{ $insiden->tindakan_dilakukan }}</td>
                                </tr>
                               
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Lanjutan</h5>
                            <table class="table">
                                <tr>
                                    <tr>
                                        <th>Penanggung Jawab Tindakan</th>
                                        <td>{{ $insiden->penanggungjawab_tindakan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Tindakan</th>
                                        <td>{{ $insiden->tanggal_tindakan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td>{{ $insiden->tanggal_mulai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>{{ $insiden->tanggal_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Manajemen Risiko</th>
                                        <td>{{ $insiden->manajemen_risiko }}</td>
                                    </tr>
                                    <tr>
                                        <th>Investigasi Lengkap</th>
                                        <td>{{ $insiden->investigasi_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>Investigasi Lanjut</th>
                                        <td>{{ $insiden->investigasi_lanjut }}</td>
                                    </tr>
                                    <tr>
                                        <th>Investigasi Setelah Grading</th>
                                        <td>{{ $insiden->investigasi_setelah_grading }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Investigasi Lengkap</th>
                                        <td>{{ $insiden->tanggal_investigasi_lengkap }}</td>
                                    </tr>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('insiden.index') }}" class="btn btn-secondary">Kembali</a>
                            <a href="{{ route('insiden.edit', $insiden->id) }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 