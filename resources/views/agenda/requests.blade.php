@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <div class="alert alert-primary" role="alert">
        Agendamentos aguardando aprovação
    </div>



    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-fingerprint"></i>
                Id
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Cliente
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Whatsapp
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Profissional
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Serviço
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Início
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Fim
            </th>

            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ $agendamento->id }}</td>
                <td>
                    @foreach ($clientes as $cliente)
                    @if ($cliente->id == $agendamento->clie_id)
                        {{ $cliente->clie_name }}
                    @endif
                    @endforeach
                </td>
                <td id="wpp">
                    @foreach ($clientes as $cliente)
                    @if ($cliente->id == $agendamento->clie_id)
                        {{ $cliente->clie_phone }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($profissionais as $profissional)
                    @if ($profissional->id == $agendamento->pro_id)
                        {{ $profissional->pro_name }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($servicos as $servico)
                    @if ($servico->id == $agendamento->ser_id)
                        {{ $servico->ser_name }}
                    @endif
                    @endforeach
                </td>
                <td> {{ $agendamento->start }} </td>
                <td> {{ $agendamento->end }}</td>
                <td>
                    {{-- botão para aprovar --}}
                    <div class="btn-group" role="group">
                        <form action="{{ route('agenda.aprovar', ["id" => $agendamento->id ]) }}" method="post">
                            @csrf
                            <button name="aprovar" id="aprovar" class="btn btn-success btn-secondary"
                                    onclick="return confirm('Deseja realmente aprovar este agendamento?')">
                                    <i class="fas fa-thumbs-up"></i>
                            </button>
                        </form>
                    </div>
                    {{-- botão para remover    --}}
                    <div class="btn-group" role="group">
                        <form action="/agendamento-recusar/{{ $agendamento->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente recusar e excluir este agendamento?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
