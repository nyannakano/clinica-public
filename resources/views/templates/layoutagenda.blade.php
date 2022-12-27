<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <link href="{{asset('assets/fullcalendar/lib/main.css')}}" rel='stylesheet' />
    <link href="{{asset('assets/css/agenda.css')}}" rel='stylesheet' />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Clinica Agenda</title>


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
                            <a href='javascript:logout.submit()'>
                                <img src="{{asset('assets/imgs/logout.png')}}" style=" filter: invert(1);" height="30vw">
                            </a> --}}
                        {{-- </div> --}}

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

    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/locales-all.js')}}"></script>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        let objCalendar;
    </script>
    <script src="{{asset('assets/js/fullcalendar-events.js')}}"></script>
    <script src="{{asset('assets/js/calendar.js')}}"></script>
</body>

</html>
