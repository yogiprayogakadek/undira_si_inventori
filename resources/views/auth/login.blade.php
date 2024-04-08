<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Webinning" name="author">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="https://dashly-theme.com/assets/css/theme.bundle.css" id="stylesheetLTR">
    <link rel="stylesheet" href="https://dashly-theme.com/assets/css/theme.rtl.bundle.css" id="stylesheetRTL"
        disabled="">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    <link rel="stylesheet" onload="this.onload=null;this.removeAttribute('media');"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">

    <!-- no-JS fallback -->
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap">
    </noscript>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" sizes="any">
    <!-- Page Title -->
    <title>E-LEARNING HOSPITALITY | NORTH SEA BALI COLLEGE</title>
</head>

<body class="d-flex align-items-center bg-light-green">
    <!-- MAIN CONTENT -->
    <main class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 col-lg-6 px-lg-4 px-xl-8 d-flex flex-column vh-100 py-6">

                <!-- Brand -->
                <a class="navbar-brand mb-auto" href="./index.html">
                    <img src="{{ asset('assets/images/logo.png') }}" class="navbar-brand-img logo-light logo-large"
                        alt="..." width="75">
                    <img src="{{ asset('assets/images/logo.png') }}" class="navbar-brand-img logo-dark logo-large"
                        alt="..." width="75">
                </a>
                <div>
                    <!-- Title -->
                    <h1 class="mb-2">
                        E-LEARNING HOSPITALITY | NORTH SEA BALI COLLEGE
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-secondary">
                        Masukkan username and password untuk login
                    </p>

                    <!-- Form -->
                    <form role="form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">

                                    <!-- Label -->
                                    <label class="form-label">
                                        Username
                                    </label>

                                    <!-- Input -->
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        placeholder="masukkan username" name="username" id="username"
                                        value="{{ old('username') }}">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Password -->
                                <div class="mb-4">

                                    <div class="row">
                                        <div class="col">

                                            <!-- Label -->
                                            <label class="form-label">
                                                Password
                                            </label>
                                        </div>
                                    </div> <!-- / .row -->

                                    <!-- Input -->
                                    <div class="input-group input-group-merge">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            autocomplete="off" data-toggle-password-input=""
                                            placeholder="masukkan password" name="password">

                                        <button type="button" class="input-group-text px-4 text-secondary link-primary"
                                            data-toggle-password=""></button>

                                    </div>
                                    <a href="javascript::void(0)" class="text-muted text-small forget-password">Lupa
                                        password</a>
                                </div>
                            </div>
                        </div> <!-- / .row -->

                        <!-- Button -->
                        <button type="submit" class="btn btn-primary mt-3">
                            Log in
                        </button>
                    </form>
                </div>

                <div class="mt-auto">

                    <!-- Link -->
                    <!-- {{-- <small class="mb-0 text-muted">
                        Don't have an account yet? <a href="./sign-up-cover.html" class="fw-semibold">Sign up</a>
                    </small> --}} -->
                </div>

            </div>

            <div class="col-md-5 col-lg-6 d-none d-lg-block">

                <!-- Image -->
                <div class="bg-size-cover bg-position-center bg-repeat-no-repeat overlay overlay-dark overlay-50 vh-100 me-n4"
                    style="background-image: url({{ asset('assets/styles/css/login/bg.jpeg') }});">
                </div>
            </div>
        </div> <!-- / .row -->
    </main> <!-- / main -->

    <!-- JAVASCRIPT-->
    <!-- Theme JS -->
    <script src="https://dashly-theme.com/assets/js/theme.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('body').on('click', '.forget-password', function() {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.info("Mohon menghubungi admin untuk pergantian password");
            })
            @if (Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

</body>

</html>
