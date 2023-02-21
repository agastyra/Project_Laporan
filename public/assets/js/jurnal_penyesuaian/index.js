$(document).ready(function () {
    let baseUrl =
        $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

    $("#debet_detail").keyup(function () {
        if (
            $("#kredit_detail").val() == "" ||
            $("#kredit_detail").val() == null ||
            $("#kredit_detail").val() == undefined ||
            $("#kredit_detail").val() == 0
        ) {
            $("#kredit_detail").val("0");
        } else {
            $("#debet_detail").val("0");
        }
    });

    $("#kredit_detail").keyup(function () {
        if (
            $("#debet_detail").val() == "" ||
            $("#debet_detail").val() == null ||
            $("#debet_detail").val() == undefined ||
            $("#debet_detail").val() == 0
        ) {
            $("#debet_detail").val("0");
        } else {
            $("#kredit_detail").val("0");
        }
    });

    $("#debet_detail").change(function () {
        if (
            $("#kredit_detail").val() == "" ||
            $("#kredit_detail").val() == null ||
            $("#kredit_detail").val() == undefined ||
            $("#kredit_detail").val() == 0
        ) {
            $("#kredit_detail").val("0");
        } else {
            $("#debet_detail").val("0");
        }
    });

    $("#kredit_detail").change(function () {
        if (
            $("#debet_detail").val() == "" ||
            $("#debet_detail").val() == null ||
            $("#debet_detail").val() == undefined ||
            $("#debet_detail").val() == 0
        ) {
            $("#debet_detail").val("0");
        } else {
            $("#kredit_detail").val("0");
        }
    });
});