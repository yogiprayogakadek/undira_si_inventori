<div class="col-12">
    <form action="{{ route('produk.store') }}" method="POST" id="form">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Tambah Produk
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
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Stok
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control stok" name="stok" id="stok"
                            placeholder="masukkan stok">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Jenis Produk
                    </label>
                    <div class="col-lg-11">
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="Suplemen A">Suplemen A</option>
                            <option value="Suplemen B">Suplemen B</option>
                            <option value="Suplemen C">Suplemen C</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Keterangan" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Keterangan
                    </label>
                    <div class="col-lg-11">
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="masukkan keterangan"></textarea>
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

{!! JsValidator::formRequest('App\Http\Requests\ProdukRequest', '#form') !!}

<script>
    @if (session('status'))
        Swal.fire(
            "{{ session('title') }}",
            "{{ session('message') }}",
            "{{ session('status') }}",
        );
    @endif
</script>
