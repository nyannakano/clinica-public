@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')
    <div id="bloco-meio" class="mb-5">
        <span class="principal">
            @if($cadastrado == true)
            @foreach($areas as $area)
                <span class="areas">
                    <h5 id="cinza" class="mb-3">
                        {{ $area->area_name }}
                    </h5>
                    @foreach($profissionais as $profissional)
                        @if($profissional->area_id == $area->id)
                            <a href="{{ route('home.servicos', ['pro_id' => $profissional->id])}}"
                                class="badge badge-pill badge-warning mb-3" id="cor-cursor">
                                {{ $profissional->pro_name }}
                            </a>
                        @endif
                    @endforeach

                </span>
            @endforeach
            @else
            <h5 id="cinza" class="mb-3">
                Você deve completar seu cadastro antes de continuar!
            </h5>
            <a href="{{ route('home.registerUpdate') }}" class="badge badge-pill badge-warning mb-3" id="cor-cursor">Clique aqui para continuar</a>
            @endif
        </div>
    </div>

@endsection
