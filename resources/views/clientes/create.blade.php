@extends('templates.layout')

@section('header')
    <h2 class="tituloCadastroCliente">Cadastro de Clientes</h2>
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

    <div class="clienteCriacao">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="clie_name" class="tituloCampo">Nome*:</label>
                    <div class="input-group mb-2">
                        <input type="text" required class="form-control" name="clie_name" placeholder="Nome do cliente">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_cpf" class="tituloCampo">CPF:</label>
                    <div class="input-group">
                        <div class="input-group mb-2">
                            <input type="number" maxlength="11" restrict-input="^[0-9-]*$"
                                   onkeypress="return isNumberKey(event)" class="form-control" name="clie_cpf"
                                   placeholder="CPF do Cliente">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_bornday" class="tituloCampo">Data de Nascimento:</label>
                    <div class="input-group mb-2">
                        <input type="date" class="form-control" name="clie_bornday">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_email" class="tituloCampo">E-mail:</label>
                    <div class="input-group mb-2">
                        <input type="email" class="form-control" name="clie_email" placeholder="E-mail">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_phone" class="tituloCampo">Telefone Celular:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="clie_phone" placeholder="Número de telefone">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="city_id" class="tituloCampo">Estado*:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="state_id" id="state_id">
                            <option value="0" selected>Selecione o Estado...</option>
                            @foreach ($estados['data'] as $estado)
                                <option value="{{ $estado->id }}">
                                    {{ $estado->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="city_id" class="tituloCampo">Cidade*:</label>
                    <div class="input-group mb-2">
                        <select required class="custom-select" name="city_id" id="city_id" disabled>
                            <option selected>Escolha...</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="clie_address_street" class="tituloCampo">Logradouro:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="clie_address_street" placeholder="Logradouro">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_address_district" class="tituloCampo">Bairro:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="clie_address_district" placeholder="Bairro">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="clie_address_number" class="tituloCampo">Número:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="clie_address_number" placeholder="Número">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="clie_address_zipcode" class="tituloCampo">CEP:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="clie_address_zipcode" placeholder="CEP">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="clie_address_complement" class="tituloCampo">Complemento:</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="clie_address_complement"
                               placeholder="Complemento">
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

@section('script')
    <script src="{{asset('assets/js/cidades-estados.js')}}"></script>
@endsection
