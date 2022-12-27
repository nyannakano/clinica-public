<!doctype html>
<html lang="pt-br">

<head>
    <title>Scullp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Icones -->
    <script src="https://kit.fontawesome.com/80b78ce4b7.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- CSS Próprio -->
    <link rel="stylesheet" href="{{ asset('assets/css/clientes.css') }}">

    @yield('head')

</head>

<body>
<!-- HEADER -->
<div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Scullp</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('home.index') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('home.registerUpdate') }}">Cadastro</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/dashboard">Opções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.agendamentosSolicitados') }}">Agendamentos Solicitados</a>
                    </li>
                  </ul>
                </div>
              </nav>
        </div>
    </div>
    <nav class="navbar navbar-collapse navbar-dark ">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarToggleExternalContent"
                        aria-controls="navbarToggleExternalContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <i class="fas fa-bars" id="burgermenu"></i>
                </button>
            </li>
        </ul>
        <img src="{{asset('assets/imgs/logo.png')}}" alt="Logo" height="80px" class="rounded float-right">
    </nav>
</div>

{{--<ul class="nav navbar navbar-dark bg-dark">--}}
{{--    <li class="nav-item">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <a class="navbar-brand" href="/">--}}
{{--                    --}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}


<h1>@yield('header')</h1>


<!-- CONTEUDO -->
<div class="content ml-4 mr-4">

    @yield('content')

</div>

<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<!-- JavaScript Próprio -->


</body>

</html>
