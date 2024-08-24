<table class="table table-hover table-striped" id="tableData">
    <thead>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>Tanggal</th>
        <th>Jenis Pembayaran</th>
        <th>Bukti Pembayaran</th>
        {{-- <th>Data Produk</th> --}}
    </thead>
    <tbody>
        @foreach ($produk as $produk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $produk->supplier->nama }}</td>
                <td>{{ date_format(date_create($produk->tanggal_proses), 'd-m-Y') }}</td>
                <td>{{ ucfirst($produk->jenis_pembayaran) }}</td>
                <td>
                    <a href="{{ asset($produk->bukti_pembayaran) }}" target="_blank">Lihat bukti</a>
                </td>
                {{-- <td>
                    <span class="badge badge-primary data-produk" data-id="{{ $produk->id }}"
                        style="cursor: pointer;">Lihat</span>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

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
