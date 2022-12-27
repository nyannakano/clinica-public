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

    <div class="profissionalCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="pro_name" class="tituloCampo">Nome:</label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="pro_name"
                               placeholder="Nome do Profissional">
                    </div>
                    <label for="pro_health_plan" class="tituloCampo">Planos de Saúde:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="pro_health_plan"
                               placeholder="Planos de Saúde (separando por vírgula)">
                    </div>
                    <label for="pro_color" class="tituloCampo">Cor:</label>
                    <div class="input-group mb-2">
                        <input type="color" required class="form-control" name="pro_color">
                    </div>
                    <label for="area_id" class="tituloCampo">Área em que atua:</label>
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
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <button style="width: 100%;" class="btn btn-primary mb-2 mt-3">Cadastrar</button>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>

@endsection
