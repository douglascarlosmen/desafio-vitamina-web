@extends('layouts.common.main')

@section('title', 'Oportunidades de Venda')

@section('content')
    <div class="col-md-6 mt-3">
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
            </tr>

            @foreach ($salesOpportunities as $saleOpportunity)
                <tr>
                    <td>{{$saleOpportunity->id}}</td>
                    <td>{{$saleOpportunity->title}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
