@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')
    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    @if($cliente == null)
    <div id="bloco-meio" class="mb-5">
        <form method="post" enctype="multipart/form-data">
        @csrf
        <label for="clie_name" class="tituloCampo mt-5">Nome Completo:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_name">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">E-mail:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_email">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Whatsapp:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_phone">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Data de Nascimento:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="date" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_bornday">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">CPF:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_cpf">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Logradouro:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_street">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Bairro:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_district">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Número:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_number">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Complemento:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_complement">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">CEP:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_zipcode">
            </div>
        </div>
        <div class="col-sm-4">
            <button style="width: 100%;" class="btn btn-primary mb-2 mt-3">Cadastrar</button>
        </div>
        </form>
    </div>
    @else
    <div id="bloco-meio" class="mb-5">
        <form method="post" enctype="multipart/form-data" action="{{ route('home.registerUpdateUpdate') }}">
        @csrf
        <label for="clie_name" class="tituloCampo mt-5">Nome Completo:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_name" value="{{ $cliente->clie_name }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">E-mail:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_email" value="{{ $cliente->clie_email }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Whatsapp:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_phone" value="{{ $cliente->clie_phone }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Data de Nascimento:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="date" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_bornday" value="{{ $cliente->clie_bornday }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">CPF:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_cpf" value="{{ $cliente->clie_cpf }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Logradouro:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_street" value="{{ $cliente->clie_address_street }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Bairro:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_district" value="{{ $cliente->clie_address_district }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Número:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_number" value="{{ $cliente->clie_address_number }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">Complemento:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_complement" value="{{ $cliente->clie_address_complement }}">
            </div>
        </div>
        <label for="clie_name" class="tituloCampo mt-2">CEP:</label>
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-2">
            <div class="input-group">
                <input type="text" aria-describedby="button-addon1" class="form-control border-0 bg-light" name="clie_address_zipcode" value="{{ $cliente->clie_address_zipcode }}">
            </div>
        </div>
        <div class="col-sm-4">
            <button style="width: 100%;" class="btn btn-primary mb-2 mt-3">Atualizar</button>
        </div>
        </form>
    </div>

    @endif
@endsection
