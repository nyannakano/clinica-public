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
            <a href="{{ route('form_cadastro_meio') }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Cadastrar Meios de Pagamento</a>
        </div>
        <div class="p-2 bd-highlight">
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Meio de Pagamento"
                       aria-label="Pesquisar Meio de Pagamento">
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
                <i class="fas fa-credit-card"></i>
                Nome
            </th>
            <th scope="col">
                <i class="fas fa-coins"></i>
                Indicador de Pagamento
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($meios as $meio)
            <tr>
                <td>{{ $meio->id }}</td>
                <td>{{ $meio->mei_name }}</td>
                <td>{{ $meio->mei_indicator }}</td>
                <td>
                    {{-- botão para editar--}}
                    <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                            data-target="#meio{{ $meio->id }}">
                        <i class="fas fa-xs fa-edit"></i>
                    </button>
                    {{-- divs para modal de edição --}}
                    <div class="modal fade" id="meio{{ $meio->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="meioLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="meioLabel">Editando
                                        meio de pagamento {{ $meio->mei_name }}</h4>
                                </div>
                                <form action="/meios/editar/{{ $meio->id }}" enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="mei_name" class="tituloCampo">Nome:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" required class="form-control" name="mei_name"
                                                   value="{{ $meio->mei_name }}" placeholder="Nome do serviço">
                                        </div>
                                        <label for="mei_indicator" class="tituloCampo">Indicador de Pagamento:</label>
                                        <div class="input-group mb-2">
                                            <input type="number" min="1" class="form-control" name="mei_indicator"
                                                   value="{{ $meio->mei_indicator }}" step="1" placeholder="Indicador de Pagamento">
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
                        <form action="/meios/remover/{{ $meio->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir este meio de pagamento?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $meios->links() }}
@endsection
