$(document).ready(function () {
    let baseUrl =
        $(location).attr("protocol") + "//" + $(location).attr("host") + "/";

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
});
