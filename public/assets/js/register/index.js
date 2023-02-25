$(document).ready(function () {
    // ganti provinsi
    $("#alamat_provinsi_address").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url:
                "http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=" +
                this.value,
            dataType: "JSON",
            success: function (response) {
                let kota_kabupaten = $("#alamat_kota_kabupaten_address");
                kota_kabupaten.find("option:not(:first)").remove();
                // tampilkan kota kabupaten
                $.each(response["kota_kabupaten"], function (i, item) {
                    kota_kabupaten.append(
                        $("<option>", {
                            value: item.id,
                            text: item.nama,
                        })
                    );
                });
                $("#alamat_kota_kabupaten_address").val("").change();
                $("#alamat_kecamatan_address").val("").change();
                $("#alamat_kelurahan_address").val("").change();
            },
        });
    });

    // ganti kota kabupaten
    $("#alamat_kota_kabupaten_address").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url:
                "http://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=" +
                this.value,
            dataType: "JSON",
            success: function (response) {
                let kecamatan = $("#alamat_kecamatan_address");
                kecamatan.find("option:not(:first)").remove();
                // tampilkan kecamatan
                $.each(response["kecamatan"], function (i, item) {
                    kecamatan.append(
                        $("<option>", {
                            value: item.id,
                            text: item.nama,
                        })
                    );
                });
                $("#alamat_kecamatan_address").val("").change();
                $("#alamat_kelurahan_address").val("").change();
            },
        });
    });

    // ganti kelurahan
    $("#alamat_kecamatan_address").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url:
                "http://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=" +
                this.value,
            dataType: "JSON",
            success: function (response) {
                let kelurahan = $("#alamat_kelurahan_address");
                kelurahan.find("option:not(:first)").remove();
                // tampilkan kelurahan
                $.each(response["kelurahan"], function (i, item) {
                    kelurahan.append(
                        $("<option>", {
                            value: item.id,
                            text: item.nama,
                        })
                    );
                });
                $("#alamat_kelurahan_address").val("").change();
            },
        });
    });
});
