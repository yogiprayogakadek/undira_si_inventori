function getData() {
    localStorage.clear()
    $.ajax({
        type: "get",
        url: "/produk-request/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/produk-request/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function getTempData() {
    $('#produkTable tbody').empty()
    if(localStorage.length == 0 || JSON.parse(localStorage.getItem('listProduk'))[0]['data'].length == 0){
        let tr_list = '<tr class="text-center">' +
            '<td colspan="4">' +
                '<h3><i>No data...</i></h3>'+
            '</td>' +
        '</tr>';
        $('#produkTable tbody').append(tr_list);
    } else {
        let jsonData = JSON.parse(localStorage.getItem('listProduk'))[0]['data'];
        $.each(jsonData, function (index, value) {
            let tr_list = '<tr>' +
                '<td width="5%">' + (index+1) + '</td>' +
                '<td>' + value.namaProduk + '</td>' +
                '<td>' + value.jumlah + '</td>' +
                '<td class="text-center">' + '<button type="button" class="btn btn-danger btn-delete-temp" data-id="'+value.produkId+'"><i class="fa fa-trash"></i></button>' + '</td>' +
            '</tr>';
            $('#produkTable tbody').append(tr_list);
        });
    }
}

function getProdukIdIndex(produkId) {
    // Get the stored data from localStorage
    const storedData = localStorage.getItem('listProduk');

    // If there's no stored data, return -1
    if (!storedData) {
      return -1;
    }

    // Parse the stored data into a JavaScript object
    const parsedData = JSON.parse(storedData);

    // Iterate over the data array and check if the produkId exists
    for (let i = 0; i < parsedData[0].data.length; i++) {
      if (parsedData[0].data[i].produkId === produkId) {
        return i; // Return the index where produkId is found
      }
    }

    return -1; // produkId not found
  }

  function removeDataFromLocalStorage(produkId) {
    // Get the stored data from localStorage
    const storedData = localStorage.getItem('listProduk');

    // If there's no stored data, return
    if (!storedData) {
      return;
    }

    // Parse the stored data into a JavaScript object
    const parsedData = JSON.parse(storedData);

    // Find the index of the produkId in the data array
    const produkIdIndex = getProdukIdIndex(produkId);

    if (produkIdIndex !== -1) {
      // Remove the object from the data array
      parsedData[0].data.splice(produkIdIndex, 1);

      // Convert the updated data back to a string and store it in localStorage
      const updatedData = JSON.stringify(parsedData);
      localStorage.setItem('listProduk', updatedData);
    }
  }

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-add', function () {
        tambah();
        setTimeout(() => {
            getTempData()
        }, 1000);
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.btn-edit', function () {
        localStorage.clear();
        let id = $(this).data('id')
        let listProduk = localStorage.getItem('listProduk') ? JSON.parse(localStorage.getItem(
            'listProduk')) : [];
        let dataArray = listProduk && Array.isArray(listProduk) ? listProduk : [];
        let tempData = {
            'data': []
        };
        $.ajax({
            type: "get",
            url: "/produk-request/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);

                $.each(response.produk, function (index, value) {
                    let data = {
                        'jumlah': parseInt(value.jumlah),
                        'produkId': parseInt(value.produkId),
                        'namaProduk': value.namaProduk,
                    };

                    tempData.data.push(data);
                });

                dataArray.push(tempData);

                // Update the listProduk in localStorage
                localStorage.setItem('listProduk', JSON.stringify(dataArray));
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on save button
    $("body").on("click", ".btn-save", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let tanggal_proses = $('input[name=tanggal_proses]').val();
        if(tanggal_proses == '' || localStorage.length == 0 || JSON.parse(localStorage.getItem('listProduk'))[0]['data'].length == 0) {
            Swal.fire('Warning', 'Mohon untuk melengkapi form', 'error');
        } else {
            $.ajax({
                type: "POST",
                url: "/produk-request/store",
                data: {
                    'tanggal_proses': tanggal_proses,
                    'list_produk': localStorage.getItem('listProduk'),
                    'supplier_id': $('#supplier_id').find(":selected").val(),
                },
                // data: data,
                // processData: false,
                // contentType: false,
                // cache: false,
                beforeSend: function () {
                    $(".btn-save").attr("disable", "disabled");
                    $(".btn-save").html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function () {
                    $(".btn-save").removeAttr("disable");
                    $(".btn-save").html("Simpan");
                },
                success: function (response) {
                    $("#formAdd").trigger("reset");
                    $(".invalid-feedback").html("");
                    Swal.fire(response.title, response.message, response.status);
                    getData();
                    localStorage.clear()
                },
                error: function (error) {
                    //
                },
            });
        }
    });

    // on update button
    $("body").on("click", ".btn-update", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let tanggal_proses = $('input[name=tanggal_proses]').val();
        if(tanggal_proses == '' || localStorage.length == 0 || JSON.parse(localStorage.getItem('listProduk'))[0]['data'].length == 0) {
            Swal.fire('Warning', 'Mohon untuk melengkapi form', 'error');
        } else {
            $.ajax({
                type: "POST",
                url: "/produk-request/update",
                data: {
                    'tanggal_proses': tanggal_proses,
                    'list_produk': localStorage.getItem('listProduk'),
                    'produk_request_id': $('input[name=produk_request_id]').val(),
                    'supplier_id': $('#supplier_id').find(":selected").val(),
                    // 'produk_request_id': $('input[name=produk_masuk_id]').val(),
                },
                // data: data,
                // processData: false,
                // contentType: false,
                // cache: false,
                beforeSend: function () {
                    $(".btn-update").attr("disable", "disabled");
                    $(".btn-update").html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function () {
                    $(".btn-update").removeAttr("disable");
                    $(".btn-update").html("Simpan");
                },
                success: function (response) {
                    $("#formEdit").trigger("reset");
                    $(".invalid-feedback").html("");
                    Swal.fire(response.title, response.message, response.status);
                    getData();
                    localStorage.clear()
                },
                error: function (error) {
                    //
                },
            });
        }
    });

    // $('body').on('click', '.btn-search', function() {
    //     $('#modalProduk').modal('show')
    //     $('#modalTable tbody').empty();

    //     $.get("/produk-request/list-produk", function (data) {
    //         $.each(data, function (index, value) {
    //             let tr_list = '<tr>' +
    //                 '<td class="text-center"> '+ '<input type="checkbox" class="checkbox-secondary checkbox-produk" id="checkbox '+value.id+'" name="list[]" data-id="'+value.id+'" data-nama="'+value.nama+'">' +' </td>' +
    //                 '<td> '+ value.nama +' </td>' +
    //                 '<td class="text-center"> '+ value.stok +' </td>' +
    //                 '<td> '+ '<input class="form-control jumlah-produk" disabled=true id="jumlah-produk'+value.id+'" data-id="'+value.id+'" data-stok="'+value.stok+'" name="jumlah-produk[]"><div class="invalid-feedback error-jumlah-'+value.id+'"></div>' +' </td>' +
    //             '</tr>';

    //             $('#modalTable tbody').append(tr_list);
    //         });
    //     });

    // });

    $('body').on('click', '.btn-search', function() {
        $('#modalProduk').modal('show');
        // $('#modalTable').DataTable();
        $('#modalTable tbody').empty();
        if($('body').find('.is-invalid').length === 0) {
            $('.btn-temp').attr('disabled', false)
        } else {
            $('.btn-temp').attr('disabled', true)
        }

        $.get("/produk-request/list-produk", function(data) {
          $.each(data, function(index, value) {
            let tr_list = '<tr>' +
              '<td class="text-center"> ' +
              '<input type="checkbox" class="checkbox-secondary checkbox-produk" id="checkbox' + value.id + '" name="list[]" data-id="' + value.id + '" data-nama="' + value.nama + '">' +
              '</td>' +
              '<td> ' + value.nama + ' </td>' +
              '<td class="text-center"> ' + value.stok + ' </td>' +
              '<td> ' +
              '<input class="form-control jumlah-produk" disabled=true id="jumlah-produk' + value.id + '" data-id="' + value.id + '" data-stok="' + value.stok + '" name="jumlah-produk[]"><div class="invalid-feedback error-jumlah-' + value.id + '"></div>' +
              '</td>' +
              '</tr>';
            $('#modalTable tbody').append(tr_list);

            // Call the getProdukIdIndex function and fill the jumlah-produk input
            const produkId = value.id;
            const jumlahProdukInput = $('#jumlah-produk' + produkId);
            const produkIdIndex = getProdukIdIndex(produkId);

            if (produkIdIndex !== -1) {
              // produkId found in localStorage
              const storedData = localStorage.getItem('listProduk');
              const parsedData = JSON.parse(storedData);
              const foundData = parsedData[0].data[produkIdIndex];

              // Fill the jumlah-produk input with the jumlah value from localStorage
              jumlahProdukInput.val(foundData.jumlah);
              jumlahProdukInput.prop('disabled', false);
              $("#checkbox"+produkId).prop('checked', true);
            } else {
              // produkId not found in localStorage
              jumlahProdukInput.val('');
              jumlahProdukInput.prop('disabled', true);
              $("#checkbox"+produkId).prop('checked', false);
            }
          });
        });
    });

    $('body').on('click', '.checkbox-produk', function() {
        let value = $(this).is( ":checked" );
        let id = $(this).data('id');

        if(value == true){
            $('#jumlah-produk'+id).prop('disabled', false);

            $('#jumlah-produk'+id).addClass('is-invalid');
            $('.error-jumlah-'+id).html('mohon isi jumlah produk')
            $('.btn-temp').attr('disabled', true)
        } else {
            $('#jumlah-produk'+id).prop('disabled', true);

            $('#jumlah-produk'+id).removeClass('is-invalid');
            $('.error-jumlah-'+id).html('')
            $('.btn-temp').attr('disabled', false)
        }

        if($('body').find('.is-invalid').length) {
            $('.btn-temp').attr('disabled', true)
        }

        if($('input:checkbox:checked').length == 0) {
            $('.btn-temp').attr('disabled', true)
        }
    })

    $('body').on('keyup', '.jumlah-produk', function() {
        let id = $(this).data('id');
        let jumlah = parseInt($(this).val());
        let stok = parseInt($(this).data('stok'))
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if(isNaN(jumlah) || jumlah === '') {
            $('#jumlah-produk'+id).addClass('is-invalid');
            $('.error-jumlah-'+id).html('mohon isi jumlah produk')
            $('.btn-temp').attr('disabled', true)
        } else {
            $('#jumlah-produk'+id).removeClass('is-invalid');
            $('.error-jumlah-'+id).html('')
            $('.btn-temp').attr('disabled', false)
        }
    })

    $('body').on('click', '.btn-temp', function() {
        localStorage.clear()
        // Retrieve existing listProduk from localStorage or create an empty array
        let listProduk = localStorage.getItem('listProduk') ? JSON.parse(localStorage.getItem(
            'listProduk')) : [];
        let dataArray = listProduk && Array.isArray(listProduk) ? listProduk : [];

        let tempData = {
            'data': []
        };

        $('.checkbox-produk:checked').each(function() {
            let jumlah = $(this).closest('tr').find('input.jumlah-produk').val();
            let produkId = $(this).data('id');
            let namaProduk = $(this).data('nama');

            let data = {
                'jumlah': parseInt(jumlah),
                'produkId': parseInt(produkId),
                'namaProduk': namaProduk,
            };

            tempData.data.push(data);
        });

        dataArray.push(tempData);

        // Update the listProduk in localStorage
        localStorage.setItem('listProduk', JSON.stringify(dataArray));

        $('#modalProduk').modal('hide');
        Swal.fire('Info', 'Data disimpan', 'success');
        getTempData()
    });

    $('body').on('click', '.btn-delete-temp', function() {
        const produkId = $(this).data('id');
        Swal.fire({
            title: "Hapus data ini?",
            text: "data akan dihapus",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
        }).then((result) => {
            if (result.value) {
                removeDataFromLocalStorage(produkId);
                Swal.fire('Info', 'Data dihapus', 'success');
                getTempData()
            }
        });
    });

    $('body').on('click', '.data-produk', function() {
        $('#modalListProduk').modal('show');
        $('#modalTableList tbody').empty();
        let id = $(this).data('id');
        $.get("/produk-request/data-produk-request/"+id, function(data) {
          $.each(data, function(index, value) {
            let tr_list = '<tr>' +
              '<td> ' + (index+1) + ' </td>' +
              '<td> ' + value.namaProduk + ' </td>' +
              '<td class="text-center"> ' + value.jumlah + ' </td>' +
              '</tr>';
            $('#modalTableList tbody').append(tr_list);
          });
        });
    });

    $('body').on('change', '.status', function() {
        let id = $(this).data('id');
        let currentStatus = $(this).data('status');
        let status = $(this).find(":selected").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        Swal.fire({
            title: "Validasi data ini?",
            text: "status akan diubah",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, validasi!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/produk-request/update-status",
                    data: {
                        'id': id,
                        'status': status
                    },
                    success: function (response) {
                        Swal.fire(response.title, response.message, response.status);
                        getData();
                    },
                    error: function (error) {
                        //
                    },
                });
            } else {
                $(this).val(currentStatus)
            }
        });
    });

    // print data
    $("body").on("click", ".btn-print", function() {
        // let tanggalAwal = $('.tanggal-awal').val();
        // let tanggalAkhir = $('.tanggal-akhir').val();
        // let kategori = $('#kategori').val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        Swal.fire({
            title: "Cetak data produk request?",
            // text: "Laporan akan dicetak",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, cetak!",
        }).then((result) => {
            if (result.value) {
                var mode = "iframe"; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close,
                    popTitle: "LaporanProdukRequest",
                    popOrient: "Portrait",
                };
                $.ajax({
                    type: "POST",
                    url: "/produk-request/print",
                    // data: {
                    //     tanggal_awal: tanggalAwal,
                    //     tanggal_akhir: tanggalAkhir,
                    //     kategori: kategori
                    // },
                    success: function(response) {
                        document.title =
                            "SIM Rekam Medis | RSD Mangusada - Print" +
                            new Date().toJSON().slice(0, 10).replace(/-/g, "/");
                        $(response.data)
                            .find("div.printableArea")
                            .printArea(options);
                    },
                });
            }
        });
    });
});
