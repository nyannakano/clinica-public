@extends('templates.layout')

@section('header')

@endsection

@section('content')
    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif
    <button name="horarios{{ $profissionalid }}" id="editar"
            class="btn mb-3 btn-info btn-secondary horarios{{ $profissionalid }}"
            data-toggle="modal"
            data-target="#excecaoNova{{ $profissionalid }}">
        Nova Exceção
    </button>
    {{--                divs para modal de edição--}}
    <div class="modal fade" id="excecaoNova{{ $profissionalid }}" tabindex="-1" role="dialog"
         aria-labelledby="excecaoNovaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="excecaoNovaLabel">Adicionando Exceção</h4>
                </div>
                <form action="/profissionais/excecoes/{{ $profissionalid }}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="exc_horas_start" class="tituloCampo">Horário Inicial:</label>
                        <div class="input-group mb-2">
                            <input type="time" required class="form-control" name="exc_horas_start" >
                            <input type="text" required class="form-control" name="profissionalid" value="{{ $profissionalid }}" hidden>
                        </div>
                        <label for="exc_horas_end" class="tituloCampo">Horário Término:</label>
                        <div class="input-group mb-2">
                            <input type="time" required class="form-control" name="exc_horas_end">
                        </div>
                        <label for="exc_dia" class="tituloCampo">Data:</label>
                        <div class="input-group mb-2">
                            <input type="date" required class="form-control" name="exc_dia">
                        </div>
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


    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-fingerprint"></i>
                Id
            </th>
            <th scope="col">
                <i class="fas fa-user"></i>
                Dia
            </th>
            <th scope="col">
                <i class="fas fa-briefcase-medical"></i>
                Hora Inicial
            </th>
            <th scope="col">
                <i class="fas fa-palette"></i>
                Hora Final
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($excecoes as $excecao)
            <tr>
                <td>{{ $excecao->id }}</td>
                <td>{{ $excecao->exc_dia }}</td>
                <td>{{ $excecao->exc_horas_start }}</td>
                <td>{{ $excecao->exc_horas_end }}</td>
                <td>
                    {{-- botão para remover    --}}
                    <div class="btn-group" role="group">
                        <form action="{{ route('excecoes.destroy', [ 'id' => $excecao->id ]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir esta exceção?')">
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
