@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <h2>Edit Insiden</h2>
            <form action="{{ route('insiden.update', $insiden->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Field yang sudah ada -->
                
                <!-- Field baru -->
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="nama_pembuat_laporan">Nama Pembuat Laporan</label>
                        <input type="text" name="nama_pembuat_laporan" class="form-control" value="{{ $insiden->nama_pembuat_laporan }}" required>
                    </div>
                </div>
                <!-- Grading -->    
                <div class="row">   
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="grading">Grading</label>
                            <select name="grading" class="form-control">
                                <option value="">Pilih Grading</option>
                                <option value="Biru">Biru</option>
                                <option value="Hijau">Hijau</option>
                                <option value="Kuning">Kuning</option>
                                <option value="Merah">Merah</option>    
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="penyebab_masalah">Penyebab yang Melatarbelakangi / Akar Masalah Kejadian</label>
                            <textarea name="penyebab_masalah" class="form-control" rows="4">{{ $insiden->penyebab_masalah }}</textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="rekomendasi">Rekomendasi</label>
                            <textarea name="rekomendasi" class="form-control" rows="4">{{ $insiden->rekomendasi }}</textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="penanggungjawab_rekomendasi">Penanggung Jawab Rekomendasi</label>
                            <input type="text" name="penanggungjawab_rekomendasi" class="form-control" value="{{ $insiden->penanggungjawab_rekomendasi }}">
                        </div>
                    </div> 
                    
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="tanggal_rekomendasi">Tanggal Rekomendasi</label>
                            <input type="date" name="tanggal_rekomendasi" class="form-control" value="{{ $insiden->tanggal_rekomendasi }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="tindakan_dilakukan">Tindakan Dilakukan</label>
                            <textarea name="tindakan_dilakukan" class="form-control" rows="4">{{ $insiden->tindakan_dilakukan }}</textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="penanggungjawab_tindakan">Penanggung Jawab Tindakan</label>
                            <input type="text" name="penanggungjawab_tindakan" class="form-control" value="{{ $insiden->penanggungjawab_tindakan }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="tanggal_tindakan">Tanggal Tindakan</label>
                            <input type="date" name="tanggal_tindakan" class="form-control" value="{{ $insiden->tanggal_tindakan }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $insiden->tanggal_mulai }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ $insiden->tanggal_selesai }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="manajemen_risiko">Manajemen Risiko</label>
                            <textarea name="manajemen_risiko" class="form-control" rows="4">{{ $insiden->manajemen_risiko }}</textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="investigasi_lengkap">Investigasi Lengkap</label>
                            <select name="investigasi_lengkap" class="form-control">
                                <option value="">Pilih Investigasi</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="investigasi_lanjut">Investigasi Lanjut</label>
                            <select name="investigasi_lanjut" class="form-control">
                                <option value="">Pilih Investigasi</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="investigasi_setelah_grading">Investigasi Setelah Grading</label>
                            <input type="text" name="investigasi_setelah_grading" class="form-control" value="{{ $insiden->investigasi_setelah_grading }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="tanggal_investigasi_lengkap">Tanggal Investigasi Lengkap</label>
                            <input type="date" name="tanggal_investigasi_lengkap" class="form-control" value="{{ $insiden->tanggal_investigasi_lengkap }}">
                        </div>
                    </div>

                </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('insiden.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
