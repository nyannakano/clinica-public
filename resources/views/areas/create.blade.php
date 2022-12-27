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

    <div class="areaCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="area_name" class="tituloCampo">Nome:</label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="area_name" placeholder="Nome da Área">
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
