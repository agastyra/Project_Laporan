$(document).ready(function () {
    let filter_display = false;
    $("#filter_buku_besar").hide();

    // Show filter jurnal
    $(document).on("click", "#filter_button", () => {
        filter_display = !filter_display;
        $("#filter_buku_besar").toggle(filter_display);
    });
});
