@extends('templates.layoutclientespages')

@section('header')

@endsection

@section('content')

<div id="bloco-meio" class="mb-5">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="tituloCampo">E-mail:</label>
                <div class="input-group mb-2">
                    <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@exemplo.com" :value="old('email')" required autofocus>
                </div>
            </div>

            <div class="mt-4">
                <label for="password" class="tituloCampo">Senha:</label>
                <div class="input-group mb-2">
                    <input type="password" id="password" class="form-control" name="password" type="password" required autocomplete="current-password">
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar Senha') }}</span>
                </label>
            </div>


                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Esqueci minha senha
                    </a><br><br>
                    <a href="/register">
                        Não possui registro? Registrar
                    </a><br><br>
                @endif

                <button style="width: 100%;" class="btn btn-secondary mb-2 mt-3">
                    {{ __('Entrar') }}
                </button>
        </form>
</div>
@endsection
