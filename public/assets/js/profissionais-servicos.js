$(document).ready(function () {

    // Selecionando profissional
    $('#pro_id').change(function () {
        $("#ser_id").prop("disabled", true);
        // profissional id
        let id = $(this).val();

        // esvaziar as opções
        $('#ser_id').find('option').not(':first').remove();

        // AJAX request
        $.ajax({
            url: '/getservicos/' + id,
            type: 'get',
            dataType: 'Json',
            success: function (response) {

                let len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }

                if (len > 0) {
                    $("#ser_id").prop("disabled", false);
                    // Read data and create <option >
                    for (let i = 0; i < len; i++) {

                        let id = response['data'][i].id;
                        let name = response['data'][i].ser_name;

                        let option = "<option value='" + id + "'>" + name + "</option>";

                        $("#ser_id").append(option);
                    }
                }

            }
        });
    });

    $('#ser_id').change(function () {
        $("#ord_sessions").prop("disabled", true);
        let id = $(this).val();
        $.ajax({
            url: '/getsessions/' + id,
            type: 'get',
            dataType: 'Json',
            success: function (response) {
                $("#ord_sessions").val(response);
                $("#ord_sessions").prop("disabled", false);
            }
        });
    });
})
