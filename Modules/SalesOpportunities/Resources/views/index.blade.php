@extends('layouts.common.main')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

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

        <div class="row">
            <form>
                <div class="mb-3">
                    <label for="date_filter" class="form-label">Filtro de Data</label>
                    <input type="text" name="date_filter" class="form-control" id="date_filter"
                        value="{{ $date_filter }}">
                </div>

                <div class="mb-3">
                    <label for="seller_filter" class="form-label">Vendedor</label>
                    <select name="seller_filter" id="seller_filter" class="form-control">
                        <option value="">Selecione...</option>
                        @foreach ($sellers as $seller)
                            <option @if ($seller->id == $seller_filter) selected @endif value="{{ $seller->id }}">
                                {{ $seller->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary">Aplicar Filtro</button>
                </div>
            </form>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Vendedor</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>

            @foreach ($salesOpportunities as $saleOpportunity)
                <tr class="{{ $saleOpportunity->tableRowClass() }}">
                    <td>{{ $saleOpportunity->id }}</td>
                    <td>{{ $saleOpportunity->title }}</td>
                    <td>{{ $saleOpportunity->client->name }}</td>
                    <td>{{ $saleOpportunity->product->name }}</td>
                    <td>{{ $saleOpportunity->seller->name }}</td>
                    <td>{{ $saleOpportunity->formatted_status }}</td>
                    <td>{{ $saleOpportunity->created_at }}</td>
                    <td>
                        @if ($saleOpportunity->status != 'approved')
                            <a
                                href="{{ route('sale_opportunity.approve', ['saleOpportunityId' => $saleOpportunity->id]) }}">Aprovar</a>
                        @endif

                        @if ($saleOpportunity->status != 'refused')
                            <a
                                href="{{ route('sale_opportunity.refuse', ['saleOpportunityId' => $saleOpportunity->id]) }}">Reprovar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
autoUpdateInput
    <script>
        $('#date_filter').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sáb"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 0
            }
        });
    </script>
@endsection
