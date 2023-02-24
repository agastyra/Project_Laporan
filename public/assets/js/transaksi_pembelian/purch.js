$(document).ready(function () {
    let baseUrl =
        $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

    let barang_id = 0;
    let barang_exists = false;
    let html = "";
    let grandTotal = 0;
    let diskon = 0;

    // get data when load page
    $.get(baseUrl + "purchase/get_detail", function (response) {
        if (
            response.result != null ||
            response.result != [] ||
            response.result != ""
        ) {
            $("#table_detail_barang_tbody").empty();
            let subTotal = 0;
            $.each(response.result, function (key, value) {
                html += "<tr id='barang_" + value.brg_id + "'>";
                html += "<td>" + (key + 1) + "</td>";
                html += "<td>" + value.name_barang + "</td>";
                html += "<td>" + value.harga_beli + "</td>";
                html += "<td class='barang_qty'>" + value.qty + "</td>";
                html +=
                    "<td class='barang_subtotal'>" +
                    value.harga_beli * value.qty +
                    "</td>";
                html +=
                    "<td>" +
                    "<button type='button' class = 'btn btn-icon btn-success btn-sm btn-update-detail' data-detail-transaksi-id='" +
                    value.trx_id +
                    "' data-detail-barang-id='" +
                    value.brg_id +
                    "' data-detail-barang-nama='" +
                    value.name_barang +
                    "' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'button' class = 'btn btn-icon btn-danger btn-sm btn-delete-detail' data-detail-transaksi-id='" +
                    value.trx_id +
                    "' data-detail-barang-id='" +
                    value.brg_id +
                    "' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
                    "</td>";
                html += "</tr>";
                subTotal += value.harga_beli * value.qty;
            });
            $("#table_detail_barang").append(html);
            html = "";
            grandTotal = subTotal;
            $("#grand_total").val(grandTotal);
        }
    });

    // get data barang when selection change
    $("#keyBarang").on("change", function () {
        if (this.value) {
            $.get(baseUrl + "cari_barang/" + this.value, function (response) {
                if (response) {
                    $("#barang_id").val(response.result[0]["id"]);
                    $("#no_barang").text(response.result[0]["no_barang"]);
                    $("#name_barang").text(response.result[0]["name_barang"]);
                    $("#harga_beli").text(response.result[0]["harga_beli"]);
                    $("#qty").val("");

                    barang_id = $("#barang_id").val();

                    $.ajax({
                        type: "GET",
                        url: baseUrl + "purchase/validate_barang/" + barang_id,
                        success: function (response) {
                            if (response) {
                                if (
                                    response == [] ||
                                    response == null ||
                                    response == undefined ||
                                    response == ""
                                ) {
                                    barang_exists = false;
                                } else {
                                    barang_exists = true;
                                }
                            }
                        },
                    });
                } else {
                    $("#no_barang").text("-");
                    $("#name_barang").text("-");
                    $("#harga_beli").text("-");
                    $("#qty").val("");
                }
            });
        } else {
            $("#no_barang").text("-");
            $("#name_barang").text("-");
            $("#harga_beli").text("-");
            $("#qty").val("");
        }
    });

    // insert or update barang
    $("#form-barang").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        if (barang_exists) {
            // put
            $.ajax({
                type: "PUT",
                url: baseUrl + "purchase/update_detail",
                data: formData,
                success: function (response) {
                    let grand_total = 0;
                    let items = document.querySelectorAll("td.barang_subtotal");
                    let total_item = Array.from(items);
                    let barang_qty = document.querySelector(
                        `tr#barang_${response.barang.id} > td.barang_qty`
                    );
                    let barang_subtotal = document.querySelector(
                        `tr#barang_${response.barang.id} > td.barang_subtotal`
                    );

                    $(barang_qty).text(response.detail.qty);
                    $(barang_subtotal).text(
                        response.barang.harga_beli * response.detail.qty
                    );

                    for (let i = 0; i < total_item.length; i++) {
                        grand_total =
                            grand_total + parseInt($(total_item[i]).text());
                    }

                    if (grand_total >= 200000 && grand_total < 350000) {
                        diskon = (grand_total * 5) / 100;
                        grand_total = grand_total - diskon;
                        $("#persen_diskon").text("5%");
                    } else if (grand_total >= 350000) {
                        diskon = (grand_total * 7) / 100;
                        grand_total = grand_total - diskon;
                        $("#persen_diskon").text("7%");
                    } else {
                        diskon = 0;
                        grand_total = grand_total - diskon;
                    }

                    $("#no_barang").text("-");
                    $("#name_barang").text("-");
                    $("#harga_beli").text("-");
                    $("#qty").val("");
                    $("#keyBarang").val("").change();

                    $("#diskon").val(diskon);
                    $("#grand_total").val(grand_total);
                },
            });
        } else {
            // post
            $.ajax({
                type: "POST",
                url: baseUrl + "purchase/save_detail",
                data: formData,
                success: function (response) {
                    $.ajax({
                        type: "GET",
                        url: baseUrl + "purchase/get_detail",
                        success: function (response) {
                            if (
                                response.result != null ||
                                response.result != [] ||
                                response.result != ""
                            ) {
                                $("#table_detail_barang_tbody").empty();
                                let subTotal = 0;
                                $.each(response.result, function (key, value) {
                                    html +=
                                        "<tr id='barang_" + value.brg_id + "'>";
                                    html += "<td>" + (key + 1) + "</td>";
                                    html +=
                                        "<td>" + value.name_barang + "</td>";
                                    html += "<td>" + value.harga_beli + "</td>";
                                    html +=
                                        "<td class='barang_qty'>" +
                                        value.qty +
                                        "</td>";
                                    html +=
                                        "<td class='barang_subtotal'>" +
                                        value.harga_beli * value.qty +
                                        "</td>";
                                    html +=
                                        "<td>" +
                                        "<button type='button' class = 'btn btn-icon btn-success btn-sm btn-update-detail' data-detail-transaksi-id='" +
                                        value.trx_id +
                                        "' data-detail-barang-id='" +
                                        value.brg_id +
                                        "' data-detail-barang-nama='" +
                                        value.name_barang +
                                        "' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'button' class = 'btn btn-icon btn-danger btn-sm btn-delete-detail' data-detail-transaksi-id='" +
                                        value.trx_id +
                                        "' data-detail-barang-id='" +
                                        value.brg_id +
                                        "' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
                                        "</td>";
                                    html += "</tr>";
                                    subTotal += value.harga_beli * value.qty;
                                });
                                $("#table_detail_barang").append(html);
                                html = "";
                                grandTotal = subTotal;

                                if (
                                    grandTotal >= 200000 &&
                                    grandTotal < 350000
                                ) {
                                    diskon = (grandTotal * 5) / 100;
                                    grandTotal = grandTotal - diskon;
                                    $("#persen_diskon").text("5%");
                                } else if (grandTotal >= 350000) {
                                    diskon = (grandTotal * 7) / 100;
                                    grandTotal = grandTotal - diskon;
                                    $("#persen_diskon").text("7%");
                                } else {
                                    diskon = 0;
                                    grandTotal = grandTotal - diskon;
                                }
                            }
                            $("#no_barang").text("-");
                            $("#name_barang").text("-");
                            $("#harga_beli").text("-");
                            $("#qty").val("");
                            $("#keyBarang").val("").change();

                            $("#diskon").val(diskon);
                            $("#grand_total").val(grandTotal);
                        },
                    });
                },
            });
        }
    });

    // inserting bayar value
    $("#bayar").on("change", function () {
        $("#kembali").val($(this).val() - $("#grand_total").val());
    });
    $("#bayar").keyup(function () {
        $("#kembali").val($(this).val() - $("#grand_total").val());
    });
    $("#grand_total").on("change", function () {
        $("#kembali").val($("#bayar").val() - $("#grand_total").val());
    });

    // get data for barang who want to update
    $(document).on("click", ".btn-update-detail", function () {
        let barang_id = $(this).data("detail-barang-id");
        let barangs_name = $(this).data("detail-barang-nama");
        let transaksis_id = $(this).data("detail-transaksi-id");
        let detail_qty = parseInt(
            document.querySelector(`tr#barang_${barang_id} > td.barang_qty`)
                .innerHTML
        );

        $("#detail_transaksi_id").val(transaksis_id);
        $("#detail_barang_id").val(barang_id);
        $("#detail_nama").val(barangs_name);
        $("#detail_qty").val(detail_qty);
    });

    // get data for barang who want to delete
    $(document).on("click", ".btn-delete-detail", function () {
        let barang_id = $(this).data("detail-barang-id");
        let transaksis_id = $(this).data("detail-transaksi-id");

        $("#delete-transaksi-pembelians-id").val(transaksis_id);
        $("#delete-barangs-id").val(barang_id);
    });

    // update qty barang
    $("#update-barang").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: "PUT",
            url: baseUrl + "purchase/update_detail_qty",
            data: formData,
            success: function (response) {
                $("#modal-edit").modal("hide");

                let grand_total = 0;
                let items = document.querySelectorAll("td.barang_subtotal");
                let total_item = Array.from(items);
                let barang_qty = document.querySelector(
                    `tr#barang_${response.barang.id} > td.barang_qty`
                );
                let barang_subtotal = document.querySelector(
                    `tr#barang_${response.barang.id} > td.barang_subtotal`
                );
                $(barang_qty).text($("#detail_qty").val());
                $(barang_subtotal).text(
                    response.barang.harga_beli *
                        parseInt($("#detail_qty").val())
                );
                for (let i = 0; i < total_item.length; i++) {
                    grand_total =
                        grand_total + parseInt($(total_item[i]).text());
                }
                if (grand_total >= 200000 && grand_total < 350000) {
                    diskon = (grand_total * 5) / 100;
                    grand_total = grand_total - diskon;
                    $("#persen_diskon").text("5%");
                } else if (grand_total >= 350000) {
                    diskon = (grand_total * 7) / 100;
                    grand_total = grand_total - diskon;
                    $("#persen_diskon").text("7%");
                } else {
                    diskon = 0;
                    grand_total = grand_total - diskon;
                    $("#persen_diskon").text("");
                }
                $("#diskon").val(diskon);
                $("#grand_total").val(grand_total);
            },
        });
    });

    // hapus detail barang
    $("#hapus-barang").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: "DELETE",
            url: baseUrl + "purchase/delete_detail",
            data: formData,
            success: function (response) {
                $("#modal-hapus").modal("hide");
                if (
                    response == null ||
                    response == undefined ||
                    response == [] ||
                    response.length == 0
                ) {
                    $("#table_detail_barang_tbody").empty();
                    $("#persen_diskon").text("");
                    $("#diskon").val(0);
                    $("#grand_total").val(0);
                    console.log("response nya null");
                    console.log(response);
                } else {
                    console.log("response nya tidak null");
                    console.log(response);

                    $(`tr#barang_${$("#delete-barangs-id").val()}`).remove();

                    let grand_total = 0;
                    let items = document.querySelectorAll("td.barang_subtotal");
                    let total_item = Array.from(items);

                    for (let i = 0; i < total_item.length; i++) {
                        grand_total =
                            grand_total + parseInt($(total_item[i]).text());
                    }
                    if (grand_total >= 200000 && grand_total < 350000) {
                        diskon = (grand_total * 5) / 100;
                        grand_total = grand_total - diskon;
                        $("#persen_diskon").text("5%");
                    } else if (grand_total >= 350000) {
                        diskon = (grand_total * 7) / 100;
                        grand_total = grand_total - diskon;
                        $("#persen_diskon").text("7%");
                    } else {
                        diskon = 0;
                        grand_total = grand_total - diskon;
                        $("#persen_diskon").text("");
                    }
                    $("#diskon").val(diskon);
                    $("#grand_total").val(grand_total);
                }
            },
        });
    });
});
