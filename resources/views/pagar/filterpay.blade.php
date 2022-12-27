@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <h1>Contas a Receber</h1>

    <div class="d-flex bd-highlight mb-1">
        <div class="mr-auto p-2 bd-highlight">
            <a href="{{ route('form_cadastro_contaareceber') }}" class="btn btn-primary mb-1 mt-2"><i
                    class="fas fa-plus-square"></i>
                Nova Conta a Receber</a>
        </div>
    </div>
    <div style="text-align: right" class="mr-3">
        <a href="{{ route('pagar.index') }}"><span class="badge badge-primary">Todos</span></a>
        <a href="{{ route('pagar.filterpay', [ 'type' => 0]) }}"><span class="badge badge-secondary">Em Aberto</span></a>
        <a href="{{ route('pagar.filterpay', [ 'type' => 1]) }}"><span class="badge badge-success">Quitado</span></a>
        <a href="{{ route('pagar.filterpay', [ 'type' => 2]) }}"><span class="badge badge-danger">Cancelado</span></a>
        {{--    <span class="badge badge-warning">Vencendo</span>--}}
    </div>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-fingerprint"></i>
                Id
            </th>
            <th scope="col">
                <i class="fas fa-user"></i>
                Cliente
            </th>
            <th scope="col">
                <i class="fas fa-user-md"></i>
                Profissional
            </th>
            <th scope="col">
                <i class="fas fa-dollar-sign"></i>
                Valor Total
            </th>
            <th scope="col">
                <i class="fas fa-dollar-sign"></i>
                Parcelas
            </th>
            <th scope="col">
                <i class="fas fa-circle"></i>
                Status
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($pagamentos as $pagamento)
            <tr>
                <td>{{ $pagamento->id }}</td>
                @if($pagamento->clie_id == null)
                    <td style="color: grey">Não possui</td>
                @else
                    @foreach($clientes as $cliente)
                        @if($cliente->id == $pagamento->clie_id)
                            <td>{{ $cliente->clie_name }}</td>
                        @endif
                    @endforeach
                @endif
                @if($pagamento->pro_id == null)
                    <td style="color: grey">Não possui</td>
                @else
                    @foreach($profissionais as $profissional)
                        @if($profissional->id == $pagamento->pro_id)
                            <td>{{ $profissional->pro_name }}</td>
                        @endif
                    @endforeach
                @endif
                <td>R${{ $pagamento->pag_price }}</td>
                <td>{{ $pagamento->pag_indicator }}</td>
                @if($pagamento->pag_open == 0)
                    <td><i class="fas fa-circle" style="color: #4a5568"></i>
                        Em Aberto
                    </td>
                @elseif($pagamento->pag_open == 1)
                    <td><i class="fas fa-circle" style="color: chartreuse"></i>
                        Quitado
                    </td>
                @else
                    <td><i class="fas fa-circle" style="color: red"></i>
                        Cancelado
                    </td>
                @endif
                <td>
                    <a href="financeiro/contaareceber/{{ $pagamento->id }}" name="visualizar" id="visualizar"
                       class="btn btn-success btn-secondary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pagamentos->links() }}

@endsection
