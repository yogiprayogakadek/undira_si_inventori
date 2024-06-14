function getData() {
    $.ajax({
        type: "get",
        url: "/produk/render",
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
        url: "/produk/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

// var rupiah = $("#harga");
// function convertToRupiah(number, prefix) {
//     var number_string = number.replace(/[^,\d]/g, "").toString(),
//         split = number_string.split(","),
//         remaining = split[0].length % 3,
//         rupiah = split[0].substr(0, remaining),
//         thousand = split[0].substr(remaining).match(/\d{3}/gi);

//     if (thousand) {
//         separator = remaining ? "." : "";
//         rupiah += separator + thousand.join(".");
//     }

//     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
//     return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
// }

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-add', function () {
        tambah();
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $.ajax({
            type: "get",
            url: "/produk/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
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
            title: "Cetak data produk?",
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
                    popTitle: "LaporanProduk",
                    popOrient: "Portrait",
                };
                $.ajax({
                    type: "POST",
                    url: "/produk/print",
                    // data: {
                    //     tanggal_awal: tanggalAwal,
                    //     tanggal_akhir: tanggalAkhir,
                    //     kategori: kategori
                    // },
                    success: function(response) {
                        document.title =
                            "PT. NUSANTARA PRIMA DJAYA - Print" +
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
