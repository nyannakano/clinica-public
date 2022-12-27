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

    <div class="contasCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="con_name" class="tituloCampo">Nome:</label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="con_name" placeholder="Nome da Conta Bancária">
                    </div>
                    <label for="con_bank" class="tituloCampo">
                        Banco:
                    </label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control"
                               name="con_bank" placeholder="Ex: Caixa Econômica">
                    </div>
                    <label for="con_banco" class="tituloCampo">
                        Saldo:
                    </label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="number" min="0" step="0.01" class="form-control"
                               name="con_balance" placeholder="Ex: 1500,50" value="0.0">
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
