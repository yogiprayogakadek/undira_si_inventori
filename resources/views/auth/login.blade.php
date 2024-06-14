<!doctype html>
<html lang="en">

<head>
    <title>PT. NUSANTARA PRIMA DJAYA</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" sizes="any">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/login-form-14/css/style.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <section style="margin-top: 3em">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h2 class="heading-section">
                        <img src="{{ asset('assets/images/logo.png') }}" style="width: 150px">
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img"
                            style="background-image: url(https://asset.kompas.com/crops/mOKFrYHlSTM6SEt4aD9PIXZnJE0=/0x5:593x400/750x500/data/photo/2020/03/16/5e6ee88f78835.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                            </div>
                            <form role="form" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" name="username" id="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Username" value="{{ old('username') }}">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control  @error('password') is-invalid @enderror"
                                        placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        {{-- <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label> --}}
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="javascript::void(0)" class="forget-password">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            {{-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://preview.colorlib.com/theme/bootstrap/login-form-14/js/jquery.min.js"></script>
    <script src="https://preview.colorlib.com/theme/bootstrap/login-form-14/js/popper.js"></script>
    <script src="https://preview.colorlib.com/theme/bootstrap/login-form-14/js/bootstrap.min.js"></script>
    <script src="https://preview.colorlib.com/theme/bootstrap/login-form-14/js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"893cdb541b906d1a","b":1,"version":"2024.4.1","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
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
