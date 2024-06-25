@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    <div class="row">
        @can('staff')
            <div class="col-5 div-preview-profil mx-auto">
                <div class="card card-profile-1 mb-4">
                    <div class="card-body text-center">
                        <div class="avatar box-shadow-2 mb-3">
                            <img src="{{ asset('assets/uploads/users/default.png') }}" alt="">
                        </div>
                        <h5 class="m-0">{{ ucfirst(auth()->user()->nama) }}</h5>
                        <p class="mt-0"><small>{{ auth()->user()->level }}</small></p>
                        <div class="row text-left">
                            <div class="col-4">
                                Nama
                            </div>
                            <div class="col-8">: {{ auth()->user()->nama }}</div>

                            {{-- <div class="col-3">
                            Tempat/Tanggal Lahir
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-8">{{ $pegawai->tempat_lahir }}/{{ $pegawai->tanggal_lahir }}</div>

                        <div class="col-3">
                            Jenis Kelamin
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-8">{{ $pegawai->jenis_kelamin }}</div> --}}
                        </div>

                        <button class="btn btn-primary btn-rounded mt-3 mr-2 btn-password">Update Password</button>
                        <button class="btn btn-success btn-rounded mt-3 btn-profil">Update Profil</button>
                    </div>
                </div>
            </div>
            <div class="col-7 div-profil" hidden>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Update Profil</h4>
                        </div>
                    </div>
                    <form action="{{ route('dashboard.update.profil') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="masukkan nama" value="{{ auth()->user()->nama }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <button class="btn btn-danger btn-cancel-profil" type="button">Batal</button>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-7 div-password" hidden>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Update Password</h4>
                        </div>
                    </div>
                    <form action="{{ route('dashboard.update.password') }}" method="POST" id="form2">
                        @csrf
                        <div class="card-body">
                            {{-- <input type="hidden" name="update_password" id="update_password" value="update-password"
                            class="form-control"> --}}
                            <div class="form-group">
                                <label for="">Password Sekarang</label>
                                {{-- <input type="password" class="form-control" name="current_password" id="current_password"
                                    placeholder="masukkan password sekarang" autocomplete="off" autofocus> --}}

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="current_password" id="current_password"
                                        placeholder="masukkan password sekarang" autocomplete="off" autofocus>
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
                                    <input type="password" class="form-control" name="new_password" id="new_password"
                                        placeholder="masukkan password baru" autocomplete="off" autofocus>
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
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                        placeholder="masukkan password konfirmasi" autocomplete="off" autofocus>
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
                                <button class="btn btn-danger btn-cancel-password" type="button">Batal</button>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endcan

        @can('admin')
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            {{-- <div class="col-4"></div> --}}
                            <div class="col-4">
                                <div class="form-group" id="tanggal-awal">
                                    <label class="control-label mb-10">Tanggal Awal</label>
                                    <input type="date" class="form-control tanggal-awal form-validation"
                                        name="tanggal_awal">
                                    <div class="invalid-feedback error-tanggal-awal"></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group" id="tangal-akhir">
                                    <label class="control-label mb-10">Tanggal Akhir</label>
                                    <input type="date" class="form-control tanggal-akhir form-validation"
                                        name="tanggal_akhir">
                                    <div class="invalid-feedback error-tanggal-akhir"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div id="main" style="width: 100%;height:600px;">
                            <h1>Selamat Datang, {{ ucfirst(auth()->user()->nama) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.pointer', function() {
                window.location = '/' + $(this).data('href');
            });
        });
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\UpdateProfilRequest', '#form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\UpdatePasswordRequest', '#form2') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <script>
        $(document).ready(function() {
            localStorage.setItem('role', "{{ auth()->user()->level }}")
            @if (session('status'))
                Swal.fire(
                    "{{ session('title') }}",
                    "{{ session('message') }}",
                    "{{ session('status') }}",
                );
            @endif

            $('body').on('click', '.btn-profil', function() {
                $('.div-profil-preview').removeClass('mx-auto');
                $('.div-profil').prop('hidden', false)
                $('.div-password').prop('hidden', true)
            });

            $('body').on('click', '.btn-cancel-profil', function() {
                $('.div-profil-preview').addClass('mx-auto');
                $('.div-profil').prop('hidden', true)
                $('.div-password').prop('hidden', true)
            });

            $('body').on('click', '.btn-password', function() {
                $('.div-profil-preview').removeClass('mx-auto');
                $('.div-profil').prop('hidden', true)
                $('.div-password').prop('hidden', false)
            });

            $('body').on('click', '.btn-cancel-password', function() {
                $('.div-profil-preview').addClass('mx-auto');
                $('.div-profil').prop('hidden', true)
                $('.div-password').prop('hidden', true)
            });


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

            @can('admin')
                function validateField(fieldClass, errorClass, errorMessage) {
                    const value = $(fieldClass).val();
                    const formGroup = $(fieldClass).closest('.form-validation');
                    // const errorElement = formGroup.(errorClass);

                    if (value === '') {
                        formGroup.addClass('is-invalid');
                        // console.log(errorElement)
                        $(errorClass).text(errorMessage);
                    } else {
                        formGroup.removeClass('is-invalid');
                        $(errorClass).text('');
                        // errorElement.text('');
                    }
                }

                function validateDates() {
                    const tanggalAwal = $('.tanggal-awal').val();
                    const tanggalAkhir = $('.tanggal-akhir').val();

                    let title = $('#filter-modal .modal-title').text();
                    let $button = title == 'Filter Data' ? $('.btn-search') : $('.btn-print-data');
                    $button.prop('disabled', !tanggalAwal || !tanggalAkhir);

                    // Validasi individual tanggal
                    validateField('.tanggal-awal', '.error-tanggal-awal', 'Mohon isi tanggal awal');
                    validateField('.tanggal-akhir', '.error-tanggal-akhir', 'Mohon isi tanggal akhir');

                    // Validasi bahwa tanggal akhir tidak sebelum tanggal awal
                    if (tanggalAwal && tanggalAkhir) {
                        const dateAwal = new Date(tanggalAwal);
                        const dateAkhir = new Date(tanggalAkhir);
                        console.log(dateAkhir)
                        if (dateAkhir < dateAwal) {
                            $('.tanggal-akhir').addClass('is-invalid');
                            $('.error-tanggal-akhir').text('Tanggal akhir tidak boleh kurang dari tanggal awal');
                            $('.btn-print-data').prop('disabled', true);
                        } else {
                            $('.tanggal-akhir').removeClass('is-invalid');
                            $('.error-tanggal-akhir').text('');

                            // get data
                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                },
                            });

                            $.ajax({
                                type: "POST",
                                url: "/dashboard/chart",
                                data: {
                                    'tanggal_awal': tanggalAwal,
                                    'tanggal_akhir': tanggalAkhir,
                                },
                                success: function(response) {
                                    // Initialize the echarts instance based on the prepared DOM
                                    var myChart = echarts.init(document.getElementById('main'));

                                    // Specify the configuration items and data for the chart
                                    var option = {
                                        series: [{
                                            type: 'pie',
                                            label: {
                                                show: true,
                                                formatter: '{b}: {c} ({d}%)' // {b}: name, {c}: value, {d}: percentage
                                            },
                                            data: response
                                        }]
                                    };

                                    // Display the chart using the configuration items and data just specified.
                                    myChart.setOption(option);
                                },
                                error: function(error) {
                                    //
                                },
                            });

                        }
                    }
                }

                $('.tanggal-awal, .tanggal-akhir').on('change', validateDates);
            @endcan
        });
    </script>
@endpush
