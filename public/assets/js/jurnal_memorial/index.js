$(document).ready(function () {
    let baseUrl =
        $(location).attr("protocol") + "//" + $(location).attr("host") + "/";
    let html = "";
    let akun_exists = false;

    $("#debet_memo").keyup(function () {
        if (
            $("#kredit_memo").val() == "" ||
            $("#kredit_memo").val() == null ||
            $("#kredit_memo").val() == undefined ||
            $("#kredit_memo").val() == 0
        ) {
            $("#kredit_memo").val("0");
        } else {
            $("#debet_memo").val("0");
        }
    });

    $("#kredit_memo").keyup(function () {
        if (
            $("#debet_memo").val() == "" ||
            $("#debet_memo").val() == null ||
            $("#debet_memo").val() == undefined ||
            $("#debet_memo").val() == 0
        ) {
            $("#debet_memo").val("0");
        } else {
            $("#kredit_memo").val("0");
        }
    });

    $("#debet_memo").change(function () {
        if (
            $("#kredit_memo").val() == "" ||
            $("#kredit_memo").val() == null ||
            $("#kredit_memo").val() == undefined ||
            $("#kredit_memo").val() == 0
        ) {
            $("#kredit_memo").val("0");
        } else {
            $("#debet_memo").val("0");
        }
    });

    $("#kredit_memo").change(function () {
        if (
            $("#debet_memo").val() == "" ||
            $("#debet_memo").val() == null ||
            $("#debet_memo").val() == undefined ||
            $("#debet_memo").val() == 0
        ) {
            $("#debet_memo").val("0");
        } else {
            $("#kredit_memo").val("0");
        }
    });

    // get data barang when selection change
    $("#akun_id_memo").on("change", function () {
        if (this.value) {
            $.get(
                baseUrl + "accounting/memorial/validate_akun/" + this.value,
                function (response) {
                    if (response) {
                        if (
                            response == [] ||
                            response == null ||
                            response == undefined ||
                            response == ""
                        ) {
                            console.log(response);
                            console.log("ini gaada datanya masihan");
                            akun_exists = false;
                        } else {
                            console.log(response);
                            console.log("ini seh wes ada datanya");
                            akun_exists = true;
                        }
                    }
                }
            );
        } else {
        }
    });

    $("#form-account").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        if (akun_exists) {
            $.ajax({
                type: "PUT",
                url: baseUrl + "accounting/memorial/update_detail",
                data: formData,
                success: function (response) {
                    console.log(response);
                    $(`tr#akun_${response.akun.id} > td.debet`).text(
                        format_number(response.detail.debet)
                    );
                    $(`tr#akun_${response.akun.id} > td.kredit`).text(
                        format_number(response.detail.kredit)
                    );
                },
                error: function (error) {
                    console.error(error);
                },
            });
        } else {
            $.ajax({
                type: "POST",
                url: baseUrl + "accounting/memorial/store_detail",
                data: formData,
                success: function (response) {
                    $.ajax({
                        type: "GET",
                        url: baseUrl + "accounting/memorial/get_detail",
                        success: function (response) {
                            if (response) {
                                console.log(response.detail);
                                $("#table_detail_akun_body").empty();
                                $.each(response.detail, function (key, value) {
                                    html += `<tr id='akun_${value.akun_id}'>`;
                                    html += `<td>( ${value.no_akun} ) ${value.name_akun}</td>`;
                                    html += `<td class='debet'>${format_number(
                                        value.debet
                                    )}</td>`;
                                    html += `<td class='kredit'>${format_number(
                                        value.kredit
                                    )}</td>`;
                                    html +=
                                        "<td>" +
                                        "<button type='button' class = 'btn btn-icon btn-success btn-sm btn-update-detail' data-detail-memorial-id='" +
                                        value.jm_id +
                                        "' data-detail-akun-id='" +
                                        value.akun_id +
                                        "' data-detail-akun-nomor='" +
                                        value.no_akun +
                                        "' data-detail-akun-nama='" +
                                        value.name_akun +
                                        "' data-detail-akun-debet='" +
                                        value.debet +
                                        "' data-detail-akun-kredit='" +
                                        value.kredit +
                                        "' data-bs-toggle = 'modal' data-bs-target = '#modal-edit'> <i class = 'mdi mdi-pencil icon-sm'> </i></button> <button type = 'button' class = 'btn btn-icon btn-danger btn-sm btn-delete-detail' data-detail-jurnal-memorial-id='" +
                                        value.jm_id +
                                        "' data-detail-akun-id='" +
                                        value.akun_id +
                                        "' data-bs-toggle = 'modal' data-bs-target = '#modal-hapus'> <i class = 'mdi mdi-delete icon-sm'> </i></button>" +
                                        "</td>";
                                    html += `</tr>`;
                                });
                                $("#table_detail_akun").append(html);
                                html = "";
                                $("#debet_memo").val("");
                                $("#kredit_memo").val("");
                                $("#akun_id_memo").val("").change();
                            }
                        },
                    });
                },
            });
        }

        $("#debet_memo").val("");
        $("#kredit_memo").val("");
        $("#akun_id_memo").val("").change();
    });

    // get data for akun who want to update
    $(document).on("click", ".btn-update-detail", function () {
        let akun_id = $(this).data("detail-akun-id");
        let akun_no = $(this).data("detail-akun-nomor");
        let akun_name = $(this).data("detail-akun-nama");
        let memorial_id = $(this).data("detail-memorial-id");
        let akun_amount = parseInt(
            $(this).data("detail-akun-debet") +
                $(this).data("detail-akun-kredit")
        );

        $("#detail_memorial_id").val(memorial_id);
        $("#detail_akun_id").val(akun_id);
        $("#detail_nama").val(`( ${akun_no} ) ${akun_name}`);
        $("#akun_amount").val(akun_amount);
    });

    // get data for akun who want to delete
    $(document).on("click", ".btn-delete-detail", function () {
        let akun_id = $(this).data("detail-akun-id");
        let jurnal_memorial_id = $(this).data("detail-jurnal-memorial-id");

        $("#delete-jurnal-memorial-id").val(jurnal_memorial_id);
        $("#delete-akun-id").val(akun_id);
    });

    // update qty akun
    $("#update-akun").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: "PUT",
            url: baseUrl + "accounting/memorial/update_detail_qty",
            data: formData,
            success: function (response) {
                $("#modal-edit").modal("hide");
                $(`tr#akun_${response.akun.id} > td.debet`).text(
                    format_number(response.detail.debet)
                );
                $(`tr#akun_${response.akun.id} > td.kredit`).text(
                    format_number(response.detail.kredit)
                );
            },
            error: function (error) {
                console.error(error);
            },
        });
    });

    // hapus detail akun
    $("#hapus-akun").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: "DELETE",
            url: baseUrl + "accounting/memorial/delete_detail",
            data: formData,
            success: function (response) {
                console.log(response);
                $("#modal-hapus").modal("hide");
                $(`tr#akun_${response.detail[0].akun_id}`).remove();
            },
        });
    });
});
