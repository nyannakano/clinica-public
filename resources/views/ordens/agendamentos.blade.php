@extends('templates.layout')

@section('header')

@endsection

@section('content')

    <div class="mr-auto p-2 bd-highlight">
        @if($sessoes < $ordem->ord_sessions)
            <a href="{{ route('ordens.agendar', ['id' => $ordem->id]) }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Agendamentos Restantes</a>
        @endif
    </div>

    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-fingerprint"></i>
                Identificação
            </th>
            <th scope="col">
                <i class="fas fa-user"></i>
                Título
            </th>
            <th scope="col">
                <i class="fas fa-calendar-alt"></i>
                Início
            </th>
            <th scope="col">
                <i class="fas fa-calendar-alt"></i>
                Fim
            </th>
            <th scope="col">
                <i class="fas fa-palette"></i>
                Cor
            </th>
            <th scope="col">
                <i class="fas fa-circle"></i>
                Status
            </th>
            <th scope="col">
                <i class="far fa-newspaper"></i>
                Descrição
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ $agendamento->id }}</td>
                <td>{{ $agendamento->title }}</td>
                <td>{{ $agendamento->start }}</td>
                <td>{{ $agendamento->end }}</td>
                <td>
                    <input type="color" value="{{ $agendamento->color }}" disabled>
                </td>
                <td>
                    @if($agendamento->status == 0)
                        <i class="fas fa-circle" style="color: #4a5568"></i>Não confirmado
                    @elseif($agendamento->status == 1)
                        <i class="fas fa-circle" style="color: chartreuse"></i>Confirmado
                    @else
                        <i class="fas fa-circle" style="color: red"></i>Cancelado
                    @endif
                </td>
                <td>{{ $agendamento->description }}</td>
                <td>
                    <a href="{{ route('agenda.index')}}" name="visualizar" id="visualizar"
                       class="btn btn-success btn-secondary">
                        <i class="fas fa-calendar-alt"></i>
                    </a>
                    {{-- botão para remover    --}}
                    <div class="btn-group" role="group">
                        <form action="{{ route('agendamento.deletar', ['id' => $agendamento->id]) }}" method="post">
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
    {{-- botão para agendamentos adicionais --}}
    @if($sessoes >= $ordem->ord_sessions)
        <button name="adicional" id="adicional" class="btn btn-info btn-secondary" data-toggle="modal"
                data-target="#ordem{{ $ordem->id }}"><i
                class="fas fa-plus-square"></i>
            Agendamentos Adicionais
        </button>
    @endif
    {{-- divs para modal de edição --}}
    <div class="modal fade" id="ordem{{ $ordem->id }}" tabindex="-1" role="dialog"
         aria-labelledby="areaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="areaLabel">Agendamento Adicional</h4>
                </div>
                <form action="{{ route('ordens.adicional') }}" enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="title" class="tituloCampo">Título:</label>
                        <div class="input-group mb-2">
                            <input type="text" required class="form-control" name="title"
                                   value="{{ $cliente->clie_name }}: Adicional" placeholder="Título do agendamento">
                            <input type="number" required class="form-control" name="ordemid"
                                   value="{{ $ordem->id }}" hidden>
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
Sessão: Adicional
                                </textarea>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Fechar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
