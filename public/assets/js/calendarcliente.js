document.addEventListener('DOMContentLoaded', function () {

    /* initialize the external events
    -----------------------------------------------------------------*/

    // var containerEl = document.getElementById('external-events-list');
    // new FullCalendar.Draggable(containerEl, {
    //     itemSelector: '.fc-event',
    //     eventData: function(eventEl) {
    //         return {
    //             title: eventEl.innerText.trim()
    //         }
    //     }
    // });
    let profissional = document.getElementById("profissionalid").value;
    let servico = document.getElementById("serviceid").value;
    let servicojson = getService(servico);
    console.log(servicojson);

    /* initialize the calendar
    -----------------------------------------------------------------*/
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        loading: function (isLoading) {
            if (isLoading) {
                $('.loading').show();
            } else {
                $('.loading').hide();
            }
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        editable: true,
        locale: 'pt-br',
        navLinks: true,
        initialView: 'timeGridWeek',
        eventResize: true,
        longPressDelay: 1000,
        allDaySlot: false,
        droppable: false,
        selectable: true,
        selectAllow: function (event) {
            let horas = getHorariosAtendimento(profissional);

            let tempoEventoInicio = event.start.toTimeString();
            let tempoEventoFim = event.end.toTimeString();


            for (let i = 0; i < horas.length; i++) {
                let horaInicial = horas[i].startTime;
                let horaFinal = horas[i].endTime;
                let dia = horas[i].daysOfWeek;
                let intervaloInicio = horas[i].interval;
                let intervaloFim= horas[i].returnInterval;

                if (dia == event.start.getDay()) {
                    if ((tempoEventoInicio >= horaInicial) && (tempoEventoFim <= horaFinal)) {
                        if(!(intervaloInicio === null)) {
                            if((tempoEventoInicio <=intervaloInicio) && (tempoEventoFim >= horaFinal))
                            console.log('Dia: ' + dia);
                            console.log('Horario inicial selecionado: ' + tempoEventoInicio);
                            console.log('Horario final selecionado: ' + tempoEventoFim);
                            console.log('Horario inicial atendimento: ' + horaInicial);
                            console.log('Horario final atendimento: ' + horaFinal);
                            console.log('Horario inicio intervalo: ' + intervaloInicio);
                            console.log('Horario final intervalo: ' + intervaloFim);
                            return true;
                        } else {
                            console.log('Dia: ' + dia);
                            console.log('Horario inicial selecionado: ' + tempoEventoInicio);
                            console.log('Horario final selecionado: ' + tempoEventoFim);
                            console.log('Horario inicial atendimento: ' + horaInicial);
                            console.log('Horario final atendimento: ' + horaFinal);
                            console.log('Não possui intervalo');
                            return true;
                        }
                    }
                }
            }
            return false;

        },
        eventResize: function (event) {
            let start = moment(event.event.start).format('YYYY-MM-DD HH:mm:ss');
            let end = moment(event.event.end).format('YYYY-MM-DD HH:mm:ss');


            let newEvent = {
                _method: 'PUT',
                title: event.event.title,
                id: event.event.id,
                start: start,
                end: end
            };

            sendEventWithoutRefetch(routeEvents('routeEventUpdate'), newEvent);
        },
        select: function (event) {
            // let teste = moment(event.start).add(30, 'm').format('DD/MM/YYYY HH:mm:ss');
            // console.log(teste); Realizar um metodo que retorne o serviço
            // que está sendo prestado e puxar ele nesse select para mudar o tempo de duração automaticamente

            console.log(servicojson);
            $("#modalCalendar").modal('show');
            $("#modalCalendar #titleModal").text('Adicionar Evento');
            $("#modalCalendar button.deleteEvent").css('display', 'none');

            let start = moment(event.start).format('DD/MM/YYYY HH:mm:ss');
            $("#modalCalendar input[name='start']").val(start);
            let end = moment(event.start).add(servicojson.ser_time, 'm').format('DD/MM/YYYY HH:mm:ss');
            $("#modalCalendar input[name='end']").val(end);
            $("#modalCalendar input[name='servico']").val(servicojson.id);

            // $("#modalCalendar input[name='color']").val(color);


        },
        eventContent: function (event) {
            let status = event.event.extendedProps.status;
            return {
                html: "HORÁRIO EM USO"
                    + " " + moment(event.event.start).format('HH:mm')
                    + " " + moment(event.event.end).format('HH:mm')
            }
        },
        businessHours: getBusinessHours(profissional),
        events: routeEvents('routeLoadEvents'),
    });

    objCalendar = calendar;
    calendar.render();

});


