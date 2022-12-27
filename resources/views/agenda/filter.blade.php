@extends('templates.layoutagenda')

@section('content')

    <div class="loading">
        <img src="{{asset('assets/imgs/load.gif')}}" alt="Carregando" class="loading-image">
    </div>

    <div class="alert alert-danger" role="alert" id="aguardandoaprovacao">
        <a href="/agenda-requests">
            Agendamentos aguardando aprovação, clique aqui para visualizar
        </a>
    </div>
    <div id='wrap'>

        @include('agenda.modal-filter-calendar')
        <div class="container">
            <div class="row mb-3 mt-3">
                <div class="col-sm" style="background-color: {{ $profissional->pro_color }}">
                    <a href="{{ route('agenda.index') }}" class="alert-link">
                        {{ $profissional->pro_name }}
                    </a>
                </div>
            </div>
        </div>
        <div id='calendar-wrap'>
            <div id='calendar'
                 data-route-load-events="{{ route('routeLoadEventsFilter', ['id' => $profissional->id]) }}"
                 data-route-event-update="{{ route('routeEventUpdate') }}"
                 data-route-event-store="{{ route('routeEventStore') }}"
                 data-route-event-confirm="{{ route('routeEventConfirm') }}"
                 data-route-event-delete="{{ route('routeEventDelete') }}"
            >
            </div>
        </div>
    </div>

@endsection
