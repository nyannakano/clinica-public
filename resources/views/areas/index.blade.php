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
            <a href="{{ route('form_cadastro_area') }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Cadastrar Áreas</a>
        </div>
        <div class="p-2 bd-highlight">
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Área"
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
                <i class="fas fa-clipboard"></i>
                Nome
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($areas as $area)
            <tr>
                <td>{{ $area->id }}</td>
                <td>{{ $area->area_name }}</td>
                <td>
                    {{-- botão para editar--}}
                    <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                            data-target="#area{{ $area->id }}">
                        <i class="fas fa-xs fa-edit"></i>
                    </button>
                    {{-- divs para modal de edição --}}
                    <div class="modal fade" id="area{{ $area->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="areaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="areaLabel">Editando
                                        área {{ $area->area_name }}</h4>
                                </div>
                                <form action="/areas/editar/{{ $area->id }}" enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="area_name" class="tituloCampo">Nome:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" required class="form-control" name="area_name"
                                                   value="{{ $area->area_name }}" placeholder="Nome da área">
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
                        <form action="/areas/remover/{{ $area->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir esta área?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $areas->links() }}

@endsection
