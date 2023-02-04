$(document).ready(function () {
    let baseUrl =
        $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

    let barangs_id = 0;
    let barang_exists = false;
    let html = "";
    let grandTotal = 0;
    let diskon = 0;

    $.get(baseUrl + "purchase/get_detail", function (response) {
        if (
            response.result != null ||
            response.result != [] ||
            response.result != ""
        ) {
            $("#table_detail_barang_tbody").empty();
            let subTotal = 0;
            $.each(response.result, function (key, value) {
                html += "<tr id='barang_" + value.id + "'>";
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
                    "<button type='submit' class = 'btn btn-icon btn-success btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'submit' class = 'btn btn-icon btn-danger btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
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

    $("#keyBarang").on("change", function () {
        if (this.value) {
            $.get(baseUrl + "cari_barang/" + this.value, function (response) {
                if (response) {
                    $("#barangs_id").val(response.result[0]["id"]);
                    $("#no_barang").text(response.result[0]["no_barang"]);
                    $("#name_barang").text(response.result[0]["name_barang"]);
                    $("#harga_beli").text(response.result[0]["harga_beli"]);
                    $("#qty").val("");

                    barangs_id = $("#barangs_id").val();

                    $.ajax({
                        type: "GET",
                        url: baseUrl + "purchase/validate_barang/" + barangs_id,
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
                                    html += "<tr id='barang_" + value.id + "'>";
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
                                        "<button type='submit' class = 'btn btn-icon btn-success btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'submit' class = 'btn btn-icon btn-danger btn-sm' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
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

        // $.ajax({
        //     type: "POST",
        //     url: baseUrl + "purchase/save_detail",
        //     data: formData,
        //     beforeSend: function(xhr) {
        //         $.ajax({
        //             type: "GET",
        //             url: baseUrl + "purchase/validate_barang/" + barangs_id,
        //             success: function(response) {
        //                 $.ajax({
        //                     type: "PUT",
        //                     url: baseUrl +
        //                         "purchase/update_detail/" +
        //                         barangs_id,
        //                     data: formData,
        //                     dataType: 'JSON',
        //                     success: function(response) {
        //                         console.log('oke data keubah');
        //                         console.log(response);
        //                         xhr.abort();
        //                     },
        //                     error: function(error) {
        //                         console.error(
        //                             'data gak keubah bro');
        //                         console.log(error);
        //                         xhr.abort();
        //                     },
        //                     complete: function(response) {
        //                         console.log('penting mari');
        //                         console.log(response);
        //                         xhr.abort();
        //                     }
        //                 });
        //             }
        //         });
        //     },
        //     success: function(response) {
        //
        //     }
        // });
    });

    $("#bayar").keyup(function (e) {
        $("#kembali").val($(this).val() - $("#grand_total").val());
    });
});
