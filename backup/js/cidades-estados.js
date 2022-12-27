$(document).ready(function(){

    // Selecionando estado
    $('#state_id').change(function(){
        $( "#city_id" ).prop( "disabled", true );
        // estado id
        let id = $(this).val();

        // esvaziar as opções
        $('#city_id').find('option').not(':first').remove();

        // AJAX request
        $.ajax({
            url: '/getcidades/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                $( "#city_id" ).prop( "disabled", false );
                let len = 0;
                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    // Read data and create <option >
                    for(let i=0; i<len; i++){

                        let id = response['data'][i].id;
                        let name = response['data'][i].title;

                        let option = "<option value='"+id+"'>"+name+"</option>";

                        $("#city_id").append(option);
                    }
                }

            }
        });
    });

});
