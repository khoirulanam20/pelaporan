<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin') }}/assets/images/favicon-32x32.png" type="image/png" />
    <link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('admin') }}/assets/js/pace.min.js"></script>
    <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">
    <title>Form Pelaporan Insiden</title>
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --background-color: #f8f9fa;
            --text-color: #212529;
            --border-color: #dee2e6;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            background: var(--background-color) !important;
            color: var(--text-color);
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        /* Navbar Styling */
        .navbar {
            background: #fff !important;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .nav-link i {
            margin-right: 0.5rem;
        }

        /* Main Content */
        .wrapper {
            margin-top: 90px;
            min-height: calc(100vh - 160px);
            padding: 2rem 0;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px var(--shadow-color);
            margin-bottom: 2rem;
        }

        .card-body {
            padding: 2.5rem;
        }

        /* Form Styling */
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-control {
            border-radius: 6px;
            padding: 0.625rem 1rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-select {
            border-radius: 6px;
            padding: 0.625rem 1rem;
        }

        /* Button Styling */
        .btn {
            padding: 0.625rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        /* Alert Styling */
        .alert {
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: var(--success-color);
        }

        /* Section Styling */
        .section-title {
            color: var(--text-color);
            font-size: 1.75rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            color: var(--secondary-color);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* Footer Styling */
        footer {
            background: #fff;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 -2px 4px var(--shadow-color);
        }

        footer p {
            margin: 0;
            color: var(--secondary-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .wrapper {
                margin-top: 80px;
                padding: 1rem 0;
            }

            .card-body {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        /* Form Group Spacing */
        .form-group {
            margin-bottom: 1.5rem;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 500;
            background-color: rgba(0,0,0,.02);
        }

        /* Custom Spacing */
        .mb-4 {
            margin-bottom: 2rem !important;
        }

        .mt-4 {
            margin-top: 2rem !important;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <h3>Form Pelaporan Insiden</h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><i class='bx bx-home-alt me-1'></i>Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class='bx bx-user me-1'></i>Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h3>Form Pelaporan Insiden</h3>
                                <p class="text-muted">Silakan isi form berikut dengan lengkap dan benar</p>
                            </div>

                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            <form action="{{ route('guest.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Pasien</label>
                                        <input type="text" name="nama_pasien" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">No RM</label>
                                        <select name="no_rm" class="form-control" required>
                                            <option value="">Pilih No RM</option>
                                            @foreach($noRMs as $rm)
                                                <option value="{{ $rm->id }}">{{ $rm->no_rm }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ruangan</label>
                                        <select name="ruangan" class="form-control" required>
                                            <option value="">Pilih Ruangan</option>
                                            @foreach($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            @foreach($jenisKelamin as $jk)
                                                <option value="{{ $jk }}">{{ $jk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Penanggung Biaya</label>
                                        <select name="penanggung_biaya" class="form-control" required>
                                            <option value="">Pilih Penanggung Biaya</option>
                                            @foreach($penanggungBiaya as $pb)
                                                <option value="{{ $pb }}">{{ $pb }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Masuk RS</label>
                                        <input type="date" name="tanggal_masuk_rs" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Waktu Insiden</label>
                                        <input type="datetime-local" name="waktu_insiden" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Insiden</label>
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

                                <div class="mb-3">
                                    <label class="form-label">Kronologi Kejadian</label>
                                    <textarea name="kronologi_kejadian" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Jenis Insiden</label>
                                        <select name="jenis_insiden" class="form-control" required>
                                            <option value="">Pilih Jenis Insiden</option>
                                            @foreach($jenisInsiden as $ji)
                                                <option value="{{ $ji }}">{{ $ji }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Insiden Terjadi Pada</label>
                                        <select name="insiden_terjadi_pada" class="form-control" required>
                                            <option value="">Pilih Insiden Terjadi Pada</option>
                                            @foreach($insidenTerjadi as $it)
                                                <option value="{{ $it }}">{{ $it }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Dampak Insiden</label>
                                        <select name="dampak_insiden" class="form-control" required>
                                            <option value="">Pilih Dampak Insiden</option>
                                            @foreach($dampakInsiden as $di)
                                                <option value="{{ $di }}">{{ $di }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pelapor Pertama</label>
                                        <select name="pelapor_pertama" class="form-control" required>
                                            <option value="">Pilih Pelapor Pertama</option>
                                            @foreach($pelaporPertama as $pp)
                                                <option value="{{ $pp }}">{{ $pp }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Insiden Menyangkut Pasien</label>
                                        <select name="insiden_menyangkut_pasien" class="form-control" required>
                                            <option value="">Pilih Insiden Menyangkut Pasien</option>
                                            @foreach($insidenMenyangkut as $im)
                                                <option value="{{ $im }}">{{ $im }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Insiden</label>
                                        <select name="tempat_insiden" class="form-control" required>
                                            <option value="">Pilih Ruangan</option>
                                            @foreach($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Unit Penyebab Insiden</label>
                                        <select name="unit_penyebab_insiden" class="form-control" required>
                                            <option value="">Pilih Ruangan</option>
                                            @foreach($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tindak Lanjut Oleh</label>
                                        <select name="tindak_lanjut_oleh" class="form-control" required>
                                            <option value="">Pilih Tindak Lanjut Oleh</option>
                                            @foreach($tindakLanjutOleh as $tlo)
                                                <option value="{{ $tlo }}">{{ $tlo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tindak Lanjut Kejadian</label>
                                    <textarea name="tindak_lanjut_kejadian" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Kejadian Serupa di Unit Lain</label>
                                        <select name="kejadian_serupa_unit_lain" class="form-control" required>
                                            <option value="">Pilih Kejadian Serupa</option>
                                            @foreach($kejadianSerupa as $ks)
                                                <option value="{{ $ks }}">{{ $ks }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Pembuat Laporan</label>
                                        <input type="text" name="nama_pembuat_laporan" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center">
            <p class="mb-0">Copyright © 2024. All right reserved.</p>
        </footer>
    </div>

    <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>
</body>

</html>