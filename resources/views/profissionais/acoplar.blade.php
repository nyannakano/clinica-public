@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>
                Quais serviços deseja ADICIONAR a lista de {{ $profissional->pro_name }}?
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($servicos as $servico) {{-- for each para buscar todos os serviços --}}
        @if($servico->area_id == $profissional->area_id) {{-- if para filtrar apenas o serviços da mesma área do profissional --}}
        <tr>
            <td>{{ $servico->ser_name }}</td>
            <td>
                <div class="btn-group" role="group">
                    <form action="/profissionais/{{ $profissional->id }}/servicos/{{ $servico->id }}" method="post">
                        @csrf
                        <button name="adicionar" id="adicionar" class="btn btn-success btn-secondary"
                                onclick="return confirm('Deseja adicionar este serviço?')">
                            <i class="fas fa-plus-square"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
        </tbody>
    </table>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>
                Quais serviços deseja REMOVER da lista de {{ $profissional->pro_name }}?
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($servicosdois as $servico) {{-- for each para buscar todos os serviços --}}
        <tr>
            <td>{{ $servico->ser_name }}</td>
            <td>
                <div class="btn-group" role="group">
                    <form action="/profissionais/retirar/{{ $profissional->id }}/servicos/{{ $servico->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button name="adicionar" id="adicionar" class="btn btn-danger btn-secondary"
                                onclick="return confirm('Deseja remover este serviço?')">
                            <i class="fas fa-xs fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
