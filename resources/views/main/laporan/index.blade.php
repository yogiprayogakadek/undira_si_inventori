@extends('templates.master')

@section('page-title', 'Laporan')
@section('page-sub-title', 'Data')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Laporan
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="m-auto"></div>
                            <button type="button" class="btn btn-outline-success btn-print mr-2">
                                <i class="nav-icon i-Download-Window font-weight-bold"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body render">
                    <h3 class="text-center">Silahkan pilih menu print untuk mencetak laporan atau menampilkan data</h3>
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
                        <div class="form-group" id="kategori">
                            <label class="control-label mb-10">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="Produk Masuk">Produk Masuk</option>
                                <option value="Produk Keluar">Produk Keluar</option>
                                <option value="Produk Request">Produk Request</option>
                            </select>
                            <div class="invalid-feedback error-kategori"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-outline btn-cek-data mr-2">Cek Data</button>
                        <button type="button" class="btn btn-primary btn-outline btn-print-data">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
    <script src="{{ asset('assets/function/laporan/main.js') }}"></script>
    <script>
        @if (session('status'))
            Swal.fire(
                "{{ session('title') }}",
                "{{ session('message') }}",
                "{{ session('status') }}",
            );
        @endif

        $('body').on('click', '.btn-cek-data', function() {
            let kategori = $('#kategori').find(":selected").val();
            let awal = $('.tanggal-awal').val();
            let akhir = $('.tanggal-akhir').val()

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            if (kategori == '' || awal == '' || akhir == '') {
                Swal.fire('Info', 'Mohon isi semua data!', 'error')
            } else {
                $.ajax({
                    type: "POST",
                    url: "/laporan/render",
                    data: {
                        kategori: kategori,
                        tanggal_awal: awal,
                        tanggal_akhir: akhir
                    },
                    success: function(response) {
                        $(".render").html(response.data);
                        $('#print-modal').modal('hide')
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.info(
                            "Untuk menampilkan data lengkap, silahkan pilih menu pada masing-masing data yang ingin ditampilkan"
                        );
                    },
                    error: function(error) {
                        console.log("Error", error);
                    },
                });
            }
        });


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
@endpush
