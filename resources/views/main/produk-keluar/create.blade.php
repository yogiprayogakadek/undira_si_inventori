<div class="col-12">
    <form id="formAdd">
        {{-- @csrf --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Tambah Produk Keluar
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
                {{-- <div class="form-group row">
                    <label for="nama" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Nama
                    </label>
                    <div class="col-lg-11">
                        <select name="supplier_id" id="supplier_id" class="form-control supplier-id">
                            @foreach ($supplier as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label for="tanggal_proses" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Tanggal
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control tanggal_proses" name="tanggal_proses"
                            id="tanggal_proses" placeholder="masukkan tanggal proses">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_customer" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Nama Customer
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control nama_customer" name="nama_customer" id="nama_customer"
                            placeholder="masukkan nama customer">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        No. Telp
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control no_telp" name="no_telp" id="no_telp"
                            placeholder="masukkan nomor telp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_pembayaran" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Jenis Pembayaran
                    </label>
                    <div class="col-lg-11">
                        <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control jenis_pembayaran">
                            <option value="">Pilih jenis pembayaran...</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bukti_pembayaran" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Bukti Pembayaran
                    </label>
                    <div class="col-lg-11">
                        <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran"
                            placeholder="masukkan bukti pembayaran" autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kondisi_pasien" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Kondisi Pasien
                    </label>
                    <div class="col-lg-11">
                        <textarea name="kondisi_pasien" id="kondisi_pasien" class="form-control" rows="6"
                            placeholder="keterangan kondisi pasien"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="btn-search" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">
                        Data Produk
                    </label>
                    <div class="col-lg-11">
                        <button type="button" class="btn btn-primary btn-search" id="btn-search">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        {{-- <h3 class="text-center">List Produk</h3> --}}
                        <table class="table table-bordered text-nowrap" id="produkTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Harga Jual</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Total Harga</th>
                                    {{-- <th width="5%"><button class="btn btn-sm btn-danger delete-all" disabled><i
                                                class="fa fa-trash"> Hapus Semua</i></button></th> --}}
                                    <th width='20%' class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td colspan="4">
                                        <h3><i>No data...</i></h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-save">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Produk</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-rounded">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="modalTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-temp" disabled="true">Save</button>
            </div>
        </div>
    </div>
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

    var currentDate = new Date();
    $('#tanggal_proses').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        endDate: "currentDate",
        maxDate: currentDate
    }).on('change', function(ev) {
        $(this).datepicker('hide');
    });
    $('#tanggal_proses').keyup(function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9^-]/g, '');
        }
    });
</script>
