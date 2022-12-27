@extends('templates.layout')

@section('header')

@endsection

@section('content')

    <div class="d-flex bd-highlight mb-3">
        {{-- botão para adicionar nova receita ou despesa--}}
        <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                data-target="#movadd">
            Nova Movimentação
        </button>
        {{-- divs para modal de nova receita ou despesa --}}
        <div class="modal fade" id="movadd" tabindex="-1" role="dialog"
             aria-labelledby="movaddLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="movaddLabel">Nova Movimentação</h4>
                    </div>
                    <form action="{{ route('contas.addmov', [ 'id' => $conta->id ]) }}"
                          enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="number" class="form-control" name="con_id"
                                   value="{{ $conta->id }}" hidden>
                            <label for="mov_type" class="tituloCampo">Tipo*:</label>
                            <div class="input-group mb-2">
                                <select name="mov_type" id="mov_type">
                                    <option value="0">Receita</option>
                                    <option value="1">Despesa</option>
                                </select>
                            </div>
                            <label for="mov_value" class="tituloCampo">Valor*:</label>
                            <div class="input-group mb-2">
                                R$<input type="number" min="0.01" step="0.01" class="form-control" name="mov_value"
                                       value="0.0">
                            </div>
                            <label for="mov_description" class="tituloCampo">Descrição:</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="mov_description"
                                         value="">
                            </div>
                            <label for="clie_id" class="tituloCampo">Cliente:</label>
                            <div class="input-group mb-2">
                                <select class="custom-select" name="clie_id" id="clie_id">
                                    <option value="{{ null }}">
                                        Selecione
                                    </option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">
                                            {{ $cliente->clie_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="pro_id" class="tituloCampo">Profissional:</label>
                            <div class="input-group mb-2">
                                <select class="custom-select" name="pro_id" id="pro_id">
                                    <option value="{{ null }}">
                                        Selecione
                                    </option>
                                    @foreach ($profissionais as $profissional)
                                        <option value="{{ $profissional->id }}">
                                            {{ $profissional->pro_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="mov_date" class="tituloCampo">Data:</label>
                            <div class="input-group mb-2">
                                <input type="date" class="form-control" name="mov_date">
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
                Descrição
            <th scope="col">
                <i class="fas fa-money-check-alt"></i>
                Cliente
            </th>
            <th scope="col">
                <i class="fas fa-university"></i>
                Profissional
            </th>
            <th scope="col">
                <i class="fas fa-dollar-sign"></i>
                Valor
            </th>
            <th scope="col">
                <i class="fas fa-dollar-sign"></i>
                Tipo
            </th>
            <th scope="col">
                Data
            </th>
            <th scope="col">

            </th>
            <th scope="col">

            </th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>0</td>
            <td>SALDO INICIAL</td>
            <td></td>
            <td></td>
            <td>R${{ $conta->con_balance }}</td>
            <td>
                <div style="color: chartreuse">Abertura de Saldo+</div>
            </td>
            <td></td>
        </tr>
        @php
            $valormovimentacoes = 0;
        @endphp
        @foreach ($movimentacoes as $movimentacao)
            @if($movimentacao->mov_cancel == 0)
                <tr>
                    <td>{{ $movimentacao->id }}</td>
                    <td>{{ $movimentacao->mov_description }}</td>
                    <td>
                        @foreach($clientes as $cliente)
                            @if($cliente->id == $movimentacao->clie_id)
                                {{ $cliente->clie_name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($profissionais as $profissional)
                            @if($profissional->id == $movimentacao->pro_id)
                                {{ $profissional->pro_name }}
                            @endif
                        @endforeach
                    </td>
                    <td>R${{ $movimentacao->mov_value }}</td>
                    <td>
                        @if($movimentacao->mov_type == 0)
                            <div style="color: chartreuse">Receita+</div>
                        @else
                            <div style="color: red">Despesa-</div>
                        @endif
                    </td>
                    <td> {{ $movimentacao->mov_date }}</td>
                    <td></td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('mov.remover', ['id' => $movimentacao->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                        onclick="return confirm('Deseja realmente excluir esta movimentação?')">
                                    <i class="fas fa-xs fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @php
                  if ($movimentacao->mov_type == 0) {
                        $valormovimentacoes += $movimentacao->mov_value;
                  } else {
                        $valormovimentacoes -= $movimentacao->mov_value;
                  }
                @endphp
            @else
                <tr class="bg-danger">
                    <td>{{ $movimentacao->id }}</td>
                    <td>{{ $movimentacao->mov_description }}</td>
                    <td>
                        @foreach($clientes as $cliente)
                            @if($cliente->id == $movimentacao->clie_id)
                                {{ $cliente->clie_name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($profissionais as $profissional)
                            @if($profissional->id == $movimentacao->pro_id)
                                {{ $profissional->pro_name }}
                            @endif
                        @endforeach
                    </td>
                    <td>R${{ $movimentacao->mov_value }}</td>
                    <td>
                        @if($movimentacao->mov_type == 0)
                            <div>Receita+</div>
                        @else
                            <div>Despesa-</div>
                        @endif
                    </td>
                    <td> {{ $movimentacao->mov_date }}</td>
                    <td>CANCELADO</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('mov.remover', ['id' => $movimentacao->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                        onclick="return confirm('Deseja realmente excluir esta movimentação?')">
                                    <i class="fas fa-xs fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            @endif
        @endforeach
        @php
            $valormovimentacoes += $conta->con_balance;
        @endphp
        </tbody>
    </table>
    <h1>Valor total: R${{ $valormovimentacoes }} </h1>
    {{ $movimentacoes->links() }}
@endsection
