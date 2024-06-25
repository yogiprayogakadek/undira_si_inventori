<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PT. NUSANTARA PRIMA DJAYA</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <div class="not-found-wrap">
        <h1 class="text-60 text-center">
            Informasi
        </h1>
        <p class="text-36 subheading mb-3 text-center">Ganti password untuk melanjutkan!</p>

        <div class="row">
            <div class="col-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('change.password') }}" method="POST" id="form2">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Password Sekarang</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="current_password"
                                            id="current_password" placeholder="masukkan password sekarang"
                                            autocomplete="off" autofocus>
                                        <div class="input-group-append show-password" style="cursor: pointer">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Password Baru</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="new_password"
                                            id="new_password" placeholder="masukkan password baru" autocomplete="off"
                                            autofocus>
                                        <div class="input-group-append show-password" style="cursor: pointer">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Password Konfirmasi</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="confirm_password"
                                            id="confirm_password" placeholder="masukkan password konfirmasi"
                                            autocomplete="off" autofocus>
                                        <div class="input-group-append show-password" style="cursor: pointer">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/common-bundle-script.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/sidebar.large.script.js') }}"></script>
<script src="{{ asset('assets/js/customizer.script.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.1/dist/sweetalert2.all.min.js"></script>

{!! JsValidator::formRequest('App\Http\Requests\UpdatePasswordRequest', '#form2') !!}
<script>
    @if (session('status'))
        Swal.fire(
            "{{ session('title') }}",
            "{{ session('message') }}",
            "{{ session('status') }}",
        );
    @endif
    // show hide password
    $('.show-password').on('click', function() {
        var $passwordInput = $(this).closest('.input-group').find('input[type="password"]');
        var $textInput = $(this).closest('.input-group').find('input[type="text"]');
        var $icon = $(this).find('i');

        if ($passwordInput.attr('type') === 'password') {
            $passwordInput.attr('type', 'text');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            console.log('as')
            $textInput.attr('type', 'password');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
</script>

</html>
