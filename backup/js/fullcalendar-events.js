$(function (){

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

    $('.confirmEvent').click(function (){
        $('.loading').show();

        let id = $("#modalCalendar input[name='id']").val();

        let Agendamento = {
            id: id,
            _method: 'POST'
        };
        let route = routeEvents('routeEventConfirm');

        sendEvent(route, Agendamento);
    });

    $('.saveEvent').click(function(event){

        $('.loading').show();

        let id = $("#modalCalendar input[name='id']").val();

        let title = $("#modalCalendar input[name='title']").val();

        let start = moment($("#modalCalendar input[name='start']")
            .val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');

        let end = moment($("#modalCalendar input[name='end']")
            .val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');

        let color = $("#modalCalendar input[name='color']").val();

        let description = $("#modalCalendar textarea[name='description']").val();

        let status = $("#modalCalendar input[name='status']").val();

        let Agendamento = {
            title: title,
            start: start,
            end: end,
            color: color,
            description: description,
            status: status,
        };

        let route;

        if(id == ''){
            route = routeEvents('routeEventStore');
        } else {
            Agendamento.id = id;
            Agendamento._method = 'PUT';
            route = routeEvents('routeEventUpdate');
        };
        sendEvent(route, Agendamento);
    });
});

function sendEvent(route, data_){

    $.ajax({
        url: route,
        data: data_,
        method: 'POST',
        dataType: 'json',
        success: function (json) {
            if(json){
                objCalendar.refetchEvents();
                $("#modalCalendar").modal('hide');
            }
        },
        error:function (json) {
            $('.loading').hide();
            let responseJSON = json.responseJSON.errors;

            $(".message").html(loadErrors(responseJSON));
        }
    });
}

function sendEventWithoutRefetch(route, data_){

    $.ajax({
        url: route,
        data: data_,
        method: 'POST',
        dataType: 'json',
        success: function (json) {
            if(json){
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


function resetForm(form){
    $(form)[0].reset();
}


function loadErrors(response) {

    let boxAlert = `<div class="alert alert-danger">`;

    for (let fields in response){
        boxAlert += `<span>${response[fields]}</span><br/>`;
    }

    boxAlert += `</div>`;

    return boxAlert.replace(/\,/g,"<br/>");
}

function clearMessages(event){
    $(event).text('');
}
