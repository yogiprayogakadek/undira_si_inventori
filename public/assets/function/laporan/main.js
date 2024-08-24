$(document).ready(function () {
    // getData();

    // print data
    $("body").on("click", ".btn-print-data", function () {
        let tanggalAwal = $('.tanggal-awal').val();
        let tanggalAkhir = $('.tanggal-akhir').val();
        let kategori = $('#kategori').find(":selected").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        Swal.fire({
            title: "Cetak Laporan?",
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
                    popTitle: "Laporan",
                    popOrient: "Landscape",
                };
                $.ajax({
                    type: "POST",
                    url: "laporan/print",
                    data: {
                        tanggal_awal: tanggalAwal,
                        tanggal_akhir: tanggalAkhir,
                        kategori: kategori
                    },
                    success: function (response) {
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
