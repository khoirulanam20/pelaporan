<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('env') }}/logoskmku.jpg" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('admin') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">
    <title>Login - SKMKU</title>
    <style>
        .section-authentication-signin {
            min-height: 100vh;
        }

        img.img-fluid {
            max-height: 300px;
        }
    </style>

</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">

        <div class="section-authentication-signin d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-lg-5 text-center mb-4 mb-lg-0">
                        <img src="{{ asset('env') }}/logo-rsud.png" width="250" alt="Logo SkripsiKU"
                            class="img-fluid">
                        <p class="mt-3">
                            Selamat datang di <strong>Form Pelaporan Insiden Kesehatan Pasien</strong>, sistem informasi yang dirancang untuk
                            memudahkan pengelolaan pelaporan insiden kesehatan pasien.
                        </p>
                    </div>
                    <!-- Form -->
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Form Pelaporan Insiden</h3>
                                    </div>
                                    <div class="login-separater text-center mb-4">
                                        <span>MASUK MENGGUNAKAN USERNAME DAN PASSWORD</span>
                                        <hr />
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username" value="{{ old('username') }}">
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password">
                                                    <span class="input-group-text" onclick="togglePassword()"><i class="bx bx-hide"></i></span>
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Form -->

                </div>
            </div>
        </div>
    </div>

    <!--end wrapper-->
    <!-- Bootstrap JS -->
    {{-- @include('sweetalert::alert') --}}

    <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            var icon = document.querySelector(".input-group-text i");
            if (x.type === "password") {
                x.type = "text";
                icon.classList.remove("bx-hide");
                icon.classList.add("bx-show");
            } else {
                x.type = "password";
                icon.classList.remove("bx-show");
                icon.classList.add("bx-hide");
            }
        }
    </script>
</body>

</html>
