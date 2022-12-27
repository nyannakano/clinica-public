@extends('templates.layout')

@section('header')

@endsection

@section('content')
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="ordemCriacao">
        <form method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="cli_id" class="tituloCampo">Cliente:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="cli_id" id="cli_id">
                            <option value="0" selected>Selecione o Cliente...</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">
                                    {{ $cliente->clie_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="pro_id" class="tituloCampo">Profissional:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="pro_id" id="pro_id">
                            <option value="0" selected>Selecione o Profissional...</option>
                            @foreach ($profissionais['data'] as $profissional)
                                <option value="{{ $profissional->id }}">
                                    {{ $profissional->pro_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ser_id" class="tituloCampo">Serviço:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="ser_id" id="ser_id" disabled>
                            <option selected>Escolha...</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ord_sessions" class="tituloCampo">Sessões:</label>
                    <div class="input-group mb-2">
                        <input type="number" id="ord_sessions" min="1" step="1" class="form-control"
                               name="ord_sessions" placeholder="Quantidade de Sessões" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ord_description" class="tituloCampo">Descrição:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="ord_description" placeholder="Descrição do serviço">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="ord_description" class="tituloCampo">Informações Adicionais:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="ord_additional" placeholder="Informações adicionais do serviço">
                    </div>
                </div>
                <div class="col-sm-4">
                    <button style="width: 100%;" class="btn btn-primary mb-2 mt-3">Cadastrar</button>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/profissionais-servicos.js') }}"></script>
@endsection
