$(function () {

    $('.date-time').mask('00/00/0000 00:00:00');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.deleteEvent').click(function () {
        $('.loading').show();

        let id = $("#modalCalendar input[name='id']").val();

        let Agendamento = {
            id: id,
            _method: 'DELETE'
        };
        let route = routeEvents('routeEventDelete');

        sendEvent(route, Agendamento);
    });

    $('.confirmEvent').click(function () {
        $('.loading').show();

        let id = $("#modalCalendar input[name='id']").val();

        let Agendamento = {
            id: id,
            _method: 'POST'
        };
        let route = routeEvents('routeEventConfirm');

        sendEvent(route, Agendamento);
    });

    $('#modalCalendar').on('hidden.bs.modal', function (event) {
        objCalendar.refetchEvents();
    });

    $('#modalCalendar input[name="start"]').change(function(){
        let starttime = $('#modalCalendar input[name="start"]').val();
        let servico = getService($('#modalCalendar input[name="servico"]').val());
        $('#modalCalendar input[name="end"]').val(moment(starttime).add(servico.ser_time));

    });

    $('#modalCalendar select[name="pro_id"]').change(function () {
        $('#modalCalendar select[name="ser_id"]').find('option').not(':first').remove();
        let id = $("#modalCalendar input[name='id']").val();
        let val = $(this).val();
        if (val === null || 0) {
            $('#modalCalendar select[name="ser_id"]').prop("disabled", true);
        } else {
            $('#modalCalendar select[name="ser_id"]').prop("disabled", false);
        }
        let servicos = getServices(val);
        for (let i = 0; i < servicos.length; i++) {
            let value = servicos[i].id;
            let text = servicos[i].ser_name;

            var o = new Option(text, value);
            $(o).html(text);
            $("#modalCalendar select[name='ser_id']").append(o);
            if (id !== null && id !== '') {
                let jsonevento = evento(id);
                if (value === jsonevento.ser_id) {
                    $("#modalCalendar select[name='ser_id']").val(value).change();
                }
            }
        }


    });



    $('.saveEvent').click(function (event) {

        $('.loading').show();

        let id = $("#modalCalendar input[name='id']").val();

        let title = $("#modalCalendar input[name='title']").val();

        let price = $("#modalCalendar input[name='price']").val();

        let ser_id = $("#modalCalendar input[name='servico']").val();

        let clie_id = $("#modalCalendar select[name='clie_id']").val();

        let pro_id = $("#modalCalendar select[name='pro_id']").val();

        let start = moment($("#modalCalendar input[name='start']")
            .val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');

        let servico = getService(ser_id);

        let end = moment($("#modalCalendar input[name='start']")
            .val(), 'DD/MM/YYYY HH:mm:ss').add(servico.ser_time, 'm').format('YYYY-MM-DD HH:mm:ss');

        console.log(end);

        let color = $("#modalCalendar input[name='color']").val();

        let description = $("#modalCalendar textarea[name='description']").val();

        let status = $("#modalCalendar input[name='status']").val();


        let Agendamento = {
            title: title,
            pro_id: pro_id,
            clie_id: clie_id,
            start: start,
            price: price,
            ser_id: ser_id,
            end: end,
            color: color,
            description: description,
            status: status,
        };

        let route;

        if (id == '') {
            route = routeEvents('cliente.routeEventStore');
        } else {
            Agendamento.id = id;
            Agendamento._method = 'PUT';
            route = routeEvents('cliente.routeEventUpdate');
        }
        ;

        sendEvent(route, Agendamento);
    });
});

function sendEvent(route, data_) {

    $.ajax({
        url: route,
        data: data_,
        method: 'POST',
        dataType: 'json',
        success: function (json) {
            if (json) {
                console.log(json);
                objCalendar.refetchEvents();
                $("#modalCalendar").modal('hide');
            } else {
                alert('Horário não disponível, verifique o tempo total deste serviço');
            }
        },
        error: function (json) {
            $('.loading').hide();
            let responseJSON = json.responseJSON.errors;

            $(".message").html(loadErrors(responseJSON));
        }
    });
}

function sendEventWithoutRefetch(route, data_) {

    $.ajax({
        url: route,
        data: data_,
        method: 'POST',
        dataType: 'json',
        success: function (json) {
            if (json) {
                console.log('Evento movido com sucesso');
            } else {
                console.log('Evento não foi movido.')
            }
        },
    });
}

function routeEvents(route) {
    return document.getElementById('calendar').dataset[route];
}


function resetForm(form) {
    $(form)[0].reset();
}


function loadErrors(response) {

    let boxAlert = `<div class="alert alert-danger">`;

    for (let fields in response) {
        boxAlert += `<span>${response[fields]}</span><br/>`;
    }

    boxAlert += `</div>`;

    return boxAlert.replace(/\,/g, "<br/>");
}

function clearMessages(event) {
    $(event).text('');
}

function evento(id) {
    let evento;
    $.ajax({
        url: '/load-eventbyid/' + id,
        method: 'GET',
        async: false,
        dataType: 'json',
        success: function (json) {
            evento = json;
        },
        error: function (json) {
            console.log('erro');
        }
    });
    return evento;
}

function getServices(id) {
    let evento;
    $.ajax({
        url: '/getservices/' + id,
        method: 'GET',
        async: false,
        dataType: 'json',
        success: function (json) {
            evento = json;
        },
        error: function (json) {
            console.log('erro');
        }
    });
    return evento;
}

function getBusinessHours(id) {
    let evento;
    $.ajax({
        url: id + '/load-businesshours/',
        method: 'GET',
        async: false,
        dataType: 'json',
        success: function (json) {
            evento = $.map(json, function(el) { return el; });
        },
        error: function (json) {
            console.log('erro' + json);
        }
    });


    return evento;
}

function getHorariosAtendimento(id) {
    let evento;
    $.ajax({
        url: id + '/load-horariosatendimento/',
        method: 'GET',
        async: false,
        dataType: 'json',
        success: function (json) {
            evento = $.map(json, function(el) { return el; });
        },
        error: function (json) {
            console.log('erro' + json);
        }
    });

    return evento;
}


function getService(id) {
    let evento;
    $.ajax({
        url: '/load-service/' + id,
        method: 'GET',
        async: false,
        dataType: 'json',
        data: {id : id},
        success: function (json) {
            evento = json;
        },
        error: function (json) {
            console.log('erro');
        }
    });
    return evento;
}

function getExceptionsDays(id) {
    let evento;

}
