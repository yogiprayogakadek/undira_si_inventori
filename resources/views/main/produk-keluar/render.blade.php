<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Produk Keluar
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-success btn-print mr-2">
                        <i class="nav-icon i-Download-Window font-weight-bold"></i> Print
                    </button>
                    @cannot('admin')
                        <button type="button" class="btn btn-outline-primary btn-add">
                            <i class="nav-icon fa fa-plus font-weight-bold"></i> Tambah
                        </button>
                    @endcannot
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Staff</th>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>No. Telp</th>
                    <th>Jenis Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Data Produk</th>
                    @cannot('admin')
                        <th>Aksi</th>
                    @endcannot
                </thead>
                <tbody>
                    @foreach ($produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->pengguna->nama }}</td>
                            <td>{{ date_format(date_create($produk->tanggal_proses), 'd-m-Y') }}</td>
                            <td>{{ $produk->nama_customer }}</td>
                            <td>{{ $produk->no_telp }}</td>
                            <td>{{ ucfirst($produk->jenis_pembayaran) }}</td>
                            <td>
                                <a href="{{ asset($produk->bukti_pembayaran) }}" target="_blank">Lihat bukti</a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn-kondisi"
                                    data-kondisi="{{ $produk->kondisi_pasien }}">Lihat</a>
                            </td>
                            <td>
                                <span class="badge badge-primary data-produk" data-id="{{ $produk->id }}"
                                    data-customer="{{ $produk->nama_customer }}" data-telp="{{ $produk->no_telp }}"
                                    style="cursor: pointer;">Lihat</span>
                            </td>
                            @cannot('admin')
                                <td>
                                    @if (auth()->user()->id == $produk->pengguna_id)
                                        <button class="btn btn-edit btn-default" data-id="{{ $produk->id }}">
                                            <i class="fa fa-eye text-success mr-2 pointer"></i> Edit
                                        </button>
                                    @else
                                        <span class="text-muted text-small" style="font-style: italic;">tidak ada hak
                                            akses</span>
                                    @endif
                                </td>
                            @endcannot
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
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-rounded">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-3">Nama Customer</div>
                    <div class="col-7 nama-customer"></div>

                    <div class="col-3">No. Telp</div>
                    <div class="col-7 no-telp"></div>
                </div>
                <table class="table table-bordered" id="modalTableList">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga Jual</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total Harga</th>
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

{{-- Filter Modal & Print Modal --}}
<div class="modal fade" id="print-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Data</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-rounded">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="kondisi"></div>
                <div class="range-date">
                    <div class="form-group" id="tanggal-awal">
                        <label class="control-label mb-10">Tanggal Awal</label>
                        <input type="date" class="form-control tanggal-awal form-validation" name="tanggal_awal">
                        <div class="invalid-feedback error-tanggal-awal"></div>
                    </div>
                    <div class="form-group" id="tangal-akhir">
                        <label class="control-label mb-10">Tanggal Akhir</label>
                        <input type="date" class="form-control tanggal-akhir form-validation" name="tanggal_akhir">
                        <div class="invalid-feedback error-tanggal-akhir"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-outline btn-print-data">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

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

    $('body').on('click', '.btn-kondisi', function() {
        $('#print-modal').modal('show')
        $('#print-modal .kondisi').show()
        $('#print-modal .range-date').hide()
        $('#print-modal .modal-title').text('Keterangan');
        $('#print-modal .kondisi').html('<span>' + $(this).data('kondisi') + '</span>')
        $('.btn-search').hide()
        $('.btn-print-data').hide()
    });

    $('body').on('click', '.btn-print', function() {
        $('#print-modal').modal('show')
        $('#print-modal .modal-title').text('Print Data');
        $('#print-modal .kondisi').hide()
        $('#print-modal .range-date').show()
        $('.btn-search').show()
        $('.btn-print-data').show()
        $('.btn-print-data').prop('disabled', true)

        $('.tanggal-awal, .tanggal-akhir').val('');
    });

    function validateField(fieldClass, errorClass, errorMessage) {
        const value = $(fieldClass).val();
        const formGroup = $(fieldClass).closest('.form-validation');
        // const errorElement = formGroup.(errorClass);

        if (value === '') {
            formGroup.addClass('is-invalid');
            // console.log(errorElement)
            $(errorClass).text(errorMessage);
        } else {
            formGroup.removeClass('is-invalid');
            $(errorClass).text('');
            // errorElement.text('');
        }
    }

    function validateDates() {
        const tanggalAwal = $('.tanggal-awal').val();
        const tanggalAkhir = $('.tanggal-akhir').val();

        let title = $('#filter-modal .modal-title').text();
        let $button = title == 'Filter Data' ? $('.btn-search') : $('.btn-print-data');
        $button.prop('disabled', !tanggalAwal || !tanggalAkhir);

        // Validasi individual tanggal
        validateField('.tanggal-awal', '.error-tanggal-awal', 'Mohon isi tanggal awal');
        validateField('.tanggal-akhir', '.error-tanggal-akhir', 'Mohon isi tanggal akhir');

        // Validasi bahwa tanggal akhir tidak sebelum tanggal awal
        if (tanggalAwal && tanggalAkhir) {
            const dateAwal = new Date(tanggalAwal);
            const dateAkhir = new Date(tanggalAkhir);
            console.log(dateAkhir)
            if (dateAkhir < dateAwal) {
                console.log('salah')
                $('.tanggal-akhir').addClass('is-invalid');
                $('.error-tanggal-akhir').text('Tanggal akhir tidak boleh kurang dari tanggal awal');
                $('.btn-print-data').prop('disabled', true);
            } else {
                console.log('benar')
                $('.tanggal-akhir').removeClass('is-invalid');
                $('.error-tanggal-akhir').text('');
            }
        }
    }
    $('.tanggal-awal, .tanggal-akhir').on('change', validateDates);
</script>
