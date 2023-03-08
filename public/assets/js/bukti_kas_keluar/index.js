$(document).ready(function () {
    let baseUrl =
        $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

    if ($("#other_cash_out").prop("checked") == true) {
        $("#purchase_bkk").css("display", "none");
        $("#purchase").css("display", "none");
        $("#purchase_cash_out").val("").change();
        $("#akun_other").css("display", "block");
        $("#amount_other").css("display", "block");
        $("#jumlah").val("");
    } else if ($("#other_cash_out").prop("checked") == false) {
        $("#purchase_bkk").css("display", "block");
        $("#purchase").css("display", "block");
        // $("#akun_other").css("display", "none");
        $("#akun_cash_out").val("").change();
        $("#amount_other").css("display", "none");
        $("#jumlah").val(0);
    }

    $("#other_cash_out").click(function () {
        if ($(this).prop("checked") == true) {
            $("#purchase_bkk").css("display", "none");
            $("#purchase").css("display", "none");
            $("#purchase_cash_out").val("").change();
            $("#akun_other").css("display", "block");
            $("#amount_other").css("display", "block");
            $("#jumlah").val("");
        } else if ($(this).prop("checked") == false) {
            $("#purchase_bkk").css("display", "block");
            $("#purchase").css("display", "block");
            // $("#akun_other").css("display", "none");
            $("#akun_cash_out").val("").change();
            $("#amount_other").css("display", "none");
            $("#jumlah").val(0);
        }
    });

    // get data when selection change
    $("#purchase_cash_out").on("change", function () {
        if (this.value) {
            $.get(
                baseUrl + "accounting/cash-out/get_transaction/" + this.value,
                function (response) {
                    if (response) {
                        $("#purhcase_jumlah").text(
                            format_number(response.total)
                        );
                        $("#jumlah").val(response.total);
                        $("#purhcase_supplier").text(response.vendor);
                    }
                }
            );
        } else {
            $("#purhcase_jumlah").text("0");
            $("#purhcase_supplier").text("--");
        }
    });
});
