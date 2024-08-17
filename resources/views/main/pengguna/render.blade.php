<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Pengguna
                </div>
                {{-- @can('Admin')   --}}
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-success btn-print mr-2">
                        <i class="nav-icon i-Download-Window font-weight-bold"></i> Print
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-add">
                        <i class="nav-icon fa fa-plus font-weight-bold"></i> Tambah
                    </button>
                </div>
                {{-- @endcan --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Status</th>
                    {{-- @can('Admin')   --}}
                    <th>Aksi</th>
                    {{-- @endcan --}}
                </thead>
                <tbody>
                    @foreach ($pengguna as $pengguna)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="javascript:void(0)" class="forgot-password" data-id="{{ $pengguna->id }}"
                                    data-username="{{ $pengguna->nama }}" data-toggle="tooltip"
                                    title="Klik dua kali untuk mengubah kata sandi">
                                    {{ $pengguna->nama }}
                            </td>
                            <td>{{ $pengguna->username }}
                            </td>
                            <td>{{ $pengguna->level }}</td>
                            <td>{{ $pengguna->status == true ? 'Aktif' : 'Tidak Aktif' }}</td>
                            {{-- @can('Admin')    --}}
                            <td>
                                <button class="btn btn-edit btn-default" data-id="{{ $pengguna->id }}">
                                    <i class="fa fa-eye text-success mr-2 pointer"></i> Edit
                                </button>
                                {{-- <button class="btn btn-validasi {{$pengguna->status == true ? 'btn-danger' : 'btn-info'}}" data-id="{{$pengguna->id}}">
                                <i class="fa {{$pengguna->status == true ? 'fa fa-ban' : 'fa-check-circle'}} text-success ml-2 pointer"></i> {{$pengguna->status == true ? 'Non-Aktifkan' : 'Aktifkan'}}
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

{{-- Modal password --}}
<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">sm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUpdate">
                    <div class="form-group password mb-3">
                        <input type="text" id="user-id" name="user_id" class="form-control" hidden>
                        <label class="form-label" for="new_password">Password</label>
                        <input type="text" name="new_password" class="form-control new_password" id="new_password"
                            placeholder="masukkan password">
                        <div class="invalid-feedback error-new_password"></div>
                    </div>
                    <div class="form-group password">
                        <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                        <input type="text" name="confirm_password" class="form-control confirm_password"
                            id="confirm_password" placeholder="masukkan ulang password">
                        <div class="invalid-feedback error-confirm_password"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-outline btn-update-password mr-15">Simpan</button>
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

    $('.forgot-password').on('dblclick', function() {
        let username = $(this).data('username')
        let id = $(this).data('id')
        $('#password-modal').modal('show');
        $('#password-modal .modal-title').html('Ubah Kata Sandi - <strong>' + username +
            '</strong>');

        // set id
        $('#password-modal #user-id').val(id)
    });

    $("body").on("click", ".btn-update-password", function(e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let form = $("#formUpdate")[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "/pengguna/update-password",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $(".btn-update-password").html("Mohon tunggu...").prop('disabled',
                    true);
            },
            done: function() {
                $(".btn-update-password").html("Simpan").prop('disabled', false);
            },
            success: function(response) {
                Swal.fire(response.title, response.message, response.status);
                if (response.status == "success") {
                    $('#password-modal').modal('hide');
                }
            },
            error: function(error) {
                let formName = [];
                let errorName = [];

                $.each($("#formUpdate").serializeArray(), function(i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ""));
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function(key, value) {
                            console.log(value)
                            errorName.push(key);
                            $("#password-modal ." + key).addClass(
                                "is-invalid");
                            $("#password-modal .error-" + key).html(value);
                        });

                        $.each(formName, function(i, field) {
                            if ($.inArray(field, errorName) == -1) {
                                $("#password-modal ." + field).removeClass(
                                    "is-invalid");
                                // console.log(field)
                                $("#password-modal .error-" + field).html('');
                            } else {
                                $("#password-modal ." + field).addClass(
                                    "is-invalid");
                            }
                        });
                    }
                }
                $(".btn-update-password").html("Simpan").prop('disabled', false);
            },
        });
    });
</script>
