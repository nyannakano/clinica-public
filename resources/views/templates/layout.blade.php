<!doctype html>
<html lang="pt-br">

<head>
    <title>Clinica</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Icones -->
    <script src="https://kit.fontawesome.com/80b78ce4b7.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- CSS Próprio -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/agendamentoviaordem.css') }}">

    @yield('head')

</head>

<body>
    <!-- HEADER -->


    <ul class="nav navbar navbar-dark bg-dark">
        <li class="nav-item">
            <div class="row">
                <div class="col-12">
                    <a class="navbar-brand" href="/agenda">
                        <img src="{{asset('assets/imgs/logo.png')}}" alt="Logo" height="80px">
                    </a>
                </div>
            </div>





        </li>
        <li class="nav-item" style="margin-right: 50%;">

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('clientes.index') }}">
                        Clientes
                    </a>
                    <a class="dropdown-item" href="{{ route('profissionais.index') }}">
                        Profissionais
                    </a>
                    <a class="dropdown-item" href="{{ route('areas.index') }}">
                        Áreas
                    </a>
                    <a class="dropdown-item" href="{{ route('agenda.index') }}">
                        Agenda
                    </a>
                    <a class="dropdown-item" href="{{ route('ordens.index') }}">
                        Ordens de Serviço
                    </a>
                    <a class="dropdown-item" href="{{ route('contas.index') }}">
                        Contas Bancárias
                    </a>
                    <a class="dropdown-item" href="{{ route('meios.index') }}">
                        Meios de Pagamento
                    </a>
                    <a class="dropdown-item" href="{{ route('pagamentos.index') }}">
                        Contas a Receber
                    </a>
                    <a class="dropdown-item" href="{{ route('pagar.index') }}">
                        Contas a Pagar
                    </a>
                    <a class="dropdown-item" href="{{ route('servicos.index') }}">
                        Serviços
                    </a>
                </div>

            </div>
        </li>
        <li class="nav-item navbar-right">
            <div class="row">
                <div class="col-7" style="margin-top: 2%;">
                    <h5 style="color: white">{{Auth::user()->name}}</h5>
                </div>
                {{--                        <div class="col-2">--}}
                {{--                            <img height="50vw" class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />--}}
                {{--                        </div>--}}
                <div class="col-5" style="margin-top: 2%;">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <a href="{{ route('dashboard') }}">
                                <img src="{{asset('assets/imgs/settings.png')}}" style=" filter: invert(1);" height="20vw">
                            </a>
                        </div>

                        {{--                                <div class="col-6 col-sm-4">--}}
                        {{--                                    <a href=" {{ route('dashboard') }}" hidden>--}}
                        {{--                                        <img src="{{asset('assets/imgs/group.png')}}" style=" filter: invert(1);" height="20vw">--}}
                        {{--                                    </a>--}}
                        {{--                                </div>--}}
                        {{-- <div class="col-6 col-sm-4" >
                            <a href='/logout'>
                                <img src="{{asset('assets/imgs/logout.png')}}" style=" filter: invert(1);" height="30vw">
                            </a>
                        </div> --}}

                    </div>
                </div>
            </div>
        </li>
    </ul>



    <h1>@yield('header')</h1>


    <!-- CONTEUDO -->
    <div class="content ml-4 mr-4">

        @yield('content')

    </div>

    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- JavaScript Próprio -->

    <script src="{{asset('assets/js/script.js')}}"></script>

    @yield('script')
    <form name="logout" method="POST" action="{{ route('logout') }}">
        @csrf

        <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();">
        </x-jet-dropdown-link>
    </form>
</body>

</html>
