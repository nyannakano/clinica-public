@extends('templates.layoutclientes')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@if($cadastrado == null)
<h5 id="cinza" class="mb-3">
    Você deve completar seu cadastro antes de continuar!
    <a href="{{ route('home.registerUpdate') }}" class="badge badge-pill badge-warning mb-3" id="cor-cursor">Clique aqui para continuar</a>
</h5>
@else


    <div id="bloco-meio" class="mb-5">
        <span class="principal">
            <h5 id="cinza" class="mb-3">
                O tempo de atendimento, para o serviço <b>{{ $servico->ser_name }}</b>, é de {{ $servico->ser_time }} minutos
            </h5><br>
            <h5 id="cinza" class="mb-3">
                 Para agendar, pressione por 2 segundos no horário desejado.
            </h5><br>
            <h5 id="cinza" class="mb-3">
                 Horários bloqueados: Fora do horário de atendimento do profissional, em intervalo, ou o horário já está ocupado
            </h5><br>

        </span>
        <input type="text" id="profissionalid" class="profissionalid" value="{{ $profissional->id }}" hidden>
        <input type="text" id="serviceid" class="serviceid" value="{{ $servico->id }}" hidden>
        @include('home.modal-calendar')
{{--        esse include é o modal que abre ao clicar em um horário--}}
        <div id='calendar-wrap'>
            <div id='calendar'
                 data-route-load-events="{{ route('cliente.routeLoadEvents', [ 'pro_id' => $profissional->id,
                       'ser_id' => $servico->id ]) }}"
                 data-route-event-update="{{ route('cliente.routeEventUpdate', [ 'pro_id' => $profissional->id,
                       'ser_id' => $servico->id ]) }}"
                 data-route-event-store="{{ route('cliente.routeEventStore', [ 'pro_id' => $profissional->id,
                       'ser_id' => $servico->id ]) }}"
{{--                 data-route-event-confirm="{{ route('cliente.routeEventConfirm', [ 'pro_id' => $profissional->id,--}}
{{--                       'ser_id' => $servico->id ]) }}"--}}
                 data-route-event-delete="{{ route('cliente.routeEventDelete', [ 'pro_id' => $profissional->id,
                       'ser_id' => $servico->id ]) }}"
{{--                 data-route-event-businesshours="{{ route('cliente.routeEventBusinessHours', [ 'pro_id' => $profissional->id,--}}
{{--                       'ser_id' => $servico->id ]) }}"--}}
            >
            </div>

    </div>
        <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
        <script src="{{asset('assets/fullcalendar/lib/locales-all.js')}}"></script>

    </div>
{{--        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>--}}

{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>--}}

{{--        <script>--}}
{{--            let objCalendar;--}}
{{--        </script>--}}
{{--    <script src="{{asset('assets/js/fullcalendar-eventscliente.js')}}"></script>--}}
{{--    <script src="{{asset('assets/js/calendarcliente.js')}}"></script>--}}
@endif
@endsection
