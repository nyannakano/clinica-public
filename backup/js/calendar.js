document.addEventListener('DOMContentLoaded', function() {

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


    /* initialize the calendar
    -----------------------------------------------------------------*/

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        loading: function(isLoading){
            if (isLoading) {
                $('.loading').show();
            }
            else {
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
        eventResize: true,
        selectable: true,
        drop: function(event) {

            let Agendamento = JSON.parse(event.draggedEl.dataset.event);

            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
                // if so, remove the element from the "Draggable Events" list
                event.draggedEl.parentNode.removeChild(event.draggedEl);

                Agendamento._method = "DELETE";
                sendEvent(routeEvents('routeFastEventDelete'), Agendamento);
            }

            let start = moment(`${event.dateStr} ${Agendamento.start}`).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(`${event.dateStr} ${Agendamento.end}`).format("YYYY-MM-DD HH:mm:ss");

            Agendamento.start = start;
            Agendamento.end = end;

            delete Agendamento.id;
            delete Agendamento._method;

            sendEvent(routeEvents('routeEventStore'), Agendamento);

        },
        eventDrop: function(event){

            let start = moment(event.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(event.event.end).format("YYYY-MM-DD HH:mm:ss");

            let newEvent = {
                _method: 'PUT',
                title: event.event.title,
                id: event.event.id,
                start: start,
                end: end
            };

            sendEventWithoutRefetch(routeEvents('routeEventUpdate'), newEvent);


        },
        eventClick: function(event){
            clearMessages('.message');
            resetForm("#formEvent");

            $("#modalCalendar").modal('show');
            $("#modalCalendar #titleModal").text('Alterar Agendamento');
            $("#modalCalendar button.deleteEvent").css('display', 'flex');

            let id = event.event.id;
            $("#modalCalendar input[name='id']").val(id);
            let title = event.event.title;
            $("#modalCalendar input[name='title']").val(title);
            let start = moment(event.event.start).format('DD/MM/YYYY HH:mm:ss');
            $("#modalCalendar input[name='start']").val(start);
            let end = moment(event.event.end).format('DD/MM/YYYY HH:mm:ss');
            $("#modalCalendar input[name='end']").val(end);
            let color = event.event.backgroundColor;
            $("#modalCalendar input[name='color']").val(color);
            let description = event.event.extendedProps.description;
            $("#modalCalendar textarea[name='description']").val(description);
            let status = event.event.extendedProps.status;
            $("#modalCalendar input[name='status']").val(status);

            if(status === 0){
                $("#modalCalendar button.confirmEvent").text('Confirmar Agendamento');
            }
            else if(status === 1){
                $("#modalCalendar button.confirmEvent").text('Retirar Confirmação');
            }
        },
        eventResize: function(event){
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
        select: function(event){
            resetForm("#formEvent");

            $("#modalCalendar").modal('show');
            $("#modalCalendar #titleModal").text('Adicionar Evento');
            $("#modalCalendar button.deleteEvent").css('display', 'none');

            let start = moment(event.start).format('DD/MM/YYYY HH:mm:ss');
            $("#modalCalendar input[name='start']").val(start);
            let end = moment(event.end).format('DD/MM/YYYY HH:mm:ss');
            $("#modalCalendar input[name='end']").val(end);

            $("#modalCalendar input[name='color']").val('#000000');

            calendar.unselect();
        },
        eventContent: function(event) {
            let status = event.event.extendedProps.status;
            if (status === 1) {
                return {
                    html: event.event.title
                        + " " + moment(event.event.start).format('HH:mm')
                        + " " + moment(event.event.end).format('HH:mm')
                        + " " + "<i class='fas fa-check-circle ml-2'></i>"
                }
            } else if (status === 0) {
                return {
                    html: event.event.title
                        + " " + moment(event.event.start).format('HH:mm')
                        + " " + moment(event.event.end).format('HH:mm')
                        + " " + "<i class='fas fa-question-circle ml-2'></i>"
                }
            }
        },
        events: routeEvents('routeLoadEvents'),
    });

    objCalendar = calendar;
    calendar.render();

});


