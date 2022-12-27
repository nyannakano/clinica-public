@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')
    <div id="bloco-meio" class="mb-5">
        <span class="principal">
            @if($cadastrado == true)
            <h5 id="cinza" class="mb-3">
                Qual serviço, de <b>{{ $profissional->pro_name }}</b>, você deseja agendar?
            </h5>
            @foreach($servicos as $servico)
                <span class="areas">
                    <a href="{{ route('home.scheduling', ['pro_id' => $profissional->id, 'ser_id' => $servico->id ]) }}" class="badge badge-pill badge-warning mb-3"
                       id="cor-cursor">{{ $servico->ser_name }}</a>
                </span>
            @endforeach
            @else
            <h5 id="cinza" class="mb-3">
                Você deve completar seu cadastro antes de continuar!
            </h5>
            <a href="{{ route('home.registerUpdate') }}" class="badge badge-pill badge-warning mb-3" id="cor-cursor">Clique aqui para continuar</a>
            @endif
        </span>
    </div>

@endsection
