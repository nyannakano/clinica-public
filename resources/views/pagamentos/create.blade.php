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

    <div class="clienteCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="clie_id" class="tituloCampo">Cliente:</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" name="clie_id" id="clie_id">
                            <option value="{{ null }}" selected>Selecione o Cliente...</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">
                                    {{ $cliente->clie_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_id" class="tituloCampo">Profissional:</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" name="pro_id" id="pro_id">
                            <option value="{{ null }}" selected>Selecione o Profissional...</option>
                            @foreach ($profissionais as $profissional)
                                <option value="{{ $profissional->id }}">
                                    {{ $profissional->pro_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="pag_indicator" class="tituloCampo">Número de Parcelas:</label>
                    <div class="input-group mb-2">
                        <input type="number" step="1" min="1" required class="form-control" name="pag_indicator" value="1">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="pag_price" class="tituloCampo">Valor Total:</label>
                    <div class="input-group">
                        <div class="input-group mb-2">
                            <input type="number" value="1.00" step="0.01" min="0.01" class="form-control" name="pag_price" required>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="mei_id" class="tituloCampo">Meio de Pagamento:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="mei_id" id="mei_id">
                            <option value="{{ null }}" selected>Selecione o Meio de Pagamento...</option>
                            @foreach ($meios as $meio)
                                <option value="{{ $meio->id }}">
                                    {{ $meio->mei_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="city_id" class="tituloCampo">Conta:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="con_id" id="con_id">
                            <option value="{{ null }}" selected>Selecione a Conta...</option>
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
    </div>
@endsection
