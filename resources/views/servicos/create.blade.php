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

    <div class="servicoCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="ser_name" class="tituloCampo">Nome:</label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="ser_name" placeholder="Nome do Serviço">
                    </div>
                    <label for="ser_price" class="tituloCampo">Preço:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="number" min="0" step="0.01" required class="form-control"
                               name="ser_price" placeholder="Ex: 99,90" value="1.00">
                    </div>
                    <label for="area_id" class="tituloCampo">Área:</label>
                    <div class="input-group mb-2">
                        <select class="custom-select" name="area_id" id="area_id" required>
                            <option selected>Escolha...</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">
                                    {{ $area->area_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <label for="ser_image" class="tituloCampo">Imagem:</label>
                    <div class="input-group mb-2">
                        <label style="width: 100%;">
                            <input type="file" class="form-control" id="ser_image" name="ser_image">
                        </label>
                    </div>
                    <label for="ser_sessions" class="tituloCampo">Sessões:</label>
                    <div class="input-group mb-2">
                        <input type="number" required class="form-control" name="ser_sessions" placeholder="Quantidade de sessões">
                    </div>
                    <label for="ser_time" class="tituloCampo">Tempo de duração (em minutos):</label>
                    <div class="input-group mb-2">
                        <input type="number" step="1" min="1" required class="form-control" name="ser_time" placeholder="EX: 60">
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
