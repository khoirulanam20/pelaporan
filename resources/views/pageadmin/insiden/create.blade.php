@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">  
            <div class="container">
                <h2>Tambah Insiden</h2>
                <form action="{{ route('insiden.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nama_pasien">Nama Pasien</label>
                                <input type="text" name="nama_pasien" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="no_rm">No RM</label>
                                <input type="text" name="no_rm" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="ruangan">Ruangan</label>
                                <select name="ruangan" class="form-control" required>
                                    <option value="">Pilih Ruangan</option>
                                    @foreach($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="penanggung_biaya">Penanggung Biaya</label>
                                <select name="penanggung_biaya" class="form-control" required>
                                    <option value="">Pilih Penanggung Biaya</option>
                                    <option value="BPJS">BPJS</option>
                                    <option value="Umum/Pribadi">Umum/Pribadi</option>
                                    <option value="Asuransi">Asuransi</option>
                                    <option value="TC/JR">TC/JR</option>
                                    <option value="Pemerintah">Pemerintah</option>
                                    <option value="Perusahaan">Perusahaan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tanggal_masuk_rs">Tanggal Masuk RS</label>
                                <input type="date" name="tanggal_masuk_rs" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="waktu_insiden">Waktu Insiden</label>
                                <input type="datetime-local" name="waktu_insiden" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="insiden">Insiden</label>
                                <select name="insiden" class="form-control" required>
                                    <option value="">Pilih Insiden</option>
                                    <option value="Administrasi Klinis">Administrasi Klinis</option>
                                    <option value="Prosedur Klinis">Prosedur Klinis</option>
                                    <option value="Dokumentasi">Dokumentasi</option>
                                    <option value="Infeksi Nosokomial">Infeksi Nosokomial</option>
                                    <option value="Medikasi/ Cairan Infus">Medikasi/ Cairan Infus</option>
                                    <option value="Laboratorium/ patologi">Laboratorium/ patologi</option>
                                    <option value="Reaksi Obat">Reaksi Obat</option>
                                    <option value="Discrepancy diagnosa">Discrepancy diagnosa</option>
                                    <option value="Reaksi sedasi">Reaksi sedasi</option>
                                    <option value="Reaksi anastesi">Reaksi anastesi</option>
                                    <option value="Oksigen">Oksigen</option>
                                    <option value="Alat">Alat</option>
                                    <option value="Prilaku Pasien">Prilaku Pasien</option>
                                    <option value="Pasien Jatuh">Pasien Jatuh</option>
                                    <option value="Resource">Resource</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="kronologi_kejadian">Kronologi Kejadian</label>
                                <textarea name="kronologi_kejadian" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jenis_insiden">Jenis Insiden</label>
                                <select name="jenis_insiden" class="form-control" required>
                                    <option value="">Pilih Jenis Insiden</option>
                                    <option value="Kejadian Nyaris Cedera">Kejadian Nyaris Cedera</option>
                                    <option value="Kejadian Tidak Diharapkan">Kejadian Tidak Diharapkan</option>
                                    <option value="Kejadian Sentinel">Kejadian Sentinel</option>
                                    <option value="Kejadian tidak cedera">Kejadian tidak cedera</option>
                                    <option value="Kondisi potensi cedera serius">Kondisi potensi cedera serius</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="insiden_terjadi_pada">Insiden Terjadi Pada Pasien</label>
                                <select name="insiden_terjadi_pada" class="form-control" required>
                                    <option value="">Pilih Insiden Terjadi Pada Pasien</option>
                                    <option value="Anak (tumbuh kembang)">Anak (tumbuh kembang)</option>
                                    <option value="Analisis Kesehatan">Analisis Kesehatan</option>
                                    <option value="Anestesi">Anestesi</option>
                                    <option value="Bedah">Bedah</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="dampak_insiden">Dampak Insiden</label>
                                <select name="dampak_insiden" class="form-control" required>
                                    <option value="">Pilih Dampak Insiden</option>
                                    <option value="Kematian">Kematian</option>
                                    <option value="Cedera Irreversibel / Cedera Berat">Cedera Irreversibel / Cedera Berat</option>
                                    <option value="Cedera Reversibel / Cedera Sedang">Cedera Reversibel / Cedera Sedang</option>
                                    <option value="Cedera Ringan">Cedera Ringan</option>
                                    <option value="Tidak Cedera">Tidak Cedera</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pelapor_pertama">Orang Pertama yang Melaporkan Insiden</label>
                                <select name="pelapor_pertama" class="form-control" required>
                                    <option value="">Pilih Orang Pertama yang Melaporkan Insiden</option>
                                    <option value="Pasien">Pasien</option>
                                    <option value="Keluarga">Keluarga</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Pengunjung">Pengunjung</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="insiden_menyangkut_pasien">Insiden Menyangkut Pasien</label>
                                <select name="insiden_menyangkut_pasien" class="form-control" required>
                                    <option value="">Pilih Insiden Menyangkut Pasien</option>
                                    <option value="Pasien Rawat Inap">Pasien Rawat Inap</option>
                                    <option value="Pasien Rawat Jalan">Pasien Rawat Jalan</option>
                                    <option value="Pasien IGD">Pasien IGD</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>   
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tempat_insiden">Tempat Insiden</label>
                                <select name="tempat_insiden" class="form-control" required>
                                    <option value="">Pilih Ruangan</option>
                                    @foreach($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="unit_penyebab_insiden">Unit Penyebab Insiden</label>
                                <select name="unit_penyebab_insiden" class="form-control" required>
                                    <option value="">Pilih Ruangan</option>
                                    @foreach($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="tindak_lanjut_kejadian">Tindak Lanjut Kejadian</label>
                                <textarea name="tindak_lanjut_kejadian" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tindak_lanjut_oleh">Tindak Lanjut Oleh</label>
                                <select name="tindak_lanjut_oleh" class="form-control" required>
                                    <option value="">Pilih Tindak Lanjut Oleh</option>
                                    <option value="Tim">Tim</option>
                                    <option value="Dokter">Dokter</option>
                                    <option value="Perawat">Perawat</option>
                                    <option value="Petugas Lainnya">Petugas Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="kejadian_serupa_unit_lain">Kejadian Serupa di Unit Lain</label>
                                <select name="kejadian_serupa_unit_lain" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nama_pembuat_laporan">Nama Pembuat Laporan</label>
                                <input type="text" name="nama_pembuat_laporan" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('insiden.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection