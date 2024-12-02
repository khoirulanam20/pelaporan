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
            background-color: #f5f5f5;
        }

        img.img-fluid {
            max-height: 300px;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-body {
            padding: 2rem;
        }

        .border.p-4 {
            border-radius: 10px;
        }

        .form-control {
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4154f1;
            box-shadow: 0 0 0 0.2rem rgba(65, 84, 241, 0.25);
        }

        .btn-primary {
            padding: 0.8rem;
            border-radius: 8px;
            background: #4154f1;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #364af3;
            transform: translateY(-1px);
        }

        .login-separater {
            position: relative;
            margin: 2rem 0;
        }

        .login-separater span {
            background: #fff;
            padding: 0 15px;
            color: #6c757d;
            font-size: 14px;
        }

        .login-separater hr {
            position: absolute;
            width: 100%;
            top: 50%;
            z-index: -1;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        #show_hide_password a {
            text-decoration: none;
            color: #6c757d;
        }

        .input-group-text {
            border-radius: 0 8px 8px 0;
            cursor: pointer;
        }

        h3 {
            color: #2b2b2b;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #4a4a4a;
        }
    </style>

</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">

        <div class="section-authentication-signin d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    
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
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
            // Animasi fade in untuk card
            $(".card").hide().fadeIn(1000);
            
            // Efek hover pada input
            $(".form-control").hover(
                function() {
                    $(this).css("border-color", "#4154f1");
                },
                function() {
                    if (!$(this).is(":focus")) {
                        $(this).css("border-color", "#ddd");
                    }
                }
            );

            // Toggle password visibility
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide").removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide").addClass("bx-show");
                }
            });

            // Efek loading pada tombol submit
            $("form").on("submit", function() {
                const btn = $(this).find("button[type='submit']");
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                btn.prop('disabled', true);
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>
</body>

</html>
