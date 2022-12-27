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
            <a href="{{ route('form_cadastro_cliente') }}" class="btn btn-dark mb-2 mt-2 btn-cliente"><i
                    class="fas fa-plus-square"></i>
                Cadastrar Cliente</a>
        </div>


        <div class="p-2 bd-highlight">
            {{-- TODO desenvolver um Search, para buscar os cliente pelo nome, CPF ou número de telefone--}}
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Cliente"
                       aria-label="Pesquisar Cliente">
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
                <i class="fab fa-whatsapp"></i>
                Telefone
            </th>
            <th scope="col">
                <i class="far fa-id-card"></i>
                CPF
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->clie_name }}</td>
                <td>{{ $cliente->clie_phone }}</td>
                <td>{{ $cliente->clie_cpf }}</td>
                <td>
                    <a href="{{ route('pagamentos.filterclient', [ 'id' => $cliente->id]) }}"
                       name="financeiro" id="financeiro" class="btn btn-success">
                        <i class="fas fa-piggy-bank"></i>
                    </a>
                    {{-- botão para editar--}}
                    <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                            data-target="#cliente{{ $cliente->id }}">
                        <i class="fas fa-xs fa-edit"></i>
                    </button>
                    {{-- divs para modal de edição --}}
                    <div class="modal fade" id="cliente{{ $cliente->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="clienteLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="clienteLabel">Editando
                                        cliente {{ $cliente->clie_name }}</h4>
                                </div>
                                <form action="/clientes/editar/{{ $cliente->id }}" enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="clie_name" class="tituloCampo">Nome:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" required class="form-control" name="clie_name"
                                                   value="{{ $cliente->clie_name }}" placeholder="Nome do cliente">
                                        </div>
                                        <label for="clie_cpf" class="tituloCampo">CPF:</label>
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="clie_cpf"
                                                   value="{{ $cliente->clie_cpf }}"
                                                   placeholder="CPF do cliente (sem pontuação)">

                                        </div>
                                        <label for="clie_email" class="tituloCampo">E-mail:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_email"
                                                   value="{{ $cliente->clie_email }}" placeholder="E-mail">
                                        </div>
                                        <label for="clie_phone" class="tituloCampo">Telefone Celular:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_phone"
                                                   value="{{ $cliente->clie_phone}}" placeholder="Número de telefone">
                                        </div>
                                        <label for="clie_bornday" class="tituloCampo">Data de Nascimento:</label>
                                        <div class="input-group mb-2">
                                            <input type="date" class="form-control" name="clie_bornday"
                                                   value="{{ $cliente->clie_bornday }}">
                                        </div>
                                        <label for="city_id" class="tituloCampo">Cidade:</label>
                                        <div class="input-group mb-2">
                                            <select required class="custom-select" name="city_id" id="city_id">
                                                <option selected>Escolha...</option>
                                                @foreach ($cidades as $cidade) {{-- for each para buscar as cidades --}}
                                                @if($cidade->id == $cliente->city_id) {{-- if para deixar selecionado a cidade atual --}}
                                                <option value="{{ $cidade->id }}" selected>
                                                    {{ $cidade->title }}
                                                </option>
                                                @else
                                                    <option value="{{ $cidade->id }}">
                                                        {{ $cidade->title }}
                                                    </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="clie_address_street" class="tituloCampo">Logradouro:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_address_street"
                                                   value="{{ $cliente->clie_address_street }}" placeholder="Logradouro">
                                        </div>
                                        <label for="clie_address_district" class="tituloCampo">Bairro:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_address_district"
                                                   value="{{ $cliente->clie_address_district }}" placeholder="Bairro">
                                        </div>
                                        <label for="clie_address_number" class="tituloCampo">Número:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_address_number"
                                                   value="{{ $cliente->clie_address_number }}" placeholder="Número">
                                        </div>
                                        <label for="clie_address_zipcode" class="tituloCampo">CEP:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_address_zipcode"
                                                   value="{{ $cliente->clie_address_zipcode }}" placeholder="CEP">
                                        </div>
                                        <label for="clie_address_complement" class="tituloCampo">Complemento:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="clie_address_complement"
                                                   value="{{ $cliente->clie_address_complement }}"
                                                   placeholder="Complemento">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- botão para remover    --}}
                    <div class="btn-group" role="group">
                        <form action="/clientes/remover/{{ $cliente->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir este cliente?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $clientes->links() }}

@endsection
