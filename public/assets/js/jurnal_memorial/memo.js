$(document).ready(function () {
    let filter_display = false;
    $("#filter_jurnal").hide();

    // Show filter jurnal
    $(document).on("click", "#filter_button", () => {
        filter_display = !filter_display;
        $("#filter_jurnal").toggle(filter_display);
    });
});
