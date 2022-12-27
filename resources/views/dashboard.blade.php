@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')

<div id="bloco-meio" class="mb-5">
    <h2 class="mt-5" id="cinza">
        Olá {{Auth::user()->name}}!
    </h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="/"><button type="button" class="btn btn-success mb-3" >Clique aqui para retornar a tela inicial</button></a>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ route('home.logout')}}"><button type="button" class="btn btn-danger mb-5">Clique aqui para fazer logout</button></a>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="/agenda"><button type="button" class="btn btn-secondary mt-5">Administrador? Clique aqui</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
