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

    <div class="gerarPagamento">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="ord_id" class="tituloCampo">Pagamento da Ordem de Serviço: {{ $ordem->id }} </label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="ord_id"
                               placeholder="Número da Ordem de Serviço" value="{{ $ordem->id }}" hidden>
                    </div>
                    <label for="pag_price" class="tituloCampo">Valor:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="number" min="0.01" step="0.01" class="form-control" name="pag_price"
                               placeholder="Valor do Pagamento" value="{{ $servico->ser_price }}">
                    </div>
                    <label for="pag_indicator" class="tituloCampo">Parcelas:</label>
                    <div class="input-group mb-2">
                        <input type="number" min="1" step="1" required class="form-control" name="pag_indicator" value="1">
                    </div>
                    <label for="mei_id" class="tituloCampo">Meio de Pagamento:</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" name="mei_id" id="mei_id">
                            <option selected>Escolha...</option>
                            @foreach ($pagamentos as $pagamento)
                                <option value="{{ $pagamento->id }}">
                                    {{ $pagamento->mei_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label for="con_id" class="tituloCampo">Conta Bancária:</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" name="con_id" id="con_id">
                            <option selected>Escolha...</option>
                            @foreach ($contas as $conta)
                                <option value="{{ $conta->id }}">
                                    {{ $conta->con_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <button style="width: 100%;" class="btn btn-primary mb-2 mt-3">Cadastrar</button>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>

@endsection
