@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')

<div id="bloco-meio" class="mb-5">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu sua senha? Sem problema, você vai receber um e-mail com um link para criação de uma nova senha.') }}
        </div>


        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <label for="email" class="tituloCampo">E-mail:</label>
                <div class="input-group mb-2">
                    <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@exemplo.com" :value="old('email')" required autofocus>
                </div>
            </div>

            <button style="width: 100%;" class="btn btn-secondary mb-2 mt-3">
                    {{ __('Resetar Senha') }}
            </button>

        </form>
</div>
@endsection
