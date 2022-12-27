@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')
    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <div id="bloco-meio" class="mb-5">
        @if(Auth::user() == null)
            <h2 class="mt-5" id="cinza">
                Olá Visitante!
            </h2>
        @else
            <h2 class="mt-5" id="cinza">
                Olá {{Auth::user()->name}}!
            </h2>
        @endif

        {{-- <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-5 mt-5">
            <div class="input-group">
                <input type="search" aria-describedby="button-addon1" class="form-control border-0 bg-light" hidden>
                <div class="input-group-append">
                    <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
        </div> --}}
        <h5 id="cinza" class="mb-3">
            Com quem você deseja agendar?
        </h5>
        @foreach($profissionais as $profissional)
            <a href="{{ route('home.servicos', [ 'pro_id' => $profissional->id ]) }}" class="badge badge-pill badge-warning mb-3" id="cor-cursor">{{ $profissional->pro_name}}</a>
        @endforeach
        <h5 id="cinza" class="mt-3 mb-1">
            Serviços:
        </h5>
    </div>
    <div class="carrossel">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner carousel-dark">
                <div class="carousel-item active">
                    <img class="d-block w-100"
                         src="{{ asset('/assets/imgs/logo.png') }}"
                         id="imgcarrossel"
                         alt="First slide">
                </div>
                @foreach($servicos as $servico)

                <div class="carousel-item">
                    <a href="{{ route('home.agendar') }}"><img class="d-block w-100"
                         src="{{ asset('/assets/storage/' . $servico->ser_image) }}"
                         id="imgcarrossel"
                         alt="{{ $servico->ser_name }}">
                    <div class="carousel-caption d-md-block">
                        <h5><span class="badge badge-secondary">{{ $servico->ser_name }}</span></h5>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endsection
