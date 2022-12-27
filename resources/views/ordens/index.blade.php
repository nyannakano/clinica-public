@extends('templates.layout')

@section('header')

@endsection

@section('content')

    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif

    <div class="d-flex bd-highlight mb-3">
        <div class="mr-auto p-2 bd-highlight">
            <a href="{{ route('form_nova_ordem') }}" class="btn btn-primary mb-2 mt-2"><i
                    class="fas fa-plus-square"></i>
                Nova Ordem de Serviço</a>
        </div>
        <div class="p-2 bd-highlight">
            <form class="form-inline mb-2 mt-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar Ordem de Serviço"
                       aria-label="Pesquisar Área">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>



    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">
                <i class="fas fa-fingerprint"></i>
                Número
            </th>
            <th scope="col">
                <i class="fas fa-user"></i>
                Nome
            </th>
            <th scope="col">
                <i class="fas fa-dollar-sign"></i>
                Valor
            </th>
            <th scope="col">
                <i class="fas fa-user-md"></i>
                Profissional
            </th>
            <th scope="col">
                <i class="fas fa-circle"></i>
                Status
            </th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($ordens as $ordem)
            <tr>
                <td>{{ $ordem->id }}</td>
                @foreach ($clientes as $cliente)
                    @if($cliente->id == $ordem->cli_id)
                        <td> {{$cliente->clie_name}} </td>
                    @endif
                @endforeach
                @foreach ($pagamentos as $pagamento)
                    @if($pagamento->ord_id == $ordem->id)
                        <td> R${{$pagamento->pag_price}}</td>
                    @endif
                @endforeach
                @foreach ($profissionais as $profissional)
                    @if($profissional->id == $ordem->pro_id)
                        <td>{{$profissional->pro_name}}</td>
                    @endif
                @endforeach
                @if($ordem->ord_status == 0)
                    <td>
                        <i class="fas fa-circle" style="color: #4a5568"></i>
                        Em aberto
                    </td>
                @elseif ($ordem->ord_status == 1)
                    <td>
                        <i class="fas fa-circle" style="color: chartreuse"></i>
                        Encerrado
                    </td>
                @else
                    <td>
                        <i class="fas fa-circle" style="color: red"></i>
                        Cancelado
                    </td>
                @endif

                <td>
                    <a href="{{ route('ordens.vieworder', ['id' => $ordem->id]) }}" name="visualizar" id="visualizar"
                       class="btn btn-success btn-secondary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $ordens->links() }}

@endsection
