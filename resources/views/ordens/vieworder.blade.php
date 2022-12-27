@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($ordem->ord_status == 2)
        <div class="alert alert-danger">
            <ul>
                <li>
                    Esta ordem está cancelada
                </li>
            </ul>
        </div>
    @elseif($ordem->ord_status == 1)
        <div class="alert alert-primary">
            <ul>
                <li>
                    Esta ordem está encerrada
                </li>
            </ul>
        </div>
    @endif
    <div class="ordemEdicao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="cli_id" class="tituloCampo">Cliente:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="cli_id" id="cli_id" disabled>
                            @foreach ($clientes as $cliente)
                                @if($ordem->cli_id == $cliente->id)
                                    <option value="{{ $cliente->id }}" selected>
                                        {{ $cliente->clie_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="pro_id" class="tituloCampo">Profissional:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="pro_id" id="pro_id" disabled>
                            @foreach ($profissionais as $profissional)
                                @if($ordem->pro_id == $profissional->id)
                                    <option value="{{ $profissional->id }}">
                                        {{ $profissional->pro_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ser_id" class="tituloCampo">Serviço:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="ser_id" id="ser_id" disabled>
                            @foreach ($servicos as $servico)
                                @if($ordem->ser_id == $servico->id)
                                    <option value="{{ $servico->id }}">
                                        {{ $servico->ser_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ord_sessions" class="tituloCampo">Sessões:</label>
                    <div class="input-group mb-2">
                        <input type="number" id="ord_sessions" min="1" step="1" class="form-control" name="ord_sessions"
                               placeholder="Quantidade de Sessões" value="{{ $ordem->ord_sessions }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ord_description" class="tituloCampo">Descrição:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="ord_description"
                               placeholder="Descrição do serviço" value="{{ $ordem->ord_description }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ord_additional" class="tituloCampo">Informações Adicionais:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="ord_additional"
                               placeholder="Informações adicionais do serviço" value="{{ $ordem->ord_additional }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    @foreach($pagamentos as $pagamento)
                        <label for="pag_price" class="tituloCampo">Valor:</label>
                        <div class="input-group mb-2">
                            @if($ordem->id == $pagamento->ord_id)
                                <input type="number" step="0.01" min="0.01" class="form-control" name="pag_price"
                                       placeholder="Valor" value="{{ $pagamento->pag_price }}">
                                <input type="number" class="form-control" name="pag_id" placeholder="Valor"
                                       value="{{ $pagamento->id }}" hidden>
                            @endif
                        </div>
                </div>
                <div class="col-sm-6">
                    <label for="mei_id" class="tituloCampo">Meio de pagamento:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="mei_id" id="mei_id">
                            @foreach($meios as $meio)
                                @if($pagamento->mei_id == $meio->id)
                                    <option value="{{ $meio->id }}" selected>
                                        {{ $meio->mei_name }}
                                    </option>
                                @else
                                    <option value="{{ $meio->id }}">
                                        {{ $meio->mei_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="pag_indicator" class="tituloCampo">Parcelas:</label>
                    <div class="input-group mb-2">
                        @if($ordem->id == $pagamento->ord_id)
                            <input type="number" step="1" min="1" class="form-control" name="pag_indicator"
                                   placeholder="Valor" value="{{ $pagamento->pag_indicator }}">
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="pag_price" class="tituloCampo">Pagamento em aberto?:</label>
                    <div class="input-group mb-2">
                        @if($pagamento->pag_indicator >= 1)
                            <input type="text" value="Sim, faltam {{ $pagamento->pag_indicator }} parcelas" disabled>
                        @else
                            <input type="text" value="Não" disabled>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="con_id" class="tituloCampo">Conta Bancária:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="con_id" id="con_id">
                            @foreach($contas as $conta)
                                @if($pagamento->con_id == $conta->id)
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
                </div>
                @endforeach
            </div>
            @if(!$ordem->ord_status == 2)
                <div class="col-sm-12">
                    <button style="width: 100%;" class="btn btn-primary mb-2 mt-3">Salvar</button>
                </div>
            @endif
        </form>
        <div class="col-sm-12">
            @if($ordem->ord_status == 1 || $ordem->ord_status == 0)
                <form action="/ordens/cancelar/{{ $ordem->id }}" method="post">
                    @csrf
                    <button name="cancel" id="cancel" class="btn btn-danger btn-secondary mb-2 mt-3"
                            style="width: 100%;"
                            onclick="return confirm('Deseja realmente cancelar este serviço? Isto é irreversível')">
                        Cancelar
                    </button>
                </form>
        </div>
        @endif
        <div class="col-sm-12">
            @if(!$ordem->ord_status == 1)
                <form action="/ordens/encerrar/{{ $ordem->id }}" method="post">
                    @csrf
                    <button name="finalize" id="finalize" class="btn btn-success btn-secondary mb-2 mt-3"
                            style="width: 100%;"
                            onclick="return confirm('Deseja realmente encerrar este serviço? Isto é irreversível')">
                        Encerrar
                    </button>
                </form>
            @endif
        </div>
        <div class="col-sm-12">
            <a href="{{ route('ordens.agendamentos', ['id' => $ordem->id]) }}" name="agenda" id="agenda"
               class="btn btn-success btn-dark mb-2 mt-3" style="width: 100%;">
                Agendamentos
            </a>
        </div>
        <div class="col-sm-4"></div>
    </div>

    </div>
@endsection
