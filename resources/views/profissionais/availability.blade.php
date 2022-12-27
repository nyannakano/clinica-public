@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>
                Qual a disponibilidade para agendamentos do(a) profissional {{ $profissional->pro_name }}?
            </th>
            <th>

            </th>
        </tr>
        </thead>
    </table>

    <a href="{{ route('excecoes.criar', [ 'id' => $profissional->id ]) }}" class="btn btn-dark">Exceções</a>

    @foreach($dias as $dia) {{-- Verificar todos os dias se possuem ou não horário definido --}}
        <form id="availability-profissional" class="availability-profissional">
            <h3>{{ $dia->dia_name }}</h3>
            @php
                $day = \App\Models\Dia::find($dia->id);
                $i = 0;
                $hora_id = null;
                foreach($horas as $hora){
                    if($hora->dia_id == $dia->id) {
                        $i++;
                        $hora_id = $hora->id;
                        break;
                    }
                }
                if($i > 0){
                    $exists = true;
                } else {
                    $exists = false;
                }
            @endphp
            @if($exists)
                <select name="dia{{ $dia->id }}" id="dia{{ $dia->id }}">
                    <option value="false">Não atende</option>
                    <option value="true" selected>Atende</option>
                </select>

            @else
                <select name="dia{{ $dia->id }}" id="dia{{ $dia->id }}">
                    <option value="false" selected>Não atende</option>
                    <option value="true">Atende</option>
                </select>
            @endif
        </form>
        @if($exists)
            <button name="horarios{{ $dia->id }}" id="editar"
                    class="btn btn-info btn-secondary horarios{{ $dia->id }}"
                    data-toggle="modal"
                    data-target="#horarios{{ $dia->id }}">
                Horário
            </button>
            {{--                divs para modal de edição--}}
            <div class="modal fade" id="horarios{{ $dia->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="horariosLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="horariosLabel">Editando {{ $dia->dia_name }}</h4>
                        </div>
                        <form action="/profissionais/disponibilidade/dia/{{ $dia->id }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <label for="horas_start" class="tituloCampo">Horário Inicial:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_start" value="{{ $hora->horas_start }}">
                                    <input type="text" required class="form-control" name="profissionalid"
                                           value="{{ $profissional->id }}" hidden>
                                    <input type="text" required class="form-control" name="diaid"
                                           value="{{ $dia->id }}"
                                           hidden>
                                    <input type="text" required class="form-control" name="horaid"
                                           value="{{ $hora_id }}"
                                           hidden>
                                </div>
                                <label for="horas_interval" class="tituloCampo">Horário Inicial Intervalo:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_interval" value="{{ $hora->horas_interval }}">
                                </div>
                                <label for="horas_return" class="tituloCampo">Horário Término Intervalo:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_return" value="{{ $hora->horas_return }}">
                                </div>
                                <label for="horas_end" class="tituloCampo">Horário Término:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_end" value="{{ $hora->horas_end }}">
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
            {{-- botão para remover    --}}
            <div class="btn-group" role="group">
                <form action="/profissionais/disponibilidade/{{ $hora_id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                            onclick="return confirm('Deseja realmente excluir este horário?')">
                        <i class="fas fa-xs fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        @else
            <button name="horarios{{ $dia->id }}" id="editar"
                    class="btn btn-info btn-secondary horarios{{ $dia->id }}"
                    data-toggle="modal"
                    data-target="#horarios{{ $dia->id }}" disabled>
                Horário
            </button>
            {{--                divs para modal de edição--}}
            <div class="modal fade" id="horarios{{ $dia->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="horariosLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="horariosLabel">Editando {{ $dia->dia_name }}</h4>
                        </div>
                        <form action="/profissionais/disponibilidade/dia/{{ $dia->id }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="modal-body">
                                <label for="horas_start" class="tituloCampo">Horário Inicial:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_start">
                                    <input type="text" required class="form-control" name="profissionalid"
                                           value="{{ $profissional->id }}" hidden>
                                    <input type="text" required class="form-control" name="diaid"
                                           value="{{ $dia->id }}"
                                           hidden>
                                </div>
                                <label for="horas_interval" class="tituloCampo">Horário Inicial Intervalo:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_interval">
                                </div>
                                <label for="horas_return" class="tituloCampo">Horário Término Intervalo:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_return">
                                </div>
                                <label for="horas_end" class="tituloCampo">Horário Término:</label>
                                <div class="input-group mb-2">
                                    <input type="time" required class="form-control" name="horas_end">
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
        @endif

    @endforeach

@endsection

@section('script')
    <script src="{{asset('assets/js/profissionais-disponibilidade.js')}}"></script>
@endsection
