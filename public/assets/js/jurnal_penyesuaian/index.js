$(document).ready(function () {
    console.log('oke');

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

    $(document).on('click', '.update-button', function() {
        let data_detail_id = $(this).data('data-detail-id');
        let detail_akun_id = $(this).data('detail-akun-id');
        let debet = $(this).data('detail-debet');
        let kredit = $(this).data('detail-kredit');
        console.log(data_detail_id);
        console.log(detail_akun_id);
        console.log(debet);
        console.log(kredit);
        
        $('#editModal').modal('show');
        //  $('#editModal').on('show.bs.modal') 
                  
                
        $('#detail-id').val(data_detail_id);
        $('#debet_detail_modal').val(debet);
        $('#kredit_detail_modal').val(kredit);
         
         
//     $('#edit-name').val(name);
//     $('#edit-email').val(email);
// });
    });

    $('#editForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        // Send data to server
        $.ajax({
            url: baseUrl + 'penyesuaian/update-penyesuaian',
            type: "PUT",
            data: formData,
            success: function(data) {
                // Reload page or update data table
                console.log('ok');
                

            },
            error: function(xhr, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }

        });
    });
});