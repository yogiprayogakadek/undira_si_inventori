<div class="col-12">
    <form action="{{ route('pengguna.update') }}" method="POST" id="form">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Ubah Pengguna
                    </div>
                    <div class="col-6 d-flex align-items-center">
                        <div class="m-auto"></div>
                        <button type="button" class="btn btn-outline-primary btn-data">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data
                        </button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="{{ $pengguna->id }}">
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Nama
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control nama" name="nama" id="nama"
                            placeholder="masukkan nama" value="{{ $pengguna->nama }}">
                        <div class="invalid-feedback error-nama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Username
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control username" name="username" id="username"
                            placeholder="masukkan username" value="{{ $pengguna->username }}">
                        <div class="invalid-feedback error-nama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Status
                    </label>
                    <div class="col-lg-11">
                        <select name="status" id="status" class="form-control status">
                            <option value="">Pilih status...</option>
                            <option value="1" {{ $pengguna->status == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $pengguna->status == '0' ? 'selected' : '' }}>Tidak aktif</option>
                        </select>
                        <div class="invalid-feedback error-status"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn  btn-primary m-1 btn-update">Simpan</button>
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
