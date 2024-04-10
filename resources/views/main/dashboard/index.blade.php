@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-4 div-preview-profil mx-auto">
            <div class="card card-profile-1 mb-4">
                <div class="card-body text-center">
                    <div class="avatar box-shadow-2 mb-3">
                        <img src="{{ asset('assets/uploads/users/default.png') }}" alt="">
                    </div>
                    <h5 class="m-0">{{ ucfirst(auth()->user()->nama) }}</h5>
                    <p class="mt-0"><small>{{ auth()->user()->level }}</small></p>
                    <div class="row text-left">
                        <div class="col-3">
                            Nama
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-8">{{ auth()->user()->nama }}</div>

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

        <div class="col-8 div-profil" hidden>
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

        <div class="col-8 div-password" hidden>
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
                            <input type="password" class="form-control" name="current_password" id="current_password"
                                placeholder="masukkan password sekarang" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Password Baru</label>
                            <input type="password" class="form-control" name="new_password" id="new_password"
                                placeholder="masukkan password baru" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Password Konfirmasi</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                placeholder="masukkan password konfirmasi" autocomplete="off" autofocus>
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
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endpush
