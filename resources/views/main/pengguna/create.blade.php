<div class="col-12">
    <form action="{{ route('pengguna.store') }}" method="POST" id="form">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Tambah Pengguna
                    </div>
                    <div class="col-6 d-flex align-items-center">
                        <div class="m-auto"></div>
                        <button type="button" class="btn btn-outline-primary btn-data">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Nama
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control nama" name="nama" id="nama"
                            placeholder="masukkan nama">
                        <div class="invalid-feedback error-nama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Username
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control username" name="username" id="username"
                            placeholder="masukkan username">
                        <div class="invalid-feedback error-nama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passsword" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Password
                    </label>
                    <div class="col-lg-11">
                        <p style="font-style: italic">Default password <b>"12345678"</b></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn  btn-primary m-1 btn-save">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{!! JsValidator::formRequest('App\Http\Requests\PenggunaRequest', '#form') !!}

<script>
    @if (session('status'))
        Swal.fire(
            "{{ session('title') }}",
            "{{ session('message') }}",
            "{{ session('status') }}",
        );
    @endif
</script>
