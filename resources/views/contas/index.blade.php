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
            <a href="{{ route('form_cadastro_conta') }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Cadastrar Contas Bancárias</a>
        </div>
        <div class="p-2 bd-highlight">
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Contas Bancárias"
                       aria-label="Pesquisar Contas Bancárias">
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
                <i class="fas fa-money-check-alt"></i>
                Nome
            </th>
            <th scope="col">
                <i class="fas fa-university"></i>
                Banco
            </th>
            <th scope="col">
                <i class="fas fa-dollar-sign"></i>
                Saldo
            </th>
            <th scope="col">

            </th>

        </tr>
        </thead>
        <tbody>
        @foreach ($contas as $conta)
            <tr>
                <td>{{ $conta->id }}</td>
                <td>{{ $conta->con_name }}</td>
                <td>{{ $conta->con_bank }}</td>
                @php
                    $val = 0;
                @endphp
                @foreach($movimentacoes as $movimentacao)
                    @if($movimentacao->con_id == $conta->id)
                        @php
                        if ($movimentacao->mov_type == 0){
                            $val = $val + $movimentacao->mov_value;
                        } else {
                            $val = $val - $movimentacao->mov_value;
                        }
                        @endphp
                    @endif
                @endforeach
                @php
                    $balance = $val + $conta->con_balance;
                @endphp
                <td>R${{ $balance }}</td>
                <td>
                    {{-- botão para editar--}}
                    <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                            data-target="#meio{{ $conta->id }}">
                        <i class="fas fa-xs fa-edit"></i>
                    </button>
                    {{-- divs para modal de edição --}}
                    <div class="modal fade" id="meio{{ $conta->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="meioLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="meioLabel">Editando
                                        conta: {{ $conta->con_name }}</h4>
                                </div>
                                <form action="/contas/editar/{{ $conta->id }}" enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="con_name" class="tituloCampo">Nome:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" required class="form-control" name="con_name"
                                                   value="{{ $conta->con_name }}" placeholder="Nome da Conta Bancária">
                                        </div>
                                        <label for="con_indicator" class="tituloCampo">Banco:</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="con_bank"
                                                   value="{{ $conta->con_banco }}" placeholder="Banco">
                                        </div>
                                        <label for="con_balance" class="tituloCampo">Saldo Inicial:</label>
                                        <div class="input-group mb-2">
                                            <input type="number" min="0" step="0.01" class="form-control"
                                                   name="con_balance"
                                                   value="{{ $conta->con_balance }}" placeholder="Saldo">
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
                        <form action="/contas/remover/{{ $conta->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button name="remover" id="remover" hidden class="btn btn-danger btn-secondary"
                                    onclick="return confirm('Deseja realmente excluir esta conta bancária?')">
                                <i class="fas fa-xs fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
{{--                    botão para visualizar movimentações--}}
                    <a href="{{ route('contas.visualizar', ['id' => $conta->id]) }}" name="visualizar" id="visualizar"
                       class="btn btn-success btn-secondary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $contas->links() }}
@endsection
