function getData() {
    $.ajax({
        type: "get",
        url: "/supplier/render",
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
        url: "/supplier/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

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
            url: "/supplier/edit/" + id,
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
            title: "Cetak data supplier?",
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
                    popTitle: "LaporanSupplier",
                    popOrient: "Portrait",
                };
                $.ajax({
                    type: "POST",
                    url: "/supplier/print",
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
