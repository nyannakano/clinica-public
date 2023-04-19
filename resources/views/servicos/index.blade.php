@extends('templates.layout')

@section('header')

@endsection

@section('content')
    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <div class="d-flex bd-highlight mb-3">
        <div class="mr-auto p-2 bd-highlight">
            <a href="{{ route('form_cadastro_servico') }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Cadastrar Serviços</a>
        </div>
        <div class="p-2 bd-highlight">
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Serviço"
                       aria-label="Pesquisar Serviço">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
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
                <i class="fas fa-concierge-bell"></i>
                Nome
            </th>
            <th scope="col">
                <i class="fas fa-coins"></i>
                Preço
            </th>
            <th scope="col">
                <i class="fas fa-flask"></i>
                Área
            </th>
            <th scope="col">
                <i class="fas fa-stopwatch-20"></i>
                Sessões
            </th>
            <th scope="col">
                <i class="fas fa-stopwatch-20"></i>
                Tempo de cada sessão (em minutos)
            </th>
            <th scope="col">
                <i class="fas fa-stopwatch-20"></i>
                Disponível para agendamento por clientes?
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($servicos as $servico)
            <tr>
                <td>{{ $servico->id }}</td>
                <td>{{ $servico->ser_name }}</td>
                <td>R${{ $servico->ser_price }}</td>
                @foreach($areas as $area)
                    @if($area->id == $servico->area_id)
                        <td>{{ $area->area_name }}</td>
                    @endif
                @endforeach
                <td>{{ $servico->ser_sessions }}</td>
                <td>{{ $servico->ser_time }}</td>
                <td>
                    @if($servico->ser_availability == 1)
                        Não
                    @else
                        Sim
                    @endif
                </td>
                <td>
                    {{-- botão para editar--}}
                    <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                            data-target="#servico{{ $servico->id }}">
                        <i class="fas fa-xs fa-edit"></i>
                    </button>
                    {{-- divs para modal de edição --}}
                    <div class="modal fade" id="servico{{ $servico->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="servicoLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="servicoLabel">Editando
                                        serviço {{ $servico->ser_name }}</h4>
                                </div>
                                <form action="/servicos/editar/{{ $servico->id }}" enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="ser_name" class="tituloCampo">Nome:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" required class="form-control" name="ser_name"
                                                   value="{{ $servico->ser_name }}" placeholder="Nome do serviço">
                                        </div>
                                        <label for="ser_price" class="tituloCampo">Preço:</label>
                                        <div class="input-group mb-2">
                                            <input type="number" min="0" class="form-control" name="ser_price"
                                                   value="{{ $servico->ser_price }}" step="0.01"
                                                   placeholder="Preço do serviço">
                                        </div>
                                        <label for="ser_sessions" class="tituloCampo">Quantidade de Sessões:</label>
                                        <div class="input-group mb-2">
                                            <input type="number" class="form-control" name="ser_sessions"
                                                   value="{{ $servico->ser_sessions }}"
                                                   placeholder="Quantidade de sessões">
                                        </div>
                                        <label for="area_id" class="tituloCampo">Área:</label>
                                        <div class="input-group mb-2">
                                            <select name="area_id" id="area_id" class="custom-select">
                                                @foreach($areas as $area)
                                                    @if($area->id == $servico->area_id)
                                                        <option value="{{ $area->id }}"
                                                                selected>{{ $area->area_name }}</option>
                                                    @else
                                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="ser_image" class="tituloCampo">Imagem:</label>
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" id="ser_image" name="ser_image">
                                        </div>
                                        <label for="ser_time" class="tituloCampo">Tempo mínimo para cada sessão (em minutos):</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="ser_time"
                                                   value="{{ $servico->ser_time }}">
                                        </div>
                                        <label for="ser_time" class="tituloCampo">Disponível para agendamento por
                                            clientes?</label>
                                        <div class="input-group mb-2">
                                            <select class="custom-select" name="ser_availability" id="ser_availability">
                                                @if($servico->ser_availability == 1) {{-- 1 está disponível; 0 não --}}
                                                <option value="1" selected>
                                                    Não
                                                </option>
                                                <option value="2">
                                                    Sim
                                                </option>
                                                @else
                                                    <option value="1">
                                                        Não
                                                    </option>
                                                    <option value="2" selected>
                                                        Sim
                                                    </option>
                                                @endif
                                            </select>
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
                        <form action="/servicos/remover/{{ $servico->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir este serviço?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $servicos->links() }}
@endsection
