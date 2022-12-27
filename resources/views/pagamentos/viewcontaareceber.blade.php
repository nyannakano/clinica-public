@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if($pagamento->pag_open == 2)
        <div class="alert alert-danger" role="alert">
            Esta conta a receber está cancelada, não é possível modificá-la.
        </div>
    @elseif($pagamento->pag_open == 1)
        <div class="alert alert-info" role="alert">
            Esta conta a receber está encerrada, não é possível modificá-la.
        </div>
    @endif


    <h1>Pagamentos</h1>
    @if($pagamento->pag_open == 0)
        @if($parcelascount < $pagamento->pag_indicator)
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight">
                    <form action="{{ route('pagamentos.generate', ['id' => $pagamento->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-primary mb-2 mt-2"><i
                                class="fas fa-plus-square"></i>
                            Gerar Parcelas
                        </button>
                    </form>
                </div>
            </div>
        @else
            {{--            TODO botão para criar parcelas adicionais--}}
        @endif
    @endif

    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-fingerprint"></i>
                Número
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Valor
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Valor Lançado
            </th>
            <th scope="col">
                <i class="fas fa-clipboard"></i>
                Vencimento
            </th>
            <th scope="col">
                <i class="fas fa-circle"></i>
                Status
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @php
            $valortotal = 0;
        @endphp
        @foreach($parcelas as $parcela)
            @php
                $valortotal += $parcela->par_price;
            @endphp
            <tr>
                <td>{{ $parcela->par_number }}</td>
                <td>R${{ $parcela->par_price }}</td>
                @foreach($movimentacoes as $movimentacao)
                    @if($movimentacao->par_id == $parcela->id)
                        <td>R${{ $movimentacao->mov_value }}</td>
                        @php
                            $movcount = 1;
                        @endphp
                        @break
                    @else
                        @php
                            $movcount = 0;
                        @endphp
                    @endif
                @endforeach
                @if($movcount == 0 || $movcount == null)
                    <td>R$0,0</td>
                @endif

                <td>{{ $parcela->par_deadline }}</td>
                <td>
                    @if($parcela->par_status == 0)
                        <i class="fas fa-circle" style="color: #4a5568"></i>Em Aberto
                    @elseif($parcela->par_status == 1)
                        <i class="fas fa-circle" style="color: chartreuse"></i>Quitado
                    @else
                        <i class="fas fa-circle" style="color: red"></i>Cancelado
                    @endif

                </td>
                <td>
                    @if($parcela->par_status == 0)
                        {{-- botão para editar--}}
                        <button name="editar" id="editar" class="btn btn-info btn-secondary" data-toggle="modal"
                                data-target="#parcela{{ $parcela->id }}">
                            <i class="fas fa-xs fa-edit"></i>
                        </button>
                        {{-- divs para modal de edição --}}
                        <div class="modal fade" id="parcela{{ $parcela->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="areaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="areaLabel">Editando Parcela
                                            {{ $parcela->par_number }}</h4>
                                    </div>
                                    <form action="/financeiro/contaareceber/editar/{{ $parcela->id }}"
                                          enctype="multipart/form-data"
                                          method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <label for="par_number" class="tituloCampo">Número:</label>
                                            <div class="input-group mb-2">
                                                <input type="number" step="1" min="1" required
                                                       class="form-control"
                                                       name="par_number"
                                                       value="{{ $parcela->par_number }}"
                                                       placeholder="Número da Parcela">
                                            </div>
                                            <label for="par_price" class="tituloCampo">Valor:</label>
                                            <div class="input-group mb-2">
                                                <input type="number" step="0.01" min="0.01" required
                                                       class="form-control"
                                                       name="par_price"
                                                       value="{{ $parcela->par_price }}"
                                                       placeholder="Valor da Parcela">
                                            </div>
                                            <label for="par_deadline" class="tituloCampo">Vencimento:</label>
                                            <div class="input-group mb-2">
                                                <input type="date" required class="form-control"
                                                       name="par_deadline" value="{{ $parcela->par_deadline }}">
                                            </div>
                                            <label for="con_id" class="tituloCampo">Conta:</label>
                                            <div class="input-group mb-2">
                                                <select required class="custom-select" name="con_id"
                                                        id="con_id">
                                                    <option>Selecione a Conta...</option>
                                                    @foreach ($contas as $conta)
                                                        @if($conta->id == $pagamento->con_id)
                                                            <option value="{{ $conta->id }}" selected>
                                                                {{ $conta->con_name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $conta->id }}">
                                                                {{ $conta->con_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
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

                        {{--  Modal para lançar recebimento --}}

                        <button name="lancar" id="lancar" class="btn btn-info btn-warning" data-toggle="modal"
                                data-target="#lancar{{ $parcela->id }}">
                            <i class="fas fa-piggy-bank"></i>
                        </button>
                        {{-- divs para modal de edição --}}
                        <div class="modal fade" id="lancar{{ $parcela->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="areaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="areaLabel">Lançar Recebimento
                                            {{ $parcela->par_number }}</h4>
                                    </div>
                                    <form action="/financeiro/contaareceber/receber/{{ $parcela->id }}"
                                          enctype="multipart/form-data"
                                          method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <label for="par_price" class="tituloCampo">Valor:</label>
                                            <div class="input-group mb-2">
                                                <input type="number" step="0.01" min="0.01" required
                                                       class="form-control"
                                                       name="par_price"
                                                       value="{{ $parcela->par_price }}"
                                                       placeholder="Valor da Parcela">
                                            </div>
                                            <label for="par_price" class="tituloCampo">Juros/Multa/Valor
                                                Adicional:</label>
                                            <div class="input-group mb-2">
                                                <input type="number" step="0.01" min="0.0" required
                                                       class="form-control"
                                                       name="par_additional"
                                                       value="0.0">
                                            </div>
                                            <label for="par_discount" class="tituloCampo">Desconto:</label>
                                            <div class="input-group mb-2">
                                                <input type="number" step="0.01" min="0.0" required
                                                       class="form-control"
                                                       name="par_discount"
                                                       value="0.0">
                                            </div>
                                            <label for="par_date" class="tituloCampo">Data de
                                                Recebimento:</label>
                                            <div class="input-group mb-2">
                                                <input type="date" required class="form-control"
                                                       name="par_date" value="{{ $datadehoje }}">
                                            </div>
                                            <label for="con_id" class="tituloCampo">Conta:</label>
                                            <div class="input-group mb-2">
                                                <select required class="custom-select" name="con_id"
                                                        id="con_id">
                                                    <option>Selecione a Conta...</option>
                                                    @foreach ($contas as $conta)
                                                        @if($conta->id == $pagamento->con_id)
                                                            <option value="{{ $conta->id }}" selected>
                                                                {{ $conta->con_name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $conta->id }}">
                                                                {{ $conta->con_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
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
                    @if($pagamento->pag_open == 0)
                        {{-- botão para remover    --}}
                        <div class="btn-group" role="group">
                            <form action="/financeiro/pagamento/remover/{{ $parcela->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                        onclick="return confirm('Deseja realmente excluir esta parcela?')">
                                    <i class="fas fa-xs fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr class="thead-dark">
            <th>
                @if($pagamento->pag_open == 0 || $pagamento->pag_open == 1)
                    <form action="/financeiro/pagamento/cancelar/{{ $pagamento->id }}" method="post">
                        @csrf
                        <button name="remover" id="remover" class="btn btn-danger btn-secondary"
                                onclick="return confirm('Deseja realmente cancelar esta conta a receber?')">
                            Cancelar
                        </button>
                    </form>
                @endif
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="2">Valor total: R${{ $valortotal }}</th>
        </tr>
        </tfoot>
    </table>
@endsection
