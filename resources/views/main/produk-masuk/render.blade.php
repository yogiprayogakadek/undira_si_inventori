<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Produk Masuk
                </div>
                {{-- @can('Admin')   --}}
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-add">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Tambah
                    </button>
                </div>
                {{-- @endcan --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Tanggal</th>
                    <th>Data Produk</th>
                    {{-- @can('Admin')   --}}
                    <th>Aksi</th>
                    {{-- @endcan --}}
                </thead>
                <tbody>
                    @foreach ($produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->supplier->nama }}</td>
                            <td>{{ date_format(date_create($produk->tanggal_proses), 'd-m-Y') }}</td>
                            <td>
                                <span class="badge badge-primary data-produk" data-id="{{ $produk->id }}"
                                    style="cursor: pointer;">Lihat</span>
                            </td>
                            {{-- @can('Admin')    --}}
                            <td>
                                <button class="btn btn-edit btn-default" data-id="{{ $produk->id }}">
                                    <i class="fa fa-eye text-success mr-2 pointer"></i> Edit
                                </button>
                                {{-- <button class="btn btn-validasi {{$produk->status == true ? 'btn-danger' : 'btn-info'}}" data-id="{{$produk->id}}">
                                <i class="fa {{$produk->status == true ? 'fa fa-ban' : 'fa-check-circle'}} text-success ml-2 pointer"></i> {{$produk->status == true ? 'Non-Aktifkan' : 'Aktifkan'}}
                            </button> --}}
                            </td>
                            {{-- @endcan --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalListProduk" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Produk</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-rounded">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="modalTableList">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

<script>
    var table = $('#tableData').DataTable({
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
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
        order: [
            [0, 'desc']
        ],
        "rowCallback": function(row, data, index) {
            // Set the row number as the first cell in each row
            $('td:eq(0)', row).html(index + 1);
        }
    });

    // Update row numbers when the table is sorted
    table.on('order.dt search.dt', function() {
        table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
</script>
