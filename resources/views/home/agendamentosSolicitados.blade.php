@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')
    <div id="bloco-meio" class="mb-5">
        <span class="principal">
            @if($cliente == null)
            <h5 id="cinza" class="mb-3">
                Você deve completar seu cadastro antes de continuar!
            </h5>
            <a href="{{ route('home.registerUpdate') }}" class="badge badge-pill badge-warning mb-3" id="cor-cursor">Clique aqui para continuar</a>
            @else
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        <i class="fas fa-clipboard"></i>
                        Título
                    </th>
                    <th scope="col">
                        <i class="fas fa-clipboard"></i>
                        Horário Início
                    </th>
                    <th scope="col">
                        <i class="fas fa-clipboard"></i>
                        Horário Fim
                    </th>
                    <th scope="col">
                        <i class="fas fa-clipboard"></i>
                        Serviço
                    </th>
                    <th scope="col">
                        <i class="fas fa-clipboard"></i>
                        Profissional
                    </th>
                    <th scope="col">
                        <i class="fas fa-clipboard"></i>
                        Aprovado?
                    </th>
                    <th scope="col"></th>

                </tr>
                </thead>
                <tbody>
                @foreach ($agendamentos as $agendamento)
                    <tr>
                        <td>{{ $agendamento->title }}</td>
                        <td>{{ $agendamento->start}}</td>
                        <td>{{ $agendamento->end }}</td>
                        @foreach($servicos as $servico)
                        @if($servico->id == $agendamento->ser_id)
                            <td>{{ $servico->ser_name }}</td>
                        @endif
                        @endforeach
                        @foreach($profissionais as $profissional)
                        @if($profissional->id == $agendamento->pro_id)
                            <td>{{ $profissional->pro_name }}</td>
                        @endif
                        @endforeach
                        @if($agendamento->auth == 0)
                            <td>Não</td>
                        @else
                            <td>Sim</td>
                        @endif
                        <td>
                            {{-- botão para remover    --}}
                            <div class="btn-group" role="group">
                                <form action="{{ route('home.destroyAgendamento', ['id' => $agendamento->id ])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                            onclick="return confirm('Deseja realmente excluir este agendamento?')">
                                        <i class="fas fa-xs fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </span>
    </div>

@endsection
