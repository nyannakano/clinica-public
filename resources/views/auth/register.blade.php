@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')

<div id="bloco-meio" class="mb-5">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="tituloCampo">Nome:</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="name" id="name" :value="old('name')" required autofocus autocomplete="name">
                </div>
            </div>

            <div class="mt-4">
                <label for="email" class="tituloCampo">E-mail:</label>
                <div class="input-group mb-2">
                    <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@exemplo.com" :value="old('email')" required autofocus>
                </div>
            </div>

            <div class="mt-4">
                <label for="password" class="tituloCampo">Senha:</label>
                <div class="input-group mb-2">
                    <input type="password" id="password" class="form-control" name="password" type="password" required autocomplete="new-password">
                </div>
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="tituloCampo">Confirme sua Senha:</label>
                <div class="input-group mb-2">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

                <a href="{{ route('password.request') }}">
                    Esqueci minha senha
                </a><br><br>

                <button style="width: 100%;" class="btn btn-secondary mb-2 mt-3">
                    {{ __('Registrar') }}
                </button>
        </form>
</div>
@endsection
