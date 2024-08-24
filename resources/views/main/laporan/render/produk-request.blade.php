<table class="table table-hover table-striped" id="tableData">
    <thead>
        <th>No</th>
        <th>Nama Staff</th>
        <th>Tanggal</th>
    </thead>
    <tbody>
        @foreach ($produk as $produk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $produk->staff->nama }}</td>
                <td>{{ date_format(date_create($produk->tanggal_request), 'd-m-Y') }}</td>
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
