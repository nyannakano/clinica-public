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

    <div class="meiosCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="mei_name" class="tituloCampo">Nome:</label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="mei_name" placeholder="Nome do Meio de Pagamento">
                    </div>
                    <label for="mei_indicator" class="tituloCampo">
                        Indicador de pagamento
                        (1 para a vista. 2 ou mais para pagamentos a prazo, utilizando a quantidade de parcelas):
                    </label>
                    <div class="input-group mb-2">
                        <input type="number" min="1" step="1" required class="form-control"
                               name="mei_indicator" placeholder="Ex: 3">
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
