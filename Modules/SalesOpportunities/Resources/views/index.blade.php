@extends('layouts.common.main')

@section('title', 'Oportunidades de Venda')

@section('content')
    <div class="col-md-9 mt-3">
        <h1 class="text-center">Oportunidades de Venda</h1>

        <div class="d-flex justify-content-center my-3">
            <a class="btn btn-primary" href="{{ route('sale_opportunity.create') }}" role="button">Nova oportunidade</a>
        </div>

        @if (session('status') === 'sale-opportunity-created')
            <div class="text-center mt-2">
                @include('components.common.success-alert', [
                    'successMessage' => 'Oportunidade Cadastrada',
                ])
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Vendedor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>

            @foreach ($salesOpportunities as $saleOpportunity)
                <tr>
                    <td>{{$saleOpportunity->id}}</td>
                    <td>{{$saleOpportunity->title}}</td>
                    <td>{{$saleOpportunity->client->name}}</td>
                    <td>{{$saleOpportunity->product->name}}</td>
                    <td>{{$saleOpportunity->seller->name}}</td>
                    <td>{{$saleOpportunity->formatted_status}}</td>
                    <td>
                        <a href="{{route('sale_opportunity.approve', ['saleOpportunityId' => $saleOpportunity->id])}}">Aprovar</a>
                        |
                        <a href="{{route('sale_opportunity.refuse', ['saleOpportunityId' => $saleOpportunity->id])}}">Reprovar</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
