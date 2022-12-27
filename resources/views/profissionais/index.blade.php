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
            <a href="{{ route('form_cadastro_profissional') }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Cadastrar Profissionais</a>
        </div>
        <div class="p-2 bd-highlight">
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Profissionais"
                       aria-label="Pesquisar Área">
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
                <i class="fas fa-user"></i>
                Nome
            </th>
            <th scope="col">
                <i class="fas fa-briefcase-medical"></i>
                Planos de Saúde
            </th>
            <th scope="col">
                <i class="fas fa-palette"></i>
                Cor
            </th>
            <th scope="col">
                <i class="fas fa-head-side-mask"></i>
                Área em que atua
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($profissionais as $profissional)
            <tr>
                <td>{{ $profissional->id }}</td>
                <td>{{ $profissional->pro_name }}</td>
                <td>{{ $profissional->pro_health_plan }}</td>
                <td><input type="color" value = "{{ $profissional->pro_color }}" disabled></td>
                @foreach ($areas as $area) {{-- for each para buscar todos as areas --}}
                @if($area->id == $profissional->area_id) {{-- if para deixar selecionado a area atual --}}
                <td>{{ $area->area_name }}</td>
                @endif
                @endforeach
                <td>
                    {{-- botão para editar--}}
                    <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                            data-target="#profissional{{ $profissional->id }}">
                        <i class="fas fa-xs fa-edit"></i>
                    </button>
                    {{-- divs para modal de edição --}}
                    <div class="modal fade" id="profissional{{ $profissional->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="profissionalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="profissionalLabel">Editando
                                        profissional {{ $profissional->pro_name }}</h4>
                                </div>
                                <form action="/profissionais/editar/{{ $profissional->id }}"
                                      enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="pro_name" class="tituloCampo">Nome:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" required class="form-control" name="pro_name"
                                                   value="{{ $profissional->pro_name }}"
                                                   placeholder="Nome do Profissional">
                                        </div>
                                        <label for="pro_health_plan" class="tituloCampo">Planos de Saúde:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="pro_health_plan"
                                                   value="{{ $profissional->pro_health_plan }}"
                                                   placeholder="Planos de Saúde">
                                        </div>
                                        <label for="pro_color" class="tituloCampo">Cor:</label>
                                        <div class="input-group mb-2">
                                            <input type="color" class="form-control" name="pro_color"
                                                   value="{{ $profissional->pro_color }}">
                                        </div>
                                        <label for="area_id" class="tituloCampo">Área em que atua:</label>
                                        <div class="input-group mb-2">
                                            <select class="custom-select" name="area_id" id="area_id">
                                                @foreach ($areas as $area) {{-- for each para buscar todos as categorias --}}
                                                @if($area->id == $profissional->area_id) {{-- if para deixar selecionado a categoria atual --}}
                                                <option value="{{ $area->id }}" selected>
                                                    {{ $area->area_name }}
                                                </option>
                                                @else
                                                    <option value="{{ $area->id }}">
                                                        {{ $area->area_name }}
                                                    </option>
                                                @endif
                                                @endforeach
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

                    {{--    Botão para adicionar serviços que são prestados por este profissional    --}}
                    <div class="btn-group" role="group">
                        <a href="{{ route('profissionais.acoplar', ['id' => $profissional->id])}}" class="btn btn-success btn-secondary">
                            <i class="fas fa-concierge-bell"></i>
                        </a>
                    </div>
                    {{--    Botão para selecionar os horários disponíveis para agendamento pelos clientes  --}}
                    <div class="btn-group" role="group">
                        <a href="{{ route('profissionais.disponibilidade', ['id' => $profissional->id])}}" class="btn btn-warning btn-secondary">
                            <i class="fas fa-clock"></i>
                        </a>
                    </div>
                    {{-- botão para remover    --}}
                    <div class="btn-group" role="group">
                        <form action="/profissionais/remover/{{ $profissional->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir este profissional?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $profissionais->links() }}
@endsection
