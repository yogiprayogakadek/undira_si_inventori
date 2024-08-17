<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Produk
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-success btn-print mr-2">
                        <i class="nav-icon i-Download-Window font-weight-bold"></i> Print
                    </button>
                    @can('admin')
                        <button type="button" class="btn btn-outline-primary btn-add">
                            <i class="nav-icon fa fa-plus font-weight-bold"></i> Tambah
                        </button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama Produk</th>
                    @can('admin')
                        <th>Harga Beli</th>
                    @endcan
                    <th>Harga Jual</th>
                    @can('admin')
                        <th>Stok</th>
                    @endcan
                    {{-- <th>Jenis Produk</th> --}}
                    <th>Foto Produk</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    @can('admin')
                        <th>Aksi</th>
                    @endcan
                </thead>
                <tbody>
                    @foreach ($produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->nama }}</td>
                            @can('admin')
                                <td>{{ 'Rp ' . number_format($produk->harga_beli, 0, '.', '.') }}</td>
                            @endcan
                            <td>{{ 'Rp ' . number_format($produk->harga_jual, 0, '.', '.') }}</td>
                            @can('admin')
                                <td>{{ $produk->stok }}</td>
                            @endcan
                            {{-- <td>{{ $produk->jenis }}</td> --}}
                            {{-- <td>
                                <img src="{{ asset($produk->foto) }}" width="100px">
                            </td> --}}
                            <td>
                                <a href="{{ asset($produk->foto) }}" target="_blank">Lihat foto</a>
                            </td>
                            <td>{{ $produk->keterangan }}</td>
                            <td>{{ $produk->status == true ? 'Aktif' : 'Tidak Aktif' }}</td>
                            @can('admin')
                                <td>
                                    <button class="btn btn-edit btn-default" data-id="{{ $produk->id }}">
                                        <i class="fa fa-eye text-success mr-2 pointer"></i> Edit
                                    </button>
                                    {{-- <button class="btn btn-validasi {{$produk->status == true ? 'btn-danger' : 'btn-info'}}" data-id="{{$produk->id}}">
                                <i class="fa {{$produk->status == true ? 'fa fa-ban' : 'fa-check-circle'}} text-success ml-2 pointer"></i> {{$produk->status == true ? 'Non-Aktifkan' : 'Aktifkan'}}
                            </button> --}}
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
