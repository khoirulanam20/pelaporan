<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pelaporan Insiden - RSUD</title>
    
    <!-- CSS -->
    <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #475569;
            --accent-color: #0ea5e9;
            --success-color: #22c55e;
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --border-color: #e2e8f0;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
        }

        /* Navbar */
        .navbar {
            padding: 1rem 0;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            max-height: 50px;
            width: auto;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .navbar-brand img {
            max-height: 40px;
        }

        .nav-link {
            color: var(--text-color);
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        /* Hero Section Styling */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(100px, -100px);
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50px, 50px);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .hero-image {
            position: relative;
            z-index: 1;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .hero-stats {
            margin-top: 2rem;
            display: flex;
            gap: 2rem;
        }

        .stat-item {
            color: white;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Form Section */
        .form-section {
            background: white;
            padding: 40px 0;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px var(--shadow-color);
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        /* Button */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        /* Alert */
        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        /* Footer */
        footer {
            background: white;
            padding: 1.5rem 0;
            text-align: center;
            box-shadow: 0 -2px 4px var(--shadow-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                padding: 100px 0 60px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-image {
                margin-top: 3rem;
            }
            
            .form-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('env') }}/logo-rsud.png" width="250" alt="Logo SkripsiKU" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1>Sistem Pelaporan Insiden Keselamatan Pasien</h1>
                        <p>Laporkan insiden keselamatan pasien dengan mudah dan aman melalui sistem pelaporan digital kami.</p>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Layanan</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><i class='bx bx-time'></i></div>
                                <div class="stat-label">Respon Cepat</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{ asset('admin') }}/assets/images/healthcare-hero.png" alt="Healthcare Illustration" 
                             class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
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
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">Copyright © {{ date('Y') }} RSUD. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
    <script>
        // Form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Tambahkan efek scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>