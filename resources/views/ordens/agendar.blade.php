@extends('templates.layout')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/css/agenda.css')}}" rel='stylesheet'/>
@endsection

@section('header')
    <div class="loading">
        <img src="{{asset('assets/imgs/load.gif')}}" alt="Carregando" class="loading-image">
    </div>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="/ordens" type="button" class="btn btn-danger">Sair</a>
    <h1>Agendando consultas para {{ $cliente->clie_name }} | Consulta com {{ $profissional->pro_name }}</h1>
    <h3>Ordem de serviço: {{ $ordem->id }}</h3>

    @for ($i = 1 + $sessoes; $i <= $ordem->ord_sessions; $i++)
        <div class="agendamento">
            <h2 class="sessao">Sessão: {{ $i }}</h2>
            <form method="post" enctype="multipart/form-data" class="mb-4" id="agendamento" name="agendamento">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="title" class="tituloCampo">Título:</label>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="title"
                               value="{{ $cliente->clie_name }}: {{ $i }}">
                        <input type="text" class="form-control" name="ordemid"
                               value="{{ $ordem->id }}" id="ordemid" hidden="true">
                    </div>
                    <div class="col-sm-12">
                        <label for="color" class="tituloCampo">Cor:</label>
                    </div>
                    <div class="input-group mb-2">
                        <input type="color" class="form-control" name="color"
                               value="{{ $profissional->pro_color }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="start" class="tituloCampo">Data e Hora Inicial:</label>
                    </div>
                    <div class="input-group mb-2">
                        <input type="datetime-local" class="form-control date-time" name="start" id="start"
                               placeholder="Data e Hora Inicial">
                    </div>
                    <div class="col-sm-6">
                        <label for="end" class="tituloCampo">Data e Hora Final:</label>
                    </div>
                    <div class="input-group mb-2">
                        <input type="datetime-local" class="form-control date-time" name="end" id="end"
                               placeholder="Data e Hora Final">
                    </div>
                    <div class="col-sm-12">
                        <label for="color" class="tituloCampo">Descrição:</label>
                    </div>
                    <div class="input-group mb-2">
                                <textarea class="form-control" name="description" id="description">Ref: Ordem de Serviço - {{ $ordem->id }}
Profissional: {{ $profissional->pro_name }}
Cliente: {{ $cliente->clie_name }}
Sessão: {{ $i }}
                                </textarea>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button type="submit" style="width: 100%;" id="botaoEnviar"
                                class="btn btn-primary mb-2 mt-3">Cadastrar
                        </button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>
        </div>
        <a href="{{ URL::route('agenda.index') }}" class="btn btn-info" target="_blank">Abrir Agenda</a>
    @endfor
@endsection


@section('script')
    <script src="{{asset('assets/js/agendarviaordem.js')}}"></script>
@endsection

