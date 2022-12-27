@extends('templates.layoutagenda')

@section('content')

    <div class="loading">
        <img src="{{asset('assets/imgs/load.gif')}}" alt="Carregando" class="loading-image">
    </div>

    <div class="alert alert-danger" role="alert" id="aguardandoaprovacao">
        <a href="/agenda-requests">Agendamentos aguardando aprovação, clique aqui para visualizar</a>
    </div>
    <div id='wrap'>

        @include('agenda.modal-calendar')
        <div class="container">
            <div class="row mb-3 mt-3">
                @foreach($profissionais as $profissional)
                    <div class="col-sm" style="background-color: {{ $profissional->pro_color }}">
                        <a href="{{ route('agenda.filter', ['id' => $profissional->id])}}" class="alert-link">
                            {{ $profissional->pro_name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div id='calendar-wrap'>
            <div id='calendar'
                 data-route-load-events="{{ route('routeLoadEvents') }}"
                 data-route-event-update="{{ route('routeEventUpdate') }}"
                 data-route-event-store="{{ route('routeEventStore') }}"
                 data-route-event-confirm="{{ route('routeEventConfirm') }}"
                 data-route-event-approve="{{ route('routeEventApprove') }}"
                 data-route-event-delete="{{ route('routeEventDelete') }}"
            >
            </div>
        </div>
    </div>

@endsection
