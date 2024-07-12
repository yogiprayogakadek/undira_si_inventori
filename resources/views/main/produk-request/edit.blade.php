<div class="col-12">
    <form id="formEdit">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Ubah Request Produk
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
                <input type="hidden" name="produk_request_id" id="produk_request_id"
                    class="form-control produk-keluar-id" value="{{ $req->id }}">
                <div class="form-group row">
                    <label for="tanggal_request" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                        Tanggal
                    </label>
                    <div class="col-lg-11">
                        <input type="text" class="form-control tanggal_request" name="tanggal_request"
                            id="tanggal_request" placeholder="masukkan tanggal request"
                            value="{{ date_format(date_create($req->tanggal_request), 'm/d/Y') }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="btn-search" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">
                        List Produk
                    </label>
                    <div class="col-lg-11">
                        {{-- <button type="button" class="btn btn-primary btn-search" id="btn-search">
                            <i class="fa fa-search"></i> Cari
                        </button> --}}

                        <table class="table table-bordered" id="modalTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $produk)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="checkbox-produk"
                                                {{ checkedData($req->data, $produk->id)['checked'] }}
                                                id="checkbox{{ $produk->id }}" name="list[]"
                                                data-id="{{ $produk->id }}" data-nama="{{ $produk->nama }}">
                                        </td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>
                                            <input class="form-control jumlah-produk"
                                                {{ checkedData($req->data, $produk->id)['checked'] == 'checked' ? '' : 'disabled' }}
                                                id="jumlah-produk{{ $produk->id }}" data-id="{{ $produk->id }}"
                                                data-stok="{{ $produk->stok }}" name="jumlah-produk[]"
                                                value="{{ checkedData($req->data, $produk->id, 'jumlah')['data'] }}">
                                            <div class="invalid-feedback error-jumlah-{{ $produk->id }}"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label for="btn-search" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">
                        Data Produk
                    </label>
                    <div class="col-lg-11">
                        <button type="button" class="btn btn-primary btn-search" id="btn-search">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div> --}}
                <div class="form-group row" hidden>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        {{-- <h3 class="text-center">List Produk</h3> --}}
                        <table class="table table-bordered text-nowrap" id="produkTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th width='20%' class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($req->data, true) as $item)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration }}</td>
                                        <td>{{ $item['namaProduk'] }}</td>
                                        <td>{{ $item['jumlah'] }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-delete-temp"
                                                data-id="{{ $item['produkId'] }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-update btn-send">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
{{-- <div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                            <th>Stok</th>
                            <th>Jumlah</th>
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
</div> --}}

<script>
    @if (session('status'))
        Swal.fire(
            "{{ session('title') }}",
            "{{ session('message') }}",
            "{{ session('status') }}",
        );
    @endif

    var table = $('#modalTable').DataTable({
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            },
            info: "Showing _START_ to _END_ from _TOTAL_ data",
            infoEmpty: "Showing 0 to 0 from 0 data",
            lengthMenu: "Showing _MENU_ data",
            search: "Search:",
            emptyTable: "Data doesn't exists",
            zeroRecords: "Data doesn't match",
            loadingRecords: "Loading..",
            processing: "Processing...",
            infoFiltered: "(filtered from _MAX_ total data)"
        },
        lengthMenu: [
            [100, 200, 300, 400, -1],
            [100, 200, 300, 400, "All"]
        ],
        // order: [
        //     [0, 'desc']
        // ],
        // "rowCallback": function(row, data, index) {
        //     // Set the row number as the first cell in each row
        //     $('td:eq(0)', row).html(index + 1);
        // }
    });

    // var currentDate = new Date();
    // $('#tanggal_request').datepicker({
    //     format: 'mm/dd/yyyy',
    //     autoclose: true,
    //     endDate: "currentDate",
    //     maxDate: currentDate
    // }).on('changeDate', function(ev) {
    //     $(this).datepicker('hide');
    // });
    // $('#tanggal_request').keyup(function() {
    //     if (this.value.match(/[^0-9]/g)) {
    //         this.value = this.value.replace(/[^0-9^-]/g, '');
    //     }
    // });
</script>
